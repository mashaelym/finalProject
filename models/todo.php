<?php

namespace model;

final class todo extends \database\model
{
    public $id;
    public $owneremail;
    public $ownerid;
    public $createddate;
    public $duedate;
    public $message;
    public $isdone;
    public $useriD;
    protected static $modelName = 'todo';

    public static function getTablename()
    {

        $tableName = 'todos';
        return $tableName;
    }

    /**
     * Find one task by task id
     */
    public static function findTaskByTaskId()
    {
        $record = todo::findOne($id);
        return $record;
    }

    /**
     * Find all tasks
     **/
    public static function findAll()
    {
        //I am temporarily putting a findall here but you should add a method to todos that takes the USER ID and returns their tasks.
        $records = \model\todo::findAll();
        print_r($records);
        return $records;
    }
    
     //This is the function to write to find tasks by user ID for listing on their homepage.
     //Should return the record set like findAll in the collection class
     public static  function findTasksbyUserId($userid) {
  
        $tableName = get_called_class();
        $sql = 'SELECT * FROM ' . $tableName . ' WHERE id = ?';
        $sql = 'SELECT * FROM ' . $tableName . ' WHERE ownerid = ?';
         //grab the only record for find one and return as an object
        $recordsSet = self::getResults($sql, $userid);
 
         if (is_null($recordsSet)) {
             return FALSE;
         } else {
             return $recordsSet;
         }
     }
}

?>
