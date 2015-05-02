<?php session_start();

function makeimage($filename, $newfilename, $path, $newwidth, $newheight) {
    //SEARCHES IMAGE NAME STRING TO SELECT EXTENSION (EVERYTHING AFTER . )
    $imgSrc = $path.$filename;
	$newpath = $path.$newfilename.$filename;
	//getting the image dimensions
	list($width, $height) = getimagesize($imgSrc);
	$end_chars1 = substr($filename, -4);
	$end_chars2 = substr($filename, -5);
		
		if( $end_chars1 == '.jpg'|| $end_chars2 == '.jpeg')
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
					
					header("Location: ../students.php?type=browse&id=".$_GET["id"]);
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


function makeimage2($filename, $newfilename, $path, $newwidth, $newheight) {
          //SEARCHES IMAGE NAME STRING TO SELECT EXTENSION (EVERYTHING AFTER . )
    $imgSrc = $path.$filename;
	 $newpath = $path.$newfilename.$filename;
	//getting the image dimensions
	list($width, $height) = getimagesize($imgSrc);
	 
	//saving the image into memory (for manipulation with GD Library)
	$myImage = imagecreatefromjpeg($imgSrc);
	///--------------------------------------------------------
	//setting the crop size
	//--------------------------------------------------------
	if($height>600)
	{
	$w = 600*$width/$height;
	$h = 600;
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
$sql_case="SELECT * from members WHERE username ='$_POST[username]'";
$result_case=mysql_query($sql_case);
$num_rows = mysql_num_rows($result_case);
if($num_rows > 0)
{
 header("Location: ../manage.php?type=member&err=1");
}
else
{
move_uploaded_file($_FILES["file"]["tmp_name"],
      "../images/". $_FILES["file"]["name"]);
$picname = $_FILES["file"]["name"];
if($picname)
{
$new1 = makeimage($picname, 'tn_', "../images/", 70, 70);
//$new2 = makeimage2($picname, 'tn2_', "../images/", 70, 70);
}
$feed_date =strtotime("now");
$dob = $_POST["month"].'/'.$_POST["date"].'/'.$_POST["year"];
$dob_str = strtotime($dob);
$pass = md5($_POST["username"]);
// $sql ="INSERT INTO members (name, username, password, priv, edit_priv, dob, email, mobile, train_city, center, address, city, state, pic)
// 			VALUES ('$_POST[name]', '$_POST[username]', '$pass', '$_POST[priv]', '$_POST[edit_pr]', '$dob_str', '$_POST[email]', '$_POST[mobile]', '$_POST[train_city]', '$_POST[train_center]', '$_POST[address]',' $_POST[city]','$_POST[state]', '$picname' )";
$sql ="INSERT INTO members (name, username, password, dob, email, mobile, address, city, state, pic, updates, query_table, structure, add_city, add_center) VALUES ('$_POST[name]', '$_POST[username]', '$pass', '$dob_str', '$_POST[email]', '$_POST[mobile]', '$_POST[address]',' $_POST[city]','$_POST[state]', '$picname', '$_POST[updates]','$_POST[query_table]','$_POST[structure]','$_POST[add_city]','$_POST[add_center]' )";
mysql_query($sql);

header("Location: ../manage.php?type=member");
}
}






if($_GET["type"] == 2)
{
move_uploaded_file($_FILES["file"]["tmp_name"],
      "../images/". $_FILES["file"]["name"]);
$picname = $_FILES["file"]["name"];
if($picname)
{
$new1 = makeimage($picname, 'tn_', "../images/", 70, 70);
//$new2 = makeimage2($picname, 'tn2_', "images/", 70, 70);
mysql_query("UPDATE members SET pic = '$picname' WHERE username='$_SESSION[SESS_MEMBER_ID]'");
}

$feed_date =strtotime("now");
$dob = $_POST["month"].'/'.$_POST["date"].'/'.$_POST["year"];
$dob_str = strtotime($dob);
mysql_query("UPDATE members SET name = '$_POST[name]',dob = '$dob_str', email='$_POST[email]', mobile = '$_POST[mobile]', address='$_POST[address]', city='$_POST[city]', state='$_POST[state]' WHERE username='$_SESSION[SESS_MEMBER_ID]'");

header("Location: ../manage.php?type=profile");
}

if($_GET["type"] == 3)
{
$sql="SELECT * from members WHERE username='$_SESSION[SESS_MEMBER_ID]'";
											$result=mysql_query($sql);
											$row = mysql_fetch_array($result);
$pass = md5($_POST["new_p"]);
if(md5($_POST["new_p"]) == md5($_POST["re_new_p"]))
{

	if($row["password"] == md5($_POST["old_p"]))
	{
	mysql_query("UPDATE members SET password = '$pass'  WHERE username='$_SESSION[SESS_MEMBER_ID]'");
	header("Location: ../manage.php?type=profile&err=3");
	}
	else
	{
	header("Location: ../manage.php?type=profile&err=1");
	}
}
else
{
header("Location: ../manage.php?type=profile&err=2");
}


}

if($_GET["type"] == 4)
{
move_uploaded_file($_FILES["file"]["tmp_name"],
      "../images/". $_FILES["file"]["name"]);
$picname = $_FILES["file"]["name"];
if($picname)
{
$new1 = makeimage($picname, 'tn_', "../images/", 70, 70);
//$new2 = makeimage2($picname, 'tn2_', "images/", 70, 70);
mysql_query("UPDATE members SET pic = '$picname' WHERE username='$_POST[username]'");
}
$centers = (isset($_POST["centers"]))?implode(',', $_POST["centers"]):'';
	
$feed_date =strtotime("now");
$dob = $_POST["month"].'/'.$_POST["date"].'/'.$_POST["year"];
$dob_str = strtotime($dob);
$sql = "UPDATE members SET name = '$_POST[name]',dob = '$dob_str', email='$_POST[email]', mobile = '$_POST[mobile]', address='$_POST[address]', city='$_POST[city]', state='$_POST[state]', add_city = '$_POST[add_city]',add_center = '$_POST[add_center]',updates = '$_POST[updates]',query_table = '$_POST[query_table]',structure = '$_POST[structure]' WHERE id='$_POST[user_id]'";

mysql_query($sql);

header("Location: ../manage.php?type=member&info=yes&id=".$_GET["id"]);
}



if($_GET["type"] == 5)
{
$qry="SELECT * FROM members WHERE id='$_GET[id]'";
$result=mysql_query($qry);
$row_edit = mysql_fetch_array($result);
if($row_edit["active"] == 0)
{
mysql_query("UPDATE members SET active = '1' WHERE id='$_GET[id]'");
}
else
{
mysql_query("UPDATE members SET active = '0' WHERE id='$_GET[id]'");
}


header("Location: ../manage.php?type=member");
}

if($_GET["type"] == 6)
{

mysql_query("DELETE FROM members WHERE id='$_GET[id]'");



header("Location: ../manage.php?type=member&info=del");
}


?>