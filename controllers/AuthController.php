<?php


namespace app\controllers;


use app\core\Application;
use app\core\Request;

class AuthController
{
    public function index()
    {
        Application::$app->router->setLayout ('auth');
        return Application::$app->router->renderView ('login');
    }

    public function login(Request $request)
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