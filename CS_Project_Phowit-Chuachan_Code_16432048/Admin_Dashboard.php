<?php
require_once("connect_db.php");

$Status_DataControl = " SELECT `DC_Motor`,`DC_BV_Tem`,`DC_BV_Water`,`DC_BV_FoodS`
                            FROM `datacontrol` 
                            ORDER BY `DateControl_ID` DESC LIMIT 1
                            ";
$DataControl_result = mysqli_query($conn, $Status_DataControl);

while ($row = $DataControl_result->fetch_assoc()) {
    $DC_Motor = $row['DC_Motor'];
    $DC_BV_Tem = $row['DC_BV_Tem'];
    $DC_BV_Water = $row['DC_BV_Water'];
    $DC_BV_FoodS = $row['DC_BV_FoodS'];
}
?>
<!-- progress start-->

<div class="container-fluid pt-4 px-4">
    <div class="row g-4">

        <div style="width: 20%;">
            <div class="bg-light rounded h-100 p-3 pt-2">
                <div class="text-center">
                    <img src="My_img/silos.png" style="width: 50px; height: 50px;">
                    <h6 class="mb-1 text-dark">ระบบให้อาหาร </h6>
                </div>

                <div class="row">
                    <?php
                    if ($DC_Motor == 0) {
                    ?>
                        <div class="text-center">
                            <img src="My_img/switch-off.png" class="p-0 m-0" style="height: 50px; width: 50px;" data-bs-toggle="modal" id="button_Food" data-bs-target="#confirmOnMotor">
                        </div>

                        <div class="modal fade" id="confirmOnMotor" tabindex="-1" aria-labelledby="confirmOnMotorLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="confirmOnMotorLabel">ยืนยันการเปิดระบบให้อาหารไก่ไข่ด้วยตนเองหรือไม่?</h6>

                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body">
                                        <!-- Form for Editing Record -->
                                        <p>ระบบจะทำการเปิดใช้งานระบบให้อาหารไก่จนกว่าผู้ใช้จะปิด หรือจนกว่าอาหารในถาดจะเต็ม</p>
                                        <form id="FormConfirmOnMotorLabel" action="OnMotor.php" method="post">
                                            <button type="submit" class="btn btn-primary" style="width: 100%;">ยืนยัน</button>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    } else {    ?>
                        <div class="text-center">
                            <img src="My_img/switch-on.png" class="p-0 m-0" style="height: 50px; width: 50px;" data-bs-toggle="modal" id="button_Food" data-bs-target="#confirmOffMotor">
                        </div>

                        <div class="modal fade" id="confirmOffMotor" tabindex="-1" aria-labelledby="confirmOffMotorLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="confirmOffMotorLabel">ยืนยันการปิดระบบให้อาหารไก่ไข่ด้วยตนเองหรือไม่?</h6>

                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body">
                                        <!-- Form for Editing Record -->
                                        <p>ระบบจะทำการปิดใช้งานระบบให้อาหารไก่จนกว่าผู้ใช้จะเปิด หรือจนกว่าจะถึงเวลาให้อาหาร</p>
                                        <form id="FormConfirmOffMotorLabel" action="OffMotor.php" method="post">
                                            <button type="submit" class="btn btn-primary" style="width: 100%;">ยืนยัน</button>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>

                </div>
            </div>
        </div>

        <div style="width: 20%;">
            <div class="bg-light rounded h-100 p-3 pt-2">
                <div class="text-center">
                    <img src="My_img/water1.png" style="width: 50px; height: 50px;">
                    <h6 class="mb-1 text-dark">ระบบน้ำดื่ม</h6>
                </div>

                <div class="row">
                    <?php
                    if ($DC_BV_Water == 0) {
                    ?>
                        <div class="text-center">
                            <img src="My_img/switch-off.png" class="p-0 m-0" style="height: 50px; width: 50px;" data-bs-toggle="modal" id="button_Food" data-bs-target="#confirmOnBallValveWater">
                        </div>

                        <div class="modal fade" id="confirmOnBallValveWater" tabindex="-1" aria-labelledby="confirmOnBallValveWaterLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="confirmOnBallValveWaterLabel">ยืนยันการเปิดระบบให้น้ำไก่ไข่ด้วยตนเองหรือไม่?</h6>

                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body">
                                        <!-- Form for Editing Record -->
                                        <p>ระบบให้น้ำไก่ไข่จะเริ่มทำงาน จนกว่าผู้ใช้จะทำการปิดระบบด้วยตนเอง หรือจะสิ้นสุดการทำงานโดยอัตโนมัติหากมีการใช้งานต่อเนื่องเป็นเวลานาน</p>
                                        <form id="FormConfirmOnBallValveWater" action="OnBallValveWater.php" method="post">
                                            <button type="submit" class="btn btn-primary" style="width: 100%;">ยืนยัน</button>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    } else {    ?>
                        <div class="text-center">
                            <img src="My_img/switch-on.png" class="p-0 m-0" style="height: 50px; width: 50px;" data-bs-toggle="modal" id="button_Food" data-bs-target="#confirmOffBallValveWater">
                        </div>

                        <div class="modal fade" id="confirmOffBallValveWater" tabindex="-1" aria-labelledby="confirmOffBallValveWaterLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="confirmOffBallValveWaterLabel">ยืนยันการปิดระบบให้น้ำไก่ไข่ด้วยตนเองหรือไม่?</h6>

                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body">
                                        <!-- Form for Editing Record -->
                                        <p>ระบบให้น้ำแก่ไก่ไข่จะถูกปิดการทำงาน จนกว่าผู้ใช้จะเปิดใช้งานอีกครั้ง หรือจนกว่าจะถึงเวลาทำงานที่ถูกกำหนดไว้</p>
                                        <form id="FormConfirmOffBallValveWater" action="OffBallValveWater.php" method="post">
                                            <button type="submit" class="btn btn-primary" style="width: 100%;">ยืนยัน</button>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>

            </div>
        </div>

        <div style="width: 20%;">
            <div class="bg-light rounded h-100 p-1 pt-2">
                <div class="text-center">
                    <img src="My_img/sprinkler.png" style="width: 50px; height: 50px;">
                    <h6 class="mb-0 text-dark">สปริงเกลอร์ <br> ลดอุณหภูมิ</h6>
                </div>

                <div class="row">
                    <?php
                    if ($DC_BV_Tem == 0) {
                    ?>
                        <div class="text-center">
                            <img src="My_img/switch-off.png" class="p-0 m-0" style="height: 50px; width: 50px;" data-bs-toggle="modal" id="button_Food" data-bs-target="#confirmOnBallValveTem">
                        </div>

                        <div class="modal fade" id="confirmOnBallValveTem" tabindex="-1" aria-labelledby="confirmOnBallValveTemLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="confirmOnBallValveTemLabel">ยืนยันการเปิดใช้งานสปริงเกลอร์ด้วยตนเองหรือไม่?</h6>

                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body">
                                        <!-- Form for Editing Record -->
                                        <p>ระบบสปริงเกลอร์จะเริ่มทำงาน จนกว่าผู้ใช้จะทำการปิดระบบด้วยตนเอง  หรือจะสิ้นสุดการทำงานโดยอัตโนมัติหากมีการใช้งานต่อเนื่องเป็นเวลานาน</p>
                                        <form id="FormConfirmOnBallValveTem" action="OnBallValveTem.php" method="post">
                                            <button type="submit" class="btn btn-primary" style="width: 100%;">ยืนยัน</button>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    } else {    ?>
                        <div class="text-center">
                            <img src="My_img/switch-on.png" class="p-0 m-0" style="height: 50px; width: 50px;" data-bs-toggle="modal" id="button_Food" data-bs-target="#confirmOffBallValveTem">
                        </div>

                        <div class="modal fade" id="confirmOffBallValveTem" tabindex="-1" aria-labelledby="confirmOffBallValveTemLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="confirmOffBallValveTemLabel">ยืนยันการปิดใช้งานสปริงเกลอร์ด้วยตนเองหรือไม่?</h6>

                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body">
                                        <!-- Form for Editing Record -->
                                        <p>ระบบสปริงเกลอร์จะถูกปิดการทำงาน จนกว่าผู้ใช้จะเปิดใช้งานอีกครั้ง หรือจนกว่าอุณหภูมิจะถึงระดับที่ถูกกำหนดไว้</p>
                                        <form id="FormConfirmOffBallValveTem" action="OffBallValveTem.php" method="post">
                                            <button type="submit" class="btn btn-primary" style="width: 100%;">ยืนยัน</button>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>

            </div>
        </div>

        <div style="width: 20%;">
            <div class="bg-light rounded h-100 p-2 pt-2">
                <div class="text-center">
                    <img src="My_img/tank.png" style="width: 50px; height: 50px;">
                    <h6 class="mt-2 text-dark p-0">ระบบให้อาหารเสริม</h6>
                </div>

                <div class="row">
                    <?php
                    if ($DC_BV_FoodS == 0) {
                    ?>
                        <div class="text-center">
                            <img src="My_img/switch-off.png" class="p-0 m-0" style="height: 50px; width: 50px;" data-bs-toggle="modal" id="button_Food" data-bs-target="#confirmOnBallValveFoodS">
                        </div>

                        <div class="modal fade" id="confirmOnBallValveFoodS" tabindex="-1" aria-labelledby="confirmOnBallValveFoodSLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="confirmOnBallValveFoodSLabel">ยืนยันการเปิดใช้งานระบบให้อาหารเสริมด้วยตนเองหรือไม่?</h6>

                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body">
                                        <!-- Form for Editing Record -->
                                        <p>ระบบให้อาหารเสริมจะเริ่มทำงาน จนกว่าผู้ใช้จะทำการปิดระบบด้วยตนเอง  หรือจะสิ้นสุดการทำงานโดยอัตโนมัติหากมีการใช้งานต่อเนื่องเป็นเวลานาน</p>
                                        <form id="FormConfirmOnBallValveFoodS" action="OnBallValveFoodS.php" method="post">
                                            <button type="submit" class="btn btn-primary" style="width: 100%;">ยืนยัน</button>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    } else {    ?>
                        <div class="text-center">
                            <img src="My_img/switch-on.png" class="p-0 m-0" style="height: 50px; width: 50px;" data-bs-toggle="modal" id="button_Food" data-bs-target="#confirmOffBallValveFoodS">
                        </div>

                        <div class="modal fade" id="confirmOffBallValveFoodS" tabindex="-1" aria-labelledby="confirmOffBallValveFoodSLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="confirmOffBallValveFoodSLabel">ยืนยันการปิดใช้งานระบบให้อาหารเสริมด้วยตนเองหรือไม่?</h6>

                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body">
                                        <!-- Form for Editing Record -->
                                        <p>ระบบให้อาหารเสริมจะถูกปิดการทำงาน จนกว่าผู้ใช้จะเปิดใช้งานอีกครั้ง หรือจนกว่าจะถึงเวลาทำงานที่ถูกกำหนดไว้</p>
                                        <form id="FormConfirmOffBallValveFoodS" action="OffBallValveFoodS.php" method="post">
                                            <button type="submit" class="btn btn-primary" style="width: 100%;">ยืนยัน</button>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
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

                        $result = mysqli_query($conn, $sql);

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