<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include 'db.php';

// Handle news posting
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['title'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $image = $_FILES['image']['name'];
    $date = date('Y-m-d');
    $author = $_SESSION['admin'];

    $target = "img/" . basename($image);
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $query = "INSERT INTO news (title, content, image, date, author) VALUES ('$title', '$content', '$image', '$date', '$author')";
        if (mysqli_query($conn, $query)) {
            $message = "News posted successfully!";
        } else {
            $message = "Error: " . mysqli_error($conn);
        }
    } else {
        $message = "Failed to upload image.";
    }
}

// Handle event posting
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['event_title'])) {
    $event_title = $_POST['event_title'];
    $event_description = $_POST['event_description'];
    $event_image = $_FILES['event_image']['name'];
    $event_date = $_POST['event_date'];
    $event_location = $_POST['event_location'];

    $target_event = "img/" . basename($event_image);
    if (move_uploaded_file($_FILES['event_image']['tmp_name'], $target_event)) {
        $event_query = "INSERT INTO events (event_title, event_description, event_image, event_date, event_location) VALUES ('$event_title', '$event_description', '$event_image', '$event_date', '$event_location')";
        if (mysqli_query($conn, $event_query)) {
            $event_message = "Event posted successfully!";
        } else {
            $event_message = "Error: " . mysqli_error($conn);
        }
    } else {
        $event_message = "Failed to upload image.";
    }
}

// Handle search
$search_query = "";
if (isset($_POST['search'])) {
    $search_query = $_POST['search_query'];
    $query = "SELECT * FROM news WHERE title LIKE '%$search_query%' ORDER BY date DESC";
} else {
    $query = "SELECT * FROM news ORDER BY date DESC";
}
$news_result = mysqli_query($conn, $query);

// Fetch events
$event_query = "SELECT * FROM events ORDER BY event_date DESC";
$events_result = mysqli_query($conn, $event_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Post News and Events</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #e0f7fa, #00796b);
            margin: 0;
            padding: 0;
            display: flex;
        }
        .sidebar {
            width: 250px;
            background: #004d40;
            color: white;
            padding: 20px;
            height: 100vh;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.2);
        }
        .sidebar h2 {
            color: #e0f7fa;
            text-align: center;
        }
        .sidebar ul {
            list-style: none;
            padding: 0;
        }
        .sidebar ul li {
            margin: 20px 0;
        }
        .sidebar ul li a {
            color: #e0f7fa;
            text-decoration: none;
            font-size: 18px;
            display: block;
            padding: 10px;
        }
        .sidebar ul li a:hover {
            background: #00796b;
            border-radius: 5px;
        }
        .main-content {
            flex: 1;
            padding: 20px;
        }
        .dashboard-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            margin-left: 270px; /* Leave space for the sidebar */
        }
        .dashboard-container h1 {
            color: #00796b;
            margin-bottom: 20px;
            text-align: center;
        }
        .dashboard-container form {
            margin-bottom: 20px;
        }
        .dashboard-container label {
            display: block;
            margin: 10px 0 5px;
            color: #00796b;
        }
        .dashboard-container input[type="text"],
        .dashboard-container textarea,
        .dashboard-container input[type="search"],
        .dashboard-container input[type="date"],
        .dashboard-container input[type="email"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 15px;
        }
        .dashboard-container input[type="file"] {
            margin-bottom: 15px;
        }
        .dashboard-container button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background: linear-gradient(to right, #004d40, #00796b);
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
        }
        .dashboard-container button:hover {
            background: linear-gradient(to right, #00796b, #004d40);
        }
        .dashboard-container .message {
            margin-bottom: 15px;
            color: #004d40;
        }
        .dashboard-container .news-item,
        .dashboard-container .event-item {
            padding: 10px;
            margin-bottom: 10px;
            border-bottom: 1px solid #ccc;
            color: #00796b;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .dashboard-container .news-item img,
        .dashboard-container .event-item img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 10px;
        }
        .dashboard-container .news-item button,
        .dashboard-container .event-item button {
            background: #00796b;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 5px 10px;
            cursor: pointer;
        }
        .dashboard-container .news-item button:hover,
        .dashboard-container .event-item button:hover {
            background: #004d40;
        }
        .dashboard-container .content {
            display: none;
        }
        .dashboard-container .toggle-content {
            cursor: pointer;
            color: #00796b;
            border: none;
            background: none;
            text-decoration: underline;
        }
        .toggle-section {
            display: none;
        }
        .toggle-section.active {
            display: block;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Admin Dashboard</h2>
        <ul>
            <li><a href="#" onclick="showSection('news-section')">Post News</a></li>
            <li><a href="#" onclick="showSection('events-section')">Post Events</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
    <div class="main-content">
        <div class="dashboard-container">

            <!-- News Section -->
            <div id="news-section" class="toggle-section active">
                <h1>Post News</h1>
                <?php if (isset($message)): ?>
                    <div class="message"><?php echo $message; ?></div>
                <?php endif; ?>
                <form method="POST" action="admin_dashboard.php" enctype="multipart/form-data">
                    <label for="title">Title:</label>
                    <input type="text" name="title" id="title" required>

                    <label for="content">Content:</label>
                    <textarea name="content" id="content" rows="5" required></textarea>

                    <label for="image">Upload Image:</label>
                    <input type="file" name="image" id="image" required>

                    <button type="submit">Post News</button>
                </form>

                <h1>Search News</h1>
                <form method="POST" action="admin_dashboard.php">
                    <input type="search" name="search_query" placeholder="Search by title..." value="<?php echo htmlspecialchars($search_query); ?>">
                    <button type="submit" name="search">Search</button>
                </form>

                <h1>News List</h1>
                <?php while ($row = mysqli_fetch_assoc($news_result)): ?>
                    <div class="news-item">
                        <img src="img/<?php echo $row['image']; ?>" alt="News Image">
                        <div>
                        <h3><?php echo $row['title']; ?></h3>
                        <small>Posted on <?php echo $row['date']; ?> by <?php echo $row['author']; ?></small>
                        <p class="content"><?php echo $row['content']; ?></p>
                        <button class="toggle-content" onclick="toggleContent(this)">Read More</button>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>

        <!-- Events Section -->
        <div id="events-section" class="toggle-section">
            <h1>Post Events</h1>
            <?php if (isset($event_message)): ?>
                <div class="message"><?php echo $event_message; ?></div>
            <?php endif; ?>
            <form method="POST" action="admin_dashboard.php" enctype="multipart/form-data">
                <label for="event_title">Event Title:</label>
                <input type="text" name="event_title" id="event_title" required>

                <label for="event_description">Event Description:</label>
                <textarea name="event_description" id="event_description" rows="5" required></textarea>

                <label for="event_image">Upload Event Image:</label>
                <input type="file" name="event_image" id="event_image" required>

                <label for="event_date">Event Date:</label>
                <input type="date" name="event_date" id="event_date" required>

                <label for="event_location">Event Location:</label>
                <input type="text" name="event_location" id="event_location" required>

                <button type="submit">Post Event</button>
            </form>

            <h1>Events List</h1>
            <?php while ($row = mysqli_fetch_assoc($events_result)): ?>
                <div class="event-item">
                    <img src="img/<?php echo $row['event_image']; ?>" alt="Event Image">
                    <div>
                        <h3><?php echo $row['event_title']; ?></h3>
                        <p><?php echo $row['event_description']; ?></p>
                        <small>Scheduled for <?php echo $row['event_date']; ?> at <?php echo $row['event_location']; ?></small>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>

    </div>
</div>

<script>
    function toggleContent(button) {
        const content = button.previousElementSibling;
        if (content.style.display === 'none' || content.style.display === '') {
            content.style.display = 'block';
            button.textContent = 'Read Less';
        } else {
            content.style.display = 'none';
            button.textContent = 'Read More';
        }
    }

    function showSection(sectionId) {
        document.querySelectorAll('.toggle-section').forEach(section => {
            section.classList.remove('active');
        });
        document.getElementById(sectionId).classList.add('active');
    }
</script>
