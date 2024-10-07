<!--Start add-->
<div class="modal fade" id="addRecordModal" tabindex="-1" aria-labelledby="addRecordModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addRecordModalLabel<">เพิ่มชุดคำสั่งควบคุม</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">

                <!-- Form for Editing Record -->
                <form id="addRequestForm" action="Insert_AdminData.php" method="post">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="Admin_ID" placeholder required>
                        <label for="Admin_ID" class="form-label">Admin ID (รหัสประจำตัวผู้ดูแลระบบ)</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="Name" placeholder required>
                        <label for="Name" class="form-label">Name (ชื่อ นามสกุล หรือเพียงชื่อ)</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" name="Password" placeholder required>
                        <label for="Password" class="form-label">Password (รหัสผ่าน)</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="tel" class="form-control" name="Tel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{2}-[0-9]{2}"
                            placeholder="ตัวอย่าง 123-456-78-90" placeholder required>
                        <label for="Tel" class="form-label">Tel (เบอร์โทรติดต่อ)</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="Address" placeholder required>
                        <label for="Address" class="form-label">Address (ที่อยู่ติดต่อ)</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="Email" class="form-control" name="Email" placeholder required>
                        <label for="Email" class="form-label">Email (อีเมลติดต่อ)</label>
                    </div>

                    <div class="form-floating mb-3" name="Program_ID" placeholder required>
                        <!--เลือกสาขา start -->
                        <?php
                            require_once("program.php");
                        ?>
                        <!--เลือกสาขา End-->
                    </div>

                    <button type="submit" class="btn btn-primary" name="insert">บันทึก</button>
                    <button type="reset" class="btn btn-primary" value="Reset">ล้างข้อมูล</button>
                </form>
                <!-- Form for Editing Record -->

            </div>
        </div>
    </div>
</div>
<!--End add-->