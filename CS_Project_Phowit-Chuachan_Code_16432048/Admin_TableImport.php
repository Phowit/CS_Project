<div class="container-fluid pt-4 px-4 rounded bg-primary">
    <div class="text-center h-100 bg-light rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0 text-dark">จำนวนไก่ที่นำเข้า กราฟประจำวันที่: <span id="displaySelectedDate"></span></h6>

            <div class="d-flex align-items-center">
                <label for="chartDatePicker" class="form-label mb-0 me-2 col-3">เลือกวันที่:</label>
                <input type="date" class="form-control me-2" id="chartDatePicker" name="date" value="<?php echo date('Y-m-d'); ?>">
                <button type="button" class="btn btn-primary" id="searchChartData">ค้นหา</button>
            </div>
            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                data-bs-target="#addRecordModal" style="height: 35px; width: 95px;">เพิ่มข้อมูล
            </button>

            <!-- เริ่ม ฟอร์มเพิ่มข้อมูลนำเข้าไก่ไข่ -->
            <?php
            require_once("Admin_FormImport.php")
            ?>
            <!-- จบ ฟอร์มเพิ่มข้อมูลนำเข้าไก่ไข่ -->
        </div>

        <div class="table-responsive">
            <?php
            require_once("connect_db.php");

            // กำหนดวันที่เริ่มต้น
            $current_date = date('Y-m-d'); // วันที่ปัจจุบันในรูปแบบ YYYY-MM-DD
            $selected_date = $current_date; // ตั้งค่าเริ่มต้นเป็นวันที่ปัจจุบัน

            if (isset($_GET['date']) && !empty($_GET['date'])) {
                $selected_date = mysqli_real_escape_string($conn, $_GET['date']);
            }

            $sql = "SELECT
                    `Import_ID`,
                    `Import_Date_Record`,
                    `Import_Date`,
                    `Import_Amount`,
                    `Import_Details`,
                    import.`Breed_ID`,
                    breed.Breed_Name
                    FROM import
                    INNER JOIN breed ON import.Breed_ID = breed.Breed_ID
                    WHERE DATE(import.`Import_Date`) = '$selected_date';
                    ";

            $result = mysqli_query($conn, $sql);

            // ตรวจสอบข้อผิดพลาดในการ query
            if (!$result) {
                echo "Error: " . mysqli_error($conn);
            }

            ?>

            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-dark" style="font-size:14px">
                        <th scope="col" class="col-0.5">รหัส</th>
                        <th scope="col" class="col-2">วัน เวลา ที่บันทึก</th>
                        <th scope="col" class="col-2">วัน เวลา ที่นำเข้า</th>
                        <th scope="col" class="col-2">สายพันธุ์</th>
                        <th scope="col" class="col-0.5">จำนวน</th>
                        <th scope="col" class="col-4">รายละเอียด</th>
                        <th scope="col" class="col-1">เครื่องมือ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $Import_ID = $row['Import_ID'];
                            $Import_Date_Record = date_create_from_format(format: "Y-m-d H:i:s", datetime: $row["Import_Date_Record"])->format(format: "d/m/Y H:i");
                            $Import_Date = $row["Import_Date"];
                            $Import_Date_Obj = date_create_from_format("Y-m-d H:i:s", $Import_Date);
                            if ($Import_Date_Obj) {
                                // ตรวจสอบรูปแบบ datetime-local ใน input ว่าต้องการแบบไหน
                                // สำหรับ input type="datetime-local" format ต้องเป็น YYYY-MM-DDTHH:mm
                                $Import_Date_For_Input = $Import_Date_Obj->format("Y-m-d\TH:i");
                                $Import_Date_Formatted = $Import_Date_Obj->format("d/m/Y H:i:s"); // สำหรับแสดงผลในตาราง
                            } else {
                                $Import_Date_For_Input = ""; // หรือจัดการตามเหมาะสม
                                $Import_Date_Formatted = $Import_Date_Raw;
                            }

                            $Breed_Name = $row['Breed_Name'];
                            $Import_Amount = $row['Import_Amount'];
                            $Import_Details = $row['Import_Details'];

                            // ตรวจสอบว่าพบข้อมูลหรือไม่
                            $import_date = isset($row['Import_Date']) ? date('Y-m-d\TH:i', strtotime($row['Import_Date'])) : '';

                            $old_Breed_ID = isset($row_old['Breed_ID']) ? $row_old['Breed_ID'] : '';
                    ?>
                            <tr style="font-size:12px">
                                <td><?php echo $Import_ID; ?></td>
                                <td><?php echo $Import_Date_Record; ?></td>
                                <td><?php echo $Import_Date_Formatted; ?></td>
                                <td><?php echo $Breed_Name; ?></td>
                                <td><?php echo $Import_Amount; ?> ตัว</td>
                                <td><?php echo $Import_Details; ?></td>

                                <td>
                                    <button type="button" class="btn" data-bs-toggle="modal" style="height:30px; width:46%; padding: 1px;"
                                        data-bs-target="#editImportModal<?= $Import_ID; ?>">
                                        <i class='far fa-edit' style='color:blue; font-size:16px;'></i>
                                    </button>

                                    <!--Start Edit-->
                                    <div class="modal fade" id="editImportModal<?= $Import_ID; ?>" tabindex="-1" aria-labelledby="editImportModalLabel<?= $Import_ID; ?>" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editImportModalLabel<?= $Import_ID; ?>">แก้ไขข้อมูล</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- Form for Editing Import ทดสอบ การแก้ไขข้อมูลการนำเข้าไก่ไข่ครั้งที่ 1 -->
                                                    <form id="addRequestForm" action="Update_Import.php" method="post">
                                                        <input type="hidden" class="form-control" name="Import_ID" id="Import_ID" value="<?php echo $Import_ID; ?>" readonly>

                                                        <div class="form-floating mb-3">
                                                            <input type="DateTime-local" class="form-control" name="Import_Date" id="Import_Date" value="<?php echo htmlspecialchars($import_date); ?>" placeholder required>
                                                            <label for="Import_Date" class="form-label">วัน เวลา ที่นำเข้ามาเลี้ยง (<?php echo $Import_Date; ?>)</label>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-8">
                                                                <div class="form-floating">
                                                                    <select class="form-select" name="Breed_ID" id="Breed_ID" aria-label="Floating label select example" required>
                                                                        <?php
                                                                        require_once("connect_db.php");
                                                                        $sql0 = "SELECT * FROM breed";
                                                                        $result0 = mysqli_query($conn, $sql0);

                                                                        while ($row_breed = $result0->fetch_assoc()) { // เปลี่ยนชื่อ row เป็น row_breed ป้องกันข้อมูลชนกัน
                                                                            $selected = ($row_breed['Breed_ID'] == $row['Breed_ID']) ? 'selected' : ''; // ใช้ $row['Breed_ID'] เพื่อเทียบค่าเก่า
                                                                        ?>
                                                                            <option value="<?= $row_breed['Breed_ID']; ?>" <?= $selected; ?>>
                                                                                <?= $row_breed['Breed_Name']; ?>
                                                                            </option>
                                                                        <?php } ?>
                                                                    </select>
                                                                    <label for="Breed_ID" class="form-label" placeholder>สายพันธุ์ไก่ (<?php echo $Breed_Name; ?>)</label>
                                                                </div>
                                                            </div>

                                                            <div class="col-4">
                                                                <div class="form-floating">
                                                                    <input type="number" class="form-control" name="New_Import_Amount" id="New_Import_Amount" min="1" value="<?php echo $Import_Amount; ?>" placeholder required>
                                                                    <label for="New_Import_Amount" class="form-label">จำนวนไก่ทั้งหมด (ตัว)</label>
                                                                </div>
                                                            </div>
                                                        </div><br>

                                                        <div class="form-floating">
                                                            <input type="text" class="form-control" name="Import_Details" id="Import_Details" style="height: 100px;" value="<?php echo $Import_Details; ?>" placeholder required>
                                                            <label for="floatingTextarea">รายละเอียด</label>
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
                                    <!--End Edit-->

                                    <button class="btn" data-bs-toggle="modal" onclick="ImportID(<?= $Import_ID; ?>)"
                                        data-bs-target="#confirmDeleteModal" style="height:30px; width:46%; padding: 5px;">
                                        <i class='material-icons' style='color:red; font-size:20px;'>delete</i>
                                    </button>
                                </td>

                                <!--Start Waring For Delete-->
                                <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h5 class="modal-title" id="confirmDeleteModalLabel">ยืนยันการลบข้อมูล</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <div class="modal-body">
                                                <p>ต้องการจะลบข้อมูลนี้หรือไม่ ?</p>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                                                <button type="button" class="btn btn-danger" onclick="deleteImportData()">ยืนยัน</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!--END Warning For Delete-->
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

<div class="container-fluid pt-4 px-4">
    <div class="row">
        <div class="col-sm-12 col-xl-12">
            <div class="h-100 bg-light rounded p-4">
                <div class="mb-4">
                    <h6 class="mb-0 text-dark">จำนวนไก่ที่นำเข้า</h6>
                    <canvas id="Import_Chart" style="max-width:100%; max-height:200px;"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid pt-4 px-4">
    <div class="row">
        <div class="col-sm-12 col-xl-12">
            <div class="h-100 bg-light rounded p-4">
                <div class="mb-4">
                    <h6 class="mb-0 text-dark">จำนวนไก่ที่นำเข้าทั้งหมด</h6>
                    <canvas id="Total_Import_Chart" style="max-width:100%; max-height:300px;"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var ImportID;

    // ฟังก์ชันเพื่อรับค่า member_ID เมื่อคลิกที่ปุ่ม "ลบ"
    function ImportID(Import_ID) {
        ImportID = Import_ID;
    }

    function deleteImportData() {

        // ถ้ายืนยันการลบ ทำการ redirect ไปยังไฟล์ planting_delete.php พร้อมส่งค่า id ของแถวที่ต้องการลบ
        window.location.href = "Delete_Import.php?id=" + ImportID;

    }
</script>

<!--จบส่วนแยก เข้าสู่ส่วนทั้งหมด -->