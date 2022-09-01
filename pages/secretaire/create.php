<?php
require "../../helpers/condb.php";
require("../../helpers/functions.php");

if (isset($_POST["ok"])) {

    $newStage_id = generateID("T", "stage");
    $newDossier_id = generateID("D", "dossier");
    $newStagiaire_id = generateID("S", "stagiaire");
    include("./file-proccess.php"); // Upload files

    $cin = $_POST["cin"];
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $sexe = $_POST["sexe"];
    $email = $_POST["email"];
    $adresse = $_POST["adress"];
    $uv = $_POST["uv"];
    $tel = $_POST["tel"];
    $ville = $_POST["ville"];
    $niveau = $_POST["niveau"];
    $startDate = $_POST["startDate"];
    $endDate = $_POST["endDate"];
    $stageType = $_POST["stageType"];
    $department = $_POST["dep"];

    $stageReq = "INSERT INTO stage (ID_STAGE, DATE_D, DATE_F, `TYPE`, ID_DEPARTEMENT) 
            VALUES ('$newStage_id', '$startDate', '$endDate', '$stageType', '$department');";
    $dossierReq = "INSERT INTO dossier (ID_DOSSIER, CV, DEMANDE, ASSURANCE, DATE_DEPOSE, STATUT, ID_STAGE)
            VALUES ('$newDossier_id', '$fileCv', '$fileDe', '$fileAs', NOW(), 'en attendant', '$newStage_id');"; //Skipped Col : PHOTO, COPY_CIN, AUTRE_FICHERS	
    $stagiaireReq = "INSERT INTO stagiaire (ID_STAGIAIRE, CIN, NOM, PRENOM, SEXE, TEL, EMAIL, VILLE, ADRESSE, ETABLISSEMENT, NIVEAU, ID_STAGE)
            VALUES('$newStagiaire_id', '$cin','$nom','$prenom','$sexe','$tel','$email','$ville','$adresse','$uv','$niveau', '$newStage_id');";

    $stageReq_run = mysqli_query($con, $stageReq);
    if ($stageReq_run) $dossierReq_run = mysqli_query($con, $dossierReq); // Check if stage created before create stagiaire
    if ($dossierReq_run) $result = mysqli_query($con, $stagiaireReq); // Check if dossier created before create stagiaire

    if (isset($result)) {

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
