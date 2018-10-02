<?php
    try{
        $bdd = new PDO('mysql:host=localhost;dbname=epitech_tp;charset=utf8','root','root');
    }
    catch (Exception $e){
        die('Erreur : '.$e->getMessage());
    }
    if (isset($_POST['prenom']) || isset($_POST['nom'])){
        if ($_POST['prenom'] != '' && $_POST['nom'] != '') {
            $prenom = $_POST['prenom'];
            $nom = $_POST['nom'];

            $tabfiche_personne = $bdd->query("SELECT * FROM fiche_personne");
            
            while ($fichepersonne = $tabfiche_personne->fetch()) {
                if ($prenom == $fichepersonne['prenom'] && $nom == $fichepersonne['nom']) {
                    echo $fichepersonne['prenom']." ".$fichepersonne['nom']."</br>";
                    echo "Né le ".$fichepersonne['date_naissance']."</br>";
                    echo "email : ".$fichepersonne['email']."</br>";
                    echo "Domicile : ".$fichepersonne['ville']." ".$fichepersonne['cpostal']."</br></br>";
                    
                    $idpersonne = $fichepersonne['id_perso'];

                    $tabmembre = $bdd->query("SELECT * FROM membre");

                    while ($membre = $tabmembre->fetch()) {
                        if ($idpersonne == $membre['id_fiche_perso']){
                            $id_abo = $membre['id_abo']; 
                            $id_membre = $membre['id_membre'];

                            $tababonnement = $bdd->query("SELECT * FROM abonnement");

                            while ($abonnement = $tababonnement->fetch()) {
                                if( $id_abo == $abonnement['id_abo']){
                                    echo "Abonnement ".$abonnement['nom']."</br>";
                                    echo $abonnement['resum']."</br>";
                                    echo $abonnement['prix']."€</br></br>";
                                    echo "    
                                    <form action='modifabo.php' method='post'>
                                        <select name='abonnement'>
                                            <option value='0'>VIP</option>
                                            <option value='1'>GOLD</option>
                                            <option value='2'>Classic</option>
                                            <option value='3'>Pass Day</option>
                                            <option value='4'>Malsch</option>
                                            <option value='5'>Supprimer</option>
                                        </select>
                                        <input type='hidden' name='id_membre' value='$id_membre'/>
                                        <input type='submit' value='Valider'/>
                                    </form>";
                                }
                            }
                        }
                    }
                }
            }
        }
        else{
            echo "Veuillez indiquer le prenom ET le nom de l'utilisateur pour modifier sont abonnement";
        }
    }
    if(isset($_POST['abonnement']) && $_POST['id_membre']){    
        $choix = $_POST['abonnement'];
        $membreid = $_POST['id_membre'];
        //var_dump($membreid);
        //var_dump($choix);
        $supabo = $bdd->query("UPDATE membre SET id_abo = $choix WHERE id_membre = $membreid");
    }
?>