<?php
require_once("connect_db.php");
session_start();

// ตรวจสอบว่าผู้ใช้เข้าสู่ระบบหรือไม่
if (!isset($_SESSION['Admin_ID'])) {
    header("Location: signin.php"); // หากยังไม่ได้ล็อกอิน ย้ายไปหน้า signin.php
    exit();
}
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
        require_once("Admin_SideBar7.php");
        ?>
        <!-- Sidebar End -->

        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <?php
            require_once("Admin_NavBar.php");
            ?>
            <!-- Navbar End -->

            <!-- table Start -->
            <?php
            require_once("connect_db.php");
            $sql = "SELECT * FROM faculty";
            $result = mysqli_query($conn, $sql);

            while ($row = $result->fetch_assoc()) {
                $Faculty_ID = $row['Faculty_ID'];
                $Faculty_Name = $row['Faculty_Name'];

            ?>

                <div class="container-fluid pt-4 px-4">
                    <div class="h-100 bg-light rounded p-4">
                        <div class="row" style="margin-bottom: 10px;">
                            <div class="col-sm-8 col-xl-10">
                                <h5 class="mb-4"><?php echo $Faculty_Name; ?></h5>
                            </div>

                            <div class="col-sm-2 col-xl-1">
                                <button type="button"
                                        class="btn btn-primary"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editFacultyModal<?= $Faculty_ID; ?>">
                                        แก้ไข
                                </button>
                            </div>

                            <!--Start Edit Faculty-->
                            <div class="modal fade" id="editFacultyModal<?= $Faculty_ID; ?>" tabindex="-1" aria-labelledby="editRecordModalLabel<?= $Faculty_ID; ?>" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editFacultyModalLabel<?= $Faculty_ID; ?>">แก้ไขข้อมูล</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Form for Editing Record -->
                                            <form id="editFacultyForm" action="Update_Faculty.php" method="post">
                                                <!-- Add your form fields here for additional request details -->

                                                <input type="hidden" name="Faculty_ID" class="form-control" id="Faculty_ID" value="<?php echo $Faculty_ID; ?>" readonly>

                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="Faculty_Name" name="Faculty_Name" value="<?php echo $Faculty_Name; ?>" placeholder required>
                                                    <label class="form-label">ชื่อคณะ</label>
                                                </div>

                                                <div class="row">
                                                    <div class="col-12" style="margin-top: 20px;">
                                                        <button type="button" class="btn btn-secondary float-end" data-bs-dismiss="modal" style="margin-top: 20px;">ยกเลิก</button>
                                                        <button type="submit" class="btn btn-primary float-end" style="margin-top: 20px; margin-right:10px">บันทึก</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--End Edit Faculty-->

                            <div class="col-sm-2 col-xl-1">
                                <button type="button"
                                        class="btn btn-danger"
                                        data-bs-toggle="modal"
                                        onclick="GeneID(<?= $Faculty_ID; ?>)"
                                        data-bs-target="#confirmDeleteModal">
                                        ลบ
                                </button>
                            </div>
                        </div>

                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <?php
                            $sql1 = "SELECT * FROM program WHERE Faculty_ID = $Faculty_ID";
                            $result1 = mysqli_query($conn, $sql1);
                            ?>

                            <table class="table text-start align-middle table-bordered table-hover mb-0">
                                <thead>
                                    <tr class="text-dark">
                                        <th scope="col" class="col-10">สาขา</th>
                                        <th scope="col" class="col-1">แก้ไข</th>
                                        <th scope="col" class="col-1">ลบ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($row = $result1->fetch_assoc()) {
                                        $Program_ID = $row['Program_ID'];
                                        $Program_Name = $row['Program_Name'];
                                    ?>
                                        <tr>
                                            <td><?php echo $Program_Name; ?></td>

                                            <!--แก้ไข-->
                                            <td>
                                                <button type="button"
                                                        class="btn btn-primary"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editProgramModal<?= $Program_ID; ?>">
                                                        แก้ไข
                                                </button>
                                            </td>

                                            <!--Start Edit Program-->
                                            <div class="modal fade" id="editProgramModal<?= $Program_ID; ?>" tabindex="-1" aria-labelledby="editRecordModalLabel<?= $Program_ID; ?>" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editProgramModalLabel<?= $Program_ID; ?>">แก้ไขข้อมูล</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <!-- Form for Editing Record -->
                                                            <form id="editProgramForm" action="Update_Program.php" method="post">
                                                                <!-- Add your form fields here for additional request details -->

                                                                <input type="hidden" name="Program_ID" class="form-control" id="Program_ID" value="<?php echo $Program_ID; ?>" readonly>

                                                                <div class="form-floating mb-3">
                                                                    <input type="text" class="form-control" id="Program_Name" name="Program_Name" value="<?php echo $Program_Name; ?>" placeholder required>
                                                                    <label class="form-label">ชื่อสาขา</label>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-12" style="margin-top: 20px;">
                                                                        <button type="button" class="btn btn-secondary float-end" data-bs-dismiss="modal" style="margin-top: 20px;">ยกเลิก</button>
                                                                        <button type="submit" class="btn btn-primary float-end" style="margin-top: 20px; margin-right:10px">บันทึก</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--End Edit Program-->

                                            <!--Start Edit-->
                                            <!--End Edit-->

                                            <td>
                                                <button type="button"
                                                        class="btn btn-danger"
                                                        data-bs-toggle="modal"
                                                        onclick="GeneID(<?= $Faculty_ID; ?>)"
                                                        data-bs-target="#confirmDeleteModal">
                                                        ลบ
                                                </button>
                                            </td>

                                            <!--Start Waring For Delete-->
                                            <!--END Warning For Delete-->

                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <!-- table End -->

        </div>
        <!-- Content End -->
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

    <script>
        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the button that opens the modal
        var btn = document.getElementById("myBtn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("btn-close")[0];

        // When the user clicks on the button, open the modal
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

    <script>
        var GeneID;

        // ฟังก์ชันเพื่อรับค่า member_ID เมื่อคลิกที่ปุ่ม "ลบ"
        function GeneID(Gene_ID) {
            GeneID = Gene_ID;
        }

        function deleteGene() {

            // ถ้ายืนยันการลบ ทำการ redirect ไปยังไฟล์ planting_delete.php พร้อมส่งค่า id ของแถวที่ต้องการลบ
            window.location.href = "Delete_Gene.php?id=" + GeneID;

        }
    </script>
</body>

</html>