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
            </div>
            <div class="ms-3">
                <h5 class="mb-0 text-light" style="font-family: 'ABeeZee';">Chicken Farm</h5>
            </div>
        </div>
        <div class="navbar-nav w-100">
            <a href="Index.php" class="nav-item nav-link <?= ($currentPage == 'Index.php') ? 'active' : 'text-light' ?>">
                <i class="fa fa-home me-2 icon"></i>หน้าหลัก</a>

            <a href="Index_Farm.php" class="nav-item nav-link <?= ($currentPage == 'Index_Farm.php') ? 'active' : 'text-light' ?>">
                <i class="fa fa-laptop me-2 icon"></i>ฟาร์มเกษตร ARU.</a>

            <a href="Index_Collect.php" class="nav-item nav-link <?= ($currentPage == 'Index_Collect.php') ? 'active' : 'text-light' ?>">
                <i class="fa fa-chart-bar me-2 icon"></i>ข้อมูลการเก็บไข่</a>
                
            <a href="Index_Chicken.php" class="nav-item nav-link <?= ($currentPage == 'Index_Chicken.php') ? 'active' : 'text-light' ?>">
                <i class="fa fa-keyboard me-2 icon"></i>ข้อมูลการเลี้ยงไก่</a>

            <a href="Login.php" class="nav-item nav-link text-light">
                <i class="fa fa-keyboard me-2 icon"></i>เข้าสู่ระบบ</a>

        </div>
    </nav>
</div>
<!-- Sidebar End -->