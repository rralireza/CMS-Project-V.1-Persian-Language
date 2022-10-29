<?php
    include_once 'DBFunctions/config.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Main Page</title>
</head>
<body>
    <form>
        <ul>
            <?php
                $connect = config();
                $result = $connect->prepare("SELECT * FROM articles");
                $result->execute();
                $row = $result->fetchAll(PDO::FETCH_OBJ);
                foreach ($row as $rose) {
                    echo "<img src='$rose->image' width='750' height='500'>";
                    echo "<h3>$rose->title</h3>";
                    echo "<h3>$rose->text</h3>";
                }
                ?>

        </ul>
    </form>
</body>
</html>