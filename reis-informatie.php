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
        $date = date('Y-m-d');
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

        <div class="reis-locaties-container">
            <?php   
                $current_reis_id = $_GET['reis_id_info'];

                $resultSet = $connectie->prepare("SELECT * FROM reizen WHERE reis_id = ?");
                $resultSet->execute([$current_reis_id]);
            
                while ($item = $resultSet->fetch()) {
                    echo '
                    <div class="reis-informatie-container">
                        <div class="afbeelding-container">
                            <img class="main-afbeelding" src="Images/indexzomer.png" alt=""></img>
                            <div class="extra-afbeeldingen-container">
                                <img class="extra-afbeeldingen" id="reis-informatie-extra-afbeelding-links-boven" src="Images/indexzomer.png" alt="">
                                <img class="extra-afbeeldingen" id="reis-informatie-extra-afbeelding-rechts-boven" src="Images/indexzomer.png" alt="">
                                <img class="extra-afbeeldingen" id="reis-informatie-extra-afbeelding-links-onder" src="Images/indexzomer.png" alt="">
                                <img class="extra-afbeeldingen" id="reis-informatie-extra-afbeelding-rechts-onder" src="Images/indexzomer.png" alt="">
                            </div>
                        </div>
                        <div class="informatie-text-container">
                            <div class="reis-informatie-locatie">' . $item['reis_location_country'] . " , " . $item['reis_location_city'] . '</div>
                            <div class="reis-informatie-title">' . $item['reis_title'] . '</div>
                            <div class="reis-reviews">
                                <i class="fa-regular fa-star"></i>
                                <i class="fa-regular fa-star"></i>
                                <i class="fa-regular fa-star"></i>
                                <i class="fa-regular fa-star"></i>
                                <i class="fa-regular fa-star"></i>
                            </div>
                            <div class="reis-informatie-title">' . $item['reis_gemiddelde_review'] . '/10 - Beoordeeld</div>
                            <div class="reis-voorzieningen">
                                <div>Populaire voorzieningen</div>
                                <div>Airco</div>
                                <div>Gratis wifi</div>
                                <div>Ontbijt inbegrepen</div>
                            </div>
                        </div>
                    </div>
                            ';
                }
            
            ?>
       
       

    </main>
    <?php 
        include_once("footer.php");
    ?>
</body>
</html>