<?php

class controllerIdentification{

  public function __construct()
  {
  }

  public function logOff() {
    // Supression des variables de session et de la session
    $_SESSION = array(); //Initialise le tableau de session vide donc à 0
    session_destroy(); //Destruction de la session en cours
    setcookie('id_user', ''); //Supression du cookie id_user en supprimant sont contenue.
    setcookie('is_admin', '');
    Utils::putAlert("Déconnexion réussie", "success", "index.php?controller=Identification&action=showLogin");
    
  }
  
  public static function showLogin() {
    Utils::showContentWithCustomPage("Identification 🏷️","Identification",Path::V_FRONTEND."v_login.inc.php");
  }
  
  public static function showRegister() {
    Utils::showContentWithCustomPage("Inscription ✒️","Inscription",Path::V_FRONTEND."v_register.inc.php");
  }
  
  public function checkConnection() {
    if (modelUser::isRegistered($_POST['email'], $_POST['password'])) //Si la méthode retourne "true"
    {
      $_SESSION['id_user'] = modelUser::getUserId($_POST['email']);
      
      if (isset($_POST['autoLog']))
      {
        setcookie('id_user', $_SESSION['id_user'], time() + 7*24*3600, null, null, false, true); // Le cookie sera sauvegader une semaine
        
      }
        if (modelUser::isAdmin($_POST['email'], $_POST['password'])) {
          $_SESSION['is_admin'] = "yes";
          if (isset($_POST['autoLog'])) {
            setcookie('is_admin', $_SESSION['is_admin'], time() + 7*24*3600, null, null, false, true);
          }
          Utils::putAlert("Connexion réussie", "success", "index.php");
          
        }
        else {
          Utils::putAlert("Connexion réussie", "success", "index.php");
          
        }
      }
      else
      {
        Utils::putAlert("Email ou mot de passe incorrect", "error", Utils::getPreviousURI());
      }
    }
      

  }
  