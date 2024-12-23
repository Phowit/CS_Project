<div class="container-fluid pt-4 px-4">
    <div class="h-100 bg-light rounded p-4">

        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">ข้อมูลการเก็บไข่</h6>
        </div>

        <div class="table-responsive">
            <?php
                require_once("connect_db.php");
                $sql = "select `Harvest_ID`,`Date_Harvest`,`EggAmount`,harvest.Admin_ID, `Admin_Name`
                        from Harvest 
                        INNER JOIN admin ON harvest.Admin_ID = admin.Admin_ID;" ;
                $result = mysqli_query($conn,$sql);
            ?>  

            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-dark">
                        <th scope="col">รหัส</th>
                        <th scope="col">วันที่เก็บ</th>
                        <th scope="col">จำนวน</th>
                        <th scope="col">ผู้ดูแลที่บันทึก</th>
                    </tr>
                </thead>

                <tbody>
                <?php
                        while($row = $result->fetch_assoc()){
                        $Harvest_ID = $row['Harvest_ID'];
                        $Date_Harvest = $row['Date_Harvest'];
                        $EggAmount = $row['EggAmount'];
                        $Admin_Name = $row['Admin_Name'];
                    ?>
                        <tr>
                            <td><?php echo $row['Harvest_ID'];?></td>
                            <td><?php echo $row['Date_Harvest'];?></td>
                            <td><?php echo $row['EggAmount'];?></td>
                            <td><?php echo $row['Admin_Name'];?></td>
                        </tr>
                    <?php }?>
                </tbody>

            </table>
            
        </div>
    </div>
</div>