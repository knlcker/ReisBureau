<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReisBureau</title>
    <link rel="stylesheet" href="/styles/main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>
<body>
    <header class="header-main">
        <img class="bookly-image" src="Images/Bookly.png" alt="Bookly-image">
        <a href="inloggen.php">Inloggen</a>
    </header>
    <main>
        <img class="index-image" src="Images/index3.png" alt="Twee stoelen op het strand">
        <div class="reis-search-container">
            <input class="reis-search" type="search" placeholder="Bestemming..."></input>
            <input class="reis-search" type="date" placeholder="Aankomst"></input>
            <input class="reis-search" type="date" placeholder="Vertrek"></input>
        </div>
    </main>
    <footer>
        
    </footer>
</body>
</html>