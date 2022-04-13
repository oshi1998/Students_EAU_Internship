<?php
require_once('services/connect.php');
require_once('permissions/only_admin.php');
?>

<?php
//คำสั่ง SQL สถานที่ฝึกงาน
$sql = "SELECT * FROM internship_places ORDER BY intsp_created DESC";
$intsp_query = mysqli_query($conn, $sql);

//คำสั่ง SQL ปีการศึกษา
$sql = "SELECT std_year FROM students GROUP BY std_year ORDER BY std_year DESC";
$std_year_query = mysqli_query($conn, $sql);
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
                        <h3>พิมพ์รายงานรายชื่อ อาจารย์ที่ปรึกษา หรือ นักศึกษาฝึกงาน</h3>
                    </div>
                    <div class="card-body w-25">
                        <form action="myreport.php" method="post">
                            <label>อาจารย์ที่ปรึกษา หรือ นักศึกษาฝึกงาน</label>
                            <select class="form-control" name="type">
                                <option value="teacher">อาจารย์ที่ปรึกษา</option>
                                <option value="student">นักศึกษาฝึกงาน</option>
                            </select>
                            <label>ปีการศึกษา</label>
                            <select class="form-control" name="year" required>
                                <option value="" selected disabled>---- เลือกปีการศึกษา ----</option>
                                <?php foreach ($std_year_query as $row) { ?>
                                    <option value="<?= $row['std_year'] ?>"><?= $row['std_year'] ?></option>
                                <?php } ?>
                            </select>
                            <br>
                            <label>สถานที่ฝึกงาน</label>
                            <select class="form-control" name="intsp_id">
                                <option value="all">---- ทัั้งหมด ----</option>
                                <?php foreach ($intsp_query as $row) { ?>
                                    <option value="<?= $row['intsp_id'] ?>"><?= $row['intsp_name'] ?></option>
                                <?php } ?>
                            </select>
                            <br>
                            <button type="submit" class="btn btn-success">พิมพ์</button>
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