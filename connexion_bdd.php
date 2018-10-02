<?php
    class Connection {
        public $bdd;
        
        public function __construct() {
            // try{
                $bdd = new PDO('mysql:host=localhost;dbname=my_meetic;charset=utf8','root','root');
              //  $bdd->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->bdd = $bdd;
            
            // catch (Exception $e){
            //     die('Erreur : '.$e->getMessage());
            // }
        
        }

    }
    $new = new Connection();
?>

