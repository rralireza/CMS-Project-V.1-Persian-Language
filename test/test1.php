<?php
$id = 1;
$connect = new PDO('mysql:host=localhost;dbname=cms;' , 'root' , '');
$result = $connect->prepare("SELECT * FROM users INNER JOIN comments ON users.id = comments.user_id WHERE users.id = ?");
$result->bindParam(1 , $id);
$result->execute();
$row = $result->fetchAll(PDO::FETCH_OBJ);

foreach ($row as $rose) {
    echo "<h1>$rose->text</h1>";
}