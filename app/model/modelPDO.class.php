<?php

require_once Path::DATABASE . 'mysql_config.class.php';

/**
 *  Classe mère modelePDO généraliste pour la gestion des BDD
 *  Méthodes génériques et réusitilisable.
 */
class modelePDO {

    // Champs en protected sont visible dans la classe de définition (modelePDO)
    // et dans les classes dérivées (fille).

    //Attributs utiles pour la connexion
    protected static $hostname = MySqlConfig::HOSTNAME;
    protected static $database = MySqlConfig::DATABASE;
    protected static $login = MySqlConfig::LOGIN;
    protected static $password = MySqlConfig::PASSWORD;

    //Attributs utiles pour la manipulation PDO de la BD
    protected static $pdoDbConnection = null;
    protected static $pdoStatementResults = null;
    protected static $query = "";
    protected static $result = null;

    /**
     * Méthode statique (s'appelle avec nomDeLaClasse::) permettant de se connecter à la BDD.
     */
    protected static function init()
    {
        if (!isset(self::$pdoDbConnection)) { //S'il n'y a pas encore eu de connexion
            try {
                self::$pdoDbConnection = new PDO('mysql:host=' . self::$hostname . ';dbname=' . self::$database . ';charset=utf8mb4', self::$login, self::$password);
                self::$pdoDbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$pdoDbConnection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
                self::$pdoDbConnection->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES utf8mb4");
            } catch (Exception $e) {
                echo 'Erreur : ' . $e->getMessage() . '<br />'; // méthode de la classe Exception
                echo 'Code : ' . $e->getCode(); // méthode de la classe Exception
            }
        }
    }

    /**
     * Méthode statique permettant de se deconnecter à la BDD.
     */
    protected static function disconnect()
    {
        // Si on n'appelle pas la méthode, la déconnexion a lieu en fin de script
        self::$pdoDbConnection = null;
    }

    /**
     * Fonction perméttant de recupérer les tuples d'une table d'une base de données.
     * @param string $table Nom de la table.
     * @return object array Occureences de la table en question.
     */
    public static function getTuplesByTable($table)
    {
        self::init();
        self::$query = "SELECT * FROM " . $table;
        self::$pdoStatementResults = self::$pdoDbConnection->prepare(self::$query);
        self::$pdoStatementResults->execute();
        self::$result = self::$pdoStatementResults->fetchAll(PDO::FETCH_OBJ);
        self::$pdoStatementResults->closeCursor();
        return self::$result;
    }

    /**
    * Permet de récupérer le nom des tables dans la base.
    * @return object Les noms des tables de la BDD.
    */
    public static function getTableNames() {
        self::init();
        self::$query = "SHOW TABLES";
        self::$pdoStatementResults = self::$pdoDbConnection->prepare(self::$query);
        self::$pdoStatementResults->execute();
        self::$result = self::$pdoStatementResults->fetchAll();
        self::$pdoStatementResults->closeCursor();
        return self::$result;
    }

    /**
     * @param string $table Nom de la table
     * @param string $fieldName Nom du champ (attribute).
     * @param string $fieldValue Valeur du champ (attribute).
     * @return object Première occurence de la table.
     */
    protected static function getFirstTupleByField($table, $fieldName, $fieldValue)
    {
        self::init();
        self::$query = "SELECT * FROM " . $table . " WHERE " . $fieldName . " = :fieldValue";
        self::$pdoStatementResults = self::$pdoDbConnection->prepare(self::$query);
        self::$pdoStatementResults->bindValue(':fieldValue', $fieldValue);
        self::$pdoStatementResults->execute();
        self::$result = self::$pdoStatementResults->fetch(PDO::FETCH_OBJ);
        self::$pdoStatementResults->closeCursor();
        return self::$result; //un seul tuple retourné : utilisation de fetch()
    }

    /**
     * 
     * @param string $table Nom de la table
     * @param string $attribute Nom de l'attribut
     * @param string $fieldName Nom du champ (attribute).
     * @param string $fieldValue Valeur du champ (attribute).
     * @return object Première occurence de la table.
     */
    protected static function getFirstAttributeByField($table, $attribute, $fieldName, $fieldValue)
    {
        self::init();
        self::$query = "SELECT $attribute FROM " . $table . " WHERE " . $fieldName . " = :fieldValue";
        self::$pdoStatementResults = self::$pdoDbConnection->prepare(self::$query);
        self::$pdoStatementResults->bindValue(':fieldValue', $fieldValue);
        self::$pdoStatementResults->execute();
        self::$result = self::$pdoStatementResults->fetch();
        self::$pdoStatementResults->closeCursor();
        return self::$result->$attribute; //un seul tuple retourné : utilisation de fetch()
    }

    /**
     * 
     * @param string $table Nom de la table
     * @param string $fieldName Nom du champ (attribute).
     * @param string $fieldValue Valeur du champ (attribute).
     */
    protected static function deleteTupleByField($table, $fieldName, $fieldValue)
    {
        self::init();
        self::$query = "DELETE FROM " . $table . " WHERE " . $fieldName . " = :fieldValue";
        self::$pdoStatementResults = self::$pdoDbConnection->prepare(self::$query);
        self::$pdoStatementResults->bindValue(':fieldValue', $fieldValue);
        self::$pdoStatementResults->execute();
    }

    /**
     * 
     * @param type $table Nom de la table
     * @return type
     */
    public static function getTupleCount($table)
    {
        self::init();
        self::$query = "SELECT COUNT(*) AS nbTuples FROM " . $table;
        self::$pdoStatementResults = self::$pdoDbConnection->prepare(self::$query);
        self::$pdoStatementResults->execute();
        self::$result = self::$pdoStatementResults->fetch();
        self::$pdoStatementResults->closeCursor();
        return self::$result->nbTuples;
    }

    /**
     * Fonction perméttant d'éffectuer une requête select.
     * @param type $field Nom des ou du champ.
     * @param type $tables Nom des ou de la table.
     * @param type $condition Condition.
     * @return object array Occurences de la table.
     */
    protected static function selectQuery($fields, $tables, $condition = null)
    {
        self::init();
        $query = "SELECT " . $fields . " FROM " . $tables;
        $params = array();
    
        if ($condition !== null) {
            $query .= " WHERE " . $condition;
            preg_match_all('/:\w+/', $condition, $matches);
            $params = $matches[0];
        }
    
        self::$pdoStatementResults = self::$pdoDbConnection->prepare($query);
    
        // Lier les paramètres à la requête préparée
        for ($i = 0; $i < count($params); $i++) {
            self::$pdoStatementResults->bindValue(($i + 1), $params[$i]);
        }
    
        self::$pdoStatementResults->execute();
        self::$result = self::$pdoStatementResults->fetchAll(PDO::FETCH_OBJ);
        self::$pdoStatementResults->closeCursor();
        return self::$result;
    }
    
    
    
    

    // protected static function selectQuery($field, $tables, $condition = null)
    // {
    //     self::init();
    //     self::$query = "SELECT " . $field . " FROM " . $tables;
    //     // Si il y'a une condition alors on rajoute à la fin de la requête.
    //     if ($condition != null) {
    //         self::$query .= " WHERE " . $condition;
    //     }
    //     self::$pdoStatementResults = self::$pdoDbConnection->prepare(self::$query);
    //     self::$pdoStatementResults->execute();
    //     self::$result = self::$pdoStatementResults->fetchAll(PDO::FETCH_OBJ);
    //     self::$pdoStatementResults->closeCursor();
    //     return self::$result;
    // }

    protected static function preparedSelectQuery($name)
    {
        self::init();
        self::$query = "$name";
        // Si il y'a une condition alors on rajoute à la fin de la requête.
        self::$pdoStatementResults = self::$pdoDbConnection->prepare(self::$query);
        self::$pdoStatementResults->execute();
        self::$result = self::$pdoStatementResults->fetchAll(PDO::FETCH_OBJ);
        self::$pdoStatementResults->closeCursor();
        return self::$result;
    }
    
    public static function insertQuery($table, $values)
    {
        self::init();
        $fields = self::getFieldNamesByTableInsert($table);
    
        // Récupérer les informations sur les colonnes de la table
        $columnsInfo = self::getColumnInfo($table);
    
        // Filtrer les champs pour exclure ceux avec une valeur par défaut
        $fields = array_filter($fields, function ($field) use ($columnsInfo) {
            return !isset($columnsInfo[$field]['default']);
        });
    
        // Générer les placeholders pour les valeurs à insérer
        $placeholders = ":" . implode(", :", $fields);
    
        self::$query = "INSERT INTO $table (" . implode(", ", $fields) . ") VALUES ($placeholders)";
        self::$pdoStatementResults = self::$pdoDbConnection->prepare(self::$query);
    
        foreach ($fields as $field) {
            // Vérifier si l'attribut est présent dans le tableau $values
            if (isset($values[$field])) {
                self::$pdoStatementResults->bindValue(":$field", $values[$field]);
            } else {
                // Sinon, spécifier la valeur NULL pour les attributs manquants
                self::$pdoStatementResults->bindValue(":$field", NULL, PDO::PARAM_NULL);
            }
        }
    
        self::$pdoStatementResults->execute();
    }
    
    public static function getColumnInfo($table)
    {
        self::init();
        $query = "DESCRIBE $table";
        self::$query = $query;
        self::$pdoStatementResults = self::$pdoDbConnection->prepare(self::$query);
        self::$pdoStatementResults->execute();
        $columnsInfo = self::$pdoStatementResults->fetchAll(PDO::FETCH_ASSOC);
        
        $result = array();
        foreach ($columnsInfo as $column) {
            $fieldName = $column['Field'];
            $result[$fieldName] = array(
                'type' => $column['Type'],
                'default' => $column['Default']
            );
        }
        
        return $result;
    }
                      
    /**
    * Modifie un tuple dans une table spécifiée.
    * @param string $table Nom de la table.
    * @param array $values Les nouvelles valeurs à mettre à jour.
    * @param string $condition La condition pour sélectionner le tuple à modifier.
    */
    public static function updateQuery($table, $values, $condition)
    {
        self::init();
        $columnsInfo = self::getColumnInfo($table);
    
        // Obtenir tous les champs du tableau $values
        $fields = array_keys($values);
    
        // Générer la clause SET pour la mise à jour des champs
        $setClause = implode(", ", array_map(function ($field) {
            return "$field = :$field";
        }, $fields));
    
        self::$query = "UPDATE $table SET $setClause WHERE $condition";
        self::$pdoStatementResults = self::$pdoDbConnection->prepare(self::$query);
    
        foreach ($fields as $field) {
            // Vérifier si l'attribut est présent dans le tableau $values
            if (isset($values[$field])) {
                self::$pdoStatementResults->bindValue(":$field", $values[$field]);
            } else {
                // Sinon, spécifier la valeur actuelle pour les attributs manquants
                self::$pdoStatementResults->bindValue(":$field", NULL, PDO::PARAM_NULL);
            }
        }
    
        self::$pdoStatementResults->execute();
    }
    

    /**
     * Fonction perméttant d'éffectuer une requête delete.
     * @param type $table Nom de la table.
     * @param type $condition Les condition.
     */
    protected static function deleteQuery($table, $condition)
    {
        self::init();
        self::$query = "DELETE FROM " . $table . " WHERE " . $condition;
        self::$pdoStatementResults = self::$pdoDbConnection->prepare(self::$query);
        self::$pdoStatementResults->execute();
    }
    
    /**
    * Effectue une recherche de tuples dans une table spécifiée en utilisant tous les champs.
    * @param string $table Nom de la table.
    * @param string $searchValue La valeur à rechercher dans les champs de la table.
    * @return array Résultat de la recherche.
    */
    public static function searchQuery($table, $searchValue)
    {
        self::seConnecter();
        $fields = self::getFieldNamesByTableInsert($table);
        $conditions = [];
        foreach ($fields as $field) {
            $conditions[] = "$field LIKE :searchValue";
        }
        $conditionString = implode(" OR ", $conditions);
        self::$requete = "SELECT * FROM $table WHERE $conditionString";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('searchValue', "%$searchValue%");
        self::$pdoStResults->execute();
        return self::$pdoStResults->fetchAll(PDO::FETCH_ASSOC);
    }
    

    // protected static function getFieldNamesByTableInsert($table)
    // {
    //     self::init();
    //     self::$query = " DESCRIBE " . $table;
    //     self::$pdoStatementResults = self::$pdoDbConnection->prepare(self::$query);
    //     self::$pdoStatementResults->execute();
    //     self::$result = self::$pdoStatementResults->fetchAll(PDO::FETCH_OBJ);
    //     self::$pdoStatementResults->closeCursor();

    //     $lesChampsSale = self::$result;
    //     $lesChampsPropre = "";
    //     foreach ($lesChampsSale as $unChamp) {
    //         $lesChampsPropre .= $unChamp->Field . ",";
    //     }
    //     $lesChampsPropre .= "$";
    //     $lesChampsPropre = str_replace(",$", "", $lesChampsPropre);
    //     return $lesChampsPropre;
    // }
    public static function getFieldNamesByTableInsert($table)
    {
        self::init();
        self::$query = "DESCRIBE " . $table;
        self::$pdoStatementResults = self::$pdoDbConnection->prepare(self::$query);
        self::$pdoStatementResults->execute();
        self::$result = self::$pdoStatementResults->fetchAll(PDO::FETCH_OBJ);
        self::$pdoStatementResults->closeCursor();
        
        $fieldNames = array();
        foreach (self::$result as $field) {
        $fieldNames[] = $field->Field;
    }
    
    return $fieldNames;
    }
    


    /**
     * Retourne les noms des attributs clé primaire.
     * @param type $table Nom de la table
     * @return string Attributs de la table.
     */
    public static function getPrimaryKeyAttributeNames($table)
    {
        $theFieldsPK = array();
        self::init();
        self::$query = "DESCRIBE " . $table;
        self::$pdoStatementResults = self::$pdoDbConnection->prepare(self::$query);
        self::$pdoStatementResults->execute();
        self::$result = self::$pdoStatementResults->fetchAll(PDO::FETCH_OBJ);
        self::$pdoStatementResults->closeCursor();

        foreach (self::$result as $unresult) {
            if ($unresult->Key == "PRI") {
                $theFieldsPK[] = $unresult->Field;
            }
        }

        return $theFieldsPK;
    }

    /**
     * Retourne le nom des attriuts d'une table.
     * @param string $table nom de la table.
     * @return object les attributs de la table.
     */
    public static function getFieldNamesByTable($table)
    {
        self::init();
        self::$query = "DESCRIBE " . $table;
        self::$pdoStatementResults = self::$pdoDbConnection->prepare(self::$query);
        self::$pdoStatementResults->execute();
        self::$result = self::$pdoStatementResults->fetchAll(PDO::FETCH_OBJ);
        self::$pdoStatementResults->closeCursor();
        return self::$result;
    }

    /**
     * Retourne le nombre d'attributs dans une table.
     * @param type $baseName nom de la BDD.
     * @param type $tableName nom de la table.
     * @return int nombre de colonnes.
     */
    public static function getColumnCountByTable($baseName, $tableName)
    {
        self::init();
        self::$query = "SELECT count(*) as nbColumns FROM information_schema.COLUMNS WHERE table_schema = '$baseName' AND table_name='$tableName'";
        self::$pdoStatementResults = self::$pdoDbConnection->prepare(self::$query);
        self::$pdoStatementResults->execute();
        self::$result = self::$pdoStatementResults->fetch();
        self::$pdoStatementResults->closeCursor();
        return self::$result->nbColumns;
    }

    public static function exists($tableName, $condition)
    {
        self::init();
        self::$query = "SELECT COUNT(*) as nbOccurence FROM $tableName WHERE $condition";
        self::$pdoStatementResults = self::$pdoDbConnection->prepare(self::$query);
        self::$pdoStatementResults->execute();
        self::$result = self::$pdoStatementResults->fetch();
        self::$pdoStatementResults->closeCursor();

        if (self::$result->nbOccurence > 0) {
            return true;
        } else {
            return false;
        }
    }

    // /**
    //  * Permet de mettre à jour le mot de passe d'un utilisateur.
    //  * @param type $email l'email.
    //  * @param type $password le mot de passe.
    //  */
    // public static function updatePasswordUtilisateur($email, $password) {
    //     self::seConnecter();
    //     self::$requete = "UPDATE utilisateur SET passUtilisateur = :passwordUtilisateur WHERE emailUtilisateur = :emailUtilisateur";
    //     self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
    //     self::$pdoStResults->bindValue('passwordUtilisateur', sha1($password));
    //     self::$pdoStResults->bindValue('emailUtilisateur', $email);
    //     self::$pdoStResults->execute();
    //     self::$pdoStResults->closeCursor();
    // }

}
