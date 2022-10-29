<?php

function config () {
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $db = 'cms';
    $connect = new PDO('mysql:host=localhost;dbname=cms' , $username , $password);
    return $connect;
}
