<?php
// extend -> "./create.php"
if (isset($_POST["ok"])) {

    $fileNameCv = $_FILES['cv']['name'];
    $fileNameDe = $_FILES['demande']['name'];
    $fileNameAs = $_FILES['assurance']['name'];
    $temp_name1  = $_FILES['cv']['tmp_name'];
    $temp_name2  = $_FILES['demande']['tmp_name'];
    $temp_name3  = $_FILES['assurance']['tmp_name'];

    $location = '../../uploads/';
    $location1;
    $location2;
    $location3;

    if (isset($fileNameCv)) {
        if (!empty($fileNameCv)) {
            $raw = explode('.', $fileNameCv);
            $fileExtention = strtolower(end($raw));
            $location1 = $location . 'cv/' . 'CV_' . $newStage_id . '.' . $fileExtention;
            if (move_uploaded_file($temp_name1, $location1)) {
                echo 'CV uploaded successfully <br/>';
            }
        }
    } else {
        echo '!cv <br/>';
    }
    if (isset($fileNameDe)) {
        if (!empty($fileNameDe)) {
            $raw = explode('.', $fileNameDe);
            $fileExtention = strtolower(end($raw));
            $location2 = $location . 'demande/' . 'Demande_'  . $newStage_id . '.' . $fileExtention;
            if (move_uploaded_file($temp_name2, $location2)) {
                echo 'Demande uploaded successfully <br/>';
            }
        }
    } else {
        echo '!demande <br/>';
    }
    if (isset($fileNameAs)) {
        if (!empty($fileNameAs)) {
            $raw = explode('.', $fileNameAs);
            $fileExtention = strtolower(end($raw));
            $location3 = $location . 'assurance/' . 'Assurance_'  . $newStage_id . '.' . $fileExtention;
            if (move_uploaded_file($temp_name3, $location3)) {
                echo 'Assurance uploaded successfully <br/>';
            }
        }
    } else {
        echo '!assurance <br/>';
    }

    //File name with extention to save in db
    $rawFileCv = explode('/', $location1);
    $rawFileDe = explode('/', $location2);
    $rawFileAs = explode('/', $location3);
    $fileCv = end($rawFileCv);
    $fileDe = end($rawFileDe);
    $fileAs = end($rawFileAs);
}
