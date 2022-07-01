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
    public string $layout = 'main';
    public string $css = '<link rel="stylesheet" href="../../public/css/{{css}}.css">';
    public string $js = '<script src="../../public/js/{{js}}.js"></script>';
    public Request $request;
    public Response $response;
    protected array $routes = [];

    /**
     * ============================================================================================
     * Application constructor.
     * ============================================================================================
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    /**
     * ============================================================================================
     * Método para modificar el valor de la propiedad layout
     * ============================================================================================
     */
    public function setLayout($layout)
    {
        $this->layout = $layout;
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
    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
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
            $this->response->setStatusCode (404);
            return $this->renderView ("_404");
        }

        if (is_string ($callback))
        {
            return $this->renderView ($callback);
        }

        if (is_array ($callback))
        {
            $callback[0] = new $callback[0]();
        }

        return call_user_func ($callback, $this->request);
    }

    /**
     * ============================================================================================
     * Método para renderizar la vista solicitada según la url
     * ============================================================================================
     */
    public function renderView($view, $params = [], $attach = '')
    {
        $layoutContent = $this->layoutContent ();
        $viewContent = $this->renderOnlyView ($view, $params);

        if (file_exists (Application::$ROOT_DIR."/public/css/$attach.css"))
        {
            $newCss = str_replace ('{{css}}', $attach, $this->css);
            $renderCss = str_replace ('{{css}}', $newCss, $layoutContent);
        }
        else
        {
            $renderCss = $layoutContent;
        }

        if (file_exists (Application::$ROOT_DIR."/public/js/$attach.js"))
        {
            $newJs = str_replace ('{{js}}', $attach, $this->js);
            $renderJs = str_replace ('{{js}}', $newJs, $renderCss);
        }
        else
        {
            $renderJs = $renderCss;
        }

        return str_replace ('{{content}}', $viewContent, $renderJs);
    }

    /**
     * ============================================================================================
     * Método para renderizar el contenido en la plantilla principal
     * ============================================================================================
     */
    public function renderContent($viewContent)
    {
        $layoutContent = $this->layoutContent ();
        return str_replace ('{{content}}', $viewContent, $layoutContent);
    }

    /**
     * ============================================================================================
     * Método para cargar la plantilla principal
     * ============================================================================================
     */
    protected function layoutContent()
    {
        $layout = $this->layout;
        ob_start ();
        include_once Application::$ROOT_DIR."/views/layouts/$layout.php";
        return ob_get_clean ();
    }

    /**
     * ============================================================================================
     * Método para cargar la vista solicitada
     * ============================================================================================
     */
    protected function renderOnlyView($view, $params)
    {
        foreach ($params as $key => $value)
        {
            $$key = $value;
        }
        ob_start ();
        include_once Application::$ROOT_DIR."/views/$view.php";
        return ob_get_clean ();
    }
}