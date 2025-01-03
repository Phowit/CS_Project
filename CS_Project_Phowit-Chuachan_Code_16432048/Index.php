<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>ระบบจัดการฟาร์มไก่ไข่อัจฉริยะด้วยเทคโนโลยีอินเทอร์เน็ตของสรรพสิ่ง</title>
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

    <link href='https://fonts.googleapis.com/css?family=ABeeZee' rel='stylesheet'>
</head>

<body>

    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>

        <?php
        require_once("Index_Sidebar1.php");
        ?>

        <!-- Blank Start -->
        <div class="content">
            <?php
            require_once("Index_Navbar.php");
            ?>

            <div class="container-fluid pt-4 px-4">
                <h5>ข้อมูลฟาร์มเกษตร มหาวิทยาลัยราชภัฏพระนครศรีอยุธยา</h5>

                <div class="row">
                    <div class="col-md-10 col-sm-12 col-xl-9 bg-light rounded p-2">
                        <!-- Carousel -->
                        <img src="My_img/Farm.png" alt="Farm" style="width:100%; height: auto;">
                    </div>

                    <div class="col-md-10 col-sm-12 col-xl-3">
                        <!-- Carousel -->
                        <div class="col-sm-6 col-xl-12 m-2">
                            <div class="bg-light rounded h-100 p-1 d-flex align-items-center">
                                <img src="My_img/temperature.png" style="width: 40px; height: 40px; margin-right:10px;">
                                <div class="w-100 ms-3">
                                    <a>อุณหภูมิโรงเรือน</a>
                                    <p class="mb-1 text-dark"> : 25 ํC</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xl-12 m-2">
                            <div class="bg-light rounded h-100 p-1 d-flex align-items-center py-3">
                                <img src="My_img/silos.png" alt="" style="width: 40px; height: 40px; margin-right:10px;">
                                <div class="w-100 ms-3">
                                    <a>ระบบให้อาหาร</a>
                                    <h6 class="mb-1 text-dark">สถานะ : เปิด </h6>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xl-12 m-2">
                            <div class="bg-light rounded h-100 p-1 d-flex align-items-center py-3">
                                <img src="My_img/water1.png" alt="" style="width: 40px; height: 40px; margin-right:10px;">
                                <div class="w-100 ms-3">
                                    <a>ระบบน้ำดื่ม</a>
                                    <h6 class="mb-1 text-dark">สถานะ : เปิด</h6>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xl-12 m-2">
                            <div class="bg-light rounded h-100 p-1 d-flex align-items-center py-2">
                                <img src="My_img/sprinkler.png" alt="" style="width: 40px; height: 40px; margin-right:10px;">
                                <div class="w-100 ms-3">
                                    <a>ระบบวาล์วน้ำสปิงเกอร์ ลดอุณหภูมิ</a>
                                    <h6 class="mb-1 text-dark">สถานะ : เปิด</h6>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xl-12 m-2">
                            <div class="bg-light rounded h-100 p-1 d-flex align-items-center py-3">
                                <img src="My_img/tank.png" alt="" style="width: 40px; height: 40px; margin-right:10px;">
                                <div class="w-100 ms-3">
                                    <a>ระบบให้อาหารเสริม</a>
                                    <h6 class="mb-1 text-dark">สถานะ : เปิด</h6>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="container-fluid pt-4 px-4 m-1">
                <div class="row">

                    <!--Chart Start อาหารหลัก-->
                    <div class="col-sm-12 col-xl-12 bg-light text-center rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0 text-dark">ระดับอุณหภูมิ</h6>
                            </div>
                            <canvas id="Temperature_Chart" style="max-width:100%; max-height:200px;"></canvas>
                    </div>
                    <!--Chart End อาหารหลัก-->

                </div>
            </div>
        </div>
    </div>
    <!-- Blank End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>
    <!-- JavaScript Libraries 1280px 720px 2560 1440-->
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

    <!-- chart -->
    <script src="chart.js"></script>
</body>

</html>