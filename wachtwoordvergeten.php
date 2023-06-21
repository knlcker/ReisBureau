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

if(isset($_POST['Bericht'])){
    $bericht = $_POST['Bericht'];
    

    $statement = $connectie->prepare("INSERT INTO wachtwoord_vergeten(bericht) VALUES(?)");
    $statement->execute([$bericht]);

}

header("Location: index.php")


?>