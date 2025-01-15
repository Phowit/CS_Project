<!-- Sidebar Start -->
<?php
    // ดึงชื่อไฟล์ปัจจุบัน
    $currentPage = basename($_SERVER['PHP_SELF']);
?>
<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-dark navbar-primary">
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <img class="rounded-circle" src="My_img/iconHomeUser.png" alt="" style="width: 40px; height: 40px;">
                <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0 text-light">หน้าหลัก</h6>
                <span class="text-light">User</span>
            </div>
        </div>
        <div class="navbar-nav w-100">
            <a href="User_Index.php" class="nav-item nav-link <?= ($currentPage == 'User_Index.php') ? 'active' : 'text-light' ?>">
                <i class="fa fa-laptop me-2 icon"></i>หน้าหลักผู้ใช้ทั่วไป</a>

            <a href="User_Farm.php" class="nav-item nav-link <?= ($currentPage == 'User_Farm.php') ? 'active' : 'text-light' ?>">
                <i class="fa fa-table me-2 icon"></i>ฟาร์มเกษตร ARU.</a>

            <a href="User_Collect.php" class="nav-item nav-link <?= ($currentPage == 'User_Collect.php') ? 'active' : 'text-light' ?>">
                <i class="fa fa-chart-bar me-2 icon"></i>ข้อมูลการเก็บไข่</a>

            <a href="User_Chicken.php" class="nav-item nav-link <?= ($currentPage == 'User_Chicken.php') ? 'active' : 'text-light' ?>">
                <i class="fa fa-chart-bar me-2 icon"></i>ข้อมูลการเลี้ยงไก่</a>

            <a href="User_Data.php" class="nav-item nav-link <?= ($currentPage == 'User_Data.php') ? 'active' : 'text-light' ?>">
                <i class="fa fa-chart-bar me-2 icon"></i>จัดการข้อมูลผู้ใช้</a>
        </div>
    </nav>
</div>
<!-- Sidebar End -->