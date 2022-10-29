<?php
include_once 'DBFunctions/config.php';
$id = $_GET['id'];
$pic = $_GET['pic'];
$connect = config();
$result = $connect->prepare("DELETE FROM categories WHERE id = ?");
$result->bindParam(1 , $id);
$result->execute();

$showImage = $connect->prepare("SELECT * FROM users WHERE id = ?");
$showImage->bindParam(1 , $pic);
$showImage->execute();
$row = $showImage->fetch(PDO::FETCH_OBJ);
header("location:dashboard.php?m=categories&p=list&pic=$row->id");
