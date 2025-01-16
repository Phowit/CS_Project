<!--Start add-->
<div class="modal fade" id="addRecordModal" tabindex="-1" aria-labelledby="addRecordModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addRecordModalLabel<">เพิ่มข้อมูลการเก็บไข่ไก่</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <!-- Form for Editing Record -->

                <form id="addRequestForm" action="Insert_collect.php" method="post">

                    <div class="form-floating mb-3">
                        <input type="datetime-local" class="form-control" name="Collect_Date" placeholder required>
                        <label for="Collect_Date" class="form-label">วัน เวลา ที่เก็บเกี่ยว</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" name="EggAmount" min="1" placeholder required>
                        <label for="EggAmount" class="form-label">จำนวนไข่ที่เก็บได้ (ฟอง)</label>
                    </div>

                    <button type="submit" class="btn btn-primary md-4">บันทึก</button>
                    <button type="reset" class="btn btn-primary md-4" value="Reset">ล้างข้อมูล</button>
                </form>

            </div>
        </div>
    </div>
</div>
<!--End add-->