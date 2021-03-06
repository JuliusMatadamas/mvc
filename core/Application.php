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
    public Database $db;
    public Router $router;
    public Request $request;
    public Response $response;
    public static Application $app;

    /**
     * ============================================================================================
     * Application constructor.
     * ============================================================================================
     */
    public function __construct($rootPath, array $config)
    {
        date_default_timezone_set('America/Mexico_City');
        /**
         * Si el proyecto no se encuentra en el servidor local
         * Se define como la ruta de archivos la ubicación del
         * servidor externo
         */
        if (isset($_SERVER["REMOTE_ADDR"]) && $_SERVER["REMOTE_ADDR"] !== "127.0.0.1")
        {
            if (isset($_SERVER["REMOTE_ADDR"]) && $_SERVER["REMOTE_ADDR"] !== "::1")
            {
                self::$ROOT_DIR = $rootPath.'/mvc1.atwebpages.com/';
            }
            else
            {
                self::$ROOT_DIR = $rootPath.'/'.APP_NAME;
            }
        }
        else
        {
            self::$ROOT_DIR = $rootPath.'/'.APP_NAME;
        }

        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        $this->db = new Database($config['db']);
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