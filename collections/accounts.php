<?php

namespace collection;

use \database\collection;

class accounts extends collection
{
	
	//Define model that will be used to bind the results
	 
    protected static $modelName = '\model\account';
	
	
	 //Find User By Email
	 
	public static function findUserbyEmail($email)
    {
		  $tableName = preg_replace('/.*\\\\/', '', get_called_class());
		  $sql = 'SELECT * FROM ' . $tableName . ' WHERE email = ?';
 
          //grab the only record for find one and return as an object
          $recordsSet = self::getResults($sql, self::$modelName, $email);
 
          if (is_null($recordsSet)) {
               return FALSE;
          } else {
               return $recordsSet[0];
          }
     }
}

?>