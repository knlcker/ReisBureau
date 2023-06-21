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

if(isset($_POST['Bericht']) && isset($_SESSION['user_id'])){
    $bericht = $_POST['Bericht'];
    

    $statement = $connectie->prepare("INSERT INTO berichten(user_id, bericht) VALUES(?, ?)");
    $statement->execute([$_SESSION['user_id'], $bericht]);

}

header("Location: index.php")


?>