<?php
include_once 'DBFunctions/config.php';
?>
<div class="row">
    <div class="col-lg-6">
        <div class="card m-b-30">
            <div class="card-body">

                <!--                <h4 class="mt-0 header-title">گزینه های جدول</h4>-->
                <!--                <p class="text-muted m-b-30">از یکی از دو کلاس اصلاح کننده استفاده کنید-->
                <!--                    <code>&lt;thead&gt;</code>به نظر می رسد نور یا خاکستری تیره.-->
                <!--                </p>-->
                <h3 class="mt-4 header-title">صفحه‌ی مدیریت نظرات</h3>
                <p>در این قسمت می‌توانید نظرات خودتان را مشاهده و در صورت نیاز ویرایش یا آنها را حذف کنید.</p>

                <div class="table-responsive">
                    <table class="table mb-0">
                            <thead class="thead-default">
                                <tr>
                                    <th>متن نظر</th>
                                    <th>نوشته</th>
                                    <th>زمان ثبت نظر</th>
                                    <th>ویرایش</th>
                                    <th>حذف</th>
                                </tr>
                            </thead>
                        <?php
                            $connect = config();
                            $picid = $_GET['pic'];
                            $result = $connect->prepare("SELECT * FROM comments INNER JOIN users ON comments.user_id = users.id WHERE users.id = ?");
                            $result->bindParam(1 , $picid);
                            $result->execute();
                            $rose = $result->fetchAll(PDO::FETCH_OBJ);
                            foreach ($rose as $row):
                        ?>
                            <tbody>
                                <tr>
                                    <th scope="row"><?php echo $row->text; ?></th>
                                    <td></td>
                                    <td></td>
                                    <td><a href="" class="btn btn-warning btn-xs"><i class="mdi mdi-pencil-outline"></i></a></td>
                                    <td><a href="" class="btn btn-danger btn-xs"><i class="mdi mdi-delete"></i></a></td>
                                </tr>
                            </tbody>
                        <?php
                            endforeach;
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div> <!-- end col -->