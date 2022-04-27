<?php
require_once "controllers/auth.controller.php";
require_once "controllers/register.controller.php";
require_once "controllers/subjects.controller.php";

$request = $_SERVER['REQUEST_URI'];
$request = explode('/', $request);
$request = $request[2];

switch ($request) {
    case '':
    case '/':
        require __DIR__ . '/views/index.php';
        break;
    case 'auth':
        require __DIR__ . '/views/auth.php';
        break;
    case 'register':
        require __DIR__ . '/views/register.php';
        break;
    case 'subjects':
        require __DIR__ . '/views/subject.php';
        break;
    default:
        break;
}
