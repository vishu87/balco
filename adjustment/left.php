<?php

$cities = array();
$centers = array();
$groups = array();
$priv = array();
$group_ids = array();
$group_ids_edit = array();

if($_SESSION['PRIV'] != 'admin'){
	$sql_priv=mysql_query("SELECT members_priv.center_id, members_priv.groups, city.city_name, city.id as city_id, center.center_name from members_priv inner join center on members_priv.center_id = center.id inner join city on center.city_id = city.id WHERE members_priv.user_id='$_SESSION[MEM_ID]' and members_priv.adjustment = 1");
	while ($row_priv = mysql_fetch_array($sql_priv)) {
		$priv[$row_priv["city_id"]][$row_priv["center_id"]] = $row_priv["groups"];
		$cities[$row_priv["city_id"]] = $row_priv["city_name"];
		$centers[$row_priv["center_id"]] = $row_priv["center_name"];
		array_push($group_ids, $row_priv["groups"]);
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
}

$group_ids = implode(',', $group_ids);
$all_groups_access = explode(',', $group_ids);

$group_names = mysql_query("SELECT id, group_name from groups where id IN (".$group_ids.") ");
while ($row_group = mysql_fetch_array($group_names)) {
	$groups[$row_group["id"]] = $row_group["group_name"];
}

?>