<?php

if (isset($_POST["week"])) {
    //include connect
    require_once('connect.php');

    //รับค่าจาก POST
    $week =  mysqli_real_escape_string($conn, $_POST["week"]);
    $std_id = mysqli_real_escape_string($conn,$_POST["std_id"]);

    //ตัวแปร STATUS
    $status = "ยืนยันเรียบร้อย";

    //คำสั่ง QUERY
    $sql = "UPDATE internship_notes SET 
        intsn_tch_status='$status'
        WHERE intsn_week='$week'
        AND std_id='$std_id'
    ";
    $query = mysqli_query($conn, $sql);

    if ($query) {
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
    header("location:../tch_std_internship_note.php?id=$std_id");
}
