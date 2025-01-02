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

                    <div class="col-md-10 col-sm-12 col-xl-3 p-2">
                        <!-- Carousel -->
                        <div class="col-sm-6 col-xl-12 m-2">
                            <div class="bg-light rounded h-100 p-1">
                                <img src="My_img/temperature.png" alt="" style="width: 40px; height: 40px; margin-right:10px;">
                                <a>อุณหภูมิ</a>
                                <a class="mb-1 text-dark"> : 25  ํC</a>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xl-12 m-2">
                            <div class="bg-light rounded h-100 p-1">
                                <img src="My_img/silos.png" alt="" style="width: 40px; height: 40px; margin-right:10px;">
                                <a>ระบบให้อาหาร</a>
                                <h6 class="mb-1 text-dark">สถานะ : เปิด </h6>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xl-12 m-2">
                            <div class="bg-light rounded h-100 p-1">
                                <img src="My_img/water1.png" alt="" style="width: 40px; height: 40px; margin-right:10px;">
                                <a>ระบบน้ำดื่ม</a>
                                <h6 class="mb-1 text-dark">สถานะ : เปิด</h6>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xl-12 m-2">
                            <div class="bg-light rounded h-100 p-1">
                                <img src="My_img/sprinkler.png" alt="" style="width: 40px; height: 40px; margin-right:10px;">
                                <a>ระบบวาล์วน้ำสปิงึ์เกอร์ ลดอุณหภูมิ</a>
                                <h6 class="mb-1 text-dark">สถานะ : เปิด</h6>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xl-12 m-2">
                            <div class="bg-light rounded h-100 p-1">
                                <img src="My_img/tank.png" alt="" style="width: 40px; height: 40px; margin-right:10px;">
                                <a>ระบบให้อาหารเสริม</a>
                                <h6 class="mb-1 text-dark">สถานะ : เปิด</h6>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="container-fluid pt-4 px-4">
                <div class="row">
                    <div class="col-md-6 col-sm-12 col-xl-6 ">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-2">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d22185.51878376601!2d100.563192!3d14.348940000000002!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e27439d817f259%3A0x985c4ac5faa7935!2z4Lih4Lir4Liy4Lin4Li04LiX4Lii4Liy4Lil4Lix4Lii4Lij4Liy4LiK4Lig4Lix4LiP4Lie4Lij4Liw4LiZ4LiE4Lij4Lio4Lij4Li14Lit4Lii4Li44LiY4Lii4Liy!5e1!3m2!1sth!2sth!4v1735466146515!5m2!1sth!2sth"
                                width="100%" height="285px" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12 col-xl-6">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-2" style="height: 100%;">
                            <a style="font-size:14px;">
                                ฟาร์มเกษตรของมหาวิทยาลัยราชภัฏพระนครศรีอยุธยาเป็นศูนย์กลางการเรียนรู้
                                และพัฒนาด้านการเกษตรที่สำคัญในภูมิภาค มีบทบาทในการสนับสนุนการเรียนการสอน การวิจัย
                                และการบริการชุมชน โดยเน้นการประยุกต์ใช้เทคโนโลยีสมัยใหม่เพื่อเพิ่มประสิทธิภาพการผลิตทางการเกษตร
                                <br><br>
                                โดยนักศึกษาสาขาวิชาเกษตรศาสตร์ของมหาวิทยาลัยจะได้รับการฝึกปฏิบัติจริงในฟาร์มเกษตรนี้
                                เพื่อพัฒนาทักษะและความรู้ในการจัดการแปลงเกษตร การดูแลพืชผล และการเลี้ยงสัตว์
                                ซึ่งเป็นการเตรียมความพร้อมสำหรับการประกอบอาชีพในอนาคต
                                <br><br>
                                มหาวิทยาลัยราชภัฏพระนครศรีอยุธยา
                                เลขที่ 96 ถ.ปรีดีพนมยงค์ ต.ประตูชัย อ.พระนครศรีอยุธยา จ.พระนครศรีอยุธยา 13000
                                โทรศัพท์: +663 527 6555
                                โทรสาร : +663 532 2076
                                อีเมล : saraban@aru.ac.th
                            </a>
                        </div>
                    </div>
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
</body>

</html>