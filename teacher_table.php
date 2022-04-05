<?php
require_once('services/connect.php');
require_once('permissions/only_admin.php');
?>

<?php
//คำสั่ง SQL
$sql = "SELECT * FROM teachers ORDER BY tch_created DESC";
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
                        <h3>ข้อมูลอาจารย์</h3>
                        <a href="teacher_add_form.php">แบบฟอร์มเพิ่มข้อมูล</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped text-center">
                                <thead>
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>อีเมล</th>
                                        <th>ชื่อจริง</th>
                                        <th>นามสกุล</th>
                                        <th>จัดการข้อมูล</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($query as $row) { ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $row['tch_email'] ?></td>
                                            <td><?= $row['tch_firstname'] ?></td>
                                            <td><?= $row['tch_lastname'] ?></td>
                                            <td>
                                                <a href="teacher_edit_form.php?id=<?= $row['tch_id'] ?>">
                                                    จัดการข้อมูล
                                                </a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
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