<?php
require_once("connect_db.php");
?>
<!-- progress start-->

<div class="container-fluid pt-4 px-4">
    <div class="row g-4">

        <div style="width: 20%;">
            <div class="bg-light rounded h-100 p-3">
                <div class="text-center">
                    <img src="My_img/silos.png" style="width: 50px; height: 50px;">
                    <h6 class="mb-1 text-dark">ระบบให้อาหาร </h6>
                </div>

                <div class="row">
                    <div class="col-3"> ปิด </div>

                    <div class="col-6">
                        <div class="form-switch text-center">
                            <input class="form-check-input" type="checkbox" role="switch" id="#" style="width:50px; height:30px;">
                        </div>
                    </div>

                    <div class="col-3"> เปิด </div>
                </div>

            </div>
        </div>

        <div style="width: 20%;">
            <div class="bg-light rounded h-100 p-3">
                <div class="text-center">
                    <img src="My_img/water1.png" style="width: 50px; height: 50px;">
                    <h6 class="mb-1 text-dark">ระบบน้ำดื่ม</h6>
                </div>

                <div class="row">
                    <div class="col-3"> ปิด </div>

                    <div class="col-6">
                        <div class="form-switch text-center">
                            <input class="form-check-input" type="checkbox" role="switch" id="#" style="width:50px; height:30px;">
                        </div>
                    </div>

                    <div class="col-3"> เปิด </div>
                </div>

            </div>
        </div>

        <div style="width: 20%;">
            <div class="bg-light rounded h-100 p-3">
                <div class="text-center">
                    <img src="My_img/sprinkler.png" style="width: 50px; height: 50px;">
                    <h6 class="mb-1 text-dark">สปิงเกอร์</h6>
                </div>

                <div class="row">
                    <div class="col-3"> ปิด </div>

                    <div class="col-6">
                        <div class="form-switch text-center">
                            <input class="form-check-input" type="checkbox" role="switch" id="#" style="width:50px; height:30px;">
                        </div>
                    </div>

                    <div class="col-3"> เปิด </div>
                </div>

            </div>
        </div>

        <div style="width: 20%;">
            <div class="bg-light rounded h-100 p-3">
                <div class="text-center">
                    <img src="My_img/tank.png" style="width: 50px; height: 50px;">
                    <h6 class="mb-1 text-dark">ระบบอาหารเสริม</h6>
                </div>

                <div class="row">
                    <div class="col-3"> ปิด </div>

                    <div class="col-6">
                        <div class="form-switch text-center">
                            <input class="form-check-input" type="checkbox" role="switch" id="#" style="width:50px; height:30px;">
                        </div>
                    </div>

                    <div class="col-3"> เปิด </div>
                </div>

            </div>
        </div>

        <div style="width: 20%;">
            <div class="bg-light rounded h-100 p-3">
                <div class="row">
                    <div class="col-4">
                        <?php

                        require_once("connect_db.php"); // เรียกใช้ไฟล์สำหรับเชื่อมต่อฐานข้อมูล

                        $sql = "SELECT `FoodLevel` FROM `status` ORDER BY `DT_record` DESC LIMIT 1"; // คำสั่ง SQL เพื่อดึงข้อมูลล่าสุดจากฐานข้อมูล

                        $result = mysqli_query($conn, $sql); // ส่งคำสั่ง SQL ไปยังฐานข้อมูลและเก็บผลลัพธ์

                        $row = $result->fetch_assoc(); // ดึงข้อมูลจากผลลัพธ์ในรูปแบบ Associative Array
                        $Progress_Food = $row['FoodLevel']; // ดึงค่าความสูง Progress Bar จากฐานข้อมูล
                        ?>
                        <!-- Progress Bar Container -->
                        <img src="My_img/silo_inner_transparent.png" style="width: 82px; height: 120px; margin-top: -7px; margin-left: -16px; position: absolute; z-index: 2;">
                        <div class="progress-container" style="z-index: 1;">
                            <!-- Progress Bar -->
                            <div class="progress-bar" id="Food_Progress"></div>
                        </div>
                    </div>
                    <div class="col-8">
                        <h6 class="mt-2 mb-2">ระดับอาหาร<br>ในถังเก็บ</h6>
                        <p><?php echo $Progress_Food ?> %</p>
                    </div>
                </div>

                <!-- JavaScript -->
                <script>
                    // ใช้ fetch() เพื่อดึงค่าความสูง Progress Bar จาก PHP
                    fetch("Admin_Progressbar.php") // เรียกไฟล์ PHP เพื่อดึงค่าจากฐานข้อมูล
                        .then((response) => response.text()) // แปลงข้อมูลที่ส่งกลับมาเป็นข้อความ
                        .then((progress) => {
                            console.log("Progress received:", progress); // Debug: แสดงค่าที่ดึงมาใน Console

                            const progressBar = document.getElementById("Food_Progress"); // ดึงองค์ประกอบ Progress Bar

                            const progressValue = parseInt(progress, 10); // แปลงค่าจากข้อความเป็นตัวเลข
                            console.log("Parsed progress value:", progressValue); // Debug: แสดงค่าที่แปลงแล้ว

                            if (!isNaN(progressValue)) { // ตรวจสอบว่าค่าที่ดึงมาเป็นตัวเลขหรือไม่
                                progressBar.style.height = progressValue + "%"; // อัปเดตความสูงของ Progress Bar
                                console.log("Progress bar updated to:", progressValue + "%"); // Debug: แสดงความสูงที่อัปเดต
                            } else {
                                console.error("Invalid progress value:", progress); // แสดงข้อผิดพลาดหากค่าไม่ถูกต้อง
                            }
                        })
                        .catch((error) => console.error("Error fetching progress:", error)); // จัดการข้อผิดพลาดของ fetch()
                </script>
            </div>
        </div>


    </div>
</div>

<!-- show from database end -->