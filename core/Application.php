<?php


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
}