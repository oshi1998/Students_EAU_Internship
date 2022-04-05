<?php
$location = basename($_SERVER['PHP_SELF']);
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="home.php">
            <img src="assets/images/logo.png" alt="logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?= ($location == "home.php") ? "active" : "" ?>" aria-current="page" href="home.php">หน้าแรก</a>
                </li>
                <?php if (isset($_SESSION["AUTH_ID"])) : ?>
                    <?php if ($role == "ผู้ดูแลระบบ") : ?>
                        <li class="nav-item">
                            <a class="nav-link <?= ($location == "admin_table.php") ? "active" : "" ?>" href="admin_table.php">ข้อมูลผู้ดูแลระบบ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($location == "overseer_table.php") ? "active" : "" ?>" href="overseer_table.php">ข้อมูลหัวหน้างาน</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($location == "student_table.php") ? "active" : "" ?>" href="student_table.php">ข้อมูลนักศึกษา</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($location == "teacher_table.php") ? "active" : "" ?>" href="teacher_table.php">ข้อมูลอาจารย์</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($location == "internship_place_table.php") ? "active" : "" ?>" href="internship_place_table.php">ข้อมูลสถานที่ฝึกงาน</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($location == "report.php") ? "active" : "" ?>" href="report.php">พิมพ์รายงาน</a>
                        </li>
                    <?php elseif ($role == "หัวหน้างาน") : ?>
                        <li class="nav-item">
                            <a class="nav-link <?= ($location == "ovs_internship.php") ? "active" : "" ?>" href="ovs_internship.php">ข้อมูลการฝึกงาน</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($location == "ovs_std_internship_work.php") ? "active" : "" ?>" href="ovs_std_internship_work.php">ข้อมูลนักศึกษาขอจบการฝึกงาน</a>
                        </li>
                    <?php elseif ($role == "อาจารย์") : ?>
                        <li class="nav-item">
                            <a class="nav-link <?= ($location == "tch_internship.php") ? "active" : "" ?>" href="tch_internship.php">ข้อมูลการฝึกงาน</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($location == "tch_std_internship_work.php") ? "active" : "" ?>" href="tch_std_internship_work.php">ข้อมูลนักศึกษาขอจบการฝึกงาน</a>
                        </li>
                    <?php elseif ($role == "นักศึกษา") :  ?>
                        <li class="nav-item">
                            <a class="nav-link <?= ($location == "internship_note.php") ? "active" : "" ?>" href="internship_note.php">บันทึกการฝึกงาน</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($location == "internship_work.php") ? "active" : "" ?>" href="internship_work.php">ขอจบการฝึกงาน</a>
                        </li>
                    <?php endif ?>
                <?php endif ?>
            </ul>
            <ul class="navbar-nav">
                <?php if (isset($_SESSION["AUTH_ID"])) : ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            ยินดีต้อนรับ, <?= $user->firstname ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#changePassModal">เปลี่ยนรหัสผ่าน</a></li>
                            <li><a class="dropdown-item" href="services/logout.php">ออกจากระบบ</a></li>
                        </ul>
                    </li>
                <?php else : ?>
                    <li class="nav-item">
                        <a class="nav-link <?= ($location == "login.php") ? "active" : "" ?>" href="login.php">เข้าสู่ระบบ</a>
                    </li>
                <?php endif ?>
            </ul>
        </div>
    </div>
</nav>

<!-- Modal -->
<div class="modal fade" id="changePassModal" tabindex="-1" aria-labelledby="changePassModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changePassModalLabel">เปลี่ยนรหัสผ่าน</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="services/change_password.php">
                <div class="modal-body">
                    <div class="form-group">
                        <label>รหัสผ่านปัจจุบัน</label>
                        <input type="password" class="form-control" name="current_password" required>
                    </div>
                    <div class="form-group">
                        <label>รหัสผ่านใหม่</label>
                        <input type="password" class="form-control" name="new_password" required>
                    </div>
                    <div class="form-group">
                        <label>ยืนยันรหัสผ่านใหม่</label>
                        <input type="password" class="form-control" name="new_password_confirm" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                    <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
                </div>
            </form>
        </div>
    </div>
</div>