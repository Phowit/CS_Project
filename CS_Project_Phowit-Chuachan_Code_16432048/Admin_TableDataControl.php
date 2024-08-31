<div class="container-fluid pt-4 px-4">
    <div class="h-100 bg-light rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">ข้อมูลชุดคำสั่งควบคุมเวลา</h6>
        </div>
        <div class="table-responsive">
            <?php
                require_once("connect_db.php");
                $sql = "select * from datacontrol ";
                $result = mysqli_query($conn,$sql);
            ?>
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-dark">
                        <th scope="col" class="col-1">รหัสชุดควบคุม</th>
                        <th scope="col" class="col-1">อุณหภูมิไม่เกิน</th>
                        <th scope="col" class="col-2">รอบให้อาหาร</th>
                        <th scope="col" class="col-2">เวลาให้น้ำ</th>
                        <th scope="col" class="col-3">เวลาให้อาหารเสริม</th>
                        <th scope="col" class="col-2">ระดับอาหาร<br>ในถาด(%)</th>
                        <th scope="col" class="col-1">ผู้ดูแลที่บันทึก</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                        while($row = $result->fetch_assoc()){
                            $DateControl_ID = $row['DateControl_ID'];
                            $Temperature_range = $row['Temperature_range'];
                            $TimeFoodS = $row['TimeFoodS'];
                            $FoodTray_rang = $row['FoodTray_rang'];
                            $TimeFood_ID = $row['TimeFood_ID'];
                            $TimeWater = $row['TimeWater'];
                            $Admin_ID = $row['Admin_ID'];
                    ?>
                        <tr>
                            <td><?php echo $row['DateControl_ID'];?></td>
                            <td><?php echo $row['Temperature_range'];?></td>
                            <td><?php echo $row['TimeFood_ID'];?> รอบ</td>
                            <td><?php echo $row['TimeWater'];?></td>
                            <td><?php echo $row['TimeFoodS'];?></td>
                            <td><?php echo $row['FoodTray_rang'];?>%</td>
                            <td><?php echo $row['Admin_ID'];?></td>
                        </tr>
                    <?php }?> <!-- close php-->
                </tbody>
            </table>
        </div>
    </div>
</div>