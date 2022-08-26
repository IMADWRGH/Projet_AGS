<?php
require("../../helpers/condb.php");

if (isset($_POST['delete_presence'])) {
    $presence_id = mysqli_real_escape_string($con, $_POST['presence_id']);

    $query = "DELETE FROM hr_presence WHERE ID_PRESENCE='$presence_id'";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {

        $res = [
            'status' => 200,
            'message' => "Presence ('$presence_id') Deleted Successfully",
        ];
        echo json_encode($res);
        return false;
    } else {

        $res = [
            'status' => 500,
            'message' => "Presence ('$presence_id') Not Deleted",
        ];
        echo json_encode($res);
        return false;
    }
}
