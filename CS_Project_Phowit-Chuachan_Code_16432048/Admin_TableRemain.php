<div class="container-fluid pt-4 px-4 rounded">
    <div class="text-center h-100 rounded bg-light p-3">
        <div class="d-flex align-items-center justify-content-between mb-2">

            <h6 class="text-dark col-5">ตารางแสดงจำนวนไก่ไข่ในโรงเรือนแต่ละสายพันธุ์</h6>
            <div class="col-2"></div>
            <?php
            require_once("connect_db.php");

            $sql = "SELECT Total FROM `total` ORDER BY `Total_Date` DESC LIMIT 1;";

            $result = $conn->query($sql);

            while ($row = $result->fetch_assoc()) {
                $Total = $row['Total'];
            }
            ?>
            <p class="col-5">จำนวนไก่ไข่ในโรงเรือนทั้งหมด <?php echo $Total ?> ตัว</p>

        </div>

        <div class="table-responsive">
            <?php

            $end_Page = 0;
            // ----------------- ส่วน Pagination Logic -----------------
            $records_per_page = 7; // จำนวนข้อมูลที่จะแสดงต่อหน้า

            // ตรวจสอบหน้าปัจจุบันจาก URL
            if (isset($_GET['page']) && is_numeric($_GET['page'])) {
                $current_page = $_GET['page'];
            } else {
                $current_page = 1; // ถ้าไม่มีการระบุหน้า ให้ถือว่าเป็นหน้าแรก
            }

            // คำนวณจุดเริ่มต้น (OFFSET) สำหรับการดึงข้อมูล
            $offset = ($current_page - 1) * $records_per_page;

            $sql0 = "WITH Ranked AS (
                    SELECT *, ROW_NUMBER() 
                    OVER (PARTITION BY Breed_ID ORDER BY Remain_Date DESC) AS rn FROM remain)
                    SELECT Ranked.*, breed.Breed_Name
                    AS total
                    FROM Ranked 
                    INNER JOIN breed ON breed.Breed_ID = Ranked.Breed_ID
                    WHERE rn = 1;
                    ";

            $result0 = mysqli_query($conn, $sql0);

            if (!$result0) {
                echo "Error: " . mysqli_error($conn);
            }

            // ดึงจำนวนข้อมูลทั้งหมดในตาราง เพื่อคำนวณจำนวนหน้าทั้งหมด
            $row_total = $result0->fetch_assoc();

            if ($row_total > 0) {
                $total_records = mysqli_num_rows($result0);
                // คำนวณจำนวนหน้าทั้งหมด
                $total_pages = ceil($total_records / $records_per_page);
            }

            $sql1 = "WITH Ranked AS (
                    SELECT *, ROW_NUMBER() 
                    OVER (PARTITION BY Breed_ID ORDER BY Remain_Date DESC) AS rn FROM remain)
                    SELECT Ranked.*, breed.Breed_Name 
                    FROM Ranked 
                    INNER JOIN breed ON breed.Breed_ID = Ranked.Breed_ID
                    WHERE rn = 1
                    LIMIT $records_per_page OFFSET $offset";

            $result1 = $conn->query($sql1);
            ?>

            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-dark" style="font-size:14px">
                        <th scope="col" class="col-7">สายพันธุ์</th>
                        <th scope="col" class="col-2">จำนวน (ตัว)</th>
                        <th scope="col" class="col-3">วันที่บันทึกล่าสุด</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result1 && mysqli_num_rows($result1) > 0) {
                        $end_Page = +1;
                        while ($row = $result1->fetch_assoc()) {
                            $Breed_Name = $row['Breed_Name'];
                            $Remain_Amount = $row['Remain_Amount'];
                            $Remain_Date = $row['Remain_Date'];
                            $Remain_Date_Format = date_create_from_format(format: "Y-m-d H:i:s", datetime: $row["Remain_Date"])->format(format: "d/m/Y H:i:s");
                    ?>
                            <tr style="font-size:12px">
                                <td><?php echo $Breed_Name; ?></td>
                                <td><?php echo $Remain_Amount; ?></td>
                                <td><?php echo $Remain_Date_Format; ?></td>
                            </tr>
                    <?php }
                    } else {
                        $end_Page = -$end_Page;
                        echo "<tr><td colspan='4' class='text-center'>ไม่พบข้อมูล</td></tr>";
                    }
                    ?> <!-- close php-->
                </tbody>
            </table>
            <?php
            // ----------------- ส่วนแสดง Pagination Links -----------------
            echo "<div class='pagination'>";

            // เราจะสร้างตัวแปรเพื่อเก็บพารามิเตอร์เดือน
            $month_param = '';
            if (!empty($selected_month)) {
                $month_param = '&month=' . urlencode($selected_month); // ใช้ urlencode เพื่อให้ปลอดภัยถ้ามีอักขระพิเศษ
            }

            // เราจะสร้างตัวแปรเพื่อเก็บพารามิเตอร์ปี
            $year_param = '';
            if (!empty($selected_year)) {
                $year_param = '&year=' . urlencode($selected_year); // ใช้ urlencode เพื่อให้ปลอดภัยถ้ามีอักขระพิเศษ
            }

            // ปุ่ม Previous
            if ($current_page > 1) {
                echo "<a href='?page=" . ($current_page - 1) . $month_param . $year_param . "' class='page-link'>&laquo; ก่อนหน้า</a>";
            } else {
                echo "<a class = 'p-2'>หน้าแรก</a>";
            }

            // ปุ่ม Next
            if ($end_Page > 0) {
                echo "<a href='?page=" . ($current_page + 1) . $month_param . $year_param . "' class='page-link'>ถัดไป &raquo;</a>";
            } else {
                echo "<a class = 'p-2'>หน้าสุดท้าย</a>";
            }
            echo "</div>";
            ?>
        </div>


    </div>
</div>