     
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
          <input type="email" name="login" class="form-control" placeholder="email" required="required" autocomplete="off" > 
      </div>
      <div class="form-group">
          <input type="username" name="username" class="form-control" placeholder="username" required="required" autocomplete="off" > 
      </div>
      <div class="form-group">
          <input type="password" name="password" class="form-control" placeholder="Mot de passe" required="required" autocomplete="off" >
      </div>
      <div class="form-group">
          <input type="password" name="repeat_password" class="form-control" placeholder="Confirmer le mot de passe" required="required" autocomplete="off" >
      </div>
      <div class="form-group">
          <button type="submit" class="btn btn-success mb-2 btn-block">Créer un compte</button>
      </div>
     <div>
          <input type="text" name="page_ref" value="account_create" style="visibility:hidden"> 
      </div>   
  </form>
</div> 
