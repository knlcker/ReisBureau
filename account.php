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
    $date_plus_one_day = date('Y-m-d+1');
    ?>
</head>

<body>
    <header class="header-account">
        <div>
            <img class="bookly-image" src="Images/Bookly.png" alt="Bookly-image">
        </div>
    </header>
    <main>
        <div class="account-menu-contents">
            <div class="account-menu">
                <a href="index.php"><i class="fa-regular fa-circle-left" style="color: #000000;"></i>Terug</a>
                <div class="account-menu-profile-options">
                    <div class="account-profile-picture-and-name">
                        <i class="fa-regular fa-circle-user" style="color: #000000;"></i>
                        <div class="account-profile-name">
                            <?php echo $_SESSION['user_firstname'] . " " . $_SESSION['user_lastname']; ?>
                        </div>
                    </div>
                    <div class="account-menu-options">
                        <div id="account-menu-account-informatie" onclick="activeAccountInformatie()">Account Informatie</div>
                        <div id="account-menu-mijn-boekingen" onclick="activeMijnBoekingen()">Mijn Boekingen</div>
                        <?php
                        if ($_SESSION['user_admin_rights'] == true) {
                            echo '<div id="account-menu-admin-panel" onclick="activeAdminPanel()">Admin Panel</div>';
                        };
                        if ($_SESSION['user_admin_rights'] == true) {
                            echo '<div id="account-menu-owner-panel" onclick="activeOwnerPanel()">Owner Panel</div>';
                        };
                        if ($_SESSION['user_admin_rights'] == true) {
                            echo '<div id="account-menu-berichten" onclick="activeBerichten()">Berichten</div>';
                        };

                        $accountCurrentOption = "Account Informatie";
                        ?>
                    </div>
                </div>
            </div>
            <div class="account-contents">
                <div class="account-content-name-and-logout">
                    <div class="account-content-name">
                        <?php echo $accountCurrentOption; ?>
                    </div>
                    <a href="logout.php" class="account-logout-button">Uitloggen<i class="fa-solid fa-arrow-right-from-bracket" style="color: #EEEFEF;"></i></a>
                </div>
                <div class="account-content-container">
                    <div id="account-content-account-information">
                        <div class="account-content-account-information-component-container">
                            <div class="account-content-account-information-component">
                                <div class="account-content-account-information-component-title-description">
                                    <div class="account-content-account-information-component-title">Naam</div>
                                    <div class="account-content-account-information-component-description"><?php echo $_SESSION['user_firstname'] . " " . $_SESSION['user_lastname']; ?></div>
                                </div>
                                <div class="account-content-account-information-component-icon">
                                    <i class="fa-regular fa-circle-user" style="color: #000000;"></i>
                                </div>
                            </div>
                            <div class="account-content-account-information-component">
                                <div class="account-content-account-information-component-title-description">
                                    <div class="account-content-account-information-component-title">E-Mail</div>
                                    <div class="account-content-account-information-component-description"><?php echo $_SESSION['user_email']; ?></div>
                                </div>
                                <div class="account-content-account-information-component-icon">
                                    <i class="fa-regular fa-circle-user" style="color: #000000;"></i>
                                </div>
                            </div>
                            <div class="account-content-account-information-component">
                                <div class="account-content-account-information-component-title-description">
                                    <div class="account-content-account-information-component-title">Land</div>
                                    <div class="account-content-account-information-component-description"><?php echo $_SESSION['user_country']; ?></div>
                                </div>
                                <div class="account-content-account-information-component-icon">
                                    <i class="fa-regular fa-circle-user" style="color: #000000;"></i>
                                </div>
                            </div>
                            <div class="account-content-account-information-component">
                                <div class="account-content-account-information-component-title-description">
                                    <div class="account-content-account-information-component-title">Geboortedatum</div>
                                    <div class="account-content-account-information-component-description"><?php echo $_SESSION['user_date']; ?></div>
                                </div>
                                <div class="account-content-account-information-component-icon">
                                    <i class="fa-regular fa-circle-user" style="color: #000000;"></i>
                                </div>
                            </div>
                        </div>
                        <div class="account-content-account-information-change-container">
                            <div class="account-content-account-information-change-button">
                                Wijzig Gegevens
                            </div>
                        </div>
                    </div>
                    <div id="account-content-mijn-boekingen">

                        <div class="account-content-mijn-boekingen-content-container">
                            <div id="account-content-mijn-boekingen-content-container-alle-boekingen">
                                <?php
                                $mijnGeboekteReizen = $connectie->prepare("SELECT boeking_id, boeking_reis_start, boeking_reis_end, boeking_aantal_personen, boeking_price, reis_review_beoordeling, reis_location_country, reis_location_city, reis_title, reis_description, user_firstname, user_lastname 
                                    FROM boekingen 
                                    INNER JOIN users 
                                    ON boekingen.user_id = users.user_id 
                                    INNER JOIN reizen 
                                    ON boekingen.reis_id = reizen.reis_id
                                    WHERE boekingen.user_id = ? ORDER BY boeking_reis_start ASC");
                                $mijnGeboekteReizen->execute([$_SESSION['user_id']]);

                                if ($mijnGeboekteReizen->rowCount() == 0) {
                                    echo "Je hebt geen reizen geboekt!";
                                } else {
                                    while ($mijnReisItem = $mijnGeboekteReizen->fetch()) {
                                        echo '
                                            <div class="admin-panel-geboekte-reis-item">
                                                <div class="admin-panel-geboekte-reis-info-locatie">
                                                    <div class="admin-panel-geboekte-reis-info-locatie-plaats">' . $mijnReisItem['reis_location_country'] . ", " . $mijnReisItem['reis_location_city'] . '</div>
                                                    <div class="admin-panel-geboekte-reis-info-locatie-overnachting">' . $mijnReisItem['reis_title'] . '</div>
                                                </div>
                                                <div class="geboekte-reis-detailts-and-cancel">
                                                    <div class="admin-panel-geboekte-reis-info-datum-container">
                                                        <div class="admin-panel-geboekte-reis-info-datum">
                                                            <div>Aankomst:</div>
                                                            <div class="admin-panel-geboekte-reis-info">' . $mijnReisItem['boeking_reis_start'] . '</div>
                                                        </div>
                                                        <div class="admin-panel-geboekte-reis-info-datum">
                                                            <div>Vertrek:</div>
                                                            <div class="admin-panel-geboekte-reis-info">' . $mijnReisItem['boeking_reis_end'] . '</div>
                                                        </div>
                                                    </div>
                                                    <div class="admin-panel-geboekte-reis-info-prijs">
                                                        <div>
                                                            <div>Aantal Personen:</div>
                                                            <div class="admin-panel-geboekte-reis-info">' . $mijnReisItem['boeking_aantal_personen'] . '</div>
                                                        </div>
                                                        <div>
                                                            <div>Prijs:</div>
                                                            <div class="admin-panel-geboekte-reis-info">€' . $mijnReisItem['boeking_price'] . '</div>
                                                        </div>
                                                    </div>                                                        
                                                    <div class="admin-panel-geboekte-reis-annuleren-container">
                                                        <form action="reis-annuleren.php" method="POST">
                                                            <input type="hidden" name="geboekte_reis_to_delete" value="' . $mijnReisItem['boeking_id'] . '"></input>
                                                            <button type="hidden" class="admin-panel-geboekte-reis-annuleren-button">Annuleren</button>
                                                        </form>';
                                                        if($date < $mijnReisItem['boeking_reis_end'] && $mijnReisItem['reis_review_beoordeling'] == null){
                                                            echo'
                                                            <form action="recensie.php" method="POST">
                                                                <input type="hidden" name="geboekte_reis_to_review" value="' . $mijnReisItem['boeking_id'] . '"></input>
                                                                <button type="hidden" class="admin-panel-geboekte-reis-review-button">Beoordelen</button>
                                                            </form>
                                                            
                                                            ';
                                                        } echo '
                                                    </div>
                                                </div>
                                            </div>';
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div id="account-content-admin-panel">
                        <div class="account-content-admin-panel-options">
                            <div class="account-content-admin-panel-options-button" id="account-content-admin-panel-options-button-reizen" onclick="adminPanelAlleReizen()">
                                Alle Reizen
                            </div>
                            <div class="account-content-admin-panel-options-button" id="account-content-admin-panel-options-button-geboekte-reizen" onclick="adminPanelGeboekteReizen()">
                                Geboekte Reizen
                            </div>
                            <div class="account-content-admin-panel-options-button" id="account-content-admin-panel-options-button-locaties-beheren" onclick="adminPanelLocatiesBeheren()">
                                Locaties Beheren
                            </div>
                            <a href="reis-aanmaken-editen.php" class="account-content-admin-panel-options-button" id="account-content-admin-panel-options-button-reis-aanmaken">
                                Reis Aanmaken
                            </a>
                        </div>
                        <div class="account-content-admin-panel-search">
                            <div class="account-content-admin-panel-search-location"></div>
                        </div>
                        <div class="account-content-admin-panel-content-container">
                            <div id="account-content-admin-panel-content-container-alle-reizen">
                                <?php
                                $AlleReizen = $connectie->prepare("SELECT * FROM reizen WHERE reis_status = 'OPEN' ORDER BY reis_gemiddelde_review DESC");
                                $AlleReizen->execute([]);

                                if ($AlleReizen->rowCount() == 0) {
                                    echo "Er zijn geen reizen gevonden!";
                                } else {
                                    while ($item = $AlleReizen->fetch()) {
                                        echo '
                                        <div class="admin-panel-reis-item">
                                            <div class="admin-panel-reis-item-reis-container-picture-location">
                                                <div class="admin-panel-reis-item-picture">
                                                    <img class="account-reis-main-images" src="reis-main-images/' . $item['reis_main_photo']  . '" alt="reis-image">
                                                </div>
                                                <div class="admin-panel-reis-item-location">
                                                    <div class="admin-panel-reis-item-location-country">' . $item['reis_location_country'] . '</div>
                                                    <div class="admin-panel-reis-item-location-city">' . $item['reis_location_city'] . '</div>
                                                </div>
                                            </div>
                                            <div class="admin-panel-reis-item-reis-container-details-edit">
                                                <div class="admin-panel-reis-item-price-and-reviews">
                                                    <div class="admin-panel-reis-item-price">
                                                        <div class="admin-panel-reis-item-price-title">P/P/N</div>
                                                        <div class="admin-panel-reis-item-price-per-night">' . $item['reis_price'] . '</div>
                                                    </div>
                                                    <div class="admin-panel-reis-item-reviews">
                                                        <div class="admin-panel-reis-item-reviews-aantal">' . $item['reis_aantal_reviews'] . ' Reviews</div>
                                                        <div class="admin-panel-reis-item-reviews-gemiddelde">' . $item['reis_gemiddelde_review'] . ' / 10</div>
                                                    </div>
                                                </div>
                                                <div class="admin-panel-reis-item-reis-container-edit-delete">
                                                    <div class="admin-panel-reis-item-icon"><i class="fa-solid fa-pen-to-square" style="color: #000000;"></i></div>
                                                    <form action="reis-delete.php" method="POST">
                                                        <input type="hidden" name="reis_id_to_delete" value="' . $item['reis_id'] . '" ></input>
                                                        <button type="submit" class="delete-button">
                                                            <i class="fa-solid fa-trash clickable" style="color: #000000;"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>';
                                    }
                                }
                                ?>

                            </div>

                            <div id="account-content-admin-panel-content-container-geboekte-reizen">
                            <?php
                                $geboekteReizen = $connectie->prepare("SELECT boeking_id, boeking_reis_start, boeking_reis_end, boeking_aantal_personen, boeking_price, reis_review_beoordeling, reis_location_country, reis_location_city, reis_title, reis_description, user_firstname, user_lastname 
                                    FROM boekingen 
                                    INNER JOIN users 
                                    ON boekingen.user_id = users.user_id 
                                    INNER JOIN reizen 
                                    ON boekingen.reis_id = reizen.reis_id
                                    ORDER BY boeking_reis_start ASC");
                                $geboekteReizen->execute([]);

                                if ($geboekteReizen->rowCount() == 0) {
                                    echo "Er zijn geen reizen geboekt!";
                                } else {
                                    while ($geboekteReisItem = $geboekteReizen->fetch()) {
                                        echo '
                                            <div class="admin-panel-geboekte-reis-item">
                                                <div class="admin-panel-geboekte-reis-info-locatie-naam">
                                                    <div class="admin-panel-geboekte-reis-info-locatie">
                                                        <div class="admin-panel-geboekte-reis-info-locatie-plaats">' . $geboekteReisItem['user_firstname'] . " " . $geboekteReisItem['user_lastname'] . '</div>
                                                    </div>
                                                    <div class="admin-panel-geboekte-reis-info-locatie">
                                                        <div class="admin-panel-geboekte-reis-info-locatie-plaats">' . $geboekteReisItem['reis_location_country'] . ", " . $geboekteReisItem['reis_location_city'] . '</div>
                                                        <div class="admin-panel-geboekte-reis-info-locatie-overnachting">' . $geboekteReisItem['reis_title'] . '</div>
                                                    </div>
                                                </div>
                                                <div class="geboekte-reis-detailts-and-cancel">
                                                    <div class="admin-panel-geboekte-reis-info-datum-container">
                                                        <div class="admin-panel-geboekte-reis-info-datum">
                                                            <div>Aankomst:</div>
                                                            <div class="admin-panel-geboekte-reis-info">' . $geboekteReisItem['boeking_reis_start'] . '</div>
                                                        </div>
                                                        <div class="admin-panel-geboekte-reis-info-datum">
                                                            <div>Vertrek:</div>
                                                            <div class="admin-panel-geboekte-reis-info">' . $geboekteReisItem['boeking_reis_end'] . '</div>
                                                        </div>
                                                    </div>
                                                    <div class="admin-panel-geboekte-reis-info-prijs">
                                                        <div>
                                                            <div>Aantal Personen:</div>
                                                            <div class="admin-panel-geboekte-reis-info">' . $geboekteReisItem['boeking_aantal_personen'] . '</div>
                                                        </div>
                                                        <div>
                                                            <div>Prijs:</div>
                                                            <div class="admin-panel-geboekte-reis-info">€' . $geboekteReisItem['boeking_price'] . '</div>
                                                        </div>
                                                    </div>                                                        
                                                    <div class="admin-panel-geboekte-reis-annuleren-container">
                                                        <form action="reis-annuleren.php" method="POST">
                                                            <input type="hidden" name="geboekte_reis_to_delete" value="' . $geboekteReisItem['boeking_id'] . '"></input>
                                                            <button type="hidden" class="admin-panel-geboekte-reis-annuleren-button">Annuleren</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>';
                                    }
                                }
                                ?>
                            </div>
                            <div id="account-content-admin-panel-content-container-locaties-beheren">
                                <div class="locaties-beheren-container">
                                    <div class="locaties-beheren-buttons">
                                        <div class="locaties-beheren-button">Toevoegen</div>
                                        <div class="locaties-beheren-button">Verwijderen</div>
                                    </div>
                                    <div id="locatie-toevoegen">
                                        <form class="form-land-toevoegen">
                                            <label for="new-country">Nieuw Land</label><br>
                                            <input type="text" name="new-country">
                                            <button class="locaties-beheren-submit-button" type="submit">Toevoegen</button>
                                        </form>
                                    </div>
                                    <div id="locatie-verwijderen"></div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div id="account-content-owner-panel">
                            
                    </div>
                    
                    <div id="account-content-berichten-container">
                        <div class="account-content-berichten-panel-options">
                            <div class="account-content-admin-panel-options-button" id="account-content-WW-panel-options-button-vergeten" onclick="berichtenWwVergeten()">
                                WW vergeten
                            </div>
                            <div class="account-content-admin-panel-options-button" id="account-content-berichten-panel-options-button-normale" onclick="berichten()">
                                 Berichten
                            </div>
                            <div class="account-content-admin-panel-options-button" id="account-content-berichten-panel-options-button-berichten" onclick="berichtenReviews()">
                                Reviews
                            </div>
                        </div>
                            
                    
                            <div id="account-content-berichten-WW-vergeten">
                                <?php
                                    $BerichtWV = $connectie->prepare("SELECT * FROM wachtwoord_vergeten");
                                    $BerichtWV->execute([]);

                                
                                
                                        while ($item = $BerichtWV->fetch()) {
                                            echo '
                                                <div class="wachtwoord-vergeten-berichten-id">' . $item['bericht_id'] . '.' . $item['bericht'] . '.</div>
                                                
                                            ';
                                        }
                                
                                ?>
                            </div>

                            <div id="account-content-berichten">
                                <?php
                                    $Bericht = $connectie->prepare("SELECT * FROM berichten");
                                    $Bericht->execute([]);

                                
                                
                                        while ($item = $Bericht->fetch()) {
                                            echo '
                                                <div class="wachtwoord-vergeten-berichten-id">' . $item['bericht_id'] . '.' . $item['bericht'] . '</div>

                                            ';
                                        }
                                
                                ?>
                                </div>

                                <div id="account-content-reviews">
                                        <?php
                                            $Reviews = $connectie->prepare("SELECT * FROM boekingen");
                                            $Reviews->execute([]);
                                
                                        
                                            while ($item = $Reviews->fetch()) {
                                                echo '
                                                    <div class="reviews-container-admin-panel">
                                                        <div class="wachtwoord-vergeten-berichten-id">' . $item['reis_id'] . '.' . $item['reis_review_beoordeling'] . '.' . $item['reis_review_bericht'] . '</div>
                                                    </div>
                                                ';
                                            }
                                
                                    ?> 
                                
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <script>
        function activeAccountInformatie() {
            document.getElementById("account-menu-account-informatie").style.color = "#4987FF";
            document.getElementById("account-content-account-information").style.display = "flex";
            document.getElementById("account-menu-mijn-boekingen").style.color = "#6F6F6F";
            document.getElementById("account-content-mijn-boekingen").style.display = "none";
            document.getElementById("account-menu-admin-panel").style.color = "#6F6F6F";
            document.getElementById("account-content-admin-panel").style.display = "none";
            document.getElementById("account-menu-owner-panel").style.color = "#6F6F6F";
            document.getElementById("account-content-owner-panel").style.display = "none";
            document.getElementById("account-menu-berichten").style.color = "#6F6F6F";
            document.getElementById("account-content-berichten-container").style.display = "none";
            <?php $accountCurrentOption = "Account Informatie"; ?>
        };

        function activeMijnBoekingen() {
            document.getElementById("account-menu-account-informatie").style.color = "#6F6F6F";
            document.getElementById("account-content-account-information").style.display = "none";
            document.getElementById("account-menu-mijn-boekingen").style.color = "#4987FF";
            document.getElementById("account-content-mijn-boekingen").style.display = "flex";
            document.getElementById("account-menu-admin-panel").style.color = "#6F6F6F";
            document.getElementById("account-content-admin-panel").style.display = "none";
            document.getElementById("account-menu-owner-panel").style.color = "#6F6F6F";
            document.getElementById("account-content-owner-panel").style.display = "none";
            document.getElementById("account-menu-berichten").style.color = "#6F6F6F";
            document.getElementById("account-content-berichten-container").style.display = "none";
            <?php $accountCurrentOption = "Mijn Boekingen"; ?>
        };

        function activeAdminPanel() {
            document.getElementById("account-menu-account-informatie").style.color = "#6F6F6F";
            document.getElementById("account-content-account-information").style.display = "none";
            document.getElementById("account-menu-mijn-boekingen").style.color = "#6F6F6F";
            document.getElementById("account-content-mijn-boekingen").style.display = "none";
            document.getElementById("account-menu-admin-panel").style.color = "#4987FF";
            document.getElementById("account-content-admin-panel").style.display = "flex";
            document.getElementById("account-menu-owner-panel").style.color = "#6F6F6F";
            document.getElementById("account-content-owner-panel").style.display = "none";
            document.getElementById("account-menu-berichten").style.color = "#6F6F6F";
            document.getElementById("account-content-berichten-container").style.display = "none";
            <?php $accountCurrentOption = "Admin Panel"; ?>
        };

        function adminPanelAlleReizen() {
            document.getElementById("account-content-admin-panel-content-container-alle-reizen").style.display = "flex";
            document.getElementById("account-content-admin-panel-content-container-geboekte-reizen").style.display = "none";
            document.getElementById("account-content-admin-panel-content-container-locaties-beheren").style.display = "none";
        }

        function adminPanelGeboekteReizen() {
            document.getElementById("account-content-admin-panel-content-container-alle-reizen").style.display = "none";
            document.getElementById("account-content-admin-panel-content-container-geboekte-reizen").style.display = "flex";
            document.getElementById("account-content-admin-panel-content-container-locaties-beheren").style.display = "none";
        }

        function adminPanelLocatiesBeheren() {
            document.getElementById("account-content-admin-panel-content-container-alle-reizen").style.display = "none";
            document.getElementById("account-content-admin-panel-content-container-geboekte-reizen").style.display = "none";
            document.getElementById("account-content-admin-panel-content-container-locaties-beheren").style.display = "flex";
        }

        function berichtenReviews() {
            document.getElementById("account-content-berichten-WW-vergeten").style.display = "none";
            document.getElementById("account-content-berichten").style.display = "none";
            document.getElementById("account-content-reviews").style.display = "flex";
        }
        function berichtenWwVergeten() {
            document.getElementById("account-content-berichten-WW-vergeten").style.display = "flex";
            document.getElementById("account-content-berichten").style.display = "none";
            document.getElementById("account-content-reviews").style.display = "none";
        }
        function berichten() {
            document.getElementById("account-content-berichten-WW-vergeten").style.display = "none";
            document.getElementById("account-content-berichten").style.display = "flex";
            document.getElementById("account-content-reviews").style.display = "none";
        }

        function activeOwnerPanel() {
            document.getElementById("account-menu-account-informatie").style.color = "#6F6F6F";
            document.getElementById("account-content-account-information").style.display = "none";
            document.getElementById("account-menu-mijn-boekingen").style.color = "#6F6F6F";
            document.getElementById("account-content-mijn-boekingen").style.display = "none";
            document.getElementById("account-menu-admin-panel").style.color = "#6F6F6F";
            document.getElementById("account-content-admin-panel").style.display = "none";
            document.getElementById("account-menu-owner-panel").style.color = "#4987FF";
            document.getElementById("account-content-owner-panel").style.display = "flex";
            document.getElementById("account-menu-berichten").style.color = "#6F6F6F";
            document.getElementById("account-content-berichten-container").style.display = "none";
            <?php $accountCurrentOption = "Owner Panel"; ?>
        };

        function activeBerichten() {
            document.getElementById("account-menu-account-informatie").style.color = "#6F6F6F";
            document.getElementById("account-content-account-information").style.display = "none";
            document.getElementById("account-menu-mijn-boekingen").style.color = "#6F6F6F";
            document.getElementById("account-content-mijn-boekingen").style.display = "none";
            document.getElementById("account-menu-admin-panel").style.color = "#6F6F6F";
            document.getElementById("account-content-admin-panel").style.display = "none";
            document.getElementById("account-menu-owner-panel").style.color = "#6F6F6F";
            document.getElementById("account-content-owner-panel").style.display = "none";
            document.getElementById("account-menu-berichten").style.color = "#4987FF";
            document.getElementById("account-content-berichten-container").style.display = "flex";
            <?php $accountCurrentOption = "Berichten"; ?>
        };
    </script>
</body>

</html>