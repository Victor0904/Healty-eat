
  <!-- premiere partie -->

<?php 
  require_once "BddConnect.php";  

  $nClientId = $GLOBALS["ClientId"];
  $nRecetteId = $GLOBALS["RecetteId"];

  $sSql = "SELECT * FROM rct_recette ";    
  if($nClientId >0)
  {     
      $sSql .= " LEFT JOIN fav_favoris ON fav_rct_id = rct_id AND fav_cli_id = ?";
  }
  $sSql .= " WHERE rct_id =?";
  
  $stmt = $GLOBALS["_bdd"]->prepare($sSql);
  


  if($nClientId >0)
  {
     $stmt->bindParam(1,$nClientId);
     $stmt->bindParam(2,$nRecetteId);
  }
  else
  {
    $stmt->bindParam(1,$nRecetteId);
  }
  $stmt->execute();
  $res = $stmt->fetchAll();
  foreach ( $res as $row ) {  
    $tabIngredients = explode("\n", $row["rct_ingredients"]);     
    $tabPreparations = explode("\n", $row["rct_preparation"]);
    $sImgFavoris = "img/etoile-vide.png";
    $sLibFavoris = "Ajouter aux favoris";
    if($nClientId >0){
      $sImgFavoris = ($row["fav_rct_id"]>0?"img/etoile-pleine.png":"img/etoile-vide.png");
      $sLibFavoris = ($row["fav_rct_id"]>0?"Favoris":"Ajouter aux favoris");
    }

    
?>
<!-- deuxieme partie -->
<!-- troisieme partie -->
<div class="all-rct">
  <ul class="card-rct">
    <div class="cards">
      <li class="cards_item">
        <div class="card">
          <div class="card_image"><img src="img-recette/<?php echo $row["rct_img"] ?>" width="500px" height="300px"></div>
          <div class="card_content">
            <h2 class="card_title"><?php echo $row["rct_name"] ?></h2> <i class="fa fa-star gold"></i>
            <p class="card_text">
              <ul class="list-card">
                <li>Nombre de personne : <b><?php echo $row["rct_nb_pers"] ?></b></li>
                <li>Niveau de difficulté : <b><?php echo $row["rct_difficulty"] ?></b></li>
                <li>Temps de préparation : <b><?php echo $row["rct_time"] ?></b></li>
                <li>Gamme de prix : <b><?php echo $row["rct_price"] ?></b></li>
                <li>Type de plat : <b><?php echo $row["rct_dish"] ?></b></li>
                <li>Ajouté par : <b><?php echo $row["rct_cli_name"] ?></b></li>
              </ul>
            </p>
              <br>
              <div class="fav-div">
                <img class="img-fav" id="img_fav" src="<?php echo $sImgFavoris ?>" onclick="JsRecetteFavoris(<?=$nClientId?>,<?=$nRecetteId?>)" 
                width="50px" style="cursor:pointer";>
                <p class="pfav" id="lib_fav"><?php echo $sLibFavoris ?> </p>
              </div>
            
          </div>
        </div>
     </li>
    </div>
  </ul>
  <br>
  <br>
  <br>
      <div class="ingredients">
        <div class="ingredients-title">
          <h1><img src="img/recipe-book.png" width="40px"> Ingrédients </h1>
          <br>
          <hr>
          <br>
        </div>
        <div class="ingredients-liste">
          <ul>
          <?php
          for ($i = 0; $i < count($tabIngredients); $i += 1) 
          {
             $sIngredient = trim($tabIngredients[$i]);
             if ($sIngredient !="")
             {
              ?>
              <li><?=$sIngredient ?></li><br>
              <?php 
             }
          }    
          ?>          
        </ul>
        </div>
      </div>
      <div class="preparation">
        <div class="preparation-title">
          <h1><img src="img/cooking.png" width="40px"> Préparation </h1>
          <br>
          <hr>
          <br>
        </div>
        <div class="preparation-liste">
          <ol>
            <?php
            for ($i = 0; $i < count($tabPreparations); $i += 1) 
            {
              $sPreparation = trim($tabPreparations[$i]);
             if ($sPreparation !="")
             {
              ?>
              <li><?=$sPreparation ?></li><br>
              <?php 
             }
            }    
            ?>      
          </ol>
        </div>
      </div>
  </div>
<?php
}
?>


