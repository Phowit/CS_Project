<?php
// fetch_table_Export.php

header('Content-Type: application/json; charset=utf-8');

// Include database connection
require_once("connect_db.php");

// Check if $_POST['breed_id'] is sent
$selectedBreedId = $_POST['breed_id'] ?? 'all';

$tableRows = [];

// Base SQL query
// Added GROUP BY to prevent duplicate rows from the JOIN
$sql = "SELECT
            exp.`Export_ID`,
            exp.`Export_Date`,
            exp.`Export_Amount`,
            exp.`Export_Details`,
            r.`Remain_ID`,
            r.`Import_ID`,
            b.`Breed_Name`,
            b.`Breed_ID`
        FROM `export` AS exp
        JOIN (
            SELECT 
                `Export_ID`, 
                MAX(`Remain_ID`) AS `Max_Remain_ID`
            FROM `remain`
            GROUP BY `Export_ID`
        ) AS subquery ON exp.`Export_ID` = subquery.`Export_ID`
        JOIN `remain` AS r ON subquery.`Max_Remain_ID` = r.`Remain_ID`
        JOIN `import` AS i ON r.`Import_ID` = i.`import_ID`
        JOIN `breed` AS b ON i.`Breed_ID` = b.`Breed_ID`
        WHERE exp.`Export_Delete` = 0
        ;";

// Add WHERE clause if a specific breed is selected
if ($selectedBreedId !== 'all' && $selectedBreedId !== null && $selectedBreedId !== '') {
    $sql .= " AND b.Breed_ID = ?";
}

// Group by the export ID to ensure a single row per export record
$sql .= " ORDER BY r.`Remain_Date` DESC ";

$stmt = $conn->prepare($sql);

if ($stmt) {
    if ($selectedBreedId !== 'all' && $selectedBreedId !== null && $selectedBreedId !== '') {
        // Bind parameter only if a specific breed is selected
        $stmt->bind_param("i", $selectedBreedId);
    }
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Format dates for display
            $Export_Date_Formatted = date_create_from_format("Y-m-d H:i:s", $row['Export_Date'])->format("d/m/Y H:i:s");
            
            // Format date for datetime-local input in modal (YYYY-MM-DDTHH:mm)
            $Export_Date_For_Input = date_create_from_format("Y-m-d H:i:s", $row["Export_Date"])->format("Y-m-d\TH:i");

            // Add row data to the array
            $tableRows[] = [
                'Export_ID' => $row['Export_ID'],
                'Export_Date_Formatted' => $Export_Date_Formatted,
                'Breed_ID' => $row['Breed_ID'],
                'Breed_Name' => $row['Breed_Name'],
                'Export_Amount' => $row['Export_Amount'],
                'Export_Details' => $row['Export_Details'],
                'Export_Date_For_Input' => $Export_Date_For_Input
            ];
        }
    }
    $stmt->close();
} else {
    // If statement preparation fails, send an error message
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
echo json_encode($response_data, JSON_UNESCAPED_UNICODE);
?>