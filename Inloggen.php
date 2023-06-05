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
        <div class="inloggen-page-container">
            <div class="inloggen-image-container">
                <img class="inloggen-image" src="Images/inloggen.png" alt="Login-image">
            </div>
            <div class="inloggen-information-container">
                <a href="index.php"><i class="fa-solid fa-arrow-left" style="color: #000000;"></i>Terug</a>
                <div class="inloggen-registreren-container">
                    <div id="inloggen" class="inloggen-container">
                        <img class="bookly-image-inloggen" src="Images/Bookly.png" alt="Bookly-image">
                        <form class="form-inloggen" action="account-inloggen-registratie.php" method="POST">
                            <div class="email-wachtwoord-input">
                                <input class="inloggen-input" type="text" name="email-login" placeholder="E-Mail..." maxlength="50" required></input>
                                <input class="inloggen-input" type="password" name="password-login" placeholder="Wachtwoord..." maxlength="20" required></input>
                            </div>
                            <div class="inloggen-wachtwoord-vergeten">Wachtwoord vergeten?</div>
                            <button class="inloggen-submit" type="submit">Log In</button>
                        </form>
                        <div class="naar-registreren-container">
                            <p>Heb je nog geen account?</p>
                            <div class="naar-registratie">
                                <p>Maak er dan</p> <div class="inloggen-registratie-switch" onclick="switchNaarRegistreren()">hier</div> <p>een aan!</p>
                            </div>
                            
                        </div>
                        
                    </div>
                    <div id="registreren" class="inloggen-container">
                        <img class="bookly-image-inloggen" src="Images/Bookly.png" alt="Bookly-image">
                        <form class="form-registratie" action="account-inloggen-registratie.php" method="POST">
                            <div class="form-registratie-input-container">
                                <div class="form-registratie-compact">
                                    <input class="registratie-voornaam" type="text" name="registreren-voornaam" placeholder="Voornaam..." maxlength="20" required></input>
                                    <input class="registratie-achternaam" type="text" name="registreren-achternaam" placeholder="Achternaam..." maxlength="35" required></input>
                                </div>
                                <div class="form-registratie-compact">
                                    <select class="registratie-land" type="" name="registreren-land" placeholder="Land" required>
                                        <option value="Nederland">Nederland</option>
                                        <option value="Duitsland">Duitsland</option>
                                        <option value="Engeland">Engeland</option>
                                        <option value="Spanje">Spanje</option>
                                        <option value="Amerika">Amerika</option>
                                    </select>
                                    <input class="registratie-geboortedatum" type="date" name="registreren-geboortedatum" placeholder="Geboortedatum" required></input>
                                </div>
                                <input class="inloggen-input" type="email" name="registreren-email" placeholder="E-Mail..." maxlength="35" required></input>
                                <input class="inloggen-input" type="password" name="registreren-wachtwoord" placeholder="Wachtwoord..." maxlength="20" required></input>
                            </div>
                            <button class="inloggen-submit" type="submit" >Maak account!</button>
                        </form>
                        <div class="naar-registreren-container">
                            <p>Heb je al een account?</p>
                            <div class="naar-registratie">
                                <p>Klik dan</p> <div class="inloggen-registratie-switch" onclick="switchNaarInloggen()">hier</div> <p>om in te loggen!</p>
                            </div>
                            
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        function switchNaarRegistreren(){
            document.getElementById("inloggen").style.display = "none";
            document.getElementById("registreren").style.display = "flex";

        };

        function switchNaarInloggen(){
            document.getElementById("inloggen").style.display = "flex";
            document.getElementById("registreren").style.display = "none";
        };
    </script>
</body>
</html>