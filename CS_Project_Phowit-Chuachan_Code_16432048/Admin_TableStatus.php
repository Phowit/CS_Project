<div class="container-fluid pt-4 px-4">
    <div class="h-100 bg-light rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">ข้อมูลสถานะ</h6>
        </div>
        <div class="table-responsive">
            <?php
                require_once("connect_db.php");
                $sql = "select * from status ";
                $result = mysqli_query($conn,$sql);
            ?>
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-dark">
                        <th scope="col" class="col-3">รหัสควบคุมอุปกรณ์</th>
                        <th scope="col" class="col-2">ระบบให้อาหาร</th>
                        <th scope="col" class="col-2">สปริงเกอร์</th>
                        <th scope="col" class="col-2">ระบบให้น้ำดื่ม</th>
                        <th scope="col" class="col-2">ระบบให้อาหารเสริม</th>
                        <th scope="col" class="col-1">ผู้ดูแลที่บันทึก</th>
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
                                $DateControl_ID = $row['DateControl_ID'];
                                
                            
                    ?>
                    <tr>
                        <td><?php echo $row['status_ID'];?></td>
                        <td><?php echo $ServoMoter;?></td>
                        <td><?php echo $BallValve_Tem;?></td>
                        <td><?php echo $BallValve_water;?></td>
                        <td><?php echo $BallValve_SFood;?></td>
                        <td><?php echo $row['DateControl_ID'];?></td>
                    </tr>
                    <?php }} else {
                                echo "ไม่พบข้อมูล";}?> <!-- close php-->
                </tbody>
            </table>
        </div>
    </div>
</div>
