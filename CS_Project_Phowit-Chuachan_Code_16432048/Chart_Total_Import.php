<?php
header('Content-Type: application/json');

// เชื่อมต่อฐานข้อมูล
require_once("connect_db.php");

$sql = "SELECT 
            `Import_Date`,
            breed.Breed_Name,
            `Import_Amount`
        FROM import 
        INNER JOIN breed 
        ON import.Breed_ID = breed.Breed_ID
        ORDER BY Import_Date ASC";
$result = $conn->query($sql);

$labels = [];
$breedData = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $date = date('Y-m-d H:i', strtotime($row['Import_Date'])); // ใช้รูปแบบเต็มเพื่อความถูกต้องในการจัดกลุ่ม
        $breed = $row['Breed_Name'];
        $amount = (int)$row['Import_Amount'];

        // Add unique dates to labels, then sort later
        if (!in_array($date, $labels)) {
            $labels[] = $date;
        }

        // Aggregate amounts by date and breed
        if (!isset($breedData[$breed])) {
            $breedData[$breed] = [];
        }
        // Group by date, summing amounts if multiple records for the same breed on the same date/time
        if (!isset($breedData[$breed][$date])) {
            $breedData[$breed][$date] = 0;
        }
        $breedData[$breed][$date] += $amount;
    }
}

// Sort labels chronologically
usort($labels, function($a, $b) {
    return strtotime($a) - strtotime($b);
});

$datasets = [];
foreach ($breedData as $breed => $entries) {
    $datasetData = [];
    foreach ($labels as $label) {
        $datasetData[] = $entries[$label] ?? 0; // Use 0 if no data for that date/breed
    }

    $datasets[] = [
        'label' => $breed,
        'data' => $datasetData,
        // Colors will be set in JavaScript for consistency
    ];
}

echo json_encode(['labels' => $labels, 'datasets' => $datasets]);

$conn->close();
?>