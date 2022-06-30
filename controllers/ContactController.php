<?php

namespace app\controllers;

use app\core\Application;
use app\core\Request;

class ContactController
{
    public static function index()
    {
        $data = [
            "name" => "Julio Cesar Matadamas"
        ];
        return Application::$app->router->renderView ('contact', $data);
    }

    public static function create(Request $request)
    {
        $body = $request->getBody ();
        echo "<pre>";
        var_dump ($body);
        echo "</pre>";
        exit;
    }

    public static function update()
    {
    }

    public static function delete()
    {
    }
}