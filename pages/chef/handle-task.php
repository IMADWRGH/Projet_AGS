<?php
// search by name / id_stage
require("../../helpers/condb.php");
require("../../helpers/functions.php");

if (isset($_POST['search'])) {

    $search = mysqli_real_escape_string($con, $_POST['search']);

    $query = "SELECT sr.NOM, sr.PRENOM, st.TYPE, st.DATE_D, st.DATE_F, st.ID_STAGE
            FROM stagiaire AS sr
            LEFT JOIN stage AS st ON sr.ID_STAGE = st.ID_STAGE
            WHERE sr.NOM LIKE '$search%' OR sr.PRENOM LIKE '$search%' OR st.ID_STAGE = '$search'
            ORDER BY ABS( DATEDIFF( st.DATE_D, CURRENT_DATE ) ) 
            LIMIT 1";
    $query_run = mysqli_query($con, $query);

    if (mysqli_num_rows($query_run) > 0) {

        $stagiaire = mysqli_fetch_array($query_run);
        $res = array();

        $res[] = array("value" => $stagiaire['ID_STAGE'], "label" => $stagiaire['NOM'] . " " . $stagiaire['PRENOM']);
        array_push($res, array("TYPE" => $stagiaire['TYPE'], "DATE_D" => $stagiaire['DATE_D'], "DATE_F" => $stagiaire['DATE_F']));
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

if (isset($_POST['create_tache'])) {


    $ID = generateID("A", "tache");
    $tache_name = mysqli_real_escape_string($con, $_POST['nom_tache']);
    $time = mysqli_real_escape_string($con, $_POST['temps']);
    $tools = mysqli_real_escape_string($con, $_POST['materiels']);
    $stage_id = mysqli_real_escape_string($con, $_POST['stage_id']);

    $query = "INSERT INTO tache (ID_TACHE, TACHE, TEMPS, MATERIEL, ID_STAGE)
    VALUES ('$ID', NULLIF('$tache_name', ''),NULLIF('$time', ''), NULLIF('$tools', ''), '$stage_id')";
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

if (isset($_POST['update_tache'])) {

    $tache_id = mysqli_real_escape_string($con, $_POST['tache_id']);
    $tache_name = mysqli_real_escape_string($con, $_POST['nom_tache_update']);
    $time = mysqli_real_escape_string($con, $_POST['temps_update']);
    $tools = mysqli_real_escape_string($con, $_POST['materiels_update']);

    $query = "UPDATE tache SET TACHE=NULLIF('$tache_name', ''), TEMPS=NULLIF('$time', ''), MATERIEL=NULLIF('$tools', '') WHERE ID_TACHE='$tache_id'";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {

        $res = [
            'status' => 200,
            'message' => "Modifié avec succès",
        ];
        echo json_encode($res);
        return false;
    } else {

        $res = [
            'status' => 500,
            'message' => "Échec de la modification",
            'error' => mysqli_error($con),
        ];
        echo json_encode($res);
        return false;
    }
}
