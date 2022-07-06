<?php

/**
 * ================================================================================================
 * Se cargan los namespace de la aplicación
 * ================================================================================================
 */
use app\controllers\AuthController;
use app\controllers\ContactController;
use app\controllers\RegisterController;
use app\core\Application;

/**
 * ================================================================================================
 * Se carga el autoload
 * ================================================================================================
 */
require_once __DIR__.'/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

/**
 * ================================================================================================
 * CONFIGURACIÓN DE DATOS PARA LA CONEXIÓN CON LA BASE DE DATOS
 * ================================================================================================
 */
$config = [
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD']
    ]
];

/**
 * ================================================================================================
 * Se crea una nueva instancia de la clase Application
 * ================================================================================================
 */
$app = new Application(dirname (__DIR__), $config);

/**
 * ================================================================================================
 * Se ejecuta el método run de la aplicación
 * ================================================================================================
 */
$app->db->applyMigrations ();