<div class="container-fluid pt-4 px-4">
    <div class="h-100 bg-light rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">ข้อมูลประวัติการทำงานย้อนหลัง</h6>
        </div>
        
        <div class="table-responsive">
            <?php
                require_once("connect_db.php");
                $sql = "SELECT 
                        `status_ID`,
                        `ServoMoter`,
                        `BallValve_Tem`,
                        `BallValve_water`,
                        `BallValve_SFood`,
                        `FoodLevel`,
                        `FoodSLevel`,
                        `T_Level`,
                        `FoodTray1`,
                        `FoodTray2`,
                        `DT_record`,
                        `Admin_Name`
                        FROM status
                        INNER JOIN admin ON status.`Admin_ID` = admin.`Admin_ID`
                        ORDER BY DT_record DESC;
                        ";
                $result = mysqli_query($conn,$sql);
            ?>
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-dark">
                        <th scope="col" class="col-1" style="font-size: 14px;">รหัสชุดข้อมูล</th>
                        <th scope="col" class="col-1.5" style="font-size: 14px;">ระบบให้อาหาร</th>
                        <th scope="col" class="col-1.5" style="font-size: 14px;">สปริงเกอร์</th>
                        <th scope="col" class="col-1.5" style="font-size: 14px;">ระบบให้น้ำดื่ม</th>
                        <th scope="col" class="col-1.5" style="font-size: 14px;">ระบบให้อาหารเสริม</th>
                        <th scope="col" class="col-2" style="font-size: 14px;">เวลาที่บันทึก</th>
                        <th scope="col" class="col-3" style="font-size: 14px;">ผู้ดูแลที่บันทึก</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if ($result->num_rows > 0) {
                            // วนลูปเพื่อดึงข้อมูลทีละแถว
                            while($row = $result->fetch_assoc()) {
                                // แปลงค่า 0 และ 1 เป็นคำว่า ปิด และ เปิด
                                $status_ID = $row['status_ID'];
                                $ServoMoter = $row["ServoMoter"] == 0 ? "ปิด" : "เปิด";
                                $BallValve_Tem = $row["BallValve_Tem"] == 0 ? "ปิด" : "เปิด";
                                $BallValve_water = $row["BallValve_water"] == 0 ? "ปิด" : "เปิด";
                                $BallValve_SFood = $row["BallValve_SFood"] == 0 ? "ปิด" : "เปิด";
                                $DT_record = date_create_from_format(format: "Y-m-d H:i:s", datetime: $row["DT_record"]) ->format(format: "d/m/Y");
                                $Admin_Name = $row['Admin_Name'];
                    ?>
                    <tr>
                        <td style="font-size: 13px;"><?php echo $row['status_ID'];?></td>
                        <td style="font-size: 13px;"><?php echo $ServoMoter;?></td>
                        <td style="font-size: 13px;"><?php echo $BallValve_Tem;?></td>
                        <td style="font-size: 13px;"><?php echo $BallValve_water;?></td>
                        <td style="font-size: 13px;"><?php echo $BallValve_SFood;?></td>
                        <td style="font-size: 13px;"><?php echo $DT_record;?></td>
                        <td style="font-size: 13px;"><?php echo $Admin_Name;?></td>
                    </tr>
                    <?php }} else {
                                echo "ไม่พบข้อมูล";}?> <!-- close php-->
                </tbody>
            </table>
        </div>
    </div>
</div>
