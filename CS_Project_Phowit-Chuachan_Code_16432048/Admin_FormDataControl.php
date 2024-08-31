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

                        <form>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="Gene_Name" name="Gene_Name" placeholder required>
                                <label class="form-label">อุณหภูมิเริ่มทำงาน</label>
                            </div>

                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="Description" name="Description" style="height: 150px;" placeholder></textarea>
                                <label for="floatingTextarea">จำนวนรอบให้อาหาร</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="Date" class="form-control" name="Date_in" id="Date_in" placeholder required>
                                <label for="Date_in" class="form-label">เวลาให้น้ำ</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="datetime-local" class="form-control" name="Date_Harvest" placeholder required>
                                <label for="Date_Harvest" class="form-label">วัน เวลา ให้อาหารเสริม</label>
                            </div>

                            <div class="form-floating mb-3">
                                <?php
                                require_once("connect_db.php");

                                $sql = "select * from admin order by Name";
                                $result = mysqli_query($conn, $sql);
                                ?>
                                <div class="form-floating mb-3">
                                    <select class="form-select" name="Name" id="Name" aria-label="Floating label select example" required>
                                        <?php
                                        while ($row = $result->fetch_assoc()) {
                                        ?>
                                            <option value="<?= $row['Name']; ?>">
                                                <?= $row['Name']; ?></option>
                                        <?php   } ?>
                                    </select>
                                    <label for="Name" class="form-label" placeholder>ผู้ดูแลที่บันทึก</label>
                                </div>
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