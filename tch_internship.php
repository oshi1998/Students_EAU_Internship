<?php
require_once('services/connect.php');
require_once('permissions/only_teacher.php');
?>

<?php
//รับค่าตัวแปร
$tch_id = $_SESSION["AUTH_ID"];
//คำสั่ง SQL SELECT ข้อมูลหัวหน้างานตามรหัส PK
$sql = "SELECT * FROM teachers WHERE tch_id='$tch_id'";
$query = mysqli_query($conn, $sql);
$tchObj = mysqli_fetch_object($query);
?>

<?php
//คำสั่ง SQL SELECT ข้อมูลปีการศึกษาของอาจารย์ที่มีนักศึกษาในการดูแล
$sql = "SELECT std_year FROM students WHERE tch_id='$tch_id' GROUP BY std_year ORDER BY std_year DESC";
$select_std_year_query = mysqli_query($conn, $sql);
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
                        <h3>ข้อมูลอาจารย์</h3>
                        <div class="row">
                            <div class="col-md-3 col-12">
                                <img class="img-responsive" src="assets/images/users/<?= $tchObj->tch_image ?>">
                            </div>
                            <div class="col-md-9 col-12">
                                <p>ชื่อ: <?= $tchObj->tch_firstname ?></p>
                                <p>นามสกุล: <?= $tchObj->tch_lastname ?></p>
                                <p>เบอร์โทรติดต่อ: <?= $tchObj->tch_tel ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <?php foreach ($select_std_year_query as $field) { ?>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-heading<?= $field['std_year'] ?>">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?= $field['std_year'] ?>" aria-expanded="false" aria-controls="flush-collapse<?= $field['std_year'] ?>">
                                            ปีการศึกษา <?= $field['std_year'] ?>
                                        </button>
                                    </h2>
                                    <div id="flush-collapse<?= $field['std_year'] ?>" class="accordion-collapse collapse" aria-labelledby="flush-heading<?= $field['std_year'] ?>" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <?php
                                            //คำสั่ง SQL SELECT ข้อมูลนักศึกษาในการดูแล
                                            $sql = "SELECT * FROM students WHERE tch_id='$tch_id'";
                                            $query = mysqli_query($conn, $sql);
                                            $std_num_rows = mysqli_num_rows($query);
                                            ?>
                                            <h3>รายชื่อนักศึกษาในการดูแล (<?= $std_num_rows . " คน" ?>)</h3>
                                            <div class="table-responsive">
                                                <table class="table table-striped text-center">
                                                    <thead>
                                                        <tr>
                                                            <th>ลำดับ</th>
                                                            <th>ชื่อ-นามสกุล</th>
                                                            <th>เบอร์โทรติดต่อ</th>
                                                            <th>รายงานฝึกงาน</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $no = 1; ?>
                                                        <?php foreach ($query as $row) { ?>
                                                            <tr>
                                                                <td><?= $no++; ?></td>
                                                                <td><?= $row['std_firstname'] . " " . $row['std_lastname'] ?></td>
                                                                <td><?= $row['std_tel'] ?></td>
                                                                <td>
                                                                    <a href="tch_std_internship_note.php?id=<?= $row['std_id'] ?>">รายงานฝึกงาน</a>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
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