<?php
// Admin_TableCollect.php

// ตรวจสอบให้แน่ใจว่าได้เรียกใช้ connect_db.php แล้ว
// ในกรณีที่คุณ include ไฟล์นี้ในไฟล์หลักอีกที ก็อาจจะไม่ต้อง require_once ที่นี่ซ้ำ
// แต่ถ้าไฟล์นี้สามารถรันเดี่ยวๆ ได้ ควรมีไว้
require_once("connect_db.php");

// กำหนดเดือนและปีเริ่มต้น
$current_month = date('n'); // เดือนปัจจุบัน (1-12)
$current_year = date('Y'); // ปีปัจจุบัน (YYYY)

$selected_month = $current_month;
$selected_year = $current_year;

// ตรวจสอบว่ามีการส่งค่า 'month' และ 'year' มาหรือไม่ (จาก JS ที่ส่งมาใน URL)
if (isset($_GET['month']) && !empty($_GET['month'])) {
    // ใช้ intval เพื่อแปลงเป็นตัวเลขเพื่อความปลอดภัยอีกชั้นก่อน mysqli_real_escape_string
    $selected_month = intval($_GET['month']);
}
if (isset($_GET['year']) && !empty($_GET['year'])) {
    // ใช้ intval เพื่อแปลงเป็นตัวเลขเพื่อความปลอดภัยอีกชั้นก่อน mysqli_real_escape_string
    $selected_year = intval($_GET['year']);
}

// ลิสต์ชื่อเดือนภาษาไทยสำหรับแสดงผลใน dropdown และในหัวตาราง
$thaiMonths = [
    1 => 'มกราคม',
    2 => 'กุมภาพันธ์',
    3 => 'มีนาคม',
    4 => 'เมษายน',
    5 => 'พฤษภาคม',
    6 => 'มิถุนายน',
    7 => 'กรกฎาคม',
    8 => 'สิงหาคม',
    9 => 'กันยายน',
    10 => 'ตุลาคม',
    11 => 'พฤศจิกายน',
    12 => 'ธันวาคม'
];
$displayMonthName = $thaiMonths[$selected_month];
$displayYearBE = $selected_year + 543; // ปีพุทธศักราช

?>
<div class="container-fluid pt-4 px-4">
    <div class="row">
        <div class="col-sm-12 col-xl-12">
            <div class="h-100 bg-light rounded p-4">
                <div class="d-flex align-items-center mb-4">

                    <div class="col-6">
                        <h6 class="mb-1">ตารางข้อมูลการเก็บไข่ไก่ : <span id="displaySelectedMonthYear"><?php echo $displayMonthName . ' ' . $displayYearBE; ?></span></h6>
                    </div>

                    <div class="col-1 d-flex">
                        <label for="selectMonth" class="form-label">เลือกเดือน:</label>
                    </div>

                    <div class="col-1.5 d-flex">
                        <select class="form-select me-2" id="selectMonth" name="month">
                            <?php
                            // สร้างตัวเลือกเดือน
                            foreach ($thaiMonths as $num => $name) {
                                $selected = ($num == $selected_month) ? 'selected' : '';
                                echo "<option value='{$num}' {$selected}>{$name}</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col-0.5 d-flex">
                        <label for="selectYear" class="form-label mb-0 me-2">เลือกปี:</label>
                    </div>

                    <div class="col-1.5 d-flex">
                        <select class="form-select me-2" id="selectYear" name="year">
                            <?php
                            // สร้างตัวเลือกปี (ย้อนหลังไป 5 ปี และไปข้างหน้า 1 ปี)
                            for ($year = $current_year - 5; $year <= $current_year + 1; $year++) {
                                $selected = ($year == $selected_year) ? 'selected' : '';
                                echo "<option value='{$year}' {$selected}>" . ($year + 543) . "</option>"; // แสดงเป็นปีพุทธศักราช
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col-1.5 d-flex">
                        <button type="button" class="btn btn-primary" id="searchTableData">ค้นหา</button>
                    </div>
                </div>

                <div class="table-responsive">
                    <?php
                    $end_Page = 0;
                    // ----------------- ส่วน Pagination Logic -----------------
                    $records_per_page = 7; // จำนวนข้อมูลที่จะแสดงต่อหน้า

                    // ตรวจสอบหน้าปัจจุบันจาก URL
                    if (isset($_GET['page']) && is_numeric($_GET['page'])) {
                        $current_page = $_GET['page'];
                    } else {
                        $current_page = 1; // ถ้าไม่มีการระบุหน้า ให้ถือว่าเป็นหน้าแรก
                    }

                    // คำนวณจุดเริ่มต้น (OFFSET) สำหรับการดึงข้อมูล
                    $offset = ($current_page - 1) * $records_per_page;

                    // ส่วนของ PHP ที่ Query ข้อมูลจากฐานข้อมูล
                    $sql = "SELECT
                                collect.`Collect_ID`,
                                collect.`Collect_Date`,
                                collect.`EggAmount`
                                AS total
                                FROM collect
                                WHERE MONTH(collect.`Collect_Date`) = '" . mysqli_real_escape_string($conn, $selected_month) . "'
                                AND YEAR(collect.`Collect_Date`) = '" . mysqli_real_escape_string($conn, $selected_year) . "'
                                ORDER BY collect.`Collect_Date` DESC;
                            ";

                    $result = mysqli_query($conn, $sql);

                    if (!$result) {
                        echo "Error: " . mysqli_error($conn);
                    }

                    // ดึงจำนวนข้อมูลทั้งหมดในตาราง เพื่อคำนวณจำนวนหน้าทั้งหมด
                    $row_total = $result->fetch_assoc();

                    if ($row_total > 0) {
                        $total_records = $row_total['total'];
                        // คำนวณจำนวนหน้าทั้งหมด
                        $total_pages = ceil($total_records / $records_per_page);
                    }

                    // ----------------- ดึงข้อมูลสำหรับหน้าปัจจุบัน -----------------
                    $sql0 = "SELECT
                                collect.`Collect_ID`,
                                collect.`Collect_Date`,
                                collect.`EggAmount`,
                                user.`User_Name`
                                FROM collect
                                INNER JOIN user ON collect.User_ID = user.User_ID
                                WHERE MONTH(collect.`Collect_Date`) = '" . mysqli_real_escape_string($conn, $selected_month) . "'
                                AND YEAR(collect.`Collect_Date`) = '" . mysqli_real_escape_string($conn, $selected_year) . "'
                                ORDER BY collect.`Collect_Date`
                                LIMIT $records_per_page OFFSET $offset";

                    $result0 = $conn->query($sql0);

                    ?>
                    <table class="table text-start align-middle table-bordered table-hover mb-0">
                        <thead>
                            <tr class="text-dark p-1" style="font-size: 14px;">
                                <th scope="col" class="col-1">ลำดับ</th>
                                <th scope="col" class="col-2">ผู้บันทึก</th>
                                <th scope="col" class="col-6">วันที่เก็บ</th>
                                <th scope="col" class="col-3">จำนวน (ฟอง)</th>
                            </tr>
                        </thead>
                        <tbody style="font-size: 13px;" class="p-1">
                            <?php
                            if ($result0 && mysqli_num_rows($result0) > 0) {
                                $end_Page = +1;
                                while ($row = $result0->fetch_assoc()) {
                                    $Collect_ID = $row['Collect_ID'];
                                    $User_Name = $row['User_Name'];
                                    $Collect_Date_Raw = $row["Collect_Date"];
                                    $Collect_Date_Obj = date_create_from_format("Y-m-d H:i:s", $Collect_Date_Raw);
                                    if ($Collect_Date_Obj) {
                                        $Collect_Date_For_Input = $Collect_Date_Obj->format("Y-m-d\TH:i");
                                        $Collect_Date_Formatted = $Collect_Date_Obj->format("d/m/Y H:i:s");
                                    } else {
                                        $Collect_Date_For_Input = "";
                                        $Collect_Date_Formatted = $Collect_Date_Raw;
                                    }
                                    $EggAmount = $row['EggAmount'];
                            ?>
                                    <tr>
                                        <td><?php echo $Collect_ID; ?></td>
                                        <td><?php echo $User_Name; ?></td>
                                        <td><?php echo $Collect_Date_Formatted; ?></td>
                                        <td><?php echo $EggAmount; ?></td>
                                    </tr>
                            <?php
                                }
                            } else {
                                $end_Page = -$end_Page;
                                echo "<tr><td colspan='4' class='text-center'>ไม่พบข้อมูลการเก็บไข่สำหรับเดือน/ปีนี้</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>

                    <?php
                    // ----------------- ส่วนแสดง Pagination Links -----------------
                    echo "<div class='pagination'>";

                    // เราจะสร้างตัวแปรเพื่อเก็บพารามิเตอร์เดือน
                    $month_param = '';
                    if (!empty($selected_month)) {
                        $month_param = '&month=' . urlencode($selected_month); // ใช้ urlencode เพื่อให้ปลอดภัยถ้ามีอักขระพิเศษ
                    }

                    // เราจะสร้างตัวแปรเพื่อเก็บพารามิเตอร์ปี
                    $year_param = '';
                    if (!empty($selected_year)) {
                        $year_param = '&year=' . urlencode($selected_year); // ใช้ urlencode เพื่อให้ปลอดภัยถ้ามีอักขระพิเศษ
                    }

                    // ปุ่ม Previous
                    if ($current_page > 1) {
                        echo "<a href='?page=" . ($current_page - 1) . $month_param . $year_param . "' class='page-link'>&laquo; ก่อนหน้า</a>";
                    } else {
                        echo "<a class = 'p-2'>หน้าแรก</a>";
                    }

                    // ปุ่ม Next
                    if ($end_Page > 0) {
                        echo "<a href='?page=" . ($current_page + 1) . $month_param . $year_param . "' class='page-link'>ถัดไป &raquo;</a>";
                    } else {
                        echo "<a class = 'p-2'>หน้าสุดท้าย</a>";
                    }
                    echo "</div>";
                    ?>

                </div>
            </div>
        </div>
    </div>
</div>