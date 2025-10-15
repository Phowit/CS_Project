<?php
require_once("connect_db.php");
session_start();

// ตรวจสอบว่าผู้ใช้เข้าสู่ระบบหรือไม่
if (!isset($_SESSION['User_ID'])) {
    header("Location: Login.php"); // หากยังไม่ได้ล็อกอิน ย้ายไปหน้า Login.php
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>ระบบจัดการฟาร์มไก่ไข่อัจฉริยะด้วยเทคโนโลยีอินเทอร์เน็ตของสรรพสิ่ง</title>

    <link rel="icon" type="image/x-icon" href="My_img/chicken.png">

    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-light position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <!-- Sidebar Start -->
        <?php
        require_once("Admin_SideBar.php");
        ?>
        <!-- Sidebar End -->

        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <?php
            require_once("Admin_NavBar.php");
            ?>
            <!-- Navbar End -->

            <!-- Chart Start อาหารหลัก & อาหารในถาด-->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">

                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-light text-center rounded p-1">
                            <div class="d-flex align-items-center justify-content-between mb-1">
                                <div class="row w-100 pt-1">
                                    <div class="col-12 col-md-7 p-2">
                                        <h6 class="mb-0 text-dark">ข้อมูลกราฟประจำวันที่: <span id="displaySelectedDate"></span></h6>
                                        <!-- <span id="displaySelectedDate"></span> ใช้คู่กับ js เพื่ออัพเดทข้อมูลกราฟ แทนการสร้างใหม่ เพื่อเพิ่มประสิทธิภาพ-->
                                    </div>


                                    <div class="col-8 col-md-3 pb-md-0 ps-4 ps-md-0">
                                        <input type="date" class="form-control" id="chartDatePicker" value="<?php echo date('Y-m-d'); ?>">
                                    </div>

                                    <div class="col-4 col-md-2 pb-md-0 pe-1 pe-md-0 m-0">
                                        <button type="button" class="btn btn-primary m-0" id="searchChartData">
                                            <i class="fa fa-search"></i> ค้นหา
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!--Chart Start อาหารหลัก-->
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-light text-center rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0 text-dark">ระดับอุณหภูมิโรงเรือน</h6>
                            </div>
                            <canvas id="Temperature_Chart"></canvas>
                        </div>
                    </div>
                    <!--Chart End อาหารหลัก-->

                    <!--Chart Start อาหารหลัก-->
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-light text-center rounded p-4">

                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0 text-dark">ระดับอาหารในถัง</h6>
                            </div>
                            <canvas id="Food_Chart"></canvas>

                        </div>
                    </div>
                    <!--Chart End อาหารหลัก-->
                </div>
            </div>
            <!--Chart End อาหารหลัก & อาหารในถาด-->

            <!--Chart Start อาหารเสริม & อุณหภูมิ-->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <!--Chart Start อาหารเสริม-->
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-light text-center rounded p-4">

                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0 text-dark">ระดับอาหารในถาด</h6>
                            </div>
                            <canvas id="FoodTray_Chart"></canvas>

                        </div>
                    </div>
                    <!--Chart End อาหารเสริม-->

                    <!--Chart Start อุณหภูมิ-->
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-light text-center rounded p-4">

                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0 text-dark">ระดับอาหารเสริม</h6>
                            </div>
                            <canvas id="FoodS_Chart"></canvas>

                        </div>
                    </div>
                    <!--Chart End อุณหภูมิ-->

                </div>
            </div>
            <!--Chart End อาหารเสริม & อุณหภูมิ-->

        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>

    <!-- Environment chart -->
    <script src="chart_Environment.js"></script>

    <!-- Total chart -->
    <script src="chart.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var currentPage = '<?php echo basename($_SERVER['PHP_SELF']); ?>'; // ดึงชื่อของหน้า PHP ที่ถูกโหลดอยู่

            var navLinks = document.querySelectorAll('.navbar-nav .nav-link');

            navLinks.forEach(function(link) {
                if (link.getAttribute('href') === currentPage) {
                    link.classList.add('active');
                }
            });
        });
    </script>

</body>

</html>