<?php

namespace app\core;

class Application
{
    /**
     * Propiedad publica de tipo de la clase Router
     */
    public Router $router;

    /**
     * Application constructor.
     */
    public function __construct()
    {
        $this->router = new Router();
    }

    public function run()
    {
    }
}