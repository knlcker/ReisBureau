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

    if(isset($_POST['add_geboekte_reis_to_review'])){
        $reisReviewID = $_POST['add_geboekte_reis_to_review'];
        $reisReviewBeoordeling = $_POST['reis_review_beoordeling'];
        if(isset($_POST['recensie_bericht'])){
            $reisReviewBericht = $_POST['recensie_bericht']; 
    
            $addReview = $connectie->prepare("UPDATE boekingen SET reis_review_beoordeling = ?, reis_review_bericht = ? WHERE boeking_id = ?");
            $addReview->execute([$reisReviewBeoordeling, $reisReviewBericht, $reisReviewID]);
        } else{
            $addReview = $connectie->prepare("UPDATE boekingen SET reis_review_beoordeling = ? WHERE boeking_id = ?");
            $addReview->execute([$reisReviewBeoordeling, $reisReviewID]);
        }
    }

header("Location: account.php")
?>
