<?php
// fetch_table_Import.php

// Set header to indicate JSON content
header('Content-Type: application/json; charset=utf-8');

// Include database connection
require_once("connect_db.php");

$tableRows = []; // Initialize array to hold table data

// Get the selected breed ID from the POST request
// ใช้ $_POST เพราะ JavaScript ส่งข้อมูลแบบ POST (FormData)
$selectedBreedId = $_POST['breedSelectImport'] ?? null;

if ($selectedBreedId !== null) {
    // Prepare the SQL statement to prevent SQL injection
    $sql = "SELECT
                `Import_ID`,
                `Import_Date`,
                `Import_Amount`,
                `Import_Details`,
                import.`Breed_ID`,         
                breed.Breed_Name
            FROM import
            INNER JOIN breed ON import.Breed_ID = breed.Breed_ID
            WHERE import.`Breed_ID` = ?
            ORDER BY `Import_Date` DESC;"; // Order by date for consistency

    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Bind parameter (i for integer)
        $stmt->bind_param("i", $selectedBreedId); 
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Format dates for display
                $Import_Date_Formatted = date_create_from_format("Y-m-d H:i:s", $row["Import_Date"])->format("d/m/Y H:i:s");
                
                // Format date for datetime-local input in modal (YYYY-MM-DDTHH:mm)
                $Import_Date_For_Input = date_create_from_format("Y-m-d H:i:s", $row["Import_Date"])->format("Y-m-d\TH:i");

                // Add row data to the array
                $tableRows[] = [
                    'Import_ID' => $row['Import_ID'],
                    'Import_Date' => $Import_Date_Formatted,
                    'Breed_ID' => $row['Breed_ID'], // Include Breed_ID for modal pre-population
                    'Breed_Name' => $row['Breed_Name'],
                    'Import_Amount' => $row['Import_Amount'],
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
} else {
    // If no breedSelect is provided (e.g., initial load without selection),
    // you might want to load a default set of data or handle it based on your logic.
    // For now, it will return an empty set if no breed ID is given.
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