<?php

namespace model;

/**
 * Utility class that has validation methods for use in the model
 */
class Validator
{
	
	/**
	 * validate e-mail
	 */
	public static function validateEmail($input)
	{
		return filter_var($input, FILTER_VALIDATE_EMAIL);
	}
	
	/**
	 * validate if input is blank
	 */
	public static function isBlank($input)
	{
		$i = trim($input);
		return strlen($i) == 0;
	}
	
	/**
	 * validate phone number format and length
	 */
	public static function validatePhoneNumber($input)
	{
		return preg_match('/\d{3}-\d{3}-\d{4}/', $input) && (strlen($input) == 12);
	}
	
	/**
	 * validate date format (mm-yy-dddd) and length
	 */
	public static function validateDate($input)
	{
		return preg_match('/\d{2}-\d{2}-\d{4}/', $input) && (strlen($input) == 10);
	}
	
	/**
	 * validate values - accepts an array of values that the input value must be in
	 */
	public static function checkValue($input, $valueCheck)
	{
		return in_array($input, $valueCheck);
	}
	
}

?>