<?php
require_once('services/connect.php');
require_once('permissions/only_admin.php');
?>

<?php
if (isset($_GET["id"])) {

    //รับค่า GET
    $id = $_GET["id"];

    //คำสั่ง SQL
    $sql = "SELECT * FROM teachers WHERE tch_id='$id'";
    $query = mysqli_query($conn, $sql);
    $data = mysqli_fetch_object($query);
} else {
    header("location:teacher_table.php");
}
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
                        <h3>แบบฟอร์มแก้ไขข้อมูลอาจารย์</h3>
                        <a href="teacher_table.php">กลับหน้าตารางข้อมูล</a>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-edit-tab" data-bs-toggle="pill" data-bs-target="#pills-edit" type="button" role="tab" aria-controls="pills-edit" aria-selected="true">แก้ไขข้อมูล</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-editPass-tab" data-bs-toggle="pill" data-bs-target="#pills-editPass" type="button" role="tab" aria-controls="pills-editPass" aria-selected="false">แก้ไขรหัสผ่าน</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-delete-tab" data-bs-toggle="pill" data-bs-target="#pills-delete" type="button" role="tab" aria-controls="pills-delete" aria-selected="false">ลบข้อมูล</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-edit" role="tabpanel" aria-labelledby="pills-edit-tab">
                                <form action="services/teacher_update.php" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-6 col-12 text-center">
                                            <img src="assets/images/users/<?= $data->tch_image ?>" width="225" height="250">
                                            <input type="text" class="form-control" name="old_image" value="<?= $data->tch_image ?>" readonly hidden>
                                            <input type="file" class="form-control" name="image" accept="image/*">
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <input type="text" class="form-control" name="id" value="<?= $data->tch_id ?>" readonly hidden>
                                            <div class="form-group">
                                                <label>ชื่อจริง</label>
                                                <input type="text" class="form-control" name="firstname" value="<?= $data->tch_firstname ?>" required>
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <label>นามสกุล</label>
                                                <input type="text" class="form-control" name="lastname" value="<?= $data->tch_lastname ?>" required>
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <label>เพศ</label>
                                                <select class="form-control" name="gender">
                                                    <option value="ชาย" <?= ($data->tch_gender == "ชาย") ? "selected" : "" ?>>ชาย</option>
                                                    <option value="หญิง" <?= ($data->tch_gender == "หญิง") ? "selected" : "" ?>>หญิง</option>
                                                </select>
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <label>ที่อยู่</label>
                                                <textarea class="form-control" name="address" required><?= $data->tch_address ?></textarea>
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <label>เบอร์โทร</label>
                                                <input type="text" class="form-control" name="tel" value="<?= $data->tch_tel ?>" required>
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <label>อีเมล</label>
                                                <input type="email" class="form-control" name="email" value="<?= $data->tch_email ?>" required>
                                            </div>

                                            <br>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-success">
                                                    บันทึกข้อมูล
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane fade" id="pills-editPass" role="tabpanel" aria-labelledby="pills-editPass">
                                <form action="services/teacher_update_password.php" method="post">
                                    <p>*ยืนยันตัวตนผู้ดูแลระบบ</p>
                                    <input type="text" class="form-control" name="id" value="<?= $data->tch_id ?>" readonly hidden>
                                    <div class="form-group">
                                        <label>รหัสผ่านของคุณ</label>
                                        <input type="password" class="form-control" name="password" required>
                                    </div>
                                    <br>
                                    <hr>
                                    <p>*แก้ไขรหัสผ่าน</p>
                                    <div class="form-group">
                                        <label>รหัสผ่านใหม่</label>
                                        <input type="password" class="form-control" name="new_password" required>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary" onclick="return confirm('ยืนยันการแก้ไขรหัสผ่าน?')">
                                            ดำเนินการแก้ไข
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane fade" id="pills-delete" role="tabpanel" aria-labelledby="pills-delete-tab">
                                <form action="services/teacher_delete.php" method="post">
                                    <p>*ยืนยันตัวตนผู้ดูแลระบบ</p>
                                    <input type="text" class="form-control" name="id" value="<?= $data->tch_id ?>" readonly hidden>
                                    <div class="form-group">
                                        <label>รหัสผ่านของคุณ</label>
                                        <input type="password" class="form-control" name="password" required>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('ยืนยันการลบ?')">
                                            ดำเนินการลบ
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
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