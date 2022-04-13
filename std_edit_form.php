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

    <style>
        h4 {
            border-bottom: 3px solid;
        }
    </style>
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
                        <form action="services/std_update.php" method="POST" enctype="multipart/form-data">
                            <h4>ข้อมูลส่วนตัว</h4>
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
                                <label>ชั้นปี</label>
                                <input type="number" class="form-control" name="class_year" min="1" max="9" value="<?= $data->std_class_year ?>" required>
                            </div>
                            <br>
                            <div class="form-group">
                                <label>รหัสนักศึกษา</label>
                                <input type="text" class="form-control" name="number" value="<?= $data->std_number ?>" required>
                            </div>
                            <br>
                            <div class="form-group">
                                <label>วันเดือนปีเกิด</label>
                                <input type="date" class="form-control" name="born" value="<?= $data->std_born ?>" required>
                            </div>
                            <br>
                            <div class="form-group">
                                <label>สัญชาติ</label>
                                <input type="text" class="form-control" name="nationality" value="<?= $data->std_nationality ?>" required>
                            </div>
                            <br>
                            <div class="form-group">
                                <label>เชื้อชาติ</label>
                                <input type="text" class="form-control" name="ethnicity" value="<?= $data->std_ethnicity ?>" required>
                            </div>
                            <br>
                            <div class="form-group">
                                <label>ศาสนา</label>
                                <input type="text" class="form-control" name="religion" value="<?= $data->std_religion ?>" required>
                            </div>
                            <br>
                            <div class="form-group">
                                <label>บัตรประจำตัวประชาชนเลขที่</label>
                                <input type="text" class="form-control" name="id_card" value="<?= $data->std_id_card ?>" minlength="13" maxlength="13" required>
                            </div>
                            <br>
                            <div class="form-group">
                                <label>ที่อยู่ภูมิลำเนาเดิม</label>
                                <textarea class="form-control" name="domicile" required><?= $data->std_domicile ?></textarea>
                            </div>
                            <br>
                            <div class="form-group">
                                <label>ที่อยู่ปัจจุบัน</label>
                                <textarea class="form-control" name="address" required><?= $data->std_address ?></textarea>
                            </div>
                            <br>
                            <div class="form-group">
                                <label>เบอร์โทรที่ติดต่อสะดวก</label>
                                <input type="text" class="form-control" name="tel" value="<?= $data->std_tel ?>" required>
                            </div>
                            <br>
                            <h4>ข้อมูลผู้ปกครอง</h4>
                            <div class="form-group">
                                <label>ชื่อบิดา</label>
                                <input type="text" class="form-control" name="father_name" value="<?= $data->std_father_name ?>" required>
                            </div>
                            <br>
                            <div class="form-group">
                                <label>อายุบิดา</label>
                                <input type="number" class="form-control" name="father_age" value="<?= $data->std_father_age ?>" required>
                            </div>
                            <br>
                            <div class="form-group">
                                <label>อาชีพบิดา</label>
                                <input type="text" class="form-control" name="father_occupation" value="<?= $data->std_father_occupation ?>" required>
                            </div>
                            <br>
                            <div class="form-group">
                                <label>ชื่อมารดา</label>
                                <input type="text" class="form-control" name="mother_name" value="<?= $data->std_mother_name ?>" required>
                            </div>
                            <br>
                            <div class="form-group">
                                <label>อายุมารดา</label>
                                <input type="number" class="form-control" name="mother_age" value="<?= $data->std_mother_age ?>" required>
                            </div>
                            <br>
                            <div class="form-group">
                                <label>อาชีพมารดา</label>
                                <input type="text" class="form-control" name="mother_occupation" value="<?= $data->std_mother_occupation ?>" required>
                            </div>
                            <br>
                            <div class="form-group">
                                <label>ที่อยู่ผู้ปกครองปัจจุบัน</label>
                                <textarea class="form-control" name="parent_address" required><?= $data->std_parent_address ?></textarea>
                            </div>
                            <br>
                            <div class="form-group">
                                <label>ชื่อผู้ปกครองในขณะที่ศึกษาอยู่</label>
                                <input type="text" class="form-control" name="parent_name" value="<?= $data->std_parent_name ?>" required>
                            </div>
                            <br>
                            <div class="form-group">
                                <label>เกี่ยวข้องเป็น</label>
                                <input type="text" class="form-control" name="parent_relationship" value="<?= $data->std_parent_relationship ?>" required>
                            </div>
                            <br>
                            <div class="form-group">
                                <label>เบอร์โทรศัพท์ผู้ปกครอง</label>
                                <input type="text" class="form-control" name="parent_tel" value="<?= $data->std_parent_tel ?>" required>
                            </div>
                            <br>
                            <h4>ความสามารถพิเศษ</h4>
                            <div class="form-group">
                                <label>ความสามารถพิเศษ 1</label>
                                <input type="text" class="form-control" name="talent_1" value="<?= $data->std_talent_1 ?>" required>
                            </div>
                            <br>
                            <div class="form-group">
                                <label>ความสามารถพิเศษ 2</label>
                                <input type="text" class="form-control" name="talent_2" value="<?= $data->std_talent_2 ?>" required>
                            </div>
                            <br>
                            <h4>เกี่ยวกับการฝึกงาน</h4>
                            <div class="form-group">
                                <label>ชื่ออาจารย์นิเทศการฝึกงาน</label>
                                <input type="text" class="form-control" name="internship_instuctor" value="<?= $data->std_internship_instuctor ?>" required>
                            </div>
                            <br>
                            <div class="form-group">
                                <label>ไฟล์ภาพแผนที่บ้านพักถึงสถานประกอบการที่ฝึกงาน โดยสังเขป</label>
                                <input name="old_map" value="<?= $data->std_map ?>" readonly hidden>
                                <input type="file" class="form-control" name="map" accept="image/*">
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