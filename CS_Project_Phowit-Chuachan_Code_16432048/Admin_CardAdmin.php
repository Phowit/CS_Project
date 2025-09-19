<div class="container-fluid pt-4 px-4 pb-0 mb-0">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h6 class="mb-0">ข้อมูลของคุณ</h6>
    </div>

    <?php
    require_once("connect_db.php");
    $sql = "select * from user WHERE user.`User_ID` = ?";

    $stmt = $conn->prepare($sql); // เตรียมคำสั่ง SQL เพื่อป้องกัน SQL Injection
    $stmt->bind_param("i", $_SESSION['User_ID']); // ผูกค่าพารามิเตอร์
    $stmt->execute(); // รันคำสั่ง
    $result = $stmt->get_result(); // รับผลลัพธ์จากฐานข้อมูล

    while ($row = $result->fetch_assoc()) {
        $User_ID = $row['User_ID'];
        $User_Name = $row['User_Name'];
        $User_Tel = $row['User_Tel'];
        $User_Address = $row['User_Address'];
        $User_Email = $row['User_Email'];
        $Program = $row['Program'];
        $User_Image = $row['User_Image'];
        $base64Image = base64_encode($User_Image); // แปลง BLOB เป็น Base64
        $User_Status = $row['User_Status'];
    ?>
        <div class="col-sm-12 col-xl-12 mb-5">
            <div class="bg-light rounded h-100 p-4">
                <div class="row">
                    <div class="col-sm-12 col-xl-4">
                        <?php echo "<img src='data:image/jpeg;base64,$base64Image' alt='User_Image' style='width: 80%; height: auto; border-radius: 5px;'>"; ?>
                    </div>

                    <div class="col-sm-12 col-xl-6">
                        <h5 class="mb-4"><?php echo $User_Name; ?></h5>

                        <dl class="row mb-0">

                            <dt class="col-sm-4">รหัสประจำตัว</dt>
                            <dd class="col-sm-8"><?php echo $User_ID; ?></dd>

                            <dt class="col-sm-4 text-truncate">สถานะ</dt>
                            <dd class="col-sm-8"><?php echo $User_Status; ?></dd>

                            <dt class="col-sm-4">เบอร์โทรศัพท์</dt>
                            <dd class="col-sm-8"><?php echo $User_Tel; ?></dd>

                            <dt class="col-sm-4">ที่อยู่ติดต่อ</dt>
                            <dd class="col-sm-8"><?php echo $User_Address; ?></dd>

                            <dt class="col-sm-4">อีเมล</dt>
                            <dd class="col-sm-8"><?php echo $User_Email; ?></dd>

                            <dt class="col-sm-4 text-truncate">สาขา</dt>
                            <dd class="col-sm-8"><?php echo $Program; ?></dd>

                        </dl>
                    </div>

                    <div class="col-sm-12 col-xl-2">

                        <!--แก้ไข-->
                        <td>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#EditAdminModal<?= $User_ID; ?>" style="height:auto; width: 100%;">แก้ไข</button>
                        </td>

                        <!--Start Edit-->
                        <div class="modal fade" id="EditAdminModal<?= $User_ID; ?>" tabindex="-1" aria-labelledby="EditAdminModal<?= $User_ID; ?>" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="EditAdminModal<?= $User_ID; ?>">แก้ไขข้อมูล</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Form for Editing Record -->
                                        <form id="EditBreedForm" action="Update_Admin.php" method="post" enctype="multipart/form-data">
                                            <!-- Add your form fields here for additional request details -->

                                            <input type="hidden" name="User_ID" class="form-control" id="User_ID" value="<?php echo $User_ID; ?>" readonly>

                                            <div class="row">
                                                <div class="col-8">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" id="User_Name" name="User_Name" value="<?php echo $User_Name; ?>" placeholder required>
                                                        <label class="form-label">ชื่อผู้ใช้</label>
                                                    </div>
                                                </div>

                                                <div class="col-4">
                                                    <div class="form-floating mb-3">
                                                        <input type="tel" class="form-control" id="User_Tel" name="User_Tel" value="<?php echo $User_Tel; ?>" placeholder required>
                                                        <label class="form-label">เบอร์โทรศัพท์</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-8">
                                                    <div class="form-floating mb-3">
                                                        <input type="email" class="form-control" id="User_Email" name="User_Email" value="<?php echo $User_Email; ?>" placeholder required>
                                                        <label class="form-label">อีเมล</label>
                                                    </div>
                                                </div>

                                                <div class="col-4">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" id="Program" name="Program" value="<?php echo $Program; ?>" placeholder required>
                                                        <label class="form-label">สาขา</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-8">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" id="User_Address" name="User_Address" value="<?php echo $User_Address; ?>" placeholder required>
                                                        <label class="form-label">ที่อยู่ติดต่อ</label>
                                                    </div>
                                                </div>

                                                <div class="col-4">
                                                    <label class="form-label">ภาพผู้ดูแลระบบ</label>
                                                    <div class="form-floating mb-3">
                                                        <input type="file" id="User_Image" name="User_Image" value="<?php $User_Image; ?>" placeholder>
                                                    </div>
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
                        </div><br><br>
                        <!--End Edit-->

                    </div>
                </div>
            </div>
        </div>
    <?php } ?> <!-- close php-->
</div>

<div class="container-fluid pt-0 px-4">
    <div class="row" style="margin: 7px;">
        <div class="col-sm-10 col-xl-10">
            <h6 class="mb-0">ข้อมูลผู้ใช้งานทั่วไป</h6>
        </div>

        <div class="col-sm-2 col-xl-2">
            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#addRecordModal"
                style="height: 40px; width: 70%; position: relative; left: 45%;">เพิ่มข้อมูล
            </button>
        </div>
    </div>

    <!-- เริ่ม ฟอร์มเพิ่มข้อมูลนำเข้าไก่ไข่ -->
    <?php
    require_once("Admin_FormAdminData.php")
    ?>
    <!-- จบ ฟอร์มเพิ่มข้อมูลนำเข้าไก่ไข่ -->

    <?php
    require_once("connect_db.php");
    $sqli = "SELECT * from user WHERE user.`User_ID` != ? AND `User_Delete` = 0";

    $stmt = $conn->prepare($sqli); // เตรียมคำสั่ง SQL เพื่อป้องกัน SQL Injection
    $stmt->bind_param("i", $_SESSION['User_ID']); // ผูกค่าพารามิเตอร์
    $stmt->execute(); // รันคำสั่ง
    $resulti = $stmt->get_result(); // รับผลลัพธ์จากฐานข้อมูล

    while ($row = $resulti->fetch_assoc()) {
        $User_ID = $row['User_ID'];
        $User_Name = $row['User_Name'];
        $User_Tel = $row['User_Tel'];
        $User_Address = $row['User_Address'];
        $User_Email = $row['User_Email'];
        $Program = $row['Program'];
        $User_Image = $row['User_Image'];
        $base64Image = base64_encode($User_Image); // แปลง BLOB เป็น Base64
        $User_Status = $row['User_Status'];
    ?>
        <div class="col-sm-12 col-xl-12" style="margin-bottom: 5px;">
            <div class="bg-light rounded h-100 p-4">
                <div class="row">
                    <div class="col-sm-12 col-xl-4">
                        <?php echo "<img src='data:image/jpeg;base64,$base64Image' alt='User_Image' style='width: 80%; height: auto; border-radius: 5px;'>"; ?>
                    </div>

                    <div class="col-sm-12 col-xl-6">
                        <h5 class="mb-4"><?php echo $User_Name; ?></h5>

                        <dl class="row mb-0">

                            <dt class="col-sm-4">รหัสประจำตัว</dt>
                            <dd class="col-sm-8"><?php echo $User_ID; ?></dd>

                            <dt class="col-sm-4">สถานะ</dt>
                            <dd class="col-sm-8"><?php echo $User_Status; ?></dd>

                            <dt class="col-sm-4">เบอร์โทรศัพท์</dt>
                            <dd class="col-sm-8"><?php echo $User_Tel; ?></dd>

                            <dt class="col-sm-4">ที่อยู่ติดต่อ</dt>
                            <dd class="col-sm-8"><?php echo $User_Address; ?></dd>

                            <dt class="col-sm-4">อีเมล</dt>
                            <dd class="col-sm-8"><?php echo $User_Email; ?></dd>

                            <dt class="col-sm-4 text-truncate">สาขา</dt>
                            <dd class="col-sm-8"><?php echo $Program; ?></dd>

                        </dl>
                    </div>

                    <div class="col-sm-12 col-xl-2">

                        <!--แก้ไข-->
                        <td>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#EditAdminModal<?= $User_ID; ?>" style="height:auto; width: 100%;">แก้ไข</button>
                        </td>

                        <!--Start Edit-->
                        <div class="modal fade" id="EditAdminModal<?= $User_ID; ?>" tabindex="-1" aria-labelledby="EditAdminModal<?= $User_ID; ?>" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="EditAdminModal<?= $User_ID; ?>">แก้ไขข้อมูล</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Form for Editing Record -->
                                        <form id="EditAdminForm" action="Update_Admin.php" method="post" enctype="multipart/form-data">
                                            <!-- Add your form fields here for additional request details -->

                                            <input type="hidden" name="User_ID" class="form-control" id="User_ID" value="<?php echo $User_ID; ?>" readonly>

                                            <div class="row">
                                                <div class="col-8">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" id="User_Name" name="User_Name" value="<?php echo $User_Name; ?>" placeholder required>
                                                        <label class="form-label">ชื่อผู้ใช้</label>
                                                    </div>
                                                </div>

                                                <div class="col-4">
                                                    <div class="form-floating mb-3">
                                                        <input type="tel" class="form-control" id="User_Tel" name="User_Tel" value="<?php echo $User_Tel; ?>" placeholder required>
                                                        <label class="form-label">เบอร์โทรศัพท์</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-8">
                                                    <div class="form-floating mb-3">
                                                        <input type="email" class="form-control" id="User_Email" name="User_Email" value="<?php echo $User_Email; ?>" placeholder required>
                                                        <label class="form-label">อีเมล</label>
                                                    </div>
                                                </div>

                                                <div class="col-4">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" id="Program" name="Program" value="<?php echo $Program; ?>" placeholder required>
                                                        <label class="form-label">สาขา</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-8">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" id="User_Address" name="User_Address" value="<?php echo $User_Address; ?>" placeholder required>
                                                        <label class="form-label">ที่อยู่ติดต่อ</label>
                                                    </div>
                                                </div>

                                                <div class="col-4">
                                                    <label class="form-label">โปรดเลือกภาพผู้ใช้</label>
                                                    <div class="form-floating mb-3">
                                                        <input type="file" id="User_Image" name="User_Image" value="<?php $User_Image; ?>" placeholder>
                                                    </div>
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
                        </div><br><br>
                        <!--End Edit-->

                        <td>
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#DeleteAdminModal<?= $User_ID; ?>" style="height:auto; width: 100%;">ลบ</button>
                        </td>

                        <!--Start Waring For Delete-->
                        <div class="modal fade" id="DeleteAdminModal<?= $User_ID; ?>" tabindex="-1" aria-labelledby="DeleteAdminModal<?= $User_ID; ?>" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="DeleteAdminModal<?= $User_ID; ?>">ยืนยันที่จะลบข้อมูลผู้ใช้หรือไม่?</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Form for Editing Record -->
                                        <form id="DeleteAdminForm" action="Delete_AdminData.php" method="post">
                                            <!-- Add your form fields here for additional request details -->
                                            <input type="hidden" name="User_ID" class="form-control" id="User_ID" value="<?php echo $User_ID; ?>" readonly>

                                            <div class="row">
                                                <div class="col-sm-8">
                                                    <p>รหัสประจำตัว : <?php echo $User_ID; ?> </p>

                                                    <p>ชื่อผู้ใช้งาน : <?php echo $User_Name; ?> </p>

                                                    <p>สถานะ : <?php echo $User_Status; ?> </p>

                                                    <p>สาขา : <?php echo $Program; ?> </p>
                                                </div>

                                                <div class="col-sm-4 col-xl-4">
                                                    <?php echo "<img src='data:image/jpeg;base64,$base64Image' alt='User_Image' style='width: 80%; height: auto; border-radius: 5px;'>"; ?>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12" style="margin-top: 20px;">
                                                    <button type="button" class="btn btn-secondary float-end" data-bs-dismiss="modal" style="margin-top: 20px;">ยกเลิก</button>
                                                    <button type="submit" class="btn btn-warning float-end" style="margin-top: 20px; margin-right:10px">ยืนยันการลบ</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--END Warning For Delete-->
                    </div>
                </div>
            </div>
        </div>
    <?php } ?> <!-- close php-->
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