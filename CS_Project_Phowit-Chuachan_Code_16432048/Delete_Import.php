<?php
require_once("connect_db.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // เริ่ม การหักลบค่าออกจากฐาน remain

    $sql = "SELECT * FROM `import` WHERE `Import_ID` = $id";    // เลือกค่ามาจาก Import_ID
    $result = mysqli_query($conn, $sql);          // เพื่อนำค่าเหล่านั้นไปทำการลบ

    while($row = $result->fetch_assoc()){
        $Import_Amount = $row['Import_Amount'];                 // จำนวนที่กำลังจะหายไป
        $Breed_ID = $row['Breed_ID'];                           // สายพันธุ์ที่ต้องการลบ นำไปใช้ในข้อต่อไป
    }

    $sqli = "SELECT * FROM `remain` WHERE `Breed_ID` = '$Breed_ID' ORDER BY `Remain_Date` DESC LIMIT 1";
    $resulti = mysqli_query($conn, $sqli);        // เลือกมาเพียง 1 ชุด ล่าสุด ที่สายพันธุ์ตรงตามต้องการ

    while($row = $resulti->fetch_assoc()){
        $Old_Remain_Amount = $row['Remain_Amount'];             // นำค่าเก่ามาเพื่อเตรียมหักลบกับค่าที่จะหายไป
        $Remain_Date = $row['Remain_Date'];                     // นำวันเวลามา เพื่อยังคงเวลาเดิมไว้ ไม่ให้เวลาเปลี่ยน หรือหาย
        $remain_ID = $row['remain_ID'];                         // id เพื่อแก้ให้ถูกชุดข้อมูล และลดความซับซ้อนของ code
    }

    $New_Remain_Amount = $Old_Remain_Amount - $Import_Amount;   // ค่าใหม่ที่หักลบแล้ว

    $sql0 = "   UPDATE `remain` 
                SET
                `Remain_Amount`='$New_Remain_Amount',
                `Remain_Date`='$Remain_Date'
                WHERE `remain_ID` = '$remain_ID' ;
            ";                                                  // แก้ไขแทนการลบ เพื่อให้ไม่เกิดความซับซ้อนของข้อมูล โดยยังคงเวลาเดิมเอาไว้

    mysqli_query($conn, $sql0);
    // จบ การหักลบค่าออกจากฐาน remain



    // เริ่ม การหักลบค่าออกจากฐาน ในตาราง total
    $sql1 = "   SELECT r1.*
                FROM remain r1
                JOIN (SELECT Breed_ID, MAX(Remain_Date) AS max_date FROM remain GROUP BY Breed_ID)
                r2 ON r1.Breed_ID = r2.Breed_ID AND r1.Remain_Date = r2.max_date;
                ";                         //เลือกค่า remain ทั้งหมดมา โดยที่ สายพันธุ์ไม่ซ้ำ และเป็นค่าล่าสุดของแต่ละสายพันธุ์เท่านั้น

    $result1 = $conn->query($sql1); // นำค่ามาเก็บไว้

    $total_amount = 0; // ตัวแปรเก็บผลรวม

    if ($result1->num_rows > 0) {
        while ($row = $result1->fetch_assoc()) {
            $total_amount += $row['Remain_Amount']; // รวมค่า
        }
    }

    $sql2 = "INSERT INTO `total`(`Total`) VALUES ('$total_amount');";   // เพิ่มค่าใหม่เข้าไปในฐาน
    mysqli_query($conn, $sql2);
    // จบ การหักลบค่าออกจากฐาน ในตาราง total



    // เริ่ม การลบข้อมูลการนำเข้า
    $sql3 = "DELETE FROM import WHERE Import_ID = $id";

    if (mysqli_query($conn, $sql3)) {
        //echo "Record deleted successfully";
    } else {
        //echo "Error deleting record: " . mysqli_error($conn);
    }
    // จบ การลบข้อมูลการนำเข้า
}
else {
    echo "No Gene ID provided";
}

    //echo $sql;

    // ปิดการเชื่อมต่อ
    mysqli_close($conn);

    // เปลี่ยนหน้า
    echo '<meta http-equiv="refresh" content="0; url= Admin_ManageImport.php">';
?>