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

if (isset($_POST['email-login']) && isset($_POST['password-login'])) {
    $login_email = $_POST['email-login'];
    $login_wachtwoord = $_POST['password-login'];

    $checkIfUserExists = $connectie->prepare("SELECT * FROM users WHERE user_email = ? AND user_password = ?");
    $checkIfUserExists->execute([$login_email, $login_wachtwoord]);

    $account = $checkIfUserExists->fetch();
        if ($account == false) {
            header("Location: Inloggen.php");
        } else {

            $_SESSION['user_id'] = $account['user_id'];
            $_SESSION['user_firstname'] = $account['user_firstname'];
            $_SESSION['user_lastname'] = $account['user_lastname'];
            $_SESSION['user_country'] = $account['user_country'];
            $_SESSION['user_date'] = $account['user_date'];
            $_SESSION['user_email'] = $account['user_email'];
            $_SESSION['user_password'] = $account['user_password'];
            $_SESSION['user_admin_rights'] = $account['user_admin_rights'];
            $_SESSION['user_owner'] = $account['user_owner'];

            header("Location: index.php");
        }
};

if (isset($_POST['registreren-voornaam']) && isset($_POST['registreren-achternaam']) && isset($_POST['registreren-land']) && isset($_POST['registreren-geboortedatum']) && isset($_POST['registreren-email']) && isset($_POST['registreren-wachtwoord'])){
    $new_voornaam = $_POST['registreren-voornaam'];
    $new_achternaam = $_POST['registreren-achternaam'];
    $new_land = $_POST['registreren-land'];
    $new_geboortedatum = $_POST['registreren-geboortedatum'];
    $new_email = $_POST['registreren-email'];
    $new_wachtwoord = $_POST['registreren-wachtwoord'];

    $checkIfUserExists = $connectie->prepare("SELECT * FROM users WHERE user_email = ?");
    $checkIfUserExists->execute([$new_email]);

    $account = $checkIfUserExists->fetch();
        if ($account == true) {
            header("Location: Inloggen.php");
        } else {

            $statement = $connectie->prepare("INSERT INTO users(user_firstname, user_lastname, user_country, user_date, user_email, user_password, user_admin_rights, user_owner) VALUES(?, ?, ?, ?, ?, ?, ?,?)");
            $statement->execute([$new_voornaam, $new_achternaam, $new_land, $new_geboortedatum, $new_email, $new_wachtwoord, FALSE, FALSE]);

            $_SESSION['user_id'] = $account['user_id'];
            $_SESSION['user_firstname'] = $account['user_firstname'];
            $_SESSION['user_lastname'] = $account['user_lastname'];
            $_SESSION['user_country'] = $account['user_country'];
            $_SESSION['user_date'] = $account['user_date'];
            $_SESSION['user_email'] = $account['user_email'];
            $_SESSION['user_password'] = $account['user_password'];
            $_SESSION['user_admin_rights'] = $account['user_admin_rights'];
            $_SESSION['user_owner'] = $account['user_owner'];

            header("Location: index.php");
        }
};
?>