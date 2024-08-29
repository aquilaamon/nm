<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events Page</title>
    <link rel="stylesheet" href="MINE.CSS">
    <style>
        
        .event-cards-container {
            display: flex;
            flex-wrap: nowrap;
            overflow-x: auto;
            gap: 20px;
            padding: 20px 0;
            scroll-behavior: smooth;
        }

        .event-card {
            background-color: #f0f0f0;
            border-radius: 10px;
            padding: 20px;
            width: 200px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: left;
        }

        .event-card img {
            width: 100%;
            border-radius: 5px;
        }

        .event-card h3 {
            margin: 15px 0 10px;
            font-size: 18px;
            color: #333;
        }

        .event-card p {
            margin: 0 0 10px;
            font-size: 14px;
            color: #666;
        }

        .search-bar {
            margin-bottom: 30px;
        }

        .search-bar input[type="text"] {
            padding: 10px;
            width: 200px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-right: 5px;
        }

        .search-bar button {
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            background-color: #00796b;
            color: white;
            cursor: pointer;
        }

        .dropdown .dropbtn {
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            background-color: #00796b;
            color: white;
            cursor: pointer;
            margin-bottom: 20px;
        }

        .event-placeholder {
            display: none; /* Hide placeholder initially */
        }

        .create-event {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #00796b;
            color: white;
            border-radius: 5px;
            text-decoration: none;
        }
    </style>
</head>
<body>

    <!--HERE GOES THE NASHA HEADER-->
    <div id="header"></div>

<h1>Events</h1>

<div class="dropdown">
    <button class="dropbtn">Our Events:</button>
    <div class="dropdown-content">
        <a href="#">New Events</a>
        <a href="#">Past Events</a>
        <a href="#">All Events</a>
        <a href="news.html">News</a>
    </div>
</div>

<div class="search-bar">
    <input type="text" id="searchInput" placeholder="Search an event...">
    <button onclick="searchEvent()">🔍</button>
</div>

<div class="event-cards-container">
    <!-- Example event card -->
    <div class="event-card">
        <img src="event_image1.jpg" alt="Event Image">
        <h3>Event Title 1</h3>
        <p>Date: 2024-08-25</p>
        <p>Location: City Hall</p>
    </div>

    <div class="event-card">
        <img src="event_image2.jpg" alt="Event Image">
        <h3>Event Title 2</h3>
        <p>Date: 2024-09-01</p>
        <p>Location: Central Park</p>
    </div>
    <!-- Add more event cards as needed -->
</div>

<div class="event-placeholder">
    <img src="ticket.png" alt="Event Ticket" width="100" height="100">
    <h2>No events scheduled yet</h2>
    <p>We couldn't find any event scheduled at this moment.</p>
    <a href="#" class="create-event">+ Create an Event</a>
</div>

</script>
<!--HERE GOES THE NASHA FOOTERS-->
    <div id="footer"></div>
    <script src="common.js"></script>

</body>
</html>
