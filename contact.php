<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OverOns</title>
    <link rel="stylesheet" href="/styles/main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>
<body>
    <main>
        <div class="contact-container">
            <div class="contact-page">
                <div class="contact-page-left-container">
                    <img class="wewanttohearfromyouimage" src="Images/weWantToHearFromYou.png" alt="we want to hear from you.">
                </div>
                <div class="contact-page-middle-container">

                </div>
                <div class="contact-page-right-container">
                    <h1>Contact us</h1>  
                    <form class="contact-message" action="bericht.php" method="POST">
                        <textarea class="contact-page-bericht" name="Bericht" cols="30" rows="10"></textarea>
                        <input type="submit">
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>
</html>