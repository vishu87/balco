<?php session_start();

require_once('config.php');

$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
	if(!$link) {
		die('Failed to connect to server: ' . mysql_error());
	}
	
	//Select database
	$db = mysql_select_db(DB_DATABASE);
	if(!$db) {
		die("Unable to select database");
	}



$sql="SELECT * from coach_groups where coach_id='$_GET[id]' order by start DESC";
$result=mysql_query($sql);
echo 'SET GROUPS';
while($row = mysql_fetch_array($result))
{
echo '<hr><h1>'.$row["group_name"].', '.$row["center_name"].'</h1>';
$dos=date("j/n/Y", $row["start"]);
$dos_str = explode("/", $dos);

if($row["end"])
{
$doe=date("j/n/Y", $row["end"]);
$doe_str = explode("/", $doe);
}else
{
$doe_str='';
}
?>

							<form action="process_group_set.php?coach_id=<?php echo $_GET["id"]; ?>&amp;id=<?php echo $row["id"];?>" method="post"/>
							START ON:&nbsp;&nbsp;&nbsp;Date <select name="date">
							<?php
							for($i=1; $i<32;$i++)
							{
							if($i == $dos_str[0])
							{
								echo '<option selected>'.$i.'</option>';
							}
							else
							{
								echo '<option>'.$i.'</option>';
							}
							}
							?>
							</select>
							Month <select name="month">
							<?php
							for($i=1; $i<13;$i++)
							{
								if($i == $dos_str[1])
							{
								echo '<option selected>'.$i.'</option>';
							}
							else
							{
								echo '<option>'.$i.'</option>';
							}
							}
							?>
							</select>
							Year <select name="year">
							<?php
							for($i=2011; $i<2015;$i++)
							{
								if($i == $dos_str[2])
							{
								echo '<option selected>'.$i.'</option>';
							}
							else
							{
								echo '<option>'.$i.'</option>';
							}
							}
							?>
							</select><br><br>
							START ON:&nbsp;&nbsp;&nbsp;Date <select name="date1">
							<?php
							for($i=0; $i<32;$i++)
							{
							if($i == $doe_str[0])
							{
								echo '<option selected>'.$i.'</option>';
							}
							else
							{
								echo '<option>'.$i.'</option>';
							}
							}
							?>
							</select>
							Month <select name="month1">
							<?php
							for($i=0; $i<13;$i++)
							{
								if($i == $doe_str[1])
							{
								echo '<option selected>'.$i.'</option>';
							}
							else
							{
								echo '<option>'.$i.'</option>';
							}
							}
							?>
							</select>
							Year <select name="year1">
							<?php
							echo '<option>0</option>';
							for($i=2011; $i<2015;$i++)
							{
								if($i == $doe_str[2])
							{
								echo '<option selected>'.$i.'</option>';
							}
							else
							{
								echo '<option>'.$i.'</option>';
							}
							}
							?>
							</select><input type="submit"></form>
<?php
}





?>