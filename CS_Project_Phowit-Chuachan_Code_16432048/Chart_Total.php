<?php

// Temperature_chart

require_once("connect_db.php");

$sql = "SELECT * FROM total";
$result = $conn->query(query: $sql);

$data = ["Total" => [], "Total_Date" => []];
while ($row = $result->fetch_assoc()) {
    $data["Total"][] = $row["Total"];
    $data["Total_Date"][] = date_create_from_format(format: "Y-m-d H:i:s", datetime: $row["Total_Date"]) ->format(format: "d/m/Y");
}

echo json_encode($data);
?>