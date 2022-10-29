<?php

    include_once 'DBFunctions/config.php';

    function showCats () {
        $connect = config();
        $result = $connect->prepare("SELECT * FROM categories");
        $result->execute();
        $row = $result->fetchAll(PDO::FETCH_OBJ);
        return $row;

    }

    function showSubCat ($id) {
        $connect = config();
        $result = $connect->prepare("SELECT * FROM categories WHERE id = ?");
        $result->bindParam(1 , $id);
        $result->execute();
        $rows = $result->fetch(PDO::FETCH_OBJ);
        return $rows->title;
    }

    function showCatData ($id) {
        $connect = config();
        $result = $connect->prepare("SELECT * FROM categories WHERE id = ?");
        $result->bindParam(1 , $id);
        $result->execute();
        $rows = $result->fetchAll(PDO::FETCH_OBJ);
        return $rows;
    }