<?php

namespace view;

/***
 * BASE VIEW
 ***/
class view
{	

	/**
	 * Stores data passed to view
	 */
	private $data = array();

	/**
	 * Add data to view -- didn't put in constructor because not every view needs data
	 */
	public function injectData($data)
	{
		$this->data = $data;
	}
	
	/***
	 * Get View Data
	 * Encapsulate post/get variables to access through this method
	 */
	protected function getViewData($paramName)
	{	
		if(array_key_exists($paramName, $this->data))
		{
			return $this->data[$paramName];
		}
		
		return null;
	}
	
	/**
	 * Method to build pages
	 */
	public function buildPage()
	{
		$header = Header::output();
		$footer = Footer::output();
		
		return $header . $this->output() . $footer;
	}
	
	/**
	 * Render View - Returns output of build page (seperate method for additional render processing)
	 */
	public function render()
	{
		return $this->buildPage();
	}
	
}