<?php
require_once("connect_db.php");
?>
<div class="container-fluid pt-2 px-4">
    <h5>สถานะระบบ</h5>

    <div class="row" style="font-size: 13px;">
        <div class="col-md-10 col-sm-12 col-xl-8 bg-light rounded p-2 mb-2">
            <!-- Carousel -->
            <img src="My_img/Farm.png" alt="Farm" style="width:100%; height: auto;">
        </div>
        <?php
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

        <div class="col-md-10 col-sm-12 col-xl-2">
            <!-- Carousel -->
            <div class="col-sm-6 col-xl-12 m-2">
                <div class="bg-light rounded h-100 p-1 text-center">
                    <div class="row text-center">
                        <div class="col-12 mt-1">
                            <img src="My_img/silos.png" style="width: 50px; height: 50px;">
                        </div>
                    </div>
                    <div class="row">
                        <a>ระบบให้อาหาร</a>
                        <a class="text-dark">สถานะ : <?php echo $ServoMoter; ?></a>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-xl-12 m-2">
                <div class="bg-light rounded h-100 p-1 text-center">
                    <div class="row">
                        <div class="col-12 mt-1">
                            <img src="My_img/water1.png" style="width: 50px; height: 50px;">
                        </div>
                    </div>
                    <div class="row">
                        <a>ระบบน้ำดื่ม</a>
                        <a class="text-dark">สถานะ :<?php echo $BallValve_water; ?></a>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-xl-12 m-2">
                <div class="bg-light rounded h-100 p-1 text-center">
                    <div class="row">
                        <div class="col-12 mt-1">
                            <img src="My_img/sprinkler.png" style="width: 50px; height: 50px;">
                        </div>
                    </div>
                    <div class="row">
                        <a>สปิงเกอร์ลดอุณหภูมิ</a>
                        <a class="text-dark">สถานะ : <?php echo $BallValve_Tem; ?></a>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-xl-12 m-2">
                <div class="bg-light rounded h-100 p-1 text-center">
                    <div class="row">
                        <div class="col-12 mt-1">
                            <img src="My_img/tank.png" style="width: 50px; height: 50px;">
                        </div>
                    </div>
                    <div class="row">
                        <a>ระบบให้อาหารเสริม</a>
                        <a class="text-dark">สถานะ : <?php echo $BallValve_SFood; ?></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-10 col-sm-12 col-xl-2">

            <div class="col-sm-6 col-xl-12 m-2">
                <div class="bg-light rounded h-100 p-1">
                    <div class="rounded h-100 p-3">
                        <div class="row mb-1">
                            <div class="col-3 p-0 m-0">
                                <?php

                                require_once("connect_db.php"); // เรียกใช้ไฟล์สำหรับเชื่อมต่อฐานข้อมูล

                                $sql1 = "SELECT `FoodLevel` FROM `status` ORDER BY `DT_record` DESC LIMIT 1"; // คำสั่ง SQL เพื่อดึงข้อมูลล่าสุดจากฐานข้อมูล

                                $result1 = mysqli_query($conn, $sql1); // ส่งคำสั่ง SQL ไปยังฐานข้อมูลและเก็บผลลัพธ์

                                $row = $result1->fetch_assoc(); // ดึงข้อมูลจากผลลัพธ์ในรูปแบบ Associative Array
                                $Progress_Food = $row['FoodLevel']; // ดึงค่าความสูง Progress Bar จากฐานข้อมูล
                                ?>
                                <!-- Progress Bar Container -->
                                <img src="My_img/silo_inner_transparent.png" style="width: 52px; height: 80px; margin-top: -10px; margin-left: -10px; margin-bottom: -1px; position: absolute; z-index: 2;">
                                <div style="margin-left: 1px;">
                                    <div class="progress-container1" style="z-index: 1;">
                                        <!-- Progress Bar -->
                                        <div class="progress-bar1" id="Food_Progress"></div>
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
                            <div class="col-9 p-1 m-0">
                                <a style="margin-left:3px;">ระดับอาหารในถัง</a>
                                <a class="text-dark" style="margin-left:3px;">สถานะ : <?php echo $Progress_Food; ?> %</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-xl-12 m-2 text-center">
                <div class="bg-light rounded h-100 p-1">
                    <div class="row">
                        <div class="col-12 mt-1">
                            <img src="My_img/chicken1.png" style="width: 50px; height: 50px;">
                        </div>
                    </div>
                    <div class="row">
                    <?php
                    $sql = "SELECT `Total` FROM `total` ORDER BY `Total_Date` DESC LIMIT 1";

                    $result = mysqli_query($conn, $sql);

                    while ($row = $result->fetch_assoc()) {
                        $Total = $row['Total'];
                    }
                    ?>
                        <a>จำนวนไก่ในโรงเรือน</a>
                        <a class="text-dark"><?php echo$Total ?> ตัว</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-xl-12 m-2">
                <div class="bg-light rounded h-100 p-1 text-center">
                    <div class="row">
                        <div class="col-12 mt-1">
                            <img src="My_img/temperature.png" style="width: 50px; height: 50px;">
                        </div>
                    </div>
                    <div class="row">
                        <a>อุณหภูมิโรงเรือน</a>
                        <a class="text-dark"><?php echo $T_Level; echo " " . $T_Status; ?></a>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-xl-12 m-2">
                <div class="bg-light rounded h-100 p-1 text-center">
                    <div class="row">
                        <div class="col-12 mt-1">
                            <img src="My_img/eggs.png" style="width: 50px; height: 50px;">
                        </div>
                    </div>
                    <div class="row">
                        <a>อัตราการออกไข่</a>
                        <a class="text-dark"><?php echo $T_Level; ?> %</a>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>