<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method === 'OPTIONS') {
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
        header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
        exit();
    }

    require_once '../../config/Database.php';
    //require_once '../../config/DatabaseLocal.php';
    require_once '../../models/Quote.php';

    if ($method === 'GET') {
        header('Access-Control-Allow-Methods: GET');
        if(!isset($_GET['id'])) {
            require_once 'read.php';
        } else {
            require_once 'read_single.php';
        }        
    }

    elseif ($method === 'POST') {
        header('Access-Control-Allow-Methods: POST');
        require_once 'create.php';
    }

    elseif ($method === 'PUT') {
        header('Access-Control-Allow-Methods: PUT');
        require_once 'update.php';
    }

    elseif ($method === 'DELETE') {
        header('Access-Control-Allow-Methods: DELETE');
        require_once 'delete.php';
    }