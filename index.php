<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);

//to do: seperate clasess
function my_autoloader($class)
{
    include 'classes/' . $class . '.class.php';
}
spl_autoload_register('my_autoloader');
$response = processRequest::createResponse();
class routes
{
    public static function getRoutes()
    {
        $route = new route();
        $route->http_method = 'GET';
        $route->page = 'index';
        $route->action = 'show';
        $route->controller = 'index';
        $route->method = 'show';
        $routes[] = $route;

        $route = new route();
        $route->http_method = 'POST';
        $route->action = 'create';
        $route->page = 'index';
        $route->controller = 'index';
        $route->method = 'create';
        $routes[] = $route;

        $route = new route();
        $route->http_method = 'GET';
        $route->action = 'show';
        $route->page = 'tasks';
        $route->controller = 'tasks';
        $route->method = 'show';
        $routes[] = $route;
        //to do: routes for create, edit, delete
        $route = new route();
        $route->http_method = 'GET';
        $route->action = 'list_task';
        $route->page = 'tasks';
        $route->controller = 'tasks';
        $route->method = 'list_task';
        $routes[] = $route;
        return $routes;
    }
}

class route
{
    public $page;
    public $action;
    public $method;
    public $controller;
}

class processRequest
{
    public static function createResponse()
    {
        $requested_route = processRequest::getRequestedRoute();
        $controller_name = $requested_route->controller;
        $controller_method = $requested_route->method;
        $controller_name::$controller_method();
    }

    public static function getRequestedRoute()
    {
        //refactor
        $request_method = request::getRequestMethod();
        $page = request::getPage();
        $action = request::getAction();
        echo 'Action: ' . $action . '</br>';
        echo 'Page: ' . $page . '</br>';
        echo 'Request Method: ' . $request_method . '</br>';

        $routes = routes::getRoutes();

        foreach ($routes as $route) {
            if ($route->page == $page && $route->http_method == $request_method && $route->action == $action) {
               return $route;
             }
        }
    }
}

class controller
{
    static public function getTemplate($template, $data = NULL)
    {
        $template = 'pages/' . $template . '.php';
        include $template;
    }
}

class index extends controller
{
    public static function show()
    {
        $myTemplateData = array('site_name' => 'My Task Site');
        self::getTemplate('homepage', $myTemplateData);
    }
    public static function create()
    {
        //add code to add a record
        print_r($_POST);
    }
}
