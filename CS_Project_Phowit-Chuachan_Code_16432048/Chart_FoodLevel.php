<?php

// Chart_FoodLevel

require_once("connect_db.php");

$sql = "SELECT FoodLevel, DT_record FROM status ORDER BY DT_record DESC LIMIT 5";
$result = $conn->query(query: $sql);

$data = ["FoodLevel" => [], "DT_record" => []];
while ($row = $result->fetch_assoc()) {
    $data["FoodLevel"][] = $row["FoodLevel"];
    $data["DT_record"][] = date_create_from_format(format: "Y-m-d H:i:s", datetime: $row["DT_record"]) ->format(format: "d/m/Y");
}

echo json_encode($data);
?>