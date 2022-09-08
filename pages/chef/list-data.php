<?php
require("../../helpers/condb.php");

$nomChef = !isset($_SESSION['chef']) ? "" : $_SESSION['chef'];

$query = "SELECT sr.CIN, sr.NOM, sr.PRENOM, sr.SEXE, sr.TEL, sr.EMAIL, sr.VILLE, sr.ADRESSE, sr.NIVEAU, sr.ETABLISSEMENT, st.TYPE, st.ENCADRANT, st.DATE_D, st.DATE_F, d.CV, d.ASSURANCE, d.DEMANDE, d.DATE_DEPOSE, d.STATUT, dp.NOM AS DP_NOM, e.TERMINE
            FROM stagiaire AS sr
            LEFT JOIN stage AS st ON st.ID_STAGE = sr.ID_STAGE
            LEFT JOIN dossier AS d ON d.ID_STAGE = sr.ID_STAGE
            LEFT JOIN evaluation AS e ON e.ID_STAGE = sr.ID_STAGE
            LEFT JOIN departement AS dp ON dp.ID_DEPARTEMENT = st.ID_DEPARTEMENT
            WHERE dp.CHEF LIKE '%$nomChef'";

$query_run = mysqli_query($con, $query);
$fetchData = array('data' => array());

if ($query_run) {

    while ($row = mysqli_fetch_assoc($query_run)) {
        $array[] = $row;
    }

    $res = array(
        'status' => 200,
        'message' => "Fetched successfully",
        'totalrecords' => count($array),
        'data' => $array
    );

    echo json_encode($res);
    return false;
} else {

    $res = [
        'status' => 500,
        'message' => "Fail to fetch",
        'error' => mysqli_error($con),
    ];
    echo json_encode($res);
    return false;
}
