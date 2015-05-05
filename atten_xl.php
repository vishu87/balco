<?php 
error_reporting(E_ALL);
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
$objPHPExcel->getProperties()->setCreator("BBFS")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");
	
//top row
$objPHPExcel->getActiveSheet()->mergeCells('A1:AP1');
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FF000000');
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'MONTHLY REPORT');
			$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->getColor()->setARGB('FFFFFF00');
$objPHPExcel->getActiveSheet()->getStyle('A1')
->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

//CITY
$styleArray1 = array(
	'font' => array(
		'bold' => true,
	),
	'alignment' => array(
		'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	),
	
	'fill' => array(
		'type' => PHPExcel_Style_Fill::FILL_SOLID,
		
		'color' => array(
			'argb' => 'FFA0A0A0',
		),
		
	),
);
$styleArray2 = array(
	'font' => array(
		'bold' => true,
	),
	'alignment' => array(
		'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	),
	
	'fill' => array(
		'type' => PHPExcel_Style_Fill::FILL_SOLID,
		
		'color' => array(
			'argb' => 'FFEEEEEE',
		),
		
	),
);

$styleArray3 = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,),'fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('argb' => 'FFEEEEEE',),),);
$styleArray4 = array('font' => array('bold' => true,'color' => array('argb' => 'FFFFFFFF',),),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,),'fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('argb' => 'FF0A1CA5',),),);
$styleArray5 = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,),'fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('argb' => 'FFEEEEEE',),),);

$objPHPExcel->getActiveSheet()->mergeCells('A2:B2');
$objPHPExcel->getActiveSheet()->getStyle('A2')->applyFromArray($styleArray1);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A2', 'CITY');
$objPHPExcel->getActiveSheet()->mergeCells('C2:D2');
$objPHPExcel->getActiveSheet()->getStyle('C2')->applyFromArray($styleArray2);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C2', $_GET["city"]);


$objPHPExcel->getActiveSheet()->mergeCells('E2:J2');
$objPHPExcel->getActiveSheet()->getStyle('E2')->applyFromArray($styleArray1);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E2', 'CENTER');
$objPHPExcel->getActiveSheet()->mergeCells('K2:O2');
$objPHPExcel->getActiveSheet()->getStyle('K2')->applyFromArray($styleArray2);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('K2', $_GET["center"]);


$objPHPExcel->getActiveSheet()->mergeCells('P2:T2');
$objPHPExcel->getActiveSheet()->getStyle('P2')->applyFromArray($styleArray1);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('P2', 'GROUP');
$objPHPExcel->getActiveSheet()->mergeCells('U2:W2');
$objPHPExcel->getActiveSheet()->getStyle('U2')->applyFromArray($styleArray2);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('U2', $_GET["group"]);


$objPHPExcel->getActiveSheet()->mergeCells('X2:AC2');
$objPHPExcel->getActiveSheet()->getStyle('X2')->applyFromArray($styleArray1);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('X2', $_GET["month"].'/'.$_GET["year"]);


$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(3);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
$objPHPExcel->getActiveSheet()->getStyle('B4')->applyFromArray($styleArray1);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B4', 'NAMES');
$objPHPExcel->getActiveSheet()->getStyle('C4')->applyFromArray($styleArray1);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C4', 'MOBILE');
$objPHPExcel->getActiveSheet()->getStyle('AI4')->applyFromArray($styleArray1);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AI4', 'TOT');
$objPHPExcel->getActiveSheet()->getColumnDimension('AI')->setWidth(4);
$objPHPExcel->getActiveSheet()->getStyle('AJ4')->applyFromArray($styleArray1);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AJ4', '%');
$objPHPExcel->getActiveSheet()->getColumnDimension('AJ')->setWidth(4);
$objPHPExcel->getActiveSheet()->mergeCells('B5:C5');
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('B5', 'CLASS');
$objPHPExcel->getActiveSheet()->getStyle('B5')->applyFromArray($styleArray4);
		

$objPHPExcel->getActiveSheet()->getStyle('A4:A5')->applyFromArray($styleArray1);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A4', 'SN');
		
	$offset= 2;
		$seq=4;					
							for($i=1;$i<=31;$i++)
							{
							$cell_val = 65+$i+$offset;
								
									if($cell_val <=90)
							{
									 
									$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue(chr($cell_val).$seq, $i);
								$objPHPExcel->getActiveSheet()->getStyle(chr($cell_val).$seq)->applyFromArray($styleArray3);
$objPHPExcel->getActiveSheet()->getColumnDimension(chr($cell_val))->setWidth(3);								
									}
									else
							{
								$cell_val =$cell_val -26;
								 
									
									$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.chr($cell_val).$seq, $i);
									
									
							$objPHPExcel->getActiveSheet()->getStyle('A'.chr($cell_val).$seq)->applyFromArray($styleArray3);
$objPHPExcel->getActiveSheet()->getColumnDimension('A'.chr($cell_val))->setWidth(3);		
									
							
							}
									}
									
									
			$seq++;

		$groupid = $_GET["group"];
			
$sql_dummy="SELECT date from attendance WHERE student_id='dm' AND groupid='$groupid' AND month='$_GET[month]' AND year='$_GET[year]' ";
							$sql_dummy=$sql_dummy." ORDER BY id ASC";
							$result_dummy=mysql_query($sql_dummy);
							$dummy_array = array();
							$tot_class= 0;
							while($row_dummy = mysql_fetch_array($result_dummy))
							{
							 array_push($dummy_array,"$row_dummy[date]");
							 $tot_class++;
							}
							
$tot_class =0;
							for($i=1;$i<=31;$i++)
							{
							$cell_val = 65+$i+$offset;
							if($cell_val <=90)
							{
									if (in_array($i, $dummy_array))
									{ 
									
									$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue(chr($cell_val).$seq, '1');
									
									$tot_class++;
									}
									
								
							}
							
							else
							{
								$cell_val =$cell_val -26;
								if (in_array($i, $dummy_array))
									{ 
									
									$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.chr($cell_val).$seq, '1');
									$tot_class++;
									
									}
									
							
							}
							}
							$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('AI'.$seq, $tot_class);
		
			$objPHPExcel->getActiveSheet()->getStyle('AI'.$seq)->applyFromArray($styleArray3);
			$objPHPExcel->getActiveSheet()->getStyle('AJ'.$seq)->applyFromArray($styleArray3);
							
			$sql_case="SELECT id, name, father_mob,dos from students WHERE first_group = $groupid AND active = '0' ";
							$sql_case =$sql_case." ORDER BY name ASC";
							//echo $group.$sql_case;
							$result_att=mysql_query($sql_case);
							$count_student = 0;
							while($row_att = mysql_fetch_array($result_att))
							{
								$date_mon1 =strtotime( $_GET["month"].'/1/'.$_GET["year"]);
								$date_mon = strtotime( '+1 month' ,$date_mon1);
								
								if($row_att["dos"] > $date_mon)
								{

								continue;
								
								}
								
								$count_student++;
								$seq++;
								$sql_st_at="SELECT date from attendance WHERE (student_id='$row_att[id]' AND attendance='P') AND (month='$_GET[month]' AND year='$_GET[year]')  ";
								$sql_st_at=$sql_st_at." ORDER BY id ASC";
								$result_st_at=mysql_query($sql_st_at);
								$st_at = array();
								while($row_st_at = mysql_fetch_array($result_st_at))
								{
									array_push($st_at,"$row_st_at[date]");
								}
								
								$sql_st_at="SELECT date from attendance WHERE (student_id='$row_att[id]' AND attendance='A') AND (month='$_GET[month]' AND year='$_GET[year]')";
								$sql_st_at=$sql_st_at." ORDER BY id ASC";
								$result_st_at=mysql_query($sql_st_at);
								$st_at_abs = array();
								$tot_att= 0;
								while($row_st_at = mysql_fetch_array($result_st_at))
								{
									array_push($st_at_abs,"$row_st_at[date]");
								}
								
								
							
							$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('B'.$seq, $row_att["name"]);
			$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$seq, $count_student);
				$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('C'.$seq, $row_att["father_mob"]);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$seq)->applyFromArray($styleArray3);
		$objPHPExcel->getActiveSheet()->getStyle('B'.$seq)->applyFromArray($styleArray5);
		$objPHPExcel->getActiveSheet()->getStyle('C'.$seq)->applyFromArray($styleArray3);
							$tot_att = 0;
							for($i=1;$i<=31;$i++)
							{
							$cell_val = 65+$i+$offset;
								
									if($cell_val <=90)
							{
									if (in_array($i, $st_at))
									{ 
									
									$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue(chr($cell_val).$seq, '1');
			$tot_att++;
									
									
									}
									
								
							}
							
							else
							{
								$cell_val =$cell_val -26;
								if (in_array($i, $st_at))
									{ 
									
									$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.chr($cell_val).$seq, '1');
			$tot_att++;
									
									
									}
									
							
							}
								
								}
								$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('AI'.$seq, $tot_att);
			if($tot_class !=0)
			{
			$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('AJ'.$seq, $tot_att/$tot_class*100);
			}
			else
			{
			$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('AJ'.$seq, '0');
			}
			$objPHPExcel->getActiveSheet()->getStyle('AI'.$seq)->applyFromArray($styleArray3);
			$objPHPExcel->getActiveSheet()->getStyle('AJ'.$seq)->applyFromArray($styleArray3);
								}
								
								
							
// Add some data
/*$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'a')
            ->setCellValue('B2', 'world!')
            ->setCellValue('C1', 'Hello')
            ->setCellValue('D2', 'world!');*/
			


// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('BBFS');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Attendance_'.$_GET["group"].'_'.$_GET["center"].'_'.$_GET["month"].'_'.$_GET["year"].'.xls"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;