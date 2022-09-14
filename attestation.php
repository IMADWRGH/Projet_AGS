<?php
require "./helpers/condb.php";
require('./resources/fpdf/fpdf.php');
// var_change :$nom $date_d $date_f 
if (isset($_GET["ok"])) {
    $fpdf = new FPDF('p', 'mm', 'A4');
    $fpdf->AddPage();
    $fpdf->SetFont('Arial', 'B', 22);
    $fpdf->Image('./resources/img/abhoer_lg.png', 10, 6, 30);
    $fpdf->SetTextColor(0, 0, 255);
    $fpdf->Cell(50);
    $fpdf->Cell(0, 20, 'ATTESTATION DE STAGE', 0, 'C');
    $fpdf->ln(45);
    $fpdf->SetFont('Arial', '', 15);
    $fpdf->SetTextColor(0, 0, 0);
    $h = 15;
    $retrai = "       ";
    $fpdf->write($h, $retrai . utf8_decode("Je soussigné, le Directeur de l'Agence du Bassin Hydraulique de l'Oum Er-Rbia (ABHOER) de Beni-Mellal, atteste par la présente que $nom, a effectué un stage du $date_d au $date_f au service informatique de l'Agence du Bassin Hydraulique de l'Oum Er-Rbia.\n"));
    $fpdf->ln(20);
    $fpdf->write($h, $retrai . utf8_decode("Durant cette période, l'intéressée a fait preuve d'assiduité et de sérieux irréprochables.\n"));
    $fpdf->ln(20);
    $fpdf->write($h, $retrai . utf8_decode("La présente attestation lui est délivrée sur sa demande pour servir et valoir ce que de droit."));
    $fpdf->Output('I', 'attestation.pdf', 'false');
}
