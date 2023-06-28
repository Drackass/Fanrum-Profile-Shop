<?php

class ControllerFavorite {
    
    public function __construct() {
    }

    public function show(){
        GlobalVariables::$categories = modelCategory::readAll();
        $productsId = array_keys($_SESSION['favorite']);
        GlobalVariables::$products = array();
        foreach ($productsId as $key=>$id) {
          $theProduct = modelProduct::getProductById($id);
          GlobalVariables::$products[] = $theProduct;
        }
        Utils::showContentWithCustomPage("Mes Favoris 📌","Products / Favorites",Path::V_FRONTEND."v_home.inc.php");
      }
    
    public static function switch() {
        Favorite::switch($_REQUEST['productId']);
        if (favorite::contains($_REQUEST['productId'])) {
          Utils::putAlert(modelProduct::getProductById($_REQUEST['productId'])->name." a bien été ajouté a votre liste de favoris", "success", Utils::getPreviousURI());
        }
        else {
          Utils::putAlert(modelProduct::getProductById($_REQUEST['productId'])->name." a bien été retiré de votre liste de favoris", "success", Utils::getPreviousURI());
        }
    }
}
?>