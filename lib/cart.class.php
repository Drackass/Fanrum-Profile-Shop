<?php

//Classe statique, peut aussi être géré avec un singleton

class Cart {

    public static function init() {
        if (!isset($_SESSION['cartProducts'])) {
            $_SESSION['cartProducts'] = array();           
        } 
    }
    
    public static function empty() {
        $_SESSION['cartProducts'] = array();
    }

    public static function destroy() {
        unset($_SESSION['cartProducts']);
    }
    
    public static function add($productId) {
        if (!self::contains($productId)) {
            $_SESSION['cartProducts'][$productId] = 1;        
        }
    }
        
    public static function remove($productId) {
        if (array_key_exists($productId, self::get()))
             unset ($_SESSION['cartProducts'][$productId]);
    }    
    
     public static function get() {
        return $_SESSION['cartProducts'];
    }
    
    public static function count() {
        $nb = 0;
        if (isset($_SESSION['cartProducts'])) {
            $nb = count($_SESSION['cartProducts']);
        }
        return $nb;
        // ou en 1 ligne : 
         //return isset($_SESSION['cartProducts'])?count($_SESSION['cartProducts']):0;
    }

    public static function isEmpty() {
        return (self::count() == 0);
    }

    public static function contains($productId) {
        return (array_key_exists($productId, self::get()));
    }

}

Cart::init();

// ---------------------------------------------------------
// Test des services (méthodes) de la classe Cart
// ---------------------------------------------------------

// Test
//Panier::ajouterProduit(4, 2);
//Panier::ajouterProduit(11, 6);
//
//var_dump($_SESSION['cartProducts']);
//
//Panier::retirerProduit(1);
//Panier::retirerProduit(4);
//Panier::retirerProduit(11);
//var_dump(Panier::isVide());

//var_dump($_SESSION['cartProducts']);
//echo Panier::getqtyByProduit(8);

//TODO ADAPTER LES CAS ET LA VUE DU PANIER...
