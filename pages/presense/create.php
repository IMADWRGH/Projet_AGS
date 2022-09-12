<?php
require("../../helpers/condb.php");
require("../../helpers/functions.php");

if (isset($_POST['create_presence'])) {


    $ID = generateID("P", "presence");
    $DATE = date("Y/m/d");
    $m_in = mysqli_real_escape_string($con, $_POST['m-in']);
    $m_out = mysqli_real_escape_string($con, $_POST['m-out']);
    $a_in = mysqli_real_escape_string($con, $_POST['a-in']);
    $a_out = mysqli_real_escape_string($con, $_POST['a-out']);
    $stage_id = mysqli_real_escape_string($con, $_POST['stage_id']);

    $query = "INSERT INTO presence (ID_PRESENCE,`DATE`, HR_ENTRE_M, HR_SORTIE_M, HR_ENTRE_A, HR_SORTIE_A, ID_STAGE)
    VALUES ('$ID','$DATE', NULLIF('$m_in', ''),NULLIF('$m_out', ''), NULLIF('$a_in', ''), NULLIF('$a_out', ''), '$stage_id')";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {

        $res = [
            'status' => 200,
            'message' => "Créé avec succès",
        ];
        echo json_encode($res);
        return false;
    } else {

        $res = [
            'status' => 500,
            'message' => "Échec de la création",
            'error' => mysqli_error($con),
        ];
        echo json_encode($res);
        return false;
    }
}
