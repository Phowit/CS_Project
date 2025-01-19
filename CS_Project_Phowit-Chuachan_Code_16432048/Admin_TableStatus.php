<div class="pt-4" style="padding-left:4%;">
    <div class="h-100 bg-light rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">ประวัติการทำงาน</h6>
        </div>

        <div class="table-responsive">
            <?php
            require_once("connect_db.php");
            $sql = "SELECT 
                        `ServoMoter`,
                        `BallValve_Tem`,
                        `BallValve_water`,
                        `BallValve_SFood`,
                        `FoodLevel`,
                        `FoodSLevel`,
                        `T_Level`,
                        `FoodTray1`,
                        `FoodTray2`,
                        `DT_record`
                        FROM status
                        ORDER BY `DT_record` DESC;
                        ";
            $result = mysqli_query($conn, $sql);
            ?>
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-dark" style="font-size: 13px;">
                        <th scope="col" class="col-2">วัน เวลา</th>
                        <th scope="col" class="col-1.5">ระบบอาหารหลัก</th>
                        <th scope="col" class="col-1.5">สปริงเกอร์</th>
                        <th scope="col" class="col-1.5">ระบบน้ำดื่ม</th>
                        <th scope="col" class="col-1.5">ระบบอาหารเสริม</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        // วนลูปเพื่อดึงข้อมูลทีละแถว
                        while ($row = $result->fetch_assoc()) {
                            // แปลงค่า 0 และ 1 เป็นคำว่า ปิด และ เปิด
                            $DT_record = date_create_from_format(format: "Y-m-d H:i:s", datetime: $row["DT_record"])->format(format: "d/m/Y");
                            $ServoMoter = $row["ServoMoter"] == 0 ? "ปิด" : "เปิด";
                            $BallValve_Tem = $row["BallValve_Tem"] == 0 ? "ปิด" : "เปิด";
                            $BallValve_water = $row["BallValve_water"] == 0 ? "ปิด" : "เปิด";
                            $BallValve_SFood = $row["BallValve_SFood"] == 0 ? "ปิด" : "เปิด";
                    ?>
                            <tr style="font-size: 13px;">
                                <td><?php echo $DT_record; ?></td>
                                <td><?php echo $ServoMoter; ?></td>
                                <td><?php echo $BallValve_Tem; ?></td>
                                <td><?php echo $BallValve_water; ?></td>
                                <td><?php echo $BallValve_SFood; ?></td>
                            </tr>
                    <?php }
                    } else {
                        echo "ไม่พบข้อมูล";
                    } ?> <!-- close php-->
                </tbody>
            </table>
        </div>
    </div>
</div>