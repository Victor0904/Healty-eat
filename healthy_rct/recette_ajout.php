 <?php 
  $nClientId = $GLOBALS["ClientId"];  
?>
 
 <form action="index.php" method="post" enctype="multipart/form-data">
  <div class="add-all">
    <div class="add-first-container">
      <div class="add-img">
        <p>Ajouter une image :</p><input type="file" name="file" accept="image/png, image/jpeg">
      </div>
      <br>
      <div class="add-title">
        <p>Trouver un titre à votre recette :</p> <input type="text" name="RctName" max length="50">
      </div>
      <br>
      <div class="add-subjet">
        <div class="first-subjet">
          <p>Définisez un nombre de personne destiné à votre recette, avec les proportions que vous allez fournir :</p>
          <select id="nbPers" name="RctNbPersonne">
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
            <option>6</option>
            <option>7</option>
            <option>8</option>
            <option>9</option>
            <option>10</option>
            <option>10+</option>
          </select>
        </div>
        <br>
        <div class="first-subjet">
          <p>choissiez le niveau de difficulté :</p> <select type="text" name="RctDifficulty">
            <option>Facile</option>
            <option>Moyen</option>
            <option>Difficile</option>
            </select>
        </div>
        <br>
        <div class="first-subjet">
          <p>Afficher un temps de préparation moyen :</p> <select type="text" name="RctTime" >
            <option>10 minutes</option>
            <option>15 minutes</option>
            <option>20 minutes</option>
            <option>25 minutes</option>
            <option>30 minutes</option>
            <option>35 minutes</option>
            <option>40 minutes</option>
            <option>45 minutes</option>
            <option>50 minutes</option>
            <option>55 minutes</option>
            <option>1 heure</option>
            <option>1h10</option>
            <option>1h15</option>
            <option>1h20</option>
            <option>1h25</option>
            <option>1h30</option>
            <option>1h35</option>
            <option>1h40</option>
            <option>1h45</option>
            <option>1h50</option>
            <option>1h55</option>
            <option>2 heures</option>
            <option>plus de 2h</option>
          </select>
        </div>
        <br>
        <div class="first-subjet">
          <p>Choissiez une gamme de prix des ingrédients : </p><select type="text" name="RctPrice" >
            <option>Bon marché</option>
            <option>Cher</option>
          </select>
        </div>
        <br>
        <div class="first-subjet">
          <p>Sélectionnez un type de plat : </p><select type="text" name="RctDish">
            <option>Entrée</option>
            <option>Plat</option>
            <option>Dessert</option>
          </select>
      </div>
    </div>
    <div class="add-second-container">
      <div class="add-second-container-title">
        <h4><img src="img/care.png">Séparer les elements avec des retour à la lignes.</h4>
      </div>
      <div class="add-second-container-ig-pp">
        <div class="add-ingredients">
          <h4>Décrivez les ingrédients et les proportions nécessaires à votre recette :</h4>
          <textarea rows="30" cols="50" type="text" name="RctIngredients" max length="1000" size="110"  ></textarea>
        </div>
        <div class="add-preparation">
        <h4>Décrivez la préparation nécessaires à votre recette :</h4>
        <textarea rows="30" cols="50" type="text" name="RctPreparation" max length="1000" size="110"></textarea>
        </div>
      </div>
    </div>
  </div>
  <div class="btnboxsubmit">
    <button class="addrecette" type="submit"> Ajouter ma recette !</button>
  </div>
  <div>
    <input type="text" name="page_ref" value="recette_create" style="visibility:hidden"> 
    <input type="text" style="visibility:hidden"  id="client" name="client" value="<?=$nClientId?>"></input>
  </div>  
</form>

