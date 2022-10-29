<?php
    include_once 'config.php';
    function image () {
        $connect = config();
        $connect = config();
        $result = $connect->prepare("SELECT * FROM users WHERE id = '$id'");
        $result->execute();
        $icons = $result->fetchAll(PDO::FETCH_OBJ);
    }