<?php
$types = array("browse"=>"Browse Students", "in_stu"=>"Inactive Students","pay_due"=>"Payment Notifications");
$cities = array();
$centers = array();
$groups = array();
$priv = array();
$group_ids = array();
$group_ids_edit = array();

if($_SESSION['PRIV'] != 'admin'){
	$sql_priv=mysql_query("SELECT members_priv.center_id, members_priv.groups, city.city_name, city.id as city_id, center.center_name from members_priv inner join center on members_priv.center_id = center.id inner join city on center.city_id = city.id WHERE members_priv.user_id='$_SESSION[MEM_ID]' and members_priv.sp_view = 1");
	while ($row_priv = mysql_fetch_array($sql_priv)) {
		$priv[$row_priv["city_id"]][$row_priv["center_id"]] = $row_priv["groups"];
		$cities[$row_priv["city_id"]] = $row_priv["city_name"];
		$centers[$row_priv["center_id"]] = $row_priv["center_name"];
		array_push($group_ids, $row_priv["groups"]);
	}

	$sql_priv=mysql_query("SELECT  members_priv.groups from members_priv WHERE members_priv.user_id='$_SESSION[MEM_ID]' and members_priv.sp_edit = 1");
	while ($row_priv = mysql_fetch_array($sql_priv)) {
		array_push($group_ids_edit, $row_priv["groups"]);
	}
} else {
	
	$sql_priv=mysql_query("SELECT center.id as center_id, city.city_name, city.id as city_id, center.center_name from center inner join city on center.city_id = city.id ");
	while ($row_priv = mysql_fetch_array($sql_priv)) {
		
		$gpx = array();
		$sql_groups = mysql_query("SELECT id from groups where center_id = '$row_priv[center_id]' ");
		while ($row_groups = mysql_fetch_array($sql_groups)) {

			array_push($gpx, $row_groups["id"]);
		}
		$priv[$row_priv["city_id"]][$row_priv["center_id"]] = implode(',', $gpx);
		$cities[$row_priv["city_id"]] = $row_priv["city_name"];
		$centers[$row_priv["center_id"]] = $row_priv["center_name"];
		array_push($group_ids, implode(',', $gpx));
	}
	$group_ids_edit = $group_ids;
}

$group_ids = implode(',', $group_ids);
$all_groups_access = explode(',', $group_ids);

if(sizeof($group_ids_edit) > 0){
	$group_ids_edit = implode(',', $group_ids_edit);
	$all_groups_access_edit = explode(',', $group_ids_edit);
} else {
	$all_groups_access_edit = array();
}



$group_names = mysql_query("SELECT id, group_name from groups where id IN (".$group_ids.") ");
while ($row_group = mysql_fetch_array($group_names)) {
	$groups[$row_group["id"]] = $row_group["group_name"];
}

$space_str1 = '&nbsp;&nbsp;&nbsp;<img src="bullet1.jpg" />&nbsp;';
$space_str2 = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="bullet2.png" />&nbsp;';
$space_str3 = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="bullet3.png" />&nbsp;';
?>

<?php
if($_GET["id"]){
	$sql_top="SELECT students.*, group_name as groupid, center.center_name as center, city.city_name as train_city  from students join groups on students.first_group = groups.id join center on groups.center_id = center.id join city on center.city_id = city.id  where students.id='$_GET[id]' ";
	$result_top=mysql_query($sql_top);
}	
if(isset($_GET["city_id"])) $city_id = $_GET["city_id"];							
if(isset($_GET["center_id"])) $center_id = $_GET["center_id"];							
if(isset($_GET["group_id"])) $group_id = $_GET["group_id"];

?>
<table width="100%" cellspacing="0" cellpadding="0">
						

						<tr>
							<td class="<?php 
							if(!$_GET["type"])
							echo "color1";
							?>"><a href="students.php">Add New Student</a></td>
						</tr>
						<tr><td><br><br></td></tr>
						<?php
						if($_SESSION['PRIV']  == 'admin'){
						?>
						<tr>
							<td class="<?php 
							if($_GET["type"] == 'approve')
							echo "color1";
							?>"><a href="students.php?type=approve_inactive">Approve Inactive Students</a></td>
						</tr>
						<tr><td><br><br></td></tr>
						<?php
						}

						?>
						<?php
						if($_GET["id"])
						{
						echo '<tr>
							<td class="color1"><a href="#">Student Profile</a></td>
						</tr>
						';
						
						}
						
						
						?>
						
						
						<?php
						foreach ($types as $type => $type_name) {
							echo '<tr><td><br></td></tr><tr class="';
							if($_GET["type"] == $type && !$_GET["id"]){
								echo 'color1';
							}
							echo '"><td><a href="students.php?type='.$type.'">'.$type_name.'</a></td></tr>';

							foreach ($cities as $key => $city) {
									echo '<tr ';
									echo ($city_id == $key && $_GET["type"] == $type)?'class="color_c"':'';
									echo '>';
									echo '<td>'.$space_str1.'<a href="?type='.$type.'&amp;city_id='.$key.'">'.$city.'</a></td>';
									if($city_id == $key && $_GET["type"] == $type){
										foreach ($priv[$key] as $center => $group) {
											echo '<tr ';
											echo ($center_id == $center)?'class="color_ce"':'';
											echo '>';
											echo '<td>'.$space_str2.'<a href="?type='.$type.'&amp;city_id='.$key.'&amp;center_id='.$center.'">'.$centers[$center].'</a></td></tr>';
											if($center_id == $center){
												$center_groups = explode(',', $group);
												foreach ($center_groups as $value) {
													echo '<tr ';
													echo ($group_id == $value)?'class="color_g"':'';
													echo '>';
													echo '<td>'.$space_str3.'<a href="?type='.$type.'&amp;city_id='.$key.'&amp;center_id='.$center.'&amp;group_id='.$value.'">'.$groups[$value].'</a></td></tr>';
												}
											}
										}
									}
								}
							}
						?>
						</table>