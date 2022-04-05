<?php

if (isset($_GET["id"])) {
    //include connect
    require_once('connect.php');

    //รับค่าจาก GET
    $id =  mysqli_real_escape_string($conn, $_GET["id"]);

    //ตัวแปร STATUS
    $status = "ยืนยันเรียบร้อย";

    //คำสั่ง QUERY
    $sql = "UPDATE internship_works SET 
        intsw_tch_status='$status'
        WHERE intsw_id='$id'
    ";
    $query = mysqli_query($conn, $sql);

    if ($query) {

        //เช็คสถานะการยืนยัน
        $sql = "SELECT * FROM internship_works WHERE intsw_id='$id'";
        $query = mysqli_query($conn, $sql);
        $intswObj = mysqli_fetch_object($query);

        if ($intswObj->intsw_ovs_status == "ยืนยันเรียบร้อย" && $intswObj->intsw_tch_status == "ยืนยันเรียบร้อย") {
            //คำสั่งSQL UPDATE สถานะการฝึกงานของนักศึกษา
            $std_id = $intswObj->std_id;
            $status = "สำเร็จการฝึกงาน";
            $sql = "UPDATE students SET std_status='$status' WHERE std_id='$std_id'";
            mysqli_query($conn, $sql);
        }


        echo "<script>
            alert('ยืนยันเรียบร้อย');
            window.history.back();
        </script>";
    } else {
        echo "<script>
            alert('ยืนยันไม่สำเร็จ');
            window.history.back()
        </script>";
    }
} else {
    header("location:../tch_std_internship_work.php");
}
