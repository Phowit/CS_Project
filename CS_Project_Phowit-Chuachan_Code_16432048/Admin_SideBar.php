<!-- Sidebar Start -->

<?php
// ดึงชื่อไฟล์ปัจจุบัน เอาไว้ตรวจสอบเงื่อนไขใน side bar แต่ละตัว
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<div class="sidebar pe-1 pb-1 mt-5 mt-md-0">
    <nav class="navbar bg-dark navbar-primary mt-5 mt-md-0">
        <div class="mt-5 mt-md-0">
            <div class="d-flex align-items-center ms-2 mb-2">
                <div class="position-relative">
                    <img class="rounded-circle" src="My_img/chicken.png" style="width: 30px; height: 30px;">
                    <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                </div>
                <div class="ms-3">
                    <h3 class="mb-0 text-light">Chicken Farm</h3>
                </div>
            </div>
            <div class="navbar-nav w-100">
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

                <!-- code ($currentPage == 'Admin_Index.php') ? 'active' : 'text-light' = if currentPage =.... will show 'active' but if not will show 'text-light'-->
                <a href="Admin_Index.php" class="nav-item nav-link p-1 <?= ($currentPage == 'Admin_Index.php') ? 'active' : 'text-light' ?>">
                    <i class="fa fa-laptop me-1 icon" style="height: 35px; width: 35px;"></i>หน้าหลัก</a>

                <a href="Admin_Environment.php" class="nav-item nav-link p-1 <?= ($currentPage == 'Admin_Environment.php') ? 'active' : 'text-light' ?>">
                    <i class="fa fa-leaf me-1 icon" style="height: 35px; width: 35px;"></i>สภาพแวดล้อมในโรงเรือน</a>

                <a href="Admin_ManageEnvironment.php" class="nav-item nav-link p-1 <?= ($currentPage == 'Admin_ManageEnvironment.php') ? 'active' : 'text-light' ?>">
                    <i class="fa fa-calendar-check-o me-1 icon" style="height: 35px; width: 35px;"></i>จัดการสภาพแวดล้อม</a>

                <a href="Admin_ManageCollect.php" class="nav-item nav-link p-1 <?= ($currentPage == 'Admin_ManageCollect.php') ? 'active' : 'text-light' ?>">
                    <i class="fa fa-chart-bar me-1 icon" style="height: 35px; width: 35px;"></i>จัดการข้อมูลผลผลิต</a>

                <a href="Admin_ManageBreedChicken.php" class="nav-item nav-link p-1 <?= ($currentPage == 'Admin_ManageBreedChicken.php') ? 'active' : 'text-light' ?>">
                    <i class="far fa-file-alt me-1 icon" style="height: 35px; width: 35px;"></i>จัดการข้อมูลสายพันธุ์ไก่ไข่</a>

                <div class="nav-item dropdown p-1">
                    <a class="nav-link dropdown-toggle text-light p-1" data-bs-toggle="dropdown">
                        <i class="fa fa-table me-1 icon" style="height: 35px; width: 35px;"></i>จัดการข้อมูลไก่
                    </a>
                    <div class="dropdown-menu bg-transparent border-0">
                        <a href="Admin_ManageImport.php" class="dropdown-item p-1 <?= ($currentPage == 'Admin_ManageImport.php') ? 'active' : 'text-light' ?>">จัดการข้อมูลการนำเข้าไก่ไข่</a>
                        <a href="Admin_ManageExport.php" class="dropdown-item p-1 <?= ($currentPage == 'Admin_ManageExport.php') ? 'active' : 'text-light' ?>">จัดการข้อมูลการนำออกไก่ไข่</a>
                        <a href="Admin_ManageTotal.php" class="dropdown-item p-1 <?= ($currentPage == 'Admin_ManageTotal.php') ? 'active' : 'text-light' ?>">รายงานข้อมูลไก่ไข่</a>
                    </div>
                </div>

                <a href="Admin_ManageData.php" class="nav-item nav-link p-1 <?= ($currentPage == 'Admin_ManageData.php') ? 'active' : 'text-light' ?>">
                    <i class="fa fa-keyboard me-1 icon" style="height: 35px; width: 35px;"></i>จัดการข้อมูลผู้ใช้</a>

                <a href="Admin_Message.php" class="nav-item nav-link p-1 <?= ($currentPage == 'Admin_Message.php') ? 'active' : 'text-light' ?>">
                    <i class="fa fa-newspaper-o me-1 icon" style="height: 35px; width: 35px;"></i>จัดการข้อความ</a>

                <a href="Admin_ConfirmLogOut.php" class="nav-item nav-link text-light p-1">
                    <i class="fa fa-sign-out me-1 icon" style="height: 35px; width: 35px;"></i>ออกจากระบบ</a>
            </div>
        </div>
    </nav>
</div>
<!-- Sidebar End -->