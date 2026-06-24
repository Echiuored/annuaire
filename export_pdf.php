<?php

session_start();

require 'config/database.php';
require 'lib/fpdf/fpdf.php';

$pdf = new FPDF();

$pdf->AddPage();

$pdf->SetFont('Arial', 'B', 16);

$pdf->Cell(190,10,'Annuaire du Personnel',0,1,'C');

$pdf->Ln(10);

$pdf->SetFont('Arial','B',10);

$pdf->Cell(40,10,'Nom',1);
$pdf->Cell(40,10,'Prenom',1);
$pdf->Cell(40,10,'Service',1);
$pdf->Cell(70,10,'Telephone',1);

$pdf->Ln();

$sql = $pdo->query("
    SELECT *
    FROM personnel
    ORDER BY nom
");

$pdf->SetFont('Arial','',10);

while($row = $sql->fetch())
{
    $pdf->Cell(40,10,$row['nom'],1);
    $pdf->Cell(40,10,$row['prenom'],1);
    $pdf->Cell(40,10,$row['service'],1);
    $pdf->Cell(70,10,$row['telephone'],1);

    $pdf->Ln();
}

$pdf->Output();