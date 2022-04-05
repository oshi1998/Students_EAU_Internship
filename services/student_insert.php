<?php

if (isset($_POST["email"])) {

    //include connect
    require_once('connect.php');

    //รับค่าจาก POST
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = md5(mysqli_real_escape_string($conn, $_POST["password"]));
    $firstname = mysqli_real_escape_string($conn, $_POST["firstname"]);
    $lastname = mysqli_real_escape_string($conn, $_POST["lastname"]);
    $gender = mysqli_real_escape_string($conn, $_POST["gender"]);
    $year = mysqli_real_escape_string($conn,$_POST['year']);
    $address = mysqli_real_escape_string($conn, $_POST["address"]);
    $tel = mysqli_real_escape_string($conn, $_POST["tel"]);
    $teacher = mysqli_real_escape_string($conn, $_POST["teacher"]);
    $overseer = mysqli_real_escape_string($conn, $_POST["overseer"]);
    $place = mysqli_real_escape_string($conn, $_POST["place"]);

    //ตรวจสอบ EMAIL
    $sql = "SELECT ad_email FROM admins WHERE ad_email='$email'
    UNION SELECT ovs_email FROM overseers WHERE ovs_email='$email'
    UNION SELECT std_email FROM students WHERE std_email='$email'
    UNION SELECT tch_email FROM teachers WHERE tch_email='$email'";
    $query = mysqli_query($conn, $sql);
    $num_rows = mysqli_num_rows($query);
    if ($num_rows <= 0) {
        //รับค่าจาก FILES
        $fileName = $_FILES["image"]["name"];
        $tempPath = $_FILES["image"]["tmp_name"];
        $fileSize = $_FILES["image"]["size"];

        //ตรวจสอบ FILES
        if (!empty($fileName)) {

            $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $valid_extentions = array("jpeg", "jpg", "png");

            if (in_array($fileExt, $valid_extentions)) {
                if ($fileSize < 5000000) {
                    $image = uniqid() . "." . $fileExt;
                    $upload_path = "../assets/images/users/$image";
                    move_uploaded_file($tempPath, $upload_path);
                } else {
                    echo "<script>
                    alert('ไฟล์รูปภาพต้องขนาดไม่เกิน 5MB');
                    window.history.back()
                </script>";
                }
            } else {
                echo "<script>
                alert('ไฟล์รูปภาพต้องนามสกุล jpeg,jpg และ png เท่านั้น');
                window.history.back()
            </script>";
            }
        } else {
            $image = "no_avatar.png";
        }


        //คำสั่ง SQL
        $sql = "INSERT INTO students (
        std_email,
        std_password,
        std_firstname,
        std_lastname,
        std_gender,
        std_year,
        std_address,
        std_tel,
        std_image,
        tch_id,
        ovs_id,
        intsp_id
    ) VALUES (
        '$email',
        '$password',
        '$firstname',
        '$lastname',
        '$gender',
        '$year',
        '$address',
        '$tel',
        '$image',
        '$teacher',
        '$overseer',
        '$place'
    )";

        $query = mysqli_query($conn, $sql);

        if ($query) {
            echo "<script>
            alert('เพิ่มข้อมูลสำเร็จ');
            window.location = '../student_table.php'
        </script>";
        } else {
            echo "<script>
            alert('เพิ่มข้อมูลไม่สำเร็จ เนื่องจากข้อมูลไม่ถูกต้อง');
            window.history.back()
        </script>";
        }
    } else {
        echo "<script>
            alert('อีเมล $email ถูกใช้งานแล้ว!');
            window.history.back()
        </script>";
    }
} else {
    header("location:../student_add_form.php");
}
