<?php

namespace http;
use \http\RequestObject;

class request
{

    /**
     * Utility method to get the request method
     */
     public static function getRequestMethod()
    {
        $request_method = $_SERVER['REQUEST_METHOD'];
        return $request_method;
    }
    
    /**
     * Utility method to get the page name requested
     */
    public static function getPage()
    {
        //this sets the default page for the app to index
        $page = 'homepage';

        //this checks if page is set
        if (!empty($_GET['page'])) {
            $page = $_GET['page'];
        }
        return $page;
    }

    /**
     * Utility method to get the action
     */
     public static function getAction()
    {

        $action = 'show';
        
        if (!empty($_GET['action'])) {
            $action = $_GET['action'];
        }
        return $action;
    }
    
    /**
     * Returns request object for route which has http/post get parameters
     */
    public static function getRequestObject()
    {
        return new RequestObject($_REQUEST);
    }

}