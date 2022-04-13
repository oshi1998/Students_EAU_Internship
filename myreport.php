<?php
require_once('services/connect.php');
?>

<?php
if (isset($_POST['type']) && isset($_POST['year']) && isset($_POST['intsp_id'])) {

    $type = mysqli_real_escape_string($conn, $_POST['type']);
    $year = mysqli_real_escape_string($conn, $_POST['year']);
    $intsp_id = mysqli_real_escape_string($conn, $_POST['intsp_id']);

    if ($intsp_id == 'all') {
        //select สถานที่ฝึกงานทั้งหมด
        $sql = "SELECT * FROM internship_places ORDER BY intsp_created DESC";
        $intsp_query = mysqli_query($conn, $sql);
        if ($type == 'teacher') {
            $title = "รายชื่ออาจารย์ที่ปรึกษาจากสถานประกอบการทั้งหมด <br>ประจำปีการศึกษา $year";
        } else if ($type == 'student') {
            $title = "รายชื่อนักศึกษาฝึกงานจากสถานประกอบการทั้งหมด <br>ประจำปีการศึกษา $year";
        } else {
            echo "<script>
            alert('ไม่สามารถพิมพ์รายงานได้!');
            window.history.back()
        </script>";
        }
    } else {
        if ($type == 'teacher') {
            //select ข้อมูลอาจารย์ตามปีการศึกษาและสถานที่ฝึกงาน
            $sql = "SELECT tch_firstname as firstname,tch_lastname as lastname,tch_gender as gender,tch_address as address,tch_tel as tel,intsp_name,intsp_address,intsp_tel FROM students,teachers,internship_places WHERE students.tch_id=teachers.tch_id AND students.intsp_id=internship_places.intsp_id AND std_year='$year' AND students.intsp_id='$intsp_id'";
            $type_name = "อาจารย์ที่ปรึกษา";
        } else if ($type == 'student') {
            //select ข้อมูลนักศึกษาฝึกงานตามปีการศึกษาและสถานที่ฝึกงาน
            $sql = "SELECT std_firstname as firstname,std_lastname as lastname,std_gender as gender,std_address as address,std_tel as tel,intsp_name,intsp_address,intsp_tel FROM students,internship_places WHERE students.intsp_id=internship_places.intsp_id AND std_year='$year' AND students.intsp_id='$intsp_id'";
            $type_name = "นักศึกษาฝึกงาน";
        } else {
            echo "<script>
            alert('ไม่สามารถพิมพ์รายงานได้!');
            window.history.back()
        </script>";
        }

        $report_query = mysqli_query($conn, $sql);
        $reportObj = mysqli_fetch_object($report_query);

        $title = "รายชื่อ$type_name" . "จากสถานประกอบการ$reportObj->intsp_name <br>ประจำปีการศึกษา $year";
    }
} else {
    echo "<script>
        alert('ไม่สามารถพิมพ์รายงานได้!');
        window.history.back()
    </script>";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>

    <?php require_once('include/css.php'); ?>

    <style>
        @media print {
            .pagebreak {
                clear: both;
                page-break-after: always;
            }

            body {
                font-size: 12px;
            }
        }
    </style>
</head>

<body>
    <div class="container text-center">
        <?php if ($intsp_id == 'all') : ?>
            <?php foreach ($intsp_query as $row1) { ?>
                <?php
                if ($type == 'teacher') {
                    //select ข้อมูลอาจารย์ตามปีการศึกษาและสถานที่ฝึกงาน
                    $sql = "SELECT tch_firstname as firstname,tch_lastname as lastname,tch_gender as gender,tch_address as address,tch_tel as tel,intsp_name,intsp_address,intsp_tel FROM students,teachers,internship_places WHERE students.tch_id=teachers.tch_id AND students.intsp_id=internship_places.intsp_id AND std_year='$year' AND students.intsp_id='$row1[intsp_id]'";
                    $type_name = "อาจารย์ที่ปรึกษา";
                } else if ($type == 'student') {
                    //select ข้อมูลนักศึกษาฝึกงานตามปีการศึกษาและสถานที่ฝึกงาน
                    $sql = "SELECT std_firstname as firstname,std_lastname as lastname,std_gender as gender,std_address as address,std_tel as tel,intsp_name,intsp_address,intsp_tel FROM students,internship_places WHERE students.intsp_id=internship_places.intsp_id AND std_year='$year' AND students.intsp_id='$row1[intsp_id]'";
                    $type_name = "นักศึกษาฝึกงาน";
                }

                $report_query = mysqli_query($conn, $sql);
                $reportObj = mysqli_fetch_object($report_query);

                $header = "รายชื่อ$type_name" . "จากสถานประกอบการ$reportObj->intsp_name <br>ประจำปีการศึกษา $year";
                ?>

                <div class="row mt-5">
                    <div class="col-12">
                        <img src="assets/images/logo.png">
                    </div>
                    <div class="col-12">
                        <h3><?= $header ?></h3>
                    </div>
                </div>

                <div class="row mt-5">
                    <?php if(mysqli_num_rows($report_query)>0) : ?>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ลำดับ</th>
                                    <th>ชื่อ-นามสกุล</th>
                                    <th>เพศ</th>
                                    <th>ที่อยู่</th>
                                    <th>เบอร์โทรศัพท์</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($report_query as $row) { ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $row['firstname'] . " " . $row['lastname'] ?></td>
                                        <td><?= $row['gender'] ?></td>
                                        <td><?= $row['address'] ?></td>
                                        <td><?= $row['tel'] ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <?php else : ?>
                        <p>ไม่พบรายชื่อ<?= $type_name ?></p>
                    <?php endif ?>
                </div>


                <div class="pagebreak"></div>
            <?php } ?>
        <?php else : ?>

            <div class="row mt-5">
                <div class="row mt-5">
                    <div class="col-12">
                        <img src="assets/images/logo.png">
                    </div>
                    <div class="col-12">
                        <h3><?= $title ?></h3>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ลำดับ</th>
                                <th>ชื่อ-นามสกุล</th>
                                <th>เพศ</th>
                                <th>ที่อยู่</th>
                                <th>เบอร์โทรศัพท์</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($report_query as $row) { ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $row['firstname'] . " " . $row['lastname'] ?></td>
                                    <td><?= $row['gender'] ?></td>
                                    <td><?= $row['address'] ?></td>
                                    <td><?= $row['tel'] ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endif ?>
    </div>
</body>

</html>