function fCreateAjax() {
  var xhr_object = null;
  if (window.XMLHttpRequest) {
    xhr_object = new XMLHttpRequest();
  }
  else if (window.ActiveXObject) {
    try {
      xhr_object = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
      try {
        xhr_object = new ActiveXObject("Microsoft.XMLHTTP");
      } catch (e) {
        alert("XHR not created");
      }
    }
  }
  return xhr_object;
};
function fGetFile(psFile) {
  var xhr_object = fCreateAjax();
  if (xhr_object != null) {
    xhr_object.open("GET", psFile, false);
    xhr_object.send(null);
    if (xhr_object.readyState == 4) {
      return (xhr_object.responseText);
    }
    else {
      return ("");
    }
  }
};

function jsBtnAccueil() {    
  frm = document.getElementById("form_principal");
  document.getElementById("page_ref").value = "accueil";    
  frm.submit();
}
function jsBtnListeRecette() {
  frm = document.getElementById("form_principal");
  document.getElementById("page_ref").value = "ldr";
  frm.submit();
}
function jsBtnAjouterRecette() {
  frm = document.getElementById("form_principal");
  document.getElementById("page_ref").value = "ajout_recette";
  frm.submit();
}
function jsBtnConnexion() {
  frm = document.getElementById("form_principal");
  document.getElementById("page_ref").value = "account_login";
  frm.submit();
}
function jsBtnCreerCompte() {
  frm = document.getElementById("form_principal");
  document.getElementById("page_ref").value = "account_new";
  frm.submit();
}
function jsOuvreRecette(pnRecette) {
  frm = document.getElementById("form_principal");
  document.getElementById("page_ref").value = "une_recette";
  document.getElementById("recette").value = pnRecette;
  frm.submit();
}

function JsAccueilInit() {
  var sInnerHTML = fGetFile("accueil.php");
  document.getElementById("div_principal").innerHTML = sInnerHTML;
}

function JsClientInitRecette(psClientId) {
  var sInnerHTML = fGetFile("z_ldr.php?client=" + psClientId);
  document.getElementById("cards").innerHTML = sInnerHTML;
}
function JsClientSearchRecette(psClientId, pObjRecette) {
  var sInnerHTML = fGetFile("z_ldr.php?client=" + psClientId + "&recette=" + pObjRecette.value);
  document.getElementById("cards").innerHTML = sInnerHTML;
}
function jsBtnSearchFilter(psClientId, psFiltre) {
  var sInnerHTML = fGetFile("z_ldr.php?client=" + psClientId + "&filtre=" + psFiltre);
  document.getElementById("cards").innerHTML = sInnerHTML;
}



function JsClientSearchRecetteFavoris(rct_fav) {
  if (pnClientActive == 0) {
    document.getElementById("noFiltre").value = "3";
  }
  else if (pnClientActive == 1) {
    document.getElementById("noFiltre").value = "4";
  }
  /* toutes */
  else {
    document.getElementById("noFiltre").value = "5";
  }

  console.log(pnClientActive + "," + psInstallId);
  document.getElementById("client_name").value = "";
  document.getElementById("client_id").value = "";
  var sInnerHTML = fGetFile("z_clients.php?client_active=" + pnClientActive + "&install_id=" + psInstallId + "&nopage=" + pnNoPage);
  document.getElementById("contenu").innerHTML = sInnerHTML;
}

function JsRecetteFavoris(psClientId, psRecetteId) {
  if(psClientId == 0){
    alert("Veuillez créer un compte pour accèder a cette fonctionnalité.");
  }
  else {
    var sRetour = fGetFile("php_actions.php?action=1&client=" + psClientId + "&recette=" + psRecetteId);
    
    if(sRetour==1){
      document.getElementById("img_fav").src ="img/etoile-pleine.png";
      document.getElementById("lib_fav").innerHTML = "Favoris"; 
    }
    else{
      document.getElementById("img_fav").src = "img/etoile-vide.png";
      document.getElementById("lib_fav").innerHTML = "Ajouter aux favoris";    
    }
  }
}

function fnBtnShow() {
  document.getElementById('btn-open').style.visibility = 'hidden';
  document.getElementById('btn-close').style.visibility = 'visible';
  document.getElementById('navbar-filtrer').style.display = "";
};
function fnBtnHide() {
  document.getElementById('btn-close').style.visibility = 'hidden';
  document.getElementById('btn-open').style.visibility = 'visible';
  document.getElementById('navbar-filtrer').style.display = "none";
};  