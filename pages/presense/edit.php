<?php
require("../../helpers/condb.php");

if (isset($_GET['presence_id'])) {

    $presence_id = mysqli_real_escape_string($con, $_GET['presence_id']);

    $query = "SELECT h.*, sr.NOM, sr.PRENOM
    FROM hr_presence AS h 
    LEFT JOIN stage AS st ON h.ID_presence = st.ID_presence 
    LEFT JOIN stagiaire AS sr ON sr.ID_STAGIAIRE = st.ID_STAGIAIRE
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

    $query = "UPDATE hr_presence SET HR_ENTRE_M='$m_in', HR_SORTIE_M='$m_out', HR_ENTRE_A='$a_in', HR_SORTIE_A='$a_out' WHERE ID_PRESENCE='$presence_id'";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {

        $res = [
            'status' => 200,
            'message' => "Presence ('$presence_id') Updated Successfully",
        ];
        echo json_encode($res);
        return false;
    } else {

        $res = [
            'status' => 500,
            'message' => "Presence ('$presence_id') Not Updated",
        ];
        echo json_encode($res);
        return false;
    }
}
