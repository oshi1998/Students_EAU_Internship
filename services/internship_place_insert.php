<?php

if (isset($_POST["name"])) {
    //include connect
    require_once('connect.php');

    //รับค่าจาก POST
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $address = mysqli_real_escape_string($conn, $_POST["address"]);
    $tel = mysqli_real_escape_string($conn, $_POST["tel"]);

    //คำสั่ง SQL
    $sql = "INSERT INTO internship_places (
        intsp_name,
        intsp_address,
        intsp_tel
    ) VALUES (
        '$name',
        '$address',
        '$tel'
    )";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        echo "<script>
            alert('เพิ่มข้อมูลสำเร็จ');
            window.location = '../internship_place_table.php'
        </script>";
    } else {
        echo "<script>
            alert('เพิ่มข้อมูลไม่สำเร็จ');
            window.history.back()
        </script>";
    }
} else {
    header("location:../internship_place_add_form.php");
}
