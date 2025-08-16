<div class="container-fluid pt-4 px-4">
    <div class="h-100 bg-light rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0 text-dark">ข้อความถึงผู้ดูแลระบบ</h6>

            <!--เพิ่ม-->
            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#addRecordModal">ส่งข้อความ</button>

            <!--Chart Start อุณหภูมิ-->
            <?php
            require_once("User_FormMessage.php");
            ?>
            <!--Chart End อุณหภูมิ-->
        </div>
        <div class="table-responsive">
            <?php
            require_once("connect_db.php");

            $end_Page = 0;
            // ----------------- ส่วน Pagination Logic -----------------
            $records_per_page = 7; // จำนวนข้อมูลที่จะแสดงต่อหน้า

            //รหัสผู้ใช้
            $User_ID_Login = $_SESSION['User_ID'];

            // ตรวจสอบหน้าปัจจุบันจาก URL
            if (isset($_GET['page']) && is_numeric($_GET['page'])) {
                $current_page = $_GET['page'];
            } else {
                $current_page = 1; // ถ้าไม่มีการระบุหน้า ให้ถือว่าเป็นหน้าแรก
            }

            // คำนวณจุดเริ่มต้น (OFFSET) สำหรับการดึงข้อมูล
            $offset = ($current_page - 1) * $records_per_page;

            $sql = "SELECT * FROM `message` WHERE `User_ID` = ? AND `Message_Delete` =  0;";

            $stmt = $conn->prepare($sql); // เตรียมคำสั่ง SQL เพื่อป้องกัน SQL Injection
            $stmt->bind_param("i", $_SESSION['User_ID']); // ผูกค่าพารามิเตอร์
            $stmt->execute(); // รันคำสั่ง
            $result = $stmt->get_result(); // รับผลลัพธ์จากฐานข้อมูล

            if (!$result) {
                echo "Error: " . mysqli_error($conn);
            }

            if ($result != "") {
                $total_records = mysqli_num_rows($result);
                // คำนวณจำนวนหน้าทั้งหมด
                $total_pages = ceil($total_records / $records_per_page);
            }

            $sql0 = "SELECT * FROM `message` WHERE `User_ID` = ? AND `Message_Delete` =  0 ORDER BY `Message_Record` DESC LIMIT $records_per_page OFFSET $offset ; ";

            $stmt0 = $conn->prepare($sql0); // เตรียมคำสั่ง SQL เพื่อป้องกัน SQL Injection
            $stmt0->bind_param("i", $_SESSION['User_ID']); // ผูกค่าพารามิเตอร์
            $stmt0->execute(); // รันคำสั่ง
            $result0 = $stmt0->get_result(); // รับผลลัพธ์จากฐานข้อมูล

            ?>

            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-dark" style="font-size: 14px;">
                        <th scope="col" class="col-1.5">วันที่ส่ง</th>
                        <th scope="col" class="col-2">หัวข้อ</th>
                        <th scope="col" class="col-7">รายละเอียด</th>
                        <th scope="col" class="col-1.5">เครื่องมือ</th>
                    </tr>
                </thead>
                <tbody style="font-size: 13px;">
                    <?php
                    if ($result0 && mysqli_num_rows($result0) > 0) {
                        $end_Page = +1;
                        while ($row = $result0->fetch_assoc()) {
                            $Message_ID = $row['Message_ID'];
                            $Message_Title = $row['Message_Title'];
                            $Message_Record = date_create_from_format(format: "Y-m-d H:i:s", datetime: $row["Message_Record"])->format(format: "d/m/Y H:i");
                            $Message_Detail = $row['Message_Detail'];
                            $User_ID = $row['User_ID'];
                    ?>
                            <tr>
                                <td><?php echo $Message_Record; ?></td>
                                <td><?php echo $Message_Title; ?></td>
                                <td><?php echo $Message_Detail; ?></td>

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
                                                    <form id="EditCollectForm" action="Update_Message.php" method="post">
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
                                                        <!-- Add your form fields here for additional request details -->
                                                        <input type="hidden" name="Message_ID" class="form-control" id="Message_ID" value="<?php echo $Message_ID; ?>" readonly>
                                                        <input type="hidden" name="User_ID" class="form-control" id="User_ID" value="<?php echo $_SESSION['User_ID']; ?>" readonly>

                                                        <p>หัวข้อ : <?php echo $Message_Title; ?> </p>
                                                        <p>วันที่ส่ง : <?php echo $Message_Record; ?> </p>

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
                                </td>
                            </tr>
                    <?php }
                    } else {
                        $end_Page = -$end_Page;
                        echo "<tr><td colspan='4' class='text-center'>ไม่พบข้อมูลการส่งข้อความของคุณ</td></tr>";
                    } ?>
                </tbody>
            </table>
            <?php
            // ----------------- ส่วนแสดง Pagination Links -----------------
            echo "<div class='pagination'>";

            // เราจะสร้างตัวแปรเพื่อเก็บพารามิเตอร์เดือน
            $month_param = '';
            if (!empty($selected_month)) {
                $month_param = '&month=' . urlencode($selected_month); // ใช้ urlencode เพื่อให้ปลอดภัยถ้ามีอักขระพิเศษ
            }

            // เราจะสร้างตัวแปรเพื่อเก็บพารามิเตอร์ปี
            $year_param = '';
            if (!empty($selected_year)) {
                $year_param = '&year=' . urlencode($selected_year); // ใช้ urlencode เพื่อให้ปลอดภัยถ้ามีอักขระพิเศษ
            }

            // ปุ่ม Previous
            if ($current_page > 1) {
                echo "<a href='?page=" . ($current_page - 1) . $month_param . $year_param . "' class='page-link'>&laquo; ก่อนหน้า</a>";
            } else {
                echo "<a class = 'p-2'>หน้าแรก</a>";
            }

            // ปุ่ม Next
            if ($end_Page > 0) {
                echo "<a href='?page=" . ($current_page + 1) . $month_param . $year_param . "' class='page-link'>ถัดไป &raquo;</a>";
            } else {
                echo "<a class = 'p-2'>หน้าสุดท้าย</a>";
            }
            echo "</div>";
            ?>
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