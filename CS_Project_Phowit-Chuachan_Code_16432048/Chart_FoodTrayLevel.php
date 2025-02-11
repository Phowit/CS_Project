<?php

// Chart_FoodLevel

require_once("connect_db.php");

$sql_FoodTray = "SELECT FoodTray1, FoodTray2, DT_record FROM status ORDER BY DT_record DESC LIMIT 5";
$result_FoodTray = $conn->query(query: $sql_FoodTray);

$data = ["FoodTray1" => [], "FoodTray2" => [], "DT_record" => []];
while ($row = $result_FoodTray->fetch_assoc()) {
    $data["FoodTray1"][] = $row["FoodTray1"];
    $data["FoodTray2"][] = $row["FoodTray2"];
    $data["DT_record"][] = date_create_from_format(format: "Y-m-d H:i:s", datetime: $row["DT_record"]) ->format(format: "d/m/Y");
}

echo json_encode($data);
?>