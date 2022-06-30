<?php


namespace app\core;


class Request
{
    /**
     * ============================================================================================
     * Método para obtener la ruta
     * ============================================================================================
     */
    public function getPath()
    {
        // Sólo en caso de ejecutarse en localhost/mvc/, reemplazar por path raíz
        $path = str_replace ("/".APP_NAME."/", "/", $_SERVER["REQUEST_URI"]) ?? '/';
        $position = strpos ($path, '?');
        if ($position === false)
        {
            return $path;
        }
        return substr($path, 0, $position);
    }

    /**
     * ============================================================================================
     * Método para obtener el método del controlador a ajecutar
     * ============================================================================================
     */
    public function getMethod()
    {
        return strtolower ($_SERVER["REQUEST_METHOD"]);
    }
    public function isGet()
    {
        return $this->getMethod () === 'get';
    }
    public function isPost()
    {
        return $this->getMethod () === 'post';
    }

    /**
     * ============================================================================================
     * Método para sanitizar los datos recbidos o pasados por GET & POST
     * @return array -> con los datos sanitizados
     * ============================================================================================
     */
    public function getBody()
    {
        $body = [];
        if ($this->getMethod () === 'get')
        {
            foreach ($_GET as $key => $value)
            {
                $body[$key] = filter_input (INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        if ($this->getMethod () === 'post')
        {
            foreach ($_POST as $key => $value)
            {
                $body[$key] = filter_input (INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        return $body;
    }
}