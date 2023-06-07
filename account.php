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
                            <?php echo $_SESSION['user_firstname'] . " " . $_SESSION['user_lastname'];?>
                        </div>
                    </div>
                    <div class="account-menu-options">
                        <div id="account-menu-account-informatie" onclick="activeAccountInformatie()">Account Informatie</div>
                        <div id="account-menu-mijn-boekingen" onclick="activeMijnBoekingen()">Mijn Boekingen</div>
                        <?php 
                        if($_SESSION['user_admin_rights'] == true){
                            echo '<div id="account-menu-admin-panel" onclick="activeAdminPanel()">Admin Panel</div>';
                        };
                        if($_SESSION['user_admin_rights'] == true){
                            echo '<div id="account-menu-owner-panel" onclick="activeOwnerPanel()">Owner Panel</div>';
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
                                    <div class="account-content-account-information-component-description"><?php echo $_SESSION['user_firstname'] . " " . $_SESSION['user_lastname'];?></div>
                                </div>
                                <div class="account-content-account-information-component-icon">
                                    <i class="fa-regular fa-circle-user" style="color: #000000;"></i>
                                </div>
                            </div>
                            <div class="account-content-account-information-component">
                                <div class="account-content-account-information-component-title-description">
                                    <div class="account-content-account-information-component-title">E-Mail</div>
                                    <div class="account-content-account-information-component-description"><?php echo $_SESSION['user_email'];?></div>
                                </div>
                                <div class="account-content-account-information-component-icon">
                                    <i class="fa-regular fa-circle-user" style="color: #000000;"></i>
                                </div>
                            </div>
                            <div class="account-content-account-information-component">
                                <div class="account-content-account-information-component-title-description">
                                    <div class="account-content-account-information-component-title">Land</div>
                                    <div class="account-content-account-information-component-description"><?php echo $_SESSION['user_country'];?></div>
                                </div>
                                <div class="account-content-account-information-component-icon">
                                    <i class="fa-regular fa-circle-user" style="color: #000000;"></i>
                                </div>
                            </div>
                            <div class="account-content-account-information-component">
                                <div class="account-content-account-information-component-title-description">
                                    <div class="account-content-account-information-component-title">Geboortedatum</div>
                                    <div class="account-content-account-information-component-description"><?php echo $_SESSION['user_date'];?></div>
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

                    </div>
                    <div id="account-content-admin-panel">
                        <div class="account-content-admin-panel-options">
                            <div class ="account-content-admin-panel-options-button" id="account-content-admin-panel-options-button-reis-aanmaken">
                                Reis Aanmaken
                            </div>
                            <div class ="account-content-admin-panel-options-button" id="account-content-admin-panel-options-button-reizen">
                                Alle Reizen
                            </div>
                            <div class ="account-content-admin-panel-options-button" id="account-content-admin-panel-options-button-geboekte-reizen">
                                Geboekte Reizen
                            </div>
                            <div class ="account-content-admin-panel-options-button" id="account-content-admin-panel-options-button-locaties-beheren">
                                Locaties Beheren
                            </div>
                        </div>
                        <div class="account-content-admin-panel-search">
                                <div class="account-content-admin-panel-search-location"></div>
                            </div>
                        <div class="account-content-admin-panel-content-container">
                            <div class="admin-panel-reis-item"></div>
                            <div class="admin-panel-reis-item"></div>
                            <div class="admin-panel-reis-item"></div>
                            <div class="admin-panel-reis-item"></div>

                        </div>
                    </div>
                    <div id="account-content-owner-panel">

                    </div>
                </div>
            </div>
        </div>
       
    </main>

    <script>
        function activeAccountInformatie(){
            document.getElementById("account-menu-account-informatie").style.color = "#4987FF";
            document.getElementById("account-content-account-information").style.display = "flex";
            document.getElementById("account-menu-mijn-boekingen").style.color = "#6F6F6F";
            document.getElementById("account-content-mijn-boekingen").style.display = "none";
            document.getElementById("account-menu-admin-panel").style.color = "#6F6F6F";
            document.getElementById("account-content-admin-panel").style.display = "none";
            document.getElementById("account-menu-owner-panel").style.color = "#6F6F6F";
            document.getElementById("account-content-owner-panel").style.display = "none";
            <?php $accountCurrentOption = "Account Informatie"; ?>
        };

        function activeMijnBoekingen(){
            document.getElementById("account-menu-account-informatie").style.color = "#6F6F6F";
            document.getElementById("account-content-account-information").style.display = "none";
            document.getElementById("account-menu-mijn-boekingen").style.color = "#4987FF";
            document.getElementById("account-content-mijn-boekingen").style.display = "flex";
            document.getElementById("account-menu-admin-panel").style.color = "#6F6F6F";
            document.getElementById("account-content-admin-panel").style.display = "none";
            document.getElementById("account-menu-owner-panel").style.color = "#6F6F6F";
            document.getElementById("account-content-owner-panel").style.display = "none";
            <?php $accountCurrentOption = "Mijn Boekingen"; ?>
        };

        function activeAdminPanel(){
            document.getElementById("account-menu-account-informatie").style.color = "#6F6F6F";
            document.getElementById("account-content-account-information").style.display = "none";
            document.getElementById("account-menu-mijn-boekingen").style.color = "#6F6F6F";
            document.getElementById("account-content-mijn-boekingen").style.display = "none";
            document.getElementById("account-menu-admin-panel").style.color = "#4987FF";
            document.getElementById("account-content-admin-panel").style.display = "flex";
            document.getElementById("account-menu-owner-panel").style.color = "#6F6F6F";
            document.getElementById("account-content-owner-panel").style.display = "none";
            <?php $accountCurrentOption = "Admin Panel"; ?>
        };

        function activeOwnerPanel(){
            document.getElementById("account-menu-account-informatie").style.color = "#6F6F6F";
            document.getElementById("account-content-account-information").style.display = "none";
            document.getElementById("account-menu-mijn-boekingen").style.color = "#6F6F6F";
            document.getElementById("account-content-mijn-boekingen").style.display = "none";
            document.getElementById("account-menu-admin-panel").style.color = "#6F6F6F";
            document.getElementById("account-content-admin-panel").style.display = "none";
            document.getElementById("account-menu-owner-panel").style.color = "#4987FF";
            document.getElementById("account-content-owner-panel").style.display = "flex";
            <?php $accountCurrentOption = "Owner Panel"; ?>
        };

    </script>
</body>
</html>