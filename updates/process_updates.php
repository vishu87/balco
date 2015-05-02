<?php session_start();
function makeimage1($filename, $newfilename, $path, $newwidth, $newheight) {
    //SEARCHES IMAGE NAME STRING TO SELECT EXTENSION (EVERYTHING AFTER . )
    $imgSrc = $path.$filename;
	$newpath = $path.$newfilename.$filename;
	//getting the image dimensions
	list($width, $height) = getimagesize($imgSrc);
	$end_chars1 = substr($filename, -4);
	$end_chars2 = substr($filename, -5);
		
		if( $end_chars1 == '.jpg'|| $end_chars1 == '.JPG'||$end_chars2 == '.jpeg')
		{
			$myImage = imagecreatefromjpeg($imgSrc);
		}
		else
		{
			if($end_chars1 == '.png')
			{
				$myImage = imagecreatefrompng($imgSrc);
			}
			else
			{
				if($end_chars1 == '.gif')
				{
					$myImage = imagecreatefromgif($imgSrc);
				}
				else
				{
					
					echo 'File Extension is not recognized. <a href="../updates.php">Click Here</a>';
					exit;
				}
			}
		}

	//saving the image into memory (for manipulation with GD Library)
	
	
	///--------------------------------------------------------
	//setting the crop size
	//--------------------------------------------------------
	if($height>50)
	{
	$w = 50;
	$h = 50;
	}
	else
	{
	
	$w = $width;
	$h = $height;
	}

	 
	//getting the top left coordinate
	$c1 = array("x"=>($w-$cropWidth)/2, "y"=>($h-$cropHeight)/2);
	$thumbSize = $w;
	$thumbSize2 = $h;
	$thumb = imagecreatetruecolor($thumbSize, $thumbSize2);
	imagecopyresampled($thumb, $myImage, 0, 0,0, 0, $thumbSize, $thumbSize2, $width, $height);
	
	//--------------------------------------------------------
	//--------------------------------------------------------
	$lineWidth = 1;
	$margin    = 0;
	$green    = imagecolorallocate($thumb, 193, 252, 182);
	 
	
	//header('Content-type: image/jpeg');
	imagejpeg($thumb,$newpath,  90);
	imagedestroy($thumb);
}

function makeimage2($filename, $newfilename, $path, $newwidth, $newheight) {
    //SEARCHES IMAGE NAME STRING TO SELECT EXTENSION (EVERYTHING AFTER . )
    $imgSrc = $path.$filename;
	$newpath = $path.$newfilename.$filename;
	//getting the image dimensions
	list($width, $height) = getimagesize($imgSrc);
	$end_chars1 = substr($filename, -4);
	$end_chars2 = substr($filename, -5);
		
		if( $end_chars1 == '.jpg'|| $end_chars1 == '.JPG'||$end_chars2 == '.jpeg')
		{
			$myImage = imagecreatefromjpeg($imgSrc);
		}
		else
		{
			if($end_chars1 == '.png')
			{
				$myImage = imagecreatefrompng($imgSrc);
			}
			else
			{
				if($end_chars1 == '.gif')
				{
					$myImage = imagecreatefromgif($imgSrc);
				}
				else
				{
					
					echo 'File Extension is not recognized. <a href="../images.php">Click Here</a>';
					exit;
				}
			}
		}

	//saving the image into memory (for manipulation with GD Library)
	
	
	///--------------------------------------------------------
	//setting the crop size
	//--------------------------------------------------------
	if($width>170)
	{
	$h = 170*$height/$width;
	$w = 170;
	}
	else
	{
	
	$w = $width;
	$h = $height;
	}

	 
	//getting the top left coordinate
	$c1 = array("x"=>($w-$cropWidth)/2, "y"=>($h-$cropHeight)/2);
	$thumbSize = $w;
	$thumbSize2 = $h;
	$thumb = imagecreatetruecolor($thumbSize, $thumbSize2);
	imagecopyresampled($thumb, $myImage, 0, 0,0, 0, $thumbSize, $thumbSize2, $width, $height);
	
	//--------------------------------------------------------
	//--------------------------------------------------------
	$lineWidth = 1;
	$margin    = 0;
	$green    = imagecolorallocate($thumb, 193, 252, 182);
	 
	
	//header('Content-type: image/jpeg');
	imagejpeg($thumb,$newpath,  90);
	imagedestroy($thumb);
}

function makeimage3($filename, $newfilename, $path, $newwidth, $newheight) {
    //SEARCHES IMAGE NAME STRING TO SELECT EXTENSION (EVERYTHING AFTER . )
    $imgSrc = $path.$filename;
	$newpath = $path.$newfilename.$filename;
	//getting the image dimensions
	list($width, $height) = getimagesize($imgSrc);
	$end_chars1 = substr($filename, -4);
	$end_chars2 = substr($filename, -5);
		
		if( $end_chars1 == '.jpg'|| $end_chars1 == '.JPG'||$end_chars2 == '.jpeg')
		{
			$myImage = imagecreatefromjpeg($imgSrc);
		}
		else
		{
			if($end_chars1 == '.png')
			{
				$myImage = imagecreatefrompng($imgSrc);
			}
			else
			{
				if($end_chars1 == '.gif')
				{
					$myImage = imagecreatefromgif($imgSrc);
				}
				else
				{
					
					echo 'File Extension is not recognized. <a href="../images.php">Click Here</a>';
					exit;
				}
			}
		}

	//saving the image into memory (for manipulation with GD Library)
	
	
	///--------------------------------------------------------
	//setting the crop size
	//--------------------------------------------------------
	if($width>270)
	{
	$h = 270*$height/$width;
	$w = 270;
	}
	else
	{
	
	$w = $width;
	$h = $height;
	}

	 
	//getting the top left coordinate
	$c1 = array("x"=>($w-$cropWidth)/2, "y"=>($h-$cropHeight)/2);
	$thumbSize = $w;
	$thumbSize2 = $h;
	$thumb = imagecreatetruecolor($thumbSize, $thumbSize2);
	imagecopyresampled($thumb, $myImage, 0, 0,0, 0, $thumbSize, $thumbSize2, $width, $height);
	
	//--------------------------------------------------------
	//--------------------------------------------------------
	$lineWidth = 1;
	$margin    = 0;
	$green    = imagecolorallocate($thumb, 193, 252, 182);
	 
	
	//header('Content-type: image/jpeg');
	imagejpeg($thumb,$newpath,  90);
	imagedestroy($thumb);
}


require_once('../config.php');
$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
	if(!$link) {
		die('Failed to connect to server: ' . mysql_error());
	}
	
	//Select database
	$db = mysql_select_db(DB_DATABASE);
	if(!$db) {
		die("Unable to select database");
	}

if($_GET["type"] == 1)
{
$pic='';
move_uploaded_file($_FILES["file"]["tmp_name"],
      "../../update_image/". $_FILES["file"]["name"]);
$picname = $_FILES["file"]["name"];
if($picname)
{
$new1 = makeimage1($picname, 'tn1_', "../../update_image/", 80, 70);
$new2 = makeimage2($picname, 'tn2_', "../../update_image/", 70, 70);
$new3 = makeimage3($picname, 'tn3_', "../../update_image/", 70, 70);
unlink('../../update_image/'.$picname);
$pic=$picname;
}

$date= $_POST["month"].'/'.$_POST["date"].'/'.$_POST["year"];
$date_str = strtotime($date);
$content = addslashes($_POST["content"]);
mysql_query("INSERT INTO updates (title, content_front, content, timestamp, image)
			VALUES ('$_POST[title]','$_POST[content_front]','$content', '$date_str','$pic')");
$sql_case="SELECT id from updates ";
$sql_student =$sql_case." ORDER BY id DESC";
$result_case=mysql_query($sql_student);
$row_student = mysql_fetch_array($result_case);
$id = $row_student["id"];
mysql_query("UPDATE updates SET  pri = '$id' WHERE id='$id'");

header("Location: ../updates.php?type=view_all");
}
if($_GET["type"] == 'up')
{

mysql_query("UPDATE updates SET  pri = '$_GET[up_pri]' WHERE id='$_GET[id]'");
mysql_query("UPDATE updates SET  pri = '$_GET[pri]' WHERE id='$_GET[up_id]'");


header("Location: ../updates.php?type=view_all");
}
if($_GET["type"] == 'edit')
{
$pic='';
move_uploaded_file($_FILES["file"]["tmp_name"],
      "../../update_image/". $_FILES["file"]["name"]);
$picname = $_FILES["file"]["name"];
if($picname)
{
	$new1 = makeimage1($picname, 'tn1_', "../../update_image/", 80, 70);
	$new2 = makeimage2($picname, 'tn2_', "../../update_image/", 70, 70);
	$new3 = makeimage3($picname, 'tn3_', "../../update_image/", 70, 70);
	unlink('../../update_image/'.$picname);
	$pic=$picname;
	mysql_query("UPDATE updates SET  image='$pic' WHERE id='$_GET[id]'");
}



$content = addslashes($_POST["content"]);
$date= $_POST["month"].'/'.$_POST["date"].'/'.$_POST["year"];
$date_str = strtotime($date);

mysql_query("UPDATE updates SET  title='$_POST[title]',content = '$content', content_front = '$_POST[content_front]' , timestamp='$date_str' WHERE id='$_GET[id]'");
header("Location: ../updates.php?type=view_all");
}




if($_GET["type"] == 'delete')
{

mysql_query("delete from updates WHERE id='$_GET[id]'");



header("Location: ../updates.php?type=view_all");
}




?>