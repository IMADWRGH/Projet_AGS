<?php
require("../../helpers/condb.php");
require("../../helpers/functions.php");

if (isset($_GET['dep_id'])) {

    $dep_id = mysqli_real_escape_string($con, $_GET['dep_id']);

    $query = "SELECT ID_DEPARTEMENT, NOM, CHEF, ETAT, created_at
            FROM departement
            WHERE ID_DEPARTEMENT = '$dep_id'";

    $query_run = mysqli_query($con, $query);

    if (mysqli_num_rows($query_run) == 1) {

        $presence = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => "Presence ('$dep_id') Fetched Successfully",
            'data' => $presence,
        ];
        echo json_encode($res);
        return false;
    } else {

        $res = [
            'status' => 404,
            'message' => "Presence ('$dep_id') Not Found",
            'error' => mysqli_error($con),
        ];
        echo json_encode($res);
        return false;
    }
}

if (isset($_POST['create_dep'])) {

    $ID = generateID("DP", "departement");
    $dep_nom = mysqli_real_escape_string($con, $_POST['dep_nom_new']);
    $chef_nom = mysqli_real_escape_string($con, $_POST['chef_nom_new']);
    $etat = mysqli_real_escape_string($con, $_POST['etat_new']);

    $query = "INSERT INTO departement (ID_DEPARTEMENT, NOM, CHEF, ETAT)
            VALUES ('$ID', NULLIF('$dep_nom', ''), NULLIF('$chef_nom', ''), NULLIF('$etat', ''))";
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

if (isset($_POST['update_dep'])) {

    $dep_id = mysqli_real_escape_string($con, $_POST['dep_id']);
    $dep_nom = mysqli_real_escape_string($con, $_POST['dep_nom']);
    $chef_nom = mysqli_real_escape_string($con, $_POST['chef_nom']);
    $etat = mysqli_real_escape_string($con, $_POST['etat']);

    $query = "UPDATE departement SET NOM=NULLIF('$dep_nom', ''), CHEF=NULLIF('$chef_nom', ''), ETAT=NULLIF('$etat', '') WHERE ID_DEPARTEMENT='$dep_id'";
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

if (isset($_POST['delete_dep'])) {

    $dep_id = mysqli_real_escape_string($con, $_POST['dep_id']);

    $query = "DELETE FROM departement WHERE ID_DEPARTEMENT='$dep_id'";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {

        $res = [
            'status' => 200,
            'message' => "Dep ('$dep_id') Deleted Successfully",
        ];
        echo json_encode($res);
        return false;
    } else {

        $res = [
            'status' => 500,
            'message' => "Failed to delete",
            'error' => mysqli_error($con),
        ];
        echo json_encode($res);
        return false;
    }
}
