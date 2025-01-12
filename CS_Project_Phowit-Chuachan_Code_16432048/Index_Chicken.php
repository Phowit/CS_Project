<?php
require_once("connect_db.php");
?>
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
        require_once("Index_Sidebar.php");
        ?>

        <!-- Blank Start -->
        <div class="content">
            <?php
            require_once("Index_Navbar.php");
            ?>

            <div class="container-fluid pt-3 px-3">
                <div class="row">

                    <div class="col-sm-4 col-xl-4">
                        <div class="bg-light rounded p-3">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <h5 class="mb-0 text-dark">การเลือกสายพันธุ์</h5>
                        </div>
                        <div class="text-center">
                            <img src='My_img/poultry.png' style='width: auto; height: 70px;'>
                        </div>
                        <a>
                            การเลือกสายพันธุ์นั้น ต้องคำนึงถึงหลายปัจจัย เช่น วัตถุประสงค์ในการเลี้ยง ต้องการจำนวนไข่ที่มาก หรือขนาดไข่ที่ใหญ่
                            ต้องการขายเนื้อด้วยหรือไม่หากหมดไข่ หากต้องการทุกอย่างอาจจำเป็นต้องเลือกสายพันธุ์เฉพาะ ที่ถูกพัฒนาขึ้นมา
                            ทำให้มีราคาที่สูงกว่าไก่ไข่ทั่วไปและหายากกว่า รวมไปถึงในบางสายพันธุ์อาจมีความทนทานต่อสภาพอากาศที่แตกต่างกัน
                            ทำให้การเลือกสายพันธุ์นั้น เป็นหัวข้อที่มีความสำคัญอย่างมากต่อการเลี้ยง
                        </a>
                        </div>
                    </div>

                    <div class="col-sm-4 col-xl-4">
                    <div class="bg-light rounded p-3">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <h5 class="mb-0 text-dark">สภาพแวดล้อม</h5>
                        </div>
                        <div class="text-center">
                            <img src='My_img/room-temperature.png' style='width: auto; height: 70px;'>
                        </div>
                        <a>
                            โดยปกติแล้ว ไก่ เป็นปศุสัตว์ ที่มีความทนทานต่อสภาพแวดล้อมมาก ทำให้สามารถเลี้ยงได้ในหลายพื้นที่
                            แต่ในหลายสายพันธุ์ก็มีความต้องการที่ต่างกัน เช่น อุณหภูมิ ดังนั้น การความคุมอุณหภูมิจึงเป็นส่วนสำคัญอย่างมาก
                            ที่ส่งผลต่อสุขภาพของไก่ไข่ ผู้เลี้ยงควรศึกษาให้ถี่ถ้วน ว่าสายพันธุ์ที่เลือกมาในหัวข้อข้างต้นนั้น มีความต้องการอุณหภูมิ
                            ประาณเท่าไร เพื่อที่จะสามารถปรับปรุงโรงเรือน หรือการเลี้ยง ให้เหมาะสมกับช่วงวัยของสายพันธุ์นั้นๆได้
                        </a>
                    </div>
                    </div>

                    <div class="col-sm-4 col-xl-4">
                    <div class="bg-light rounded p-3">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <h5 class="mb-0 text-dark">อาหารและโภชนาการ</h5>
                        </div>
                        <div class="text-center">
                            <img src='My_img/rice.png' style='width: auto; height: 70px;'>
                        </div>
                        <a>
                            อาหารและโภชนาการ มีผลอย่างมากต่อการเลี้ยงไก่ไข่ ทั้งต่อสุขภาพและผลผลิต เช่น
                            โปรตีน จำเป็นสำหรับการสร้างกล้ามเนื้อและการสร้างโปรตีนในไข่ขาว
                            แร่ธาตุและวิตามิน สำคัญสำหรับการสร้างเปลือกไข่ที่แข็งแรง ช่วยในการเจริญเติบโตของกระดูก
                            วิตามิน ช่วยเสริมภูมิคุ้มกันและการผลิตไข่ รวมไปถึง การให้อาหารในปริมาณที่เหมาะสมต่อแต่ละสายพันธุ์
                            ช่วยให้ไก่ไม่อ้วนเกินไปหรือผอมเกินไป ซึ่งส่งผลต่อประสิทธิภาพการผลิตไข่
                        </a>
                    </div>
                    </div>
                </div>

            </div><br>


            <?php
            require_once("Index_ChickenCard.php");
            ?>

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