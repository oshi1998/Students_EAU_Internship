<?php
require_once('services/connect.php');
require_once('permissions/only_admin.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบการฝึกงานของนักศึกษาคณะเทคโนโลยีสารสนเทศมหาวิทยาลัยอีสเทิร์นเอเชีย</title>

    <?php require_once('include/css.php'); ?>
</head>

<body>

    <div class="container">
        <!-- include menu -->
        <?php require_once('include/menu.php') ?>
        <!-- end include -->

        <!-- content -->

        <div class="row mt-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3>แบบฟอร์มเพิ่มข้อมูลอาจารย์</h3>
                        <a href="teacher_table.php">กลับหน้าตารางข้อมูล</a>
                    </div>
                    <div class="card-body">
                        <form action="services/teacher_insert.php" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>ชื่อจริง</label>
                                <input type="text" class="form-control" name="firstname" required>
                            </div>
                            <br>
                            <div class="form-group">
                                <label>นามสกุล</label>
                                <input type="text" class="form-control" name="lastname" required>
                            </div>
                            <br>
                            <div class="form-group">
                                <label>เพศ</label>
                                <select class="form-control" name="gender">
                                    <option value="ชาย">ชาย</option>
                                    <option value="หญิง">หญิง</option>
                                </select>
                            </div>
                            <br>
                            <div class="form-group">
                                <label>ที่อยู่</label>
                                <textarea class="form-control" name="address" required></textarea>
                            </div>
                            <br>
                            <div class="form-group">
                                <label>เบอร์โทร</label>
                                <input type="text" class="form-control" name="tel" required>
                            </div>
                            <br>
                            <div class="form-group">
                                <label>อีเมล</label>
                                <input type="email" class="form-control" name="email" required>
                            </div>
                            <br>
                            <div class="form-group">
                                <label>รหัสผ่าน</label>
                                <input type="password" class="form-control" name="password" required>
                            </div>
                            <br>
                            <div class="form-group">
                                <label>ไฟล์รูปประจำตัว เฉพาะไฟล์ jpeg,jpg และ png เท่านั้น</label>
                                <input type="file" class="form-control" name="image" accept="image/*">
                            </div>
                            <br>

                            <div class="form-group">
                                <button type="submit" class="btn btn-success">บันทึกข้อมูล</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>

        <!-- end content -->

        <!-- include footer -->
        <?php require_once('include/footer.php'); ?>
        <!-- end include -->
    </div>



    <?php require_once('include/js.php'); ?>
</body>

</html>