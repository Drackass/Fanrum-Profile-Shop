<?php

class modelCategory extends modelePDO {
  
  /**
   * Retourne les occurences de la table category.
   */
  public static function readAll()
  {
    return self::getTuplesByTable("category");
  }
  
  
  /**
   * Ajoute un tuple dans la table category.
  * @param array $values Les valeurs à insérer.
  */
  public static function insert($values)
  {
    self::insertQuery("category", $values);
  }
  
  /**
   * Ajoute un tuple dans la table category.
   * @param array $values Les valeurs à insérer.
   * @param string $condition La condition pour sélectionner le tuple à modifier.
   */
  public static function update($values, $condition)
  {
    self::updateQuery("category", $values, $condition);
  }
  
  /**
   * Ajoute un tuple dans la table category.
   * @param string $condition La condition pour sélectionner le tuple à supprimer.
   */
  public static function delete($condition)
  {
    self::deleteQuery("category", $condition);
  }
  
  /**
   * Effectue une recherche de tuples dans la table category en utilisant tous les champs.
   * @param string $searchValue La valeur à rechercher dans les champs de la table.
   * @return array Résultat de la recherche.
   */
  public static function search($searchValue)
  {
    return self::searchQuery("category", $searchValue);
  }
  
  /**
   * Retourne le nombre de category.
   * @return int nombre d'occurences de la table category.  
   */ 
  public static function count() {
    return self::getNbTuples("category");
  }
  
}

// ---------------------------------------------------------
// Test des services (méthodes) de la classe model
// ---------------------------------------------------------

// Test