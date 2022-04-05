<?php
require_once('services/connect.php');
require_once('permissions/only_teacher.php');
?>

<?php
//รับค่าตัวแปร
$tch_id = $_SESSION["AUTH_ID"];
?>

<?php
//คำสั่ง SQL
$sql = "SELECT * FROM students,internship_works WHERE students.std_id=internship_works.std_id AND internship_works.tch_id='$tch_id' ORDER BY intsw_date DESC";
$query = mysqli_query($conn, $sql);
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
                        <h3>ข้อมูลนักศึกษาขอจบการฝึกงาน</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped text-center">
                                <thead>
                                    <tr>
                                        <th>วัน/เดือน/ปี</th>
                                        <th>ชื่อ-นามสกุล</th>
                                        <th>เริ่มฝึกงานเมื่อ</th>
                                        <th>จบการฝึกงานเมื่อ</th>
                                        <th>อาจารย์ยืนยัน</th>
                                        <th>หัวหน้างานยืนยัน</th>
                                        <th>สถานะการขอจบ</th>
                                        <th>จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($query as $row) { ?>
                                        <tr>
                                            <td><?= $row['intsw_date'] ?></td>
                                            <td><?= $row['std_firstname'] . " " . $row['std_lastname'] ?></td>
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
                                            <td>
                                                <?php if ($row['intsw_tch_status'] == "ยังไม่ได้รับการยืนยัน") : ?>
                                                    <a href="services/intsw_tch_confirm.php?id=<?= $row['intsw_id'] ?>" onclick="return confirm('ยืนยันการอนุมัติ?')">อนุมัติ</a>
                                                <?php endif ?>
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