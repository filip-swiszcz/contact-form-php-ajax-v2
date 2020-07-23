<!DOCTYPE html>
<html lang="pl">
<head>
    <title>Kontakt - KOZLOVSKY</title>
    <meta charset="UTF-8">
	<meta name="description" content="Kozlovsky">
	<meta name="keywords" content="clothes, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Google font -->
    <link href='https://fonts.googleapis.com/css?family=Courier Prime' rel='stylesheet'>
    
    <!-- Favicon -->
    <link href="img/favicon.ico" rel="shortcut icon"/>
    
    <!-- Stylesheets -->
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <script src="https://kit.fontawesome.com/fdc333dac4.js" crossorigin="anonymous"></script>
    
    <!-- Main Stylesheets -->
    <link rel="stylesheet" href="css/style.css"/>
    
    <!-- Google reCaptcha -->
    <script src="https://www.google.com/recaptcha/api.js?render=SITE_KEY"></script>
    <script>
        grecaptcha.ready(function () {
            grecaptcha.execute('SITE_KEY', { action: 'contact' }).then(function (token) {
                var recaptchaResponse = document.getElementById('recaptchaResponse');
                recaptchaResponse.value = token;
            });
        });
    </script>
    
</head>
<body>
    
    <div id="success"></div>
    <div id="error"></div>
    
    <header class="header">
        <div class="container">
            <div class="row justify-content-md-center top-header">
                
                <div class="col logos" style="padding: 0.625rem">
                    <div class="logo">
                        <a href="#">
                            <img src="img/3dgifmaker28.gif" alt="">
                        </a>
                    </div>
                </div>
                
                <div class="col align-self-center menu" style="padding: 0.625rem">
                    <ul class="main-menu">
                        <li class="drop-li">
                            <?php if (isset($_SESSION['member_id'])) { ?>
                            <a href="konto.php" class="login">Witaj <?php echo $user[0]['member_name']; ?>!</a>
                            <div class="dropdown">
                                <a href="konto.php">Mój profil</a>
                                <a href="wyloguj.php">Wyloguj</a>
                            </div>
                            <?php } else { ?>
                            <a href="logowanie.php" class="login">Zaloguj się</a>
                            <?php } ?>
                        </li>
                        <li><a href="lista-zyczen.php" class="favorite"><i class="far fa-heart"></i></a></li>
                        <li><a href="koszyk.php" class="cart"><i class="fas fa-shopping-cart"></i></a></li>
                    </ul>
                </div>
                
            </div>
        </div>
        <div class="container" style="padding: 0">
            <nav class="nav">
                <a href="index.php" class="nav-link">STRONA GŁÓWNA</a>
                <a href="sklep.php" class="nav-link">SKLEP</a>
                <a href="kontakt.php" class="nav-link active">KONTAKT</a>
                <a href="o-nas.php" class="nav-link">O NAS</a>
            </nav>
            <nav class="mobile-nav">
                <div class="row text-center">
                    <div class="col mobile">
                        <a href="#" class="side-button" onclick="openSide()"><i class="fas fa-bars"></i></a>
                    </div>
                    <div class="col mobile">
                        <a href="<?php if (isset($_SESSION['member_id'])) { echo 'konto.php'; } else { echo 'logowanie.php'; }  ?>"><i class="fas fa-user-circle"></i></a>
                    </div>
                    <div class="col mobile">
                        <a href="#"><i class="fas fa-shopping-cart"></i></a>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    
    <div id="slide-out" class="side-nav">
        <div class="container">
            <div class="row text-right">
                <div class="col">
                    <a href="javascript:void(0)" class="closebtn" onclick="closeSide()">&times;</a>
                </div>
            </div>
            <div class="row text-center">
                <div class="col">
                    <ul class="side-ul">
                        <li><a href="index.php">STRONA GŁÓWNA</a></li>
                        <li><a href="sklep.php">SKLEP</a></li>
                        <li><a href="kontakt.php">KONTAKT</a></li>
                        <li><a href="o-nas.php">O NAS</a></li>
                        <li><?php if (isset($_SESSION['member_id'])) { echo '<a href="wyloguj.php" style="color: red">WYLOGUJ</a>'; } else { echo '<a href="logowanie.php">ZALOGUJ SIĘ</a>'; } ?></li>
                    </ul>
                </div>
            </div>
            <div class="row text-center">
                <div class="col" style="margin-top: 70vh">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-instagram-square"></i></a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container container-contact">
        <div class="row text-left">
            <div class="col contact">
                <h4>Skontaktuj się z nami:</h4>
            </div>
        </div>
        <div class="row text-left">
            <div class="col contact">
                <form class="contact-form" id="contact-form" method="post" action="inc/ContactScript.php">
                    <label class="col-sm-3 col-xs-no-pd">Imię:</label>
                    <div class="col-sm-12 col-xs-no-pd contact-div">
                        <input class="col-sm-6" id="name" type="text" name="name">
                    </div>
                    <label class="col-sm-3 col-xs-no-pd">Email:</label>
                    <div class="col-sm-12 col-xs-no-pd contact-div">
                        <input class="col-sm-6" id="email" type="text" name="email">
                    </div>
                    <label class="col-sm-3 col-xs-no-pd">Tytuł (np. współpraca):</label>
                    <div class="col-sm-12 col-xs-no-pd contact-div">
                        <input class="col-sm-6" id="title" type="text" name="title">
                    </div>
                    <label class="col-sm-3 col-xs-no-pd">Treść:</label>
                    <div class="col-sm-12 col-xs-no-pd contact-div">
                        <textarea class="col-sm-6" id="message" type="text" name="message"></textarea>
                    </div>
                    <div class="col-sm-12 col-xs-no-pd contact-div" style="margin-top: 1.5rem">
                        <input class="col-sm-offset-3 col-sm-6 btn" type="submit" name="submit" value="Wyślij">
                    </div>
                    <input id="recaptchaResponse" type="hidden" name="recaptcha_response">
                </form>
            </div>
        </div>
        <div class="row text-left">
            <div class="col contact">
                <p style="font-size: 0.75rem; margin-bottom: 3rem;">Nasz email: contact@kozlovskybrand.com</p>
            </div>
        </div>
    </div>
    
    <footer>
        <div class="container">
            <div class="row text-center">
                <div class="col">
                    <a href="#" class="social-icons"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="social-icons"><i class="fab fa-instagram-square"></i></a>
                </div>
                <div class="col-6">
                    <ul class="footer">
                        <li><a href="#">REGULAMIN</a></li>
                        <li><a href="#">POLITYKA PRYWATNOŚCI</a></li>
                        <li><a href="#">DOSTAWA</a></li>
                    </ul>
                </div>
                <div class="col">
                    <p class="copyright">COPYRIGHT © 2020 KOZLOVSKY</p>
                </div>
            </div>
        </div>
    </footer>
    
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/contact.js"></script>
    <script>
        function openSide() {
            document.getElementById('slide-out').style.width = '100%';
        }
        function closeSide() {
            document.getElementById('slide-out').style.width = '0';
        }
    </script>
    
</body>
</html>