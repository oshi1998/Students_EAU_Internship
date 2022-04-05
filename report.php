<?php
require_once('services/connect.php');
require_once('permissions/only_admin.php');
?>

<?php
//คำสั่ง SQL
$sql = "SELECT * FROM students ORDER BY std_created DESC";
$query = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบการฝึกงานของนักศึกษาคณะเทคโนโลยีสารสนเทศมหาวิทยาลัยอีสเทิร์นเอเชีย</title>

    <?php require_once('include/css.php'); ?>
</head>

<body>

    <div class="container">
        <!-- include menu -->
        <?php require_once('include/menu.php') ?>
        <!-- end include -->

        <!-- content -->

        <div class="row mt-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3>พิมพ์รายงาน</h3>
                    </div>
                    <div class="card-body w-25">
                        <form action="myreport.php" method="post">
                            <!-- <select class="form-control" name="std_id">
                                <option value="" selected disabled>---- เลือกนักศึกษา ----</option>
                            </select>
                            <br>
                            <select class="form-control" name="year">
                                <option value="" selected disabled>---- ปีการศึกษา ----</option>
                            </select>
                            <br>
                            <select class="form-control" name="tch_id">
                                <option value="" selected disabled>---- อาจารย์ที่ปรึกษา ----</option>
                            </select>
                            <br>
                            <select class="form-control" name="intsp_id">
                                <option value="" selected disabled>---- สถานที่ฝึกงาน ----</option>
                            </select>
                            <br> -->
                            <button type="submit" class="btn btn-success">พิมพ์</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>

        <!-- end content -->


        <!-- include footer -->
        <?php require_once('include/footer.php'); ?>
        <!-- end include -->
    </div>


    <?php require_once('include/js.php'); ?>
</body>

</html>