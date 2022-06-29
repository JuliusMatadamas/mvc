<?php

namespace app\core;

define ('APP_NAME', 'mvc1');

class Application
{
    /**
     * ============================================================================================
     * Propiedades de la clase
     * ============================================================================================
     */
    public static string $ROOT_DIR;
    public Router $router;
    public Request $request;

    /**
     * ============================================================================================
     * Application constructor.
     * ============================================================================================
     */
    public function __construct($rootPath)
    {
        /**
         * Si el proyecto no se encuentra en el servidor local
         * Se define como la ruta de archivos la ubicación del
         * servidor externo
         */
        if ( $_SERVER["REMOTE_ADDR"] !== "127.0.0.1" )
        {
            $_SERVER["REMOTE_ADDR"] !== "::1" ? self::$ROOT_DIR = $rootPath.'/mvc1.atwebpages.com/' : self::$ROOT_DIR = $rootPath.'/'.APP_NAME;
        }
        else
        {
            self::$ROOT_DIR = $rootPath.'/'.APP_NAME;
        }

        $this->request = new Request();
        $this->router = new Router($this->request);
    }

    /**
     * ============================================================================================
     * Método run de la aplicación
     * ============================================================================================
     */
    public function run()
    {
        echo $this->router->resolve();
    }
}