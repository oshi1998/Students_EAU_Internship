<?php 
require_once('services/connect.php');
require_once('permissions/check_login_page.php'); 
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

        <section class="content">
            <div class="row">
                <div class="col-12 mt-5">
                    <h3 class="text-center">เข้าสู่ระบบ</h3>
                    <form class="p-5" method="post" action="services/login.php">
                        <div class="form-group">
                            <label>อีเมล</label>
                            <input type="email" class="form-control" placeholder="กรอกอีเมล" name="email" required>
                        </div>
                        <br>
                        <div class="form-group">
                            <label>รหัสผ่าน</label>
                            <input type="password" class="form-control" placeholder="กรอกรหัสผ่าน" name="password" required>
                        </div>
                        <div class="form-group text-center mt-5">
                            <button type="submit" class="btn btn-light">เข้าสู่ระบบ</button>
                        </div>
                    </form>
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