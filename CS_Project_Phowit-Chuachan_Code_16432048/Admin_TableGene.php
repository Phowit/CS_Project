<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<div class="container-fluid pt-4 px-4">
    <div class="h-100 bg-light rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0 text-dark">สายพันธุ์ไก่</h6>

            <!--เพิ่ม-->
            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#addRecordModal">เพิ่มข้อมูล</button>

            <!--Chart Start อุณหภูมิ-->
            <?php
                require_once("Admin_FormGeneChicken.php");
            ?>
            <!--Chart End อุณหภูมิ-->
        </div>

        <div class="table-responsive">
            <?php
            require_once("connect_db.php");
            $sql = "select * from gene ";
            $result = mysqli_query($conn, $sql);
            ?>
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-dark">
                        <th scope="col" class="col-1">รหัส</th>
                        <th scope="col" class="col-2">ชื่อสายพันธุ์ไก่</th>
                        <th scope="col" class="col-7">คำอธิบายสายพันธุ์</th>
                        <th scope="col" class="col-1">แก้ไข</th>
                        <th scope="col" class="col-1">ลบ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = $result->fetch_assoc()) {
                        $Gene_ID = $row['Gene_ID'];
                        $Gene_Name = $row['Gene_Name'];
                        $Description = $row['Description'];
                    ?>
                        <tr>
                            <td><?php echo $row['Gene_ID']; ?></td>
                            <td><?php echo $row['Gene_Name']; ?></td>
                            <td><?php echo $row['Description']; ?></td>

                            <!--แก้ไข-->
                            <td>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editRecordModal<?= $row['Gene_ID']; ?>">แก้ไข</button>
                            </td>

                            <!--Start Edit-->
                            <div class="modal fade" id="editRecordModal<?= $row['Gene_ID']; ?>" tabindex="-1" aria-labelledby="editRecordModalLabel<?= $row['Gene_ID']; ?>" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editRecordModalLabel<?= $row['Gene_ID']; ?>">แก้ไขข้อมูล</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Form for Editing Record -->
                                            <form id="editRecordForm" action="Update_Gene.php" method="post">
                                                <!-- Add your form fields here for additional request details -->

                                                <input type="hidden" name="Gene_ID" class="form-control" id="Gene_ID" value="<?php echo $row['Gene_ID']; ?>" readonly>

                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="Gene_Name" name="Gene_Name" value="<?php echo $row['Gene_Name'] ?>" placeholder required>
                                                    <label class="form-label">ชื่อสายพันธุ์ไก่</label>
                                                </div>

                                                <div class="form-floating mb-3">
                                                    <textarea class="form-control" id="Description" name="Description" style="height: 150px;" placeholder><?php echo $row['Description']; ?></textarea>
                                                    <label for="floatingTextarea">คำอธิบายสายพันธุ์ไก่</label>
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
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" onclick="GeneID(<?= $row['Gene_ID']; ?>)" data-bs-target="#confirmDeleteModal">ลบ</button>
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
                                            <button type="button" class="btn btn-danger" onclick="deleteGene()">ยืนยัน</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!--END Warning For Delete-->

                        </tr>
                    <?php } ?>
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
    var GeneID;

    // ฟังก์ชันเพื่อรับค่า member_ID เมื่อคลิกที่ปุ่ม "ลบ"
    function GeneID(Gene_ID) {
        GeneID = Gene_ID;
    }

    function deleteGene() {

        // ถ้ายืนยันการลบ ทำการ redirect ไปยังไฟล์ planting_delete.php พร้อมส่งค่า id ของแถวที่ต้องการลบ
        window.location.href = "Delete_Gene.php?id=" + GeneID;

    }
</script>