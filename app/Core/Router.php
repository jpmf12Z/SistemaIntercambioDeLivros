<?php
namespace App\Core;

class Router {
    private $route;

    public function __construct($route) {
        $this->route = trim($route, '/');
    }

    public function dispatch() {
        $parts = $this->route ? explode('/', $this->route) : ['home','index'];
$controllerName = ucfirst($parts[0]) . 'Controller';
$action = $parts[1] ?? 'index';


        $controllerClass = "\\App\\Controllers\\$controllerName";
        $file = __DIR__ . "/../Controllers/$controllerName.php";

        if (!file_exists($file)) {
            echo "Controller $controllerName não encontrado!";
            return;
        }

        require_once $file;
        $controller = new $controllerClass();

        if (!method_exists($controller, $action)) {
            echo "Ação $action não encontrada!";
            return;
        }

        call_user_func([$controller, $action]);
    }
}
