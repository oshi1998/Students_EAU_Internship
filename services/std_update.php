<?php

if (isset($_POST["firstname"])) {

    //include connect
    require_once("connect.php");

    //รับค่าจาก POST
    $firstname = mysqli_real_escape_string($conn, $_POST["firstname"]);
    $lastname = mysqli_real_escape_string($conn, $_POST["lastname"]);
    $address = mysqli_real_escape_string($conn, $_POST["address"]);
    $tel = mysqli_real_escape_string($conn, $_POST["tel"]);
    $class_year = (isset($_POST['class_year'])) ? mysqli_real_escape_string($conn, $_POST['class_year']) : NULL;
    $born = (isset($_POST['born'])) ? mysqli_real_escape_string($conn, $_POST['born']) : NULL;
    $nationality = (isset($_POST['nationality'])) ? mysqli_real_escape_string($conn, $_POST['nationality']) : NULL;
    $ethnicity = (isset($_POST['ethnicity'])) ? mysqli_real_escape_string($conn, $_POST['ethnicity']) : NULL;
    $religion = (isset($_POST['born'])) ? mysqli_real_escape_string($conn, $_POST['religion']) : NULL;
    $number = (isset($_POST['number'])) ? mysqli_real_escape_string($conn, $_POST['number']) : NULL;
    $id_card = (isset($_POST['id_card'])) ? mysqli_real_escape_string($conn, $_POST['id_card']) : NULL;
    $domicile = (isset($_POST['domicile'])) ? mysqli_real_escape_string($conn, $_POST['domicile']) : NULL;
    $father_name = (isset($_POST['father_name'])) ? mysqli_real_escape_string($conn, $_POST['father_name']) : NULL;
    $father_age = (isset($_POST['father_age'])) ? mysqli_real_escape_string($conn, $_POST['father_age']) : NULL;
    $father_occupation = (isset($_POST['father_occupation'])) ? mysqli_real_escape_string($conn, $_POST['father_occupation']) : NULL;
    $mother_name = (isset($_POST['mother_name'])) ? mysqli_real_escape_string($conn, $_POST['mother_name']) : NULL;
    $mother_age = (isset($_POST['mother_age'])) ? mysqli_real_escape_string($conn, $_POST['mother_age']) : NULL;
    $mother_occupation = (isset($_POST['mother_occupation'])) ? mysqli_real_escape_string($conn, $_POST['mother_occupation']) : NULL;
    $parent_name = (isset($_POST['parent_name'])) ? mysqli_real_escape_string($conn, $_POST['parent_name']) : NULL;
    $parent_relationship = (isset($_POST['parent_relationship'])) ? mysqli_real_escape_string($conn, $_POST['parent_relationship']) : NULL;
    $parent_address = (isset($_POST['parent_address'])) ? mysqli_real_escape_string($conn, $_POST['parent_address']) : NULL;
    $parent_tel = (isset($_POST['parent_tel'])) ? mysqli_real_escape_string($conn, $_POST['parent_tel']) : NULL;
    $talent_1 = (isset($_POST['talent_1'])) ? mysqli_real_escape_string($conn, $_POST['talent_1']) : NULL;
    $talent_2 = (isset($_POST['talent_2'])) ? mysqli_real_escape_string($conn, $_POST['talent_2']) : NULL;
    $internship_instuctor = (isset($_POST['internship_instuctor'])) ? mysqli_real_escape_string($conn, $_POST['internship_instuctor']) : NULL;
    $old_map = mysqli_real_escape_string($conn, $_POST['old_map']);

    //รับค่าจาก SESSION
    $std_id = $_SESSION["AUTH_ID"];

    //รับค่าจาก FILES MAP
    $fileName = $_FILES["map"]["name"];
    $tempPath = $_FILES["map"]["tmp_name"];
    $fileSize = $_FILES["map"]["size"];

    //ตรวจสอบ FILES MAP
    if (!empty($fileName)) {

        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $valid_extentions = array("jpeg", "jpg", "png");

        if (in_array($fileExt, $valid_extentions)) {
            if ($fileSize < 5000000) {

                //ตรวจสอบลบรูปภาพแผนที่
                $delete_path = "../assets/images/maps/$old_map";

                if (file_exists($delete_path)) {
                    unlink($delete_path);
                }

                $map = uniqid() . "." . $fileExt;
                $upload_path = "../assets/images/maps/$map";
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
        $map = $old_map;
    }


    //คำสั่ง SQL
    $sql = "UPDATE students SET
            std_firstname = '$firstname',
            std_lastname = '$lastname',
            std_address = '$address',
            std_tel = '$tel',
            std_class_year = '$class_year',
            std_born = '$born',
            std_nationality = '$nationality',
            std_ethnicity = '$ethnicity',
            std_religion = '$religion',
            std_number = '$number',
            std_id_card = '$id_card',
            std_domicile = '$domicile',
            std_father_name = '$father_name',
            std_father_age = '$father_age',
            std_father_occupation = '$father_occupation',
            std_mother_name = '$mother_name',
            std_mother_age = '$mother_age',
            std_mother_occupation = '$mother_occupation',
            std_parent_name = '$parent_name',
            std_parent_relationship = '$parent_relationship',
            std_parent_address = '$parent_address',
            std_parent_tel = '$parent_tel',
            std_talent_1 = '$talent_1',
            std_talent_2 = '$talent_2',
            std_internship_instuctor = '$internship_instuctor',
            std_map = '$map'
            WHERE std_id = '$std_id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<script>
            alert('อัพเดตข้อมูลสำเร็จ');
            window.location='../internship_note.php'
        </script>";
        exit;
    } else {
        echo "<script>
            alert('อัพเดตข้อมูลไม่สำเร็จ');
            
        </script>";
        exit;
    }
} else {
    header("location:../std_edit_form.php");
    exit;
}
