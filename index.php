<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');

    require_once '../../config/DatabaseLocal.php';
    //require_once '../../config/Database.php';
    require_once '../../api/authors/';
    require_once '../../api/categories/';
    require_once '../../api/quotes/';

    // Instantiate Database & connect
    $database = new Database();
    $db = $database->connect();