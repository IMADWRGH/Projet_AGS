<?php

function generateID($prefix, $table)
{
    require("condb.php");
    $name_id = "ID_" . strtoupper($table);
    $query = "SELECT * FROM $table ORDER BY $name_id DESC LIMIT 1";
    $query_run = mysqli_query($con, $query);

    if (mysqli_num_rows($query_run) > 0) {
        if ($row = mysqli_fetch_assoc($query_run)) {
            $uid = $row['ID_PRESENCE'];
            $get_numbers = preg_replace("/[^0-9]/", "", $uid);
            $id_increase = $get_numbers + 1;
            $id = $prefix . $id_increase;
            return $id;
        }
    } else {
        $id = $prefix . "1";
        return $id;
    }
}
