<div class="container-fluid pt-4 px-4">
    <div class="h-100 bg-light rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">ข้อมูลชุดคำสั่งควบคุม</h6>

            <!--เพิ่ม-->
            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#addRecordModal">เพิ่มข้อมูล</button>

            <!--Start add-->
            <div class="modal fade" id="addRecordModal" tabindex="-1" aria-labelledby="addRecordModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addRecordModalLabel<">เพิ่มชุดคำสั่งควบคุม</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Form for Editing Record -->
                            <form id="addRequestForm" action="Insert_GeneChicken.php" method="post">
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

                                    $sql = "select * from admin order by Admin_Name";
                                    $result = mysqli_query($conn, $sql);
                                    ?>
                                    <div class="form-floating mb-3">
                                        <select class="form-select" name="Admin_Name" id="Admin_Name" aria-label="Floating label select example" required>
                                            <?php
                                            while ($row = $result->fetch_assoc()) {
                                            ?>
                                                <option value="<?= $row['Admin_Name']; ?>">
                                                    <?= $row['Admin_Name']; ?></option>
                                            <?php   } ?>
                                        </select>
                                        <label for="Admin_Name" class="form-label" placeholder>ผู้ดูแลที่บันทึก</label>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary me-4">บันทึก</button>
                                <button type="reset" class="btn btn-primary me-4" value="Reset">ล้างข้อมูล</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--End add-->
        </div>
        <div class="table-responsive">
            <?php
            require_once("connect_db.php");
            $sql = "select 
                        datacontrol.`DateControl_ID`,
                        datacontrol.`Temperature_range`,
                        datacontrol.`TimeFoodS`,
                        datacontrol.`TimeWater`,
                        datacontrol.`FoodTray_rang`,
                        datacontrol.`TimeFood_1`,
                        datacontrol.`TimeFood_2`,
                        datacontrol.`TimeFood_3`,
                        datacontrol.`Admin_ID`,
                        admin.Admin_Name
                    FROM datacontrol 
                    INNER JOIN admin ON datacontrol.Admin_ID = admin.Admin_ID;";
            $result = mysqli_query($conn, $sql);
            ?>
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-dark">
                        <th scope="col" class="col-1" style="font-size: 14px;">รหัสชุดควบคุม</th>
                        <th scope="col" class="col-1" style="font-size: 14px;">อุณหภูมิไม่เกิน</th>
                        <th scope="col" class="col-1.5" style="font-size: 14px;">เวลาให้อาหาร<br>(รอบที่1)</th>
                        <th scope="col" class="col-1.5" style="font-size: 14px;">เวลาให้อาหาร<br>(รอบที่2)</th>
                        <th scope="col" class="col-1.5" style="font-size: 14px;">เวลาให้น้ำ</th>
                        <th scope="col" class="col-1.5" style="font-size: 14px;">เวลาให้อาหารเสริม</th>
                        <th scope="col" class="col-2" style="font-size: 14px;">ระดับอาหารในถาด<br>ที่ต้องแจ้งเตือน(%)</th>
                        <th scope="col" class="col-2" style="font-size: 14px;">ผู้ดูแลที่บันทึก</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    while ($row = $result->fetch_assoc()) {
                        $DateControl_ID = $row['DateControl_ID'];
                        $Temperature_range = $row['Temperature_range'];
                        $TimeFoodS = $row['TimeFoodS'];
                        $FoodTray_rang = $row['FoodTray_rang'];
                        $TimeFood_1 = $row['TimeFood_1'];
                        $TimeFood_2 = $row['TimeFood_2'];
                        $TimeWater = $row['TimeWater'];
                        $Admin_Name = $row['Admin_Name'];
                    ?>
                        <tr>
                            <td style="font-size: 13px;"><?php echo $row['DateControl_ID']; ?></td>
                            <td style="font-size: 13px;"><?php echo $row['Temperature_range']; ?></td>
                            <td style="font-size: 13px;"><?php echo $row['TimeFood_1']; ?></td>
                            <td style="font-size: 13px;"><?php echo $row['TimeFood_2']; ?></td>
                            <td style="font-size: 13px;"><?php echo $row['TimeWater']; ?></td>
                            <td style="font-size: 13px;"><?php echo $row['TimeFoodS']; ?></td>
                            <td style="font-size: 13px;"><?php echo $row['FoodTray_rang']; ?>%</td>
                            <td style="font-size: 13px;"><?php echo $row['Admin_Name']; ?></td>
                        </tr>
                    <?php } ?> <!-- close php-->
                </tbody>
            </table>
        </div>
    </div>
</div>