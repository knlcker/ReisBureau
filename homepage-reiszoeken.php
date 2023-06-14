<?php 
    session_start();

    function isPresent($waarde) {
        return isset($waarde) && $waarde != "";
    }
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
        $date = date('Y-m-d+1');
    ?>
</head>
<body>
    <header class="header-main">
        <a href="index.php"><img class="bookly-image" src="Images/Bookly.png" alt="Bookly-image"></a>        
        <?php 
            if(isset($_SESSION['user_firstname'])){
                echo '<a href="account.php">' . $_SESSION['user_firstname'] . '</a>';
            } else {
                echo '<a href="Inloggen.php">Inloggen</a>';
            }
        ?>
    </header>
    <main class="main-index">
        <img class="index-image" src="Images/index3.png" alt="Twee stoelen op het strand">
            <div class="reis-search-container">
                <form class="reis-search-container" action="homepage-reiszoeken.php" method="GET">
                    <input class="reis-search" name="search_location" type="search" placeholder="Locatie..." <?php if(isset($_GET['search_location'])){echo 'value="' . $_GET['search_location'] . '"';} ?> ></input>
                    <input class="reis-search" name="search_date_start" type="date" min="<?php echo $date;?>" placeholder="Aankomst" <?php if(isset($_GET['search_date_start'])){echo 'value="' . $_GET['search_date_start'] . '"';} ?>></input>
                    <input class="reis-search" name="search_date_end" type="date" min="<?php echo $date;?>" placeholder="Vertrek" <?php if(isset($_GET['search_date_end'])){echo 'value="' . $_GET['search_date_end'] . '"';} ?>></input>
                </form>
            </div>

        <div class="reis-locaties-container">
            <?php
            if(count($_GET) == 0) {
                $resultSet = $connectie->prepare("SELECT * FROM reizen");
                $resultSet->execute([]);
            } else {

            if(isset($_GET['search_location']) && isPresent($_GET['search_location']) && isPresent($_GET['search_date_start']) && isPresent($_GET['search_date_end'])){
                $search_input = $_GET['search_location'];
                $search_date_start = $_GET['search_date_start'];
                $search_date_end = $_GET['search_date_end'];
                if($search_date_start >= $search_date_end){
                    echo "Vertrek datum kan niet eerder dan of gelijk zijn als aankomst, Pas uw zoekopdracht aan!";
                } else {
                    $resultSet = $connectie->prepare("SELECT * FROM reizen WHERE concat(reis_title, reis_description, reis_location_country, reis_location_city) LIKE ? AND reis_available_start <= ? AND reis_available_end >= ?");
                    $resultSet->execute(["%" . $search_input . "%", $search_date_start, $search_date_end]); 
                }
                
            }
            else if(isPresent($_GET['search_location']) && !isPresent($_GET['search_date_start']) && !isPresent($_GET['search_date_end'])){
                $search_input = $_GET['search_location'];
                $resultSet = $connectie->prepare("SELECT * FROM reizen WHERE concat(reis_title, reis_description, reis_location_country, reis_location_city) LIKE ?");
                $resultSet->execute(["%" . $search_input . "%"]);

            } 
            
            // Geen locatie en enddate, wel start date
            else if(!isPresent($_GET['search_location']) && isPresent($_GET['search_date_start']) && !isPresent($_GET['search_date_end'])){
                $search_date_start = $_GET['search_date_start'];
                $resultSet = $connectie->prepare("SELECT * FROM reizen WHERE reis_available_start <= ?");
                $resultSet->execute([$search_date_start]);

            } else if(!isPresent($_GET['search_location']) && !isPresent($_GET['search_date_start']) && isPresent($_GET['search_date_end'])){
                $search_date_end = $_GET['search_date_end'];
                $resultSet = $connectie->prepare("SELECT * FROM reizen WHERE reis_available_end >= ?");
                $resultSet->execute([$search_date_end]);


            } else if(isPresent($_GET['search_location']) && isPresent($_GET['search_date_start']) && !isPresent($_GET['search_date_end'])){
                $search_input = $_GET['search_location'];
                $search_date_start = $_GET['search_date_start'];
                $resultSet = $connectie->prepare("SELECT * FROM reizen WHERE concat(reis_title, reis_description, reis_location_country, reis_location_city) LIKE ? AND reis_available_start <= ?");
                $resultSet->execute(["%" . $search_input . "%", $search_date_start]);

            } else if(isPresent($_GET['search_location']) && !isPresent($_GET['search_date_start']) && isPresent($_GET['search_date_end'])){
                $search_input = $_GET['search_location'];
                $search_date_end = $_GET['search_date_end'];
                $resultSet = $connectie->prepare("SELECT * FROM reizen WHERE concat(reis_title, reis_description, reis_location_country, reis_location_city) LIKE ? AND reis_available_end >= ?");
                $resultSet->execute(["%" . $search_input . "%", $search_date_end]);

            } else if(!isPresent($_GET['search_location']) && isPresent($_GET['search_date_start']) && isPresent($_GET['search_date_end'])){
                $search_date_start = $_GET['search_date_start'];
                $search_date_end = $_GET['search_date_end'];
                if($search_date_start >= $search_date_end){
                    echo "Vertrek datum kan niet eerder dan of gelijk zijn als aankomst, Pas uw zoekopdracht aan!";
                } else {
                    $resultSet = $connectie->prepare("SELECT * FROM reizen WHERE reis_available_start <= ? AND reis_available_end >= ?");
                    $resultSet->execute([$search_date_start, $search_date_end]);   
                }
                

            } else{
                $resultSet = $connectie->prepare("SELECT * FROM reizen");
                $resultSet->execute([]);
            }
        }

            if(isset($resultSet)){
                if($resultSet->rowCount() == 0){
                    echo "Er zijn geen reizen gevonden met deze zoekresultaten!";
                } else{
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
                                    <div class="reviews-container">
                                        <div class="reviews">' . $item['reis_gemiddelde_review'] .'/10</div>
                                        <div class="reviews">' . $item['reis_aantal_reviews'] .'(beoordelingen)</div>
                                    </div>
                                </div>
                                <div class="right-container-reis-homepage">
                                    <div class="price">€ ' . $item['reis_price'] .'</div>
                                </div>
                            </div>

                            <div class="right-container-reis-homepage">
                                <form action="reis-informatie.php" method="GET" class="form-reis-informatie">
                                    <input type="hidden" name="reis_id_info" value="' . $item['reis_id'] . '"></input>
                                    <button type="submit" class="reis-informatie-button">bekijk reis</button>
                                </form>
                                <div class="price">€ ' . $item['reis_price'] .'</div>
                            </div>
                        </div>
                    </div>
                ';
   
                        ';
                }
            }
            }
            ?>
       

    </main>
    <?php 
        include_once("footer.php");
    ?>
</body>
</html>