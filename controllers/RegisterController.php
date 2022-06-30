<?php


namespace app\controllers;


use app\core\Application;
use app\core\Request;
use app\models\User;

class RegisterController
{
    public function index()
    {
        return Application::$app->router->renderView ('register');
    }

    public function create(Request $request)
    {
        $user = new User();
        if ($request->isPost ())
        {
            $user->loadData ($request->getBody ());

            if ($user->validate () && $user->create())
            {
                return 'success';
            }

            echo "<pre>";
            var_dump ($user->errors);
            echo "</pre>";
            exit;

            return Application::$app->router->renderView ('register', ['user' => $user]);
        }
        Application::$app->router->setLayout ('auth');
    }
}