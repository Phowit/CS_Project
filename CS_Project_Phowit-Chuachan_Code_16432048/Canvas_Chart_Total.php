<div class="col-12">
    <div class="container-fluid pt-3 px-2">
        <div class="bg-light text-center rounded p-2">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0 text-dark">จำนวนไก่ในโรงเรือนทั้งหมด</h6>

                <?php
                $sql = "SELECT `Total` FROM `total` ORDER BY `Total_Date` DESC LIMIT 1";

                $result = mysqli_query($conn, $sql);

                while ($row = $result->fetch_assoc()) {
                    $Total = $row['Total'];
                }
                ?>

                <a><?php echo "ปัจจุบัน " . $Total . " ตัว"; ?></a>
            </div>
            <canvas id="Total_Chart" style="max-width:100%; max-height:200px;"></canvas>
        </div>
    </div>
</div>