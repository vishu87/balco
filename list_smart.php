<?php 
error_reporting(E_ALL);
set_time_limit ( 3600 ) ;
date_default_timezone_set('Europe/London');

/** PHPExcel */
require_once 'phpxml/Classes/PHPExcel.php';
include('simple_html_dom.php');
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


$objPHPExcel->getActiveSheet()->getStyle('A1:I1')->applyFromArray($styleArray1);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'Last Name');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1', 'First Name');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C1', 'Street Address');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D1', 'City Adress');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E1', 'Country');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F1', 'Phone');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G1', 'Email');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H1', 'Site');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I1', 'Fax');

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(5);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10);


	//$offset= -1;
$seq=2;					

							
		
								for($i=$_GET["s"];$i<=$_GET["e"];$i++)
							{
							
							$matter = file_get_html("http://www.epo.org/prdb/db?=&country=AL&city=&action=showDetails&name=&id=".$i);
	$f_name='';
	$l_name='';
	$address='';
	$con='';
	$city='';
	$phone='';
	$email="";
	$site='';
	$fax='';
	$count=0;
	foreach($matter->find('td') as $element)
	{
		$line= trim($element->plaintext);
		//echo $line;
		if($count==0)
		{
			$word = explode(',', $line);
			//echo strlen($line);
			$f_name=substr($word[1],0,-4);
			$l_name=$word[0];
			$count++;
			
		}
		else
		{
		if($count==1)
		{
			$address=$line;
			$count++;
		}
		else
		{
		if($count==2)
		{
			if(substr($line,2,1)== '-')
			{
				$count++;
			}
			else
			{
				$address=$address.', '.$line;
			}
		}
		if($count==3)
		{
			//echo "Address: ".$address;
			$con=substr($line,0,2);
			//echo "Country:".$con;
			//$word2 = explode('-', $line);
			//$city = $word2[1];
			$city = $line;
			//echo "city:".$city;
			$count++;
		}
		if(substr($line,0,3)== 'Tel')
		{
			$phone=substr($line,10);
			//echo "Phone:".$phone;
		}
		if(substr($line,0,6)== 'E-mail')
		{
			$email=substr($line,13);
			//echo "Email:".$email;
		}
		if(substr($line,0,3)== 'WWW')
		{
			$site=substr($line,10);
			//echo "SIte:".$site;
		}
		if(substr($line,0,3)== 'Fax')
		{
			$fax=substr($line,10);
			//echo "fax:".$fax;
		}
		}
		}
	}
	
	
								
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$seq, $l_name);	
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$seq, $f_name);
		
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$seq, $address);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$seq, $city);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$seq, $con);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$seq, $phone);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$seq, $email);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$seq, $site);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$seq, $fax);
		if($i%2 == 0)
{
$objPHPExcel->getActiveSheet()->getStyle('A'.$seq.':'.'I'.$seq)->applyFromArray($styleArray2);
}
else
{
$objPHPExcel->getActiveSheet()->getStyle('A'.$seq.':'.'I'.$seq)->applyFromArray($styleArray3);
}		
								
								$seq++;
								}
								
								
							
// Add some data
/*$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'a')
            ->setCellValue('B2', 'world!')
            ->setCellValue('C1', 'Hello')
            ->setCellValue('D2', 'world!');*/
	$objPHPExcel->getActiveSheet()->getStyle('A1:I'.$seq.'')
->getAlignment()->setWrapText(true);



// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('Ouput');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="output.xls"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
