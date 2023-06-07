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
    <?php
        $dsn = 'mysql:dbname=webapp2;host=127.0.0.1';
        $user = 'root';
        $password = '';

        try {
            $connectie = new PDO($dsn, $user, $password);
        } catch (PDOException $e) {
            echo "Verbinding werkt niet" . $e;
        }
    ?>
</head>
<body>
    <header class="header-main">
        <img class="bookly-image" src="Images/Bookly.png" alt="Bookly-image">
        <?php 
            if(isset($_SESSION['user_firstname'])){
                echo '<a href="account.php">' . $_SESSION['user_firstname'] . '</a>';
            } else echo '<a href="Inloggen.php">Inloggen</a>';
        ?>
    </header>
    <main class="main-index">
        <img class="index-image" src="Images/index3.png" alt="Twee stoelen op het strand">
            <div class="reis-search-container">
                <input class="reis-search" type="search" placeholder="Locatie..."></input>
                <input class="reis-search" type="date" placeholder="Aankomst"></input>
             <input class="reis-search" type="date" placeholder="Vertrek"></input>
            </div>

        <div class="reis-locaties-container">
            <?php

            if(isset($_GET['search'])){
                $search_input = $_GET['search'];
                $resultSet = $connectie->prepare("SELECT * FROM reizen WHERE concat(reis_title, reis_description, reis_location) LIKE ?");
                $resultSet->execute(["%" . $search_input . "%"]);
            } else{
                $resultSet = $connectie->prepare("SELECT * FROM reizen");
                $resultSet->execute([]);
            }
            while ($item = $resultSet->fetch()) {
                echo '
                <div class="reis-container">
                    <div class="left-container-reis-homepage">
                        <div class="reis-img">foto</div>
                    </div>
                
                    <div class="middle-container-reis-homepage">
                        <div class="middle">
                            <div class="location">' . $item['reis_location_country'] . " , " . $item['reis_location_city'].'</div>
                            <div class="accommodation">' . $item['reis_title'] .'</div>
                            <div class="divider"></div>
                            <div class="reviews">' . $item['reis_reviews'] .'</div>
                        </div>
                        <div class="right-container-reis-homepage">
                            <div class="price">€ ' . $item['reis_price'] .'</div>
                        </div>
                    </div>
                    
                
                </div>
                        ';
            }
            ?>
        </div>

       

    </main>
    <?php 
        include_once("footer.php");
    ?>
</body>
</html>