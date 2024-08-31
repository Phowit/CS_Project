<?php
    require_once("connect_db.php");
    $sql = "select * from status ";
    $result = mysqli_query($conn,$sql);

    if ($result->num_rows > 0) {
        // วนลูปเพื่อดึงข้อมูลทีละแถว
        while($row = $result->fetch_assoc()) {
            // แปลงค่า 0 และ 1 เป็นคำว่า ปิด และ เปิด
            $status_ID = $row['status_ID'];
            $ServoMoter = $row['ServoMoter'];
            $ServoMoter = $row["ServoMoter"] == 0 ? "ปิด" : "เปิด";
            $BallValve_Tem = $row["BallValve_Tem"] == 0 ? "ปิด" : "เปิด";
            $BallValve_water = $row["BallValve_water"] == 0 ? "ปิด" : "เปิด";
            $BallValve_SFood = $row["BallValve_SFood"] == 0 ? "ปิด" : "เปิด";
            $DateControl_ID = $row['DateControl_ID'];

             // แสดงผลในรูปแบบตาราง
            echo "<tr>  
                        <td>" . $status_ID . "</td>
                        <td>" . $ServoMoter . "</td>
                        <td>" . $ServoMoter . "</td>
                        <td>" . $BallValve_Tem . "</td>
                        <td>" . $BallValve_water . "</td>
                        <td>" . $BallValve_SFood . "</td>
                        <td>" . $DateControl_ID . "</td>
                </tr>";
            }
        } else {
            echo "ไม่พบข้อมูล";
        }
?>