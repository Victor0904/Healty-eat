<div class="login-form">
<?php                 
  $sMessageErreur = $GLOBALS["MessageErreur"];
  if($sMessageErreur!="") 
  {
?>
  <div class="alert alert-danger">
      <strong>Erreur : </strong><?php echo $sMessageErreur?>
  </div>
<?php
  }
?>             
  <form action="index.php" method="post" id="form_principal">
      <h2 class="text-center">Connexion</h2>       
      <div class="form-group">
          <input type="email" name="login" class="form-control" placeholder="Email" required="required" autocomplete="off" value="toto@gmail.com"> 
      </div>
      <div class="form-group">
          <input type="password" name="password" class="form-control" placeholder="Mot de passe" required="required" autocomplete="off" value="123Toto" >
      </div>
      <div class="form-group">
          <button type="submit" class="btn btn-success mb-2 btn-block">Connexion</button>
      </div>
      
      <div>
          <input type="text" name="page_ref" value="login_install" style="visibility:hidden"> 
      </div> 
      <input type="text" style="visibility:hidden"  id="page_ref" name="page_ref" value="account_login"></input>   
  </form>
  <div class="form-group">
         <button class="btn btn-success mb-2 btn-block" onclick="jsBtnCreerCompte()">Créer un compte</button>         
      </div>
</div> 
