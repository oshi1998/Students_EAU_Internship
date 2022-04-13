<?php
require_once('services/connect.php');
?>

<?php
//รับค่าตัวแปร
if (isset($_GET['type']) && isset($_GET['week']) && isset($_GET['std_id'])) {

    $type = mysqli_real_escape_string($conn, $_GET['type']);
    $week = mysqli_real_escape_string($conn, $_GET['week']);
    $std_id = mysqli_real_escape_string($conn, $_GET['std_id']);

    if ($type == 'daily') {
        if ($week == 'all') {
            $sql = "SELECT intsn_date,intsn_work_in,intsn_work_out,intsn_leave FROM internship_notes WHERE std_id='$std_id' ORDER BY intsn_date ASC";
        } else {
            $sql = "SELECT intsn_date,intsn_work_in,intsn_work_out,intsn_leave FROM internship_notes WHERE intsn_week='$week' AND std_id='$std_id' ORDER BY intsn_date ASC";
        }

        $report_query = mysqli_query($conn, $sql);

        $title = "ใบบันทึกลงเวลาปฏิบัติงาน";
        $sub_title = ($week == 'all') ? "" : "สัปดาห์ที่ $week";
    } else if ($type == 'weekly') {

        //คำสั่ง SQL SELECT ข้อมูลนักศึกษาตามรหัส PK
        $sql = "SELECT * FROM students,teachers,overseers,internship_places WHERE students.tch_id=teachers.tch_id AND students.ovs_id=overseers.ovs_id
        AND students.intsp_id=internship_places.intsp_id AND std_id='$std_id'";
        $query = mysqli_query($conn, $sql);
        $stdObj = mysqli_fetch_object($query);

        if ($week == 'all') {
            $sql = "SELECT * FROM internship_notes WHERE std_id='$std_id' GROUP BY intsn_week ORDER BY intsn_date ASC";
        } else {
            $sql = "SELECT * FROM internship_notes WHERE std_id='$std_id' AND intsn_week='$week' ORDER BY intsn_date ASC";
        }

        $intsn_query = mysqli_query($conn, $sql);
        $intsn_object = mysqli_fetch_object($intsn_query);

        $title = "บันทึกรายละเอียดการฝึกปฏิบัติงานรายสัปดาห์";
        $sub_title = "";
    } else {
        echo "<script>
            alert('ไม่สามารถพิมพ์รายงานได้');
            window.history.back()
        </script>";
    }
} else if (isset($_GET['type']) && isset($_GET['std_id'])) {

    function DayThai($strDate)
    {
        $strDay = date("j", strtotime($strDate));
        return "$strDay";
    }

    function MonthThai($strDate)
    {
        $strMonth = date("n", strtotime($strDate));
        $strMonthCut = array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
        $strMonthThai = $strMonthCut[$strMonth];
        return "$strMonthThai";
    }

    function YearThai($strDate)
    {
        $strYear = date("Y", strtotime($strDate)) + 543;
        return "$strYear";
    }

    function calAge($strDate)
    {
        $currentYear = date("Y");
        $strYear = date("Y", strtotime($strDate));
        $age = intval($currentYear - $strYear);
        return "$age";
    }

    $type = mysqli_real_escape_string($conn, $_GET['type']);
    $std_id = mysqli_real_escape_string($conn, $_GET['std_id']);

    if ($type == 'personal') {
        //คำสั่ง SQL SELECT ข้อมูลนักศึกษาตามรหัส PK
        $sql = "SELECT * FROM students,teachers,overseers,internship_places WHERE students.tch_id=teachers.tch_id AND students.ovs_id=overseers.ovs_id
        AND students.intsp_id=internship_places.intsp_id AND std_id='$std_id'";
        $query = mysqli_query($conn, $sql);
        $stdObj = mysqli_fetch_object($query);

        if ($stdObj->std_number != '') {
            $sql = "SELECT intsw_start_date,intsw_end_date FROM internship_works WHERE std_id='$std_id' AND intsw_tch_status='ยืนยันเรียบร้อย' AND intsw_ovs_status='ยืนยันเรียบร้อย'";
            $query = mysqli_query($conn, $sql);
            $intswObj = mysqli_fetch_object($query);
        } else {
            echo "<script>
                alert('ไม่สามารถพิมพ์ประวัติได้ กรุณากรอกข้อมูลประวัติส่วนตัวให้ครบถ้วน');
                window.location='std_edit_form.php?id=$std_id'
            </script>";
        }

        $title = "ประวัตินักศึกษาฝึกงาน";
    } else {
        echo "<script>
            alert('ไม่สามารถพิมพ์รายงานได้');
            window.history.back()
        </script>";
    }
} else {
    echo "<script>
            alert('ไม่สามารถพิมพ์รายงานได้');
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
        <?php if ($type == 'daily') : ?>
            <div class="row mt-5">
                <div class="col-12">
                    <h3><?= $title ?></h3>
                    <h4><?= $sub_title ?></h4>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-12">

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>วันที่ (ว/ด/ป)</th>
                                    <th>เวลาเข้างาน</th>
                                    <th>เวลาออกงาน</th>
                                    <th>จำนวนชั่วโมง(สะสม)</th>
                                    <th>หมายเหตุ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($report_query as $row) { ?>
                                    <?php
                                    //จำนวนชั่วโมงสะสม
                                    $work_in = explode(':', $row['intsn_work_in']);
                                    $work_in = $work_in[0] + floor(($work_in[1] / 60) * 100) / 100 . PHP_EOL;
                                    $work_out = explode(':', $row['intsn_work_out']);
                                    $work_out = $work_out[0] + floor(($work_out[1] / 60) * 100) / 100 . PHP_EOL;
                                    $comulative_hours = number_format($work_out - $work_in, 0);
                                    ?>
                                    <tr>
                                        <td><?= $row['intsn_date'] ?></td>
                                        <td><?= substr($row['intsn_work_in'], 0, 5) ?></td>
                                        <td><?= substr($row['intsn_work_out'], 0, 5) ?></td>
                                        <td><?= $comulative_hours ?></td>
                                        <td><?= ($row['intsn_leave'] == '1') ? "<strong class='text-danger'>ลางาน</strong>" : "" ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php elseif ($type == 'weekly') : ?>
            <?php if ($week == 'all') : ?>
                <?php foreach ($intsn_query as $row) { ?>
                    <div class="row mt-5">
                        <div class="col-12">
                            <img src="assets/images/logo.png">
                        </div>
                        <div class="col-12">
                            <h3><?= $title ?></h3>
                            <h4><?= $sub_title ?></h4>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-12" style="text-align: left;">

                            <?php

                            //select วันทำงาน แรกและสุดท้ายของสัปดาห์
                            $sql = "SELECT min(intsn_date) as min_date,max(intsn_date) as max_date FROM internship_notes WHERE intsn_week='$row[intsn_week]' AND std_id='$std_id'";
                            $intsn_select_date_query = mysqli_query($conn, $sql);
                            $intsn_select_date_obj = mysqli_fetch_object($intsn_select_date_query);
                            $min_date = $intsn_select_date_obj->min_date;
                            $max_date = $intsn_select_date_obj->max_date;

                            ?>

                            <p>วัน/เดือน/ปี ที่ได้รับมอบหมาย: <span class='dottedUnderline'><?= $min_date ?></span></p>
                            <p>ลักษณะงานที่มอบหมาย: <span class='dottedUnderline'><?= $row['intsn_job'] ?></span></p>
                            <p>วัน/เดือน/ปี ที่ส่งงาน: <span class='dottedUnderline'><?= $max_date ?></span></p>
                            <br>
                            <div class="table-responsive">
                                <table class="table table-bordered text-center">
                                    <thead>
                                        <tr>
                                            <th style="width: 50%;">
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
                                                <p><?= $row['intsn_work_step'] ?></p>
                                                <br>

                                                <h6>ผลการปฏิบัติงาน</h6>
                                                <p><?= $row['intsn_work_result'] ?></p>
                                            </td>
                                            <td><?= $stdObj->ovs_firstname . " " . $stdObj->ovs_lastname ?></td>
                                            <td><?= $max_date ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <br>

                            <strong>สิ่งที่ได้เรียนรู้จากงานที่ได้รับมอบหมาย</strong>
                            <p><?= "<span class='dottedUnderline'>$row[intsn_work_learn]</span>" ?></p>
                            <br>

                            <strong>ปัญหาที่พบจากการปฏิบัติงานและแนวทางแก้ไข</strong>
                            <p><?= "<span class='dottedUnderline'>$row[intsn_work_issue]</span>" ?></p>
                            <br>

                            <strong>สิ่งที่ต้องนำไปปรับปรุงภายหลังการฝึกงาน (ให้ระบุความรู้ ทักษะที่ต้องทบทวน หรือศึกษาเพิ่มเติม)</strong>
                            <p><?= "<span class='dottedUnderline'>$row[intsn_work_improve]</span>" ?></p>
                            <br>

                            <strong><u class="dotted">สำหรับผู้รับผิดชอบการฝึกงาน</u></strong>
                            <br>
                            <strong>การตรวจสอบผลการปฏิบัติงาน (โปรดระบุคุณภาพของงาน ระยะเวลาที่แล้วเสร็จ ข้อบกพร่อง และคำแนะนำ)</strong>
                            <p><?= "<span class='dottedUnderline'>$row[intsn_work_performance]</span>" ?></p>

                            <div class="row mt-5 text-center">
                                <div class="col-6">
                                    <p>ลงชื่อ ...........<?= $stdObj->std_firstname ?>..<?= $stdObj->std_lastname ?>........... <br>
                                        (.....<?= $stdObj->std_firstname ?>..<?= $stdObj->std_lastname ?>..........) <br>
                                        นักศึกษา
                                    </p>
                                </div>

                                <div class="col-6">
                                    <p>ลงชื่อ .................................................................. <br>
                                        (.....<?= $stdObj->ovs_firstname ?>..<?= $stdObj->ovs_lastname ?>..........) <br>
                                        ผู้รับผิดชอบการฝึกงาน/ผู้มอบหมายงาน
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pagebreak"></div>
                <?php } ?>

            <?php else : ?>
                <div class="row mt-5">
                    <div class="col-12">
                        <img src="assets/images/logo.png">
                    </div>
                    <div class="col-12">
                        <h3><?= $title ?></h3>
                        <h4><?= $sub_title ?></h4>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-12" style="text-align: left;">
                        <?php
                        //select วันทำงาน แรกและสุดท้ายของสัปดาห์
                        $sql = "SELECT min(intsn_date) as min_date,max(intsn_date) as max_date FROM internship_notes WHERE intsn_week='$week' AND std_id='$std_id'";
                        $intsn_select_date_query = mysqli_query($conn, $sql);
                        $intsn_select_date_obj = mysqli_fetch_object($intsn_select_date_query);
                        $min_date = $intsn_select_date_obj->min_date;
                        $max_date = $intsn_select_date_obj->max_date;

                        ?>
                        <p>วัน/เดือน/ปี ที่ได้รับมอบหมาย: <span class='dottedUnderline'><?= $min_date ?></span></p>
                        <p>ลักษณะงานที่มอบหมาย: <span class='dottedUnderline'><?= $intsn_object->intsn_job ?></span></p>
                        <p>วัน/เดือน/ปี ที่ส่งงาน: <span class='dottedUnderline'><?= $max_date ?></span></p>
                        <br>
                        <div class="table-responsive">
                            <table class="table table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th style="width: 50%;">
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
                                            <p><?= $intsn_object->intsn_work_step ?></p>
                                            <br>

                                            <h6>ผลการปฏิบัติงาน</h6>
                                            <p><?= $intsn_object->intsn_work_result ?></p>
                                        </td>
                                        <td><?= $stdObj->ovs_firstname . " " . $stdObj->ovs_lastname ?></td>
                                        <td><?= $max_date ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <br>

                        <strong>สิ่งที่ได้เรียนรู้จากงานที่ได้รับมอบหมาย</strong>
                        <p><?= "<span class='dottedUnderline'>$intsn_object->intsn_work_learn</span>" ?></p>
                        <br>

                        <strong>ปัญหาที่พบจากการปฏิบัติงานและแนวทางแก้ไข</strong>
                        <p><?= "<span class='dottedUnderline'>$intsn_object->intsn_work_issue</span>" ?></p>
                        <br>

                        <strong>สิ่งที่ต้องนำไปปรับปรุงภายหลังการฝึกงาน (ให้ระบุความรู้ ทักษะที่ต้องทบทวน หรือศึกษาเพิ่มเติม)</strong>
                        <p><?= "<span class='dottedUnderline'>$intsn_object->intsn_work_improve</span>" ?></p>
                        <br>

                        <strong><u class="dotted">สำหรับผู้รับผิดชอบการฝึกงาน</u></strong>
                        <br>
                        <strong>การตรวจสอบผลการปฏิบัติงาน (โปรดระบุคุณภาพของงาน ระยะเวลาที่แล้วเสร็จ ข้อบกพร่อง และคำแนะนำ)</strong>
                        <p><?= "<span class='dottedUnderline'>$intsn_object->intsn_work_performance</span>" ?></p>

                        <div class="row mt-5 text-center">
                            <div class="col-6">
                                <p>ลงชื่อ ...........<?= $stdObj->std_firstname ?>..<?= $stdObj->std_lastname ?>........... <br>
                                    (.....<?= $stdObj->std_firstname ?>..<?= $stdObj->std_lastname ?>..........) <br>
                                    นักศึกษา
                                </p>
                            </div>

                            <div class="col-6">
                                <p>ลงชื่อ .................................................................. <br>
                                    (.....<?= $stdObj->ovs_firstname ?>..<?= $stdObj->ovs_lastname ?>..........) <br>
                                    ผู้รับผิดชอบการฝึกงาน/ผู้มอบหมายงาน
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif ?>
        <?php elseif ($type == 'personal') : ?>
            <div class="row mt-5">
                <div class="col-12">
                    <h6>ประวัตินักศึกษาฝึกงาน</h6>
                    <h6>สาขาวิชาเทคโนโลยีสารสนเทศ คณะเทคโนโลยีสารสนเทศ</h6>
                    <h6>มหาวิทยาลัยอีสเทิร์นเอเชีย</h6>
                </div>
            </div>
            <div class="m-5" style="text-align: left;">
                <div class="row mt-5">
                    <div class="col-12">
                        <p>ระยะเวลาฝึกงาน วันที่........<?= DayThai($intswObj->intsw_start_date) ?>................เดือน..........<?= MonthThai($intswObj->intsw_start_date) ?>............ปี...........<?= YearThai($intswObj->intsw_start_date) ?>.............</p>
                        <p>ถึงวันที่..............<?= DayThai($intswObj->intsw_end_date) ?>.....................เดือน.........<?= MonthThai($intswObj->intsw_end_date) ?>.............ปี.......<?= YearThai($intswObj->intsw_end_date) ?>.................</p>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-12">
                        <p>1. ชื่อ-สกุล...........<?= $stdObj->std_firstname ?>......<?= $stdObj->std_lastname ?>...............ชั้นปีที่....<?= $stdObj->std_class_year ?>.....รหัส......<?= $stdObj->std_number ?>........</p>
                        <p>เกิดวันที่....<?= DayThai($stdObj->std_born) ?>.......เดือน........<?= MonthThai($stdObj->std_born) ?>...........พ.ศ......<?= YearThai($stdObj->std_born) ?>...........อายุ.......<?= calAge($stdObj->std_born) ?>.........ปั</p>
                        <p>สัญชาติ....<?= $stdObj->std_nationality ?>.......เชื้อชาติ........<?= $stdObj->std_ethnicity ?>...........ศาสนา......<?= $stdObj->std_religion ?>...........</p>
                        <p>บัตรประจำตัวประชาชนเลขที่.............................................<?= $stdObj->std_id_card ?>...............................................................</p>
                    </div>
                    <div class="col-12">
                        <p>2. ภูมิลำเนาเดิม.........................<?= $stdObj->std_domicile ?>................................................................................................................................</p>
                        <p>ที่อยู่ปัจจุบัน.............................<?= $stdObj->std_address ?>.................................................................................................................................</p>
                        <p>เบอร์โทรศัพท์ที่ติดต่อสะดวก.................<?= $stdObj->std_tel ?>.....................................................................................................................................</p>
                    </div>
                    <div class="col-12">
                        <p>3. ชื่อบิดา.......<?= $stdObj->std_father_name ?>...................อายุ.........<?= $stdObj->std_father_age ?>.......อาชีพ..........<?= $stdObj->std_father_occupation ?>...............</p>
                        <p>ชื่อมารดา.......<?= $stdObj->std_mother_name ?>...................อายุ.........<?= $stdObj->std_mother_age ?>.......อาชีพ..........<?= $stdObj->std_mother_occupation ?>................</p>
                        <p>ที่อยู่.......................<?= $stdObj->std_parent_address ?>....................................................................................................................................................</p>
                        <p>ชื่อผู้ปกครองในขณะที่ศึกษาอยู่......<?= $stdObj->std_parent_name ?>...........เกี่ยวข้องเป็น....<?= $stdObj->std_parent_relationship ?>...........</p>
                    </div>
                    <div class="col-12">
                        <p>4. ที่อยู่.......................<?= $stdObj->std_parent_address ?>....................................................................................................................................................</p>
                    </div>
                    <div class="col-12">
                        <p>5. เบอร์โทรศัพท์.......................<?= $stdObj->std_parent_tel ?>....................................................................................................................................................</p>
                    </div>
                    <div class="col-12">
                        <p>6. ความสามารถพิเศษ</p>
                        <p>1) .<?= $stdObj->std_talent_1 ?>......................................</p>
                        <p>2) .<?= $stdObj->std_talent_2 ?>......................................</p>
                    </div>
                    <div class="col-12">
                        <p>7. ชื่ออาจารย์ที่ปรึกษา....<?= $stdObj->tch_firstname ?>....<?= $stdObj->tch_lastname ?>................</p>
                        <p>ชื่ออาจารย์นิเทศการฝึกงาน....<?= $stdObj->std_internship_instuctor ?>......................................................................</p>
                    </div>
                </div>
            </div>

            <div class="pagebreak"></div>

            <div class="row">
                <div class="col-12">
                    <h4>แผนที่บ้านพักถึงสถานประกอบการที่ฝึกงาน โดยสังเขป</h4>
                </div>
                <div class="col-12">
                    <img src="assets/images/maps/<?= $stdObj->std_map ?>" width="300">
                </div>
            </div>
        <?php endif ?>
    </div>


    <script>
        window.print()
    </script>
</body>

</html>