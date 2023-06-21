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

if(isset($_POST['reis_review'])){
    $reisReview = $_POST['reis_review'];
    $reisReviewBeoordeling = $_POST['reis-review-beoordeling'];
    if(isset($_POST['recensie-bericht'])){
        $reisReviewBericht = $_POST['recensie-bericht']; 

        $addReview = $connectie->prepare("INSERT INTO reviews(reis_id, reis_review_beoordeling, reis_review_bericht) VALUES(?, ?, ?)");
        $addReview->execute([$reisReview, $reisReviewBeoordeling, $reisReviewBericht]);
    } else{
        $addReview = $connectie->prepare("INSERT INTO reviews(reis_id, reis_review_beoordeling) VALUES(?, ?)");
        $addReview->execute([$reisReview, $reisReviewBeoordeling]);
    }
}

header("Location: account.php")
?>
