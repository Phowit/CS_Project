    <!--Start add-->
    <div class="modal fade" id="addRecordModal" tabindex="-1" aria-labelledby="addRecordModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addRecordModalLabel<">การส่งข้อความ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form for Editing Record -->
                    <form id="addRequestForm" action="Insert_UserForm.php" method="post" enctype="multipart/form-data">
                        <!-- Add your form fields here for additional request details -->

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="Title" name="Title" placeholder required>
                            <label class="form-label">เรื่อง</label>
                        </div>

                        <div class="form-floating mb-3">
                            <textarea class="form-control" id="Detail" name="Detail" style="height: 150px;" placeholder></textarea>
                            <label for="floatingTextarea">รายละเอียด</label>
                        </div>

                        <button type="submit" class="btn btn-primary me-4">บันทึก</button>
                        <button type="reset" class="btn btn-primary me-4" value="Reset">ล้างข้อมูล</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--End add-->