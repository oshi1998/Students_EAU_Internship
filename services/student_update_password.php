<?php

if (isset($_POST["id"])) {

    //include connect
    require_once('connect.php');

    //รับค่าจาก POST
    $id = mysqli_real_escape_string($conn, $_POST["id"]);
    $password = md5(mysqli_real_escape_string($conn, $_POST["password"]));
    $new_password = md5(mysqli_real_escape_string($conn, $_POST["new_password"]));

    //รับค่าจาก SESSION
    $admin_id = mysqli_real_escape_string($conn, $_SESSION["AUTH_ID"]);

    //ตรวจสอบการยืนยันตน
    $sql = "SELECT * FROM admins WHERE ad_id='$admin_id' AND ad_password='$password'";
    $query = mysqli_query($conn, $sql);
    $num_rows = mysqli_num_rows($query);

    if ($num_rows == 1) {

        //คำสั่ง SQL
        $sql = "UPDATE students SET std_password='$new_password' WHERE std_id='$id'";
        $query = mysqli_query($conn, $sql);

        if ($query) {
            echo "<script>
                alert('แก้ไขรหัสผ่านสำเร็จ');
                window.location = '../student_table.php'
            </script>";
        } else {
            echo "<script>
                alert('แก้ไขรหัสผ่านไม่สำเร็จ');
                window.history.back()
            </script>";
        }
    } else {
        echo "<script>
            alert('ยืนยันตนไม่สำเร็จ');
            window.history.back()
        </script>";
    }
} else {
    header("location:../student_table.php");
}
