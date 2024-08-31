<?php
    require_once("connect_db.php");
    session_start();
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
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <?php
		    require_once("User_SideBar2.php");
		?>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <?php
                require_once("User_NavBar.php");
            ?>
            <!-- Navbar End -->

            <!-- progress -->
            <?php
                require_once("Public_Progress.php");
            ?>
            <!-- progress -->

            <!--table Start ข้อมูลไก่-->
            <?php
		        require_once("User_TableChickenData.php");
		    ?>
            <!--teble End ข้อมูลไก่-->

            <!-- Widgets Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">

                    <!--ข้อมูลการเก็บไข่ start -->
                    <?php
                        require_once("User_TableHarvest.php");
                    ?>
                    <!--ข้อมูลการเก็บไข่ End-->

                    <!-- calendar Start-->
                        <div class="col-sm-12 col-md-6 col-xl-4">
                            <div class="h-100 bg-primary rounded p-4">
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <h6 class="mb-0">ปฏิทิน</h6>
                                </div>
                                <div id="calender"></div>
                            </div>
                        </div>
                    <!-- Widgets End -->
                </div>

                <div class="row g-4 mt-1">
                    <div class="col-sm-12 col-md-12 col-xl-12">
                        <div class="h-100 bg-primary rounded p-4">
                            <p>สรุปการดูแลไก่ไข่อย่างง่าย</p>

                            <p>
                                1) ทำกรงตับใส่ไก่ช่องละ 1-2 ตัว ขนาด กว้าง 50 ซม.สูง 66 ซม.โดยใช้ไม้ที่เรามีอยู่ เช่นไม้ไผ่ ไม้ยูคาพร้อมที่วางกรงตับมีความสูง 50 ซม.
                                อุปกรณ์ให้อาหารใช้ไผ่ผ่าครึ่ง ที่ให้น้ำใช้ขวดน้ำที่ใช้แล้ว แบบง่าย ๆ ประหยัดต้นทุนต่ำ
                            </p>

                            <p>
                                2) ใช้ตาข่ายคลุมเพื่อกันยุงให้กับไก่ในเวลากลางคืนให้อาหารไก่ไข่
                                ระยะไก่รุ่นโปรตีน 13-15 เปอร์เซ็นต์วันละ 80-100 กรัม/วัน ให้เช้า และบ่าย สังเกตการกินอาหารของไก่ ล้างรางน้ำวันละ 1 ครั้ง
                            </p>

                            <p>
                                3) ถ่ายพยาธิภายนอกภายในไก่ ก่อนไก่จะให้ไข่ และทำวัคซีนนิวคลาสเซิล อหิวาต์ไก่ คอยสังเกตสุขภาพชองไก่ ช่วงอากาศเปลี่ยนให้วิตามินละลายน้ำ
                                กับไก่ช่วงไก่เริ่มให้ไข่ ( 20-22สัปดาห์ ) ให้เปลี่ยนอาหารเป็นอาหารไก่ไข่ระยะให้ไข่โปรตีน 14- 15 เปอร์เซ็นต์ ให้วันละ 150-200 กรัม
                            </p>

                            <p>
                                4)ช่วงสัปดาห์ที่ 28-31 สัปดาห์ ให้อาหารไก่เพิ่มขึ้นตามจำนวนไข่ที่ให้ เก็บไข่ไก่อย่างน้อยวันละ 2 ครั้ง กลางวัน และก่อนเลิกงาน หมั่นดูแลตรวจสุขภาพไก่
                                เป็นประจำทุกวัน ทำความสะอาดรางอาหารถ้ามีอาหารเปียกติดราง
                            </p>

                            <p>
                                5) ถ้าบริเวณใกล้เคียงมีศัตรูทำลายไก่ เช่น สุนัข งู ตัวเงินตัวทองให้ทำการป้องกันเช่นทำคอก หรือป้องกันไม่ให้เข้าไปทำลายไก่ได้
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Widget End -->
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
</body>

</html>