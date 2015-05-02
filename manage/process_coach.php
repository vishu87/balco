<?php session_start();

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
$sql_case="SELECT * from city ORDER BY city_name ASC";
								$result_case=mysql_query($sql_case);
								$count_city =1;
								while($row = mysql_fetch_array($result_case))
								{
									if($_POST["city"] == $count_city )
									{
										$city = $row["city_name"];
										break;
									}
									
									$count_city++;
								}
	echo $city;							
mysql_query("INSERT INTO groups (group_name, center_name,city_name)
			VALUES ('$_POST[group]', '$_POST[center]', '$_POST[city]' )");

header("Location: ../manage.php?type=group");
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
mysql_query("UPDATE students SET name = '$_POST[name]',dob = '$dob_str', email='$_POST[email]', train_city = '$_POST[train_city]',groupid = '$_POST[groupid]', father='$_POST[father]', father_mob = '$_POST[father_mob]', mother='$_POST[mother]' , mother_mob = '$_POST[mother_mob]', address='$_POST[address]', city='$_POST[city]', state='$_POST[state]' WHERE id='$_GET[id]'");

header("Location: ../students.php?type=browse&id=".$_GET["id"]);
}


if($_GET["type"] == 'paystart')
{
$feed_date =strtotime("now");

$doe = strtotime($_POST["doe"]);
if($_POST["dos"])
{
$dos = strtotime($_POST["dos"]);
mysql_query("INSERT INTO payment_history (student_id, dos, doe, amount, remark, date, added_by)
			VALUES ('$_GET[id]', '$dos','$doe', '$_POST[amount]','$_POST[remark]','$feed_date','admin' )");
mysql_query("UPDATE students SET dos = '$dos',doe = '$doe' WHERE id='$_GET[id]'");
}
else
{
$dor = strtotime($_POST["dor"]);
mysql_query("INSERT INTO payment_history (student_id, dor, doe, amount, remark, date, added_by)
			VALUES ('$_GET[id]', '$dor','$doe', '$_POST[amount]','$_POST[remark]','$feed_date','admin' )");
mysql_query("UPDATE students SET doe = '$doe' WHERE id='$_GET[id]'");
}
header("Location: ../students.php?type=browse&id=".$_GET["id"]);
}
?>