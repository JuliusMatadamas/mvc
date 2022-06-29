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
            return "Not found";
        }

        if (is_string ($callback))
        {
            return $this->renderView ($callback);
        }

        return call_user_func ($callback);
    }

    /**
     * ============================================================================================
     * Método para renderizar la vista solicitada según la url
     * ============================================================================================
     */
    public function renderView($view)
    {
        $layoutContent = $this->layoutContent ();
        $viewContent = $this->renderOnlyView ($view);
        return str_replace ('{{content}}', $viewContent, $layoutContent);
    }

    protected function layoutContent()
    {
        ob_start ();
        include_once Application::$ROOT_DIR."/views/layouts/main.php";
        return ob_get_clean ();
    }

    protected function renderOnlyView($view)
    {
        ob_start ();
        include_once Application::$ROOT_DIR."/views/$view.php";
        return ob_get_clean ();
    }
}