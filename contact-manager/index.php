<?php
// Front controller: every request comes through here
session_start();
if (empty($_SESSION['csrf'])) {
    $_SESSION['csrf'] = bin2hex(random_bytes(32));
}

function e(?string $s): string // escape output (prevents XSS)
{
    return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8');
}

// Whitelist of allowed routes: page => [controller class, allowed actions]
$routes = [
    'contacts' => ['ContactController', ['index', 'add', 'edit', 'delete']],
    'auth'     => ['AuthController', ['login', 'logout']],
];

$page = $_GET['page'] ?? 'contacts';
$action = $_GET['action'] ?? ($page === 'auth' ? 'login' : 'index');

if (!isset($routes[$page]) || !in_array($action, $routes[$page][1], true)) {
    http_response_code(404);
    exit('Page not found');
}

[$class] = $routes[$page];
require __DIR__ . "/controllers/$class.php";
(new $class())->$action();
