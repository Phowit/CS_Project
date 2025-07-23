<?php
// fetch_table_Import.php

// Set header to indicate JSON content
header('Content-Type: application/json; charset=utf-8');

// Include database connection
require_once("connect_db.php"); // ตรวจสอบให้แน่ใจว่าไฟล์นี้เชื่อมต่อฐานข้อมูลได้ถูกต้อง

$tableRows = []; // Initialize array to hold table data

// Get the selected breed ID from the POST request
// *** เปลี่ยนจาก 'breedSelectImport' เป็น 'breed_id' เพื่อให้สอดคล้องกับ JS ***
$selectedBreedId = $_POST['breed_id'] ?? 'all'; // Default to 'all' if not set

// เตรียมส่วนของ WHERE clause
$where_clause = "";
if ($selectedBreedId !== 'all') {
    // ใช้ prepared statement สำหรับการกรองตาม Breed_ID
    $where_clause = " WHERE import.`Breed_ID` = ?";
}

// Prepare the SQL statement
// *** เปลี่ยนจาก `Import_Amount` เป็น `New_Import_Amount` ตามโครงสร้างที่คุณให้มาใน Admin_TableImport.php ***
$sql = "SELECT
            `Import_ID`,
            `Import_Date`,
            `Import_Amount`, 
            `Import_Details`,
            import.`Breed_ID`,      
            breed.Breed_Name
        FROM import
        INNER JOIN breed ON import.Breed_ID = breed.Breed_ID
        $where_clause
        ORDER BY `Import_Date` DESC;"; // Order by date for consistency

$stmt = $conn->prepare($sql);

if ($stmt) {
    if ($selectedBreedId !== 'all') {
        // Bind parameter ONLY if a specific breed ID is selected
        // *** ตรวจสอบชนิดข้อมูลของ Breed_ID ในฐานข้อมูลของคุณ ***
        // ถ้าเป็น INT ใช้ "i", ถ้าเป็น VARCHAR/STRING ใช้ "s"
        $stmt->bind_param("s", $selectedBreedId); // สมมติว่า Breed_ID อาจเป็น String (UUID หรือรหัสอื่นๆ) หรือ "i" ถ้าเป็น Integer
    }
    
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Format dates for display
            // ตรวจสอบว่าวันที่สามารถสร้าง object ได้ก่อน format
            $Import_Date_Obj = date_create_from_format("Y-m-d H:i:s", $row["Import_Date"]);
            $Import_Date_Formatted = $Import_Date_Obj ? $Import_Date_Obj->format("d/m/Y H:i:s") : $row["Import_Date"];
            
            // Format date for datetime-local input in modal (YYYY-MM-DDTHH:mm)
            $Import_Date_For_Input = $Import_Date_Obj ? $Import_Date_Obj->format("Y-m-d\TH:i") : "";

            // Add row data to the array
            $tableRows[] = [
                'Import_ID' => $row['Import_ID'],
                'Import_Date' => $Import_Date_Formatted,
                'Breed_ID' => $row['Breed_ID'], // Include Breed_ID for modal pre-population
                'Breed_Name' => $row['Breed_Name'],
                'Import_Amount' => $row['Import_Amount'], // ใช้ New_Import_Amount
                'Import_Details' => $row['Import_Details'],
                'Import_Date_For_Input' => $Import_Date_For_Input // Add this for the edit modal
            ];
        }
    }
    $stmt->close();
} else {
    // If statement preparation fails, send an error message
    echo json_encode(["error" => "Failed to prepare statement: " . $conn->error]);
    exit();
}

// Close the database connection
if ($conn) {
    $conn->close();
}

// Prepare the final response structure
$response_data = [
    "tableData" => $tableRows
];

// Encode the array to JSON and output it
echo json_encode($response_data, JSON_UNESCAPED_UNICODE);
?>