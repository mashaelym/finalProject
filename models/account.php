<?php

namespace model;

final class account extends \database\model
{
    public $id;
    public $email;
    public $fname;
    public $lname;
    public $phone;
    public $birthday;
    public $gender;
    public $password;
    protected static $modelName = 'account';

    public static function getTableName()
    {
        $tableName = 'accounts';
        return $tableName;
    }
    
    /**
     * Find one task
     */
    public static function findTask($id)
    {
        $record = todo::findOne($id);
        return $record;
    }

    /**
     * Find all tasks
     **/
    public static function findTasks()
    {
        //I am temporarily putting a findall here but, should add a method to todos that takes the USER ID and returns their tasks.
        $records = todo::findAll();
        print_r($records);
        return $records;
    }
    
    
    public function checkPassword($LoginPassword) {
 
        return password_verify($LoginPassword, $this->password);
 
 
     }
     
    //This is the function to write to find user by ID for login.
    //should return the object like findOne in the collection class
    public static function findUserbyEmail($email)
   {
 
             $tableName = get_called_class();
             $sql = 'SELECT * FROM ' . $tableName . ' WHERE email = ?';
 
          //grab the only record for find one and return as an object
             $recordsSet = self::getResults($sql, $email);
 
             if (is_null($recordsSet)) {
                 return FALSE;
             } else {
                 return $recordsSet[0];
             }
 
     }
    
    public function validate()
     {
         $valid = TRUE;
         echo 'myemail: ' . $this->email;
         if($this->email == '') {
             $valid = FALSE;
             echo 'nothing in email';
         }
 
 
         return $valid;

     }
     
}


?>
