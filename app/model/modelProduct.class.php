<?php

class modelProduct extends modelePDO {
  
  /**
   * Retourne les occurences de la table category.
   */
  public static function readAll()
  {
    return self::getTuplesByTable("product");
  }
  
  
  /**
   * Ajoute un tuple dans la table category.
  * @param array $values Les valeurs à insérer.
  */
  public static function insert($values)
  {
    self::insertQuery("product", $values);
  }
  
  /**
   * Ajoute un tuple dans la table category.
   * @param array $values Les valeurs à insérer.
   * @param string $condition La condition pour sélectionner le tuple à modifier.
   */
  public static function update($values, $condition)
  {
    self::updateQuery("product", $values, $condition);
  }
  
  /**
   * Ajoute un tuple dans la table category.
   * @param string $condition La condition pour sélectionner le tuple à supprimer.
   */
  public static function delete($condition)
  {
    self::deleteQuery("product", $condition);
  }
  
  /**
   * Effectue une recherche de tuples dans la table category en utilisant tous les champs.
   * @param string $searchValue La valeur à rechercher dans les champs de la table.
   * @return array Résultat de la recherche.
   */
  public static function search($searchValue)
  {
    return self::searchQuery("product", $searchValue);
  }
  
  /**
   * Retourne le nombre de category.
   * @return int nombre d'occurences de la table category.  
   */ 
  public static function count() {
    return self::getNbTuples("product");
  }

  /**
   * Retourne un produit suivant son id.
   * @param int $id l'id du produit a rechercher.
   * @return object Première occurence de la table produit trouvé. 
   */ 
  public static function getProductById($id) {
    return self::getFirstTupleByField("product","id",$id);
  }

  /**
   * Retourne un produit suivant son id.
   * @param int $userId l'id du user a rechercher.
   * @return object array occurences de la table produit trouvé. 
   */ 
  public static function getProductsByUserId($userId) {
    return self::selectQuery("*","product","userId = ".$userId);
  }

  
  public static function getImgByProductId($productId) {
    return self::getFirstAttributeByField("product", "image", "id", $productId);
  }


  public static function searchCategoy($search,$category) {
    return self::selectQuery("*","product","categoryId LIKE '".$category."' AND NAME LIKE '%".$search."%'");
  }

  public static function BuyProducts($productId,$userId) {
    $values = array(
      "userId" => $userId);
    return self::updateQuery("product",$values,"id=".$productId);
  }
  
}

// ---------------------------------------------------------
// Test des services (méthodes) de la classe model
// ---------------------------------------------------------

// Test