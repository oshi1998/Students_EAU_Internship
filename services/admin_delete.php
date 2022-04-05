<?php

if(isset($_POST["id"])){

    //include connect
    require_once('connect.php');

    //รับค่าจาก POST
    $id = mysqli_real_escape_string($conn,$_POST["id"]);
    $password = md5(mysqli_real_escape_string($conn,$_POST["password"]));

    //รับค่าจาก SESSION
    $admin_id = mysqli_real_escape_string($conn,$_SESSION["AUTH_ID"]);

    //ตรวจสอบการยืนยันตน
    $sql = "SELECT * FROM admins WHERE ad_id='$admin_id' AND ad_password='$password'";
    $query = mysqli_query($conn,$sql);
    $num_rows = mysqli_num_rows($query);

    if($num_rows==1){
        //ดึงรูปภาพ
        $sql = "SELECT ad_image FROM admins WHERE ad_id='$id'";
        $query = mysqli_query($conn,$sql);
        $data = mysqli_fetch_object($query);
        $ad_image = $data->ad_image;
        //ลบรูปภาพ
        if($ad_image!="no_avatar.png"){
            $delete_path = "../assets/images/users/$ad_image";
            if(file_exists($delete_path)){
                unlink($delete_path);
            }
        }
        //คำสั่ง SQL
        $sql = "DELETE FROM admins WHERE ad_id='$id'";
        $query = mysqli_query($conn,$sql);

        if($query){
            echo "<script>
                alert('ลบข้อมูลสำเร็จ');
                window.location = '../admin_table.php'
            </script>";
        }else{
            echo "<script>
                alert('ไม่สามารถลบได้ เนื่องจากข้อมูลอาจมีความสัมพันธ์กับตารางข้อมูลอื่น');
                window.history.back()
            </script>";
        }
    }else{
        echo "<script>
            alert('ยืนยันตนไม่สำเร็จ');
            window.history.back()
        </script>";
    }
}else{
    header("location:../admin_table.php");
}