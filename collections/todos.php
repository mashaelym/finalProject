<?php
namespace collection;

use \database\collection;
 
class todos extends collection
{
	
	
	// Model Name
	 
	protected static $modelName = '\model\todo';
	
	
	//Find Tasks By User Id
	 
	public static function findTasksbyUserId($userId)
	{
	  
        $tableName = preg_replace('/.*\\\\/', '', get_called_class());
		$sql = 'SELECT * FROM ' . $tableName . ' WHERE ownerid = ?';
		 //grab the only record for find one and return as an object
		$recordsSet = self::getResults($sql, self::$modelName, $userId);
 
		 if (is_null($recordsSet)) {
			 return FALSE;
		 } else {
			 return $recordsSet;
		 }
	}
}
 
 ?>