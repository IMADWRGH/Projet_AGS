<?php
require("../../helpers/condb.php");

// Fetch details for fill view modal
if (isset($_POST['view_demande'])) {

    $stage_id = mysqli_real_escape_string($con, $_POST['stage_id']);

    $query = "SELECT sr.CIN, sr.NOM, sr.PRENOM, sr.SEXE, sr.TEL, sr.EMAIL, sr.VILLE, sr.ADRESSE, d.CV, d.ASSURANCE, d.DEMANDE
            FROM stagiaire AS sr
            LEFT JOIN dossier AS d ON d.ID_STAGE = sr.ID_STAGE
            WHERE sr.ID_STAGE = '$stage_id'";

    // TODO: calc demands nombre for stagiaire
    // $countDemandes = "SELECT count(CIN)
    //                 FROM stage AS st
    //                 LEFT JOIN stagiaire AS sr ON sr.ID_STAGE = st.ID_STAGE
    //                 GROUP BY `name`
    // ";        

    $query_run = mysqli_query($con, $query);

    if (mysqli_num_rows($query_run) == 1) {

        $details = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => "Fetched successfully",
            'data' => $details,
        ];
        echo json_encode($res);
        return false;
    } else {

        $res = [
            'status' => 404,
            'message' => "Not Found",
            'error' => mysqli_error($con),
        ];
        echo json_encode($res);
        return false;
    }
}
if (isset($_POST['accepte_demande'])) {

    $stage_id = mysqli_real_escape_string($con, $_POST['stage_id']);

    $query = "UPDATE dossier SET STATUT='accepte'";
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
