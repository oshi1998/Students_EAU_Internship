<?php

if (isset($_POST["week"])) {
    //include connect
    require_once('connect.php');

    //รับค่าจาก POST
    $week =  mysqli_real_escape_string($conn, $_POST["week"]);
    $job = mysqli_real_escape_string($conn, $_POST['job']);
    $step = mysqli_real_escape_string($conn, $_POST['step']);
    $result = mysqli_real_escape_string($conn, $_POST['result']);
    $learn = mysqli_real_escape_string($conn, $_POST['learn']);
    $issue = mysqli_real_escape_string($conn, $_POST['issue']);
    $improve = mysqli_real_escape_string($conn, $_POST['improve']);

    //รับค่าจาก SESSION
    $std_id = $_SESSION["AUTH_ID"];

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

    //คำสั่ง QUERY
    $sql = "UPDATE internship_notes SET intsn_job='$job',intsn_work_step='$step',intsn_work_result='$result',intsn_work_learn='$learn',intsn_work_issue='$issue',intsn_work_improve='$improve' WHERE intsn_week='$week' AND std_id='$std_id'";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        echo "<script>
            alert('อัพเดตข้อมูลสำเร็จ');
            window.location = '../internship_note.php'
        </script>";
    } else {
        echo "<script>
            alert('อัพเดตข้อมูลไม่สำเร็จ');
            window.history.back()
        </script>";
    }
} else {
    header("location:../internship_note_weekly_add_form.php?week=$week");
}
