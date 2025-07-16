<!--Start add-->
<div class="modal fade" id="addRecordModal" tabindex="-1" aria-labelledby="addRecordModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addRecordModalLabel<">เพิ่มข้อมูลการส่งออกไก่ไข่</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">

                <!--Start Form for Insert Export-->
                <form id="addRequestForm" action="Insert_Export.php" method="post">
                    <input type="hidden" class="form-control" name="Export_ID" id="Export_ID" value="<?php echo $Export_ID ?>" readonly>

                    <div class="row">
                        <div class="form-floating mb-3">
                            <select class="form-select" name="import_ID" id="import_ID" aria-label="Floating label select example" required>
                                <?php
                                require_once("connect_db.php");
                                $sql = "SELECT 
                                                `import_ID`,
                                                `Import_Date`,
                                                `Import_Amount`,
                                                `Import_Details`,
                                                breed.Breed_Name
                                            FROM `import` 
                                            INNER JOIN breed
                                            ON import.Breed_ID = breed.Breed_ID";
                                $result = mysqli_query($conn, $sql);

                                while ($row = $result->fetch_assoc()) {
                                    $import_ID = $row['import_ID'];
                                    $Import_Date = $row['Import_Date'];
                                    $Import_Date_Format = date_create_from_format(format: "Y-m-d H:i:s", datetime: $row['Import_Date'])->format(format: "d/m/Y H:i");
                                    $Import_Amount = $row['Import_Amount'];
                                    $Import_Details = $row['Import_Details'];
                                    $Breed_Name = $row['Breed_Name'];
                                    $Option = "รหัส : $import_ID , เวลา : $Import_Date_Format , สายพันธุ์ : $Breed_Name , จำนวน $Import_Amount ตัว";
                                ?>

                                    <option value="<?= $row['import_ID']; ?>">
                                        <?= $Option; ?></option>
                                <?php   } ?>
                            </select>
                            <label for="Breed_ID" class="form-label" placeholder>ข้อมูลการนำเข้าไก่ที่เกี่ยวข้อง</label>
                        </div>

                        <div class="col-8">
                            <div class="form-floating mb-3">
                                <?php
                                // For Show Time Now In Input                        
                                date_default_timezone_set('Asia/Bangkok'); // ตั้งค่า timezone (เปลี่ยนตามพื้น)

                                // ดึงวันที่และเวลาปัจจุบันในรูปแบบที่เหมาะกับ input[type="datetime-local"]
                                $currentDateTime = date('Y-m-d\TH:i');
                                ?>
                                <input type="DateTime-local" class="form-control" name="Export_Date" id="Import_Date" value="<?php echo $currentDateTime; ?>" placeholder required>
                                <label for="Export_Date" class="form-label">วัน เวลา ที่ส่งออก</label>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-floating">
                                <input type="number" class="form-control" name="Import_Amount" id="Import_Amount" min="1" placeholder required>
                                <label for="Import_Amount" class="form-label">จำนวนไก่ทั้งหมด (ตัว)</label>
                            </div>
                        </div>
                    </div><br>

                    <div class="form-floating mb-3">
                        <textarea class="form-control" id="Import_Details" name="Import_Details" style="height: 150px;" placeholder></textarea>
                        <label for="floatingTextarea">รายละเอียด</label>
                    </div>

                    <button type="submit" class="btn btn-primary">บันทึก</button>
                    <button type="reset" class="btn btn-primary" value="Reset">ล้างข้อมูล</button>
                </form>
                <!--End Form for Insert Export-->

            </div>
        </div>
    </div>
</div>
<!--End add-->