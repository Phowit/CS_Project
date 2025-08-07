<div class="container-fluid pt-4 px-4">
    <div class="h-100 bg-light rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0 text-dark">ข้อความถึงผู้ดูแลระบบ</h6>
        </div>
        <div class="table-responsive">
            <?php
            require_once("connect_db.php");
            $sql = "SELECT
                    `Message_ID`,
                    `Message_Record`,
                    `Message_Title`,
                    `Message_Detail`,
                    message.`User_ID`,
                    user.User_Name
                    FROM `message`
                    INNER JOIN user ON user.User_ID = message.User_ID
                    WHERE `Message_Delete` = 0
                    ORDER BY `Message_Record` DESC;
                    ";

            $result = mysqli_query($conn, $sql);
            ?>

            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-dark" style="font-size: 14px;">
                        <th scope="col" class="col-1.5">วันที่ส่ง</th>
                        <th scope="col" class="col-1.5">หัวข้อ</th>
                        <th scope="col" class="col-6">รายละเอียด</th>
                        <th scope="col" class="col-1.5">ผู้ส่ง</th>
                        <th scope="col" class="col-1.5">เครื่องมือ</th>

                    </tr>
                </thead>
                <tbody style="font-size: 13px;">
                    <?php
                    while ($row = $result->fetch_assoc()) {
                        $Message_ID = $row['Message_ID'];
                        $Message_Record = date_create_from_format(format: "Y-m-d H:i:s", datetime: $row["Message_Record"])->format(format: "d/m/Y H:i");
                        $Message_Title = $row['Message_Title'];
                        $Message_Detail = $row['Message_Detail'];
                        $User_ID = $row['User_ID'];
                        $User_Name = $row['User_Name'];
                    ?>
                        <tr>
                            <td><?php echo $Message_Record; ?></td>
                            <td><?php echo $Message_Title; ?></td>
                            <td><?php echo $Message_Detail; ?></td>
                            <td><?php echo $User_Name; ?></td>

                            <!--แก้ไข-->
                            <td>
                                <button type="button" class="btn" data-bs-toggle="modal" style="height:30px; width:46%; padding: 1px;"
                                    data-bs-target="#EditMessageModal<?= $Message_ID; ?>">
                                    <i class='far fa-edit' style='color:blue; font-size:16px;'></i>
                                </button>

                                <!--Start Edit-->
                                <div class="modal fade" id="EditMessageModal<?= $Message_ID; ?>" tabindex="-1" aria-labelledby="EditMessageModalLabel<?= $Message_ID; ?>" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="EditMessageModalLabel<?= $Message_ID; ?>">แก้ไขข้อมูล</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Form for Editing Record -->
                                                <form id="EditCollectForm" action="Admin_Update_Message.php" method="post">
                                                    <!-- Add your form fields here for additional request details -->

                                                    <input type="hidden" name="Message_ID" class="form-control" id="Message_ID" value="<?php echo $Message_ID; ?>" readonly>

                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" id="Message_Title" name="Message_Title" value="<?php echo $Message_Title; ?>" placeholder required>
                                                        <label class="form-label">หัวข้อ</label>
                                                    </div>

                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" id="Message_Detail" name="Message_Detail" value="<?php echo $Message_Detail; ?>" placeholder required>
                                                        <label for="form-label">รายละเอียด</label>
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

                                <button type="button" class="btn" data-bs-toggle="modal" style="height:30px; width:46%; padding: 1px;"
                                    data-bs-target="#DeleteMessageModal<?= $Message_ID; ?>">
                                    <i class='material-icons' style='color:red; font-size:20px;'>delete</i>
                                </button>

                                <!--Start Waring For Delete-->
                                <div class="modal fade" id="DeleteMessageModal<?= $Message_ID; ?>" tabindex="-1" aria-labelledby="DeleteMessageModalLabel<?= $Message_ID; ?>" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="DeleteMessageModalLabel<?= $Message_ID; ?>">แก้ไขข้อมูล</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Form for Editing Record -->
                                                <form id="DeleteMessageForm" action="Delete_Message.php" method="post">
                                                    <!-- Add your form fields here for additional request details-->
                                                    <input type="hidden" name="Message_ID" class="form-control" id="Message_ID" value="<?php echo $Message_ID; ?>" readonly>
                                                    <input type="hidden" name="User_ID" class="form-control" id="User_ID" value="<?php echo $_SESSION['User_ID']; ?>" readonly>

                                                    <p>หัวข้อ : <?php echo $Message_Title; ?> </p>
                                                    <p>วันที่ส่ง : <?php echo $Message_Record; ?> </p>

                                                    <div class="row">
                                                        <div class="col-12" style="margin-top: 20px;">
                                                            <button type="button" class="btn btn-secondary float-end" data-bs-dismiss="modal" style="margin-top: 20px;">ยกเลิก</button>
                                                            <button type="submit" class="btn btn-danger float-end" style="margin-top: 20px; margin-right:10px">ยืนยันการลบ</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--END Warning For Delete-->
                            </td>
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