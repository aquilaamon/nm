<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News Portal</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="MINE.CSS">
    <link rel="stylesheet" href="webstyle.css">
    <style>
    
    </style>
</head>
<body>

    <!--HERE GOES THE NASHA HEADER-->
    <div id="header"></div>

   <main>
   <div id="newsContainer">

   <div class="title">
            <h1>Nasha News</h1>
        </div>
        <div class="News_Press">
            <div class="title">Latest News</div>
            <div class="arrows">
                <i class="fas fa-arrow-circle-left" id="prev"></i>
                <i class="fas fa-arrow-circle-right" id="next"></i>
            </div>
        </div>

        <div class="news-section">
            <?php
            include 'db.php';

            // Fetch news articles from the database
            $query = "SELECT * FROM news ORDER BY date DESC";
            $result = mysqli_query($conn, $query);

            // Display each news article
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<section>';
                echo '<div class="card" onclick="openModal(' . htmlspecialchars(json_encode($row)) . ')">';
                echo '<img src="img/' . htmlspecialchars($row['image']) . '" alt="News Image">';
                echo '<div class="card-content">';
                echo '<div class="card-title">' . htmlspecialchars($row['title']) . '</div>';
                echo '<div class="card-meta"><span>' . htmlspecialchars($row['date']) . '</span><span>By ' . htmlspecialchars($row['author']) . '</span></div>';
                echo '<div class="card-description">' . htmlspecialchars($row['content']) . '</div>';
                echo '</div>';
                echo '</div>';
                echo '</section>';
            }

            // Close database connection
            mysqli_close($conn);
            ?>
        </div>

        <button id="loadMore" onclick="loadOldNews()">More</button>
    </div>

    <!-- Modal -->
    <div id="newsModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <div id="modalTitle"></div>
            <div id="modalMeta"></div>
            <div id="modalImage"></div>
            <div id="modalDescription"></div>
            <div class="share-buttons">
                <button class="facebook">Share on Facebook</button>
                <button class="twitter">Share on Twitter</button>
                <button class="whatsapp">Share on WhatsApp</button>
            </div>
        </div>
    </div>

   </main>
    

    <script>
        // Function to open the modal with news details
    function openModal(newsData) {
    document.getElementById('modalTitle').innerText = newsData.title;
    document.getElementById('modalMeta').innerText = newsData.date + ' | By ' + newsData.author;
    document.getElementById('modalImage').innerHTML = '<img src="img/' + newsData.image + '" alt="News Image">';
    document.getElementById('modalDescription').innerText = newsData.content;
    document.getElementById('newsModal').style.display = "block";
}

    // Function to close the modal
    function closeModal() {
        document.getElementById('newsModal').style.display = "none";
}

    </script>

    <script src="scripts.js"></script>
    <div id="footer"></div>
    <script src="common.js"></script>
</body>
</html>
