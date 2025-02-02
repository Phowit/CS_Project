<!--Start add-->
<div class="modal fade" id="addRecordModal" tabindex="-1" aria-labelledby="addRecordModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addRecordModalLabel<">เพิ่มข้อมูลการส่งออกไก่ไข่</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <!-- Form for Editing Record -->
                <form id="addRequestForm" action="Insert_Import.php" method="post">
                    <input type="hidden" class="form-control" name="Export_ID" id="Export_ID" value="<?php echo $Export_ID ?>" readonly>

                    <div class="form-floating mb-3">
                        <?php
                        // ตั้งค่า timezone (เปลี่ยนตามพื้นที่ของคุณ)
                        date_default_timezone_set('Asia/Bangkok'); 

                        // ดึงวันที่และเวลาปัจจุบันในรูปแบบที่เหมาะกับ input[type="datetime-local"]
                        $currentDateTime = date('Y-m-d\TH:i');
                        ?>
                        <input type="DateTime-local" class="form-control" name="Export_Date" id="Import_Date" value="<?php echo $currentDateTime; ?>" placeholder required>
                        <label for="Export_Date" class="form-label">วัน เวลา ที่ส่งออก</label>
                    </div>

                    <div class="row">
                        <div class="col-8">
                            <div class="form-floating">
                                <select class="form-select" name="Breed_ID" id="Breed_ID" aria-label="Floating label select example" required>
                                    <?php
                                    require_once("connect_db.php");
                                    $sql = "select * from breed";
                                    $result = mysqli_query($conn, $sql);

                                    while ($row = $result->fetch_assoc()) {
                                    ?>
                                        <option value="<?= $row['Breed_ID']; ?>">
                                            <?= $row['Breed_Name']; ?></option>
                                    <?php   } ?>
                                </select>
                                <label for="Breed_ID" class="form-label" placeholder>สายพันธุ์ไก่</label>
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
            </div>
        </div>
    </div>
</div>
<!--End add-->