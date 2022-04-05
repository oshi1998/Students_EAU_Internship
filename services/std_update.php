<?php

if(isset($_POST["firstname"])){

    //include connect
    require_once("connect.php");

    //รับค่าจาก POST
    $firstname = mysqli_real_escape_string($conn,$_POST["firstname"]);
    $lastname = mysqli_real_escape_string($conn,$_POST["lastname"]);
    $tel = mysqli_real_escape_string($conn,$_POST["tel"]);

    //รับค่าจาก SESSION
    $std_id = $_SESSION["AUTH_ID"];

    //คำสั่ง SQL UPDATE
    $sql = "UPDATE students SET std_firstname='$firstname',std_lastname='$lastname',std_tel='$tel' WHERE std_id='$std_id'";
    $result = mysqli_query($conn,$sql);

    if($result){
        echo "<script>
            alert('อัพเดตข้อมูลสำเร็จ');
            window.location='../internship_note.php'
        </script>";
        exit;
    }else{
        echo "<script>
            alert('อัพเดตข้อมูลไม่สำเร็จ');
            window.history.back()
        </script>";
        exit;
    }

}else{
    header("location:../std_edit_form.php");
    exit;
}