<div class="container-fluid pt-4 px-4 rounded bg-primary">
    <div class="text-center">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6>ข้อมูลการนำเข้าไก่ไข่ของคุณ</h6>

            <div class="col-3">
                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#addRecordModal">เพิ่มข้อมูล</button>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editImportModal<?= $Import_ID; ?>">แก้ไข</button>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" onclick="SetID(<?= $Import_ID; ?>)" data-bs-target="#confirmDeleteModal">ลบ</button>
            </div>

            <!-- เริ่ม ฟอร์มเพิ่มข้อมูลนำเข้าไก่ไข่ -->
            <?php 
                require_once("Admin_FormChicken.php")
            ?>
            <!-- จบ ฟอร์มเพิ่มข้อมูลนำเข้าไก่ไข่ -->

        </div>
        <div class="table-responsive">
            <?php
            require_once("connect_db.php");
            $sql = "select 
                    `Import_ID`,
                    `Import_Date_Record`,
                    `Import_Date`,
                    `Import_Amount`,
                    `Import_Details`,
                    import.`Breed_ID`,
                    import.`User_ID`,
                    user.User_Name,
                    breed.Breed_Name
                    FROM import
                    INNER JOIN user ON import.User_ID = user.User_ID
                    INNER JOIN breed ON import.Breed_ID = breed.Breed_ID
                    WHERE import.User_ID = ?;
                    ";
                    

            $stmt = $conn->prepare($sql); // เตรียมคำสั่ง SQL เพื่อป้องกัน SQL Injection
            $stmt->bind_param("i", $_SESSION['User_ID']); // ผูกค่าพารามิเตอร์
            $stmt->execute(); // รันคำสั่ง
            $result = $stmt->get_result(); // รับผลลัพธ์จากฐานข้อมูล
            ?>

            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-dark">
                        <th scope="col" class="col-0.5">รหัส</th>
                        <th scope="col" class="col-2">ผู้บันทึก</th>
                        <th scope="col" class="col-2">เวลาที่บันทึก</th>
                        <th scope="col" class="col-2">เวลาที่นำเข้า</th>
                        <th scope="col" class="col-2">สายพันธุ์</th>
                        <th scope="col" class="col-0.5">จำนวน</th>
                        <th scope="col" class="col-3">รายละเอียด</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = $result->fetch_assoc()) {
                        $Import_ID = $row['Import_ID'];
                        $User_Name = $row['User_Name'];
                        $Import_Date_Record = date_create_from_format(format: "Y-m-d H:i:s", datetime: $row["Import_Date_Record"]) ->format(format: "d/m/Y H:i");
                        $Import_Date = date_create_from_format(format: "Y-m-d H:i:s", datetime: $row["Import_Date"]) ->format(format: "d/m/Y H:i");
                        $Breed_Name = $row['Breed_Name'];
                        $Import_Amount = $row['Import_Amount'];
                        $Import_Details = $row['Import_Details'];
                    ?>
                        <tr>
                            <td><?php echo $Import_ID; ?></td>
                            <td><?php echo $User_Name; ?></td>
                            <td><?php echo $Import_Date_Record; ?></td>
                            <td><?php echo $Import_Date; ?></td>
                            <td><?php echo $Breed_Name; ?></td>
                            <td><?php echo $Import_Amount; ?> ตัว</td>
                            <td><?php echo $Import_Details; ?></td>

                            <!--แก้ไข-->

                            <!--Start Edit-->
                            <div class="modal fade" id="editImportModal<?= $Import_ID; ?>" tabindex="-1" aria-labelledby="editImportModalLabel<?= $Import_ID; ?>" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editImportModalLabel<?= $Import_ID; ?>">แก้ไขข้อมูล</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Form for Editing Import -->
                                            <form id="addRequestForm" action="Update_ChickenData.php" method="post">

                                                <!-- Add your form fields here for additional request details -->

                                                <input type="hidden" name="Set_ID" class="form-control" id="Set_ID" value="<?php echo $Import_ID; ?>" readonly>

                                                <div class="form-floating mb-3">
                                                    <input type="Date" class="form-control" name="Date_in" id="Date_in" placeholder required>
                                                    <label for="Date_in" class="form-label">วัน เวลา ที่นำเข้ามาเลี้ยง</label>
                                                </div>

                                                <div class="form-floating mb-3">
                                                </div>

                                                <div class="row">
                                                    <div class="col-12" style="margin-top: 20px;">
                                                        <button type="button" class="btn btn-secondary float-end" data-bs-dismiss="modal" style="margin-top: 20px;">ยกเลิก</button>
                                                        <button type="submit" class="btn btn-primary float-end" style="margin-top: 20px; margin-right:10px">บันทึก</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--End Edit-->

                            <!--Start Waring For Delete-->
                            <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h5 class="modal-title" id="confirmDeleteModalLabel">ยืนยันการลบข้อมูล</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <div class="modal-body">
                                            <p>ต้องการจะลบข้อมูลนี้หรือไม่ ?</p>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                                            <button type="button" class="btn btn-danger" onclick="deleteImportData()">ยืนยัน</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!--END Warning For Delete-->
                        </tr>
                    <?php } ?> <!-- close php-->
                </tbody>
            </table>
        </div>
    </div><br>
</div><br>

<div class="container-fluid pt-4 px-4 rounded bg-primary">
    <div class="text-center">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6>ข้อมูลการนำเข้าไก่ไข่ทั้งหมด</h6>
        </div>
        <div class="table-responsive">
            <?php
            require_once("connect_db.php");
            $sqli = "select 
                    `Import_ID`,
                    `Import_Date_Record`,
                    `Import_Date`,
                    `Import_Amount`,
                    `Import_Details`,
                    import.`Breed_ID`,
                    import.`User_ID`,
                    user.User_Name,
                    breed.Breed_Name
                    FROM import
                    INNER JOIN user ON import.User_ID = user.User_ID
                    INNER JOIN breed ON import.Breed_ID = breed.Breed_ID
                    WHERE import.User_ID != ?;
                    ";
                    

            $stmt = $conn->prepare($sqli); // เตรียมคำสั่ง SQL เพื่อป้องกัน SQL Injection
            $stmt->bind_param("i", $_SESSION['User_ID']); // ผูกค่าพารามิเตอร์
            $stmt->execute(); // รันคำสั่ง
            $result1 = $stmt->get_result(); // รับผลลัพธ์จากฐานข้อมูล
            ?>

            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-dark">
                        <th scope="col" class="col-0.5">รหัส</th>
                        <th scope="col" class="col-2">ผู้บันทึก</th>
                        <th scope="col" class="col-2">เวลาที่บันทึก</th>
                        <th scope="col" class="col-2">เวลาที่นำเข้า</th>
                        <th scope="col" class="col-2">สายพันธุ์</th>
                        <th scope="col" class="col-0.5">จำนวน</th>
                        <th scope="col" class="col-3">รายละเอียด</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = $result1->fetch_assoc()) {
                        $Import_ID = $row['Import_ID'];
                        $User_Name = $row['User_Name'];
                        $Import_Date_Record = date_create_from_format(format: "Y-m-d H:i:s", datetime: $row["Import_Date_Record"]) ->format(format: "d/m/Y H:i");
                        $Import_Date = date_create_from_format(format: "Y-m-d H:i:s", datetime: $row["Import_Date"]) ->format(format: "d/m/Y H:i");
                        $Breed_Name = $row['Breed_Name'];
                        $Import_Amount = $row['Import_Amount'];
                        $Import_Details = $row['Import_Details'];
                    ?>
                        <tr>
                            <td><?php echo $Import_ID; ?></td>
                            <td><?php echo $User_Name; ?></td>
                            <td><?php echo $Import_Date_Record; ?></td>
                            <td><?php echo $Import_Date; ?></td>
                            <td><?php echo $Breed_Name; ?></td>
                            <td><?php echo $Import_Amount; ?> ตัว</td>
                            <td><?php echo $Import_Details; ?></td>

                            <!--แก้ไข-->

                            <!--Start Edit-->
                            <div class="modal fade" id="editImportModal<?= $Import_ID; ?>" tabindex="-1" aria-labelledby="editImportModalLabel<?= $Import_ID; ?>" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editImportModalLabel<?= $Import_ID; ?>">แก้ไขข้อมูล</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Form for Editing Import -->
                                            <form id="addRequestForm" action="Update_ChickenData.php" method="post">

                                                <!-- Add your form fields here for additional request details -->

                                                <input type="hidden" name="Set_ID" class="form-control" id="Set_ID" value="<?php echo $Import_ID; ?>" readonly>

                                                <div class="form-floating mb-3">
                                                    <input type="Date" class="form-control" name="Date_in" id="Date_in" placeholder required>
                                                    <label for="Date_in" class="form-label">วัน เวลา ที่นำเข้ามาเลี้ยง</label>
                                                </div>

                                                <div class="form-floating mb-3">
                                                </div>

                                                <div class="row">
                                                    <div class="col-12" style="margin-top: 20px;">
                                                        <button type="button" class="btn btn-secondary float-end" data-bs-dismiss="modal" style="margin-top: 20px;">ยกเลิก</button>
                                                        <button type="submit" class="btn btn-primary float-end" style="margin-top: 20px; margin-right:10px">บันทึก</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--End Edit-->

                            <!--Start Waring For Delete-->
                            <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h5 class="modal-title" id="confirmDeleteModalLabel">ยืนยันการลบข้อมูล</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <div class="modal-body">
                                            <p>ต้องการจะลบข้อมูลนี้หรือไม่ ?</p>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                                            <button type="button" class="btn btn-danger" onclick="deleteImportData()">ยืนยัน</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!--END Warning For Delete-->
                        </tr>
                    <?php } ?> <!-- close php-->
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    var btn = document.getElementById("myBtn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("btn-close")[0];

    // When the user clicks on the button, open the modal
    btn.onclick = function() {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>

<script>
    var ImportID;

    // ฟังก์ชันเพื่อรับค่า member_ID เมื่อคลิกที่ปุ่ม "ลบ"
    function ImportID(Import_ID) {
        ImportID = Import_ID;
    }

    function deleteImportData() {

        // ถ้ายืนยันการลบ ทำการ redirect ไปยังไฟล์ planting_delete.php พร้อมส่งค่า id ของแถวที่ต้องการลบ
        window.location.href = "Delete_ChickenData.php?id=" + ImportID;

    }
</script>