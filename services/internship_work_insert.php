<?php

if (isset($_POST["start"])) {
    //include connect
    require_once("connect.php");

    //รับค่าจาก post
    $start = mysqli_real_escape_string($conn, $_POST["start"]);
    $end = mysqli_real_escape_string($conn, $_POST["end"]);

    //รับค่าจาก session
    $std_id = $_SESSION["AUTH_ID"];

    //คำสั่ง SQL SELECT ข้อมูลนักศึกษา
    $sql = "SELECT * FROM students WHERE std_id='$std_id'";
    $result = mysqli_query($conn, $sql);
    $stdObj = mysqli_fetch_object($result);

    //ตั้งค่าตัวแปร status
    $status = "ยังไม่ได้รับการยืนยัน";

    //วันที่ปัจจุบัน
    $date = date("Y-m-d");

    //คำสั่ง SQL เพิ่มข้อมูลการขอจบ
    $sql = "INSERT INTO internship_works (
        intsw_start_date,
        intsw_end_date,
        intsw_tch_status,
        intsw_ovs_status,
        tch_id,
        ovs_id,
        std_id,
        intsw_date
    ) VALUES (
        '$start',
        '$end',
        '$status',
        '$status',
        '$stdObj->tch_id',
        '$stdObj->ovs_id',
        '$std_id',
        '$date'
    )";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<script>
            alert('สำเร็จ');
            window.history.back()
        </script>";
    } else {
        echo "<script>
            alert('ไม่สำเร็จ');
            window.history.back()
        </script>";
    }
} else {
    header("location:../internship_work.php");
}
