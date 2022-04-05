<?php

if (isset($_POST["week"])) {
    //include connect
    require_once('connect.php');

    //รับค่าจาก POST
    $week =  mysqli_real_escape_string($conn, $_POST["week"]);
    $date = mysqli_real_escape_string($conn, $_POST["date"]);
    $work_in = mysqli_real_escape_string($conn, $_POST["work_in"]);
    $work_out = mysqli_real_escape_string($conn, $_POST["work_out"]);
    $leave = mysqli_real_escape_string($conn, $_POST["leave"]);

    //รับค่าจาก SESSION
    $std_id = $_SESSION["AUTH_ID"];

    //ตัวแปร STATUS
    $status = "ยังไม่ได้รับการยืนยัน";

    //เช็คว่าสัปดาห์นั้นได้รับการยืนยันไปแล้วหรือยัง
    $sql = "SELECT * FROM internship_notes WHERE intsn_week='$week' AND std_id='$std_id' AND intsn_ovs_status='ยืนยันเรียบร้อย'";
    $query = mysqli_query($conn, $sql);
    $num_rows = mysqli_num_rows($query);

    if ($num_rows > 0) {
        echo "<script>
                alert('สัปดาห์ที่ $week ได้รับการยืนยันการบันทึกฝึกงานเรียบร้อยแล้ว');
                window.history.back()
            </script>";
        exit;
    }

    //เช็คว่าวันที่ดังกล่าวได้ทำการบันทึกฝึกงานไปแล้วหรือยัง
    $sql =  "SELECT * FROM internship_notes WHERE intsn_date='$date' AND std_id='$std_id'";
    $query = mysqli_query($conn, $sql);
    $num_rows = mysqli_num_rows($query);

    if ($num_rows > 0) {
        echo "<script>
                alert('วันที่ $date ได้มีการบันทึกการฝึกงานเรียบร้อยแล้ว');
                window.history.back()
            </script>";
        exit;
    }

    if ($leave == 0) {
        //กรณีที่มาทำงาน
        //ตรวจสอบ INPUT เวลาเข้า-ออกงาน และงานที่ได้รับมอบหมาย
        if (empty($work_in) || empty($work_out)) {
            echo "<script>
                alert('คุณเลือกมาทำงาน แต่กรอกข้อมูลเวลาเข้า-ออกงาน ไม่ครบถ้วน');
                window.history.back()
            </script>";
            exit;
        } else {
            //คำสั่ง SQL
            $sql = "INSERT INTO internship_notes (
                std_id,
                intsn_week,
                intsn_date,
                intsn_work_in,
                intsn_work_out,
                intsn_leave,
                intsn_ovs_status,
                intsn_tch_status
            ) VALUES (
                '$std_id',
                '$week',
                '$date',
                '$work_in',
                '$work_out',
                '$leave',
                '$status',
                '$status'
            )";
        }
    } else {
        //ลางาน
        //คำสั่ง SQL
        $sql = "INSERT INTO internship_notes (
            std_id,
            intsn_week,
            intsn_date,
            intsn_leave,
            intsn_ovs_status,
            intsn_tch_status
        ) VALUES (
            '$std_id',
            '$week',
            '$date',
            '$leave',
            '$status',
            '$status'
        )";
    }

    //คำสั่ง QUERY
    $query = mysqli_query($conn, $sql);

    if ($query) {
        echo "<script>
            alert('เพิ่มข้อมูลสำเร็จ');
            window.location = '../internship_note.php'
        </script>";
    } else {
        echo "<script>
            alert('เพิ่มข้อมูลไม่สำเร็จ');
            window.history.back()
        </script>";
    }
} else {
    header("location:../internship_note_daily_add_form.php?week=$week");
}
