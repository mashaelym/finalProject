<?php

namespace http;

use \route\routes;
use \view\MessageView;

class processRequest
{

    /**
     * Create Response
     * This is the main function of the program to calculate the response to a get or post request
     */
    public static function createResponse()
    {
        $requested_route = processRequest::getRequestedRoute();
        
        //namespace is hardcoded here otherwise we would need to have a ton of use statements and always update this file
        $controller_name = "controller\\". $requested_route->controller;
        //this determines the method to call for the controller
        $controller_method = $requested_route->method;

        //controller is now in instance because it stores an instance of the request object for that controller
        $r = request::getRequestObject();
        
        $c = new $controller_name($r);
        $c->$controller_method();
    }

    /**
     * Get Requested Route
     * This function matches the request to the correct controller
     */
    public static function getRequestedRoute()
    {
        $request_method = request::getRequestMethod();
        $page = request::getPage();
        $action = request::getAction();
        
        //build routes
        routes::buildRoutes();
                
        //swapped out loop for searching in route object array for faster performance
        $route = routes::getRoute(strtolower($page . '-' . $action));
        
        if($route !== null)
        {
            return $route;
        }
        
        //page not found message
        $v = new MessageView();
        $v->injectData(array('message' => 'Page Not Found - 404'));
        echo $v->render();
        die(); //halt execution if the page is not found
    }
}
