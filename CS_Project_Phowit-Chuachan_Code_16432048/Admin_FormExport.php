<!--Start add-->
<div class="modal fade" id="addExportModal" tabindex="-1" aria-labelledby="addExportModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addExportModalLabel<">เพิ่มข้อมูลการส่งออกไก่ไข่</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">

                <!--Start Form for Insert Export-->
                <form id="addRequestForm" action="Insert_Export.php" method="post">
                    <input type="hidden" class="form-control" name="Export_ID" id="Export_ID" value="<?php echo $Export_ID ?>" readonly>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-floating mb-3">
                                <select class="form-select" name="Breed_ID" id="Breed_ID" aria-label="Floating label select example" required>
                                    <?php
                                    require_once("connect_db.php");
                                    $sql = "    WITH Ranked AS (
                                                    SELECT
                                                        r.*,
                                                        i.Breed_ID,
                                                        ROW_NUMBER() OVER (PARTITION BY i.Breed_ID ORDER BY r.Remain_ID DESC) AS rn
                                                    FROM remain r
                                                    INNER JOIN import i ON r.import_ID = i.import_ID
                                                )
                                                SELECT
                                                    Ranked.*,
                                                    b.Breed_Name
                                                FROM Ranked
                                                INNER JOIN breed AS b ON b.Breed_ID = Ranked.Breed_ID
                                                WHERE Ranked.rn = 1 AND Remain_Amount != 0
                                            ";
                                    //เลือกเฉพาะสายพันธุ์ที่มีการนำเข้าเท่านั้น และให้ไม่ซ้ำกัน
                                    // remain จะเป็นจำนวนล่าสุดเสมอ ไม่ต้องห่วงว่า import จะเป็นเท่าไร 
                                    // เพราะ import_ID เป็นแค่ตัวบอกว่าล่าสุดคือตัวไหน 

                                    $result = mysqli_query($conn, $sql);

                                    while ($row = $result->fetch_assoc()) {
                                        $Breed_ID = $row['Breed_ID'];
                                        $Breed_Name = $row['Breed_Name'];
                                        $Remain_Amount = $row['Remain_Amount'];
                                    ?>

                                        <option value="<?= $row['Breed_ID']; ?>">
                                            <?= $Breed_Name; ?> มีจำนวน <?= $Remain_Amount; ?> ตัว
                                        </option>
                                    <?php   } ?>
                                </select>
                                <label for="Breed_ID" class="form-label" placeholder> เลือกสายพันธุ์ไก่ไข่</label>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-floating mb-3">
                                <?php
                                // For Show Time Now In Input                        
                                date_default_timezone_set('Asia/Bangkok'); // ตั้งค่า timezone (เปลี่ยนตามพื้น)

                                // ดึงวันที่และเวลาปัจจุบันในรูปแบบที่เหมาะกับ input[type="datetime-local"]
                                $currentDateTime = date('Y-m-d\TH:i');
                                ?>
                                <input type="DateTime-local" class="form-control" name="Export_Date" id="Export_Date" value="<?php echo $currentDateTime; ?>" placeholder required>
                                <label for="Export_Date" class="form-label">วัน เวลา ที่ส่งออก</label>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-floating">
                                <input type="number" class="form-control" name="Export_Amount" id="Export_Amount" min="1" placeholder required>
                                <label for="Export_Amount" class="form-label">จำนวนไก่ทั้งหมด (ตัว) โปรดระบุข้อมูลจริง</label>
                            </div>
                        </div>
                    </div><br>

                    <div class="form-floating mb-3">
                        <textarea class="form-control" id="Export_Details" name="Export_Details" style="height: 150px;" placeholder></textarea>
                        <label for="floatingTextarea">รายละเอียด</label>
                    </div>

                    <button type="submit" class="btn btn-primary">บันทึก</button>
                    <button type="reset" class="btn btn-primary" value="Reset">ล้างข้อมูล</button>
                </form>
                <!--End Form for Insert Export-->

            </div>
        </div>
    </div>
</div>
<!--End add-->