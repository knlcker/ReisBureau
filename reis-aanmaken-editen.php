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
        <header class="header-account">
            <div>
                <img class="bookly-image" src="Images/Bookly.png" alt="Bookly-image">
            </div>
        </header>
            <div class="terug">
                <a href="index.php"><i class="fa-regular fa-circle-left" style="color: #000000;"></i>Terug</a>
            </div>
            <div id="reis-aanmaken" class="reis-aanmaken-container">
                <form action="reis-toevoegen-bewerken.php" method="POST" class="reis-aanmaken">
                    <label for="Locatie">Locatie Naam</label><br>
                    <input class="reis-Invulvelden" type="text" name="Locatie" placeholder="Locatie Naam...">
                    <label for="Beschrijving">Overnachting Beschrijving</label><br>
                    <input class="reis-Invulvelden" type="text" name="Beschrijving" placeholder="Overnachting Beschrijving...">
                    <label for="Prijs">Prijs Per Nacht</label><br>
                    <input class="reis-Invulvelden" class="prijs"  type="price" name="Prijs" placeholder="Prijs Per Nacht...">
                    <label for="Start-datum">Start</label><br>
                    <input class="reis-Invulvelden" class="datum-aanmaken" type="date" name="Start-datum">
                    <label for="Eind-datum">Einde</label><br>
                    <input class="reis-Invulvelden" class="datum-aanmaken" type="date" name="Eind-datum">
                    <label for="beschrijving-reis">Beschrijving reis</label><br>
                    <input class="reis-Invulvelden" class="Beschrijving-reis" type="text" name="Beschrijving-reis" placeholder="Beschrijving Reis...">
                    <label for="hoofd-afbeelding">Hoofd Afbeelding</label><br>
                    <input class="files" type="file" name="hoofd-afbeelding" placeholder="Hoofd Afbeelding..." accept="image/png, image/jpeg">
                    <label for="hoofd-afbeelding">Overige Afbeelding</label><br>
                    <input class="files" type="file" name="overige-afbeelding" placeholder="Overige Afbeelding..." accept="image/png, image/jpeg" multiple>
                    <input class="reis-aanmaken-submit" type="submit">
                </form>
            </div>
        </main>
    </body>
    </html>