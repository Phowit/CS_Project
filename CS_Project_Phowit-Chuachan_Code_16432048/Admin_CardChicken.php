    <div style="display: flex; justify-content: center; margin-bottom: 10px;">
        <button type="button" class="btn btn-warning" data-bs-toggle="modal"
            data-bs-target="#addRecordModal" style="height: 40px; width: 100px;
            align-items: center;">เพิ่มข้อมูล
        </button>

        <!-- เริ่ม ฟอร์มเพิ่มข้อมูลนำเข้าไก่ไข่ -->
        <?php
        require_once("Admin_FormImport.php")
        ?>
        <!-- จบ ฟอร์มเพิ่มข้อมูลนำเข้าไก่ไข่ -->
    </div>

    <?php
    require_once("connect_db.php");
    $sql = "select 
            import.`Import_ID`,
            import.`Import_Date_Record`,
            import.`Import_Date`,
            import.`Import_Amount`,
            import.`Import_Details`,

            import.`User_ID`,
            user.`User_Name`,

            import.`Breed_ID`,
            breed.`Breed_Name`
            FROM import

            INNER JOIN user ON import.`User_ID` = user.`User_ID`
            INNER JOIN breed ON import.`Breed_ID` = breed.`Breed_ID`

            WHERE import.`User_ID` = ?;
                ";


    $stmt = $conn->prepare($sql); // เตรียมคำสั่ง SQL เพื่อป้องกัน SQL Injection
    $stmt->bind_param("i", $_SESSION['User_ID']); // ผูกค่าพารามิเตอร์
    $stmt->execute(); // รันคำสั่ง
    $result = $stmt->get_result(); // รับผลลัพธ์จากฐานข้อมูล

    while ($row = $result->fetch_assoc()) {
        $Import_ID = $row['Import_ID'];
        $Import_Date_Record = date_create_from_format(format: "Y-m-d H:i:s", datetime: $row["Import_Date_Record"])->format(format: "d/m/Y H:i");
        $Import_Date = date_create_from_format(format: "Y-m-d H:i:s", datetime: $row["Import_Date"])->format(format: "d/m/Y H:i");
        $Import_Amount = $row['Import_Amount'];
        $Import_Details = $row['Import_Details'];

        $User_Name = $row['User_Name']; // ดึงโดย User_ID

        $Breed_Name = $row['Breed_Name']; // ดึงโดย Breed_ID
    ?>
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h3 class="accordion-header" id="headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $Import_ID; ?>"
                        aria-expanded="false">

                        <div class="col-sm-12 col-xl-3">
                            <h6>รหัสการนำเข้า : <?php echo $Import_ID; ?></h6>
                        </div>

                        <div class="col-sm-12 col-xl-5">
                            <h6>สายพันธุ์ : <?php echo $Breed_Name; ?></h6>
                        </div>

                        <div class="col-sm-12 col-xl-4">
                            <h6>วันที่นำเข้า : <?php echo $Import_Date; ?></h6>
                        </div>


                    </button>
                </h3>

                <div id="collapse<?php echo $Import_ID; ?>" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">

                        <div class="row">
                            <div class="col-sm-12 col-xl-4">
                                <a>รายละเอียด : <?php echo $Import_Details; ?></a>
                            </div>

                            <div class="col-sm-12 col-xl-2">
                                <a>จำนวน : <?php echo $Import_Amount; ?> ตัว</a>
                            </div>

                            <div class="col-sm-12 col-xl-4">
                                <a>วันที่บันทึก : <?php echo $Import_Date_Record; ?></a>
                            </div>

                            <div class="col-sm-12 col-xl-2">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#EditImportModal<?= $Import_ID; ?>" style="height:auto; width: 50%;">แก้ไข</button>

                                <!--Start Edit-->
                                <div class="modal fade" id="EditImportModal<?= $Import_ID; ?>" tabindex="-1" aria-labelledby="EditImportModalLabel<?= $Import_ID; ?>" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="EditImportModalLabel<?= $Import_ID; ?>">แก้ไขข้อมูล</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Form for Editing Import ทดสอบ การแก้ไขข้อมูลการนำเข้าไก่ไข่ครั้งที่ 1 -->
                                                <form id="addRequestForm" action="Update_Import.php" method="post">
                                                    <input type="hidden" class="form-control" name="Import_ID" id="Import_ID" value="<?php echo $Import_ID; ?>" readonly>

                                                    <div class="form-floating mb-3">
                                                        <input type="DateTime-local" class="form-control" name="Import_Date" id="Import_Date" value="<?php echo $Import_Date; ?>" placeholder required>
                                                        <label for="Import_Date" class="form-label">วัน เวลา ที่นำเข้ามาเลี้ยง</label>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-8">
                                                            <div class="form-floating">
                                                                <select class="form-select" name="Breed_ID" id="Breed_ID" aria-label="Floating label select example" required>
                                                                    <?php
                                                                    require_once("connect_db.php");
                                                                    $sql0 = "select * from breed";
                                                                    $result0 = mysqli_query($conn, $sql0);

                                                                    while ($row = $result0->fetch_assoc()) {
                                                                    ?>
                                                                        <option value="<?= $row['Breed_ID']; ?>">
                                                                            <?= $row['Breed_Name']; ?></option>
                                                                    <?php   } ?>
                                                                </select>
                                                                <label for="Breed_ID" class="form-label" placeholder>สายพันธุ์ไก่</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-4">
                                                            <div class="form-floating">
                                                                <input type="number" class="form-control" name="Import_Amount" id="Import_Amount" min="1" value="<?php echo $Import_Amount; ?>" placeholder required>
                                                                <label for="Import_Amount" class="form-label">จำนวนไก่ทั้งหมด (ตัว)</label>
                                                            </div>
                                                        </div>
                                                    </div><br>

                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" name="Import_Details" id="Import_Details" style="height: 100px;" value="<?php echo $Import_Details; ?>" placeholder required>
                                                        <label for="floatingTextarea">รายละเอียด</label>
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

                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" onclick="UserID(<?= $User_ID; ?>)" data-bs-target="#confirmDeleteModal" style="height:auto; width: 45%;">ลบ</button>

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
                            </div>
                        </div>

                        <?php
                        require_once("connect_db.php");
                        $sql1 = "SELECT * FROM `export` WHERE `Import_ID` = ?;";

                        $stmt = $conn->prepare($sql1); // เตรียมคำสั่ง SQL เพื่อป้องกัน SQL Injection
                        $stmt->bind_param("i", $Import_ID); // ผูกค่าพารามิเตอร์
                        $stmt->execute(); // รันคำสั่ง
                        $result1 = $stmt->get_result(); // รับผลลัพธ์จากฐานข้อมูล

                        if (mysqli_num_rows($result1) == 0) {

                            echo "<h6 style='text-align: center;'>ไม่พบข้อมูลการส่งออก</h6>";
                        } else {
                        ?>
                            <table class="table text-start align-middle table-bordered table-hover mb-0">
                                <thead>
                                    <tr class="text-dark">
                                        <th scope="col" class="col-0.5">รหัส</th>
                                        <th scope="col" class="col-2.5">วัน เวลา <br> ที่บันทึก</th>
                                        <th scope="col" class="col-2.5">วัน เวลา <br> ที่นำออก</th>
                                        <th scope="col" class="col-2">จำนวน</th>
                                        <th scope="col" class="col-4">รายละเอียด</th>
                                        <th scope="col" class="col-0.5">เครื่องมือ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($row = $result1->fetch_assoc()) {
                                        $Export_ID = $row['Export_ID'];
                                        $Export_Date_Record = date_create_from_format(format: "Y-m-d H:i:s", datetime: $row["Export_Date_Record"])->format(format: "d/m/Y H:i");
                                        $Export_Date = date_create_from_format(format: "Y-m-d H:i:s", datetime: $row["Export_Date"])->format(format: "d/m/Y H:i");
                                        $Export_Amount = $row['Export_Amount'];
                                        $Export_Details = $row['Export_Details'];
                                    ?>
                                        <tr>
                                            <td><?php echo $Export_ID; ?></td>
                                            <td><?php echo $Export_Date_Record; ?></td>
                                            <td><?php echo $Export_Date; ?></td>
                                            <td><?php echo $Export_Amount; ?> ตัว</td>
                                            <td><?php echo $Export_Details; ?></td>

                                            <td>
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#editExportModal<?= $Export_ID; ?>" style="height: 35px; width: 100%;">แก้ไข
                                                </button>

                                                <!--Start Edit-->
                                                <div class="modal fade" id="editExportModal<?= $Export_ID; ?>" tabindex="-1" aria-labelledby="editExportModalLabel<?= $Export_ID; ?>" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="editExportModalLabel<?= $Export_ID; ?>">แก้ไขข้อมูล</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <!-- Form for Editing Import ทดสอบ การแก้ไขข้อมูลการนำเข้าไก่ไข่ครั้งที่ 1 -->
                                                                <form id="addRequestForm" action="Update_Export.php" method="post">
                                                                    <input type="hidden" class="form-control" name="Export_ID" id="Export_ID" value="<?php echo $Export_ID; ?>" readonly>

                                                                    <div class="row">
                                                                        <div class="col-8">
                                                                            <div class="form-floating">
                                                                                <input type="DateTime-local" class="form-control" name="Export_Date" id="Export_Date" value="<?php echo $Export_Date; ?>" placeholder required>
                                                                                <label for="Export_Date" class="form-label">วัน เวลา ที่นำออก</label>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-4">
                                                                            <div class="form-floating">
                                                                                <input type="number" class="form-control" name="Export_Amount" id="Export_Amount" min="1" max="<?php echo $Import_Amount; ?>" value="<?php echo $Export_Amount; ?>" placeholder required>
                                                                                <label for="Export_Amount" class="form-label">จำนวนไก่ทั้งหมด (สูงสุด <?php echo $Import_Amount; ?> ตัว)</label>
                                                                            </div>
                                                                        </div>
                                                                    </div><br>

                                                                    <div class="form-floating">
                                                                        <input type="text" class="form-control" name="Export_Details" id="Export_Details" style="height: 100px;" value="<?php echo $Export_Details; ?>" placeholder required>
                                                                        <label for="floatingTextarea">รายละเอียด</label>
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

                                                <br>

                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" onclick="ImportID(<?= $Import_ID; ?>)"
                                                    data-bs-target="#confirmDeleteModal" style="height: 35px; width: 100%;  margin-top: 5px;">ลบ
                                                </button>
                                            </td>

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
                                <?php }
                                } ?> <!-- close php-->
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div><br>
    <?php } ?> <!-- close php-->


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
        var UserID;

        // ฟังก์ชันเพื่อรับค่า member_ID เมื่อคลิกที่ปุ่ม "ลบ"
        function UserID(User_ID) {
            UserID = User_ID;
        }

        function deleteAdmin() {

            // ถ้ายืนยันการลบ ทำการ redirect ไปยังไฟล์ planting_delete.php พร้อมส่งค่า id ของแถวที่ต้องการลบ
            window.location.href = "Delete_AdminData.php?id=" + UserID;

        }
    </script>