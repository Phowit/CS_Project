<!--Start add New Admin -->
<div class="modal fade" id="addRecordModal" tabindex="-1" aria-labelledby="addRecordModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addRecordModalLabel<">เพิ่มข้อมูลผู้ใช้</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">

                <!-- Start Form for Insert New Admin -->
                <form id="addRequestForm" action="Insert_AdminData.php" method="post" enctype="multipart/form-data"> 
                    <!-- enctype="multipart/form-data" (use for image)-->

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="User_Name" placeholder required>
                        <label for="User_Name" class="form-label">Name (ชื่อ นามสกุล หรือเพียงชื่อ)</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" name="User_Password" placeholder required>
                        <label for="User_Password" class="form-label">Password (รหัสผ่าน)</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="tel" class="form-control" name="User_Tel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{2}-[0-9]{2}"
                            placeholder="ตัวอย่าง 123-456-78-90" placeholder>
                        <label for="User_Tel" class="form-label">Tel (เบอร์โทรติดต่อ) ตัวอย่าง 081-234-56-78</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="User_Address" placeholder required>
                        <label for="User_Address" class="form-label">Address (ที่อยู่ติดต่อ)</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="Email" class="form-control" name="User_Email" placeholder required>
                        <label for="User_Email" class="form-label">Email (อีเมลติดต่อ)</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="Program" placeholder required>
                        <label for="Program" class="form-label">สาขา</label>
                    </div>

                    <label>รูปภาพ</label>
                    <div class="form-floating mb-3">
                        <input type="file" id="User_Image" name="User_Image">
                    </div>
                    
                    <button type="submit" class="btn btn-primary" name="insert">บันทึก</button>
                    <button type="reset" class="btn btn-primary" value="Reset">ล้างข้อมูล</button>
                </form>
                <!-- End Form for Insert New Admin -->

            </div>
        </div>
    </div>
</div>
<!--End add New Admin -->