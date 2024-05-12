<?php
namespace controllers;

class Errors{
    public function not_found(){
        require_once 'views/errors/not_found.php';
    }
}