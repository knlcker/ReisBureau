<?php 
session_start();

    $dsn = 'mysql:dbname=webapp2;host=127.0.0.1';
    $user = 'root';
    $password = '';

    try {
        $connectie = new PDO($dsn, $user, $password);
    } catch (PDOException $e) {
        echo "Verbinding werkt niet" . $e;
    }

    $date = date('Y-m-d');

if(isset($_POST['Locatie-land']) && isset($_POST['Locatie-stad']) && isset($_POST['Beschrijving']) && isset($_POST['Prijs']) && isset($_POST['Start-datum']) && isset($_POST['Eind-datum']) && isset($_POST['Beschrijving-reis']) && isset($_POST['hoofd-afbeelding'])){
    

}

header("Location: account.php")
?>