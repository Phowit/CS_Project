<?php
require_once("connect_db.php");
session_start();

/*
    if (!isset($_SESSION['Admin_ID'])) {
        $_SESSION['msg'] = "You must log in first";
        header('location: signin.php');
    }

    if (!isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['Admin_ID']);
        header('location: signin.php');
    }*/
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
            require_once("Admin_SideBar1.php");
        ?>
        <!-- Sidebar End -->

        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <?php
                require_once("Admin_NavBar.php");
            ?>
            <!-- Navbar End -->

            <!-- progress -->
            <?php
                require_once("Public_bar.php");
            ?>
            <!-- progress -->


            <!-- Chart Start อาหารหลัก & อาหารในถาด-->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <!--Chart Start อาหารหลัก-->
                    <?php
                        require_once("Admin_ChartFood.php");
                    ?>
                    <!--Chart End อาหารหลัก-->

                    <!--Chart Start อาหารหลัก-->
                    <?php
                        require_once("Admin_ChartFoodTray.php");
                    ?>
                    <!--Chart End อาหารหลัก-->
                </div>
            </div>
            <!--Chart End อาหารหลัก & อาหารในถาด-->

            <!--Chart Start อาหารเสริม & อุณหภูมิ-->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <!--Chart Start อาหารเสริม-->
                    <?php
                        require_once("Admin_ChartSupplementaryFood.php");
                    ?>
                    <!--Chart End อาหารเสริม-->

                    <!--Chart Start อุณหภูมิ-->
                    <?php
                        require_once("Admin_ChartTemperature.php");
                    ?>
                    <!--Chart End อุณหภูมิ-->
                </div>
            </div>
            <!--Chart End อาหารเสริม & อุณหภูมิ-->

            <!-- Widgets Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">

                    <!-- calendar Start-->
                    <div class="col-sm-12 col-md-6 col-xl-4">
                        <div class="h-100 bg-light rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4 text-dark">
                                <h6 class="mb-0">ปฏิทิน</h6>
                            </div>
                            <div id="calender"></div>
                        </div>
                    </div>
                    <!-- calendar End-->

                    <!-- status Start-->
                    <div class="col-sm-12 col-md-6 col-xl-8">
                        <div class="h-100 bg-light rounded p-4">
                            <h6>วิธีการเลี้ยงไก่พื้นฐาน</h6><br>
                            <p>การเลี้ยงไก่ไข่เริ่มจากการเลือกสายพันธุ์ที่เหมาะสม เช่น ไก่โรดไทยหรือไก่เล็กฮอร์นขาว
                                จากนั้นสร้างโรงเรือนที่มีการระบายอากาศดีและสะอาด ให้น้ำและอาหารที่มีคุณภาพสูงอย่างสม่ำเสมอ
                                ควบคุมอุณหภูมิและแสงสว่างในโรงเรือนเพื่อให้ไก่มีสุขภาพดี
                                ป้องกันโรคด้วยการฉีดวัคซีนและรักษาความสะอาดของโรงเรือนอย่างต่อเนื่อง
                                สุดท้ายตรวจสอบและบันทึกผลผลิตไข่เพื่อปรับปรุงการเลี้ยงในอนาคต12</p>
                        </div>
                    </div>
                    <!-- status End-->
                    <!-- Widgets End -->
                </div>
            </div>
            <!-- Widgets End -->

            <!--Chart Start อุณหภูมิ-->
            <?php
                require_once("Admin_Dashboard.php");
            ?>
            <!--Chart End อุณหภูมิ-->
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

    <!-- chart -->
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

        /* function domeUpdate(dome_id) {
             var dome_name = document.getElementById("dome_name").value;
             var dome_size = document.getElementById("dome_size").value;
             var dome_img = document.getElementById("dome_img").value;

             if (dome_name.trim() == '' || dome_size.trim() == '' || dome_img.trim() == '') {
                 alert("กรุณากรอกข้อมูลให้ครบทุกช่อง");
             } else {
                 window.location.href = "dome_update.php?dome_id=" + dome_id +
                     "&dome_name=" + dome_name +
                     "&dome_size=" + dome_size +
                     "&dome_img=" + dome_img;
             }
         }*/
    </script>

    <!-- start Modal-->
    <script>
        // Get the modal
        var modal = document.getElementById("Modal");

        // Get the button that opens the modal
        var btn = document.getElementById("myBtn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal 
        btn.onclick = function() {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
    <!-- start Modal-->
</body>

</html>