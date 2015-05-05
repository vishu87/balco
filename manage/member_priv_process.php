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
$params = array("sp_view","sp_edit","eval_view","eval_edit","att_view","att_edit","c_att_view","c_att_edit","payments","adjustment");

$num_rows = mysql_num_rows($sql_case);
if($num_rows == 0){
 header("Location: ../manage_priv.php?type=member&err=1");
} else {
	mysql_query("DELETE from members_priv where user_id = $user_id ");
	foreach ($_POST["centers"] as $center) {
		$groups = array();
		if(isset($_POST["groups_".$center])){
			foreach ($_POST["groups_".$center] as $group) {
				array_push($groups, $group);
			}
			if(sizeof($groups)>0){
				$groups_str = implode(',', $groups);
				$update = array();
				foreach ($params as $param) {
					$update[$param] = (isset($_POST[$param.'_'.$center]) && $_POST[$param.'_'.$center] == 1)?'1':'0';
				}
				mysql_query("INSERT into members_priv (user_id, center_id, groups, sp_view , sp_edit , eval_view , eval_edit , att_view , att_edit , c_att_view , c_att_edit , payments , adjustment ) values ('$user_id', '$center', '$groups_str', '$update[sp_view]' , '$update[sp_edit]' , '$update[eval_view]' , '$update[eval_edit]' , '$update[att_view]' , '$update[att_edit]' , '$update[c_att_view]' , '$update[c_att_edit]' , '$update[payments]' , '$update[adjustment]') ");
			}
		}
	}
}
header("location: ../manage.php?type=member_priv&id=".$user_id);




?>