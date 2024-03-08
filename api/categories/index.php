<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method === 'OPTIONS') {
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
        header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
        exit();
    }

    // require_once '../../config/Database.php';
    require_once '../../config/DatabaseLocal.php';
    require_once '../../models/Author.php';

    if (method === 'GET') {
        header('Access-Control-Allow-Methods: GET');
        require_once 'read.php';
    }