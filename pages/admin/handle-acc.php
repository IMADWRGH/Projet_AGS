<?php
require("../../helpers/condb.php");
require("../../helpers/functions.php");

if (isset($_GET['acc_id'])) {

    $acc_id = mysqli_real_escape_string($con, $_GET['acc_id']);

    $query = "SELECT ID_UTILISATEUR, USERNAME, PWD, `ROLE`, ETAT, created_at
            FROM utilisateur
            WHERE ID_UTILISATEUR = '$acc_id'";

    $query_run = mysqli_query($con, $query);

    if (mysqli_num_rows($query_run) == 1) {

        $presence = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => "Account ('$acc_id') Fetched Successfully",
            'data' => $presence,
        ];
        echo json_encode($res);
        return false;
    } else {

        $res = [
            'status' => 404,
            'message' => "Account ('$acc_id') Not Found",
            'error' => mysqli_error($con),
        ];
        echo json_encode($res);
        return false;
    }
}

if (isset($_POST['create_acc'])) {

    $ID = generateID("U", "utilisateur");
    $username = mysqli_real_escape_string($con, $_POST['username_new']);
    $pwd = mysqli_real_escape_string($con, $_POST['pwd_new']);
    $role = mysqli_real_escape_string($con, $_POST['role_new']);
    $etat = mysqli_real_escape_string($con, $_POST['etat_new']);

    $query = "INSERT INTO utilisateur (ID_UTILISATEUR, USERNAME, PWD, `ROLE`, ETAT)
            VALUES ('$ID', NULLIF('$username', ''), NULLIF('$pwd', ''), NULLIF('$role', ''), NULLIF('$etat', ''))";
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

if (isset($_POST['update_acc'])) {

    $acc_id = mysqli_real_escape_string($con, $_POST['acc_id']);
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $pwd = mysqli_real_escape_string($con, $_POST['pwd']);
    $role = mysqli_real_escape_string($con, $_POST['role']);
    $etat = mysqli_real_escape_string($con, $_POST['etat']);

    $query = "UPDATE utilisateur SET USERNAME=NULLIF('$username', ''), PWD=NULLIF('$pwd', ''), `ROLE`=NULLIF('$role', ''), ETAT=NULLIF('$etat', '') WHERE ID_UTILISATEUR='$acc_id'";
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

if (isset($_POST['delete_acc'])) {

    $acc_id = mysqli_real_escape_string($con, $_POST['acc_id']);

    $query = "DELETE FROM utilisateur WHERE ID_UTILISATEUR='$acc_id'";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {

        $res = [
            'status' => 200,
            'message' => "$acc_id Deleted Successfully",
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
