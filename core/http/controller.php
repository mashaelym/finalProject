<?php

namespace http;
use \http\RequestObject;
use \Session\MySessionHandler;
use \view\MessageView;

/***
 * BASE CONTROLLER
 ***/
class controller
{
	/**
	 * Stores request object so its available to all methods
	 */
	private $httpRequestObject;
	
	/***
	 * Contructor
	 *
	 * Require that http post/get php HTTP Request Object
	 */
	public function __construct(RequestObject $httpRequestObject)
	{	
		$this->httpRequestObject = $httpRequestObject;
		$this->initializeSession();
	}

	/**
	 * Return HTTP Request Object Which Encapsulates Access to all GET/POST parameters
	 */
	protected function getRequestObject()
	{
		return $this->httpRequestObject;
	}
	 
	 /**
	  * Get session helper/handler
	  */
	 protected function getSessionHandler()
	 {
		return new MySessionHandler();
	 }
	 
	/**
	 * We want the session initialized for every method -- cleans up controller
	 * It is automatically always on
	 * Start session on controller construction
	 */
	 private function initializeSession()
	 {
		//we want the session register shutdown to be initailized before starting any sessions
		//and while the controller is getting constructed.
		session_register_shutdown();
		session_start();
	 }
	 
	 /**
	  * Helper method to display messages from the controller
	  */
	 protected function displayMessage($message)
	 {
		 $v = new MessageView();
		 $v->injectData(array('message' => $message));
		 echo $v->render();
		 die(); //halt execution of all other code when displaying a message
	 }
	 
}