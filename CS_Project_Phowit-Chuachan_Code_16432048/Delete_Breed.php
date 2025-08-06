<?php
require_once("connect_db.php");

$Breed_ID = $_POST['Breed_ID'];

if($Breed_ID >0 ){
    // เริ่ม ลบ remain ที่มี Breed_ID = id ที่ต้องการลบ ------------------------------------
    $sql = "UPDATE `remain` SET`Remain_Deleted`= 1 WHERE `Breed_ID` = $Breed_ID";

    mysqli_query($conn, $sql);
    // จบ ลบ remain ที่มี Breed_ID = id ที่ต้องการลบ ------------------------------------


    
    // เริ่ม ลบสายพันธุ์ออกจากตาราง -----------------------------------------------------
    $sql3 = "UPDATE `breed` SET `Breed_Deleted`= 1 WHERE `Breed_ID` = $Breed_ID";

    if (mysqli_query($conn, $sql3)) {
        //echo "Record deleted successfully";
        //echo $Breed_ID;
    } else {
        //echo "Error deleting record: " . mysqli_error($conn);
    }
    // จบ ลบสายพันธุ์ออกจากตาราง -----------------------------------------------------
} else {
    echo "No Breed ID provided";
}

    // เริ่ม การหักลบค่าออกจากฐาน ในตาราง total ------------------------------------
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
    // จบ การหักลบค่าออกจากฐาน ในตาราง total ------------------------------------



    // เริ่ม ลบสายพันธุ์ออกจากตาราง -----------------------------------------------------
    $sql3 = "UPDATE `breed` SET `Data_Deleted`= 1 WHERE `Breed_ID` = $id";

    if (mysqli_query($conn, $sql3)) {
        //echo "Record deleted successfully";
        echo $id;
    } else {
        //echo "Error deleting record: " . mysqli_error($conn);
    }
    // จบ ลบสายพันธุ์ออกจากตาราง -----------------------------------------------------

?>
<meta http-equiv="refresh" content = "0; url = Admin_ManageBreedChicken.php ">