<?php

    
    function login ($data) {
        if ( isset($_POST['btn']) ) {
            $data = $_POST['frm'];
//        $error = $_GET['error'];
//        $error2 = $_GET['error2'];
            $result = $connect->prepare("SELECT * FROM users WHERE username = ?");
            $result->bindParam(1, $data['username']);
            $result->execute();
            $row = $result->fetch(PDO::FETCH_OBJ);
            if ($row->password == $data['password']) {
                $_SESSION['name'] = $row->name;
//                $picture = $row->image;
                header("location: dashboard.php");
            }
            else {
                header("location: pages-login.php?error");
            }
        }
    }