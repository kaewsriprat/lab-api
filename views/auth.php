<?php

$request = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', $request);
if (isset($request[3])) {
    $request = $request[3];
    $id = explode('/', $_SERVER['REQUEST_URI']);
    if(isset($id[4])){
        $id = $id[4];
    }
}
switch ($method) {
    case 'GET':
        switch ($request) {
            case 'getUsers':
                echo json_encode(getUsers());
                break;
            case 'getUserById':
                echo json_encode(getUserById($id));
                break;
            default:
                break;
        }
        break;
    case 'POST':
        switch ($request) {
            case 'login': 
                echo login();
                break;
            case 'checkToken':
                echo checkToken();
                break;
            case 'logout':
                logout();
                break;
            default:
                break;
        }
        break;
    default:
        break;
}
