<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<div class="container-fluid pt-4 px-4">
    <div class="h-100 bg-light rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0 text-dark">ตารางจัดการข้อมูลสายพันธุ์ไก่ไข่</h6>

            <!--เพิ่ม-->
            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#addRecordModal">เพิ่มข้อมูล</button>

            <!--Chart Start อุณหภูมิ-->
            <?php
            require_once("Admin_FormBreedChicken.php");
            ?>
            <!--Chart End อุณหภูมิ-->
        </div>

        <div class="table-responsive">
            <?php
            require_once("connect_db.php");
            $sql_Table_Breed = "select * from breed ";
            $result_Table_Breed = mysqli_query($conn, $sql_Table_Breed);
            ?>
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-dark">
                        <th scope="col" class="col-0.5">ลำดับ</th>
                        <th scope="col" class="col-2">ชื่อสายพันธุ์ไก่ไข่</th>
                        <th scope="col" class="col-6">คำอธิบายสายพันธุ์</th>
                        <th scope="col" class="col-2">รูปตัวอย่าง</th>
                        <th scope="col" class="col-1.5">เครื่องมือ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = $result_Table_Breed->fetch_assoc()) {
                        $Breed_ID = $row['Breed_ID'];
                        $Breed_Name = $row['Breed_Name'];
                        $Breed_Description = $row['Breed_Description'];
                        $Breed_Img = $row['Breed_Img'];
                        $base64Image = base64_encode($Breed_Img); // แปลง BLOB เป็น Base64
                    ?>
                        <tr>
                            <td><?php echo $Breed_ID; ?></td>
                            <td><?php echo $Breed_Name; ?></td>
                            <td><?php echo $Breed_Description; ?></td>
                            <td><?php echo "<img src='data:image/jpeg;base64,$base64Image' alt='Breed_Img' style='height: auto; width: 100%; border-radius: 5px;'>"; ?></td>

                            <!--แก้ไข-->
                            <td>
                                <button type="button" class="btn" data-bs-toggle="modal" 
                                    data-bs-target="#EditBreedModal<?= $Breed_ID; ?>" style="height:30px; width:46%; padding: 5px;">
                                    <i class='far fa-edit' style='color:blue; font-size:16px;'></i>
                                </button>

                                <!--Start Edit-->
                                <div class="modal fade" id="EditBreedModal<?= $Breed_ID; ?>" tabindex="-1" aria-labelledby="EditBreedModalLabel<?= $Breed_ID; ?>" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="EditBreedModalLabel<?= $Breed_ID; ?>">แก้ไขข้อมูล</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Form for Editing Record -->
                                                <form id="EditBreedForm" action="Update_Breed.php" method="post" enctype="multipart/form-data">
                                                    <!-- Add your form fields here for additional request details -->

                                                    <input type="hidden" name="Breed_ID" class="form-control" id="Breed_ID" value="<?php echo $Breed_ID; ?>" readonly>

                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" id="Breed_Name" name="Breed_Name" value="<?php echo $Breed_Name; ?>" placeholder required>
                                                        <label class="form-label">ชื่อสายพันธุ์ไก่ไข่</label>
                                                    </div>

                                                    <div class="form-floating mb-3">
                                                        <textarea class="form-control" id="Breed_Description" name="Breed_Description" style="height: 150px;" placeholder><?php echo $Breed_Description; ?></textarea>
                                                        <label for="floatingTextarea">คำอธิบายสายพันธุ์ไก่</label>
                                                    </div>

                                                    <label class="form-label">ภาพสายพันธุ์ไก่ไข่ตัวอย่าง</label>
                                                    <div class="form-floating mb-3">
                                                        <input type="file" id="Breed_Img" name="Breed_Img" value="<?php $Breed_Img; ?>" placeholder>
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

                                <button type="button" class="btn" data-bs-toggle="modal" onclick="BreedID(<?= $Breed_ID; ?>)"
                                    data-bs-target="#confirmDeleteModal" style="height:30px; width:46%; padding: 5px; margin-top:5px;">
                                    <i class='material-icons' style='color:red; font-size:20px;'>delete</i>
                                </button>

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
                                                <button type="button" class="btn btn-danger" onclick="deleteBreed()">ยืนยัน</button>
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

<script>
    var BreedID;

    // ฟังก์ชันเพื่อรับค่า member_ID เมื่อคลิกที่ปุ่ม "ลบ"
    function BreedID(Breed_ID) {
        BreedID = Breed_ID;
    }

    function deleteBreed() {

        // ถ้ายืนยันการลบ ทำการ redirect ไปยังไฟล์ planting_delete.php พร้อมส่งค่า id ของแถวที่ต้องการลบ
        window.location.href = "Delete_Breed.php?id=" + BreedID;

    }
</script>