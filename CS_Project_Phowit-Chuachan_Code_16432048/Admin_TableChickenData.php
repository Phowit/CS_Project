<div class="container-fluid pt-4 px-4">
    <div class="bg-light text-center rounded p-4">

        <div class="table-responsive">
            <?php
            require_once("connect_db.php");
            $sql = "select * from chicken_data  ";
            $result = mysqli_query($conn, $sql);
            ?>

            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-dark">
                        <th scope="col" class="col-1">รหัส</th>
                        <th scope="col" class="col-2">วันที่นำเข้ามาเลี้ยง</th>
                        <th scope="col" class="col-3">สายพันธุ์ไก่</th>
                        <th scope="col" class="col-2">จำนวนทั้งหมด(ตัว)</th>
                        <th scope="col" class="col-2">ชื่อผู้ใช้</th>
                        <th scope="col" class="col-1">แก้ไข</th>
                        <th scope="col" class="col-1">ลบ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = $result->fetch_assoc()) {
                        $Set_ID = $row['Set_ID'];
                        $Date_in = $row['Date_in'];
                        $Gene = $row['Gene'];
                        $Amount = $row['Amount'];
                        $Name = $row['Name'];
                    ?>
                        <tr>
                            <td><?php echo $row['Set_ID']; ?></td>
                            <td><?php echo $row['Date_in']; ?></td>
                            <td><?php echo $row['Gene']; ?></td>
                            <td><?php echo $row['Amount']; ?></td>
                            <td><?php echo $row['Name']; ?></td>

                            <!--แก้ไข-->
                            <td>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editRecordModal<?= $row['Set_ID']; ?>">แก้ไข</button>
                            </td>

                                <!--Start Edit-->
                            <div class="modal fade" id="editRecordModal<?= $row['Set_ID']; ?>" tabindex="-1" aria-labelledby="editRecordModalLabel<?= $row['Set_ID']; ?>" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editRecordModalLabel<?= $row['Set_ID']; ?>">แก้ไขข้อมูล</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Form for Editing Record -->
                                            <form id="addRequestForm" action="Update_ChickenData.php" method="post">
                                                <!-- Add your form fields here for additional request details -->

                                                <input type="hidden" name="Set_ID" class="form-control" id="Set_ID" value="<?php echo $row['Set_ID']; ?>" readonly>
                                                
                                                    <div class="form-floating mb-3">
                                                        <input type="Date" class="form-control" name="Date_in" id="Date_in" placeholder required>
                                                        <label for="Date_in" class="form-label">วัน เวลา ที่นำเข้ามาเลี้ยง</label>
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
                                                                
                            <td>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" onclick="SetID(<?= $row['Set_ID']; ?>)" data-bs-target="#confirmDeleteModal">ลบ</button>
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
                                                <button type="button" class="btn btn-danger" onclick="deleteChickenData()">ยืนยัน</button>
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
    var SetID;

    // ฟังก์ชันเพื่อรับค่า member_ID เมื่อคลิกที่ปุ่ม "ลบ"
    function SetID(Set_ID) {
        SetID = Set_ID;
    }

    function deleteChickenData() {

        // ถ้ายืนยันการลบ ทำการ redirect ไปยังไฟล์ planting_delete.php พร้อมส่งค่า id ของแถวที่ต้องการลบ
        window.location.href = "Delete_ChickenData.php?id=" + SetID;

    }
</script>