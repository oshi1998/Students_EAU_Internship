<?php

$hostname = "localhost";
$username = "root";
$password = "";
$database = "students_eau_internship";

$conn = mysqli_connect($hostname, $username, $password, $database);
date_default_timezone_set("Asia/Bangkok");

if (mysqli_connect_errno()) {
    echo "เชื่อมต่อฐานข้อมูลไม่สำเร็จ: " . mysqli_connect_error();
    exit();
} else {
    session_start();
    
    if (isset($_SESSION["AUTH_ID"])) {
        //รับค่าจาก SESSION
        $id = $_SESSION["AUTH_ID"];
        $role = $_SESSION["AUTH_ROLE"];

        if ($role == "ผู้ดูแลระบบ") {
            $sql = "SELECT ad_email as email,ad_firstname as firstname,ad_lastname as lastname,ad_image as image FROM admins WHERE ad_id='$id'";
        } else if ($role == "หัวหน้างาน") {
            $sql = "SELECT ovs_email as email,ovs_firstname as firstname,ovs_lastname as lastname,ovs_image as image FROM overseers WHERE ovs_id='$id'";
        } else if ($role == "นักศึกษา") {
            $sql = "SELECT std_email as email,std_firstname as firstname,std_lastname as lastname,std_image as image FROM students WHERE std_id='$id'";
        } else if ($role == "อาจารย์") {
            $sql = "SELECT tch_email as email,tch_firstname as firstname,tch_lastname as lastname,tch_image as image FROM teachers WHERE tch_id='$id'";
        } else {
            echo "<script>
                alert('คุณไม่มีสิทธิ์เข้าใช้งานหน้านี้');
                window.location = 'services/logout.php'
            </script>";
        }

        $query = mysqli_query($conn, $sql);
        $user = mysqli_fetch_object($query);
    }
}
