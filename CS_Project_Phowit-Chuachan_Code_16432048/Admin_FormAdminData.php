<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-12">
            <div class="bg-light rounded h-100 p-4">

                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button"
                        data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                        aria-expanded="false" aria-controls="collapseTwo">
                        เพิ่มชุดคำสั่งควบคุม
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                    <div class="accordion-body">

                        <form action="Insert_AdminData.php" method="post">
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
                            <a href="Admin_Index.php" class="btn btn-primary">ยกเลิก</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>