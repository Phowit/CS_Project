<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-12">
            <div class="bg-light rounded h-100 p-4">
                
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button"
                        data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                        aria-expanded="false" aria-controls="collapseTwo">
                        เพิ่มข้อมูลสายพันธุ์ไก่
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                    <div class="accordion-body">

                        <form action="Insert_GeneChicken.php" method="post">
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
                            <a href="Admin_Index.php" class="btn btn-primary">ยกเลิก</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
