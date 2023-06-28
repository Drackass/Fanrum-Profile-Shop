<?php

class controllerUser{
  
  public function __construct()
  {
  }
  
  public function showProfileUser() {
    if (isset($_GET['userId'])) {
      GlobalVariables::$theUser = modelUser::getUserById($_GET['userId']);
      GlobalVariables::$profilePicture = Path::IMG_PRODUCT.modelProduct::getImgByProductId(GlobalVariables::$theUser->picture);
      GlobalVariables::$ProductsUser = modelproduct::getProductsByUserId($_GET['userId']);
      if (isset($_SESSION['id_user'])) {
        GlobalVariables::$isOwnerProfile = ($_GET['userId'] == $_SESSION['id_user']) ? true : false;
        
      }
      $forPath = (GlobalVariables::$isOwnerProfile)?"Mon Profil":"Profil de @".GlobalVariables::$theUser->pseudo;
      Utils::showContentWithCustomPage("Mon profil 🗿","Profil Utilisateur / ".$forPath,Path::V_FRONTEND."v_user_profile.inc.php");

    }
    else{
      if (isset($_SESSION['id_user'])) {
        GlobalVariables::$theUser = modelUser::getUserById($_SESSION['id_user']);
        GlobalVariables::$profilePicture = Path::IMG_PRODUCT.modelProduct::getImgByProductId(GlobalVariables::$theUser->picture);
        GlobalVariables::$ProductsUser = modelproduct::getProductsByUserId($_SESSION['id_user']);
        GlobalVariables::$isOwnerProfile = true;
        Utils::showContentWithCustomPage("Mon profil 🗿","Profil Utilisateur / Mon profil",Path::V_FRONTEND."v_user_profile.inc.php");
      }
      else {
        Utils::putAlert("Merci de bien vouloir vous connecter", "error", "index.php?controller=Identification&action=showLogin");
      }

    }
  }
  
  public function delete() {
    modelUser::delete();
    $_SESSION = array(); //Initialise le tableau de session vide donc à 0
    session_destroy(); //Destruction de la session en cours
    setcookie('id_user', ''); //Supression du cookie id_user en supprimant sont contenue.
    setcookie('is_admin', '');
    Utils::putAlert("suppression du compte réussie", "success", "index.php");
  }
  
  public function add() {
    $values = array(
      "pseudo" => $_POST['pseudo'],
      "email" => $_POST['email'],
      "password" => sha1($_POST['password']));
    modelUser::insert($values);
    Utils::putAlert("le compte a bien été crée", "success", "index.php?controller=Identification&action=showLogin");
  }
  
  public function updateProfile() {
    $values = array(
      "pseudo" => $_POST['pseudo'],
      "picture" => $_POST['selected-image-id'],
      "description" => $_POST['profile-description']);
      modelUser::updateProfile($values);
    Utils::putAlert("le compte a bien été mis a jour", "success", Utils::getPreviousURI());
  }
}