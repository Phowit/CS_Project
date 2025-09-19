<!--Start add-->
<div class="modal fade" id="addRecordModal" tabindex="-1" aria-labelledby="addRecordModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addRecordModalLabel<">เพิ่มข้อมูลการเก็บไข่ไก่</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">

                <!-- Form for Insert Collect -->
                <form id="addRequestForm" action="Insert_collect.php" method="post">
                    <input type="hidden" name="User_ID" class="form-control" id="User_ID" value="<?php echo $_SESSION['User_ID']; ?>" readonly>

                    <div class="form-floating mb-3">
                        <?php
                        // For Show Time Now In Input  
                        date_default_timezone_set('Asia/Bangkok'); // ตั้งค่า timezone (เปลี่ยนตามพื้น)

                        // ดึงวันที่และเวลาปัจจุบันในรูปแบบที่เหมาะกับ input[type="datetime-local"]
                        $currentDateTime = date('Y-m-d\TH:i');
                        ?>
                        <input type="datetime-local" class="form-control" name="Collect_Date" value="<?php echo $currentDateTime; ?>" placeholder required>
                        <label for="Collect_Date" class="form-label">วัน เวลา ที่เก็บเกี่ยว</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" name="EggAmount" min="1" placeholder required>
                        <label for="EggAmount" class="form-label">จำนวนไข่ที่เก็บได้ (ฟอง)</label>
                    </div>

                    <button type="submit" class="btn btn-primary md-4">บันทึก</button>
                    <button type="reset" class="btn btn-primary md-4" value="Reset">ล้างข้อมูล</button>
                </form>
                <!-- Form for Insert Collect -->

            </div>
        </div>
    </div>
</div>
<!--End add-->