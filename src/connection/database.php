<?php
function getConnection()
{
    $mysqli = new mysqli("localhost", "root", "", "cnpm", "3306");

    // Check connection
    if ($mysqli->connect_errno) {
        echo "Kết nối MYSQLi lỗi" . $mysqli->connect_error;
        exit();
    }
    return $mysqli;
}
?>