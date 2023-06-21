<footer>
        <div class="footer-container">
            <div class="footer-top">
                <div class="footer-text-container">
                    <h1 class="footer-category-text-header">Klantenservice</h1>
                    <?php
                        if(isset($_SESSION['user_id'])){
                            echo '<a href="contact.php" class="footer-category-text">Contact Us</a>';
                        } else{
                            echo '<a href="Inloggen.php" class="footer-category-text">Contact Us</a>';
                        }
                    
                    ?>
                    <div class="footer-category-text">contact-bookly@gmail.com</div>
                    <a href="over-ons.html" class="footer-category-text">Over ons</a>
            	</div>
                <div class="footer-text-container">
                    <h1 class="footer-category-text-header">Reizen</h1>
                    <a href="homepage-reiszoeken.php" class="footer-category-text">Zomer</a>
                    <a href="homepage-reiszoeken.php" class="footer-category-text">Winter</a>
                    <a href="homepage-reiszoeken.php" class="footer-category-text">Populaire</a>
                </div>
                <div class="footer-text-container">
                <h1 class="footer-category-text-header">Account</h1>
                    <a href="logout.php" class="footer-category-text">Log-uit</a>
                    <a href="Inloggen.php" class="footer-category-text">Log-in</a>
                </div>
                <div class="footer-text-container">
                    <div>
                        <h1 class="footer-category-text-header">Veilig betalen</h1>
                    </div>
                    <div class="footer-text-container-betalen">
                        <h2 class="footer-category-text"><i class="fa-brands fa-paypal"></i></h2>
                        <h2 class="footer-category-text"><i class="fa-solid fa-building-columns"></i></h2>
                        <h2 class="footer-category-text"><i class="fa-brands fa-btc"></i></h2>
                    </div>
                </div>
            </div>
            <div class="footer-bottom-container">
                <div class="footer-bottom">
                    <a href="voorwaarden.php" class="footer-category-text-header color-light-blue">Voorwaarden</a>
                    <a href="privacy-policy.php" class="footer-category-text-header color-light-blue">Privacy</a>
                    <a href="cookie-policy.php" class="footer-category-text-header color-light-blue">Cookie</a>
                </div>
            </div>
        </div>
    </footer>