<?php
    try{
    $pdo_option[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
    $GLOBALS["_bdd"] = new PDO( 'mysql:host=localhost;dbname=healthy_eat;charset=utf8',
    'root','');
    
     }catch(Exeption $e){
      die('Erreur:'.$e->getMessage());
    }

?>
