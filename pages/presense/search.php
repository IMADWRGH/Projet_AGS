<?php
// search by name / cin
require("../../helpers/condb.php");

if (isset($_POST['search'])) {

    $search = mysqli_real_escape_string($con, $_POST['search']);

    $query = "SELECT * FROM stagiaire WHERE NOM LIKE '$search%'";
    $query_run = mysqli_query($con, $query);

    if (mysqli_num_rows($query_run) > 0) {

        $stagiaire = mysqli_fetch_array($query_run);
        $res = array();

        $res[] = array("value" => $stagiaire['ID_STAGIAIRE'], "label" => $stagiaire['NOM'] . " " . $stagiaire['PRENOM']);
        echo json_encode($res);
        return false;
    } else {

        $res = [
            'status' => 404,
            'message' => "Stagiaire not found",
        ];
        echo json_encode($res);
        return false;
    }
}
