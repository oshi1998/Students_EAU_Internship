<?php
require_once('services/connect.php');
require_once('permissions/only_student.php');
?>

<?php
//รับค่าตัวแปร
$std_id = $_SESSION["AUTH_ID"];
//คำสั่ง SQL SELECT ข้อมูลนักศึกษาตามรหัส PK
$sql = "SELECT * FROM students,teachers,overseers,internship_places WHERE students.tch_id=teachers.tch_id AND students.ovs_id=overseers.ovs_id
AND students.intsp_id=internship_places.intsp_id AND std_id='$std_id'";
$query = mysqli_query($conn, $sql);
$stdObj = mysqli_fetch_object($query);
?>

<?php
//คำสั่ง SQL
$sql = "SELECT * FROM internship_works WHERE std_id='$std_id' ORDER BY intsw_date DESC";
$query = mysqli_query($conn, $sql);
$num_rows = mysqli_num_rows($query);
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
                        <h3>ข้อมูลนักศึกษา</h3>
                        <div class="row">
                            <div class="col-md-3 col-12">
                                <img class="img-responsive" src="assets/images/users/<?= $stdObj->std_image ?>">
                            </div>
                            <div class="col-md-9 col-12">
                                <p>ชื่อ: <?= $stdObj->std_firstname ?></p>
                                <p>นามสกุล: <?= $stdObj->std_lastname ?></p>
                                <p>เบอร์โทรติดต่อ: <?= $stdObj->std_tel ?></p>
                                <p>สถานที่ฝึกงาน: <?= $stdObj->intsp_name ?></p>
                                <p>อาจารย์ที่ปรึกษา: <?= $stdObj->tch_firstname . " " . $stdObj->tch_lastname ?></p>
                                <p>หัวหน้างาน: <?= $stdObj->ovs_firstname . " " . $stdObj->ovs_lastname ?></p>
                                <p>สถานะการฝึกงาน: <?= $stdObj->std_status ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        <?php if ($num_rows <= 0) : ?>
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            แบบฟอร์มขอจบการฝึกงาน
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <form action="services/internship_work_insert.php" method="post">
                                                <div class="form-group">
                                                    <label>วันที่เริ่มฝึกงาน</label>
                                                    <input type="date" class="form-control" name="start" required>
                                                </div>
                                                <br>
                                                <div class="form-group">
                                                    <label>วันที่จบการฝึกงาน</label>
                                                    <input type="date" class="form-control" name="end" required>
                                                </div>
                                                <br>
                                                <button type="submit" class="btn btn-success">ส่งแบบฟอร์ม</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif ?>
                        <div class="table-responsive">
                            <table class="table table-striped text-center">
                                <thead>
                                    <tr>
                                        <th>วัน/เดือน/ปี</th>
                                        <th>เริ่มฝึกงานเมื่อ</th>
                                        <th>จบการฝึกงานเมื่อ</th>
                                        <th>อาจารย์ยืนยัน</th>
                                        <th>หัวหน้างานยืนยัน</th>
                                        <th>สถานะการขอจบ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($query as $row) { ?>
                                        <tr>
                                            <td><?= $row['intsw_date'] ?></td>
                                            <td><?= $row['intsw_start_date'] ?></td>
                                            <td><?= $row['intsw_end_date'] ?></td>
                                            <td><?= $row['intsw_tch_status'] ?></td>
                                            <td><?= $row['intsw_ovs_status'] ?></td>
                                            <td>
                                                <?php
                                                if ($row['intsw_tch_status'] == "ยังไม่ได้รับการยืนยัน" && $row['intsw_ovs_status'] == "ยังไม่ได้รับการยืนยัน") {
                                                    echo "รอการยืนยันจากอาจารย์และหัวหน้างาน";
                                                } else if ($row['intsw_tch_status'] == "ยังไม่ได้รับการยืนยัน" && $row['intsw_ovs_status'] == "ยืนยันเรียบร้อย") {
                                                    echo "รอการยืนยันจากอาจารย์";
                                                } else if ($row['intsw_tch_status'] == "ยืนยันเรียบร้อย" && $row['intsw_ovs_status'] == "ยังไม่ได้รับการยืนยัน") {
                                                    echo "รอการยืนยันจากหัวหน้างาน";
                                                } else {
                                                    echo "สำเร็จ";
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
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