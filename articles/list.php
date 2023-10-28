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
                    <h3 class="mt-4 header-title">صفحه‌ی مدیریت نوشته‌ها</h3>
                    <p>در این قسمت می‌توانید نوشته‌های خودتان را مدیریت کنید. به طور کلی در این بخش می‌توان تمامی مطالب ثبت شده را مشاهده و همچنین، نوشته‌های قبلی را در صورت تمایل، ویرایش یا حذف کرد.</p>

                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="thead-default">
                        <tr>
                            <th>عنوان</th>
                            <th>دسته بندی</th>
                            <th>تصویر</th>
                            <th>ویرایش</th>
                            <th>حذف</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            $connect = config();
                            $result = $connect->prepare("SELECT * FROM articles INNER JOIN users ON articles.user_id = users.id WHERE users.id = ?");
                            $result->bindParam(1 , $_GET['pic']);
                            $result->execute();
                            $items = $result->fetchAll(PDO::FETCH_OBJ);
                            foreach ($items as $row):
                        ?>
                                <?php

                                ?>
                        <tr>
                            <th scope="row"><?php echo $row->title; ?></th>
                            <td><?php

                                $id = $row->category;
                                $connect = config();
                                $result = $connect->prepare("SELECT * FROM categories WHERE id = ?");
                                $result->bindParam(1 , $id);
                                $result->execute();
                                $rows = $result->fetchAll(PDO::FETCH_OBJ);
                                foreach ($rows as $rose) {
                                    echo "<span class='btn btn-outline-info waves-effect waves-light' style='border-radius: 10px;'>$rose->title</span>";
                                }

                                ?></td>
                            <?php
                            $connect = config();
                            $picid = $_GET['pic'];
                            $result = $connect->prepare("SELECT * FROM users WHERE id = ?");
                            $result->bindParam(1 , $picid);
                            $result->execute();
                            $roze = $result->fetchAll(PDO::FETCH_OBJ);
                            foreach ($roze as $roses):
                            ?>
                            <td><img src="<?php echo $row->image; ?>" width="100px" height="50px"></td>
                            <td><a href="dashboard.php?m=articles&p=edit&id=<?php echo $row->id; ?>&pic=<?php echo $roses->id ?>" class="btn btn-warning btn-xs"><i class="mdi mdi-pencil-outline"></i></a></td>
                            <td><a href="dashboard.php?m=articles&p=delete&id=<?php echo $row->id; ?>&pic=<?php echo $roses->id ?>" class="btn btn-danger btn-xs"><i class="mdi mdi-delete"></i></a></td>
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