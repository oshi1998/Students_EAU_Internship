<?php 
require_once('services/connect.php');
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

        <div class="row">
            <div class="col-12 text-center">
                <h1>ระบบการฝึกงานของนักศึกษาคณะเทคโนโลยีสารสนเทศ <br> มหาวิทยาลัยอีสเทิร์นเอเชีย</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <img src="assets/images/home_banner.png" class="img-responsive">
            </div>
        </div>

        <section class="content">
            <div class="row">
                <div class="col-12 text-center mt-5">
                    <h1>ข่าวประชาสัมพันธ์</h1>
                </div>
            </div>

            <!-- ส่วนข่าวประชาสัมพันธ์ -->
            <div class="row">
                <div class="col-12">
                </div>
            </div>
        </section>


        <!-- end content -->


        <!-- include footer -->
        <?php require_once('include/footer.php'); ?>
        <!-- end include -->
    </div>



    <?php require_once('include/js.php'); ?>
</body>

</html>