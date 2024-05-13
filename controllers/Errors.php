<?php
namespace controllers;

class Errors{
    public function index(){
        require_once 'views/errors/not_found.php';
    }
}