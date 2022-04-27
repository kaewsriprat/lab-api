<?php

include"include/autoload.php";

function getUsers(){
    $sql = "SELECT * FROM users";
    $conn = new query();
    $result = $conn->execute($sql);
    return $result;
}

function getUserById($id) {
    $sql = "SELECT * FROM users WHERE id = $id";
    $conn = new query();
    $result = $conn->execute($sql);
    return $result;
}

function login() {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "SELECT users.id, users.firstname, users.lastname, users.email ";
    $sql .= "FROM users ";
    $sql .= "WHERE email = '$email' AND password = '$password'";
    $conn = new query();
    $result = $conn->execute($sql);
    $conn->closeConnection();
    echo $sql . "<br/>";
    if($result) {
        echo $result[0]['token'];
        expireToken($result[0]['token']);
        $result[0]['token'] = createToken($result[0]['id']);
        return json_encode($result);
    } else {
        return json_encode(['error' => 'Invalid email or password']);
    }
}

function createToken($id) {
    $token = md5(uniqid(rand(), true));
    $createTokenSQL = "INSERT tokens_users (token, user_id) VALUES ('$token', '$id')";
    $conn = new query();
    $conn->execute($createTokenSQL);
    $conn->closeConnection();
    return $token;
}

function updateToken($id) {
    $token = md5(uniqid(rand(), true));
    $updateTokenSQL = "UPDATE tokens_users SET token = '$token' WHERE user_id = '$id' AND expire_at IS NULL";
    $conn = new query();
    $conn->execute($updateTokenSQL);
    $conn->closeConnection();
}

function expireToken($token) {
    $expireTokenSQL = "UPDATE tokens_users SET expire_at = NOW() WHERE token = '$token'";
    $conn = new query();
    $conn->execute($expireTokenSQL);
    $conn->closeConnection();
}

function checkToken() {
    $data = json_decode(file_get_contents('php://input'), true);
    $token = $data['token'];    
    $sql = "SELECT * FROM tokens_users WHERE token = '$token' AND expire_at IS NULL";
    $conn = new query();
    $result = $conn->execute($sql);
    $conn->closeConnection();
    if($result) {
        return json_encode(['tokenStatus' => true]);
    } else {
        return json_encode(['tokenStatus' => false]);
    }
}

function logout() { 
    $data = json_decode(file_get_contents('php://input'), true);
    $token = $data['token'];    
    expireToken($token);
}
