<?php

if(isset($_GET['id'])){

    
 require('fpdf184/fpdf.php');

$pdf = new FPDF();

$pdf->AddPage();

$pdf->SetFont('Arial', 'B', 24);

$pdf->Cell(190,20,'PiperNet Ltd',0,1,'C');

$pdf->SetFont('Arial', 'U', 16);

$pdf->Cell(100,20,'Payment Recipt',0,1,'');

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(50,8,'Customer ID',1,0,'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(80,8,$_GET['id'],1,1,'C');

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(50,8,'Date',1,0,'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(80,8,$_GET['date'],1,1,'C');

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(50,8,'Transaction Type',1,0,'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(80,8,$_GET['type'],1,1,'C');

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(50,8,'Transaction ID',1,0,'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(80,8,$_GET['tid'],1,1,'C');

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(50,8,'Amount',1,0,'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(80,8,$_GET['amount'].' BDT',1,1,'C');

$pdf->Output('recipt.pdf','D');
}


?>