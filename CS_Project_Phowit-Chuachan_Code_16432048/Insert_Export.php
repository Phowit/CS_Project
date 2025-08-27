<?php
    // ตรวจสอบว่ามีการส่งข้อมูลมาจากฟอร์มหรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // เชื่อมต่อฐานข้อมูล
    require_once("connect_db.php");

    // เริ่ม รับข้อมูลจากฟอร์ม ---------------------------------------------
    $Breed_ID = $_POST['Breed_ID'];

    $Export_Date = $_POST['Export_Date'];
    $Export_Amount = $_POST['Export_Amount'];
    $Export_Details = $_POST['Export_Details'];
    // จบ รับข้อมูลจากฟอร์ม ---------------------------------------------



    // เริ่ม ส่วนการตรวจสอบค่า ---------------------------------------------
    $Check_Amount_SQL = "   SELECT
                            `Remain_Amount`,
                            i.import_ID
                            FROM `remain` AS r
                            JOIN import AS i ON i.import_ID = r.Import_ID
                            JOIN breed AS b ON b.Breed_ID = i.Breed_ID
                            WHERE b.Breed_ID = $Breed_ID
                            ORDER BY `Remain_ID` DESC LIMIT 1
                        ";

    $Check_Amount_Result = mysqli_query($conn,$Check_Amount_SQL);

    while($row = $Check_Amount_Result->fetch_assoc()){
        $Old_Remain_Amount = $row['Remain_Amount'];
        $Old_Import_ID = $row['import_ID'];
    }

    //ถ้าค่านำออกน้อยกว่าหรือเท่ากันกับค่าที่เหลือทั้งหมดให้
    if( $Export_Amount <= $Old_Remain_Amount ){

        // 1. เพิ่มข้อมูลการนำออกไก่ไข่ +++++
        $sql = "   INSERT into export (Export_Date,Export_Amount,Export_Details)
                    values('$Export_Date','$Export_Amount','$Export_Details')   ";

        mysqli_query($conn,$sql);

        // 2. เริ่ม คำนวนค่า remain ใหม่และเพิ่มอีก 1 remain โดย +++++
            // 2.1. ดึงค่า export_id ล่าสุดที่พึ่งเพิ่มไปเมื่อสักครู่มาใส่
            $New_ExportID_SQL = "SELECT `Export_ID` FROM `export` ORDER BY `Export_ID` DESC LIMIT 1";

            $New_ExportID_Result = mysqli_query($conn,$New_ExportID_SQL);

            while($row = $New_ExportID_Result->fetch_assoc()){
                $New_Export_ID = $row['Export_ID'];
            }
        
            // 2.2. คำนวน 
            $New_Remain_Amount = $Old_Remain_Amount - $Export_Amount;

            // 2.3. เพิ่มค่า remain ใหม่
            $New_Remain_SQL = " INSERT INTO `remain`(`Remain_Amount`,`Import_ID`, `Export_ID`) 
                                VALUES ('$New_Remain_Amount','$Old_Import_ID','$New_Export_ID') ";

            mysqli_query($conn,$New_Remain_SQL); 
        // 2. จบ คำนวนค่า remain ใหม่และเพิ่มอีก 1 remain โดย +++++


        // เริ่ม คำนวนค่า total ในตาราง total ใหม่--------------------------------------------------
                $sql1 = "   WITH Ranked AS (
                                SELECT
                                    r.*,
                                    i.Breed_ID,
                                    ROW_NUMBER() OVER (PARTITION BY i.Breed_ID ORDER BY r.Remain_ID DESC) AS rn
                                FROM remain r
                                INNER JOIN import i ON r.import_ID = i.import_ID
                            )
                            SELECT
                                Ranked.*,
                                b.Breed_Name
                            FROM Ranked
                            INNER JOIN breed AS b ON b.Breed_ID = Ranked.Breed_ID
                            WHERE Ranked.rn = 1
                            ";  //เลือกค่า remain ทั้งหมดมา โดยที่ สายพันธุ์ไม่ซ้ำ และเป็นค่าล่าสุดของแต่ละสายพันธุ์เท่านั้น
                                //เพื่อนำมาคำนวนค่า total ใหม่ทุกๆครั้ง แทนการตรวจสอบว่าค่าเพิ่มหรือลด เพื่อความเสถียร์ของข้อมูล

                $result1 = $conn->query($sql1); // นำค่ามาเก็บไว้

                $total_amount = 0; // ตัวแปรเก็บผลรวม

                if ($result1->num_rows > 0) {
                    while ($row = $result1->fetch_assoc()) {
                        $total_amount += $row['Remain_Amount']; // รวมค่า
                    }
                }

                $sql2 = "INSERT INTO `total`(`Total`) VALUES ('$total_amount');";   // เพิ่มค่าใหม่เข้าไปในฐาน
                mysqli_query($conn, $sql2);
            // จบ คำนวนค่า total ในตาราง total ใหม่ --------------------------------------------------

        // ปิดการเชื่อมต่อ
        mysqli_close($conn);

        // เปลี่ยนหน้า
        echo '<meta http-equiv="refresh" content="0; url=Admin_ManageExport.php">';

    } else {
        echo"

            <script>
            document.addEventListener('DOMContentLoaded', function() {
                let modal = document.getElementById('errorModal');
                modal.style.display = 'block';
            });
            </script>
        ";

        
        // ปิดการเชื่อมต่อ
        mysqli_close($conn);

        // เปลี่ยนหน้า
        echo '<meta http-equiv="refresh" content="3; url=Admin_ManageExport.php">';
    }
    // จบ ส่วนการตรวจสอบค่า ---------------------------------------------


}

/*
echo "ส่วนการตรวจสอบ <br>";
echo "SQLi =" . $sqli ."คือการเพิ่ม import <br>";
echo "SQL0 =" . $sql0 ."ดึง remain ล่าสุดมา <br>";
echo "SQL1 =" . $sql1 ."เพิ่ม remain ใหม่ไป โดยรวมกับค่าเก่าแล้ว แต่ยังไม่ให้เข้าฐาน <br>";
echo "SQL2 =" . $sql2 ."รวมค่า total จะได้" . $total_amount . "<br>";
echo "SQL3 =" . $sql3 ."เพิ่มค่า total" . "<br>";
echo "New_Remain_Amount" . $New_Remain_Amount . "=" . $Old_Remain_Amount . "+" . $Import_Amount . "<br>";
echo "ผลรวมของ Remain_Amount: " . $total_amount;
*/

?>
<div id="errorModal" style="display:none; position:fixed; top:30%; left:50%; transform:translate(-50%, -50%);
                             background-color:white; padding:20px; border:1px solid #ccc; z-index:1000; box-shadow: 0 0 10px rgba(0,0,0,0.5);">
    <p style="color:red;">❌ จำนวนไก่ไข่ไม่ถูกต้อง</p>
    <p>จำนวนไก่ไข่ที่นำออกมีมากกว่าจำนวนที่เหลือ</p>
    <a>โปรดระบุจำนวนไก่ไข่ที่นำออกให้ถูกต้อง</a>
</div>