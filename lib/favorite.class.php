<?php

/**
 * Classe statique permettant de gérer les produit en favoris d'un utilisateur
 * dans la session directement si il n'est pas encore connecté/inscrit.
 */
class Favorite {

    /**
     * Méthode permettant d'initialiser le tableau de session
     * des produit favoris ajouté par l'utilisateur non connecté.
     *
     * @return void
     */
    public static function init() {
        if(!isset($_SESSION["favorite"])) {
            $_SESSION["favorite"] = array();
        }
    }

    public static function get() {
        // Retourne le array favorite.
        return $_SESSION["favorite"];
    }

    public static function switch($id) {
        // ajoute/retire l'id du produit à l'array favorite.
        if (self::contains($id)) {
            self::remove($id);
        }
        else {
            self::add($id);
        }


    }

    public static function add($id) {
        // Ajoute l'id du produit à l'array favorite.
        // array_push($_SESSION["favorite"], $id);
        if (!self::contains($id)) {
            $_SESSION['favorite'][$id] = 1;        
        }
    }

    public static function remove($productId) {
        if (array_key_exists($productId, self::get()))
             unset ($_SESSION['favorite'][$productId]);
    }  

    public static function contains($productId) {
        return (array_key_exists($productId, self::get()));
    }

    public static function isEmpty() {
        // Vérifie si l'array favorite est vide.
        return empty($_SESSION["favorite"]);
    }

    public static function count(){
        // Retourne le nombre ligne contenue dans le tableau, si il n'existe pas ou null
        // alors retourne 0.
        return isset($_SESSION['favorite'])?count($_SESSION['favorite']):0;
    }

    public static function isFavorite($id) {
        // Vérifie si l'id du produit est déjà dans l'array favorite.
        if(self::contains($id)) {
            echo "favorite";
        }
    }
}

Favorite::init();

// $_SESSION['favorite'] = array();
// ---------------------------------------------------------
// Test des services (méthodes) de la classe Favorite
// ---------------------------------------------------------
