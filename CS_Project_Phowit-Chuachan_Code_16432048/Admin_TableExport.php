<div class="container-fluid pt-4 px-4 rounded bg-primary">
    <div class="text-center h-100 bg-light rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6>ข้อมูลการนำไก่ออก</h6>

            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                data-bs-target="#addRecordModal" style="height: 35px; width: 95px;">เพิ่มข้อมูล
            </button>

            <!-- เริ่ม ฟอร์มเพิ่มข้อมูลนำเข้าไก่ไข่ -->
            <?php
                require_once("Admin_FormExport.php")
            ?>
            <!-- จบ ฟอร์มเพิ่มข้อมูลนำเข้าไก่ไข่ -->
        </div>

        <div class="table-responsive">
            <?php
            require_once("connect_db.php");
            $sql = "select 
                    `Export_ID`,
                    `Export_Date_Record`,
                    `Export_Date`,
                    `Export_Amount`,
                    `Export_Details`,
                    import.`Import_Amount`,
                    breed.Breed_Name
                    FROM export
                    INNER JOIN import ON import.Import_ID = export.Import_ID
                    INNER JOIN breed ON import.Breed_ID = breed.Breed_ID;
                    ";

            $result = mysqli_query($conn, $sql);
            ?>

            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-dark" style="font-size:14px">
                        <th scope="col" class="col-0.5">รหัส</th>
                        <th scope="col" class="col-2">วัน เวลา ที่บันทึก</th>
                        <th scope="col" class="col-2">วัน เวลา ที่นำออก</th>
                        <th scope="col" class="col-2">สายพันธุ์</th>
                        <th scope="col" class="col-0.5">จำนวน</th>
                        <th scope="col" class="col-4">รายละเอียด</th>
                        <th scope="col" class="col-1">เครื่องมือ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = $result->fetch_assoc()) {
                        $Export_ID = $row['Export_ID'];
                        $Export_Date_Record = date_create_from_format(format: "Y-m-d H:i:s", datetime: $row["Export_Date_Record"])->format(format: "d/m/Y H:i");
                        $Export_Date = date_create_from_format(format: "Y-m-d H:i:s", datetime: $row["Export_Date"])->format(format: "d/m/Y H:i");
                        $Breed_Name = $row['Breed_Name'];
                        $Export_Amount = $row['Export_Amount'];
                        $Export_Details = $row['Export_Details'];
                        $Import_Amount = $row['Import_Amount'];
                    ?>
                        <tr style="font-size:12px">
                            <td><?php echo $Export_ID; ?></td>
                            <td><?php echo $Export_Date_Record; ?></td>
                            <td><?php echo $Export_Date; ?></td>
                            <td><?php echo $Breed_Name; ?></td>
                            <td><?php echo $Export_Amount; ?> ตัว</td>
                            <td><?php echo $Export_Details; ?></td>


                            <td>
                                <button type="button" class="btn" data-bs-toggle="modal" style="height:30px; width:46%; padding: 1px;"
                                        data-bs-target="#editExportModal<?= $Export_ID; ?>">
                                        <i class='far fa-edit' style='color:blue; font-size:16px;'></i>
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
                                                                <label for="Export_Amount" class="form-label">จำนวนไก่ทั้งหมด (ตัว)</label>
                                                            </div>
                                                        </div>
                                                    </div><br>

                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" name="Export_Details" id="Export_Details" style="height: 100px;" value="<?php echo $Export_Details; ?>" placeholder required>
                                                        <label for="floatingTextarea">รายละเอียด</label>
                                                    </div>

                                                    <div class="col-12">
                                                        <a>นำเข้าจำนวน <?php echo $Import_Amount; ?> ตัว</a>
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

                                <button class="btn" data-bs-toggle="modal" onclick="ImportID(<?= $Import_ID; ?>)"
                                        data-bs-target="#confirmDeleteModal" style="height:30px; width:46%; padding: 5px;">
                                        <i class='material-icons' style='color:red; font-size:20px;'>delete</i>
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
                    <?php } ?> <!-- close php-->
                </tbody>
            </table>
        </div>
    </div><br>
</div><br>

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
        window.location.href = "Delete_Import.php?id=" + ImportID;

    }
</script>