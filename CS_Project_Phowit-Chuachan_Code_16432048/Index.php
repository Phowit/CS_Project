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

            <div class="container-fluid pt-3 px-4">
                <h5>สถานะระบบ</h5>

                <div class="row">
                    <div class="col-md-10 col-sm-12 col-xl-9 bg-light rounded p-2">
                        <!-- Carousel -->
                        <img src="My_img/Farm.png" alt="Farm" style="width:100%; height: auto;">
                    </div>
                    <?php
                    require_once("connect_db.php");
                    $sql = "SELECT 
                            `T_Level`,
                            `ServoMoter`,
                            `BallValve_Tem`,
                            `BallValve_water`,
                            `BallValve_SFood`,
                            `FoodLevel`,
                            `DT_record`
                            FROM status
                            ORDER BY `DT_record` DESC
                            LIMIT 1;
                        ";
                    $result = mysqli_query($conn, $sql);

                    if ($result->num_rows > 0) {
                        // วนลูปเพื่อดึงข้อมูลทีละแถว
                        while ($row = $result->fetch_assoc()) {
                            // แปลงค่า 0 และ 1 เป็นคำว่า ปิด และ เปิด
                            $DT_record = date_create_from_format(format: "Y-m-d H:i:s", datetime: $row["DT_record"])->format(format: "d/m/Y");
                            $T_Level = $row["T_Level"];
                            $T_Status = $row["T_Level"] > 30 ? "ร้อนเกินไป" : ($row["T_Level"] < 22 ? "เย็นเกินไป" : "อุณหภูมิเหมาะสม");
                            $ServoMoter = $row["ServoMoter"] == 0 ? "ปิด" : "เปิด";
                            $BallValve_Tem = $row["BallValve_Tem"] == 0 ? "ปิด" : "เปิด";
                            $BallValve_water = $row["BallValve_water"] == 0 ? "ปิด" : "เปิด";
                            $BallValve_SFood = $row["BallValve_SFood"] == 0 ? "ปิด" : "เปิด";
                            $FoodLevel = $row["FoodLevel"];
                        }
                    } else { 
                            $DT_record = "ไม่พบข้อมูล";
                            $T_Level = "ไม่พบข้อมูล";
                            $T_Status = "";
                            $ServoMoter = "ไม่พบข้อมูล";
                            $BallValve_Tem = "ไม่พบข้อมูล";
                            $BallValve_water = "ไม่พบข้อมูล";
                            $BallValve_SFood = "ไม่พบข้อมูล";
                            $FoodLevel = "ไม่พบข้อมูล";
                    }
                    ?>

                    <div class="col-md-10 col-sm-12 col-xl-3">
                        <!-- Carousel -->
                        <div class="col-sm-6 col-xl-12 m-2">
                            <div class="bg-light rounded h-100 p-1 d-flex align-items-center">
                                <img src="My_img/temperature.png" style="width: 40px; height: 40px; margin-right:10px;">
                                <div class="w-100 ms-3">
                                    <a>อุณหภูมิโรงเรือน</a>
                                    <h6 class="mb-1 text-dark"><?php echo $T_Level; echo " ".$T_Status; ?></h6>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xl-12 m-2">
                            <div class="bg-light rounded h-100 p-1 d-flex align-items-center py-2">
                                <img src="My_img/silos.png" alt="" style="width: 40px; height: 40px; margin-right:10px;">
                                <div class="w-100 ms-3">
                                    <a>ระบบให้อาหาร</a>
                                    <h6 class="mb-1 text-dark">สถานะ : <?php echo $ServoMoter; ?></h6>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xl-12 m-2">
                            <div class="bg-light rounded h-100 p-1 d-flex align-items-center py-2">
                                <img src="My_img/water1.png" alt="" style="width: 40px; height: 40px; margin-right:10px;">
                                <div class="w-100 ms-3">
                                    <a>ระบบน้ำดื่ม</a>
                                    <h6 class="mb-1 text-dark">สถานะ :<?php echo $BallValve_water; ?></h6>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xl-12 m-2">
                            <div class="bg-light rounded h-100 p-1 d-flex align-items-center py-2">
                                <img src="My_img/sprinkler.png" alt="" style="width: 40px; height: 40px; margin-right:10px;">
                                <div class="w-100 ms-3">
                                    <a>วาล์วน้ำสปิงเกอร์ ลดอุณหภูมิ</a>
                                    <h6 class="mb-1 text-dark">สถานะ : <?php echo $BallValve_Tem; ?></h6>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xl-12 m-2">
                            <div class="bg-light rounded h-100 p-1 d-flex align-items-center py-2">
                                <img src="My_img/tank.png" alt="" style="width: 40px; height: 40px; margin-right:10px;">
                                <div class="w-100 ms-3">
                                    <a>ระบบให้อาหารเสริม</a>
                                    <h6 class="mb-1 text-dark">สถานะ : <?php echo $BallValve_SFood; ?></h6>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xl-12 m-2">
                            <div class="bg-light rounded h-100 p-1 d-flex align-items-center py-2">
                                <img src="My_img/silo(2).png" alt="" style="width: 40px; height: 40px; margin-right:10px;">
                                <div class="w-100 ms-3">
                                    <a>ระดับอาหารในถัง</a>
                                    <h6 class="mb-1 text-dark">สถานะ : <?php echo $FoodLevel; ?></h6>
                                </div>
                            </div>
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

    <!-- chart -->
    <script src="chart.js"></script>
</body>

</html>