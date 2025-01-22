<!-- Sidebar Start -->

<?php
// ดึงชื่อไฟล์ปัจจุบัน
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<div class="sidebar pe-1 pb-3">
    <nav class="navbar bg-dark navbar-primary">
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <img class="rounded-circle" src="My_img/chicken.png" style="width: 40px; height: 40px;">
                <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
            </div>
            <div class="ms-3">
                <h5 class="mb-0 text-light">Chicken Farm</h5>
            </div>
        </div>
        <div class="navbar-nav w-100">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <a href="Admin_Index.php" class="nav-item nav-link p-1 <?= ($currentPage == 'Admin_Index.php') ? 'active' : 'text-light' ?>">
                <i class="fa fa-laptop me-2 icon"></i>หน้าหลัก</a>

            <a href="Admin_Farm.php" class="nav-item nav-link p-1 <?= ($currentPage == 'Admin_Farm.php') ? 'active' : 'text-light' ?>">
                <i class="fa fa-university me-2 icon"></i>ฟาร์มเกษตร ARU.</a>

            <a href="Admin_Chicken.php" class="nav-item nav-link p-1 <?= ($currentPage == 'Admin_Chicken.php') ? 'active' : 'text-light' ?>">
                <i class="fas fa-building me-2 icon"></i>ข้อมูลการเลี้ยงไก่</a>

            <a href="Admin_Status.php" class="nav-item nav-link p-1 <?= ($currentPage == 'Admin_Status.php') ? 'active' : 'text-light' ?>">
                <i class="fa fa-tachometer-alt me-2 icon"></i>จัดการข้อมูลสถานะ</a>

            <a href="Admin_ManageBreedChicken.php" class="nav-item nav-link p-1 <?= ($currentPage == 'Admin_ManageBreedChicken.php') ? 'active' : 'text-light' ?>">
                <i class="far fa-file-alt me-2 icon"></i>จัดการข้อมูลพันธุ์ไก่</a>

            <div class="nav-item dropdown p-1">
                <a class="nav-link dropdown-toggle text-light p-1" data-bs-toggle="dropdown">
                    <i class="fa fa-table me-2 icon"></i>จัดการข้อมูลไก่
                </a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="Admin_ManageImport.php" class="dropdown-item p-1 <?= ($currentPage == 'Admin_ManageImport.php') ? 'active' : 'text-light' ?>">จัดการข้อมูลนำเข้าไก่</a>
                    <a href="Admin_ManageExport.php" class="dropdown-item p-1 <?= ($currentPage == 'Admin_ManageExport.php') ? 'active' : 'text-light' ?>">จัดการข้อมูลนำออกไก่</a>
                </div>
            </div>

            <a href="Admin_ManageCollect.php" class="nav-item nav-link p-1 <?= ($currentPage == 'Admin_ManageCollect.php') ? 'active' : 'text-light' ?>">
                <i class="fa fa-chart-bar me-2 icon"></i>จัดการข้อมูลไข่</a>

            <a href="Admin_ManageData.php" class="nav-item nav-link p-1 <?= ($currentPage == 'Admin_ManageData.php') ? 'active' : 'text-light' ?>">
                <i class="fa fa-keyboard me-2 icon"></i>จัดการข้อมูลผู้ใช้</a>

            <a href="Admin_ConfirmLogOut.php" class="nav-item nav-link text-light p-1">
                <i class="fa fa-sign-out me-2 icon"></i>ออกจากระบบ</a>
        </div>
    </nav>
</div>
<!-- Sidebar End -->