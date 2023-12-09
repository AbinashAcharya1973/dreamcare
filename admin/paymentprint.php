<?php
include 'dbconfig.php';$conn= new mysqli($hostname,$username,$pwd,$databasename) or die("Could not connect to mysql".mysqli_error($con));
$_POST = json_decode(file_get_contents('php://input'), true);
	$vno=$_POST['vno'];
	$ipadd=$_SERVER['REMOTE_ADDR'];	
require('fpdf.php');

$pdf = new FPDF("P","cm",array(21,7));
$pdf->AddPage();
$pdf->SetMargins(0,0,0);
$pdf->SetAutoPageBreak(true);
$pdf->Ln(.2);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(0,0,'AK Technologies',0,0,'C');
$pdf->SetFont('Arial','',7);
$pdf->Ln(0.3);
$pdf->Cell(0,0,'GST NO:',0,0,'C');
$pdf->Ln(0.3);
$pdf->Cell(0,0,'Address:',0,0,'C');
$pdf->Ln(0.3);
$pdf->Cell(0,0,'Phone No:',0,0,'C');
$pdf->Ln(0.3);
$pdf->Cell(0,0,'Email Id :',0,0,'C');
$pdf->Ln(.5);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(0,0,'PAYMENT VOUCHER',0,0,'C');
$pdf->SetFont('Arial','B',8);
$pdf->SetFont('Arial','',8);
$pdf->Ln(.7);
$orderhead=$conn->query("select ReceiptHead.AccName as byac,ReceiptDetails.AccName as fname,ReceiptHead.ReceiptDate as rdate,ReceiptHead.Amount as ramount from ReceiptHead inner join ReceiptDetails on ReceiptHead.ReceiptNo=ReceiptDetails.ReceiptNo where ReceiptHead.ReceiptNo=".$vno);
if($row=$orderhead->fetch_assoc()) 
{ 
    $party=$row['fname'];$rdate=$row['rdate'];$ramount=$row['ramount'];$rby=$row['byac'];
};
$pdf->Cell(5,0,"Receipt No:".$vno);
$pdf->Cell(0,0,'Receipt Date :'.$rdate,0,0,'R');
$pdf->Ln(.7);
$pdf->Cell(0,0,"Received From: ".$party);
$pdf->Ln(.4);
$pdf->Cell(0,0,"The Sum of : ".$ramount);
$pdf->Ln(.4);
$pdf->Cell(0,0,"Received In : ".$rby);
$pdf->Ln(1);
$pdf->Cell(5,0,"Received By");
$pdf->Cell(0,0,'',0,0,'R');
$pdf->Output("F","pdfs/receipt-".$vno.".pdf");
?>