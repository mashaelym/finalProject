<?php

namespace model;
use \collection\todos;
use \DateTime;
use \database\model;

final class todo extends model
{
    /**
     * declare fields in the table
     */
    public $id;
    public $owneremail;
    public $ownerid;
    public $createddate;
    public $duedate;
    public $message;
    public $isdone;
    
    const MODEL_NAME = 'todo';
    const PRIMARY_KEY = 'id';
    const TABLE_NAME = 'todos';

    /**
     * Find one task by task id
     */
    public static function findOne($id)
    {
        $record = todos::findOne($id);
        return $record;
    }

    /**
     * Find all tasks
     **/
    public static function findAll()
    {
        $records = todos::findAll();
        return $records;
    }
    
     /**
      * Find all tasks by UserId
      */
     public static  function findAllbyUserId($userId)
     {
        $records = todos::findTasksbyUserId($userId);
        return $records;
     }
     
     /**
     * Prehook method will run any post processing activities after validation
     */
    public function preHook()
    {       
        //run for due date
        $date = DateTime::createFromFormat('m-d-Y', $this->duedate); //convert to mysql format
        $this->duedate = $date->format('Y-m-d');
    }
    
    /**
     * Validate method to validate fields
     */
     public function validate()
     {       
        $errors = array();
        
        if(Validator::validateDate($this->duedate) == false)
        {
            $errors[] = 'Invalid date format / missing date';
        }
        
         if(Validator::isBlank($this->message) == true)
         {
             $errors[] = 'Missing message';
         }
         
         if(Validator::isBlank($this->isdone) == true || Validator::checkValue($this->isdone, array(1, 0)) == false)
        {
            $errors[] = 'Invalid/missing completion status';
        }

        if(sizeof($errors) > 0)
        {
            return $errors;
        }
        else
        {
            return true;
        }
     }
}

?>