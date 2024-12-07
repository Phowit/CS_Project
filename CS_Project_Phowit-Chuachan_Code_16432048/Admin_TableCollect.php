<div class="container-fluid pt-4 px-4">
    <div class="h-100 bg-light rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-4">ข้อมูลการเก็บไข่</h6>

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
                        collect.`EggAmount`,
                        admin.`Admin_ID`,
                        admin.Admin_Name
                    FROM collect 
                    INNER JOIN admin ON collect.Admin_ID = admin.Admin_ID;";
            $result = mysqli_query($conn, $sql);
            ?>
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-dark" style="font-size: 14px;">
                        <th scope="col" class="col-1">รหัส</th>
                        <th scope="col" class="col-3">วันที่เก็บ</th>
                        <th scope="col" class="col-2">จำนวน (ฟอง)</th>
                        <th scope="col" class="col-3">ผู้ดูแล</th>
                        <th scope="col" class="col-1">แก้ไข</th>
                        <th scope="col" class="col-1">ลบ</th>
                    </tr>
                </thead>
                <tbody style="font-size: 13px;">
                    <?php
                    while ($row = $result->fetch_assoc()) {
                        $Collect_ID = $row['Collect_ID'];
                        $Collect_Date = date_create_from_format(format: "Y-m-d H:i:s", datetime: $row["Collect_Date"]) ->format(format: "d/m/Y H:i");
                        $EggAmount = $row['EggAmount'];
                        $Admin_Name = $row['Admin_Name'];
                    ?>
                        <tr>
                            <td><?php echo $Collect_ID; ?></td>
                            <td><?php echo $Collect_Date; ?></td>
                            <td><?php echo $EggAmount; ?></td>
                            <td><?php echo $Admin_Name; ?></td>
                            <td> <a class="btn btn-sm btn-primary col-12" href="">แก้ไข</a> </td>

                            <td>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" onclick="CollectID(<?= $Collect_ID; ?>)" data-bs-target="#confirmDeleteModal">ลบ</button>
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
                                            <button type="button" class="btn btn-danger" onclick="deleteHarvest()">ยืนยัน</button>
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