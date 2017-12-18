<?php

namespace Session;

class MySessionHandler
{
	public function isLoggedIn()
	{
		if(isset($_SESSION['id']) == true)
		{
			return true;
		}	
	}
	
	public function getSessionVariable($parameterName)
	{
		if(array_key_exists($parameterName, $_SESSION))
		{
			return $_SESSION[$parameterName];
		}
		
		return null;
	}
	
	public function setSessionVariable($parameterName, $parameterValue)
	{
		$_SESSION[$parameterName] = $parameterValue;
	}
}

?>