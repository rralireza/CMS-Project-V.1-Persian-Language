<?php

    function config() {
        $connect = new PDO("mysql:host=localhost;dbname=cms;" , "root" , "");
        return $connect;
    }