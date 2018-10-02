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
    <form action="modifabo.php" method="post">
        <input type="text" placeholder="Prenom" name="prenom"/>
        <input type="text" placeholder="Nom" name="nom"/>
        <input type="submit" value="Valider">
    </form>
    <?php
        include 'modifabo1.php';   
    ?>
</body>
</html>