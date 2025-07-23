<?php
header('Content-Type: application/json');

require_once("connect_db.php");

$sql_Total = "SELECT * FROM total";
$result_Total = $conn->query(query: $sql_Total);

$data = ["Total" => [], "Total_Date" => []];
while ($row = $result_Total->fetch_assoc()) {
    $data["Total"][] = $row["Total"];
    $data["Total_Date"][] = date_create_from_format(format: "Y-m-d H:i:s", datetime: $row["Total_Date"]) ->format(format: "d/m/Y");
}

echo json_encode($data);
?>