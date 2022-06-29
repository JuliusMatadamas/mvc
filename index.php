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
use app\core\Application;

/**
 * ================================================================================================
 * Se crea una nueva instancia de la clase Application
 * ================================================================================================
 */
$app = new Application();

/**
 * ================================================================================================
 * Routes
 * ================================================================================================
 */
$app->router->get('/', function(){
    return "Greetings from index";
});
$app->router->get('/contact', function(){
    return "Contact form here";
});

/**
 * ================================================================================================
 * Se ejecuta el método run de la aplicación
 * ================================================================================================
 */
$app->run ();