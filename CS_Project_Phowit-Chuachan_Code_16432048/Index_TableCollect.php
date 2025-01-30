<div class="container-fluid pt-4 px-4">
    <div class="h-100 bg-light rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-4">ข้อมูลการเก็บไข่ไก่</h6>
        </div>
        <div class="table-responsive">
            <?php
            require_once("connect_db.php");
            $sql = "select 
                        collect.`Collect_ID`,
                        collect.`Collect_Date`,
                        collect.`EggAmount`
                    FROM collect 
                    ";
            $result = $conn->query($sql); // รับผลลัพธ์จากฐานข้อมูล

            ?>
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-dark" style="font-size: 14px;">
                        <th scope="col" class="col-1">รหัส</th>
                        <th scope="col" class="col-8">วันที่เก็บ</th>
                        <th scope="col" class="col-3">จำนวน</th>
                    </tr>
                </thead>
                <tbody style="font-size: 13px;">
                    <?php
                    while ($row = $result->fetch_assoc()) {
                        $Collect_ID = $row['Collect_ID'];
                        $Collect_Date = date_create_from_format(format: "Y-m-d H:i:s", datetime: $row["Collect_Date"])->format(format: "d/m/Y H:i");
                        $EggAmount = $row['EggAmount'];
                    ?>
                        <tr>
                            <td><?php echo $Collect_ID; ?></td>
                            <td><?php echo $Collect_Date; ?></td>
                            <td><?php echo $EggAmount; ?> ฟอง</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>