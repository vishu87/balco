<?php 
session_start();
include('config.php');
include('auth.php');

date_default_timezone_set('Europe/London');

/** PHPExcel */
require_once 'phpxml/Classes/PHPExcel.php';

$con = mysql_connect(DB_HOST,DB_USER,DB_PASSWORD);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db(DB_DATABASE, $con);
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set properties
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");
	

//CITY
$styleArray1 = array(
	'font' => array(
		'bold' => true,
		'color' => array('argb' => 'FFFFFFFF',)
	),
	'alignment' => array(
		'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
		'WrapText' => true,
	),
	
	'fill' => array(
		'type' => PHPExcel_Style_Fill::FILL_SOLID,
		
		'color' => array(
			'argb' => 'FF0344A6',
		),
		
	),
);
$styleArray2 = array(
	
	'alignment' => array(
		'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
		'WrapText' => true,
	),
	
	'fill' => array(
		'type' => PHPExcel_Style_Fill::FILL_SOLID,
		
		'color' => array(
			'argb' => 'FFEEEEEE',
		),
		
	),
);
$objPHPExcel->createSheet();
$objPHPExcel->setActiveSheetIndex(0);


$styleArray3 = array('alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'WrapText' => true,),);

$styleArray4 = array('font' => array('bold' => true,'color' => array('argb' => 'FFFFFFFF',),),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,),'fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('argb' => 'FF0A1CA5',),),);
$styleArray5 = array('alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,),);


$objPHPExcel->getActiveSheet()->getStyle('A1:T1')->applyFromArray($styleArray1);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'SN');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1', 'Name');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C1', 'DOB');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D1', 'CITY');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E1', 'CENTER');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F1', 'GROUP');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G1', 'EMAIL');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H1', 'MOBILE');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I1', 'FATHER');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J1', 'FATHER MOB');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('K1', 'FATHER EMAIL');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('L1', 'MOTHER');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('M1', 'MOTHER MOB');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('N1', 'MOTHER EMAIL');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('O1', 'MONTH PLAN');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('P1', 'START ON');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q1', 'DUE ON');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('R1', 'ADDRESS');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('S1', 'CITY');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('T1', 'STATE');
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(3);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(20);

	//$offset= -1;
		$seq=2;					

							
			$sql_case=base64_decode($_GET["case"]);
			$sql_case = preg_replace("/id, active, center, groupid, dob, name, train_city, school, father, father_mob, doe/","*", $sql_case);
							
							$result_att=mysql_query($sql_case);
							$count_student = 0;
							while($row_att = mysql_fetch_array($result_att))
							{
								$sql_pay="SELECT * from payment_history WHERE student_id='$row_att[id]' ORDER BY id DESC";
								$result_pay=mysql_query($sql_pay);
								$row_pay = mysql_fetch_array($result_pay);
								if($row_att["active"] == 1)
									{
										continue;
									}
									else
									{
									$count_student++;
									}
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$seq, $count_student);	
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$seq, $row_att["name"]);
		if($row_att["dob"])
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$seq, date("n/j/Y", $row_att["dob"]));
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$seq, $row_att["train_city"]);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$seq, $row_att["center"]);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$seq, $row_att["groupid"]);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$seq, $row_att["email"]);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$seq, $row_att["mobile"]);$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$seq, $row_att["father"]);$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$seq, $row_att["father_mob"]);$objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'.$seq, $row_att["father_email"]);$objPHPExcel->setActiveSheetIndex(0)->setCellValue('L'.$seq, $row_att["mother"]);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('M'.$seq, $row_att["mother_mob"]);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('N'.$seq, $row_att["mother_email"]);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('O'.$seq, $row_pay["months"]);
		if($row_pay["dos"])
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('P'.$seq, date("n/j/Y", $row_pay["dos"]));
		
		if($row_pay["doe"])
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q'.$seq, date("n/j/Y", $row_pay["doe"]));
		
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('R'.$seq, $row_att["address"]);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('S'.$seq, $row_att["city"]);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('T'.$seq, $row_att["state"]);
		if($count_student%2 == 0)
{
$objPHPExcel->getActiveSheet()->getStyle('A'.$seq.':'.'T'.$seq)->applyFromArray($styleArray2);
}
else
{
$objPHPExcel->getActiveSheet()->getStyle('A'.$seq.':'.'T'.$seq)->applyFromArray($styleArray3);
}		
								
								$seq++;
								}
								
								
							
// Add some data
/*$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'a')
            ->setCellValue('B2', 'world!')
            ->setCellValue('C1', 'Hello')
            ->setCellValue('D2', 'world!');*/
	$objPHPExcel->getActiveSheet()->getStyle('A1:Q'.$seq.'')
->getAlignment()->setWrapText(true);
	$objPHPExcel->getActiveSheet()->getStyle('T2'.':'.'T'.$seq)->applyFromArray($styleArray5);	
	$objPHPExcel->getActiveSheet()->getStyle('R2'.':'.'R'.$seq)->applyFromArray($styleArray5);


// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('BBFS');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="BBFS.xls"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;