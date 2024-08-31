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
		    require_once("Admin_SideBar5.php");
		?>
        <!-- Sidebar End -->

        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <?php
                require_once("Admin_NavBar.php");
            ?>
            <!-- Navbar End -->


            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-md-12 col-xl-12">
                        <div class="h-100 bg-primary rounded p-4">

                            <?php
                                require_once("connect_db.php");
                                $sql = "select * from admin ";
                                $result = mysqli_query($conn,$sql);
                            ?>

                            <?php
                                while($row = $result->fetch_assoc()){
                                $Admin_ID = $row['Admin_ID'];
                                $Name = $row['Name'];
                                //$Password = $row['Password'];
                                $Tel = $row['Tel'];
                                $Address = $row['Address'];
                                $Email = $row['Email'];
                                $AdminName = $row['AdminName'];
                                $Program_ID = $row['Program_ID'];
                            ?>
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <h6 class="mb-0">ข้อมูลผู้ดูแลระบบ</h6>
                            </div>

                            <div class="d-flex justify-content-between">
                                <p>รหัสผู้ดูแลระบบ : </p>
                                <p><?php echo $row['Admin_ID'];?></p>
                            </div>

                            <div class="d-flex justify-content-between">
                                <p>ชื่อ-นามสกุล หรือ ชื่อเพียงอย่างเดียว : </p>
                                <p><?php echo $row['Name'];?></p>
                            </div>

                            <div class="d-flex justify-content-between">
                                <p>เบอร์โทรติดต่อ : </p>
                                <p><?php echo $row['Tel'];?></p>
                            </div>
                            
                            <div class="d-flex justify-content-between">
                                <p>ที่อยู่ : </p>
                                <p><?php echo $row['Address'];?></p>
                            </div>
                            
                            <div class="d-flex justify-content-between">
                                <p>อีเมล : </p>
                                <p><?php echo $row['Email'];?></p>
                            </div>
                            
                            <div class="d-flex justify-content-between">
                                <p>ชื่อผู้ใช้ : </p>
                                <p><?php echo $row['AdminName'];?></p>
                            </div>
                            
                            <div class="d-flex justify-content-between">
                                <p>รหัสสาขา : </p>
                                <p><?php echo $row['Program_ID'];?></p>
                            </div>

                            <div class="d-flex justify-content-between">
                                <p>สาขา : </p>
                                <p>ทดสอบ</p>
                            </div>

                            <div class="d-flex justify-content-between">
                                <p>คณะ : </p>
                                <p>ทดสอบ</p>
                            </div>

                            <a href="Admin_AddData.php" class="btn btn-sm btn-primary">แก้ไข</a><br>
                            <a>----------------------------------------------------------------------</a>
                            <?php }?> <!-- close php-->
                        </div>
                    </div>
                </div>
            </div>

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