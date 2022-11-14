<?php

use core\Router;
use core\Application;
use app\controllers;

/*
|--------------------------------------------------------------------------
|Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the public/index.php file
|--------------------------------------------------------------------------
*/
Router::get('/', [controllers\DefaultController::class, 'show_homepage']);
Router::get('/home', [controllers\DefaultController::class, 'show_homepage']);
Router::get('/about', [controllers\AboutController::class, 'index']);
Router::get('/lotto', [controllers\LottoController::class, 'index']);