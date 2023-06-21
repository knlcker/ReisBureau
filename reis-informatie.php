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
        $date_plus_one_day = date('Y-m-d', strtotime("+1 day"));
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
                                <img class="extra-afbeeldingen" id="reis-informatie-extra-afbeelding-links-boven" src="Images/index.png" alt="">
                                <img class="extra-afbeeldingen" id="reis-informatie-extra-afbeelding-rechts-boven" src="Images/indexwinter.png" alt="">
                                <img class="extra-afbeeldingen" id="reis-informatie-extra-afbeelding-links-onder" src="Images/indexextra.png" alt="">
                                <img class="extra-afbeeldingen" id="reis-informatie-extra-afbeelding-rechts-onder" src="Images/index3.png" alt="">
                            </div>
                        </div>
                        <div class="informatie-text-container">
                            <div class="informatie-text">
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
                                <div class="populair-container">Populaire voorzieningen</div>
                                <div><i class="fa-solid fa-snowflake"></i> Airco</div>
                                <div><i class="fa-solid fa-wifi"></i> Gratis wifi</div>
                                <div><i class="fa-solid fa-mug-hot"></i> Ontbijt inbegrepen</div>
                            </div>
                        </div>
                        <div class="reis-boeken-button">
                                <form action="reis-boekingen.php" method="POST" class="form-reis-boeken">
                                    <input type="hidden" name="reis_id_to_book" value="' . $item['reis_id'] . '"></input>
                                    <div class="invulvelden-reis-boeken">
                                    <div>
                                        <label clas="reis-boeken-label" for="aantal-persoonen">Aantal persoonen: </label><br>
                                        <input class="invulveld-reis-boeken" type="number" name="aantal-persoonen" min="1" max="' . $item['reis_max_people'] .'" value="1" required</input>
                                    </div>
                                    <div>
                                        <label clas="reis-boeken-label" for="datum-aankomst">Aankomst datum: </label><br>
                                        <input class="invulveld-reis-boeken" type="date" name="datum-aankomst" min="' . $date . '" max="' . $item['reis_available_end'] . '" value="' . $date .'" required</input>
                                    </div>
                                    <div>
                                        <label clas="reis-boeken-label" for="datum-vertrek">Vertrek datum: </label><br>
                                        <input class="invulveld-reis-boeken" type="date" name="datum-vertrek" min="' . $date_plus_one_day . '" max="' . $item['reis_available_end'] . '" required </input>
                                    </div>
                                        <div clas="reis-boeken-confirm-button-container">
                                        <button type="submit" class="reis-informatie-button">boeken</button>
                                    </div>
                                    </div>
                                    
                                </form>
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