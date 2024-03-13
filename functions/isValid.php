<?php
    header('Access-Control-Allow-Methods: GET');

    function isValid($id, $model) {
        $model->id = $id;
        return $model->read_single($model->id);
    }
?>