<?php
require_once('services/connect.php');
require_once('permissions/only_student.php');
?>

<?php
if (isset($_GET['week'])) {
    $week = $_GET['week'];

    if ($week >= 1 && $week <= 13) {

        $std_id = $_SESSION["AUTH_ID"];
        $sql = "SELECT * FROM internship_notes WHERE intsn_week='$week' AND std_id='$std_id' AND intsn_ovs_status='ยืนยันเรียบร้อย'";
        $check_intsn_status_query = mysqli_query($conn, $sql);
        $check_intsn_status_num_rows = mysqli_num_rows($check_intsn_status_query);
        
        if($check_intsn_status_num_rows>=1){
            echo "<script>
            alert('สัปดาห์ที่ $week ได้รับการยืนยันจากหัวหน้างาน หรือ อาจารย์ที่ปรึกษาเรียบร้อยแล้ว');
            window.location = 'internship_note.php'
        </script>";
        }

    } else {
        echo "<script>
            alert('Week ต้องอยู่ระหว่าง 1-13 เท่านั้น!');
            window.location = 'internship_note.php'
        </script>";
    }
} else {
    header("location:internship_note.php");
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
                        <h3>แบบฟอร์มบันทึกการฝึกงานรายวัน</h3>
                        <p class="text-danger">หมายเหตุ:</p>
                        <ul>
                            <li>หากลางานให้ติ๊กเลือกลางาน และไม่ต้องกรอกเวลาเข้า-ออกงาน และงานที่ได้รับมอบหมาย</li>
                            <li>หากสัปดาห์ไหนได้รับการยืนยันการบันทึกฝึกงานโดยหัวหน้างานเรียบร้อยแล้ว จะไม่สามารถบันทึกเพิ่มได้</li>
                        </ul>
                        <a href="internship_note.php">กลับหน้าบันทึกการฝึกงาน</a>
                    </div>
                    <div class="card-body">
                        <form action="services/internship_note_insert.php" method="post">
                            <div class="form-group">
                                <label>สัปดาห์ที่</label>
                                <input type="number" class="form-control" name="week" value="<?= $week ?>" min="1" max="13" required readonly>
                            </div>
                            <br>
                            <div class="form-group">
                                <label>วันที่</label>
                                <input type="date" class="form-control" name="date" value="<?= date("Y-m-d") ?>" required>
                            </div>
                            <br>
                            <div class="form-group">
                                <label>เวลาเข้างาน</label>
                                <input type="time" class="form-control" name="work_in">
                            </div>
                            <br>
                            <div class="form-group">
                                <label>เวลาออกงาน</label>
                                <input type="time" class="form-control" name="work_out">
                            </div>
                            <br>
                            <div class="form-group">
                                <label>มาทำงาน/ลางาน</label>
                                <input type="radio" name="leave" value="0" checked> มาทำงาน
                                <input type="radio" name="leave" value="1"> ลางาน
                            </div>
                            <br>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success" onclick="return confirm('ยืนยันการบันทึก?')">บันทึกข้อมูล</button>
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