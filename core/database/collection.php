<?php

namespace database;

abstract class collection
{

    /**
     * Factory method to create model
     */
    public static function create()
    {
        $model = new static::$modelName;
        return $model;
    }

    /**
     * Find all method
     */
    public static function findAll()
    {
        //replace namespace
        $tableName = preg_replace('/.*\\\\/', '', get_called_class());
        $sql = 'SELECT * FROM ' . $tableName;
        return self::getResults($sql, static::$modelName);
    }

    /**
     * Get Results
     * Added result class because the correct model instance was not being passed correctly
     */
     protected static function getResults($sql, $resultClass, $parameters = null) 
    {
        if (!is_array($parameters)) {
        $parameters = (array) $parameters;
        }

        $db = dbConn::getConnection();
        $statement = $db->prepare($sql);
        
        $statement->execute($parameters);
        
        //get_called_class is a bad idea here --- it would return an instance of a collection class
        //where we want the model class
                        
        if ($statement->rowCount() > 0) {
            $statement->setFetchMode(\PDO::FETCH_CLASS, $resultClass);
            $recordsSet = $statement->fetchAll();
 
         } else {
             
             $recordsSet = NULL;
 
         }

        return $recordsSet;
    }

    /**
     * Find One
     */
    public static function findOne($id)
    {
        $tableName = preg_replace('/.*\\\\/', '', get_called_class());
        $sql = 'SELECT * FROM ' . $tableName . ' WHERE id = ?'; 
        //grab the only record for find one and return as an object
        $recordsSet = self::getResults($sql, static::$modelName, $id);
 
         if (is_null($recordsSet)) {
             return FALSE;
         } else {
             return $recordsSet[0];
         }
    }
}

?>