<?php

// Temperature_chart

require_once("connect_db.php");

$sql_T_Level = "SELECT T_Level, DT_record FROM status ORDER BY DT_record DESC LIMIT 5";
$result_T_Level = $conn->query(query: $sql_T_Level);

$data = ["T_Level" => [], "DT_record" => []];
while ($row = $result_T_Level->fetch_assoc()) {
    $data["T_Level"][] = $row["T_Level"];
    $data["DT_record"][] = date_create_from_format(format: "Y-m-d H:i:s", datetime: $row["DT_record"]) ->format(format: "d/m/Y");
}

echo json_encode($data);
?>