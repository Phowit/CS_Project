<?php
// Admin_TableImport.php

// เชื่อมต่อฐานข้อมูล
require_once("connect_db.php");

// ดึงรายการสายพันธุ์ทั้งหมดจากฐานข้อมูลสำหรับ Dropdown
$breeds = [];
$sql_breeds = "SELECT Breed_ID, Breed_Name FROM breed ORDER BY Breed_Name ASC";
$result_breeds = mysqli_query($conn, $sql_breeds);

if ($result_breeds) {
    while ($row_breed = mysqli_fetch_assoc($result_breeds)) {
        $breeds[] = $row_breed;
    }
} else {
    error_log("Error fetching breeds for dropdown: " . mysqli_error($conn));
}

// กำหนดค่าเริ่มต้นของสายพันธุ์ที่เลือก
$selected_breed_id = 'all';

// ตรวจสอบว่ามีการส่งค่า 'breed_id' มาจาก URL (จาก JS) หรือไม่
if (isset($_GET['breed_id']) && $_GET['breed_id'] !== '') {
    $selected_breed_id = mysqli_real_escape_string($conn, $_GET['breed_id']);
}

// กำหนดเงื่อนไข WHERE clause สำหรับ SQL Query และชื่อสายพันธุ์สำหรับแสดงผล
$where_clause = "";
$display_breed_name_in_title = "ทั้งหมด";

if ($selected_breed_id !== 'all') {
    $where_clause = "AND i.`Breed_ID` = $selected_breed_id";
    foreach ($breeds as $breed) {
        if ($breed['Breed_ID'] == $selected_breed_id) {
            $display_breed_name_in_title = $breed['Breed_Name'];
            break;
        }
    }
}


// SQL Query เพื่อดึงข้อมูลการนำเข้าสำหรับการแสดงผลครั้งแรก
$sql_data_initial_load = "SELECT
                            i.`Import_ID`,
                            i.`Import_Date`,
                            i.`Import_Amount`,
                            i.`Import_Details`,
                            b.`Breed_Name`,
                            b.`Breed_ID`
                        FROM `import` i
                        JOIN `breed` b ON i.`Breed_ID` = b.`Breed_ID`
                        WHERE `Import_Delete` = 0
                        $where_clause
                        ORDER BY i.`Import_Date` DESC;";

$result_data_initial_load = mysqli_query($conn, $sql_data_initial_load);

// เตรียมข้อมูลสำหรับส่งไปยัง JavaScript เพื่อให้ JS สร้างตาราง (เมื่อโหลดหน้าครั้งแรก)
$initial_table_data = [];
if ($result_data_initial_load) {
    while ($row = $result_data_initial_load->fetch_assoc()) {
        // จัดรูปแบบวันที่สำหรับแสดงผลและสำหรับ input type="datetime-local"
        $Import_Date_Obj = date_create_from_format("Y-m-d H:i:s", $row["Import_Date"]);
        $Import_Date_For_Input = $Import_Date_Obj ? $Import_Date_Obj->format("Y-m-d\TH:i") : "";
        $Import_Date_Formatted = $Import_Date_Obj ? $Import_Date_Obj->format("d/m/Y H:i:s") : "";

        $initialTableData[] = [
            'Import_ID' => $row['Import_ID'],
            'Import_Date' => $Import_Date_Formatted, // สำหรับแสดงในตาราง
            'Import_Date_For_Input' => $Import_Date_For_Input, // สำหรับใส่ใน input datetime-local
            'Breed_Name' => $row['Breed_Name'],
            'Breed_ID' => $row['Breed_ID'], // สำหรับเลือกใน dropdown แก้ไข
            'Import_Amount' => $row['Import_Amount'],
            'Import_Details' => $row['Import_Details']
        ];
    }
} else {
    error_log("Error fetching initial import data: " . mysqli_error($conn));
}

?>

<div class="container-fluid pt-4 px-4 rounded bg-primary mb-5">
    <div class="text-center h-100 bg-light rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="m-0 text-dark col-4">ตารางจัดการข้อมูลการนำเข้าไก่ไข่</h6>

            <div class="d-flex align-items-center col-6">
                <label for="breedSelectImport" class="form-label mb-0 me-2 col-4">เลือกสายพันธุ์ไก่ไข่:</label>
                <select class="form-select" name="breedSelectImport" id="breedSelectImport" aria-label="Floating label select example" required>
                    <option value="all" <?php echo ($selected_breed_id == 'all') ? 'selected' : ''; ?>>-- แสดงทั้งหมด --</option>
                    <?php
                    foreach ($breeds as $option) {
                        $selected = ($option['Breed_ID'] == $selected_breed_id) ? 'selected' : '';
                        echo '<option value="' . htmlspecialchars($option['Breed_ID']) . '" ' . $selected . '>';
                        echo htmlspecialchars($option['Breed_Name']);
                        echo '</option>';
                    }
                    ?>
                </select>
                <button type="button" class="btn btn-primary ms-2" id="searchBreedImport">ค้นหา</button>
            </div>

            <button type="button" class="btn btn-warning col-2" data-bs-toggle="modal"
                data-bs-target="#addRecordModal" style="height: 35px; width: 95px;">เพิ่มข้อมูล
            </button>

            <?php require_once("Admin_FormImport.php"); ?>
        </div>

        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-dark" style="font-size:14px">
                        <th scope="col" class="col-1">ลำดับ</th>
                        <th scope="col" class="col-2">วัน เวลา ที่นำเข้า</th>
                        <th scope="col" class="col-2">สายพันธุ์</th>
                        <th scope="col" class="col-2">จำนวน (ตัว)</th>
                        <th scope="col" class="col-4">รายละเอียด</th>
                        <th scope="col" class="col-1">เครื่องมือ</th>
                    </tr>
                </thead>
                <tbody id="importTableBody">
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="editImportModal" tabindex="-1" aria-labelledby="editImportModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editImportModalLabel">แก้ไขข้อมูลการนำเข้า</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm" action="Update_Import.php" method="post">
                    <input type="hidden" name="Import_ID" class="form-control" id="edit_Import_ID" value="" readonly>

                    <div class="form-floating mb-3">
                        <input type="datetime-local" class="form-control" name="Import_Date" id="edit_Import_Date" required>
                        <label for="edit_Import_Date">วัน เวลา ที่นำเข้ามาเลี้ยง</label>
                    </div>

                    <div class="row">
                        <div class="col-8">
                            <div class="form-floating">
                                <select class="form-select" name="Breed_ID" id="edit_Breed_ID" aria-label="Floating label select example" required>
                                    <?php
                                    // Populate breed options for edit modal using $breeds array
                                    foreach ($breeds as $option) {
                                        echo '<option value="' . htmlspecialchars($option['Breed_ID']) . '">' . htmlspecialchars($option['Breed_Name']) . '</option>';
                                    }
                                    ?>
                                </select>
                                <label for="edit_Breed_ID">สายพันธุ์ไก่</label>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-floating">
                                <input type="number" class="form-control" name="New_Import_Amount" id="edit_Import_Amount" value="" min="1" required>
                                <label for="New_Import_Amount">จำนวนไก่ที่นำเข้า (ตัว)</label>
                            </div>
                        </div>
                    </div><br>

                    <div class="form-floating">
                        <textarea class="form-control" name="Import_Details" id="edit_Import_Details" value="" style="height: 100px;" required></textarea>
                        <label for="edit_Import_Details">รายละเอียด</label>
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

<div class="modal fade" id="deleteImportModal" tabindex="-1" aria-labelledby="deleteImportModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteImportModalLabel">ยืนยันการลบข้อมูลหรือไม่?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="DeleteForm" action="Delete_Import.php" method="post">
                    <input type="hidden" name="Delete_Import_ID" class="form-control" id="delete_Import_ID" value="" readonly>
                    <input type="hidden" name="Delete_Import_Amount" class="form-control" id="delete_Import_Amount" value="" readonly>

                    
                    <div class="row">
                        <div class="col-12" style="margin-top: 20px;">
                            <button type="button" class="btn btn-secondary float-end" data-bs-dismiss="modal" style="margin-top: 20px;">ยกเลิก</button>
                            <button type="submit" class="btn btn-warning float-end" style="margin-top: 20px; margin-right:10px">ยืนยัน</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    // ส่งข้อมูลที่ PHP ดึงมาตอนแรกไปยัง JavaScript
    // ใช้ JSON.parse(decodeURIComponent(...)) เพื่อความปลอดภัยในการส่งข้อมูลที่มีอักขระพิเศษ
const initialImportTableData = JSON.parse('<?php echo json_encode($initialTableData); ?>');
</script>