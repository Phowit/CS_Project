<div class="container-fluid pt-4 px-4 rounded bg-primary">
    <div class="text-center h-100 bg-light rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0 text-dark">จำนวนไก่ที่นำเข้า</h6>

            <div class="d-flex align-items-center">
                <label for="breedSelectImport" class="form-label mb-0 me-2 col-3">เลือกสายพันธุ์:</label>
                <select class="form-select" name="breedSelectImport" id="breedSelectImport" aria-label="Floating label select example" required>
                    <?php
                    // PHP for dropdown options (same as before, but only for initial load)
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
                <button type="button" class="btn btn-primary ms-2" id="searchBreedImport">ค้นหา</button>
            </div>
            
            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                data-bs-target="#addRecordModal" style="height: 35px; width: 95px;">เพิ่มข้อมูล
            </button>

            <?php require_once("Admin_FormImport.php"); // Ensure this file exists and contains your add modal ?>
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
                    <input type="hidden" name="Import_ID" id="edit_Import_ID">
                    
                    <div class="form-floating mb-3">
                        <input type="datetime-local" class="form-control" name="Import_Date" id="edit_Import_Date" required>
                        <label for="edit_Import_Date">วัน เวลา ที่นำเข้ามาเลี้ยง</label>
                    </div>

                    <div class="row">
                        <div class="col-8">
                            <div class="form-floating">
                                <select class="form-select" name="Breed_ID" id="edit_Breed_ID" aria-label="Floating label select example" required>
                                    <?php
                                    // PHP for breed options in edit modal (still dynamic)
                                    require_once("connect_db.php");
                                    $sql_edit_breed = "SELECT Breed_ID, Breed_Name FROM breed ORDER BY Breed_Name ASC";
                                    $result_edit_breed = mysqli_query($conn, $sql_edit_breed);
                                    if ($result_edit_breed) {
                                        while ($row_edit_breed = $result_edit_breed->fetch_assoc()) {
                                            echo '<option value="' . htmlspecialchars($row_edit_breed['Breed_ID']) . '">' . htmlspecialchars($row_edit_breed['Breed_Name']) . '</option>';
                                        }
                                    }
                                    if ($conn) mysqli_close($conn);
                                    ?>
                                </select>
                                <label for="edit_Breed_ID">สายพันธุ์ไก่</label>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-floating">
                                <input type="number" class="form-control" name="New_Import_Amount" id="edit_Import_Amount" min="1" required>
                                <label for="edit_Import_Amount">จำนวนไก่ทั้งหมด (ตัว)</label>
                            </div>
                        </div>
                    </div><br>

                    <div class="form-floating">
                        <textarea class="form-control" name="Import_Details" id="edit_Import_Details" style="height: 100px;" required></textarea>
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
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">ยืนยัน</button>
            </div>
        </div>
    </div>
</div>