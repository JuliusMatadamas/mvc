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
        $path = str_replace ("/mvc/", "/", $_SERVER["REQUEST_URI"]) ?? '/';
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
}