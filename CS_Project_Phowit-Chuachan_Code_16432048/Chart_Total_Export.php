<?php
header('Content-Type: application/json');
// เชื่อมต่อฐานข้อมูล
require_once("connect_db.php");

$sql = "SELECT Export_Date, Breed_Type, Amount FROM export ORDER BY Export_Date ASC";
$result = $conn->query($sql);

$labels = [];
$breedData = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $date = date('Y-m-d H:i', strtotime($row['Export_Date']));
        $breed = $row['Breed_Type'];
        $amount = (int)$row['Amount'];

        if (!in_array($date, $labels)) {
            $labels[] = $date;
        }

        if (!isset($breedData[$breed])) {
            $breedData[$breed] = [];
        }
        if (!isset($breedData[$breed][$date])) {
            $breedData[$breed][$date] = 0;
        }
        $breedData[$breed][$date] += $amount;
    }
}

usort($labels, function($a, $b) {
    return strtotime($a) - strtotime($b);
});

$datasets = [];
foreach ($breedData as $breed => $entries) {
    $datasetData = [];
    foreach ($labels as $label) {
        $datasetData[] = $entries[$label] ?? 0;
    }

    $datasets[] = [
        'label' => $breed,
        'data' => $datasetData,
    ];
}

echo json_encode(['Export_Date' => $labels, 'Export_Amount' => $datasets]); // Changed to match your JS structure

$conn->close();
?>