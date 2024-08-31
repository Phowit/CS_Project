<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-12">
            <div class="bg-light rounded h-100 p-4">

                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button"
                        data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                        aria-expanded="false" aria-controls="collapseTwo">
                        เพิ่มข้อมูลการเก็บไข่ไก่
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                    <div class="accordion-body">

                        <form action="Insert_collect.php" method="post">
                            <div class="form-floating mb-3">
                                <input type="datetime-local" class="form-control" name="Date_Harvest" placeholder required>
                                <label for="Date_Harvest" class="form-label">วัน เวลา ที่เก็บเกี่ยว</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" name="EggAmount" min="1" placeholder required>
                                <label for="EggAmount" class="form-label">จำนวนไข่ที่เก็บได้ (ฟอง)</label>
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

                            <button type="submit" class="btn btn-primary md-4">บันทึก</button>
                            <button type="reset" class="btn btn-primary md-4" value="Reset">ล้างข้อมูล</button>
                            <!--<a href="Admin_Index.php" class="btn btn-primary md-4">ยกเลิก</a>-->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>