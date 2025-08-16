<?php
// User_TableCollect.php

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

                    <div class="col-5">
                        <h6 class="mb-1">ตารางข้อมูลการเก็บไข่ไก่ : <span id="displaySelectedMonthYear"><?php echo $displayMonthName . ' ' . $displayYearBE; ?></span> ของคุณ</h6>
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

                    <div class="col-1 d-flex">
                        <button type="button" class="btn btn-primary" id="searchTableData">ค้นหา</button>
                    </div>

                    <div class="col-1.5 d-flex">
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#addRecordModal">เพิ่มข้อมูล</button>
                    </div>
                    <?php
                    // หาก User_FormCollect.php คือ Modal สำหรับเพิ่มข้อมูล ให้ require_once ที่นี่
                    require_once("Admin_FormCollect.php");
                    ?>
                </div>

                <div class="table-responsive">
                    <?php
                    $end_Page = 0;
                    // ----------------- ส่วน Pagination Logic -----------------
                    $records_per_page = 7; // จำนวนข้อมูลที่จะแสดงต่อหน้า

                    //รหัสผู้ใช้
                    $User_ID_Login = $_SESSION['User_ID'];

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
                                AND `User_ID` = $User_ID_Login
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
                                collect.`EggAmount`
                                FROM collect
                                WHERE MONTH(collect.`Collect_Date`) = '" . mysqli_real_escape_string($conn, $selected_month) . "'
                                AND YEAR(collect.`Collect_Date`) = '" . mysqli_real_escape_string($conn, $selected_year) . "'
                                AND `User_ID` = $User_ID_Login
                                AND `Collect_Delete` = 0
                                ORDER BY collect.`Collect_Date` DESC
                                LIMIT $records_per_page OFFSET $offset";

                    $result0 = $conn->query($sql0);

                    ?>
                    <table class="table text-start align-middle table-bordered table-hover mb-0">
                        <thead>
                            <tr class="text-dark p-1" style="font-size: 14px;">
                                <th scope="col" class="col-1">ลำดับ</th>
                                <th scope="col" class="col-7">วันที่เก็บ</th>
                                <th scope="col" class="col-3">จำนวน ฟอง</th>
                                <th scope="col" class="col-1">เครื่องมือ</th>
                            </tr>
                        </thead>
                        <tbody style="font-size: 13px;" class="p-1">
                            <?php
                            if ($result0 && mysqli_num_rows($result0) > 0) {
                                $end_Page = +1;
                                while ($row = $result0->fetch_assoc()) {
                                    $Collect_ID = $row['Collect_ID'];
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
                                        <td><?php echo $Collect_Date_Formatted; ?></td>
                                        <td><?php echo $EggAmount; ?></td>
                                        <td>
                                            <button type="button" class="btn" style="height:30px; width:46%; padding: 1px;"
                                                data-bs-target="#EditCollectModal<?= $Collect_ID; ?>" data-bs-toggle="modal">
                                                <i class='far fa-edit' style='color:blue; font-size:16px;'></i>
                                            </button>

                                            <div class="modal fade" id="EditCollectModal<?= $Collect_ID; ?>" tabindex="-1" aria-labelledby="EditCollectModalLabel<?= $Collect_ID; ?>" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="EditCollectModalLabel<?= $Collect_ID; ?>">แก้ไขข้อมูล</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form id="EditCollectForm" action="Update_Collect.php" method="post">
                                                                <input type="hidden" name="Collect_ID" class="form-control" id="Collect_ID_Edit" value="<?php echo $Collect_ID; ?>" readonly>
                                                                <input type="hidden" name="User_ID" class="form-control" id="User_ID" value="<?php echo $_SESSION['User_ID']; ?>" readonly>

                                                                <div class="form-floating mb-3">
                                                                    <input type="datetime-local" class="form-control" id="Collect_Date_Edit" name="Collect_Date" value="<?php echo $Collect_Date_For_Input; ?>" required>
                                                                    <label class="form-label">วันที่เก็บ</label>
                                                                </div>

                                                                <div class="form-floating mb-3">
                                                                    <input type="number" class="form-control" id="EggAmount_Edit" name="EggAmount" value="<?php echo $EggAmount; ?>" min="1" required>
                                                                    <label for="form-label">จำนวน ฟอง</label>
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

                                            <button type="button" class="btn" style="height:30px; width:46%; padding: 1px;"
                                                data-bs-target="#deleteCollectModal<?= $Collect_ID; ?>" data-bs-toggle="modal">
                                                <i class='far fa-trash-alt' style='color:red; font-size:16px;'></i>
                                            </button>

                                            <div class="modal fade" id="deleteCollectModal<?= $Collect_ID; ?>" tabindex="-1" aria-labelledby="deleteCollectModalLabel<?= $Collect_ID; ?>" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteCollectModalLabel<?= $Collect_ID; ?>">ยืนยันการลบข้อมูลหรือไม่?</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form id="deleteCollectForm" action="Delete_Collect.php" method="post">
                                                                <input type="hidden" name="Collect_ID" class="form-control" id="Collect_ID_Edit" value="<?php echo $Collect_ID; ?>" readonly>
                                                                <input type="hidden" name="User_ID" class="form-control" id="User_ID" value="<?php echo $_SESSION['User_ID']; ?>" readonly>

                                                                <p>วันที่เก็บเกี่ยว : <?php echo $Collect_Date_Formatted; ?> </p>
                                                                <p>จำนวน : <?php echo $EggAmount; ?> ฟอง</p>

                                                                <div class="row">
                                                                    <div class="col-12" style="margin-top: 20px;">
                                                                        <button type="button" class="btn btn-secondary float-end" data-bs-dismiss="modal" style="margin-top: 20px;">ยกเลิก</button>
                                                                        <button type="submit" class="btn btn-primary float-end" style="margin-top: 20px; margin-right:10px">ลบข้อมูล</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                            <?php
                                }
                            } else {
                                $end_Page = -$end_Page;
                                echo "<tr><td colspan='4' class='text-center'>ไม่พบข้อมูลการเก็บไข่ของคุณสำหรับเดือน/ปีนี้</td></tr>";
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

<div class="modal fade" id="deleteCollectModal" tabindex="-1" aria-labelledby="deleteCollectModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteCollectModalLabel">ยืนยันการลบข้อมูล</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                คุณแน่ใจหรือไม่ว่าต้องการลบข้อมูลการเก็บไข่นี้?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                <button type="button" class="btn btn-danger" onclick="deleteCollectConfirm()">ลบ</button>
            </div>
        </div>
    </div>
</div>