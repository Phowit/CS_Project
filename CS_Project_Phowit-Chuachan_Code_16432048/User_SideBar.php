<!-- Sidebar Start -->
<?php
// ดึงชื่อไฟล์ปัจจุบัน
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-dark navbar-primary">
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <img class="rounded-circle" src="My_img/chicken.png" alt="" style="width: 40px; height: 40px;">
                <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
            </div>
            <div class="ms-3">
                <h5 class="mb-0 text-light">Chicken Farm</h5>
            </div>
        </div>
        <div class="navbar-nav w-100">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <a href="User_Index.php" class="nav-item nav-link <?= ($currentPage == 'User_Index.php') ? 'active' : 'text-light' ?>">
                <i class="fa fa-laptop me-2 icon"></i>หน้าหลักผู้ใช้ทั่วไป</a>

            <a href="User_Collect.php" class="nav-item nav-link <?= ($currentPage == 'User_Collect.php') ? 'active' : 'text-light' ?>">
                <i class="fa fa-chart-bar me-2 icon"></i>ข้อมูลการเก็บไข่</a>

            <a href="User_Chicken.php" class="nav-item nav-link <?= ($currentPage == 'User_Chicken.php') ? 'active' : 'text-light' ?>">
                <i class="fas fa-building me-2 icon"></i>ข้อมูลการเลี้ยงไก่ไข่</a>

            <a href="User_Breed.php" class="nav-item nav-link <?= ($currentPage == 'User_Breed.php') ? 'active' : 'text-light' ?>">
                <i class="far fa-file-alt me-2 icon"></i>ข้อมูลสายพันธุ์ไก่ไข่</a>

            <a href="User_Data.php" class="nav-item nav-link <?= ($currentPage == 'User_Data.php') ? 'active' : 'text-light' ?>">
                <i class="fa fa-keyboard me-2 icon"></i>จัดการข้อมูลผู้ใช้</a>

            <a href="User_Message.php" class="nav-item nav-link <?= ($currentPage == 'User_Message.php') ? 'active' : 'text-light' ?>">
                <i class="fa fa-sticky-note-o me-2 icon"></i>การส่งข้อความ</a>

            <a href="User_ConfirmLogOut.php" class="nav-item nav-link text-light">
                <i class="fa fa-sign-out me-2 icon"></i>ออกจากระบบ</a>
        </div>
    </nav>
</div>
<!-- Sidebar End  fa fa-sign-out-->