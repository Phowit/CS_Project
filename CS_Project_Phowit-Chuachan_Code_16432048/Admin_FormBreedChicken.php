<!--Start add -->
<div class="modal fade" id="addRecordModal" tabindex="-1" aria-labelledby="addRecordModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addRecordModalLabel<">เพิ่มข้อมูลสายพันธุ์ไก่</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> <!-- closed button-->
            </div>
            <div class="modal-body">

                <!--Start Form for Insert New Breed-->
                <form id="addRequestForm" action="Insert_BreedChicken.php" method="post" enctype="multipart/form-data">

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="Breed_Name" name="Breed_Name" placeholder required>
                        <label class="form-label">ชื่อสายพันธุ์ไก่</label>
                    </div>

                    <div class="form-floating mb-3">
                        <textarea class="form-control" id="Breed_Description" name="Breed_Description" style="height: 150px;" placeholder></textarea>
                        <label for="floatingTextarea">คำอธิบายสายพันธุ์ไก่</label>
                    </div>

                    <label>ภาพสายพันธุ์ไก่ไข่ตัวอย่าง</label>
                    <div class="form-floating mb-3">
                        <input type="file" id="Breed_Img" name="Breed_Img" value="<?php $Breed_Img; ?>">
                    </div>

                    <button type="submit" class="btn btn-primary me-4">บันทึก</button>
                    <button type="reset" class="btn btn-primary me-4" value="Reset">ล้างข้อมูล</button>
                </form>
                <!--Start Form for Insert New Breed-->
                
            </div>
        </div>
    </div>
</div>
<!--End add-->