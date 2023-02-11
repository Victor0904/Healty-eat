<?php 
  $nClientId = $GLOBALS["ClientId"];
  $sClientName = $GLOBALS["ClientName"];


$dt = new \DateTime();
$sH = $dt->format('H');
$nH = (int)$sH;
$sBonjourBonsoir = ($nH<14 ?'Bonjour' : 'Bonsoir' );
$sMidiSoir = ($nH<14 ?'midi' : 'soir' );
?>

 <h3><?=$sBonjourBonsoir?> <?=$sClientName?>, qu'allez vous préparer ce <?=$sMidiSoir?> ?</h3>
<div class="btn-CO-box">
  <div class="btn-close" id="btn-close">
    <img src="img/close.png" onclick="fnBtnHide()">
  </div>
  <div class="btn-open" id="btn-open" style="visibility: hidden;">
    <img src="img/open.png" onclick="fnBtnShow()">
  </div>
</div>
<div class="search-navbar" id="navbar-filtrer">
  <div class="first-select">
    <input class="input-choice" name="client_name" id="client_name" type="text" placeholder="Rechercher une recette"
      onkeyup="JsClientSearchRecette('<?=$nClientId?>',this)"></input>

    <button class="btn-choice" id="Favoris" onclick="jsBtnSearchFilter('<?=$nClientId?>', 'favoris')">
      favoris
    </button>
    
    <button class="btn-choice" id="random" onclick="jsBtnSearchFilter('<?=$nClientId?>', 'random')">
      Découvrir une recette ?
    </button>

    <button class="btn-choice" id="all" onclick="jsBtnSearchFilter('<?=$nClientId?>', 'all')">
      Toutes les recettes
    </button>
  </div>
 
  <div class="second-select">
    <h2>Votre gamme de prix </h2>
    <button class="btn-choice" id="price_cheap" onclick="jsBtnSearchFilter('<?=$nClientId?>', 'price_cheap')">
      Bon marché
    </button>
    <button class="btn-choice" id="price_expensive" onclick="jsBtnSearchFilter('<?=$nClientId?>', 'price_expensive')">
      Cher
    </button>
  </div>

  <div class="thrid-select">
    <h2>Votre difficulté</h2>
    <button class="btn-choice" id="easy" onclick="jsBtnSearchFilter('<?=$nClientId?>', 'easy' )">
      Facile
    </button>
    <button class="btn-choice" id="normal" onclick="jsBtnSearchFilter('<?=$nClientId?>', 'normal' )">
      Moyen
    </button>
    <button class="btn-choice" id="hard" onclick="jsBtnSearchFilter('<?=$nClientId?>', 'hard' )">
      Difficile
    </button>
  </div>
   <div class="fourth-select">
    <h2>Votre type de repas</h2>
    <button class="btn-choice" id="starter" onclick="jsBtnSearchFilter('<?=$nClientId?>', 'starter' )">
      Entrée
    </button>
    <button class="btn-choice" id="dish" onclick="jsBtnSearchFilter('<?=$nClientId?>', 'dish' )">
      Plat
    </button>
    <button class="btn-choice" id="dessert" onclick="jsBtnSearchFilter('<?=$nClientId?>', 'dessert' )">
      Dessert
    </button>
  </div>
</div>
<!-- deuxieme partie -->

<!-- troisieme partie -->

  <div class="main">
  <h1>Liste des Recettes </h1>
  <br>
  <ul class="cards" id="cards">
    
  </ul>
</div>


