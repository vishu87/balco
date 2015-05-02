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
//mysql_select_db("bbfs", $con);

function Duration2($s){

/* Find out the seconds between each dates */
$timestamp = $s - strtotime("now");

/* Cleaver Maths! */

$days=floor($timestamp/(60*60*24));
/* Display for date, can be modified more to take the S off */

 $str = $days; 
return $str;

}

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

		
							
							$qx = "SELECT members_priv.groups from members_priv WHERE members_priv.user_id='$_SESSION[MEM_ID]' and members_priv.sp_view = 1 and members_priv.center_id= '$_GET[center]' limit 1 ";

							$sql_priv=mysql_query($qx);
							$row_priv = mysql_fetch_array($sql_priv);
								
							$group_ids_edit = $row_priv["groups"];

							$i=0;
							$qx = "select id, group_name from groups where id IN ($group_ids_edit) order by group_name asc";

							$result_grp=mysql_query($qx);

							while($row_grp = mysql_fetch_array($result_grp))
							{
							$objPHPExcel->createSheet();
							

							$seq=2;	
							$result_att=mysql_query("select students.* from students join groups on students.first_group = groups.id WHERE students.first_group = '$row_grp[id]' order by doe asc");
							
							$count_student = 0;
$objPHPExcel->setActiveSheetIndex($i);
$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);



$objPHPExcel->getActiveSheet()->getStyle('A1:J1')->applyFromArray($styleArray1);
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'SN');
$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Name');
$objPHPExcel->getActiveSheet()->setCellValue('C1', 'CENTER');
$objPHPExcel->getActiveSheet()->setCellValue('D1', 'GROUP');
$objPHPExcel->getActiveSheet()->setCellValue('E1', 'FATHER MOB');
$objPHPExcel->getActiveSheet()->setCellValue('F1', 'MOTHER MOB');
$objPHPExcel->getActiveSheet()->setCellValue('G1', 'MONTH PLAN');
$objPHPExcel->getActiveSheet()->setCellValue('H1', 'END ON');
$objPHPExcel->getActiveSheet()->setCellValue('I1', 'AMOUNT DUE');
$objPHPExcel->getActiveSheet()->setCellValue('J1', 'DAYS LEFT');
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(3);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(8);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(10);

	//$offset= -1;
							while($row_att = mysql_fetch_array($result_att))
							{
								$sql_pay="SELECT * from payment_history WHERE student_id='$row_att[id]' ORDER BY doe DESC";
								$result_pay=mysql_query($sql_pay);
								$row_pay = mysql_fetch_array($result_pay);
								if($row_att["active"] == 1)
									{
										continue;
									}
									
									if( $row_att["doe"])
									{
									if(strtotime("now") < strtotime('- 15 days',$row_att["doe"]))
									{
										continue;
									}
									
									}
									$count_student++;
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$seq, $count_student);	
		$objPHPExcel->getActiveSheet()->setCellValue('B'.$seq, $row_att["name"]);
		$objPHPExcel->getActiveSheet()->setCellValue('C'.$seq, $row_att["center"]);
		$objPHPExcel->getActiveSheet()->setCellValue('D'.$seq, $row_att["groupid"]);
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$seq, $row_att["father_mob"]);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$seq, $row_att["mother_mob"]);
		$objPHPExcel->getActiveSheet()->setCellValue('G'.$seq, $row_pay["months"]);
		if($row_att["doe"])
		$objPHPExcel->getActiveSheet()->setCellValue('H'.$seq, date("d/m/y", $row_att["doe"]));
		
		
		$objPHPExcel->getActiveSheet()->setCellValue('I'.$seq, $row_pay["sub_fee"]);
		
		if($row_att["doe"])
									{
									
			$objPHPExcel->getActiveSheet()->setCellValue('J'.$seq,duration2($row_att["doe"] ));
		
									}
		if($count_student%2 == 0)
{
$objPHPExcel->getActiveSheet()->getStyle('A'.$seq.':'.'J'.$seq)->applyFromArray($styleArray2);
}
else
{
$objPHPExcel->getActiveSheet()->getStyle('A'.$seq.':'.'J'.$seq)->applyFromArray($styleArray3);
}		
								
								$seq++;
								}
								
								
							
// Add some data
/*$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'a')
            ->setCellValue('B2', 'world!')
            ->setCellValue('C1', 'Hello')
            ->setCellValue('D2', 'world!');*/
	$objPHPExcel->getActiveSheet()->getStyle('A1:J'.$seq.'')
->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getPageSetup()->setPrintArea('A1:J'.$seq.'');
$objPHPExcel->getActiveSheet()->getPageSetup()->setFitToWidth(1);


// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle($row_grp["group_name"]);
$i++;
}

// Set active sheet index to the first sheet, so Excel opens this as the first sheet



// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.$_GET["center"].'on'.date("d-m-Y", strtotime("today")).'.xls"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
