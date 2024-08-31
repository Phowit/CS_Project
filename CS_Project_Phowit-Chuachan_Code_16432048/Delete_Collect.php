<?php
require_once("connect_db.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // SQL to delete the record
    $sql = "DELETE FROM harvest WHERE Harvest_ID = $id";

    if (mysqli_query($conn, $sql)) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}
else {
    echo "No Gene ID provided";
}

?>
<meta http-equiv="refresh" content = "0; url =Admin_ManageCollect.php ">