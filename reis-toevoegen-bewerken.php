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
    $new_locatie_land = $_POST['Locatie-land'];
    $new_locatie_stad = $_POST['Locatie-stad'];
    $new_locatie_overnachting_beschrijving = $_POST['Beschrijving'];
    $new_locatie_prijs = $_POST['Prijs'];
    $new_locatie_start_datum = $_POST['Start-datum'];
    $new_locatie_eind_datum = $_POST['Eind-datum'];
    $new_locatie_beschrijving_reis = $_POST['Beschrijving-reis'];
    $new_locatie_hoofd_afbeelding = $_POST['hoofd-afbeelding'];

    $reis_toevoegen = $connectie->prepare("INSERT into reizen(reis_title, reis_description, reis_location_country, reis_location_city, reis_price, reis_available_start, reis_available_end, reis_main_photo) VALUES(?, ?, ?, ?, ?, ?, ?, ?)");
    $reis_toevoegen->execute([$new_locatie_overnachting_beschrijving, $new_locatie_beschrijving_reis, $new_locatie_land, $new_locatie_stad, $new_locatie_prijs, $new_locatie_start_datum, $new_locatie_eind_datum, $new_locatie_hoofd_afbeelding]);
}



header("Location: account.php")
?>