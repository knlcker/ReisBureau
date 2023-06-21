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
    $date_plus_one_day = date('Y-m-d', strtotime("+1 day"));

if(isset($_POST['geboekte_reis_to_delete'])){
    $geboekte_reis_to_close = $_POST['geboekte_reis_to_delete'];

    $statement = $connectie->prepare("DELETE FROM boekingen WHERE boeking_id = ?");
    $statement->execute([$geboekte_reis_to_close]);

}

header("Location: account.php")
?>