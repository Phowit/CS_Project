<!-- Sidebar Start -->
<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-dark navbar-primary">
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <img class="rounded-circle" src="My_img/iconHomeAdmin.png" alt="" style="width: 40px; height: 40px;">
                <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0 text-light">หน้าหลัก</h6>
                <span class="text-light">Admin</span>
            </div>
        </div>
        <div class="navbar-nav w-100 ">
            <a href="Admin_Index.php" class="nav-item nav-link active">
                <i class="fa fa-laptop me-2 icon"></i>หน้าหลัก</a>

            <a href="Admin_Status.php" class="nav-item nav-link text-light">
                <i class="fa fa-tachometer-alt me-2 icon"></i>จัดการข้อมูลสถานะ</a>

            <a href="Admin_ManageBreedChicken.php" class="nav-item nav-link text-light">
                <i class="far fa-file-alt me-2 icon"></i>จัดการข้อมูลพันธุ์ไก่</a>

            <!--<a href="Admin_ManageChicken.php" class="nav-item nav-link text-light">
                <i class="fa fa-table me-2 icon"></i>จัดการข้อมูลไก่</a>-->

                <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-light" data-bs-toggle="dropdown"><i class="fa fa-table me-2 icon"></i>จัดการข้อมูลไก่</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="Admin_ManageImport.php" class="dropdown-item">จัดการข้อมูลนำเข้าไก่</a>
                            <a href="Admin_TableExport.php" class="dropdown-item">จัดการข้อมูลนำออกไก่</a>
                        </div>
                    </div>

            <a href="Admin_ManageCollect.php" class="nav-item nav-link text-light">
                <i class="fa fa-chart-bar me-2 icon"></i>จัดการข้อมูลไข่</a>

            <a href="Admin_ManageData.php" class="nav-item nav-link text-light">
                <i class="fa fa-keyboard me-2 icon"></i>จัดการข้อมูลผู้ใช้</a>

        </div>
    </nav>
</div>
<!-- Sidebar End -->