<?php

class Hasher
{ 
	static function hashPassword($password)
	{
	//	$password = $_POST['password'];
		$hashed_password = password_hash($password, PASSWORD_DEFAULT);
		return $hashed_password;
	}
	
	static function hashComparision($password, $hashed_password)
	{
		if(password_verify($password, $hashed_password))
		{
   			return true;
   			else{
   				return false;
   				}
		} 
	}
}

?>