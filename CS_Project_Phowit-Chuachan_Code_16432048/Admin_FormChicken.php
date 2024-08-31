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

                        <form action="Insert_Chicken.php" method="post">
                            <div class="form-floating mb-3">
                                <input type="Date" class="form-control" name="Date_in" id="Date_in" placeholder required>
                                <label for="Date_in" class="form-label">วัน เวลา ที่นำเข้ามาเลี้ยง</label>
                            </div>

                            <div class="form-floating mb-3">
                                <?php
                                require_once("connect_db.php");

                                $sql = "select * from gene order by Gene_Name";
                                $result = mysqli_query($conn, $sql);
                                ?>
                                <div class="form-floating mb-3">
                                    <select class="form-select" name="Gene" id="Gene" aria-label="Floating label select example" required>
                                        <?php
                                        while ($row = $result->fetch_assoc()) {
                                        ?>
                                            <option value="<?= $row['Gene_Name']; ?>">
                                                <?= $row['Gene_Name']; ?></option>
                                        <?php   } ?>
                                    </select>
                                    <label for="Gene" class="form-label" placeholder>สายพันธุ์ไก่</label>
                                </div>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" name="Amount" id="Amount" min="1" placeholder required>
                                <label for="Amount" class="form-label">จำนวนไก่ทั้งหมด (ตัว)</label>
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
                                    <label for="Name" class="form-label" placeholder>ชื่อผู้ใช้</label>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">บันทึก</button>
                            <button type="reset" class="btn btn-primary" value="Reset">ล้างข้อมูล</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>