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
                    <div class="account-profile-picture">
                        <i class="fa-regular fa-circle-user" style="color: #000000;"></i>
                    </div>
                    <div class="account-menu-options">
                        
                    </div>
                </div>
            </div>
            <div class="account-contents"></div>
        </div>
       
    </main>
</body>
</html>