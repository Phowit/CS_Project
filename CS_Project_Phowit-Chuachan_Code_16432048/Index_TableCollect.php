<div class="container-fluid pt-4 px-4">
    <div class="row">

        <div class="col-sm-12 col-xl-12">
            <div class="h-100 bg-light rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-1">ตารางข้อมูลการเก็บไข่ไก่ของวันที่ : <span id="displaySelectedDate"></span></h6>

                    <div class="d-flex align-items-center">
                        <label for="chartDatePicker" class="form-label mb-0 me-2 col-3">เลือกวันที่:</label>
                        <input type="date" class="form-control me-2" id="chartDatePicker" name="date" value="<?php echo date('Y-m-d'); ?>">
                        <button type="button" class="btn btn-primary" id="searchChartData">ค้นหา</button>
                    </div>

                </div>

                <div class="table-responsive">
                    <?php
                    require_once("connect_db.php");

                    // กำหนดวันที่เริ่มต้น
                    $current_date = date('Y-m-d'); // วันที่ปัจจุบันในรูปแบบ YYYY-MM-DD
                    $selected_date = $current_date; // ตั้งค่าเริ่มต้นเป็นวันที่ปัจจุบัน

                    // *** แก้ไขส่วนนี้ ***
                    // ตรวจสอบว่ามีการส่งค่า 'date' (จาก JavaScript) หรือ 'search_date' (ถ้ากดปุ่ม submit แบบเก่า) มาหรือไม่
                    // เพื่อความสอดคล้องกับ chart.js และ Chart_Collect.php ที่แก้ไป แนะนำให้ใช้ 'date'
                    if (isset($_GET['date']) && !empty($_GET['date'])) {
                        $selected_date = mysqli_real_escape_string($conn, $_GET['date']);
                    }
                    // ถ้ายังต้องการรองรับแบบเก่าเผื่อไว้ (ไม่แนะนำ):
                    // else if (isset($_GET['search_date']) && !empty($_GET['search_date'])) {
                    //     $selected_date = mysqli_real_escape_string($conn, $_GET['search_date']);
                    // }
                    // *** สิ้นสุดการแก้ไขส่วนนี้ ***

                    // ปรับปรุง SQL Query ให้กรองตามวันที่
                    $sql = "SELECT
                                collect.`Collect_ID`,
                                collect.`Collect_Date`,
                                collect.`EggAmount`
                                FROM collect
                                WHERE DATE(collect.`Collect_Date`) = '$selected_date'
                                ORDER BY collect.`Collect_Date` DESC;
                            ";

                    $result = mysqli_query($conn, $sql);

                    // ตรวจสอบข้อผิดพลาดในการ query
                    if (!$result) {
                        echo "Error: " . mysqli_error($conn);
                    }

                    ?>
                    <table class="table text-start align-middle table-bordered table-hover mb-0">
                        <thead>
                            <tr class="text-dark p-1" style="font-size: 14px;">
                                <th scope="col" class="col-1">ลำดับ</th>
                                <th scope="col" class="col-7">วันที่เก็บ</th>
                                <th scope="col" class="col-3">จำนวน (ฟอง)</th>
                            </tr>
                        </thead>
                        <tbody style="font-size: 13px;" class="p-1">
                            <?php
                            if ($result && mysqli_num_rows($result) > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $Collect_ID = $row['Collect_ID'];
                                    $Collect_Date_Raw = $row["Collect_Date"];
                                    $Collect_Date_Obj = date_create_from_format("Y-m-d H:i:s", $Collect_Date_Raw);
                                    if ($Collect_Date_Obj) {
                                        // ตรวจสอบรูปแบบ datetime-local ใน input ว่าต้องการแบบไหน
                                        // สำหรับ input type="datetime-local" format ต้องเป็น YYYY-MM-DDTHH:mm
                                        $Collect_Date_For_Input = $Collect_Date_Obj->format("Y-m-d\TH:i");
                                        $Collect_Date_Formatted = $Collect_Date_Obj->format("d/m/Y H:i:s"); // สำหรับแสดงผลในตาราง
                                    } else {
                                        $Collect_Date_For_Input = ""; // หรือจัดการตามเหมาะสม
                                        $Collect_Date_Formatted = $Collect_Date_Raw;
                                    }

                                    $EggAmount = $row['EggAmount'];
                            ?>
                                    <tr>
                                        <td><?php echo $Collect_ID; ?></td>
                                        <td><?php echo $Collect_Date_Formatted; ?></td>
                                        <td><?php echo $EggAmount; ?></td>
                                    </tr>
                            <?php
                                }
                            } else {
                                echo "<tr><td colspan='4' class='text-center'>ไม่พบข้อมูลการเก็บไข่สำหรับวันที่นี้</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>