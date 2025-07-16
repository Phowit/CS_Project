<div class="container-fluid pt-4 px-4 rounded bg-primary">
    <div class="text-center h-100 bg-light rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0 text-dark">จำนวนไก่ที่นำออก</h6>

            <div class="d-flex align-items-center">
                <label for="breedSelectExport" class="form-label mb-0 me-2 col-3">เลือกสายพันธุ์:</label>
                <select class="form-select" name="breedSelectExport" id="breedSelectExport" aria-label="Floating label select example" required>
                    <?php
                    // PHP for dropdown options
                    require_once("connect_db.php");

                    $sql_Picker = "SELECT Breed_ID , Breed_Name FROM breed ORDER BY Breed_Name ASC";
                    $result_Picker = mysqli_query($conn, $sql_Picker);

                    $initial_selected_breed_id = '';
                    if ($result_Picker && $result_Picker->num_rows > 0) {
                        $breed_options = [];
                        while ($row_breedPicker = $result_Picker->fetch_assoc()) {
                            $breed_options[] = $row_breedPicker;
                        }
                        
                        // Set the first breed as default selected if no GET param
                        $initial_selected_breed_id = $breed_options[0]['Breed_ID'];
                        
                        foreach ($breed_options as $option) {
                            $selected = ($initial_selected_breed_id == $option['Breed_ID']) ? 'selected' : '';
                            echo '<option value="' . htmlspecialchars($option['Breed_ID']) . '" ' . $selected . '>';
                            echo htmlspecialchars($option['Breed_Name']);
                            echo '</option>';
                        }
                    } else {
                        echo '<option value="">ไม่พบสายพันธุ์</option>';
                    }
                    ?>
                </select>
                <button type="button" class="btn btn-primary ms-2" id="searchBreedExport">ค้นหา</button>
            </div>

            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                data-bs-target="#addRecordModal" style="height: 35px; width: 95px; margin-right: 10px;">เพิ่มข้อมูล
            </button>

            <?php require_once("Admin_FormExport.php");?>
            </div>

        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-dark" style="font-size:14px">
                        <th scope="col" class="col-0.5">รหัส</th>
                        <th scope="col" class="col-2">วัน เวลา ที่บันทึก</th>
                        <th scope="col" class="col-2">วัน เวลา ที่นำออก</th>
                        <th scope="col" class="col-2">สายพันธุ์</th>
                        <th scope="col" class="col-0.5">จำนวน</th>
                        <th scope="col" class="col-4">รายละเอียด</th>
                        <th scope="col" class="col-1">เครื่องมือ</th>
                    </tr>
                </thead>
                <tbody id="exportTableBody">
                    </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">ยืนยันการลบข้อมูล</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>ต้องการจะลบข้อมูลนี้หรือไม่ ?</p>
                <input type="hidden" id="deleteExportId" value="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">ยืนยัน</button>
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