<div class="container-fluid pt-4 px-4">
    <div class="row">

        <div class="col-sm-12 col-xl-12">
            <div class="h-100 bg-light rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-4">ข้อมูลการเก็บไข่ไก่</h6>

                    <!--เพิ่ม-->
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#addRecordModal">เพิ่มข้อมูล</button>

                    <!-- เริ่ม ฟอร์มเพิ่มข้อมูลไก่ -->
                    <?php
                    require_once("Admin_FormCollect.php")
                    ?>
                    <!-- จบ ฟอร์มเพิ่มข้อมูลไก่ -->
                </div>
                <div class="table-responsive">
                    <?php
                    require_once("connect_db.php");
                    $sql = "select 
                    collect.`Collect_ID`,
                    collect.`Collect_Date`,
                    collect.`EggAmount`
                    FROM collect
                    ORDER BY collect.`Collect_Date` DESC;
                    ";

                    $result = mysqli_query($conn, $sql);

                    ?>
                    <table class="table text-start align-middle table-bordered table-hover mb-0">
                        <thead>
                            <tr class="text-dark p-1" style="font-size: 14px;">
                                <th scope="col" class="col-1">ลำดับ</th>
                                <th scope="col" class="col-7">วันที่เก็บ</th>
                                <th scope="col" class="col-3">จำนวน (ฟอง)</th>
                                <th scope="col" class="col-1">เครื่องมือ</th>
                            </tr>
                        </thead>
                        <tbody style="font-size: 13px;" class="p-1">
                            <?php
                            while ($row = $result->fetch_assoc()) {
                                $Collect_ID = $row['Collect_ID'];
                                $Collect_Date = date_create_from_format(format: "Y-m-d H:i:s", datetime: $row["Collect_Date"])->format(format: "d/m/Y");
                                $EggAmount = $row['EggAmount'];
                            ?>
                                <tr>
                                    <td><?php echo $Collect_ID; ?></td>
                                    <td><?php echo $Collect_Date; ?></td>
                                    <td><?php echo $EggAmount; ?></td>

                                    <!--แก้ไข-->
                                    <td>
                                        <button type="button" class="btn" data-bs-toggle="modal" style="height:30px; width:46%; padding: 1px;"
                                            data-bs-target="#EditCollectModal<?= $Collect_ID; ?>">
                                            <i class='far fa-edit' style='color:blue; font-size:16px;'></i>
                                        </button>

                                        <!--Start Edit-->
                                        <div class="modal fade" id="EditCollectModal<?= $Collect_ID; ?>" tabindex="-1" aria-labelledby="EditCollectModalLabel<?= $Collect_ID; ?>" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="EditCollectModalLabel<?= $Collect_ID; ?>">แก้ไขข้อมูล</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- Form for Editing Record -->
                                                        <form id="EditCollectForm" action="Update_Collect.php" method="post">
                                                            <!-- Add your form fields here for additional request details -->

                                                            <input type="hidden" name="Collect_ID" class="form-control" id="Collect_ID" value="<?php echo $Collect_ID; ?>" readonly>

                                                            <div class="form-floating mb-3">
                                                                <input type="DateTime-local" class="form-control" id="Collect_Date" name="Collect_Date" value="<?php echo $Collect_Date; ?>" placeholder required>
                                                                <label class="form-label">วันที่เก็บ</label>
                                                            </div>

                                                            <div class="form-floating mb-3">
                                                                <input type="number" class="form-control" id="EggAmount" name="EggAmount" value="<?php echo $EggAmount; ?>" placeholder required>
                                                                <label for="form-label">จำนวน (ฟอง)</label>
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

                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-xl-12 mt-2">
            <div class="bg-light text-center rounded p-4 mb-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0 text-dark">จำนวนไข่ไก่ที่เก็บได้</h6>
                </div>
                <canvas id="Collect_Chart" style="max-width:100%; max-height:500px;"></canvas>
            </div>
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
    var HarvestID;

    // ฟังก์ชันเพื่อรับค่า member_ID เมื่อคลิกที่ปุ่ม "ลบ"
    function CollectID(Collect_ID) {
        CollectID = Collect_ID;
    }

    function deleteHarvest() {

        // ถ้ายืนยันการลบ ทำการ redirect ไปยังไฟล์ planting_delete.php พร้อมส่งค่า id ของแถวที่ต้องการลบ
        window.location.href = "Delete_Collect.php?id=" + CollectID;

    }
</script>