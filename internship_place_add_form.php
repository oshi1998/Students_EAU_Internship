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
                        <h3>แบบฟอร์มเพิ่มข้อมูลสถานที่ฝึกงาน</h3>
                        <a href="internship_place_table.php">กลับหน้าตารางข้อมูล</a>
                    </div>
                    <div class="card-body">
                        <form action="services/internship_place_insert.php" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>ชื่อสถานที่</label>
                                <input type="text" class="form-control" name="name" required>
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