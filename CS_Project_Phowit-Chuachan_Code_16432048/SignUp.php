<?php
require_once("connect_db.php");
session_start();

// หากผู้ใช้ล็อกอินแล้ว ให้ย้ายไปหน้า dashboard
if (isset($_SESSION['User_Name'])) {
    header("Location: Admin_Index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>ระบบจัดการฟาร์มไก่ไข่อัจฉริยะด้วยเทคโนโลยีอินเทอร์เน็ตของสรรพสิ่ง</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <link rel="icon" type="image/x-icon" href="My_img/chicken.png">

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

        <!-- Sign In Start -->
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-10">
                    <div class="bg-primary rounded p-4 p-sm-5 my-4 mx-3">

                        <form id="addRequestForm" action="Insert_UserData.php" method="post" enctype="multipart/form-data">

                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <a href="index.html" class="">
                                    <h6 class="text-dark"></i>สมัครสมาชิก</h6>
                                </a>
                            </div>

                                <div class="row">
                                    <div class="col-9 form-floating mb-2">
                                        <input type="text" class="form-control" name="User_Name" placeholder required>
                                        <label for="User_Name" class="form-label">Name (ชื่อ นามสกุล หรือเพียงชื่อ)</label>
                                    </div>

                                    <div class="col-3 form-floating">
                                        <input type="password" class="form-control" name="User_Password" placeholder required>
                                        <label for="User_Password" class="form-label">Password (รหัสผ่าน)</label>
                                    </div>
                                </div>

                            <div class="form-floating mb-2">
                                <input type="tel" class="form-control" name="User_Tel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{2}-[0-9]{2}"
                                    placeholder="ตัวอย่าง 123-456-78-90" placeholder>
                                <label for="User_Tel" class="form-label">Tel (เบอร์โทรติดต่อ) ตัวอย่าง 081-234-56-78</label>
                            </div>

                            <div class="form-floating mb-2">
                                <input type="text" class="form-control" name="User_Address" placeholder required>
                                <label for="User_Address" class="form-label">Address (ที่อยู่ติดต่อ)</label>
                            </div>

                                <div class="row">
                                    <div class="col-7 form-floating">
                                        <input type="Email" class="form-control" name="User_Email" placeholder required>
                                        <label for="User_Email" class="form-label"> Email (อีเมลติดต่อ)</label>
                                    </div>

                                    <div class="col-5 form-floating mb-2">
                                        <input type="text" class="form-control" name="Program"placeholder required>
                                        <label for="Program" class="form-label">สาขา</label>
                                    </div>
                                </div>

                                <div class="form-floating mb-2">
                                    <a>เลือกรูปภาพ</a>
                                    <input type="file" id="User_Image" name="User_Image">
                                </div>

                                <button type="submit" class="btn btn-primary py-1 col-1">ยืนยัน</button>
                                <a href="User_Index.php" class="btn btn-warning py-1 col-1">ยกเลิก</a>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sign In End -->
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