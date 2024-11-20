<div class="container-fluid pt-4 px-4">
    <div class="bg-light text-center rounded p-4">

        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">ข้อมูลไก่</h6>
        </div>

        <div class="table-responsive">
            <?php
                require_once("connect_db.php");
                $sql = "select `Set_ID`,`Date_in`,`Gene`,`Amount`,chickendata.`Admin_ID`,`Admin_Name`
                        from chickendata
                        INNER JOIN admin ON chickendata.Admin_ID = admin.Admin_ID;" ;
                $result = mysqli_query($conn,$sql);
            ?>  
             <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-dark">
                        <th scope="col">รหัส</th>
                        <th scope="col">วันที่นำเข้ามาเลี้ยง</th>
                        <th scope="col">สายพันธุ์ไก่</th>
                        <th scope="col">จำนวนทั้งหมด</th>
                        <th scope="col">ผู้ดูแลที่บันทึก</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    while ($row = $result->fetch_assoc()) {
                        $Set_ID = $row['Set_ID'];
                        $Date_in = $row['Date_in'];
                        $Gene = $row['Gene'];
                        $Amount = $row['Amount'];
                        $Admin_Name = $row['Admin_Name'];
                    ?>
                        <tr>
                            <td><?php echo $row['Set_ID']; ?></td>
                            <td><?php echo $row['Date_in']; ?></td>
                            <td><?php echo $row['Gene']; ?></td>
                            <td><?php echo $row['Amount']; ?></td>
                            <td><?php echo $row['Admin_Name']; ?></td>

                        </tr>
                    <?php } ?> <!-- close php-->
                </tbody>
            </table>
        </div>
        
    </div>
</div>