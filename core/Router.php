<?php

/**
 * sMVC router class
 *
 * @author     sedasoft stefan.segers@telenet.be
 * @package    sMVC\core
 * @version    1.0.0
 * @since      Class available since Release 1.0.0
 */

namespace core;

class Router {
    
    public static array $routes = [];
    
    public Request $request;
    public Response $response;
       
    public function __construct(Request $request, Response $response) {
        $this->request = $request;
        $this->response = $response;
    }
    
    public static function get($path, $callback, $params = []) 
    {
        self::$routes['get'][$path]['callback'] = $callback;
        self::$routes['get'][$path]['params'] = $params;
    }
    
    public static function post($path, $callback, $params = []) 
    {
        self::$routes['post'][$path]['callback'] = $callback;
        self::$routes['post'][$path]['params'] = $params;
    }
       
    public function resolve() {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = self::$routes[$method][$path]['callback'] ?? false;
        $params = self::$routes[$method][$path]['params'] ?? false;
    
        if ($callback === false){
            $this->response->statusCode(404); 
            return $this->showView('error/404');
        }
        if (is_string($callback)){
            $view = $callback;
            if ($params){ 
                return $this->showView($view, $params);
            }
            return $this->showView($view);
        }
        if (is_array($callback)) {
            //make instance of the controller before execute
            //$callback[0] holds the controller class name
            $callback[0] = new $callback[0]();
            
        }
        return call_user_func($callback);
    }
    
    public function showView($view, $params = [])
    {
        Application::$app->view->display($view, $params);
    }
}
