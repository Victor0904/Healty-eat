<?php 
  require_once "BddConnect.php";
  require_once "php_utiles.php";

  $nClientId = 0;
  $nRecetteId = 0;

  $page_ref = "ldr";
  if(isset($_POST['page_ref']))
  {
    $page_ref = $_POST['page_ref'];    
  }
  if(isset($_POST['client']))
  {
    $nClientId = $_POST['client'];    
  }
  if(isset($_POST['recette']))
  {
    $nRecetteId = $_POST['recette'];    
  }

 $GLOBALS["MessageErreur"] = "";
 
 if($page_ref == "account_login")
 {
  if(isset($_POST['login'])) 
    {
      $nClientId = PhpVerifLoginClient($_POST['login'],$_POST['password']);
      if($nClientId>0)
      {
        $page_ref = "ldr";
      }
      else 
      {
        $GLOBALS["MessageErreur"] = "Impossible de vous connnecter";
      }
    }
 }

 if($page_ref == "account_create")
 {
    if(isset($_POST['login'])) 
    {
      $nClientId = PhpTestLoginClient($_POST['login']);
      if($nClientId>0)
      {
        $GLOBALS["MessageErreur"] =  "Nom d'utilisateur déjà existant";         
      }
      else 
      {
        $nClientId = PhpInsertLoginClient($_POST['login'], $_POST['username'], $_POST['password']);
        if($nClientId>0)
        {      
           $page_ref = "ldr";
        }
      }
    }
  }
  
 if($page_ref == "account_new")  
 {
    $page_ref ="account_create";
 }

 $GLOBALS["ClientId"] = $nClientId;
 $GLOBALS["RecetteId"] = $nRecetteId;
 $GLOBALS["ClientName"] = PhpGetClientName($nClientId);

 if($page_ref == "recette_create")  
 {
   if(isset($_FILES['file'])){

      $sFileTmpName = $_FILES['file']['tmp_name'];
      $sFileName = $_FILES['file']['name'];
      $nFileSize = $_FILES['file']['size'];
      $sFileError = $_FILES['file']['error'];

      $sRctClientName = $GLOBALS["ClientName"];

      $sRctImage = PhpRecetteInsert(
                                  $sRctClientName
                                  ,$_POST['RctName'] 
                                  ,$sFileName   // déjà rempli
                                  ,$_POST['RctNbPersonne'] 
                                  ,$_POST['RctTime']             
                                  ,$_POST['RctDifficulty']               
                                  ,$_POST['RctPrice']            
                                  ,$_POST['RctDish']       
                                  ,$_POST['RctIngredients']            
                                  ,$_POST['RctPreparation']             
                                );

      move_uploaded_file($sFileTmpName, 'img-recette/'.$sRctImage);
      $page_ref = "ldr";
    }

  }

   $bNavBar = true;
  if($page_ref == "account_login" || $page_ref == "account_create")
  {   
    $bNavBar = false;   
  }
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Healthy-eat</title>
  <?php
    if($bNavBar)
    {   
    ?><link rel="stylesheet" href="css/navbar.css"><?php
    }
    if($page_ref == "accueil")
    { 
      ?><link rel="stylesheet" href="css/index.css"><?php   
    }
    if($page_ref == "ldr")
    {   
      ?><link rel="stylesheet" href="css/ldr.css"><?php       
    }
    if($page_ref == "une_recette")
    {
      ?><link rel="stylesheet" href="css/rct.css"><?php     
    }
     if($page_ref == "ajout_recette")
    {
      ?><link rel="stylesheet" href="css/addr.css"><?php     
    }
    if($page_ref == "account_login" || $page_ref == "account_create")
    {      
      ?>
       <link rel="stylesheet" href="css/login.css">
       <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
      <?php     
    }
  ?>  
  <script src="script.js"></script>
</head>
<body>

<?php 


  if ($bNavBar)
  {
    include 'navbar.php';
  }

  if($page_ref == "accueil")
    { 
      include 'accueil.php';  
    }
    if($page_ref == "ldr")
    {   
      include 'ldr.php';
    }
    if($page_ref == "account_login")
    {       
      include 'acc_login.php';
    }
    if($page_ref == "account_create")
    {       
      include 'acc_create.php';
    }
    if($page_ref == "ajout_recette")
    {   
      include 'recette_ajout.php';
    }  
    if($page_ref == "une_recette")
    {   
      include 'recette.php';
    }
  
    if($bNavBar)
    {  
?>
      <div name="div_principal">  
      </div>
        
        <form action="index.php" method="post" id="form_principal">
            <input type="text" style="visibility:hidden"  id="page_ref" name="page_ref" value="accueil"></input>
            <input type="text" style="visibility:hidden"  id="client" name="client" value="<?=$nClientId?>"></input>
            <input type="text" style="visibility:hidden"  id="recette" name="recette" value="<?=$nRecetteId?>"></input>
        </form>
      <?php
    }
 ?> 
</body>
<script>
<?php 
    if($page_ref == "accueil")
    { 
      ?>JsAccueilInit()<?php  
    }
    if($page_ref == "ldr")
    {   
      ?> JsClientInitRecette('<?=$nClientId?>');<?php  
    }
    if($page_ref == "recette")
    {   
      include 'recette.php';
    }  
?>
</script>
</html>