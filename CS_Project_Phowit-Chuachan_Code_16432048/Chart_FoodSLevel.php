<?php

// Chart_FoodSLevel

require_once("connect_db.php");

$sql_FoodSLevel = "SELECT FoodSLevel, DT_record FROM status ORDER BY DT_record DESC LIMIT 5";
$result_FoodSLevel = $conn->query(query: $sql_FoodSLevel);

$data = ["FoodSLevel" => [], "DT_record" => []];
while ($row = $result_FoodSLevel->fetch_assoc()) {
    $data["FoodSLevel"][] = $row["FoodSLevel"];
    $data["DT_record"][] = date_create_from_format(format: "Y-m-d H:i:s", datetime: $row["DT_record"]) ->format(format: "d/m/Y");
}

echo json_encode($data);
?>