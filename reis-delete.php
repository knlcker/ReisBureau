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

if(isset($_POST['reis_id_to_delete'])){
    $reis_id_to_close = $_POST['reis_id_to_delete'];

    $statement = $connectie->prepare("UPDATE reizen SET reis_status = 'CLOSED' WHERE reis_id = ?");
    $statement->execute([$reis_id_to_close]);

}

header("Location: account.php")
?>