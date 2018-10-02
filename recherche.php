<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="style.css" />
</head>
<body>
    <?php 
        function connection (){
            try{
                return new PDO('mysql:host=localhost;dbname=epitech_tp;charset=utf8','root','root');
            }
            catch (Exception $e){
                die('Erreur : '.$e->getMessage());
            }
        }
        $bdd = connection();
        ?>
    <form action="traitement.php" method="post">
        <select name="genre" id="genre">
            <option value="genre">Genre</option>
            <?php
            $tabGenre = $bdd->query('SELECT * FROM genre');
            
            while( $genre = $tabGenre->fetch() ) {
                echo '<option value="' . $genre['id_genre'] . '">' . $genre['nom'] . '</option>'; 
            }
            ?>
        </select><br>
        <select name="distributeur" id="distributeur">
            <option value="distribution">Distribution</option>
            <?php
            $tabDistrib = $bdd->query('SELECT * FROM distrib');
            
            while( $distrib = $tabDistrib->fetch() ) {
                echo '<option value="' . $distrib['id_distrib'] . '">' . $distrib['nom'] . '</option>'; 
            }
            ?>
        </select><br>
        <input type="submit" value="Valider"/>
    </form>
</body>
</html>