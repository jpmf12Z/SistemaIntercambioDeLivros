<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Carrega o Autoload primeiro (assim todas as classes serão encontradas)
require_once __DIR__ . '/../app/Core/Autoload.php';

// Depois carrega o Router normalmente
use App\Core\Router;

$route = $_GET['route'] ?? '';
$router = new Router($route);
$router->dispatch();
