<?php

function userRegister() {
    $newUser = array(
        'firstname' => $_POST['firstname'],
        'lastname' => $_POST['lastname'],
        'email' => $_POST['email'],
        'password' => $_POST['password'],
        'active' => 1
    );
    if(userIsValid($newUser['email'])){
        $sql = "INSERT INTO users (firstname, lastname, email, password, active) VALUES ('$newUser[firstname]', '$newUser[lastname]', '$newUser[email]', '$newUser[password]', '$newUser[active]')";
        try {
            $conn = new query();
            $conn->execute($sql);
            $conn->closeConnection();
            return json_encode(['success' => 'User created']);
        } catch (Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    } else {
        return json_encode(['error' => 'User already exists']);
    } 
}

function userIsValid($email) {
    try {
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $conn = new query();
        $result = $conn->execute($sql);
        $conn->closeConnection();
        if($result) {
            return false;
        } else {
            return true;
        }
    } catch (Exception $e) {
        return json_encode(['error' => $e->getMessage()]);
    }
}

?>