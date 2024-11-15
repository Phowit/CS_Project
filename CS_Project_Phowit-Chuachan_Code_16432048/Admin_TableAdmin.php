<div class="container-fluid pt-4 px-4">
    <div class="bg-light text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">ข้อมูลผู้ดูแลระบบ</h6>

            <!--เพิ่ม-->
            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#addRecordModal">เพิ่มข้อมูล</button>

            <!-- เริ่ม ฟอร์มเพิ่มข้อมูลไก่ -->
            <?php 
                require_once("Admin_FormAdminData.php")
            ?>
            <!-- จบ ฟอร์มเพิ่มข้อมูลไก่ -->
        </div>

        <div class="table-responsive">
            <?php
            require_once("connect_db.php");
            $sql = "select * from admin ";
            $result = mysqli_query($conn, $sql);
            ?>

            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-dark">
                        <th scope="col" class="col-1">รหัสผู้ดูแล</th>
                        <th scope="col" class="col-2">ชื่อผู้ดูแลระบบ</th>
                        <th scope="col" class="col-2">เบอร์โทรติดต่อ</th>
                        <th scope="col" class="col-2">ที่อยู่ติดต่อ</th>
                        <th scope="col" class="col-1">อีเมลติดต่อ</th>
                        <th scope="col" class="col-2">สาขา</th>
                        <th scope="col" class="col-1">แก้ไข</th>
                        <th scope="col" class="col-1">ลบ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = $result->fetch_assoc()) {
                        $Admin_ID = $row['Admin_ID'];
                        $Admin_Name = $row['Admin_Name'];
                        $Tel = $row['Tel'];
                        $Address = $row['Address'];
                        $Email = $row['Email'];
                        $Program_ID = $row['Program_ID'];
                    ?>
                        <tr>
                            <td><?php echo $row['Admin_ID']; ?></td>
                            <td><?php echo $row['Admin_Name']; ?></td>
                            <td><?php echo $row['Tel']; ?></td>
                            <td><?php echo $row['Address']; ?></td>
                            <td><?php echo $row['Email']; ?></td>
                            <td><?php echo $row['Program_ID']; ?></td>
                            <td> <a class="btn btn-sm btn-primary col-12">แก้ไข</a> </td>

                            <td>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" onclick="AdminID(<?= $row['Admin_ID']; ?>)" data-bs-target="#confirmDeleteModal">ลบ</button>
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
                                            <button type="button" class="btn btn-danger" onclick="deleteAdmin()">ยืนยัน</button>
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
    var AdminID;

    // ฟังก์ชันเพื่อรับค่า member_ID เมื่อคลิกที่ปุ่ม "ลบ"
    function AdminID(Admin_ID) {
        AdminID = Admin_ID;
    }

    function deleteAdmin() {

        // ถ้ายืนยันการลบ ทำการ redirect ไปยังไฟล์ planting_delete.php พร้อมส่งค่า id ของแถวที่ต้องการลบ
        window.location.href = "Delete_AdminData.php?id=" + AdminID;

    }
</script>