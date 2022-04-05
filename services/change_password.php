<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //include connect
    require_once('connect.php');

    //รับค่าจาก POST
    $current_password = mysqli_real_escape_string($conn, $_POST["current_password"]);
    $new_password = mysqli_real_escape_string($conn, $_POST["new_password"]);
    $new_password_confirm = mysqli_real_escape_string($conn, $_POST["new_password_confirm"]);

    //คำสั่ง SQL ดึงรหัสผ่านของผู้ใช้งานตามตำแหน่ง
    if ($role == "ผู้ดูแลระบบ") {
        $sql = "SELECT ad_password as user_password FROM admins WHERE ad_id='$id'";
    } else if ($role == "หัวหน้างาน") {
        $sql = "SELECT ovs_password as user_password FROM overseers WHERE ovs_id='$id'";
    } else if ($role == "นักศึกษา") {
        $sql = "SELECT std_password as user_password FROM students WHERE std_id='$id'";
    } else if ($role == "อาจารย์") {
        $sql = "SELECT tch_password as user_password FROM teachers WHERE tch_id='$id'";
    }

    $query = mysqli_query($conn, $sql);
    $userObj = mysqli_fetch_object($query);
    $userPassword = $userObj->user_password;

    //ตรวจสอบรหัสผ่านปัจจุบันว่าถูกต้องหรือไม่
    if (md5($current_password) == $userPassword) {
        //ตรวจสอบรหัสผ่านปัจจุบันกับรหัสผ่านใหม่ เหมือนกันหรือไม่
        if ($current_password != $new_password) {
            //ตรวจสอบการยืนยันรหัสผ่านใหม่
            if ($new_password == $new_password_confirm) {
                $new_password = md5($new_password); //เข้ารหัส md5

                //คำสั่ง SQL อัพเดตรหัสผ่านผู้ใช้งาน
                if ($role == "ผู้ดูแลระบบ") {
                    $sql = "UPDATE admins SET ad_password='$new_password' WHERE ad_id='$id'";
                } else if ($role == "หัวหน้างาน") {
                    $sql = "UPDATE overseers SET ovs_password='$new_password' WHERE ovs_id='$id'";
                } else if ($role == "นักศึกษา") {
                    $sql = "UPDATE students SET std_password='$new_password' WHERE std_id='$id'";
                } else if ($role == "อาจารย์") {
                    $sql = "UPDATE teachers SET tch_password='$new_password' WHERE tch_id='$id'";
                }

                $query = mysqli_query($conn,$sql);

                if($query){
                    echo "<script>
                        alert('เปลี่ยนรหัสผ่านสำเร็จ');
                        window.history.back()
                    </script>";
                }else{
                    echo "<script>
                        alert('เปลี่ยนรหัสผ่านไม่สำเร็จ กรุณาลองใหม่อีกครั้ง');
                        window.history.back()
                    </script>";
                }
            } else {
                echo "<script>
                    alert('การยืนยันรหัสผ่านใหม่ไม่ตรงกัน');
                    window.history.back()
                </script>";
            }
        } else {
            echo "<script>
                alert('รหัสผ่านปัจจุบัน กับ รหัสผ่านใหม่ เหมือนกัน');
                window.history.back()
            </script>";
        }
    } else {
        echo "<script>
            alert('รหัสผ่านปัจจุบันไม่ถูกต้อง');
            window.history.back()
        </script>";
    }
} else {
    header("location:../home.php");
}
