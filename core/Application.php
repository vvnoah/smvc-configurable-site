<?php

/**
 * sMVC application class
 *
 * @author     sedasoft stefan.segers@telenet.be
 * @package    sMVC\core
 * @version    1.0.0
 * @since      Class available since Release 1.0.0
 */

namespace core;

class Application {
    
    public static string $APP_DIR;
    public static string $ROOT_DIR;
    public static Application $app;
    
    public Router $router;
    public Request $request;
    public Response $response;
    public View $view;
    public Database $db;
    
    public function __construct($config) {
        self::$ROOT_DIR = dirname(__DIR__);
        self::$APP_DIR = $config['application']['directory'];
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request,$this->response);
        $this->view = new View();
        if ($config['db']['active'] === "true"){
            $this->db = new Database($config['db']);
        }
    }
    
    public function run() {
        $this->router->resolve();
    }
}
