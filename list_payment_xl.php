<?php 
session_start();
include('config.php');
include('auth.php');


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

$styleArray3 = array('alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'WrapText' => true,),);

$styleArray4 = array('font' => array('bold' => true,'color' => array('argb' => 'FFFFFFFF',),),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,),'fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('argb' => 'FF0A1CA5',),),);
$styleArray5 = array('alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,),);


$objPHPExcel->getActiveSheet()->getStyle('A1:Q1')->applyFromArray($styleArray1);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'SN');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1', 'Payment Date');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C1', 'Start Date');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D1', 'End Date');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E1', 'Reg Fee');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F1', 'Sub Fee');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G1', 'Amount');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H1', 'Month Plan');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I1', 'Payment remark');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J1', 'Name');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('K1', 'City');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('L1', 'Center');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('M1', 'Group');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('N1', 'FATHER');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('O1', 'FATHER MOB');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('P1', 'FATHER EMAIL');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q1', 'VERIFIED');

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(3);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(8);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(22);
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(40);



	//$offset= -1;
		$seq=2;					

							
			$sql_case=base64_decode($_GET["case"]);
							
							$result_att=mysql_query($sql_case);
							$count_student = 0;
							while($row_att = mysql_fetch_array($result_att))
							{
								$count_student++;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$seq, $count_student);	
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$seq, date("d M y ", $row_att["dor"]));
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$seq, date("d M y ", $row_att["dos"]));
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$seq, date("d M y ", $row_att["doe"]));
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$seq, $row_att["reg_fee"]);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$seq, $row_att["sub_fee"]);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$seq, $row_att["amount"]);
		
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$seq,  $row_att["months"]);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$seq, $row_att["p_remark"]);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$seq, $row_att["name"]);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'.$seq, $row_att["train_city"]);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('L'.$seq, $row_att["center"]);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('M'.$seq, $row_att["groupid"]);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('N'.$seq, $row_att["father"]);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('O'.$seq, $row_att["father_mob"]);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('P'.$seq, $row_att["father_email"]);
		$verify = ($row_att["verified"]==1)?'Yes':'No';
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q'.$seq, $verify);
	
		
		
		if($count_student%2 == 0)
{
$objPHPExcel->getActiveSheet()->getStyle('A'.$seq.':'.'Q'.$seq)->applyFromArray($styleArray2);
}
else
{
$objPHPExcel->getActiveSheet()->getStyle('A'.$seq.':'.'Q'.$seq)->applyFromArray($styleArray3);
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



// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('BBFS');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="BBFS.xls"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;