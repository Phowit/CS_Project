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
        require_once("Admin_Sidebar.php");
        ?>

        <!-- Blank Start -->
        <div class="content">
            <?php
            require_once("Admin_Navbar.php");
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
                                การเลือกสายพันธุ์ไก่ไข่เป็นปัจจัยสำคัญที่ส่งผลต่อประสิทธิภาพการผลิตและผลกำไร 
                                ผู้เลี้ยงจำเป็นต้องพิจารณาหลายด้าน เช่น วัตถุประสงค์ของการเลี้ยง (เช่น ต้องการไข่จำนวนมาก, 
                                ไข่ขนาดใหญ่, หรือมีศักยภาพในการผลิตเนื้อหลังปลดระวาง), ความเหมาะสมกับสภาพแวดล้อม 
                                (เช่น ความทนทานต่อสภาพอากาศร้อน), และ ความต้านทานโรค นอกจากนี้ยังต้องคำนึงถึงต้นทุน
                                ของสายพันธุ์และความพร้อมในการจัดหา สายพันธุ์ที่ได้รับการพัฒนาเฉพาะทางมักมีประสิทธิภาพสูง 
                                แต่ก็อาจมีราคาสูงและหาได้ยากกว่า การศึกษาข้อมูลของแต่ละสายพันธุ์จากแหล่งที่น่าเชื่อถือ
                                จะช่วยให้ผู้เลี้ยงสามารถตัดสินใจเลือกสายพันธุ์ที่เหมาะสมกับเงื่อนไขการเลี้ยงของตนเองได้
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
                                สภาพแวดล้อมในการเลี้ยงมีอิทธิพลอย่างมากต่อสุขภาพและผลผลิตของไก่ไข่ 
                                แม้ว่าไก่จะเป็นสัตว์ที่ปรับตัวได้ดี แต่การควบคุมปัจจัยทางสภาพแวดล้อมให้เหมาะสมกับสายพันธุ์
                                และช่วงวัยเป็นสิ่งจำเป็นอย่างยิ่ง โดยเฉพาะอย่างยิ่ง อุณหภูมิที่เหมาะสม ซึ่งเป็นปัจจัยหลักที่ส่งผล
                                ต่อความเครียดและการกินอาหารของไก่ไข่ การจัดการโรงเรือนให้มีการระบายอากาศที่ดี 
                                มีความชื้นที่เหมาะสม และสะอาดอยู่เสมอ จะช่วยลดความเสี่ยงของการเกิดโรคและส่งเสริม
                                ให้ไก่มีสุขภาพแข็งแรง สามารถแสดงศักยภาพการผลิตได้อย่างเต็มที่ การศึกษาวิจัยพบว่า
                                การจัดการสภาพแวดล้อมที่ไม่เหมาะสม เช่น ความร้อนสูงเกินไป สามารถลดประสิทธิภาพการผลิตไข่
                                และคุณภาพเปลือกไข่ได้
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
                                โภชนาการที่ครบถ้วนและเหมาะสมเป็นหัวใจสำคัญของการเลี้ยงไก่ไข่ การจัดหาสารอาหาร
                                ในปริมาณที่ถูกต้องตามช่วงอายุและสายพันธุ์จะส่งผลโดยตรงต่อสุขภาพของไก่และการผลิตไข่ที่มีคุณภาพ 
                                โปรตีน เป็นสิ่งจำเป็นสำหรับการเจริญเติบโตของกล้ามเนื้อและการสร้างไข่ขาว ในขณะที่ แร่ธาตุ 
                                โดยเฉพาะแคลเซียมและฟอสฟอรัส มีความสำคัญอย่างยิ่งต่อการสร้างเปลือกไข่ที่แข็งแรงและ
                                พัฒนาการของกระดูก นอกจากนี้ วิตามิน ยังมีบทบาทในการเสริมสร้างภูมิคุ้มกัน
                                และสนับสนุนกระบวนการผลิตไข่ การให้อาหารในปริมาณที่เหมาะสมยังช่วยรักษาสมดุลของร่างกายไก่ 
                                ไม่ให้อ้วนหรือผอมเกินไป ซึ่งจะส่งผลดีต่อประสิทธิภาพการผลิตไข่ในระยะยาว 
                            </a>
                        </div>
                    </div>
                </div>

            </div><br>

            <?php
            require_once("Common_Diseases.php");
            ?>

            <!-- Footer Start -->
            <div class="container-fluid pt-1 px-3 fs-6">
                <div class="bg-light rounded-top p-2">
                    <div class="row">
                        <div class="col-12 col-sm-12 text-center text-sm-start mb-2">
                            ธนกร สุทธิธร. (2559). บทบาทของโภชนาการต่อการผลิตไก่ไข่. วารสารสัตวบาลไทย, 1(1), 1-10. 
                        </div>

                        <div class="col-12 col-sm-12 text-center text-sm-start mb-2">
                            นฤมล มนตรีกุล ณ อยุธยา, วิไลลักษณ์ กิจจาวัฒนชัย, และ ชนะพล อ่อนจันทร์. (2562). 
                            การจัดการสายพันธุ์ไก่ไข่เชิงพาณิชย์. วารสารวิจัยเกษตรและเทคโนโลยี, 7(1), 55-64. 
                        </div>

                        <div class="col-12 col-sm-12 text-center text-sm-start mb-2">
                            วิรัตน์ บัวงาม. (2552). การจัดการโรงเรือนไก่ไข่เพื่อลดความเครียดจากความร้อน. 
                            วารสารวิทยาศาสตร์และเทคโนโลยีการเกษตร, 6(2), 123-130. 
                        </div>

                        <div class="col-12 col-sm-12 text-center text-sm-start">
                            อุดมศักดิ์ มั่นหมาย, สมชาย บุตรจันทร์, และ อรุณศรี ศิริวงษ์. (2558). 
                            อิทธิพลของอุณหภูมิโรงเรือนต่อประสิทธิภาพการผลิตและคุณภาพไข่ไก่. วารสารวิชาการเกษตรศาสตร์, 34(3), 200-210. 
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End -->

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