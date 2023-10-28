<?php
    include_once 'DBFunctions/config.php';
    if (isset($_POST['btn'])) {
        $data = $_POST['frm'];
        $connect = config();
        $result = $connect->prepare("INSERT INTO categories (title , chid , status) VALUES (? , ? , ?)");
        $result->bindParam(1 , $data['title']);
        $result->bindParam(2 , $data['chid']);
        $result->bindParam(3 , $data['status']);
        $result->execute();
    }
    if (isset($_POST['exit'])) {
        header('location:dashboard.php?m=index&p=index');
    }

    if (isset($_POST['exit'])) {
        header("location: dashboard.php?m=categories&p=list");
    }

?>
<form action="" method="post">
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h4 class="page-title m-0">اضافه کردن دسته بندی جدید</h4>
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

<!--                <h4 class="mt-0 header-title">ورودی های متن</h4>-->
<!--                <p class="text-muted m-b-30 font-14">در اینجا نمونه هایی از <code-->
<!--                            class="highlighter-rouge">.form-control</code> به هر HTML5 متنی اعمال می شود <code class="highlighter-rouge">&lt;input&gt;</code> <code-->
<!--                            class="highlighter-rouge">تایپ</code>.</p>-->

                <div class="form-group row">
                    <label for="example-text-input" class="col-sm-2 col-form-label">عنوان دسته</label>
                    <div class="col-sm-10">
                        <input class="form-control" name="frm[title]" type="text" placeholder="لطفا عنوان دسته بندی موردنظر خودتان را وارد کنید" id="example-text-input">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">وضعیت گروه‌بندی دسته</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="frm[chid]">
                            <option value="0">دسته‌ی اصلی</option>
                            <?php
                                $connection = config();
                                $submenu = $connection->prepare("SELECT * FROM categories");
                                $submenu->execute();
                                $items = $submenu->fetchAll(PDO::FETCH_OBJ);
                                foreach ($items as $row) {
                                    echo "<option value=\"$row->id\">$row->title</option>";
                                }
                            ?>

                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">وضعیت</label>
                    <div class="col-sm-10">
                        <select class="custom-select" name="frm[status]">
                            <option value="1">فعال</option>
                            <option value="0">غیرفعال</option>
                        </select>
                    </div>
                </div>

                <button type="submit" name="btn" class="btn btn-success waves-effect waves-light">ثبت دسته</button>
                <button type="reset" class="btn btn-warning waves-effect waves-light">بازنشانی اطلاعات</button>
                <button type="submit" name="exit" class="btn btn-danger waves-effect waves-light" >انصراف</button>

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
</form>