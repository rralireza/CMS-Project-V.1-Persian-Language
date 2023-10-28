<?php
    try {
        include_once 'DBFunctions/config.php';
        $connect = config();
        $data = $_POST['frm'];
        if ( isset($_FILES['image']) ) {
            if ( file_exists($_FILES['image']['tmp_name']) ) {
                $filename = $_FILES['image']['name'];
                $path = 'articleImages/' . $data['title'] . '/' . $filename;
                if (!is_dir($data['title'])) {
                    mkdir('articleImages/' . $data['title']);
                }
                move_uploaded_file($_FILES['image']['tmp_name'] , $path);
            }

        }
        if ( isset($_POST['btn']) ) {

            if (trim($data['title']) != '' && trim($data['category']) != '' && trim($data['text']) != '' && trim($path) != '') {
                $result = $connect->prepare("INSERT INTO articles (title , text , category , image , user_id) VALUES (? , ? , ? , ? , ?)");
                $result->bindParam(1 , $data['title']);
                $result->bindParam(2 , $data['text']);
                $result->bindParam(3 , $data['category']);
                $result->bindParam(4 , $path);
                $result->bindParam(5 , $_GET['pic']);
                $result->execute();
            }

        }
    } catch (Exception $x) {
        echo $x->getMessage();
    }
?>

<form method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title m-0" style="font-size: 14pt; font-weight: bold;">اضافه کردن نوشته‌ی جدید</h4>
                    </div>
                    <div class="col-md-4">
                        <div class="float-right d-none d-md-block">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="ti-settings mr-1"></i> تنظیمات
                                </button>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated">
                                    <a class="dropdown-item" href="#">عملیات</a>
                                    <a class="dropdown-item" href="#">اقدام دیگر</a>
                                    <a class="dropdown-item" href="#">چیز های دیگر</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">پیوند جدا شده</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end page-title-box -->
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-body">

                    <h4 class="mt-0 header-title">نوشتن متن جدید</h4>


                    <div class="form-group row">
                        <label for="example-text-input" class="col-sm-2 col-form-label">تیتر نوشته</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" placeholder="تیتر نوشته را وارد کنید" id="example-text-input" name="frm[title]">
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">انتخاب دسته‌بندی</label>
                        <div class="col-sm-10">
                            <select class="custom-select" name="frm[category]">
                                <option selected>دسته‌بندی موردنظر خودتان را انتخاب کنید</option>
                                <?php
                                    $connection = config();
                                    $showCategories = $connection->prepare("SELECT * FROM categories");
                                    $showCategories->execute();
                                    $items = $showCategories->fetchAll(PDO::FETCH_OBJ);
                                    foreach ($items as $row) {
                                        echo "<option value=\"$row->id\">$row->title</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card m-b-30">
                                <div class="card-body">



                                        <textarea style="width: 1175px; height: 200px;" name="frm[text]"></textarea>


                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div> <!-- end row -->

                    <div class="form-group row">
                        <label for="example-file-input" class="col-sm-1 col-form-label">تصویر کاور</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="file" value="تیتر نوشته را وارد کنید" id="example-text-input" name="image">
                        </div>
                    </div>

                    <button class="btn btn-dark" name="btn" type="submit">ثبت نوشته</button>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
</form>