<?php
// search by name / cin
require("../../helpers/condb.php");

if (isset($_POST['search'])) {

    $search = mysqli_real_escape_string($con, $_POST['search']);

    $query = "SELECT `sr`.*, `st`.`ID_STAGE`
                FROM `stagiaire` AS `sr`
                LEFT JOIN `stage` AS `st` ON `sr`.`ID_STAGE` = `st`.`ID_STAGE`
                WHERE sr.`NOM` LIKE '$search%' OR sr.`PRENOM` LIKE '$search%' OR st.ID_STAGE = '$search'
                ORDER BY ABS( DATEDIFF( st.DATE_D, CURRENT_DATE ) ) 
                LIMIT 1
    ";
    $query_run = mysqli_query($con, $query);

    if (mysqli_num_rows($query_run) > 0) {

        $stagiaire = mysqli_fetch_array($query_run);
        $res = array();

        $res[] = array("value" => $stagiaire['ID_STAGE'], "label" => $stagiaire['NOM'] . " " . $stagiaire['PRENOM']);
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
