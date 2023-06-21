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

    if(isset($_POST['reis_id_to_book'])) {
        $reis_ophalen = $connectie->prepare("SELECT * FROM reizen where reis_id = ?");
        $reis_ophalen->execute([$_POST['reis_id_to_book']]);

        $reis = $reis_ophalen->fetch();
    }

    if(isset($_POST['reis_id_to_book']) && isset($_POST['aantal-persoonen']) && isset($_POST['datum-aankomst']) && isset($_POST['datum-vertrek'])){
        if($_POST['datum-aankomst'] >= $_POST['datum-vertrek']){
            header("Location: homepage-reiszoeken.php");
        } else{
            $reis_id = $_POST['reis_id_to_book'];
            $user_id = $_SESSION['user_id'];
            $reis_aantal_personen = $_POST['aantal-persoonen'];
            $reis_datum_aankomst = $_POST['datum-aankomst'];
            $reis_datum_vertrek = $_POST['datum-vertrek'];
            $reis_prijs_per_nacht = $reis['reis_price'];

            $datum1=date_create($reis_datum_aankomst);
            $datum2=date_create($reis_datum_vertrek);
            $verschil=date_diff($datum1,$datum2);
            $aantal_dagen=$verschil->format("%a");

            $prijs= ($aantal_dagen * $reis_prijs_per_nacht * $reis_aantal_personen);

            $statement = $connectie->prepare("INSERT INTO boekingen(reis_id, user_id, boeking_reis_start, boeking_reis_end, boeking_aantal_personen, boeking_price) VALUES(?, ?, ?, ?, ?, ?)");
            $statement->execute([$reis_id, $user_id, $reis_datum_aankomst, $reis_datum_vertrek, $reis_aantal_personen, $prijs]);
        }

    }

    header("Location: account.php")
    ?>