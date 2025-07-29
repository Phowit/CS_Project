<?php
// fetch_table_Export.php

// Set header to indicate JSON content
header('Content-Type: application/json; charset=utf-8');

// Include database connection
require_once("connect_db.php"); // ตรวจสอบให้แน่ใจว่า connect_db.php อยู่ใน path ที่ถูกต้อง

// ตรวจสอบว่ามี $_POST['breedSelectExport'] ส่งมาหรือไม่
$selectedBreedId = $_POST['breedSelectExport'] ?? 'all'; // Default to 'all' if not provided

$tableRows = []; // Initialize array to hold table data

// Base SQL query
$sql = "SELECT
            exp.Export_ID,
            exp.Export_Date,
            exp.Export_Amount,
            exp.Export_Details,
            b.Breed_ID,
            b.Breed_Name
        FROM export AS exp
        INNER JOIN breed AS b ON exp.Breed_ID = b.Breed_ID";

// Add WHERE clause if a specific breed is selected
if ($selectedBreedId !== 'all' && $selectedBreedId !== null && $selectedBreedId !== '') {
    $sql .= " WHERE b.Breed_ID = ?"; // เพิ่ม WHERE clause
}

$sql .= " ORDER BY exp.`Export_Date` DESC"; // เพิ่ม ORDER BY

$stmt = $conn->prepare($sql);

if ($stmt) {
    if ($selectedBreedId !== 'all' && $selectedBreedId !== null && $selectedBreedId !== '') {
        // Bind parameter only if a specific breed is selected
        $stmt->bind_param("i", $selectedBreedId); // 'i' for integer, assuming Breed_ID is int
    }
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Format dates for display
            $Export_Date_Formatted = date_create_from_format("Y-m-d H:i:s", $row['Export_Date'])->format("d/m/Y H:i:s");
            
            // Format date for datetime-local input in modal (YYYY-MM-DDTHH:mm)
            $Export_Date_DateTimeLocal = date_create_from_format("Y-m-d H:i:s", $row["Export_Date"])->format("Y-m-d\TH:i");

            // Add row data to the array
            $tableRows[] = [
                'Export_ID' => $row['Export_ID'],
                'Export_Date_Formatted' => $Export_Date_Formatted ,
                'Breed_ID' => $row['Breed_ID'], // Include Breed_ID
                'Breed_Name' => $row['Breed_Name'],
                'Export_Amount' => $row['Export_Amount'],
                'Export_Details' => $row['Export_Details'],
                'Export_Date_DateTimeLocal' => $Export_Date_DateTimeLocal // Add this for the edit modal input
            ];
        }
    }
    $stmt->close();
} else {
    // If statement preparation fails, send an error message
    // This error will be caught by JavaScript's .then(data => { if (data.error) ... })
    echo json_encode(["error" => "Failed to prepare statement: " . $conn->error], JSON_UNESCAPED_UNICODE);
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
// JSON_UNESCAPED_UNICODE is important for Thai characters
echo json_encode($response_data, JSON_UNESCAPED_UNICODE);
?>