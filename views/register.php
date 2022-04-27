<?php

$request = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', $request);
if (isset($request[3])) {
    $request = $request[3];
}
switch ($method) {
    case 'GET':
        switch ($request) {
            default:
                break;
        }
        break;
    case 'POST':
        switch ($request) {
            case 'userRegister': 
                echo userRegister();
                break;
            default:
                break;
        }
        break;
    default:
        break;
}
