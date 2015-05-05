<?php
$months_name = array ("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");

$month = base64_decode($_GET["month"]);
$year = base64_decode($_GET["year"]);

$cities = array();
$centers = array();
$groups = array();
$priv_view = array();
$priv_edit = array();

if($_SESSION['PRIV'] != 'admin'){
	$sql_priv=mysql_query("SELECT members_priv.center_id, members_priv.groups, city.city_name, city.id as city_id, center.center_name from members_priv inner join center on members_priv.center_id = center.id inner join city on center.city_id = city.id WHERE members_priv.user_id='$_SESSION[MEM_ID]' and members_priv.att_view = 1");
	while ($row_priv = mysql_fetch_array($sql_priv)) {
		$priv_view[$row_priv["city_id"]][$row_priv["center_id"]] = $row_priv["groups"];
		$cities[$row_priv["city_id"]] = $row_priv["city_name"];
		$centers[$row_priv["center_id"]] = $row_priv["center_name"];
	}

	$sql_priv=mysql_query("SELECT members_priv.center_id, members_priv.groups, city.city_name, city.id as city_id, center.center_name from members_priv inner join center on members_priv.center_id = center.id inner join city on center.city_id = city.id WHERE members_priv.user_id='$_SESSION[MEM_ID]' and members_priv.att_edit = 1");
	while ($row_priv = mysql_fetch_array($sql_priv)) {
		$priv_edit[$row_priv["city_id"]][$row_priv["center_id"]] = $row_priv["groups"];
	}
} else {
	
	$sql_priv=mysql_query("SELECT center.id as center_id, city.city_name, city.id as city_id, center.center_name from center inner join city on center.city_id = city.id ");
	while ($row_priv = mysql_fetch_array($sql_priv)) {
		$gpx = array();
		$sql_groups = mysql_query("SELECT id from groups where center_id = '$row_priv[center_id]' ");
		while ($row_groups = mysql_fetch_array($sql_groups)) {

			array_push($gpx, $row_groups["id"]);
		}
		$priv_view[$row_priv["city_id"]][$row_priv["center_id"]] = implode(',', $gpx);
		$priv_edit[$row_priv["city_id"]][$row_priv["center_id"]] = $priv_view[$row_priv["city_id"]][$row_priv["center_id"]];
		$cities[$row_priv["city_id"]] = $row_priv["city_name"];
		$centers[$row_priv["center_id"]] = $row_priv["center_name"];
	}
}

if(isset($_GET["city_id"])) $city_id = $_GET["city_id"];							
if(isset($_GET["center_id"])) $center_id = $_GET["center_id"];							
if(isset($_GET["group_id"])) $group_id = $_GET["group_id"];	

?>

<table width="100%" cellspacing="0" cellpadding="0">
						<tr class="color2">
							<td >
							<form action="?" method="get"><table cellspacing="0" cellpadding="0" width="100%">
									<tr>
							<td align="right" width="50%">Select Month</td>
							<td><select name="month">
							
							<?php
							
							for($i=1; $i<13;$i++)
							{
								if($i<10)
								{
								echo '<option value="'.base64_encode($i).'"';
								if($i == (int)$month) echo " selected";
								
								echo '>'.$months_name[$i - 1].'</option>';
								}
								else
								{
								echo '<option value="'.base64_encode($i).'"';
								if($i == $month) echo " selected";
								echo '>'.$months_name[$i - 1].'</option>';
								}
							}
							?>
							</select></td>
									</tr>
									<tr>
											<td align="right">Select Year</td>
											<td><select name="year"><?php
							for($i=2011; $i<=2020;$i++)
							{
								echo '<option value="'.base64_encode($i).'"';
								if($i == $year) echo " selected";
								
								echo '>'.$i.'</option>';
							}
							?></select></td>
									</tr>
									<tr>
											<td align="right">City</td><td>
											
									<?php
				
									echo '<select name="city_id"  id="ctlcityidtype">
									<option value="0">Select</option>';
									
									foreach($cities as $key=>$value)
									{
										echo '<option value="'.$key.'" '; 
										echo ' >'.$value.'</option>';
										$count_city++;
									}
									echo'</select>';

								
								
								
							?>
							</td>
							
									</tr>
							<tr>
									<td align="right">Traning Center
							</td>
							<td >
							<?php
							

								echo '<select name="center_id" id="ctlcenteridtype"><option value="0">Select</option>';
								
								echo '</select>';
								//echo "yes";
							
							?>
							
							
							</td>
							</tr>
								
								</table>
								<div align="center">
						<input type="SUBMIT" Value="GO" class="color3" style="border:0px; margin:10px; padding:5px 10px">
						</div>
							</form>
							</td>
						</tr>
						
						<?php 
							echo '<tr class="';
							if($_GET["type"] == 'browse' ||$_GET["type"] == 'edit')
							{
							echo 'color1';
							}
							echo '"><td><a href="students.php?type=browse">Browse Students</a>';
							
						
							?>
							
						</td></tr>
						
						
						
						</table>