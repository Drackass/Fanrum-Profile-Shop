<?php

class controllerProduct{
  
  public function __construct()
  {
  }

  public function searchCategory() {
    GlobalVariables::$categories = modelCategory::readAll();
    $theCategory = $_GET['category'];
    GlobalVariables::$products = modelProduct::searchCategoy($_GET['search'], empty($theCategory) ? "%" : $theCategory);
    Utils::showContentWithCustomPage("SAUZET SHOP 👋","Products",Path::V_FRONTEND."v_home.inc.php");
}


  public function BuyProducts() {
    if (isset($_SESSION['id_user'])) {
      foreach (array_keys($_SESSION['cartProducts']) as $key=>$id) {
        modelProduct::BuyProducts($id,$_SESSION['id_user']);
  
      }
      Cart::empty();
      Utils::putAlert("Merci de votre achat", "success", Utils::getPreviousURI());
    }
    else {
      Utils::putAlert("Merci de bien vouloir vous connecter", "error", "index.php?controller=Identification&action=showLogin");
    }


  }


}