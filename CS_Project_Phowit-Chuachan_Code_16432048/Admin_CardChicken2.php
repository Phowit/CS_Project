
    <?php
    require_once("connect_db.php");
    $sql = "select 
            import.`Import_ID`,
            import.`Import_Date_Record`,
            import.`Import_Date`,
            import.`Import_Amount`,
            import.`Import_Details`,

            import.`User_ID`,
            user.`User_Name`,

            import.`Breed_ID`,
            breed.`Breed_Name`
            FROM import

            INNER JOIN user ON import.`User_ID` = user.`User_ID`
            INNER JOIN breed ON import.`Breed_ID` = breed.`Breed_ID`

            WHERE import.`User_ID` != ?;
                ";


    $stmt = $conn->prepare($sql); // เตรียมคำสั่ง SQL เพื่อป้องกัน SQL Injection
    $stmt->bind_param("i", $_SESSION['User_ID']); // ผูกค่าพารามิเตอร์
    $stmt->execute(); // รันคำสั่ง
    $result = $stmt->get_result(); // รับผลลัพธ์จากฐานข้อมูล

    while ($row = $result->fetch_assoc()) {
        $Import_ID = $row['Import_ID'];
        $Import_Date_Record = date_create_from_format(format: "Y-m-d H:i:s", datetime: $row["Import_Date_Record"])->format(format: "d/m/Y H:i");
        $Import_Date = date_create_from_format(format: "Y-m-d H:i:s", datetime: $row["Import_Date"])->format(format: "d/m/Y H:i");
        $Import_Amount = $row['Import_Amount'];
        $Import_Details = $row['Import_Details'];

        $User_Name = $row['User_Name']; // ดึงโดย User_ID

        $Breed_Name = $row['Breed_Name']; // ดึงโดย Breed_ID
    ?>
        
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h3 class="accordion-header" id="headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $Import_ID; ?>"
                        aria-expanded="false">

                        <div class="col-sm-12 col-xl-3">
                            <h6>รหัสการนำเข้า : <?php echo $Import_ID; ?></h6>
                        </div>

                        <div class="col-sm-12 col-xl-5">
                            <h6>สายพันธุ์ : <?php echo $Breed_Name; ?></h6>
                        </div>

                        <div class="col-sm-12 col-xl-4">
                            <h6>วันที่นำเข้า : <?php echo $Import_Date; ?></h6>
                        </div>


                    </button>
                </h3>

                <div id="collapse<?php echo $Import_ID; ?>" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">

                        <div class="row">
                            <div class="col-sm-12 col-xl-6">
                                <a>รายละเอียด : <?php echo $Import_Details; ?></a>
                            </div>

                            <div class="col-sm-12 col-xl-2">
                                <a>จำนวน : <?php echo $Import_Amount; ?> ตัว</a>
                            </div>

                            <div class="col-sm-12 col-xl-4">
                                <a>วันที่บันทึก : <?php echo $Import_Date_Record; ?></a>
                            </div>
                        </div>

                        <?php
                        require_once("connect_db.php");
                        $sql1 = "SELECT * FROM `export` WHERE `Import_ID` = ?;";

                        $stmt = $conn->prepare($sql1); // เตรียมคำสั่ง SQL เพื่อป้องกัน SQL Injection
                        $stmt->bind_param("i", $Import_ID); // ผูกค่าพารามิเตอร์
                        $stmt->execute(); // รันคำสั่ง
                        $result1 = $stmt->get_result(); // รับผลลัพธ์จากฐานข้อมูล

                        if (mysqli_num_rows($result1) == 0) {

                            echo "<h6 style='text-align: center;'>ไม่พบข้อมูลการส่งออก</h6>";
                        } else {
                        ?>
                            <table class="table text-start align-middle table-bordered table-hover mb-0">
                                <thead>
                                    <tr class="text-dark">
                                        <th scope="col" class="col-1">รหัส</th>
                                        <th scope="col" class="col-2.5">วัน เวลา <br> ที่บันทึก</th>
                                        <th scope="col" class="col-2.5">วัน เวลา <br> ที่นำออก</th>
                                        <th scope="col" class="col-2">จำนวน</th>
                                        <th scope="col" class="col-4">รายละเอียด</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($row = $result1->fetch_assoc()) {
                                        $Export_ID = $row['Export_ID'];
                                        $Export_Date_Record = date_create_from_format(format: "Y-m-d H:i:s", datetime: $row["Export_Date_Record"])->format(format: "d/m/Y H:i");
                                        $Export_Date = date_create_from_format(format: "Y-m-d H:i:s", datetime: $row["Export_Date"])->format(format: "d/m/Y H:i");
                                        $Export_Amount = $row['Export_Amount'];
                                        $Export_Details = $row['Export_Details'];
                                    ?>
                                        <tr>
                                            <td><?php echo $Export_ID; ?></td>
                                            <td><?php echo $Export_Date_Record; ?></td>
                                            <td><?php echo $Export_Date; ?></td>
                                            <td><?php echo $Export_Amount; ?> ตัว</td>
                                            <td><?php echo $Export_Details; ?></td>
                                        </tr>
                                <?php }
                                } ?> <!-- close php-->
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div><br>
    <?php } ?> <!-- close php-->

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
        var UserID;

        // ฟังก์ชันเพื่อรับค่า member_ID เมื่อคลิกที่ปุ่ม "ลบ"
        function UserID(User_ID) {
            UserID = User_ID;
        }

        function deleteAdmin() {

            // ถ้ายืนยันการลบ ทำการ redirect ไปยังไฟล์ planting_delete.php พร้อมส่งค่า id ของแถวที่ต้องการลบ
            window.location.href = "Delete_AdminData.php?id=" + UserID;

        }
    </script>