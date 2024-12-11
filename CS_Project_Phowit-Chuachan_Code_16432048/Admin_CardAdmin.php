<div class="container-fluid pt-4 px-4">
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

    <?php
    require_once("connect_db.php");
    $sql = "select * from user ";
    $result = mysqli_query($conn, $sql);

    while ($row = $result->fetch_assoc()) {
        $Admin_ID = $row['User_ID'];
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
                        <?php echo "<img src='data:image/jpeg;base64,$base64Image' alt='User_Image' style='height: 200px; width: auto;'>"; ?>
                    </div>

                    <div class="col-sm-12 col-xl-8">
                        <h6 class="mb-4"><?php echo $User_Name; ?></h6>

                        <dl class="row mb-0">

                            <dt class="col-sm-4">รหัสผู้ดูแลระบบ</dt>
                            <dd class="col-sm-8"><?php echo $Admin_ID; ?></dd>

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

                    <div class="col-sm-12 col-xl-4">

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