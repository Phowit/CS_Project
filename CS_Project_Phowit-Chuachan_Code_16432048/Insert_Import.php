<?php
    // เชื่อมต่อฐานข้อมูล
    require_once("connect_db.php");

//เรอ่มส่วนการเพิ่มข้อมูล import --------------------------------------------
// ตรวจสอบว่ามีการส่งข้อมูลมาจากฟอร์มหรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // รับข้อมูลจากฟอร์ม
    $Import_Date = $_POST['Import_Date'];
    $Breed_ID = $_POST['Breed_ID'];
    $Import_Amount = $_POST['Import_Amount'];
    $Import_Details = $_POST['Import_Details'];

    // เตรียมคำสั่ง SQL
    $sqli = "insert into Import (Import_Date,Breed_ID,Import_Amount,Import_Details)";
    $sqli .= "values('$Import_Date','$Breed_ID','$Import_Amount','$Import_Details')";

    mysqli_query($conn,$sqli);
    //echo"SQL = ".$sqli;
    //echo"error = " . mysqli_error($conn);
}
//จบส่วนการเพิ่มข้อมูล import --------------------------------------------



//เริ่มส่วนการตรวจสอบและเพิ่ม remain ใหม่ --------------------------------------------
//หลังจากเพิ่มข้อมูลการนำเข้าเสร็จ ดึงข้อมูล remain มาตรวจสอบว่ามี Breed_ID เหมือนกันหรือไม่? หากไม่มี ให้เพิ่ม remain ใหม่ เข้าไป
$sql0 = "SELECT * FROM `remain` WHERE Breed_ID = $Breed_ID ORDER BY `Remain_Date` DESC LIMIT 1;" ;
$result0 = $conn->query($sql0);//ดึงข้อมูลทั้งหมดจาก remain มา

//ตรวจสอบว่ามีข้อมูลเก่าอยู่แล้วหรือไม่
if($result0 && $result0 > 0) {
    //ถ้ามี ให้นำค่าเก่าล่าสุดมา + เพิ่มกับค่าใหม่ แล้วค่อยสร้างชุดข้อมูลใหม่ เพื่อที่จะสามารถสร้างเป็นกราฟวัดได้ ว่าเพิ่มลดเท่าไร
    while($row = $result0->fetch_assoc()){
        $Remain_Amount = $row['Remain_Amount'];
    }

    $New_Remain_Amount = $Remain_Amount + $Import_Amount; //ข้อมูลเก่า + ใหม่
    
    $sql1 = " INSERT INTO `remain`(`Remain_Amount`, `total_ID`, `Breed_ID`) VALUES ($New_Remain_Amount, '1' ,$Breed_ID);";

} else {
    //ถ้าไม่มี ให้สร้างสาย remain ด้วยข้อมูลใหม่ทั้งหมดใหม่
    $sql1 = "INSERT INTO `remain`(`Remain_Amount`, `total_ID`, `Breed_ID`) VALUES ($Import_Amount, '1' ,$Breed_ID);";
}
mysqli_query($conn,$sql1);
//จบส่วนการตรวจสอบและเพิ่ม remain ใหม่ --------------------------------------------



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
