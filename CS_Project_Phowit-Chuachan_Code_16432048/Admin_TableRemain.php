<div class="container-fluid pt-3 px-2 rounded">
    <div class="text-center h-100 rounded bg-light p-2">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6>จำนวนไก่แต่ละสายพันธุ์</h6>
        </div>

        <div class="table-responsive">
            <?php
            require_once("connect_db.php");

            $sql = "WITH Ranked AS (
                    SELECT *, ROW_NUMBER() 
                    OVER (PARTITION BY Breed_ID ORDER BY Remain_Date DESC) AS rn FROM remain)
                    SELECT Ranked.*, breed.Breed_Name 
                    FROM Ranked 
                    INNER JOIN breed ON breed.Breed_ID = Ranked.Breed_ID
                    WHERE rn = 1;
                    ";

            $result = mysqli_query($conn, $sql);
            ?>

            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-dark" style="font-size:14px">
                        <th scope="col" class="col-8">สายพันธุ์</th>
                        <th scope="col" class="col-1">จำนวน</th>
                        <th scope="col" class="col-3">วันที่บันทึกล่าสุด</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = $result->fetch_assoc()) {
                        $Breed_Name = $row['Breed_Name'];
                        $Remain_Amount = $row['Remain_Amount'];
                        $Remain_Date = date_create_from_format(format: "Y-m-d", datetime: $row["Remain_Date"])->format(format: "d/m/Y");
                    ?>
                        <tr style="font-size:12px">
                            <td><?php echo $Breed_Name; ?></td>
                            <td><?php echo $Remain_Amount; ?> ตัว</td>
                            <td><?php echo $Remain_Date; ?></td>
                        </tr>
                    <?php } ?> <!-- close php-->
                </tbody>
            </table>
        </div>


    </div>
</div>

<script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    var btn = document.getElementById("myBtn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("btn-close")[0];

    // When the user clicks on the button, open the modal
    btn.onclick = function() {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>

<script>
    var ImportID;

    // ฟังก์ชันเพื่อรับค่า member_ID เมื่อคลิกที่ปุ่ม "ลบ"
    function ImportID(Import_ID) {
        ImportID = Import_ID;
    }

    function deleteImportData() {

        // ถ้ายืนยันการลบ ทำการ redirect ไปยังไฟล์ planting_delete.php พร้อมส่งค่า id ของแถวที่ต้องการลบ
        window.location.href = "Delete_Import.php?id=" + ImportID;

    }
</script>