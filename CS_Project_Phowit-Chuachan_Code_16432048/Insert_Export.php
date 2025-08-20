<?php
    // ตรวจสอบว่ามีการส่งข้อมูลมาจากฟอร์มหรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // เชื่อมต่อฐานข้อมูล
    require_once("connect_db.php");

    // รับข้อมูลจากฟอร์ม
    $import_ID = $_POST['import_ID'];
    $Export_Date = $_POST['Export_Date'];
    $Export_Amount = $_POST['Export_Amount'];
    $Export_Details = $_POST['Export_Details'];

    // เตรียมคำสั่ง SQL
    $sql0 = "insert into export (Export_Date,Export_Amount,Export_Details,import_ID)";
    $sql0 .= "values('$Export_Date','$Export_Amount','$Export_Details','$import_ID')";

    mysqli_query($conn,$sqli);
    //echo"SQL = ".$sqli;
    //echo"error = " . mysqli_error($conn);
}

// เริ่ม ส่วนการเพิ่มค่า remain ---------------------------------------------------------
$sql0 = "   SELECT `Remain_Amount` ,
                import.Breed_ID , 
                import.import_ID ,
                breed.Breed_ID ,
                import.Import_Amount
            FROM `remain` 
            INNER JOIN breed ON breed.Breed_ID = remain.Breed_ID
            INNER JOIN import ON remain.Breed_ID = import.Breed_ID
            WHERE import.import_ID = $import_ID
            ORDER BY `Remain_Date` DESC LIMIT 1
            ;
        ";
$result0 = mysqli_query($conn, $sql0);

while($row = $result0->fetch_assoc()){
    $Old_Remain_Amount = $row['Remain_Amount'];
}

$New_Remain_Amount = $Old_Remain_Amount + $Import_Amount;

$sql1 = "INSERT INTO `remain`(`Remain_Amount`,`total_ID`, `Breed_ID`) VALUES ('$New_Remain_Amount',1,'$Breed_ID')";
mysqli_query($conn, $sql1);
// จบ ส่วนการเพิ่มค่า remain ---------------------------------------------------------



// เริ่ม ส่วนการรวมค่า total -----------------------------------------------------------
$sql2 = "   SELECT r1.*
            FROM remain r1
            JOIN (SELECT Breed_ID, MAX(Remain_Date) AS max_date FROM remain GROUP BY Breed_ID)
            r2 ON r1.Breed_ID = r2.Breed_ID AND r1.Remain_Date = r2.max_date;
            ";                         //เลือกค่า remain ทั้งหมดมา โดยที่ สายพันธุ์ไม่ซ้ำ และเป็นค่าล่าสุดของแต่ละสายพันธุ์เท่านั้น

$result2 = $conn->query($sql2); // นำค่ามาเก็บไว้

$total_amount = 0; // ตัวแปรเก็บผลรวม

if ($result2->num_rows > 0) {
    while ($row = $result2->fetch_assoc()) {
        $total_amount += $row['Remain_Amount']; // รวมค่า
    }
}

$sql3 = "INSERT INTO `total`(`Total`) VALUES ('$total_amount');";   // เพิ่มค่าใหม่เข้าไปในฐาน
mysqli_query($conn, $sql3);
// จบ ส่วนการรวมค่า total -----------------------------------------------------------


/*
echo "SQLi =" . $sqli ."คือการเพิ่ม import <br>";
echo "SQL0 =" . $sql0 ."ดึง remain ล่าสุดมา <br>";
echo "SQL1 =" . $sql1 ."เพิ่ม remain ใหม่ไป โดยรวมกับค่าเก่าแล้ว แต่ยังไม่ให้เข้าฐาน <br>";
echo "SQL2 =" . $sql2 ."รวมค่า total จะได้" . $total_amount . "<br>";
echo "SQL3 =" . $sql3 ."เพิ่มค่า total" . "<br>";
echo "New_Remain_Amount" . $New_Remain_Amount . "=" . $Old_Remain_Amount . "+" . $Import_Amount . "<br>";
echo "ผลรวมของ Remain_Amount: " . $total_amount;
*/

    // ปิดการเชื่อมต่อ
    mysqli_close($conn);

    // เปลี่ยนหน้า
    echo '<meta http-equiv="refresh" content="0; url=Admin_ManageImport.php">';
?>
