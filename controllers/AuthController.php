<?php


namespace app\controllers;


use app\core\Application;
use app\core\Request;
use app\models\User;

class AuthController
{
    public function index()
    {
        $user = new User();
        Application::$app->router->setLayout ('auth');
        return Application::$app->router->renderView ('login', ['user' => $user], 'login');
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