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

    if(isset($_POST['account_deleter_email'])) {
        $email_to_delete = $_POST['account_deleter_email'];
    
        $statement = $connectie->prepare("SELECT user_email FROM users WHERE user_email = ? AND user_owner = FALSE ");
        $statement->execute([$email_to_delete]);
    
        $emailCheck = $statement->fetch();
        if($emailCheck == 0){
            echo "Email niet gevonden";
        } else {
            $statement = $connectie->prepare("DELETE FROM users WHERE user_email = ? ");
            $statement->execute([$email_to_delete]);
        };
    
    
    }
    
    if(isset($_POST['permission_giver_email'])) {
        $email_to_give_admin = $_POST['permission_giver_email'];
    
        $statement = $connectie->prepare("SELECT user_email FROM users WHERE user_email = ? AND user_admin_rights = FALSE");
        $statement->execute([$email_to_give_admin]);
    
        $emailCheck = $statement->fetch();
        if($emailCheck == 0){
            echo "Email niet gevonden of gebruiker heeft geen rechten.";
        } else {
            $statement = $connectie->prepare("UPDATE users SET user_admin_rights = TRUE WHERE user_email = ? ");
            $statement->execute([$email_to_give_admin]);
        };
    }
    
    if(isset($_POST['permission_taker_email'])) {
        $email_to_take_admin = $_POST['permission_taker_email'];
    
        $statement = $connectie->prepare("SELECT user_email FROM users WHERE user_email = ? AND user_admin_rights = TRUE AND user_owner = FALSE");
        $statement->execute([$email_to_take_admin]);
    
        $emailCheck = $statement->fetch();
        if($emailCheck == 0){
            echo "Email niet gevonden of gebruiker heeft geen rechten.";
        } else {
            $statement = $connectie->prepare("UPDATE users SET user_admin_rights = FALSE WHERE user_email = ? ");
            $statement->execute([$email_to_take_admin]);
        };
    }

header("Location: account.php")
?>