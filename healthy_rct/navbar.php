<div class="box-title">
  <?php 
  if($GLOBALS["ClientId"]>0) 
       {?>
  <div class="deconnexion">
  <a href="index.php">
    <button class="btn-dc">
    Déconnexion
    <button>
  </a>
  </div>
   <?php
       }
   ?> 
<div class="title">
  <h1>Healthy-eat</h1>
  <h2>Mangez mieux, mangez heureux</h2>
</div>
</div>
<br>
<hr>
<!-- premiere partie -->
<!-- deuxieme partie -->
 <nav class="navbar">
  
      <button class="btn-nav" onclick="jsBtnAccueil()">à propos des recette healthy ? </button>
      <button class="btn-nav" onclick="jsBtnListeRecette()">liste des recettes</button>
      <?php 
       if($GLOBALS["ClientId"]>0) 
       {?>
         <button class="btn-nav" onclick="jsBtnAjouterRecette()">Ajouter une recette</button>                    
        <?php
       }
       else 
      {?>  
          <button class="btn-nav" onclick="jsBtnConnexion()">Connexion/crée un compte</button>       
       <?php
      }
      ?>  
</nav> 
<br>
<br>
<br>
