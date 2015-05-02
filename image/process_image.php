<?php session_start();

function makeimage($filename, $newfilename, $path, $newwidth, $newheight) {
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
	if($height>100)
	{
	$w = 100*$width/$height;
	$h = 100;
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



	if($_GET["type"] == 'delete')
	{
	$sql_case="SELECT * from images WHERE id ='$_GET[id]' ";
						$result_case=mysql_query($sql_case);
						$row = mysql_fetch_array($result_case);
					
	mysql_query("DELETE FROM images WHERE id='$_GET[id]'");
	header("Location: ../images.php");
	unlink('../../image_email/'.$row["image"].'');
	unlink('../../image_email/tn_'.$row["image"].'');
	header("Location: ../images.php");
	}
	else
	{
	$picname = $_FILES["file"]["name"];
$dir    = '../../image_email/';
$files1 = scandir($dir);

if(in_array($picname, $files1))
{
echo 'File with same name already exists. Please change and re-upload. <a href="../images.php">Click Here</a>';
exit;
}
else
{

move_uploaded_file($_FILES["file"]["tmp_name"],"../../image_email/". $_FILES["file"]["name"]);
$new1 = makeimage($picname, 'tn_', "../../image_email/", 70, 70);
mysql_query("INSERT INTO images (image) VALUES ('$picname')");
			header("Location: ../images.php");
}
}




?>