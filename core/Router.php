<?php

/**
 * ================================================================================================
 * Se define el namespace de la clase
 * ================================================================================================
 */
namespace app\core;

class Router
{
    /**
     * ============================================================================================
     * Propiedades de la clase
     * ============================================================================================
     */
    public Request $request;
    protected array $routes = [];

    /**
     * ============================================================================================
     * Application constructor.
     * ============================================================================================
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * ============================================================================================
     * @param $path -> ruta de la url
     * @param $callback -> Método a ejecutar en el controlador
     * ============================================================================================
     */
    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    /**
     * ============================================================================================
     * Método para resolver que ruta y que método ejecutar
     * ============================================================================================
     */
    public function resolve()
    {
        $path = $this->request->getPath ();
        $method = $this->request->getMethod ();
        $callback = $this->routes[$method][$path] ?? false;

        if ($callback === false)
        {
            echo "Not found";
            exit;
        }

        echo call_user_func ($callback);
    }
}