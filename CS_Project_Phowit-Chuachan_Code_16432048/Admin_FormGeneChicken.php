    <!--Start add-->
    <div class="modal fade" id="addRecordModal" tabindex="-1" aria-labelledby="addRecordModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addRecordModalLabel<">เพิ่มข้อมูลสายพันธุ์ไก่</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Form for Editing Record -->
                            <form id="addRequestForm" action="Insert_GeneChicken.php" method="post">
                                <!-- Add your form fields here for additional request details -->

                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="Gene_Name" name="Gene_Name" placeholder required>
                                    <label class="form-label">ชื่อสายพันธุ์ไก่</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <textarea class="form-control" id="Description" name="Description" style="height: 150px;" placeholder></textarea>
                                    <label for="floatingTextarea">คำอธิบายสายพันธุ์ไก่</label>
                                </div>

                                <button type="submit" class="btn btn-primary me-4">บันทึก</button>
                                <button type="reset" class="btn btn-primary me-4" value="Reset">ล้างข้อมูล</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--End add-->