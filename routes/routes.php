<?php

namespace route;

/**
 * Class to build routes in a factory like style including searching for routes
 */
class routes
{   
    
    /**
     * Static array of route objects stored to cache for entire php request
     */
    private static $routes;
    
    /**
     * Method to find route by identifier
     */
    public static function getRoute($routeName)
    {       
        if(isset(self::$routes[$routeName]) == true) 
        {
            return self::$routes[$routeName];
        }
        
        return null;
    }
    
    /**
     * Factory method to add route
     */
    private static function addRoute($http_method,$action,$page,$controller,$method)
    {
         $route = new route();
         $route->http_method = $http_method;
         $route->action = $action;
         $route->page = $page;
         $route->controller = $controller;
         $route->method = $method;
         
         //this creates a unique identifer for each route
         $name = strtolower($page  . '-' . $action);
         $route->name = $name;
         
         self::$routes[$name] = $route;
    }
    
    /**
     * Method to build routes all at once
     */
    public static function buildRoutes()
    {
        self::$routes = array();
        
        //homepage controller
        self::addRoute('GET', 'show', 'homePage', 'homepageController','show');
        
        //portal controller
        self::addRoute('GET', 'show', 'portal', 'portalController', 'show');
        
        //tasks controller
        self::addRoute('GET', 'show', 'tasks', 'tasksController', 'show');
        self::addRoute('GET', 'all', 'tasks', 'tasksController', 'all');
        self::addRoute('GET', 'add', 'tasks', 'tasksController', 'add');
        self::addRoute('POST', 'create', 'tasks', 'tasksController', 'create');
        self::addRoute('POST', 'edit', 'tasks', 'tasksController', 'edit');
        self::addRoute('POST', 'update', 'tasks', 'tasksController', 'update');
        self::addRoute('POST', 'delete', 'tasks', 'tasksController', 'delete');
        
        //accounts controller
        self::addRoute('GET', 'show', 'accounts', 'accountsController', 'show');
        self::addRoute('GET', 'all', 'accounts', 'accountsController', 'all');
        self::addRoute('POST', 'create', 'accounts', 'accountsController', 'create');
        self::addRoute('GET', 'edit', 'accounts', 'accountsController', 'edit');
        self::addRoute('POST', 'update', 'accounts', 'accountsController', 'update');
        self::addRoute('POST', 'delete', 'accounts', 'accountsController', 'delete');
        self::addRoute('GET', 'register', 'accounts', 'accountsController', 'register');
        self::addRoute('POST', 'login', 'accounts', 'accountsController', 'login');
        self::addRoute('GET', 'logout', 'accounts', 'accountsController', 'logout');
    }
    
    /**
     * Method to get all routes (array full of route objects)
     */
    public static function getRoutes()
    {
        return self::$routes;
    }

}