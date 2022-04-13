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

                                <a href="std_edit_form.php?id=<?= $std_id ?>">แก้ไขข้อมูลส่วนตัว</a>
                                <a target="_blank" href="std_report.php?type=personal&std_id=<?= $std_id ?>">พิมพ์ประวัติส่วนตัว</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h3>บันทึกการฝึกงาน</h3>
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <?php for ($i = 1; $i <= 13; $i++) { ?>
                                    <button class="nav-link" id="nav-week<?= $i ?>-tab" data-bs-toggle="tab" data-bs-target="#nav-week<?= $i ?>" type="button" role="tab" aria-controls="nav-week<?= $i ?>" aria-selected="false">สัปดาห์ที่ <?= $i ?></button>
                                <?php } ?>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <?php for ($i = 1; $i <= 13; $i++) { ?>
                                <div class="tab-pane fade" id="nav-week<?= $i ?>" role="tabpanel" aria-labelledby="nav-week<?= $i ?>-tab">

                                    <?php
                                    $sql = "SELECT * FROM internship_notes WHERE std_id='$std_id' AND intsn_week='$i' ORDER BY intsn_date ASC";
                                    $intsn_query = mysqli_query($conn, $sql);

                                    $intsn_num_rows = mysqli_num_rows($intsn_query);
                                    $intsn_object = mysqli_fetch_object($intsn_query);
                                    ?>

                                    <h3 class="mt-3">รายละเอียดการฝึกงานสัปดาห์ที่ <?= $i ?></h3>
                                    <?php if ($intsn_num_rows >= 1) : ?>
                                        <p>สถานะยืนยันจากหัวหน้างาน: <span class="<?= ($intsn_object->intsn_ovs_status == 'ยังไม่ได้รับการยืนยัน') ? "text-danger" : "text-success" ?>"><?= $intsn_object->intsn_ovs_status ?></span></p>
                                        <p>สถานะยืนยันจากอาจารย์ที่ปรึกษา: <span class="<?= ($intsn_object->intsn_tch_status == 'ยังไม่ได้รับการยืนยัน') ? "text-danger" : "text-success" ?>"><?= $intsn_object->intsn_tch_status ?></span></p>
                                        <?php if ($intsn_object->intsn_job == "") :  ?>
                                            <a class="mt-3" href="internship_note_daily_add_form.php?week=<?= $i ?>">บันทึกการฝึกงานรายวัน</a>
                                            <a class="mt-3" href="internship_note_weekly_add_form.php?week=<?= $i ?>">บันทึกการฝึกงานรายสัปดาห์</a>
                                        <?php else : ?>
                                            <ul>
                                                <li><a target="_blank" href="std_report.php?type=daily&week=<?= $i ?>&std_id=<?= $std_id ?>">บันทึกการลงเวลาปฏิบัติงาน (สัปดาห์ที่ <?= $i ?>)</a></li>
                                                <li><a target="_blank" href="std_report.php?type=weekly&week=<?= $i ?>&std_id=<?= $std_id ?>">บันทึกรายละเอียดการฝึกปฏิบัติงานรายสัปดาห์ (สัปดาห์ที่ <?= $i ?>)</a></li>
                                            </ul>
                                        <?php endif ?>
                                        <hr>
                                        <div class="table-responsive">
                                            <table class="table table-bordered text-center">
                                                <thead>
                                                    <tr>
                                                        <th colspan="4">บันทึกการมาทำงานรายวัน</th>
                                                    </tr>
                                                    <tr clas>
                                                        <th>วันที่</th>
                                                        <th>เวลาเข้างาน</th>
                                                        <th>เวลาออกงาน</th>
                                                        <th>มาทำงาน/ลางาน</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($intsn_query as $row) { ?>
                                                        <tr>
                                                            <td><?= $row['intsn_date'] ?></td>
                                                            <td><?= $row['intsn_work_in'] ?></td>
                                                            <td><?= $row['intsn_work_out'] ?></td>
                                                            <td>
                                                                <?php
                                                                if ($row['intsn_leave'] == 0) {
                                                                    echo "<span class='text-success'>มาทำงาน</span>";
                                                                } else {
                                                                    echo "<span class='text-danger'>ลางาน</span>";
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>

                                        <br>

                                        <h4>บันทึกรายละเอียดการฝึกปฏิบัติงานรายสัปดาห์</h4>
                                        <br>

                                        <?php
                                        if ($intsn_object->intsn_job != "") {
                                            //select วันทำงาน แรกและสุดท้ายของสัปดาห์
                                            $sql = "SELECT min(intsn_date) as min_date,max(intsn_date) as max_date FROM internship_notes WHERE intsn_week='$i' AND std_id='$std_id'";
                                            $intsn_select_date_query = mysqli_query($conn, $sql);
                                            $intsn_select_date_obj = mysqli_fetch_object($intsn_select_date_query);
                                            $min_date = $intsn_select_date_obj->min_date;
                                            $max_date = $intsn_select_date_obj->max_date;
                                        }
                                        ?>

                                        <p>วัน/เดือน/ปี ที่ได้รับมอบหมาย: <?= ($intsn_object->intsn_job == "") ? "<span class='text-danger dottedUnderline'>นักศึกษายังไม่ได้บันทึกการทำงานรายสัปดาห์</span>" : "<span class='dottedUnderline'>$min_date</span>" ?></p>
                                        <p>ลักษณะงานที่มอบหมาย: <?= ($intsn_object->intsn_job == "") ? "<span class='text-danger dottedUnderline'>นักศึกษายังไม่ได้บันทึกการทำงานรายสัปดาห์</span>" : "<span class='dottedUnderline'>$intsn_object->intsn_job</span>" ?></p>
                                        <p>วัน/เดือน/ปี ที่ส่งงาน: <?= ($intsn_object->intsn_job == "") ? "<span class='text-danger dottedUnderline'>นักศึกษายังไม่ได้บันทึกการทำงานรายสัปดาห์</span>" : "<span class='dottedUnderline'>$max_date</span>" ?></p>
                                        <br>
                                        <div class="table-responsive">
                                            <table class="table table-bordered text-center">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            ขั้นตอนการทำงาน ผลการปฏิบัติงาน (ได้ผลเป็นอย่างไร ทำได้มาก น้อยเพียงใด ระยะเวลาที่ใช้)
                                                            และข้อบกพร่องของงาน ปัญหาและวิธีการแก้ปัญหา (ถ้ามี) (ให้รายงานตามลักษณะงานแต่ละประเภท)
                                                        </th>
                                                        <th>บุคคล/หน่วยงานที่ต้องประสานงาน</th>
                                                        <th>เวลาที่แล้วเสร็จ</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td style="text-align: left;">
                                                            <h6>ขั้นตอนการปฏิบัติงาน</h6>
                                                            <p><?= ($intsn_object->intsn_work_step == "") ? "<span class='text-danger'>นักศึกษายังไม่ได้บันทึกการทำงานรายสัปดาห์</span>" : $intsn_object->intsn_work_step ?></p>
                                                            <br>

                                                            <h6>ผลการปฏิบัติงาน</h6>
                                                            <p><?= ($intsn_object->intsn_work_result == "") ? "<span class='text-danger'>นักศึกษายังไม่ได้บันทึกการทำงานรายสัปดาห์</span>" : $intsn_object->intsn_work_result ?></p>
                                                        </td>
                                                        <td><?= $stdObj->ovs_firstname . " " . $stdObj->ovs_lastname ?></td>
                                                        <td><?= ($intsn_object->intsn_job == "") ? "<span class='text-danger'>นักศึกษายังไม่ได้บันทึกการทำงานรายสัปดาห์</span>" : $max_date ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <br>

                                        <strong>สิ่งที่ได้เรียนรู้จากงานที่ได้รับมอบหมาย</strong>
                                        <p><?= ($intsn_object->intsn_work_learn == "") ? "<span class='text-danger dottedUnderline'>นักศึกษายังไม่ได้บันทึกการทำงานรายสัปดาห์</span>" : "<span class='dottedUnderline'>$intsn_object->intsn_work_learn</span>" ?></p>
                                        <br>

                                        <strong>ปัญหาที่พบจากการปฏิบัติงานและแนวทางแก้ไข</strong>
                                        <p><?= ($intsn_object->intsn_work_issue == "") ? "<span class='text-danger dottedUnderline'>นักศึกษายังไม่ได้บันทึกการทำงานรายสัปดาห์</span>" : "<span class='dottedUnderline'>$intsn_object->intsn_work_issue</span>" ?></p>
                                        <br>

                                        <strong>สิ่งที่ต้องนำไปปรับปรุงภายหลังการฝึกงาน (ให้ระบุความรู้ ทักษะที่ต้องทบทวน หรือศึกษาเพิ่มเติม)</strong>
                                        <p><?= ($intsn_object->intsn_work_improve == "") ? "<span class='text-danger dottedUnderline'>นักศึกษายังไม่ได้บันทึกการทำงานรายสัปดาห์</span>" : "<span class='dottedUnderline'>$intsn_object->intsn_work_improve</span>" ?></p>
                                        <br>

                                        <strong><u class="dotted">สำหรับผู้รับผิดชอบการฝึกงาน</u></strong>
                                        <br>
                                        <strong>การตรวจสอบผลการปฏิบัติงาน (โปรดระบุคุณภาพของงาน ระยะเวลาที่แล้วเสร็จ ข้อบกพร่อง และคำแนะนำ)</strong>
                                        <p><?= ($intsn_object->intsn_work_performance == "") ? "<span class='text-danger dottedUnderline'>หัวหน้างานยังไม่ได้ทำการตรวจสอบ</span>" : "<span class='dottedUnderline'>$intsn_object->intsn_work_performance</span>" ?></p>
                                        <br>
                                    <?php else : ?>
                                        <p class="text-danger">สัปดาห์ที่ <?= $i ?> ยังไม่มีการบันทึกการฝึกงาน</p>
                                        <?php if ($stdObj->std_status == 'อยู่ระหว่างการฝึกงาน') : ?>
                                            <a class="mt-3" href="internship_note_daily_add_form.php?week=<?= $i ?>">บันทึกการฝึกงานรายวัน</a>
                                        <?php endif ?>
                                    <?php endif ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="row mt-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3>พิมพ์รายงาน</h3>
                    </div>
                    <div class="card-body">
                        <ul>
                            <li><a target="_blank" href="std_report.php?type=daily&week=all&std_id=<?= $std_id ?>">บันทึกการลงเวลาปฏิบัติงาน (ทั้งหมด)</a></li>
                            <li><a target="_blank" href="std_report.php?type=weekly&week=all&std_id=<?= $std_id ?>">บันทึกรายละเอียดการฝึกปฏิบัติงานรายสัปดาห์ (ทั้งหมด)</a></li>
                        </ul>
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