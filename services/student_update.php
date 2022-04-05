<?php

if (isset($_POST["id"])) {

    //include connect
    require_once('connect.php');

    //รับค่าจาก POST
    $id = mysqli_real_escape_string($conn, $_POST["id"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $firstname = mysqli_real_escape_string($conn, $_POST["firstname"]);
    $lastname = mysqli_real_escape_string($conn, $_POST["lastname"]);
    $gender = mysqli_real_escape_string($conn, $_POST["gender"]);
    $year = mysqli_real_escape_string($conn, $_POST['year']);
    $address = mysqli_real_escape_string($conn, $_POST["address"]);
    $tel = mysqli_real_escape_string($conn, $_POST["tel"]);
    $old_image = mysqli_real_escape_string($conn, $_POST["old_image"]);
    $teacher = mysqli_real_escape_string($conn, $_POST["teacher"]);
    $overseer = mysqli_real_escape_string($conn, $_POST["overseer"]);
    $place = mysqli_real_escape_string($conn, $_POST["place"]);

    //ตรวจสอบ Email
    $sql = "SELECT ad_email FROM admins WHERE ad_email='$email'
    UNION SELECT ovs_email FROM overseers WHERE ovs_email='$email'
    UNION SELECT std_email FROM students WHERE std_email='$email' AND std_id!='$id'
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

                    //ตรวจสอบลบรูปภาพ
                    if ($old_image != "no_avatar.png") {
                        $delete_path = "../assets/images/users/$old_image";
                        if (file_exists($delete_path)) {
                            unlink($delete_path);
                        }
                    }

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
            $image = $old_image;
        }


        //คำสั่ง SQL
        $sql = "UPDATE students SET
            std_email = '$email',
            std_firstname = '$firstname',
            std_lastname = '$lastname',
            std_gender = '$gender',
            std_year = '$year',
            std_address = '$address',
            std_tel = '$tel',
            std_image = '$image',
            tch_id = '$teacher',
            ovs_id = '$overseer',
            intsp_id = '$place'
            WHERE std_id = '$id'
        ";

        $query = mysqli_query($conn, $sql);

        if ($query) {
            echo "<script>
            alert('อัพเดตข้อมูลสำเร็จ');
            window.location = '../student_table.php'
        </script>";
        } else {
            echo "<script>
            alert('อัพเดตข้อมูลไม่สำเร็จ เนื่องจากข้อมูลไม่ถูกต้อง');
            window.history.back()
        </script>";
        }
    } else {
        echo "<script>
            alert('อีเมลซ้ำ');
            window.history.back()
        </script>";
    }
} else {
    header("location:../student_table.php");
}
