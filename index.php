<?php

/**
 * ================================================================================================
 * Se carga el autoload
 * ================================================================================================
 */
require_once __DIR__.'/vendor/autoload.php';

/**
 * ================================================================================================
 * Se carga el namespace de la aplicación
 * ================================================================================================
 */

use app\controllers\AuthController;
use app\controllers\ContactController;
use app\controllers\RegisterController;
use app\core\Application;

/**
 * ================================================================================================
 * Se crea una nueva instancia de la clase Application
 * ================================================================================================
 */
$app = new Application(dirname (__DIR__));

/**
 * ================================================================================================
 * Routes
 * ================================================================================================
 */
$app->router->get('/', 'home');
$app->router->get('/contact', [ContactController::class, 'index']);
$app->router->post('/contact', [ContactController::class, 'create']);
$app->router->get('/login', [AuthController::class, 'index']);
$app->router->post('/login', [AuthController::class, 'login']);
$app->router->get('/register', [RegisterController::class, 'index']);
$app->router->post('/register', [RegisterController::class, 'create']);

/**
 * ================================================================================================
 * Se ejecuta el método run de la aplicación
 * ================================================================================================
 */
$app->run ();