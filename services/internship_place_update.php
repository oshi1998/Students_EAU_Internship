<?php

if (isset($_POST["id"])) {
    //include connect
    require_once('connect.php');

    //รับค่าจาก POST
    $id = mysqli_real_escape_string($conn, $_POST["id"]);
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $address = mysqli_real_escape_string($conn, $_POST["address"]);
    $tel = mysqli_real_escape_string($conn, $_POST["tel"]);

    //คำสั่ง SQL
    $sql = "UPDATE internship_places SET
        intsp_name='$name',
        intsp_address='$address',
        intsp_tel='$tel'
        WHERE intsp_id='$id'
    ";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        echo "<script>
            alert('อัพเดตข้อมูลสำเร็จ');
            window.location = '../internship_place_table.php'
        </script>";
    } else {
        echo "<script>
            alert('อัพเดตข้อมูลไม่สำเร็จ');
            window.history.back()
        </script>";
    }
} else {
    header("location:../internship_place_add_form.php");
}
