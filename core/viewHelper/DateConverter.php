<?php

namespace viewHelper;
use \DateTime;

class DateConverter
{
  
	/**
	 * Convert yyyy-mm-dd MySQL Date Format to mm-dd-yyyy
	 */
	public static function MySqlDateToPHPDateConverter($mySqlDate)
	{
		if($mySqlDate == null)
		{
			return;
		}
		
		$date = DateTime::createFromFormat('Y-m-d', $mySqlDate); //convert to php format
		return $date->format('m-d-Y');
	}
	
	/**
	 * Convert yyyy-mm-dd hh:mm:ss MySQL Date Format to mm-dd-yyyy hh:mm:ss
	 */
	public static function MySqlTimeStampToPHPDateConverter($mySqlDate)
	{
		if($mySqlDate == null)
		{
			return;
		}
		
		$date = DateTime::createFromFormat('Y-m-d h:m:s', $mySqlDate); //convert to php format
		return $date->format('m-d-Y h:m:s');
	}
  
}
?>