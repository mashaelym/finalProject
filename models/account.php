<?php

namespace model;
use \collection\accounts;
use \DateTime;
use \database\model;

final class account extends model
{
    
    /**
     * declare fields in the table
     */
    public $id;
    public $email;
    public $fname;
    public $lname;
    public $password;
    public $phone;
    public $birthday;
    public $gender;
    
    /**
     * model properties
     */
    const MODEL_NAME = 'account';
    const PRIMARY_KEY = 'id';
    const TABLE_NAME = 'accounts';
    
    /**
     * Find one account by id
     */
    public static function findOne($id)
    {
        $record = accounts::findOne($id);
        return $record;
    }
    
    /**
     * Find all accounts
     */
    public static function findAll()
    {
        $records = accounts::findAll();
        return $records;
    }
    
    /**
     * Set password - uses php builtin function to hash password
     */
    public function setPassword($password)
    {
        $password = password_hash($password, PASSWORD_DEFAULT);
        return $password;
    }
    
    /**
     * Check password - uses built in php function for verify
     */
    public function checkPassword($loginPassword)
    {
        return password_verify($loginPassword, $this->password);
    }
     
    /**
     * Find user by email
     */
    public static function findUserbyEmail($email)
    {
        $record = accounts::findUserbyEmail($email);
        return $record;
    }
    
    /**
     * Prehook method will run any post processing activities after validation, but before insert/save
     */
    public function preHook()
    {
        //we hash the password in preHook before insert because a blank password can still generate a hash
        //doing it here makes sure we don't have a zero length password
        
        //we need to make sure we aren't re-hashing a password      
        //since we are using php's function it will recognize its own password
        //hash type bcrypt
        $passwordInfo = password_get_info($this->password);
        if($passwordInfo['algoName'] != 'bcrypt')
        {
            $this->password = $this->setPassword($this->password);
        }
        
        //since the birthday field is optional - only convert to mysql data format it is present
        if($this->birthday != null)
        {
            $date = DateTime::createFromFormat('m-d-Y', $this->birthday); //convert to mysql format
            $this->birthday = $date->format('Y-m-d');
        }
    }
    
    /**
     * Validate method to validate fields
     */
    public function validate()
     {       
         $errors = array();
         
         if(Validator::isBlank($this->fname) == true)
         {
             $errors[] = 'Missing first name';
         }
     
         if(Validator::isBlank($this->lname) == true)
         {
             $errors[] = 'Missing last name';
         }

         if(Validator::isBlank($this->email) == true || Validator::validateEmail($this->email) == false)
         {
            $errors[] = 'E-mail cannot be left blank or is invalid format';
         }
         
         if(Validator::isBlank($this->password) == true)
         {
             $errors[] = 'Missing password';
         }
         
         if(Validator::isBlank($this->phone) == false &&  Validator::validatePhoneNumber($this->phone) == false)
         {
             $errors[] = 'Invalid phone number format';          
         }
        
        if(Validator::isBlank($this->birthday) == false && Validator::validateDate($this->birthday) == false)
        {
            $errors[] = 'Invalid birthday format';
        }
        
        if(Validator::isBlank($this->gender) == false && Validator::checkValue($this->gender, array('M', 'F')) == false)
        {
            $errors[] = 'Invalid gender';
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