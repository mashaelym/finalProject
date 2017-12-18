<?php

namespace Session;


//Provides helper functions for php sessions
 
class MySessionHandler
{
	
	
	//Checks to see if user is logged in
	 
	public function isLoggedIn()
	{
		if(isset($_SESSION['id']) == true)
		{
			return true;
		}	
	}
	
	
	 //Encapsulate access to the session global vars - get method
	 
	public function getSessionVariable($parameterName)
	{
		if(array_key_exists($parameterName, $_SESSION))
		{
			return $_SESSION[$parameterName];
		}
		
		return null;
	}
	
	
	 //Encapsulate access to the session global vars - set method
	 
	public function setSessionVariable($parameterName, $parameterValue)
	{
		$_SESSION[$parameterName] = $parameterValue;
	}
}

?>