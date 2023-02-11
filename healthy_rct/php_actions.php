<?php 
  require_once "BddConnect.php";
  require_once "php_utiles.php";

  
  if(isset($_GET["action"]))
  {
      $nAction =$_GET["action"];      
  }
  
  if(isset($_GET["client"]))
  {
      $nClientId =$_GET["client"];
  }
  
  if(isset($_GET["recette"]))
  {
      $nRecetteId =$_GET["recette"];      
  }
  
if($nAction=="1"){
 $sRetour= PhpRecetteFavoris($nClientId, $nRecetteId);
 echo $sRetour;
}
?>