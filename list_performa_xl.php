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


$arr_prop=array('Ball_Control', 'Dribbling', 'Receiving', 'Tackling', 'Passing', 'Finishing',
'Progression', 'Pressure', 'Supprt & Cover', 'Off The Ball', 'Delay', 'Defensive_Cover', 'Support', 'Mobility', 'Space', 'Concentration', 'Balance', 'Switch_Play', 
'Flexibility', 'Agility/Balance','Agility','Pace','Endurance','Reaction','Speed','Coordination',
'Behaviour', 'Communication',
'Perseverance','Teamwork','Passion','Fairplay'
);
/*
$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("bbfs", $con);

*/
$con = mysql_connect("localhost","bbfoomlp_main","!delMUMc#@ndig@rh!");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("bbfoomlp_bbfs", $con);


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
$objPHPExcel->getActiveSheet()->mergeCells('A1:P1');
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FF000000');
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'EVALUATION REPORT');
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
			'argb' => 'DDDDDDDD',
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

$border1= array(
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

$border2= array(
	'borders' => array(
		'outline' => array(
			'style' => PHPExcel_Style_Border::BORDER_THICK,
			'color' => array('argb' => 'FFAAAAAA'),
		),
	),
);
		

$styleArray3 = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,),'fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('argb' => 'FFEEEEEE',),),);
$styleArray4 = array('font' => array('bold' => true,'color' => array('argb' => 'FFFFFFFF',),),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,),'fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('argb' => 'FF0A1CA5',),),);
$styleArray5 = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,),'fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('argb' => 'FFEEEEEE',),),);




///merging
/*
$objPHPExcel->getActiveSheet()->mergeCells('C3:H3');
$objPHPExcel->getActiveSheet()->setCellValue('C3', 'Technical');
$objPHPExcel->getActiveSheet()->setCellValue('C3', 'Technical');

$objPHPExcel->getActiveSheet()->mergeCells('I3:T3');
$objPHPExcel->getActiveSheet()->setCellValue('I3', 'Tactical');

$objPHPExcel->getActiveSheet()->mergeCells('U3:AB3');
$objPHPExcel->getActiveSheet()->setCellValue('U3', 'Physical');

$objPHPExcel->getActiveSheet()->mergeCells('AC3:AD3');
$objPHPExcel->getActiveSheet()->setCellValue('AC3', 'Social');

$objPHPExcel->getActiveSheet()->mergeCells('AE3:AH3');
$objPHPExcel->getActiveSheet()->setCellValue('AE3', 'Mental');

$objPHPExcel->getActiveSheet()->getStyle('C3:AH3')->applyFromArray($styleArray1);
*/


switch($_GET["month"])
						{
							case 1:
								$v_month = 'Jan-Mar';
								break;
							
							case 4:
								$v_month = 'Apr-Jun';
								break;
							
							case 7:
								$v_month = 'Jul-Sep';
								break;
							
							case 10:
								$v_month = 'Oct-Dec';
								break;
							
						}
$objPHPExcel->getActiveSheet()->mergeCells('A2:L2');
$objPHPExcel->getActiveSheet()->getStyle('A2')->applyFromArray($styleArray1);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A2', $_GET["group"].' / '.$_GET["center"].' / '.$_GET["city"].' / '.$v_month.' / '.$_GET["year"]);



$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(3);
$objPHPExcel->getActiveSheet()->getColumnDimension('AI')->setWidth(300);


$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
$objPHPExcel->getActiveSheet()->getStyle('B4')->applyFromArray($styleArray1);
$objPHPExcel->getActiveSheet()->setCellValue('B4', 'NAMES');
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('B5', 'Parameter');
$objPHPExcel->getActiveSheet()->getStyle('B5')->applyFromArray($styleArray4);
		

$objPHPExcel->getActiveSheet()->getStyle('A4:A5')->applyFromArray($styleArray1);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A4', 'SN');

$sql_dummy="SELECT performa from evaluation WHERE (student_id='0' AND city='$_GET[city]') AND (center='$_GET[center]' AND group_id='$_GET[group]') AND (quarter='$_GET[month]' AND year='$_GET[year]') ";
							$sql_dummy=$sql_dummy." ORDER BY id ASC";
							$result_dummy=mysql_query($sql_dummy);
							$dummy_array = array();
							$tot_class= 0;
							$row_dummy = mysql_fetch_array($result_dummy);
							$dummy_array = explode(",", $row_dummy["performa"]);
							if(sizeof($dummy_array) == 0) 
							{
							exit();
							}
							
	$offset= 1;
		$seq=4;					
							$tot_param = 1;
							$start = "C3";
							$tag_next =0;
							$last_cell ="C3";
							for($i=1;$i<=32;$i++)
							{
								
								$cell_val = 65+$tot_param+$offset;
								if($cell_val <=90)
								{
									$pos = chr($cell_val).$seq;
									$pos2 = chr($cell_val).'3';
									
								}
								else
								{
									$cell_val =$cell_val -26;
									$pos = 'A'.chr($cell_val).$seq;
									$pos2 = 'A'.chr($cell_val).'3';
								}
								
								
									if ($dummy_array[$i-1] >0)
								{
										 
									$objPHPExcel->getActiveSheet()->setCellValue($pos, $arr_prop[$i-1]);
									$objPHPExcel->getActiveSheet()->getStyle($pos)->applyFromArray($styleArray3);
									$objPHPExcel->getActiveSheet()->getStyle($pos)->getAlignment()->setTextRotation(90);
									$objPHPExcel->getActiveSheet()->getColumnDimension(chr($cell_val))->setWidth(3);								
									$tot_param++;
										if($tag_next == 1)
										{
											$start = $pos2;
											$tag_next =0;
										}
								}

								/*switch($i)
								{
									case 6:
											$objPHPExcel->getActiveSheet()->mergeCells($start.':'.$pos2);
											$objPHPExcel->getActiveSheet()->setCellValue($start, 'Technical');
											$objPHPExcel->getActiveSheet()->setCellValue($start, 'Technical');
											$objPHPExcel->getActiveSheet()->getStyle($start)->getAlignment()->setTextRotation(90);
											$tag_next=1;
											break;
									case 18:
											$objPHPExcel->getActiveSheet()->mergeCells($start.':'.$pos2);
											$objPHPExcel->getActiveSheet()->setCellValue($start, 'Tactical');
											$objPHPExcel->getActiveSheet()->setCellValue($start, 'Tactical');
											$objPHPExcel->getActiveSheet()->getStyle($start)->getAlignment()->setTextRotation(90);
											
											$tag_next=1;
											break;
									case 26:
											$objPHPExcel->getActiveSheet()->mergeCells($start.':'.$pos2);
											$objPHPExcel->getActiveSheet()->setCellValue($start, 'Physical');
											$objPHPExcel->getActiveSheet()->setCellValue($start, 'Physical');
											$objPHPExcel->getActiveSheet()->getStyle($start)->getAlignment()->setTextRotation(90);
											
											$tag_next=1;
											break;
									case 28:
											$objPHPExcel->getActiveSheet()->mergeCells($start.':'.$pos2);
											$objPHPExcel->getActiveSheet()->setCellValue($start, 'Mental');
											$objPHPExcel->getActiveSheet()->setCellValue($start, 'Mental');
											$objPHPExcel->getActiveSheet()->getStyle($start)->getAlignment()->setTextRotation(90);
											
											$tag_next=1;
											break;
									case 32:
											$objPHPExcel->getActiveSheet()->mergeCells($start.':'.$pos2);
											$objPHPExcel->getActiveSheet()->setCellValue($start, 'Social');
											$objPHPExcel->getActiveSheet()->setCellValue($start, 'Social');
											$objPHPExcel->getActiveSheet()->getStyle($start)->getAlignment()->setTextRotation(90);
											$tag_next=1;
											break;
								}
								*/
							
							}
									
									
			$seq++;
		

							
							
$tot_class =0;
							
							//$objPHPExcel->getActiveSheet()->setCellValue('AJ'.$seq, $tot_class);
		
							
			$sql_case="SELECT * from students WHERE ( train_city='$_GET[city]' AND center='$_GET[center]') AND ( groupid='$_GET[group]' AND active = '0') ";
							$sql_case =$sql_case." ORDER BY name ASC";
							//echo $group.$sql_case;
							$result_att=mysql_query($sql_case);
							$count_student = 0;
							
							while($row_att = mysql_fetch_array($result_att))
							{
							
								////CHECK1
								$date_mon1 =strtotime( $_GET["month"].'/1/'.$_GET["year"]);
								$date_mon = strtotime( '+3 month' ,$date_mon1);
								if($row_att["dos"] > $date_mon)continue;
								
								////CHECK2
								$qry1= "SELECT DISTINCT group_id from  evaluation  WHERE student_id='$row_att[id]' AND (quarter='$_GET[month]' AND year='$_GET[year]')";
								//echo $qry1;
								$result_check = mysql_query($qry1);
								//echo $row_att["dos"]."AA".strtotime($date_mon)."BB";
								$row_group_names= mysql_fetch_array($result_check);
								$total_groups = mysql_num_rows($result_check);
								
								
								if($total_groups == 1 && $row_group_names["group_id"] != $_GET["group"])
								continue;
								//CHECK ENDS
								
								
								$count_student++;
								$seq++;
								$sql_st_at="SELECT performa,comments from evaluation WHERE (student_id='$row_att[id]') AND (quarter='$_GET[month]' AND year='$_GET[year]') AND group_id='$_GET[group]'  ";
								$sql_st_at=$sql_st_at." ORDER BY id ASC";
								$result_st_at=mysql_query($sql_st_at);
								$st_at = array();
								$row_st_at = mysql_fetch_array($result_st_at);
								$st_at = explode(",", $row_st_at["performa"]);
								
								
								
							
							$objPHPExcel->getActiveSheet()->setCellValue('B'.$seq, $row_att["name"]);
							$objPHPExcel->getActiveSheet()->setCellValue('A'.$seq, $count_student);
							$objPHPExcel->getActiveSheet()->getStyle('A'.$seq)->applyFromArray($styleArray3);
							$objPHPExcel->getActiveSheet()->getStyle('B'.$seq)->applyFromArray($styleArray5);
							$tot_att = 0;
							$tot_param = 1;
							for($i=1;$i<=32;$i++)
							{
							if ($dummy_array[$i-1] >0)
							{
							$cell_val = 65+$tot_param+$offset;
								
									if($cell_val <=90)
							{
									
									if(sizeof($st_at)>1)
								{
									$objPHPExcel->getActiveSheet()->setCellValue(chr($cell_val).$seq, $st_at[$i-1]);
								}
								else
								{
									$objPHPExcel->getActiveSheet()->setCellValue(chr($cell_val).$seq, '');
								}
									
								
							}
							
							else
							{
								$cell_val =$cell_val -26;
								
										if(sizeof($st_at)>1)
								{
									$objPHPExcel->getActiveSheet()->setCellValue('A'.chr($cell_val).$seq, $st_at[$i-1]);
								}
								else
								{
									$objPHPExcel->getActiveSheet()->setCellValue('A'.chr($cell_val).$seq, '');
								}
									
							
							}
								$tot_param++;
								}
								}
								
							$cell_val = 65+$tot_param+$offset;
								
									if($cell_val <=90)
							{		
									$pos=chr($cell_val).$seq;	
							}
							else
							{
									$cell_val =$cell_val -26;
								$pos ='A'.chr($cell_val).$seq;
							}
							$objPHPExcel->getActiveSheet()->setCellValue($pos, $row_st_at["comments"]);
							$tot_param++;
							$cell_val = 65+$tot_param+$offset;
								
									if($cell_val <=90)
							{		
									$pos=chr($cell_val).$seq;	
									$pos_col=chr($cell_val);	
							}
							else
							{
									$cell_val =$cell_val -26;
								$pos ='A'.chr($cell_val).$seq;
								$pos_col ='A'.chr($cell_val);
							}
							$objPHPExcel->getActiveSheet()->setCellValue($pos, $row_att["name"]);
							
							$objPHPExcel->getActiveSheet()->getStyle($pos)->applyFromArray($styleArray5);
							$objPHPExcel->getActiveSheet()->getColumnDimension($pos_col)->setWidth(20);
							$objPHPExcel->getActiveSheet()->getStyle('A3:'.$pos.'')->applyFromArray($border1);
								}
								
	$objPHPExcel->getActiveSheet()->getStyle('A6:AJ'.$seq.'')->getAlignment()->setWrapText(true);
	$objPHPExcel->getActiveSheet()->getStyle('A6:AJ'.$seq.'')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$seq++;
$tot_param = 1;
for($i=1;$i<=32;$i++)
							{
								
								$cell_val = 65+$tot_param+$offset;
								if($cell_val <=90)
								{
									$pos = chr($cell_val).$seq;
									$pos2 = chr($cell_val).'3';
									
								}
								else
								{
									$cell_val =$cell_val -26;
									$pos = 'A'.chr($cell_val).$seq;
									$pos2 = 'A'.chr($cell_val).'3';
								}
								
								
									if ($dummy_array[$i-1] >0)
								{
										 
									$objPHPExcel->getActiveSheet()->setCellValue($pos, $arr_prop[$i-1]);
									$objPHPExcel->getActiveSheet()->getStyle($pos)->applyFromArray($styleArray3);
									$objPHPExcel->getActiveSheet()->getStyle($pos)->getAlignment()->setTextRotation(90);
									$objPHPExcel->getActiveSheet()->getColumnDimension(chr($cell_val))->setWidth(3);								
									$tot_param++;
										if($tag_next == 1)
										{
											$start = $pos2;
											$tag_next =0;
										}
								}

								/*switch($i)
								{
									case 6:
											$objPHPExcel->getActiveSheet()->mergeCells($start.':'.$pos2);
											$objPHPExcel->getActiveSheet()->setCellValue($start, 'Technical');
											$objPHPExcel->getActiveSheet()->setCellValue($start, 'Technical');
											$objPHPExcel->getActiveSheet()->getStyle($start)->getAlignment()->setTextRotation(90);
											$tag_next=1;
											break;
									case 18:
											$objPHPExcel->getActiveSheet()->mergeCells($start.':'.$pos2);
											$objPHPExcel->getActiveSheet()->setCellValue($start, 'Tactical');
											$objPHPExcel->getActiveSheet()->setCellValue($start, 'Tactical');
											$objPHPExcel->getActiveSheet()->getStyle($start)->getAlignment()->setTextRotation(90);
											
											$tag_next=1;
											break;
									case 26:
											$objPHPExcel->getActiveSheet()->mergeCells($start.':'.$pos2);
											$objPHPExcel->getActiveSheet()->setCellValue($start, 'Physical');
											$objPHPExcel->getActiveSheet()->setCellValue($start, 'Physical');
											$objPHPExcel->getActiveSheet()->getStyle($start)->getAlignment()->setTextRotation(90);
											
											$tag_next=1;
											break;
									case 28:
											$objPHPExcel->getActiveSheet()->mergeCells($start.':'.$pos2);
											$objPHPExcel->getActiveSheet()->setCellValue($start, 'Mental');
											$objPHPExcel->getActiveSheet()->setCellValue($start, 'Mental');
											$objPHPExcel->getActiveSheet()->getStyle($start)->getAlignment()->setTextRotation(90);
											
											$tag_next=1;
											break;
									case 32:
											$objPHPExcel->getActiveSheet()->mergeCells($start.':'.$pos2);
											$objPHPExcel->getActiveSheet()->setCellValue($start, 'Social');
											$objPHPExcel->getActiveSheet()->setCellValue($start, 'Social');
											$objPHPExcel->getActiveSheet()->getStyle($start)->getAlignment()->setTextRotation(90);
											$tag_next=1;
											break;
								}
								*/
							
							}
							


							
// Add some data
/*$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'a')
            ->setCellValue('B2', 'world!')
            ->setCellValue('C1', 'Hello')
            ->setCellValue('D2', 'world!');*/
			


// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('BBFS');
$objPHPExcel->getActiveSheet()->freezePane('A6');;
$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Evaluation-'.$_GET["group"].'-'.$_GET["center"].' on'.date("d-m-Y", strtotime("today")).'.xls"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
?>