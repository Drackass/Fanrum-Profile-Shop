<?php

class modelUser extends modelePDO {
  
  /**
   * Retourne les occurences de la table category.
   */
  public static function readAll()
  {
    return self::getTuplesByTable("user");
  }
  
  
  /**
   * Ajoute un tuple dans la table category.
  * @param array $values Les valeurs à insérer.
  */
  public static function insert($values)
  {
    self::insertQuery("user", $values);
  }
  
  /**
   * Ajoute un tuple dans la table category.
   * @param array $values Les valeurs à insérer.
   * @param string $condition La condition pour sélectionner le tuple à modifier.
   */
  public static function update($values, $condition)
  {
    self::updateQuery("user", $values, $condition);
  }

  public static function updateProfile($values){
    self::updateQuery("user", $values, "id=".$_SESSION['id_user']);

  }
  
  /**
   * Ajoute un tuple dans la table category.
   * @param string $condition La condition pour sélectionner le tuple à supprimer.
   */
  public static function delete()
  {
    self::deleteTupleByField("user","id",$_SESSION['id_user']);
  }
  
  /**
   * Effectue une recherche de tuples dans la table category en utilisant tous les champs.
   * @param string $searchValue La valeur à rechercher dans les champs de la table.
   * @return array Résultat de la recherche.
   */
  public static function search($searchValue)
  {
    return self::searchQuery("user", $searchValue);
  }
  
  /**
   * Retourne le nombre de category.
   * @return int nombre d'occurences de la table category.  
   */ 
  public static function count() {
    return self::getNbTuples("user");
  }
  
  /**
  * Fonction permettant de vérifier si l'utilisateur est administrateur.
  *
  * @param string $email
  * @param string $password
  * @return boolean
  */
  public static function isAdmin($email, $password)
  {
    self::init();
    self::$query = "SELECT * FROM user WHERE email = :email AND password = :password AND isAdmin = 1";
    self::$pdoStatementResults = self::$pdoDbConnection->prepare(self::$query);
    self::$pdoStatementResults->bindValue(":email", $email);
    self::$pdoStatementResults->bindValue(":password", sha1($password));
    self::$pdoStatementResults->execute();
    self::$result = self::$pdoStatementResults->fetch();
    self::$pdoStatementResults->closeCursor();
    return (self::$result != null);
  }
  
    /**
     * Fonction permettant de vérifier la si l'utilisateur est enregistré.
     *
     * @param string $email
     * @param string $password
     * @return boolean
     */
    public static function isRegistered($email, $password)
    {
      self::init();
      self::$query = "SELECT * FROM user WHERE email = :email AND password = :password";
      self::$pdoStatementResults = self::$pdoDbConnection->prepare(self::$query);
      self::$pdoStatementResults->bindValue(":email", $email);
      self::$pdoStatementResults->bindValue(":password", sha1($password));
      self::$pdoStatementResults->execute();
      self::$result = self::$pdoStatementResults->fetch();
      self::$pdoStatementResults->closeCursor();
      return (self::$result != null);
      
    }
    
    public static function getUserId($email) {
      return self::getFirstAttributeByField("user", "id", "email", $email);
    }
    
    public static function getUserById($id) {
      return self::getFirstTupleByField("user", "id", $id);
    }
    
    public static function getPseudoById($userId){
      return self::getFirstAttributeByField("user","pseudo","id",$userId);
    }

    public static function getProfilePicture(){
      $thePicture = Path::IMG_PRODUCT."Template.jpg";
      if (isset($_SESSION['id_user'])) {
        $user = self::getUserById($_SESSION['id_user']);
        $thePicture = Path::IMG_PRODUCT.modelProduct::getProductById($user->picture)->image;
      }

      return $thePicture;
    }
  }
    
    
    // ---------------------------------------------------------
    // Test des services (méthodes) de la classe model
// ---------------------------------------------------------

// Test