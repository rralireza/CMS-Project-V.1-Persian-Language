<?php
    $id = $_GET['id'];
    include_once 'DBFunctions/config.php';
    include_once 'DBFunctions/showCatForEdit.php';
    $connect = config();
    $showData = $connect->prepare("SELECT * FROM articles WHERE id = ?");
    $showData->bindParam(1 , $id);
    $showData->execute();
    $items = $showData->fetchAll(PDO::FETCH_OBJ);

    if (isset($_POST['btn'])){
        //something to do!
        $data = $_POST['frm'];
        $connect = config();
        if ($_FILES['image']['name'] != '') {
            if ( file_exists($_FILES['image']['tmp_name']) ) {
                $filename = $_FILES['image']['name'];
                $path = 'articleImages/' . $data['title'] . '/' . $filename;
                if (!is_dir($data['title'])) {
                    mkdir('articleImages/' . $data['title']);
                }
                move_uploaded_file($_FILES['image']['tmp_name'] , $path);
            }
        } else {
            $path = $items->image;
        }
        $result = $connect->prepare("UPDATE articles SET title = ? , text = ? , category = ? , image = ? WHERE id='$id'");
        $result->bindParam(1 , $data['title']);
        $result->bindParam(2 , $data['text']);
        $result->bindParam(3 , $data['category']);
        $result->bindParam(4 , $path);
        $result->execute();
    }
?>

<form method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title m-0" style="font-size: 14pt; font-weight: bold;">ویرایش نوشته‌های قدیمی</h4>
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
                    <?php foreach ($items as $row): ?>
                    <h4 class="mt-0 header-title">ویرایش مقاله‌ی <?php echo "<span style='font-weight: bold;'>$row->title</span>" ?></h4>


                    <div class="form-group row">
                        <label for="example-text-input" class="col-sm-2 col-form-label">تیتر نوشته</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" placeholder="تیتر نوشته را وارد کنید" id="example-text-input" name="frm[title]" value="<?php echo $row->title; ?>">
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">انتخاب دسته‌بندی</label>
                        <div class="col-sm-10">
                            <select class="custom-select" name="frm[category]">
                                <option selected>دسته‌بندی موردنظر خودتان را انتخاب کنید</option>
                                <?php
                                    $categories = showCats();
                                    foreach ($categories as $items) {
                                        echo "<option value=\"$items->id\" ";
                                        if ($row->category == $items->id) {
                                            echo " selected";
                                        }
                                    echo "> $items->title </option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card m-b-30">
                                <div class="card-body">



                                    <textarea style="width: 1175px; height: 200px;" name="frm[text]"><?php echo $row->text; ?></textarea>


                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div> <!-- end row -->

                    <div class="form-group row">
                        <label for="example-file-input" class="col-sm-1 col-form-label">تصویر کاور</label>
                             <img src="<?php echo $row->image; ?>" class="rounded-circle" height="80px" width="80px">
                        <div class="col-sm-10">
                            <input class="form-control" type="file" value="<?php echo $row->image ?>>" id="example-text-input" name="image">
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <button class="btn btn-dark" name="btn" type="submit">ویرایش نوشته</button>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
</form>