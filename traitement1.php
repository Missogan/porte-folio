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
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////FILM////////////////////////////////////////////////////////////////////////////////////////
    if (isset($_POST['search'])) {

        $search = $_POST['search'];
        $tabfilm = $bdd->query("SELECT * FROM film");

        while ($film = $tabfilm->fetch()) {
            if($search == $film['titre']){
                    
                echo "Nom : ".$film['titre']."<br>";
                    
                $genre_film = $film['id_genre'];
                $distrib_film = $film['id_distrib'];
                $resum = $film['resum'];
                $debut_affiche = $film['date_debut_affiche'];
                $fin_affiche = $film['date_fin_affiche'];
                $duree = $film['duree_min'];
                $prod = $film['annee_prod'];
                    
                $tabgenre = $bdd->query("SELECT * FROM genre");
                    
                while ($genre = $tabgenre->fetch()) {
                    if ($genre_film == $genre['id_genre']) {
                            
                        echo "Genre : ".$genre['nom']."<br><br>";
                        echo "Résumer : ".$resum."<br><br>";
                            
                        $tab_distrib = $bdd->query("SELECT * FROM distrib");
                            
                        if ($distrib_film != NULL){
                            while ($distrib = $tab_distrib->fetch()) {
                                if($distrib_film == $distrib['id_distrib']){
                                    echo "Distributeur : ".$distrib['nom'];
                                }
                            }
                        }
                        else{
                            echo "Distibuteur : Inconnu<br>";
                        }
                        echo "Durée : ".$duree." min<br>";
                        echo "Produit en : ".$prod."<br>";
                        echo "A l'affiche du : ".$debut_affiche."  au ".$fin_affiche."<br>";
                    }
                }
                    
            }
        }
    }
    if (isset($_POST['genre']) || isset($_GET['genre'])) {
        
        if(isset($_POST['genre'])) {
            $genre = $_POST['genre'];
        }
        if(isset($_GET['genre'])) {
            $genre = $_GET['genre'];
        }
        if ($genre != 'genre') {
            $messagesParPage = 5;

            $retour_total = $bdd->query('SELECT COUNT(*) AS total FROM genre');
            $donnees_total = $retour_total->fetch();
            $total = $donnees_total['total'];

            $nombreDePages = ceil($total/$messagesParPage);

            if(isset($_GET['page'])) {
                $pageActuelle = intval($_GET['page']);

                if( $pageActuelle > $nombreDePages ) {
                    $pageActuelle = $nombreDePages;
                }
            }
            else {
                $pageActuelle = 1;
            }

            $premiereEntree = ($pageActuelle-1)*$messagesParPage;

            $retour_messages = $bdd->query("SELECT titre,id_genre FROM film WHERE id_genre = '" . $genre . "' LIMIT " . $premiereEntree . ", " . $messagesParPage. "");
            while ($donnees_messages = $retour_messages->fetch() ) {
                
                if ($donnees_messages['id_genre'] == $genre) {
                    echo '<table width="400" border="2px solid gray" align="center" cellpadding="0" cellspacing="0">
                            <tr>
                                <td><strong>' . $donnees_messages['titre'] . '</strong></td>
                            </tr>
                        </table>
                            <br>';
                }
            }
            echo '<p align="center">Page : ';
            for( $i = 1; $i <= $nombreDePages; $i++) {
                if( $i == $pageActuelle ) {
                    echo ' [ ' . $i . ' ] ';
                }
                else {
                    echo ' <a href="traitement.php?page=' . $i . '&amp;genre=' . $genre . '">' . $i . '</a> ';
                }
            } 
            echo '</p>';

        }
    }
    if (isset($_POST['distributeur']) || isset($_GET['distrib'])) {
        
        if(isset($_POST['distributeur'])) {
            $distrib = $_POST['distributeur'];
        }
        if(isset($_GET['distrib'])) {
            $distrib = $_GET['distrib'];
        }

        if($distrib != 'distribution') {
            $messagesParPage = 5;

            $retour_total = $bdd->query('SELECT COUNT(*) AS total FROM distrib');
            $donnees_total = $retour_total->fetch();
            $total = $donnees_total['total'];

            $nombreDePages = ceil($total/$messagesParPage);

            if(isset($_GET['page'])) {
                $pageActuelle = intval($_GET['page']);

                if( $pageActuelle > $nombreDePages ) {
                    $pageActuelle = $nombreDePages;
                }
            }
            else {
                $pageActuelle = 1;
            }

            $premiereEntree = ($pageActuelle-1)*$messagesParPage;
            $count = null;

            $retour_messages = $bdd->query("SELECT titre, id_distrib FROM film WHERE id_distrib = '" . $distrib . "' LIMIT " . $premiereEntree . ", " . $messagesParPage. "");
            while ($donnees_messages = $retour_messages->fetch() ) {
                $count = count($donnees_messages);
                if ($donnees_messages['id_distrib'] == $distrib) {
                    echo '<table width="400" border="2px solid gray" align="center" cellpadding="0" cellspacing="0">
                            <tr>
                                <td><strong>' . $donnees_messages['titre'] . '</strong></td>
                            </tr>
                          </table>
                            <br>';
                }
            }
            $totalPage = ceil($count/$messagesParPage);
            echo '<p align="center">Page : ';
            for( $i = 1; $i <= $totalPage; $i++) {
                if( $i == $pageActuelle ) {
                    echo ' [ ' . $i . ' ] ';
                }
                else {
                    echo ' <a href="traitement.php?page=' . $i . '&amp;distrib=' . $distrib . '">' . $i . '</a> ';
                }
            } 
            echo '</p>';
        }
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////MEMBRE////////////////////////////////////////////////////////////////////////////////////////////////////

            if (isset($_POST['prenom']) || isset($_POST['nom'])) {

                $prenom = $_POST['prenom'];
                $nom = $_POST['nom'];

                $tabfiche_personne = $bdd->query("SELECT * FROM fiche_personne");

                while ($fichepersonne = $tabfiche_personne->fetch()) {
                    if ($prenom == $fichepersonne['prenom'] || $nom == $fichepersonne['nom']) {
                        echo $fichepersonne['prenom']." ".$fichepersonne['nom']."</br>";
                        echo "Né le ".$fichepersonne['date_naissance']."</br>";
                        echo "email : ".$fichepersonne['email']."</br>";
                        echo "Domicile : ".$fichepersonne['ville']." ".$fichepersonne['cpostal']."</br></br>";

                    }
                }
            }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////HISTORIQUE////////////////////////////////////////////////////////////////////////////////////////////////

            if(isset($_POST['nom_historique'])){

                $id_nom_historique = $_POST['nom_historique'];

                $tab_historique_membre = $bdd->query("SELECT * FROM historique_membre");

                echo "<form method='post' action='traitement.php'>";
                while($historique_membre = $tab_historique_membre->fetch()){
                    if($historique_membre['id_membre'] == $id_nom_historique){

                        $tabfilm = $bdd->query("SELECT id_film, titre FROM film");

                        while ($film = $tabfilm->fetch()) {
                            if ($film['id_film'] == $historique_membre['id_film'] ) {
                                echo "<input type='radio' name='film_commenter' value='".$film['id_film']."'/>";
                                echo "<label for='".$film['id_film']."'>".$film['titre']."</label></br>";
                            }
                        }
                    }
                }
                echo "<input type='hidden' name='id_membre' value='$id_nom_historique'/>";
                echo "<input type='submit' value='Poster un avis'/>";
                echo "</form>";
            }
            if(isset($_POST['film_commenter']) && isset($_POST['id_membre']) && !isset($_POST['commenter'])){

                $film_commenter = $_POST['film_commenter'];
                $id_membre = $_POST['id_membre'];

                echo "<form method='post' action='traitement.php'>";
                    echo "<label for='commentaire'>Quel est votre commentaire ?</label></br></br>";
                    echo "<textarea name='commenter' rows='10' cols='50'>Ecrivez votre commentaire ici</textarea>";
                    echo "<input type='hidden' name='id_membre' value='$id_membre'/>";
                    echo "<input type='hidden' name='film_commenter' value='$film_commenter'/></br>";
                    echo "<input type='submit' value='Envoyer'/>";
                echo "</form>";
            }
            if (isset($_POST['commenter'])) {

                $film_commenter = $_POST['film_commenter'];
                $id_membre = $_POST['id_membre'];
                $commentaire = $_POST['commenter'];

                $commenter = $bdd->query("UPDATE historique_membre SET commentaire = $commentaire WHERE id_film = $film_commenter AND id_membre = $id_membre");

                echo "Votre commentaire à bien été ajouté";
                var_dump($id_membre);
                var_dump($film_commenter);
                var_dump($commentaire);
            }

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////FUNCTION/////////////////////////////////////////////////////////////////////////////////////////////////

            function form_prenom (){

                $bdd = connection();
                $tab_prenom_nom = $bdd-> query("SELECT id_perso,prenom,nom FROM fiche_personne");

                echo "<form method='post' action='traitement.php'>";
                echo "<label for='nom_historique'>De quel membre voulez vous voir l'historique ?</label>";
                echo "<select name='nom_historique'>";

                while ($prenom_nom = $tab_prenom_nom->fetch()) {

                    $id = $prenom_nom['id_perso'];
                    $prenom = $prenom_nom['prenom'];
                    $nom = $prenom_nom['nom'];

                    echo "<option value= '$id'>$prenom $nom</option>";
                }
                echo "<input type = 'submit' value = 'Valider'/>";
            }
?>