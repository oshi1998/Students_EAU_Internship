<?php
require_once('services/connect.php');
require_once('permissions/only_student.php');
?>

<?php
if (isset($_GET["id"])) {

    //รับค่า GET
    $id = $_GET["id"];

    //คำสั่ง SQL
    $sql = "SELECT * FROM students WHERE std_id='$id'";
    $query = mysqli_query($conn, $sql);
    $data = mysqli_fetch_object($query);
} else {
    header("location:admin_table.php");
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
                        <h3>แบบฟอร์มแก้ไขข้อมูลส่วนตัว</h3>
                        <a href="internship_note.php">กลับหน้าบันทึกรายงาน</a>
                    </div>
                    <div class="card-body">
                       <form action="services/std_update.php" method="POST">
                           <div class="form-group">
                               <label>ชื่อจริง</label>
                               <input type="text" class="form-control" name="firstname" value="<?= $data->std_firstname ?>" required>
                           </div>
                           <br>
                           <div class="form-group">
                               <label>นามสกุล</label>
                               <input type="text" class="form-control" name="lastname" value="<?= $data->std_lastname ?>" required>
                           </div>
                           <br>
                           <div class="form-group">
                               <label>เบอร์โทร</label>
                               <input type="text" class="form-control" name="tel" value="<?= $data->std_tel ?>" required>
                           </div>
                           <br>
                           <button type="submit" class="btn btn-success">บันทึก</button>
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