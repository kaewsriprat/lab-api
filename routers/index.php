<?php

$router = new router();
echo $router->getPath();
switch ($router->getPath()) {
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

?>