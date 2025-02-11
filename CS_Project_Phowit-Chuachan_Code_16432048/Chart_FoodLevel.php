<?php

// Chart_FoodLevel

require_once("connect_db.php");

$sql_FoodLevel = "SELECT FoodLevel, DT_record FROM status ORDER BY DT_record DESC LIMIT 5";
$result_FoodLevel = $conn->query(query: $sql_FoodLevel);

$data = ["FoodLevel" => [], "DT_record" => []];
while ($row = $result_FoodLevel->fetch_assoc()) {
    $data["FoodLevel"][] = $row["FoodLevel"];
    $data["DT_record"][] = date_create_from_format(format: "Y-m-d H:i:s", datetime: $row["DT_record"]) ->format(format: "d/m/Y");
}

echo json_encode($data);
?>