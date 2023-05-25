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

if (isset($_POST['registreren-voornaam']) && isset($_POST['registreren-achternaam']) && isset($_POST['registreren-land']) && isset($_POST['registreren-geboortedatum']) && isset($_POST['registreren-email']) && isset($_POST['registreren-wachtwoord'])){
    $new_voornaam = $_POST['registreren-voornaam'];
    $new_achternaam = $_POST['registreren-achternaam'];
    $new_land = $_POST['registreren-land'];
    $new_geboortedatum = $_POST['registreren-geboortedatum'];
    $new_email = $_POST['registreren-email'];
    $new_wachtwoord = $_POST['registreren-wachtwoord'];

    $statement = $connectie->prepare("INSERT INTO users(user_firstname, user_lastname, user_country, user_date, user_email, user_password, user_admin_rights, user_owner) VALUES(?, ?, ?, ?, ?, ?, ?,?)");
    $statement->execute([$new_voornaam, $new_achternaam, $new_land, $new_geboortedatum, $new_email, $new_wachtwoord, FALSE, FALSE]);

    $_SESSION['naam'] = $new_voornaam;
    //de session

    Header("Location: index.php");
};




Header("Location: Inloggen.php");
?>