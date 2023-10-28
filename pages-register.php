<?php
    session_start();
    include_once 'DBFunctions/config.php';
    $connect = config();
     try {
        if ( isset($_POST['btn']) ) {
            $error = $_GET['error'];
            $successful=$_GET['successful'];
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $email = $_POST['email'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $age = $_POST['age'];
            $gender = $_POST['gender'];
            $file = $_FILES['file'];
            if ( isset($_FILES['file']) ) {
                if ( file_exists($_FILES['file']['tmp_name']) ) {
                    $filename = $_FILES['file']['name'];
                    $path = 'images/' . $email . '/' . $filename;
                    if (! is_dir($email) ) {
                        mkdir('images/' . $email);
                    }

                    move_uploaded_file($_FILES['file']['tmp_name'] , $path);
                }
            }




//        $_SESSION['image'] = $path;



            if (trim($firstname) != '' && trim($lastname) != '' && trim($email) != '' && trim($username) != '' && trim($password) != '' && trim($age) != '' && trim($gender) != '' && trim($path) != '' &&  strlen($password) >= 8 &&  isset($_POST['checkbox']) ) {
                $result = $connect->prepare("INSERT INTO users (name , lastname , email , username , password , age , gender , image ) VALUES (? , ? , ? , ? , ? , ? , ? , ?)" );
                $result->bindParam(1 , $firstname);
                $result->bindParam(2 , $lastname);
                $result->bindParam(3 , $email);
                $result->bindParam(4 , $username);
                $result->bindParam(5 , $password);
                $result->bindParam(6 , $age);
                $result->bindParam(7 ,$gender);
                $result->bindParam(8 , $path);
                $result->execute();
                header("location: pages-register.php?successful");
            }
            else {
                header("location: pages-register.php?error");
            }
        }
    } catch(Exception $x) {
        echo $x->getMessage();
    }


?>
<!DOCTYPE html>
<html lang="en">
    
<head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>زینزر - داشبورد ادمین بوت استرپ 4</title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="ThemeDesign" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <link rel="shortcut icon" href="assets/images/favicon.ico">
<!--        <script>-->
<!--            document.getElementById('nameFa').addEventListener('keypress',function(e){-->
<!---->
<!--                if ((e.charCode >= 97 && e.charCode <= 122) || (e.charCode>=65 && e.charCode<=90)){-->
<!--                    alert("Language is english");-->
<!--                    e.preventDefault();-->
<!--                }-->
<!---->
<!--                else if(isPersian(e.key))-->
<!--                    alert("Language is Persian");-->
<!--                else-->
<!--                    alert("Others");-->
<!--            });-->
<!---->
<!--            function isPersian(str){-->
<!--                var p = /^[\u0600-\u06FF\s]+$/;-->
<!--                return p.test(str);-->
<!--            }-->
<!--        </script>-->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
        <link href="assets/css/style.css" rel="stylesheet" type="text/css">

    </head>


    <body class="fixed-left">

        <!-- Loader -->
        <div id="preloader">
            <div id="status">
                <div class="spinner">
                    <div class="rect1"></div>
                    <div class="rect2"></div>
                    <div class="rect3"></div>
                    <div class="rect4"></div>
                    <div class="rect5"></div>
                </div>
            </div>
        </div>

        <!-- Begin page -->
        <div class="home-btn d-none d-sm-block">
            <a href="pages-login.php" class="text-dark"><i class="mdi mdi-home h1"></i></a>
        </div>

        <div class="account-pages">
            

            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 offset-lg-1">
                        <div class="text-left"> 
                            <div>
                                <a href="pages-login.php"" class="logo logo-admin"><img src="assets/images/logo_dark.png" height="28" alt="logo"></a>
                            </div>
                            <h5 class="font-14 text-muted mb-4">زینزر - داشبورد ادمین بوت استرپ 4 ریسپانسیو</h5>
                            <p class="text-muted mb-4">یک قالب مدیریتی حرفه ای برای انواع ادمین هایی که میخواهد شرکت و یا تجارت و مشتریان خود  را اداره کنند.</p>

                            <h5 class="font-14 text-muted mb-4">مقررات :</h5>
                            <div>
                                <p><i class="mdi mdi-arrow-right text-primary mr-2"></i>ستفاده از طراحان گرافیک است..</p>
                                <p><i class="mdi mdi-arrow-right text-primary mr-2"></i>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با ا.</p>
                                <p><i class="mdi mdi-arrow-right text-primary mr-2"></i>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با ا .</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="card mb-0">
                            <div class="card-body">
                                <div class="p-2">
                                    <h4 class="text-muted float-right font-18 mt-4">ثبت نام</h4>
                                    <div>
                                        <a href="pages-login.php" class="logo logo-admin"><img src="assets/images/logo_dark.png" height="28" alt="logo"></a>
                                    </div>
                                </div>
        
                                <div class="p-2">
                                    <form class="form-horizontal m-t-20" action="" method="POST" enctype="multipart/form-data">
        
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <input class="form-control" type="email" required="" placeholder="ایمیل" name="email">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-12">
                                                <input class="form-control" type="text" required="" placeholder="نام" name="firstname" id="nameFa">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-12">
                                                <input class="form-control" type="text" required="" placeholder="نام خانوادگی" name="lastname" id="nameFa">
                                            </div>
                                        </div>
            
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <input class="form-control" type="text" required="" placeholder="نام کاربری" name="username">
                                            </div>
                                        </div>
            
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <input class="form-control" type="password" required="" placeholder="رمز عبور (حداقل 8 کاراکتر وارد کنید)" name="password">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-12">
                                                <label for="">
                                                    سن:
                                                    <select name="age">
                                                        <?php
                                                            for ($i = 18; $i <= 75; $i++) {
                                                                echo "<option>$i</option>";
                                                            }
                                                        ?>
                                                    </select>
                                               </label>

                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-12">
                                                <label>
                                                    جنسیت:
                                                    <select name="gender" id="">
                                                        <?php
                                                        $g = array("آقا" , "خانم");
                                                        foreach ($g as $values) {
                                                            echo "<option>$values</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-12">
                                                <input class="form-control" type="file" name="file">
                                            </div>
                                        </div>
            
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="checkbox" id="customCheck1">
                                                    <label class="custom-control-label font-weight-normal" for="customCheck1">قبول میکنم <a href="#" class="text-primary">شرایط و ضوابط </a></label>
                                                </div>
                                            </div>
                                        </div>
            
                                        <div class="form-group text-center row m-t-20">
                                            <div class="col-12">
                                                <button class="btn btn-primary btn-block waves-effect waves-light" name="btn" type="submit">ثبت نام</button>
                                            </div>
                                        </div>
                                        <?php
                                        if (isset($_GET['error'])) {
                                        ?>
                                            <div class="alert alert-danger">

                                                <strong>لطفا تمامی قوانین را مطالعه کرده و گزینه تایید شرایط را بزنید.</strong>

                                            </div>
                                        <?php
                                            }
                                            elseif(isset($_GET['successful'])) {
                                        ?>
                                        <div class="alert alert-success">

                                            <strong>ثبت نام شما با موفقیت انجام شد.</strong>

                                        </div>
                                        <?php
                                            }
                                        ?>
                                        <?php
                                            if (isset($_GET['failed4'])):
                                        ?>
                                        <div class="alert alert-danger">
                                            <strong>نام کاربری قبلا به ثبت رسیده است.</strong>
                                        </div>
                                        <?php
                                            endif;
                                        ?>
                                        <?php
                                        if (isset($_GET['failed5'])):
                                            ?>
                                            <div class="alert alert-danger">
                                                <strong>ایمیل قبلا به ثبت رسیده است.</strong>
                                            </div>
                                        <?php
                                        endif;
                                        ?>

            
                                        <div class="form-group m-t-10 mb-0 row">
                                            <div class="col-12 m-t-20 text-center">
                                                <a href="pages-login.php" class="text-muted">در حال حاضر حساب کاربری دارید؟</a>
                                            </div>
                                        </div>
                                    </form>

                                </div>
        
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
        </div>


        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/modernizr.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>

        <!-- App js -->
        <script src="assets/js/app.js"></script>

    </body>

</html>