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

$user_id = $_GET["user_id"];

$sql_case=mysql_query("SELECT id from members WHERE id ='$user_id'");

$num_rows = mysql_num_rows($sql_case);
if($num_rows == 0){
 header("Location: ../manage_priv.php?type=member&err=1");
}
if($_GET["type"] == 1){

	$center_id = $_POST["center"];
	if($center_id == -1){
		$sql_centers = mysql_query("SELECT id from center");
		while ($row_centers = mysql_fetch_array($sql_centers)) {
			$group = array(); 
			$sql_groups = mysql_query("SELECT id from groups where center_id = $row_centers[id] order by group_name desc ");
			while ($row_group = mysql_fetch_array($sql_groups)) {
				array_push($group, $row_group["id"]);
			}
			$center_id = $row_centers["id"];
			$groups = implode(',', $group);
			$sql ="INSERT INTO members_priv (user_id, center_id, groups, sp_view, sp_edit, eval_view, eval_edit, att_view, att_edit, c_att_view, c_att_edit, payments, adjustment, add_new_group, add_member, manage_member, level) VALUES ('$user_id ','$center_id','$groups','$_POST[sp_view]','$_POST[sp_edit]','$_POST[eval_view]','$_POST[eval_edit]','$_POST[att_view]','$_POST[att_edit]','$_POST[c_att_view]','$_POST[c_att_edit]','$_POST[payments]','$_POST[adjustment]','$_POST[add_new_group]','$_POST[add_member]','$_POST[manage_member]','$_POST[level]')";
			mysql_query($sql);

		}

	} else {
		$groups = implode(',', $_POST["groups"]);
		if(strlen($groups) == 0){

		} else {
		
			$sql ="INSERT INTO members_priv (user_id, center_id, groups, sp_view, sp_edit, eval_view, eval_edit, att_view, att_edit, c_att_view, c_att_edit, payments, adjustment, add_new_group, manage_member, level) VALUES ('$user_id ','$center_id','$groups','$_POST[sp_view]','$_POST[sp_edit]','$_POST[eval_view]','$_POST[eval_edit]','$_POST[att_view]','$_POST[att_edit]','$_POST[c_att_view]','$_POST[c_att_edit]','$_POST[payments]','$_POST[adjustment]','$_POST[add_new_group]','$_POST[manage_member]','$_POST[level]')";
			mysql_query($sql);
		}
	}
	
	header("Location: ../manage.php?type=member_priv&id=".$user_id);
}
if($_GET["type"] == 2){
	$edit_id = $_POST["edit_id"];
	
	
	$center_id = $_POST["center"];
	$groups = implode(',', $_POST["groups"]);
	
	if(strlen($groups) == 0){

	} else {
	
		$sql ="UPDATE members_priv set center_id = '$center_id',groups = '$groups', sp_view = '$_POST[sp_view]',sp_edit = '$_POST[sp_edit]',eval_view = '$_POST[eval_view]',eval_edit = '$_POST[eval_edit]',att_view = '$_POST[att_view]',att_edit = '$_POST[att_edit]',c_att_view = '$_POST[c_att_view]',c_att_edit = '$_POST[c_att_edit]',payments = '$_POST[payments]',adjustment = '$_POST[adjustment]',add_new_group = '$_POST[add_new_group]',manage_member = '$_POST[manage_member]',level = '$_POST[level]' where id = '$edit_id' and user_id = '$user_id' ";
		//echo $sql;
		mysql_query($sql);
	}
	header("Location: ../manage.php?type=member_priv&id=".$user_id);
}



?>