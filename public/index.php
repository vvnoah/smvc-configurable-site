<?php
use core\Application;
use Dotenv\Dotenv;

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| this application. We just need to utilize it! We'll simply require it
| into the script here so we don't need to manually load our classes.
|
*/

require_once __DIR__.'/../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| load .env in your application
|--------------------------------------------------------------------------
|
| Now you can use the .env variables in your application
| For example for .env variable DB_USER = root
| you will have access to it with the superglobal $_ENV['DB_USER'];
|
*/

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();
/*
|--------------------------------------------------------------------------
| application configuration settings
|--------------------------------------------------------------------------
|
*/
$config = [
    'application' => [
        'directory' => dirname(__DIR__).'/application',
    ],
    'db' => [
        'active' => $_ENV['DB_ACTIVE'] ?? false,
        'host' => $_ENV['DB_HOST'] ?? null,
        'name' => $_ENV['DB_NAME'] ?? null,
        'user' => $_ENV['DB_USER'] ?? '',
        'password' => $_ENV['DB_PASSWORD'] ?? '',
    ],
];

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once he application is instanced, the routing file is loaded.
| Then starting the application, the http request of the client will be analyzed 
| and the appropriate route will be executed. 
| Then, we will send the response back to this client's browser, allowing them 
| to enjoy the application.
|
*/
$app = new Application($config);

include_once __DIR__.'/../application/routes.php';

$app->run();
?>