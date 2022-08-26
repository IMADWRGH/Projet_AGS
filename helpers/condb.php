<?php
$con = mysqli_connect("localhost", "root", "", "abhoer_db");

if (!$con) {
    echo "Connection Failed";
    exit();
}
