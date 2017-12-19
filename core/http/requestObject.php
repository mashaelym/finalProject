<?php

namespace http;

/**
 * Encapsulate get/post parameters
 */
class RequestObject
{
	/**
	 * Store parameters
	 */
	private $httpRequestArray;
	
	/**
	 * construct object with $_REQUEST
	 */
	public function __construct(array $httpRequestArray)
	{
		$this->httpRequestArray = $httpRequestArray;
	}
	
	/**
	 * Get HTTP GET/POST parameters
	 */
	public function getParameter($httpParamName)
	{
		if(array_key_exists($httpParamName, $this->httpRequestArray))
		{
			return $this->httpRequestArray[$httpParamName];
		}
		
		return null;
	}
}
	
?>