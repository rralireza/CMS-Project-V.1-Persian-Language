<?php
include_once 'DBFunctions/config.php';
include_once 'DBFunctions/showCatForEdit.php';
?>
<div class="row">
    <div class="col-lg-6">
        <div class="card m-b-30">
            <div class="card-body">

                <!--                <h4 class="mt-0 header-title">گزینه های جدول</h4>-->
                <!--                <p class="text-muted m-b-30">از یکی از دو کلاس اصلاح کننده استفاده کنید-->
                <!--                    <code>&lt;thead&gt;</code>به نظر می رسد نور یا خاکستری تیره.-->
                <!--                </p>-->
                <h3 class="mt-4 header-title">صفحه‌ی دسته بندی‌ها</h3>
                <p>در این قسمت می‌توانید دسته بندی‌های خودتان را مدیریت کنید. به طور کلی در این بخش می‌توان تمامی دسته بندی‌های ثبت شده را مشاهده و آن‌ها را در صورت تمایل، ویرایش یا حذف کرد.</p>

                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="thead-default">
                        <tr>
                            <th>عنوان</th>
                            <th>وضعیت نمایش</th>
                            <th>وضعیت دسته‌بندی</th>
                            <th>ویرایش</th>
                            <th>حذف</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            $connect = config();
                            $result = $connect->prepare("SELECT * FROM categories");
                            $result->execute();
                            $items = $result->fetchAll(PDO::FETCH_OBJ);
                            foreach ($items as $row):
                        ?>
                            <tr>
                                <th scope="row"><?php echo "<span class='btn btn-outline-dark waves-effect waves-light' style='border-radius: 20px;'>$row->title</span>"; ?></th>
                                <td><?php if ($row->status == 0) {
                                        echo "<span class='btn btn-outline-danger waves-effect waves-light' style='border-radius: 20px;'>غیر فعال</span>";
                                    } elseif ($row->status == 1) {
                                        echo "<span class='btn btn-outline-success waves-effect waves-light' style='border-radius: 20px;'>فعال</span>";
                                    } ?></td>
                                <td><?php if ($row->chid == 0) {
                                        echo "<span class='btn btn-outline-primary waves-effect waves-light' style='border-radius: 20px;'>سرگروه</span>";
                                    } else {
                                        $subCat = showSubCat($row->chid);
                                        echo "<span class='btn btn-outline-info waves-effect waves-light' style='border-radius: 20px;'>$subCat</span>";
                                    } ?></td>
                                <?php
                                    $pic = $_GET['pic'];
                                    $connect = config();
                                    $result = $connect->prepare("SELECT * FROM users WHERE id = ?");
                                    $result->bindParam(1 , $pic);
                                    $result->execute();
                                    $show = $result->fetchAll(PDO::FETCH_OBJ);
                                    foreach ($show as $value):
                                ?>
                                <td><a href="dashboard.php?m=categories&p=edit&id=<?php echo $row->id ?>&pic=<?php echo $value->id ?>" class="btn btn-warning btn-xs" style='border-radius: 20px;'><i class="mdi mdi-pencil-outline"></i></a></td>
                                <td><a href="dashboard.php?m=categories&p=delete&id=<?php  echo $row->id ?>&pic=<?php echo $value->id ?>" class="btn btn-danger btn-xs" style='border-radius: 20px;'><i class="mdi mdi-delete"></i></a></td>
                            </tr>
                        <?php
                            endforeach;
                        ?>
                        <?php
                            endforeach;
                        ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> <!-- end col -->