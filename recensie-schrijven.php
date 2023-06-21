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
<header class="header-account">
        <div>
            <img class="bookly-image" src="Images/Bookly.png" alt="Bookly-image">
        </div>
    </header>
    <main class="recensie-main">
        <div class="recensie-container">
            <div class="recensie-terug-container">
                <a href="account.php"><i class="fa-regular fa-circle-left" style="color: #000000;"></i>Terug</a>
            </div>
            <div class="recensie-form-container">
                <form class="recensie-form">
                    <div class="recensie-form-beoordeling">
                        <div>Welk cijfer zou U uw reis geven?</div>
                        <select type="select" value="10" name="reis-review-beoordeling" required>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                        </select>
                    </div>
                    <div class="recensie-form-bericht">
                        <textarea class="recensie-bericht" type="text" name="recensie-bericht" placeholder="Heeft u opmerkingen over uw reis?..."></textarea>
                        <input type="hidden" name="reis_review" value="' . $_POST['geboekte_reis_to_review'] . '"></input>
                    </div>
                </form>
            </div>
        </div>  
    </main>
</body>     
</html>
