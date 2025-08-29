<?php

require_once("connect_db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" ) {

$Delete_Export_ID = $_POST['Delete_Export_ID'];
$Delete_Export_Amount = $_POST['Delete_Export_Amount'];

if ($Delete_Export_ID > 0 AND $Delete_Export_Amount > 0) {
    // เริ่ม ส่วนการลบข้อมูลการนำออกไก่ไข่ -------------------------------------------------------------------------------
    $Export_Updare_SQL = " UPDATE `export` SET `Export_Delete`='1' WHERE `Export_ID` = $Delete_Export_ID ";

    if (mysqli_query($conn, $Export_Updare_SQL)){
        //echo "การลบเสร็จสิ้น" ;
    } else {
        echo " เกิดข้อผิดพลาดในการลบข้อมูล " . mysqli_error($conn);
    }
    // จบ ส่วนการลบข้อมูลการนำออกไก่ไข่ -------------------------------------------------------------------------------


    // เริ่ม ส่วนการหักค่าออกจากตาราง remain -----------------------------------------------------
    $Latest_Remain_SQL = "SELECT * FROM `remain` WHERE `Export_ID` = $Delete_Export_ID ORDER BY `Remain_ID`DESC LIMIT 1";

    $Latest_Remain_result = mysqli_query($conn, $Latest_Remain_SQL);

    while ($row = $Latest_Remain_result->fetch_assoc()) {
        $Remain_Amount = $row['Remain_Amount'];
        $Import_ID = $row['Import_ID'];
    }

    $New_Remain_Amount = $Remain_Amount + $Delete_Export_Amount;

    $New_Remain_SQL = "INSERT INTO `remain`(`Remain_Amount`, `Import_ID`, `Export_ID`) VALUES ('$New_Remain_Amount','$Import_ID','$Delete_Export_ID')";

    mysqli_query($conn, $New_Remain_SQL);
    // จบ ส่วนการหักค่าออกจากตาราง remain -----------------------------------------------------


    // เริ่ม คำนวนค่า total ในตาราง total ใหม่--------------------------------------------------
        $sql = "   SELECT
                    r1.*,
                    b.Breed_Name
                FROM remain r1
                INNER JOIN import i ON r1.Import_ID = i.Import_ID
                INNER JOIN breed b ON i.Breed_ID = b.Breed_ID
                JOIN (
                    SELECT
                        i.Breed_ID,
                        MAX(r2.Remain_Date) AS max_date
                    FROM remain r2
                    INNER JOIN import i ON r2.Import_ID = i.Import_ID
                    GROUP BY i.Breed_ID
                ) AS subquery ON i.Breed_ID = subquery.Breed_ID AND r1.Remain_Date = subquery.max_date;
                ";  //เลือกค่า remain ทั้งหมดมา โดยที่ สายพันธุ์ไม่ซ้ำ และเป็นค่าล่าสุดของแต่ละสายพันธุ์เท่านั้น
        //เพื่อนำมาคำนวนค่า total ใหม่ทุกๆครั้ง แทนการตรวจสอบว่าค่าเพิ่มหรือลด เพื่อความเสถียร์ของข้อมูล

        $result = $conn->query($sql); // นำค่ามาเก็บไว้

        $total_amount = 0; // ตัวแปรเก็บผลรวม

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $total_amount += $row['Remain_Amount']; // รวมค่า
            }
        }

        $sql = "INSERT INTO `total`(`Total`) VALUES ('$total_amount');";   // เพิ่มค่าใหม่เข้าไปในฐาน
        mysqli_query($conn, $sql);
    // จบ คำนวนค่า total ในตาราง total ใหม่ --------------------------------------------------
}
} else {
    echo "No Export ID";
}

// ปิดการเชื่อมต่อ
mysqli_close($conn);

// เปลี่ยนหน้า
echo '<meta http-equiv="refresh" content="0; url= Admin_ManageExport.php">';

?>