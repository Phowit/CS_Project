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