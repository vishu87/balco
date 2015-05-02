<?php 
error_reporting(E_ALL);

date_default_timezone_set('Europe/London');

/** PHPExcel */
require_once 'phpxml/Classes/PHPExcel.php';

$arr_cat=array('Technical', 'Technical', 'Technical', 'Technical', 'Technical', 'Technical',
'Tactical', 'Tactical', 'Tactical', 'Tactical', 'Tactical', 'Tactical', 'Tactical', 'Tactical', 'Tactical', 'Tactical', 'Tactical', 'Tactical', 
'Physical', 'Physical','Physical','Physical','Physical','Physical','Physical','Physical',
'Social', 'Social',
'Mental','Mental','Mental','Mental'
);

$arr_class=array('yellow', 'yellow', 'yellow', 'yellow', 'yellow', 'yellow',
'green', 'green', 'green', 'green', 'green', 'green', 'green', 'green', 'green', 'green', 'green', 'green', 
'red', 'red','red','red','red','red','red','red',
'magenta', 'magenta',
'blue','blue','blue','blue'
);


$arr_prop=array('Ball Control', 'Dribbling', 'Receiving', 'Tackling', 'Passing', 'Finishing',
'Progression', 'Pressure', 'Supprt & Cover', 'Off The Ball', 'Delay', 'Defensive Cover', 'Support', 'Mobility', 'Space', 'Concentration', 'Balance', 'Switch_Play', 
'Flexibility', 'Agility/Balance','Agility','Pace','Endurance','Reaction','Speed','Coordination',
'Behaviour', 'Communication',
'Perseverance','Teamwork','Passion','Fairplay'
);

$reviews = array('You Have to Improve!','You Can Improve!','You are Doing Well, Carry on!','You are Very Good!','You are Excellent!!!');

function duration($s){
	$str='';
	/* Find out the seconds between each dates */
	$timestamp = strtotime("now") - $s;

	/* Cleaver Maths! */
	$years=floor($timestamp/(60*60*24*365));$timestamp%=60*60*24*365;
	$months=floor($timestamp/(60*60*24*30));
	/* Display for date, can be modified more to take the S off */
	if ($years >= 1) { $str.= $years; }
	if ($months >= 1) { //$str.= $months.'M'; 
	}
	return $str;

}

$id= base64_decode($_GET["id"]);
$month = base64_decode($_GET["q"]);
$year = base64_decode($_GET["y"]);
/*
$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("bbfs", $con);
*/

$con = mysql_connect("localhost","bbfootba","!delMUMc#@ndig@rh!");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("bbfootba_bbfs", $con);


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set properties
$objPHPExcel->getProperties()->setCreator("BBFS")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");

//styles
$styleArray1 = array(
	'font' => array(
		'bold' => true,
	),
	
	'alignment' => array(
		'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
		'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
	),
);

$styleArray2 = array(
	'font' => array(
		'bold' => false,
	),
	
	'alignment' => array(
		'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
		'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
	),
);

$border_thick= array(
	'borders' => array(
		'outline' => array(
			'style' => PHPExcel_Style_Border::BORDER_THICK,
			'color' => array('argb' => 'FF000000'),
		),
	),
);

$border_thin_in= array(
	'borders' => array(
		'inside' => array(
			'style' => PHPExcel_Style_Border::BORDER_THIN,
			'color' => array('argb' => 'FF666666'),
		),
		'outline' => array(
			'style' => PHPExcel_Style_Border::BORDER_THIN,
			'color' => array('argb' => 'FF666666'),
		),
	),
);
//top row
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(11);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(13);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(13);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(13);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(13);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(13);
$objPHPExcel->getActiveSheet()->mergeCells('A1:G1');
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'BHAICHUNG BHUTIA FOOTBALL SCHOOLS');
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->getColor()->setARGB('FFFF0000');
$objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($styleArray1);

$objPHPExcel->getActiveSheet()->mergeCells('A2:G2');
$objPHPExcel->getActiveSheet()->setCellValue('A2', 'PLAYER EVALUATION');
$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->getColor()->setARGB('FF000000');
$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setSize(9); 
$objPHPExcel->getActiveSheet()->getStyle('A2')->applyFromArray($styleArray1);

$objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(40);
$objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(40);

$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setName('Logo');
$objDrawing->setDescription('Logo');
$objDrawing->setPath('bbfs_logo.JPG');
$objDrawing->setHeight(80);
$objDrawing->setOffsetX(15);
$objDrawing->setOffsetY(15);
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

$objPHPExcel->getActiveSheet()->getStyle('A1:G2')->applyFromArray($border_thick);


//student info
$objPHPExcel->getActiveSheet()->getRowDimension('3')->setRowHeight(7);

$objPHPExcel->getActiveSheet()->mergeCells('A4:G4');
$objPHPExcel->getActiveSheet()->setCellValue('A4', 'STUDENT ELEMENTS');
$objPHPExcel->getActiveSheet()->getStyle('A4')->getFont()->getColor()->setARGB('FFFFFFFF');
$objPHPExcel->getActiveSheet()->getStyle('A4')->applyFromArray($styleArray1);
$objPHPExcel->getActiveSheet()->getStyle('A4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
->getStartColor()->setARGB('FFFF0000');
$objPHPExcel->getActiveSheet()->getRowDimension('4')->setRowHeight(20);
$objPHPExcel->getActiveSheet()->getStyle('A4')->getFont()->setSize(8); 

$sql_case="SELECT * from students WHERE id='$id'";
$sql_case =$sql_case." ORDER BY name ASC";
$result=mysql_query($sql_case);
$row = mysql_fetch_array($result);

$objPHPExcel->getActiveSheet()->getRowDimension('5')->setRowHeight(3);
$objPHPExcel->getActiveSheet()->mergeCells('A6:B6');
$objPHPExcel->getActiveSheet()->setCellValue('A6', 'NAME');
$objPHPExcel->getActiveSheet()->mergeCells('A7:B7');
$objPHPExcel->getActiveSheet()->setCellValue('A7', 'AGE');
$objPHPExcel->getActiveSheet()->mergeCells('A8:B8');
$objPHPExcel->getActiveSheet()->setCellValue('A8', 'GROUP');
$objPHPExcel->getActiveSheet()->mergeCells('A9:B9');
$objPHPExcel->getActiveSheet()->setCellValue('A9', 'CENTER');
$objPHPExcel->getActiveSheet()->getStyle('A6:A9')->getFont()->getColor()->setARGB('FF000000');
$objPHPExcel->getActiveSheet()->getStyle('A6:A9')->applyFromArray($styleArray1);
$objPHPExcel->getActiveSheet()->getStyle('A6:A9')->getFont()->setSize(8);
$objPHPExcel->getActiveSheet()->getRowDimension('6')->setRowHeight(20);
$objPHPExcel->getActiveSheet()->getRowDimension('7')->setRowHeight(20);
$objPHPExcel->getActiveSheet()->getRowDimension('8')->setRowHeight(20);
$objPHPExcel->getActiveSheet()->getRowDimension('9')->setRowHeight(20);

$objPHPExcel->getActiveSheet()->mergeCells('C6:E6');
$objPHPExcel->getActiveSheet()->setCellValue('C6', $row["name"]);
$objPHPExcel->getActiveSheet()->mergeCells('C7:E7');
$objPHPExcel->getActiveSheet()->setCellValue('C7', duration($row["dob"]));
$objPHPExcel->getActiveSheet()->mergeCells('C8:E8');
$objPHPExcel->getActiveSheet()->setCellValue('C8', $row["groupid"]);
$objPHPExcel->getActiveSheet()->mergeCells('C9:E9');
$objPHPExcel->getActiveSheet()->setCellValue('C9', $row["center"]);
$objPHPExcel->getActiveSheet()->getStyle('C6:C9')->getFont()->getColor()->setARGB('FF000000');
$objPHPExcel->getActiveSheet()->getStyle('C6:C9')->applyFromArray($styleArray1);
$objPHPExcel->getActiveSheet()->getStyle('C6:C9')->getFont()->setSize(8);

$objPHPExcel->getActiveSheet()->getStyle('A6:E9')->applyFromArray($border_thin_in);
$objPHPExcel->getActiveSheet()->getStyle('A6:G9')->applyFromArray($border_thick);

//performance

$objPHPExcel->getActiveSheet()->getRowDimension('10')->setRowHeight(5);

$objPHPExcel->getActiveSheet()->mergeCells('A11:G11');
$objPHPExcel->getActiveSheet()->setCellValue('A11', 'BBFS - DEVELOPMENT MODEL');
$objPHPExcel->getActiveSheet()->getStyle('A11')->getFont()->getColor()->setARGB('FFFFFFFF');
$objPHPExcel->getActiveSheet()->getStyle('A11')->applyFromArray($styleArray1);
$objPHPExcel->getActiveSheet()->getStyle('A11')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
->getStartColor()->setARGB('FFFF0000');
$objPHPExcel->getActiveSheet()->getRowDimension('11')->setRowHeight(20);
$objPHPExcel->getActiveSheet()->getStyle('A11')->getFont()->setSize(8); 

$sql_st_at="SELECT performa,comments from evaluation WHERE student_id='$id' AND (quarter='$month' AND year='$year') ";
$result_st_at=mysql_query($sql_st_at);
$st_at = array();
$row_st_at = mysql_fetch_array($result_st_at);
$st_at = explode(",", $row_st_at["performa"]);
$objPHPExcel->getActiveSheet()->getRowDimension('12')->setRowHeight(5);

$seq=13;
$offset= 1;
$tot_param = 1;
$start = $seq;
$params=0;
for($i=0;$i<=32;$i++)
	{
		if($i==6 && $params >0)
		{
			$objPHPExcel->getActiveSheet()->mergeCells('A'.$start.':A'.($seq-1));
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$start, $arr_cat[$i-1]);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$start)->applyFromArray($styleArray1);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$start)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFF7ED7B');
					
			//black row
			$objPHPExcel->getActiveSheet()->mergeCells('A'.$seq.':G'.$seq);
			$objPHPExcel->getActiveSheet()->getRowDimension($seq)->setRowHeight(5);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$seq)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FF000000');
			
			$seq++;
			$start = $seq;
		}
		
		if($i==18 && $params >0)
		{
			$objPHPExcel->getActiveSheet()->mergeCells('A'.$start.':A'.($seq-1));
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$start, $arr_cat[$i-1]);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$start)->applyFromArray($styleArray1);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$start)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FF7CFE9D');
					
			//black row
			$objPHPExcel->getActiveSheet()->mergeCells('A'.$seq.':G'.$seq);
			$objPHPExcel->getActiveSheet()->getRowDimension($seq)->setRowHeight(5);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$seq)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FF000000');
			
			$seq++;
			$start = $seq;
		}
		
		if($i==26 && $params >0)
		{
			$objPHPExcel->getActiveSheet()->mergeCells('A'.$start.':A'.($seq-1));
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$start, $arr_cat[$i-1]);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$start)->applyFromArray($styleArray1);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$start)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFFB9576');
					
			//black row
			$objPHPExcel->getActiveSheet()->mergeCells('A'.$seq.':G'.$seq);
			$objPHPExcel->getActiveSheet()->getRowDimension($seq)->setRowHeight(5);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$seq)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FF000000');
			
			$seq++;
			$start = $seq;
		}
		
		if($i==28 && $params >0)
		{
			$objPHPExcel->getActiveSheet()->mergeCells('A'.$start.':A'.($seq-1));
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$start, $arr_cat[$i-1]);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$start)->applyFromArray($styleArray1);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$start)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFD97EFB');
					
			//black row
			$objPHPExcel->getActiveSheet()->mergeCells('A'.$seq.':G'.$seq);
			$objPHPExcel->getActiveSheet()->getRowDimension($seq)->setRowHeight(5);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$seq)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FF000000');
			
			$seq++;
			$start = $seq;
		}
		
		if($i==32 && $params >0)
		{
			$objPHPExcel->getActiveSheet()->mergeCells('A'.$start.':A'.($seq-1));
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$start, $arr_cat[$i-1]);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$start)->applyFromArray($styleArray1);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$start)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FF90FFF8');
					
			//black row
			$objPHPExcel->getActiveSheet()->mergeCells('A'.$seq.':G'.$seq);
			$objPHPExcel->getActiveSheet()->getRowDimension($seq)->setRowHeight(5);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$seq)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FF000000');
			
		}
		
		if($i<32)
		{
			if( $i!=0)
			{
				if($arr_cat[$i] != $arr_cat[$i-1])
				$params=0;			
			}
			if($st_at[$i]>0 )
			{
				$params++;
				$cell_val = 65 + $st_at[$i] +$offset;
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$seq, $arr_prop[$i]);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$seq, $reviews[0]);
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$seq, $reviews[1]);
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$seq, $reviews[2]);
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$seq, $reviews[3]);
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$seq, $reviews[4]);
				
				if($i<=5)$objPHPExcel->getActiveSheet()->getStyle(chr($cell_val).$seq)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFF7ED7B');
				
				if($i<=17 && $i>5)$objPHPExcel->getActiveSheet()->getStyle(chr($cell_val).$seq)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FF7CFE9D');
				
				if($i<=25 && $i>17)$objPHPExcel->getActiveSheet()->getStyle(chr($cell_val).$seq)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFFB9576');
				
				if($i<=27 && $i>25)$objPHPExcel->getActiveSheet()->getStyle(chr($cell_val).$seq)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFD97EFB');
				
				if($i<=31 && $i>27)$objPHPExcel->getActiveSheet()->getStyle(chr($cell_val).$seq)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FF90FFF8');
				
				
				$objPHPExcel->getActiveSheet()->getRowDimension($seq)->setRowHeight(27);
				$objPHPExcel->getActiveSheet()->getStyle('B'.$seq.':G'.$seq)->getFont()->setSize(8); 
				$objPHPExcel->getActiveSheet()->getStyle('B'.$seq)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFEEEEEE');
				$objPHPExcel->getActiveSheet()->getStyle('B'.$seq.':G'.$seq)->applyFromArray($styleArray1);
				$objPHPExcel->getActiveSheet()->getStyle('B'.$seq.':G'.$seq)->getAlignment()->setWrapText(true);
				$objPHPExcel->getActiveSheet()->getStyle('B'.$seq.':G'.$seq)->applyFromArray($border_thin_in);
				$seq++;
			}
		}
	
	}

	$objPHPExcel->getActiveSheet()->getStyle('A13:G'.($seq-1))->applyFromArray($border_thick);
	
//observation
$seq++;
$objPHPExcel->getActiveSheet()->getRowDimension($seq)->setRowHeight(8);
$seq++;
$objPHPExcel->getActiveSheet()->getRowDimension($seq)->setRowHeight(40);
$objPHPExcel->getActiveSheet()->mergeCells('A'.$seq.':A'.$seq);
$objPHPExcel->getActiveSheet()->setCellValue('A'.$seq, 'OBSERVATIONS');
$objPHPExcel->getActiveSheet()->getStyle('A'.$seq)->applyFromArray($styleArray1);
$objPHPExcel->getActiveSheet()->getStyle('A'.$seq)->getFont()->setSize(8);


$objPHPExcel->getActiveSheet()->mergeCells('B'.$seq.':G'.$seq);
$objPHPExcel->getActiveSheet()->setCellValue('B'.$seq, $row_st_at["comments"]);
$objPHPExcel->getActiveSheet()->getStyle('B'.$seq)->applyFromArray($styleArray2);
$objPHPExcel->getActiveSheet()->getStyle('B'.$seq)->getFont()->setSize(8);
$seq++;

//directors

$objPHPExcel->getActiveSheet()->getRowDimension($seq)->setRowHeight(15);
$objPHPExcel->getActiveSheet()->mergeCells('A'.$seq.':A'.$seq);
$objPHPExcel->getActiveSheet()->setCellValue('A'.$seq, 'DIRECTORS');
$objPHPExcel->getActiveSheet()->getStyle('A'.$seq)->applyFromArray($styleArray1);
$objPHPExcel->getActiveSheet()->getStyle('A'.$seq)->getFont()->setSize(9);

$objPHPExcel->getActiveSheet()->mergeCells('B'.$seq.':C'.$seq);
$objPHPExcel->getActiveSheet()->setCellValue('B'.$seq, 'BHAICHUNG BHUTIA');
$objPHPExcel->getActiveSheet()->getStyle('B'.$seq)->applyFromArray($styleArray1);
$objPHPExcel->getActiveSheet()->getStyle('B'.$seq)->getFont()->setSize(9);

$objPHPExcel->getActiveSheet()->mergeCells('D'.$seq.':E'.$seq);
$objPHPExcel->getActiveSheet()->setCellValue('D'.$seq, 'ANURAG KHILNANI');
$objPHPExcel->getActiveSheet()->getStyle('D'.$seq)->applyFromArray($styleArray1);
$objPHPExcel->getActiveSheet()->getStyle('D'.$seq)->getFont()->setSize(9);

$objPHPExcel->getActiveSheet()->mergeCells('F'.$seq.':G'.$seq);
$objPHPExcel->getActiveSheet()->setCellValue('F'.$seq, 'KISHORE TAID');
$objPHPExcel->getActiveSheet()->getStyle('F'.$seq)->applyFromArray($styleArray1);
$objPHPExcel->getActiveSheet()->getStyle('F'.$seq)->getFont()->setSize(9);



$objPHPExcel->getActiveSheet()->getStyle('A'.$seq.':G'.$seq)->applyFromArray($border_thin_in);
$objPHPExcel->getActiveSheet()->getStyle('A'.$seq.':G'.$seq)->applyFromArray($border_thick);
// Rename sheet

$objPHPExcel->getActiveSheet()->setTitle('BBFS');
$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->getActiveSheet()->getPageMargins()->setTop(0.25);
$objPHPExcel->getActiveSheet()->getPageMargins()->setRight(0.20);
$objPHPExcel->getActiveSheet()->getPageMargins()->setLeft(0.20);
$objPHPExcel->getActiveSheet()->getPageMargins()->setBottom(0.25);
$objPHPExcel->getActiveSheet()->getPageSetup()->setHorizontalCentered(true);
$objPHPExcel->getActiveSheet()->getPageSetup()->setVerticalCentered(false);

// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Evaluation.xls"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
?>