<?php
require "../../helpers/condb.php";
require("../../helpers/functions.php");

if (isset($_POST["ok"])) {

    $ID = generateID("S", "satage");
    $cin = $_POST["cin"];
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $sexe = $_POST["sexe"];
    $mail = $_POST["mail"];
    $adresse = $_POST["adress"];
    $uv = $_POST["uv"];
    $tel = $_POST["tel"];
    $ville = $_POST["ville"];
    $niveau = $_POST["niveau"];

    $req = "INSERT INTO `stagiaire` VALUES('$cin',' $nom','$prenom',' $sexe','$tel','$mail','$ville','$adresse','$uv','$niveau')";
    $result = mysqli_query($con, $req);
    if ($result) {

        $res = [
            'status' => 200,
            'message' => "Created successfully",
        ];
        echo json_encode($res);
        return false;
    } else {

        $res = [
            'status' => 500,
            'message' => "Failed to create",
            'error' => mysqli_error($con),
        ];
        echo json_encode($res);
        return false;
    }
}
