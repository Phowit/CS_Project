<?php
require_once("connect_db.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>สมัครสมาชิก</title>
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


        <!-- Sign Up Start -->
        <div class="container-fluid">
            <div class="row h-50 align-items-center justify-content-center">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <div class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h3>สร้างบัญชีผู้ดูแล</h3>
                        </div>

                        <form action="register_AdminData.php" method="post">

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="Admin_ID" placeholder required>
                                <label for="Admin_ID" class="form-label">รหัสประจำตัว</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="Name" placeholder required>
                                <label for="Name" class="form-label">ชื่อ</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" name="Password" placeholder required>
                                <label for="Password" class="form-label">รหัสผ่าน</label>
                            </div>

                            <div class="form-floating mb-3" name="Program_ID" placeholder required>
                                <select class="form-select">
                                    <option selected>ผู้ดูแลภายนอก</option>
                                    <option value="1">สาขาวิชาคณิตศาสตร์</option>
                                    <option value="2">สาขาวิชาวิทยาศาสตร์</option>
                                    <option value="3">สาขาวิชาสังคมศึกษา</option>
                                </select>
                                <label for="floatingSelect">สาขา</label>
                            </div>

                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <a href="">ลืมรหัสผ่าน</a>
                            </div>

                            <button type="submit" class="btn btn-primary py-3 w-100 mb-4">สมัครสมาชิก</button>
                            <p class="text-center mb-0">มีบัญชีอยู่แล้ว<a href="signin.php">เข้าสู่ระบบ</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sign Up End -->
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