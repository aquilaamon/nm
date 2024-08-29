<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Support Our Work</title>
    <link rel="stylesheet" href="MINE.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        @import url("https://fonts.googleapis.com/css2?family=Rubik:wght@500&display=swap");

        
    </style>
</head>

<body>
<div class="container">

<!--HERE GOES THE NASHA HEADER-->
<div id="header"></div>



<div class="hero">
    <div class="title">
        <h1>Donate</h1>
    </div>
    </div>


<main>
<div class="d-flex flex-row justify-content-center mb-5">
    <div class="mpesa px-4 py-2 mx-2"><span>Mpesa</span></div>
    
</div>

<div class="packages">
    <!-- Bronze Package -->
    <div class="package bronze">
        <div class="package-header">
            <h2>Bronze Support</h2>
            <p>Ksh. 100</p>
        </div>
        <p>Your contribution can make a difference. Join us in providing essential resources to those in need. Every little bit counts.</p>
        <form action="stk_initiate.php" method="post">
            <input type="text" name="amount" value="100" hidden>
            <input type="text" name="phone" placeholder="Mpesa Phone Number" required>
            <button type="submit" name="submit" value="bronze">Donate</button>
        </form>
    </div>

    <!-- Silver Package -->
    <div class="package silver">
        <div class="package-header">
            <h2>Silver Support</h2>
            <p>Ksh. 500</p>
        </div>
        <p>Help us expand our reach and impact more lives. Your support can bring hope and change to communities in need.</p>
        <form action="stk_initiate.php" method="post">
            <input type="text" name="amount" value="500" hidden>
            <input type="text" name="phone" placeholder="Mpesa Phone Number" required>
            <button type="submit" name="submit" value="silver">Donate</button>
        </form>
    </div>

    <!-- Gold Package -->
    <div class="package gold">
        <div class="package-header">
            <h2>Gold Support</h2>
            <p>Ksh. 1000</p>
        </div>
        <p>Become a key partner in our mission. Your generous donation will help sustain vital programs that uplift those in need.</p>
        <form action="stk_initiate.php" method="post">
            <input type="text" name="amount" value="1000" hidden>
            <input type="text" name="phone" placeholder="Mpesa Phone Number" required>
            <button type="submit" name="submit" value="gold">Donate</button>
        </form>
    </div>
</div>
</main>
</div>

        <!--HERE GOES THE NASHA FOOTERS-->
    <div id="footer"></div>
    <script src="common.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
