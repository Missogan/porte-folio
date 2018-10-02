<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="style.css"/>
</head>
<body>
    <header>
        <div class="VideoPane">
            <video class="videoPane_video" src="video/fond_header.mp4" loop="loop" muted="muted" autoplay="autoplay" playsinline="playsinline"></video>
        </div>
        <div class="div_search">
                <form action="traitement.php" method="post" id="form_search">
                    <input type="text" placeholder="Search" name="search"/>
                </form>
        </div>
        <?php include('header.php') ?>
        <article>
            <!-- Ici le dernier film sortie -->
            <div class="a_laffiche">
                <h4>A L'AFFICHE</h4>
                <div class="film1">
                    <img src="image/film1.jpeg" alt="Avatar">
                    <img src="image/film2.jpeg" alt="X-men Days of Future Past ">
                    <img src="image/film3.jpeg" alt="Tomb Raider">
                    <img src="image/film4.jpeg" alt="Black Panther">
                </div>
            </div>
        </article>
    </header>
    <div class="container">
        <article>
            <div class="Prochainement">
                <div>
                    <h4>PROCHAINEMENT</h4>
                <div>
                <div class="film">
                    <img src="image/film6.jpeg" alt="Star Wars">
                    <img src="image/film7.jpeg" alt="Le Hobbit">
                    <img src="image/film8.jpeg" alt="Deadpool">
                    <img src="image/film10.jpeg" alt="King Kong">
                </div>
            </div>
            <div class="Les_succes">
                <div>
                    <h4>LES SUCCES</h4>
                </div>
                <div class="film">
                    <img src="image/film11.jpeg" alt="Warcaft">
                    <img src="image/film12.jpeg" alt="Ant-Man">
                    <img src="image/film13.jpeg" alt="Valerian">
                    <img src="image/film14.jpeg" alt="Spidrman Home-Coming">
                </div>
            </div>
            <div class="Nos_coup_de_coeur">
                <div>
                    <h4>NOS COUP DE COEUR</h4>
                </div>
                <div class="film">
                    <img src="image/film15.jpeg" alt="Tortue ninja">
                    <img src="image/film16.jpeg" alt="Albator">
                    <img src="image/film5.jpeg" alt="Blade Runner 2040">
                    <img src="image/film9.jpeg" alt="Pulpe fiction">    
                </div>
            </div>
        </article>
    </div>
    <footer>
        <div class="footer_gauche">
            <p>Copyright</p>
        </div>
        <div class="footer_droit">
            <ul><h5>Partner</h5>
                <li>OpenClassRoom</li>
                <li>Grafikart</li>
                <li>Web@cademie</li>
            </ul>
        </div>
    </footer>
</body>
</html>