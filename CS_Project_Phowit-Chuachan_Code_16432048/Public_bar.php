<?php
    require_once("connect_db.php");
    // ดึงข้อมูลจากตาราง
$sql = "SELECT FoodLevel, FoodSLevel, FoodTrayLevel1, FoodTrayLevel2, T_Level FROM status ORDER BY  DT_record DESC LIMIT 1";
$result = $conn->query($sql);
?>
<!-- progress start-->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <?php
                while ($row = $result->fetch_assoc()) {
                $FoodLevel = $row['FoodLevel'];
                $FoodSLevel = $row['FoodSLevel'];
                $FoodTrayLevel = $row['FoodTrayLevel1'];
                $FoodTrayLevel = $row['FoodTrayLevel2'];
                $T_Level = $row['T_Level'];
            ?>
                <div class="col-sm-6 col-xl-3">
                    <div class="bg-light rounded h-100 p-3">
                        <h6 class="mb-1 text-dark">ระดับอาหารหลักในถัง</h6>
                        <small><?php echo $row['FoodLevel']; ?> % ของถังเก็บ</small>
                    </div>
                </div>

                <div class="col-sm-6 col-xl-3">
                    <div class="bg-light rounded h-100 p-3">
                        <h6 class="mb-1 text-dark">ระดับอาหารในถาดอาหาร</h6>
                        <small><?php echo $row['FoodTrayLevel1']; ?>% ของถาดที่ 1</small><br>
                        <small><?php echo $row['FoodTrayLevel2']; ?>% ของถาดที่ 2</small>
                    </div>
                </div>

                <div class="col-sm-6 col-xl-3">
                    <div class="bg-light rounded h-100 p-3">
                        <h6 class="mb-1 text-dark">ระดับอาหารเสริม</h6>
                        <small><?php echo $row['FoodSLevel']; ?>% ของกระบอกเก็บ</small>
                    </div>
                </div>

                <div class="col-sm-6 col-xl-3">
                    <div class="bg-light rounded h-100 p-3">
                        <h6 class="mb-1 text-dark">ระดับอุณหภูมิ</h6>
                        <small><?php echo $row['T_Level']; ?> องศาเซลเซียส</small>
                    </div>
                </div>
            </div>

        <?php } ?>
    </div>

<!-- show from database end -->