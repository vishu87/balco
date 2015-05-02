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
require_once('../auth.php');
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
$dos = strtotime($_POST["dos"]);
$dor = strtotime($_POST["dor"]);
$doe = strtotime($_POST["doe"]);
$sql_group = mysql_query("SELECT id from groups where city_name='$_POST[train_city]' AND center_name ='$_POST[train_center]' AND group_name='$_POST[groupid]' limit 1");
$row_group = mysql_fetch_array($sql_group);
$group_id = $row_group["id"];
mysql_query("INSERT INTO students (name, dob, email, school, mobile, status_email, status_mob, train_city, center,  groupid, first_group, father, father_mob, father_email, father_status_mob, father_status_email, mother, mother_mob, mother_email, mother_status_mob , mother_status_email, address, city, state, pic, dos, doe, add_date, added_by)
			VALUES ('$_POST[name]', '$dob_str','$_POST[email]','$_POST[school]', '$_POST[mobile]', '$_POST[status_email]', '$_POST[status_mob]', '$_POST[train_city]', '$_POST[train_center]','$_POST[groupid]','$group_id','$_POST[father]','$_POST[father_mob]', '$_POST[father_email]','$_POST[father_status_mob]', '$_POST[father_status_email]' , '$_POST[mother]','$_POST[mother_mob]', '$_POST[mother_email]','$_POST[mother_status_mob]', '$_POST[mother_status_email]', '$_POST[address]','$_POST[city]','$_POST[state]','$picname', '$dos', '$doe','$feed_date','$_SESSION[SESS_MEMBER_ID]' )");
$sql_case="SELECT * from students ";
$sql_student =$sql_case." ORDER BY id DESC";
$result_case=mysql_query($sql_student);
$row_student = mysql_fetch_array($result_case);
$id = $row_student["id"];
$email = $row_student["email"];
if($dos && $doe){
	$sql = "INSERT INTO payment_history (student_id, email, dos, dor, doe, reg_fee,sub_fee,kit_fee,amount, months, adjustment, p_remark, a_remark, date, added_by) VALUES ('$id', '$email', '$dos', '$dor', '$doe','$_POST[reg_fee]','$_POST[sub_fee]','$_POST[kit_fee]' ,'$_POST[amount]', '$_POST[mplan]','$_POST[adjust]','$_POST[p_remark]','$_POST[a_remark]','$feed_date','$_SESSION[SESS_MEMBER_ID]')";
mysql_query($sql);
}


header("Location: ../students.php?type=browse&id=".$id);
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
mysql_query("UPDATE students SET pic = '$picname' WHERE id='$_GET[id]'");
}

$feed_date =strtotime("now");
$dob = $_POST["month"].'/'.$_POST["date"].'/'.$_POST["year"];
$dob_str = strtotime($dob);
$dos = strtotime($_POST["dos"]);
$doe = strtotime($_POST["doe"]);

mysql_query("UPDATE students SET name = '$_POST[name]',dob = '$dob_str', email='$_POST[email]', school='$_POST[school]', mobile='$_POST[mobile]', status_email='$_POST[status_email]', status_mob='$_POST[status_mob]', father='$_POST[father]', father_mob = '$_POST[father_mob]',father_email = '$_POST[father_email]', father_status_mob = '$_POST[father_status_mob]', father_status_email = '$_POST[father_status_email]', mother='$_POST[mother]' , mother_mob = '$_POST[mother_mob]',mother_email = '$_POST[mother_email]',mother_status_mob = '$_POST[mother_status_mob]', mother_status_email = '$_POST[mother_status_email]', address='$_POST[address]', city='$_POST[city]', state='$_POST[state]', second_group = '$_POST[second_group]' WHERE id='$_GET[id]'");

header("Location: ../students.php?type=browse&id=".$_GET["id"]);
}


if($_GET["type"] == 'paystart')
{
$feed_date =strtotime("now");

$doe = strtotime($_POST["doe"]);
$dos = strtotime($_POST["dos"]);
$dor = strtotime($_POST["dor"]);
mysql_query("INSERT INTO payment_history (student_id, email, dos, dor, doe,reg_fee,sub_fee, kit_fee ,amount, months, adjustment, p_remark, a_remark, date, added_by)
			VALUES ('$_GET[id]', '$email','$dos', '$dor', '$doe' ,'$_POST[reg_fee]','$_POST[sub_fee]','$_POST[kit_fee]','$_POST[amount]', '$_POST[mplan]','$_POST[adjust]','$_POST[p_remark]','$_POST[a_remark]','$feed_date','$_SESSION[SESS_MEMBER_ID]') ");

mysql_query("UPDATE students SET active = '0' WHERE id='$_GET[id]'");

$sql_case="SELECT * from payment_history WHERE student_id='$_GET[id]' ORDER by doe DESC ";
$result_case=mysql_query($sql_case);
$row_student = mysql_fetch_array($result_case);
mysql_query("UPDATE students SET doe= '$row_student[doe]' WHERE id='$_GET[id]' ");

$sql_case="SELECT * from payment_history WHERE student_id='$id' ORDER by dos ASC ";
$result_case=mysql_query($sql_case);
$row_student = mysql_fetch_array($result_case);
mysql_query("UPDATE students SET dos= '$row_student[dos]' WHERE id='$_GET[id]'");


header("Location: ../students.php?type=browse&id=".$_GET["id"]);
}

if($_GET["type"] == 'payedit')
{
$feed_date =strtotime("now");

$doe = strtotime($_POST["doe"]);
$dos = strtotime($_POST["dos"]);
$dor = strtotime($_POST["dor"]);
mysql_query("UPDATE payment_history SET student_id='$_GET[id]', email='$email', dos='$dos', dor='$dor', doe='$doe', reg_fee='$_POST[reg_fee]',sub_fee='$_POST[sub_fee]',kit_fee='$_POST[kit_fee]',amount='$_POST[amount]', months='$_POST[mplan]', adjustment='$_POST[adjust]', p_remark='$_POST[p_remark]', a_remark='$_POST[a_remark]', date='$feed_date', added_by='$_SESSION[SESS_MEMBER_ID]' WHERE id='$_POST[pay_id]'");

$id= $_GET["id"];

$sql_case="SELECT * from payment_history WHERE student_id='$id' ORDER by doe DESC ";
$result_case=mysql_query($sql_case);
$row_student = mysql_fetch_array($result_case);
mysql_query("UPDATE students SET doe= '$row_student[doe]' WHERE id='$id'");
if($row_student["doe"] > strtotime("now"))
{
mysql_query("UPDATE students SET active= '0' WHERE id='$id'");
}

$sql_case="SELECT * from payment_history WHERE student_id='$id' ORDER by dos ASC ";
$result_case=mysql_query($sql_case);
$row_student = mysql_fetch_array($result_case);
mysql_query("UPDATE students SET dos= '$row_student[dos]' WHERE id='$id'");



header("Location: ../students.php?type=browse&id=".$_GET["id"]);
}


if($_GET["type"] == 'inactive')
{

$doi = strtotime($_POST["doi"]);
mysql_query("UPDATE students SET active= '-1', main_reason ='$_POST[inactive_reason]' , other_reason='$_POST[other_reason]' WHERE id='$_GET[id]'");

mysql_query("INSERT into inactive_history (student_id,inactive_on,add_date,added_by) VALUES ('$_GET[id]','$doi','".strtotime("now")."','$_SESSION[SESS_MEMBER_ID]') ");

header("Location: ../students.php?type=browse&id=".$_GET["id"]);
}



if($_GET["type"] == 6)
{

$sql_case="SELECT * from payment_history WHERE id='$_GET[id]' ";
$result_case=mysql_query($sql_case);
$row_student = mysql_fetch_array($result_case);
$id= $row_student["student_id"];

mysql_query("DELETE FROM payment_history WHERE id='$_GET[id]'");

$sql_case="SELECT * from payment_history WHERE student_id='$id' ORDER by doe DESC ";
$result_case=mysql_query($sql_case);
$row_student = mysql_fetch_array($result_case);
mysql_query("UPDATE students SET doe= '$row_student[doe]' WHERE id='$id'");

$sql_case="SELECT * from payment_history WHERE student_id='$id' ORDER by dos ASC ";
$result_case=mysql_query($sql_case);
$row_student = mysql_fetch_array($result_case);
mysql_query("UPDATE students SET dos= '$row_student[dos]' WHERE id='$id'");

header("Location: ../students.php?type=browse&id=".$id);
}

if($_GET["type"] == 'injury_add')
{

$dos = strtotime($_POST["in_dos"]);
$feed_date =strtotime("now");
mysql_query("INSERT INTO injury_history (student_id, dos, remark, date, added_by)
			VALUES ('$_GET[id]', '$dos','$_POST[remark]','$feed_date','$_SESSION[SESS_MEMBER_ID]') ");
	header("Location: ../students.php?type=browse&id=".$_GET["id"]);		

}

if($_GET["type"] == 'injury_update')
{

$dos = strtotime($_POST["in_dos"]);
$doe = strtotime($_POST["in_doe"]);
$feed_date =strtotime("now");
mysql_query("UPDATE injury_history SET dos= '$dos', doe = '$doe', remark = '$_POST[remark]' WHERE id='$_GET[inj_id]'");

	header("Location: ../students.php?type=browse&id=".$_GET["id"]);		

}

if($_GET["type"] == 'injury_del')
{
mysql_query("DELETE FROM injury_history WHERE id='$_GET[inj_id]'");


	header("Location: ../students.php?type=browse&id=".$_GET["id"]);		

}

if($_GET["type"] == 'chat')
{
	$chat = mysql_real_escape_string($_POST["chat"]);
	$student_id = mysql_real_escape_string($_GET["id"]);
	$added_by = $_SESSION["SESS_MEMBER_ID"];
	$add_date = strtotime("now");
	mysql_query("INSERT into student_chat (student_id, chat, add_date, added_by) VALUES ('$student_id', '$chat', '$add_date', '$added_by') ");

	header("Location: ../students.php?type=browse&id=".$student_id);		
}


if($_GET["type"] == 'app_in')
{
	$student_id = mysql_real_escape_string($_GET["id"]);

	mysql_query("UPDATE students set active = '1' where id = '$student_id' ");

	header("Location: ../students.php?type=approve_inactive");		
}

if($_GET["type"] == 'disapp_in')
{
	$student_id = mysql_real_escape_string($_GET["id"]);

	mysql_query("UPDATE students set active = '0' where id = '$student_id' ");

	header("Location: ../students.php?type=approve_inactive");		
}

if($_GET["type"] == 'shift')
{
	$first_group = mysql_real_escape_string($_POST["first_group"]);
	$old_group = mysql_real_escape_string($_POST["old_group"]);
	$student_id = mysql_real_escape_string($_GET["id"]);
	$doc = mysql_real_escape_string($_POST["doc"]);

	$added_by = $_SESSION["SESS_MEMBER_ID"];
	$add_date = strtotime("now");

	if($first_group == $old_group || $first_group == 0 || $first_group == '' || $old_group == 0 || $old_group == ''){
		header("Location: ../students.php?type=edit&id=".$_GET["id"]."&err=".urlencode(base64_encode("Can not shift to same group/Wrong Group Deatils")));
	} else {
		if(($timestamp = strtotime($doc)) !== false){

			$shift_date = strtotime($doc);
			mysql_query("UPDATE students set first_group = '$first_group' where id='$student_id' ");

			mysql_query("INSERT into group_shift (student_id, old_group, new_group, shift_date, done_by) VALUES ('$student_id','$old_group','$first_group','$shift_date','$added_by') ");
			
			header("Location: ../students.php?type=edit&id=".$_GET["id"]);
		} else {
			header("Location: ../students.php?type=edit&id=".$_GET["id"]."&err=".urlencode(base64_encode("Invalid Date")));
		}
	}
}

if($_GET["type"] == 'del_shift')
{
	$student_id = mysql_real_escape_string($_GET["id"]);
	$shift_id = mysql_real_escape_string($_GET["shift_id"]);


	if(mysql_query("DELETE from group_shift where id='$shift_id' ")) {
		header("Location: ../students.php?type=edit&id=".$_GET["id"]);
	} else {
		header("Location: ../students.php?type=edit&id=".$_GET["id"]."&err=".urlencode(base64_encode("Invalid Deatails")));
	}
}
// if($_GET["type"] == 'force_shift')
// {
// 	$student_id = mysql_real_escape_string($_GET["id"]);
// 	$first_group = mysql_real_escape_string($_POST["first_group"]);


// 	if($first_group != 0 && $first_group != '') {
// 		$query =  mysql_query("SELECT * from groups where id=$first_group limit 1 ");
// 		$row = mysql_fetch_array($query);

// 		$center = $row["center_name"];
// 		$city = $row["city_name"];
// 		$group = $row["group_name"];
// 		$shift_date = strtotime($doc);
// 		mysql_query("UPDATE students set train_city = '$city', center='$center', groupid='$group', first_group = '$first_group' where id='$student_id' ");
// 		header("Location: ../students.php?type=edit&id=".$_GET["id"]);
// 	} else {
// 		header("Location: ../students.php?type=edit&id=".$_GET["id"]."&err=".urlencode(base64_encode("Invalid Group")));
// 	}
// }


?>