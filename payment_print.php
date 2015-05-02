<?php
require('fpdf.php');

class PDF extends FPDF
{
// Page header
function Header()
{
	// Logo
	$this->Image('logo.png',20,6);
	// Arial bold 15
	// Line break
	$this->Ln(25);
}

}

// Instanciation of inherited class

// Begin configuration

$textColour = array( 0, 0, 0 );
$headerColour = array( 100, 100, 100 );
$tableHeaderTopTextColour = array( 255, 255, 255 );
$tableHeaderTopFillColour = array( 125, 152, 179 );
$tableHeaderTopProductTextColour = array( 0, 0, 0 );
$tableHeaderTopProductFillColour = array( 143, 173, 204 );
$tableHeaderLeftTextColour = array( 99, 42, 57 );
$tableHeaderLeftFillColour = array( 184, 207, 229 );
$tableBorderColour = array( 50, 50, 50 );
$tableRowFillColour = array( 213, 170, 170 );
$reportName = "2009 Widget Sales Report";
$reportNameYPos = 160;
$logoFile = "widget-company-logo.png";
$logoXPos = 50;
$logoYPos = 108;
$logoWidth = 110;
$columnLabels = array( "Q1", "Q2", "Q3", "Q4" );
$rowLabels = array( "SupaWidget", "WonderWidget", "MegaWidget", "HyperWidget" );
$chartXPos = 20;
$chartYPos = 250;
$chartWidth = 160;
$chartHeight = 80;
$chartXLabel = "Product";
$chartYLabel = "2009 Sales";
$chartYStep = 20000;

$chartColours = array(
                  array( 255, 100, 100 ),
                  array( 100, 255, 100 ),
                  array( 100, 100, 255 ),
                  array( 255, 255, 100 ),
                );

$data = array(
          array( 9940, 10100, 9490, 11730 ),
          array( 19310, 21140, 20560, 22590 ),
          array( 25110, 26260, 25210, 28370 ),
          array( 27650, 24550, 30040, 31980 ),
        );

// End configuration


$pdf = new PDF();
$pdf->AddPage();
$pdf->SetTextColor( 255,255,255 );
$pdf->SetFont( 'Arial', '', 10 );
$pdf->SetFillColor(195,14,13);
$pdf->Cell(0,5,'Receipt of payment ',0,1,'L',true);
$pdf->Ln(1);
// Create the table header row
$pdf->SetFont( 'Arial', 'B', 11 );

// "PRODUCT" cell
$pdf->SetTextColor( 0,0,0 );


 $pdf->Cell( 96, 12, 'Name', 0, 0, 'L' );
 $pdf->Cell( 70, 12, 'Name', 0, 0, 'L' );


$pdf->Ln( 6 );
$pdf->Cell( 96, 12, 'Father\'s Name', 0, 0, 'L' );
  $pdf->Cell( 70, 12, 'Name', 0, 0, 'L' );
  $pdf->Ln( 6 );

  $pdf->Cell( 96, 12, 'Group', 0, 0, 'L' );
  $pdf->Cell( 70, 12, ':   Name', 0, 0, 'L' );
  $pdf->Ln( 6 );
  $pdf->Cell( 96, 12, 'Subscription Period:', 0, 0, 'L' );
  $pdf->Cell( 70, 12, 'Name', 0, 0, 'L' );
  $pdf->Ln( 6 );
  $pdf->Cell( 96, 12, 'Paid Amount', 0, 0, 'L' );
  $pdf->Cell( 70, 12, 'Name', 0, 0, 'L' );
  $pdf->Ln( 6 );
$pdf->Cell( 96, 12, 'Payment Date', 0, 0, 'L' );
  $pdf->Cell( 70, 12, 'Name', 0, 0, 'L' );
  $pdf->Ln( 6 );
  
$pdf->Cell( 96, 12, 'Payment Information', 0, 0, 'L' );
  $pdf->Cell( 70, 12, 'Name', 0, 0, 'L' );
$pdf->Output( "report.pdf", "I" );
?>
