<?php
require_once("connect_db.php");

$Delete_Import_ID = $_POST['Delete_Import_ID'];
$Delete_Import_Amount = $_POST['Delete_Import_Amount'];

if ($Delete_Import_ID > 0) {

    // เริ่ม ลบข้อมูลการนำเข้า ออกจากตาราง -----------------------------------------------------
    $Import_Update_SQL = "UPDATE `import` SET `Import_Delete` = '1' WHERE `import_ID` = $Delete_Import_ID";

    if (mysqli_query($conn, $Import_Update_SQL)) {
        //echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
    // จบ ลบข้อมูลการนำเข้า ออกจากตาราง -----------------------------------------------------



    // เริ่ม ส่วนการหักค่าออกจากตาราง remain -----------------------------------------------------
    $Latest_Remain_SQL = "SELECT * FROM `remain` WHERE `Import_ID` = $Delete_Import_ID ORDER BY `Remain_ID`DESC LIMIT 1";

    $Latest_Remain_result = mysqli_query($conn, $Latest_Remain_SQL);

    while ($row = $Latest_Remain_result->fetch_assoc()) {
        $Remain_Amount = $row['Remain_Amount'];
        $Export_ID = $row['Export_ID'];
    }

    $New_Remain_Amount = $Remain_Amount - $Delete_Import_Amount;

    $New_Remain_SQL = "INSERT INTO `remain`(`Remain_Amount`, `Import_ID`, `Export_ID`) VALUES ('$New_Remain_Amount','$Delete_Import_ID','$Export_ID')";

    mysqli_query($conn, $New_Remain_SQL);
    // จบ ส่วนการหักค่าออกจากตาราง remain -----------------------------------------------------



    // เริ่ม คำนวนค่า total ในตาราง total ใหม่--------------------------------------------------
        $sql = "   SELECT
                    r1.*,
                    b.Breed_Name
                FROM remain r1
                INNER JOIN import i ON r1.import_ID = i.import_ID
                INNER JOIN breed b ON i.Breed_ID = b.Breed_ID
                JOIN (
                    SELECT
                        i.Breed_ID,
                        MAX(r2.Remain_Date) AS max_date
                    FROM remain r2
                    INNER JOIN import i ON r2.import_ID = i.import_ID
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

} else {
    echo "No Breed ID provided";
}

//echo $sql;

// ปิดการเชื่อมต่อ
mysqli_close($conn);

// เปลี่ยนหน้า
echo '<meta http-equiv="refresh" content="0; url= Admin_ManageImport.php">';

?>