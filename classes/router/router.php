<?php

class router {

    private $request; 

    public function __construct() {
        $this->request = $_SERVER['REQUEST_URI'];
    }

    public function getPath() {
        return $this->request[2];
    }

    public function getMethod() {
        $this->request = $_SERVER['REQUEST_METHOD'];
        return $this->request;
    }

}


?>