<?php
require("../../helpers/condb.php");

if (isset($_GET['presence_id'])) {

    $presence_id = mysqli_real_escape_string($con, $_GET['presence_id']);

    $query = "SELECT h.*, sr.NOM, sr.PRENOM
    FROM presence AS h
    LEFT JOIN stagiaire AS sr ON h.ID_STAGE = sr.ID_STAGE
    WHERE h.ID_PRESENCE = '$presence_id'";

    $query_run = mysqli_query($con, $query);

    if (mysqli_num_rows($query_run) == 1) {

        $presence = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => "Presence ('$presence_id') Fetched Successfully",
            'data' => $presence,
        ];
        echo json_encode($res);
        return false;
    } else {

        $res = [
            'status' => 404,
            'message' => "Presence ('$presence_id') Not Found",
        ];
        echo json_encode($res);
        return false;
    }
}

if (isset($_POST['update_presence'])) {

    $presence_id = mysqli_real_escape_string($con, $_POST['presence_id']);
    $m_in = mysqli_real_escape_string($con, $_POST['m-in']);
    $m_out = mysqli_real_escape_string($con, $_POST['m-out']);
    $a_in = mysqli_real_escape_string($con, $_POST['a-in']);
    $a_out = mysqli_real_escape_string($con, $_POST['a-out']);

    $query = "UPDATE presence SET HR_ENTRE_M=NULLIF('$m_in', ''), HR_SORTIE_M=NULLIF('$m_out', ''), HR_ENTRE_A=NULLIF('$a_in', ''), HR_SORTIE_A=NULLIF('$a_out', '') WHERE ID_PRESENCE='$presence_id'";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {

        $res = [
            'status' => 200,
            'message' => "Updated Successfully",
        ];
        echo json_encode($res);
        return false;
    } else {

        $res = [
            'status' => 500,
            'message' => "Failed to update",
            'error' => mysqli_error($con),
        ];
        echo json_encode($res);
        return false;
    }
}
