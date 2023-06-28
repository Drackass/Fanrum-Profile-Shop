<?php

class ControllerCart {
    
    public function __construct() {
    }
    
    public static function add() {
        Cart::add($_REQUEST['productId']);
        Utils::putAlert(modelProduct::getProductById($_REQUEST['productId'])->name." a bien été ajouté a votre panier", "success", Utils::getPreviousURI());
    }
    
    public static function remove() {
        Cart::remove($_REQUEST['productId']);
        Utils::putAlert(modelProduct::getProductById($_REQUEST['productId'])->name." a bien été retiré de votre panier", "success", Utils::getPreviousURI());
    }

    public static function empty() {
        Cart::empty();
        Utils::putAlert("Votre panier est maintenant vide", "success", Utils::getPreviousURI());

    }
}
?>