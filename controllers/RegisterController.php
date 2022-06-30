<?php


namespace app\controllers;


use app\core\Application;
use app\core\Request;

class RegisterController
{
    public function index()
    {
        return Application::$app->router->renderView ('register');
    }

    public function create(Request $request)
    {
        if ($request->isPost ())
        {
            $body = $request->getBody ();
            echo "<pre>";
            var_dump ($body);
            echo "</pre>";
            exit;
        }
        echo "Verify data to register";
    }
}