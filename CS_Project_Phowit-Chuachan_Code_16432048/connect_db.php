<?php 
    $db_host = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "cs_project";
    
                        //("server_name","username_database","password","database_name") *xampp not password*
            $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

            if($conn->connect_error) {
                die("Connection failed: ".$con->connect_error);
            }
?>