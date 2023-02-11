  <?php 
    require_once "BddConnect.php"; 
    require_once "php_utiles.php"; 


    $sSql = "SELECT * FROM rct_recette";
    $sWhere = "";
    $nClientId =0;
    if(isset($_GET["client"]))
    {
        $nClientId =$_GET["client"];
    }
    
    if(isset($_GET["recette"]))
    {
        $sParam ="%".$_GET["recette"]."%";
        $sWhere = " WHERE rct_name like ?";
    }
    if(isset($_GET["filtre"]))
    {
        $sFiltre =$_GET["filtre"];
        if($sFiltre == "price_cheap"){
          $sWhere = " WHERE rct_price = 'bon marché' ";
        }
        if($sFiltre == "price_expensive"){
          $sWhere = " WHERE rct_price = 'cher' ";
        }
        if($sFiltre == "easy"){
          $sWhere = " WHERE rct_difficulty = 'facile' ";
        }
        if($sFiltre == "normal"){
          $sWhere = " WHERE rct_difficulty = 'moyen' ";
        }
        if($sFiltre == "hard"){
          $sWhere = " WHERE rct_difficulty = 'difficile' ";
        }
        if($sFiltre == "starter"){
          $sWhere = " WHERE rct_dish = 'Entrée' ";
        }
        if($sFiltre == "dish"){
          $sWhere = " WHERE rct_dish = 'Plat' ";
        }
        if($sFiltre == "dessert"){
          $sWhere = " WHERE rct_dish = 'Dessert' ";
        }
        if($sFiltre == "all"){
          
        }
        if($sFiltre == "favoris"){
          $sWhere = " INNER JOIN fav_favoris ON fav_rct_id = rct_id WHERE fav_cli_id = ? ";
          $sParam = $nClientId ;
        }
        if($sFiltre == "random"){
          $nbMaxRecettes = PhpNombreRecetteMax($nClientId);  
          $nNoRecette = rand(1, $nbMaxRecettes);
          $sSql = "SELECT * FROM 
             (
              SELECT *,  ROW_NUMBER() OVER (ORDER BY rct_id) AS num_order FROM rct_recette
              WHERE  rct_id NOT IN (SELECT fav_rct_id FROM fav_favoris WHERE fav_cli_id = ? ) 
             ) rct
             WHERE  num_order = ? ";         
          $sParam = $nClientId ;
          
        }
      
    }
    
  
    $stmt = $GLOBALS["_bdd"]->prepare($sSql.$sWhere);
    if (isset($sParam))
    {
      $stmt->bindParam(1,$sParam);
    }
    if (isset($nNoRecette))
    {
      $stmt->bindParam(2,$nNoRecette);
    }
    $stmt->execute();
    $res = $stmt->fetchAll();
    foreach ( $res as $row ) {  
       $nRecetteId =$row["rct_id"]; 
    ?>
    <li class="cards_item">
      <div class="card">
        <div class="card_image"><img src="img-recette/<?php echo $row["rct_img"] ?>" width="400px" height="auto"></div>
        <div class="card_content">
          <h2 class="card_title"><?php echo $row["rct_name"] ?></h2> <i class="fa fa-star gold"></i>
          <p class="card_text">
            <ul>
              <li>Nombre de personne : <b><?php echo $row["rct_nb_pers"] ?></b></li>
              <li>Niveau de difficulté : <b><?php echo $row["rct_difficulty"] ?></b></li>
              <li>Temps de préparation : <b><?php echo $row["rct_time"] ?></b></li>
              <li>Gamme de prix : <b><?php echo $row["rct_price"] ?></b></li>
              <li>Type de plat : <b><?php echo $row["rct_dish"] ?></b></li>
            </ul>
          </p>
          <button class="btn card_btn" onclick="jsOuvreRecette(<?=$nRecetteId?>)"> Cuisiner !</button>
        </div>
      </div>
    </li>
    <?php 
    }
    ?>