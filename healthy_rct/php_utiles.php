 <?php
  require_once "BddConnect.php";  

 function PhpGetInt($psSql,$psChamp)
 {      
      $nReturn = 0;
      $stmt = $GLOBALS["_bdd"]->prepare($psSql);
      $stmt->execute();
      $res = $stmt->fetchAll();
      foreach ( $res as $row ) {
        $nReturn = $row[$psChamp]; 
      }

      return $nReturn;
  }
 function PhpGetString($psSql,$psChamp)
 {      
      $sReturn = "";
      $stmt = $GLOBALS["_bdd"]->prepare($psSql);
      $stmt->execute();
      $res = $stmt->fetchAll();
      foreach ( $res as $row ) {
        $sReturn = $row[$psChamp]; 
      }
      return $sReturn;
  }

  function PhpVerifLoginClient($psLogin, $psPassWord)
  {     
      $bConnect = false; 
      $nClientId = 0;
      $nTentatives = 0;
      $stmt = $GLOBALS["_bdd"]->prepare("SELECT * 
                            FROM cli_client 
                            WHERE cli_email = ? 
                            AND cli_actif = 1                      
                            ");
      $stmt->bindParam(1,$psLogin);
      $stmt->execute();
      $res = $stmt->fetchAll();
      foreach ( $res as $row ) {
        $nClientId = $row["cli_id"]; 
        $nTentatives = $row["cli_tentatives"];
        if (password_verify($psPassWord, $row["cli_password"]))
        {
          $bConnect = true;
        }
      
      }
      if (($nClientId > 0) && (!$bConnect)) {
        ++$nTentatives;
        $sSql= "update cli_client
        set cli_tentatives = ?
        where cli_id = ?";  
        $stmt = $GLOBALS["_bdd"]->prepare($sSql);   
        $nParam = 1;
        $stmt->bindParam($nParam++,$nTentatives);      
        $stmt->bindParam($nParam++,$nClientId); 
        $retour = $stmt->execute();
        if ($nTentatives == 10) {
          $sSql= "update cli_client
          set cli_actif = 0
          where cli_id = ?";  
          $stmt = $GLOBALS["_bdd"]->prepare($sSql);   
          $nParam = 1;     
          $stmt->bindParam($nParam++,$nClientId); 
          $retour = $stmt->execute();
        }
        $nClientId = 0;

      }

      return $nClientId;
  }

  function PhpTestLoginClient($psLogin)
  {
      $nClientId = 0;
      $stmt = $GLOBALS["_bdd"]->prepare("SELECT * 
                            FROM cli_client 
                            WHERE cli_email = ?");
      $stmt->bindParam(1,$psLogin);
      $stmt->execute();
      $res = $stmt->fetchAll();
      foreach ( $res as $row ) {
        $nClientId = $row["cli_id"]; 
      }
      return  ($nClientId !=0 );
  }

  function PhpInsertLoginClient($psLogin, $psUsername, $psPassWord)
  {      
      $sPassWord = password_hash($psPassWord, PASSWORD_DEFAULT, ['cost' =>12]); 
      $sSql = "INSERT INTO cli_client  (cli_email, cli_username, cli_password) values(?,?,?)";
      $stmt = $GLOBALS["_bdd"]->prepare($sSql);
      $stmt->bindParam(1,$psLogin);
      $stmt->bindParam(2,$psUsername);
      $stmt->bindParam(3,$sPassWord);
      $nRetour =$stmt->execute();
      return  (PhpVerifLoginClient($psLogin, $psPassWord));
  }

  function PhpGetClientName($pnClientId){
      $sClientName="";
     $stmt = $GLOBALS["_bdd"]->prepare("SELECT cli_username 
                            FROM cli_client 
                            WHERE cli_id = ?");
      $stmt->bindParam(1,$pnClientId);
      $stmt->execute();
      $res = $stmt->fetchAll();
      foreach ( $res as $row ) {
        $sClientName = $row["cli_username"]; 
      }
      return  ($sClientName);
  }

  function PhpRecetteFavoris($pnClientId, $pnRctId)
  {            
      $bExist = 0; 
      $sSql = "SELECT fav_cli_id FROM fav_favoris WHERE fav_cli_id=? AND fav_rct_id=?";
      $stmt = $GLOBALS["_bdd"]->prepare($sSql);
      $stmt->bindParam(1,$pnClientId);
      $stmt->bindParam(2,$pnRctId);
      $stmt->execute();
      $res = $stmt->fetchAll();
      foreach ( $res as $row ) {
        $bExist = 1; 
      }
      if ($bExist==1)
      {
        PhpRecetteDeleteFavoris($pnClientId, $pnRctId);
        $sRetour=0;
      }
      else{
        PhpRecetteInsertFavoris($pnClientId, $pnRctId);
        $sRetour=1;
      }

      return( $sRetour );
      
  } 



  function PhpRecetteInsertFavoris($pnClientId, $pnRctId)
  {            
      $sSql = "INSERT INTO fav_favoris (fav_cli_id, fav_rct_id) values(?,?)";
      $stmt = $GLOBALS["_bdd"]->prepare($sSql);
      $stmt->bindParam(1,$pnClientId);
      $stmt->bindParam(2,$pnRctId);
      $nRetour =$stmt->execute();
  } 
  function PhpRecetteDeleteFavoris($pnClientId, $pnRctId)
  {            
      $sSql = "DELETE FROM  fav_favoris WHERE fav_cli_id=? AND fav_rct_id=?";
      $stmt = $GLOBALS["_bdd"]->prepare($sSql);
      $stmt->bindParam(1,$pnClientId);
      $stmt->bindParam(2,$pnRctId);
      $nRetour =$stmt->execute();
  } 

  function PhpNombreRecetteMax($pnClientId)
  {
      $nNb = 0 ;
      $sSql = "SELECT COUNT(1) AS nb 
              FROM rct_recette 
              WHERE rct_id NOT IN (SELECT fav_rct_id FROM fav_favoris WHERE fav_cli_id = ? ) ";
      $stmt = $GLOBALS["_bdd"]->prepare($sSql);
      $stmt->bindParam(1,$pnClientId);
      $stmt->execute();
      $res = $stmt->fetchAll();
      foreach ( $res as $row ) {
        $nNb = $row["nb"]; 
      }
      return  ($nNb);
  }


  function PhpRecetteInsert(
                                $psRctClientName
                                ,$psRctName
                                ,$psRctImage
                                ,$pnRctNbPersonne
                                ,$psRctTime            
                                ,$psRctDifficulty              
                                ,$psRctPrice           
                                ,$psRctDish      
                                ,$psRctIngredients           
                                ,$psRctPreparation            
                                  )
{ 
    $sSql= "insert rct_recette
         (
          rct_cli_name
          ,rct_name
          ,rct_img
          ,rct_nb_pers	
          ,rct_time 
          ,rct_difficulty 
          ,rct_price 
          ,rct_dish 
          ,rct_ingredients 
          ,rct_preparation 
          )
       values(?,?,?,?,?
             ,?,?,?,?,?
             )";      
  
    $stmt = $GLOBALS["_bdd"]->prepare($sSql);   
    $nParam = 1;
    $stmt->bindParam($nParam++,$psRctClientName); 
    $stmt->bindParam($nParam++,$psRctName);             
    $stmt->bindParam($nParam++,$psRctImage);         
    $stmt->bindParam($nParam++,$pnRctNbPersonne);           
    $stmt->bindParam($nParam++,$psRctTime);         
    $stmt->bindParam($nParam++,$psRctDifficulty);     
    $stmt->bindParam($nParam++,$psRctPrice);          
    $stmt->bindParam($nParam++,$psRctDish);           
    $stmt->bindParam($nParam++,$psRctIngredients); 
    $stmt->bindParam($nParam++,$psRctPreparation);            
    $retour = $stmt->execute();
    // $retour   : 1 if inserted. 2 if the row has been updated.
    
    $sRctImage = $psRctImage;

    $sSql= "SELECT max(rct_id) as id FROM rct_recette";
    
    $nRctId = PhpGetInt($sSql,"id");

    $sp = explode('.' ,$psRctImage);   // toto.png     $sp[0] = toto      $sp[1] = png  

   
    if (count($sp)>=2) {
      $sRctImage = "recette_".$nRctId.".".$sp[1];   // recette_1.png
      
      $sSql= "update rct_recette
         set rct_img = ?
         where rct_id = ?";  
      $stmt = $GLOBALS["_bdd"]->prepare($sSql);   
      $nParam = 1;
      $stmt->bindParam($nParam++,$sRctImage);      
      $stmt->bindParam($nParam++,$nRctId); 
      $retour = $stmt->execute();
    }
    
    return ($sRctImage);
}
?>