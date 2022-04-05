<?php

if (isset($_POST["email"])) {

    //include connect
    require_once('connect.php');

    //รับค่าจาก POST
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = md5(mysqli_real_escape_string($conn, $_POST["password"]));

    //คำสั่ง SQL
    $sql = "SELECT ad_id,ad_role FROM admins WHERE ad_email = '$email' AND ad_password='$password'
    UNION SELECT ovs_id,ovs_role FROM overseers WHERE ovs_email = '$email' AND ovs_password='$password'
    UNION SELECT std_id,std_role FROM students WHERE std_email = '$email' AND std_password='$password'
    UNION SELECT tch_id,tch_role FROM teachers WHERE tch_email = '$email' AND tch_password='$password'";
    $query = mysqli_query($conn, $sql);

    if ($query) {

        $num_rows = mysqli_num_rows($query);

        if ($num_rows == 1) {

            $data = mysqli_fetch_object($query);
            $_SESSION["AUTH_ID"] = $data->ad_id;
            $_SESSION["AUTH_ROLE"] = $data->ad_role;

            echo "<script>
                alert('เข้าสู่ระบบสำเร็จ');
                window.location = '../home.php'
            </script>";
        } else {
            echo "<script>
                alert('อีเมล หรือ รหัสผ่านไม่ถูกต้อง');
                window.history.back()
            </script>";
        }
    } else {
        echo "<script>
            alert('อีเมล หรือ รหัสผ่านไม่ถูกต้อง');
            window.history.back()
        </script>";
    }
} else {
    header("location:../login.php");
}
