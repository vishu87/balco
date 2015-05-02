<?php
if($_GET["pro"] == 'change')
{
if($_POST["groups"]){
$groups= $_POST["groups"];}
else
{
$groups = array();
}

foreach($groups as $group)
{

$result_coach_group2 = mysql_query("select * from coach_groups where (coach_id = '$_POST[coach_id]' AND active = '0') AND ( city_name='$_POST[city]' AND center_name='$_POST[center]') AND group_name='$group' ");
$total_group = mysql_num_rows($result_coach_group2);
if($total_group == 0)
{
mysql_query("INSERT INTO coach_groups(coach_id, coach_name, city_name, center_name, group_name)
			VALUES ('$_POST[coach_id]', '$_POST[coach]', '$_POST[city]','$_POST[center]','$group' )");
}

}


$result_coach_group = mysql_query("select * from coach_groups where (coach_id = '$_POST[coach_id]' AND active='0') AND ( city_name='$_POST[city]' AND center_name='$_POST[center]') ");

while($row_coach_group = mysql_fetch_array($result_coach_group))
{
	if(in_array($row_coach_group["group_name"], $groups))
	{
	
	}
	else
	{
		mysql_query("UPDATE coach_groups SET active = '1' WHERE id='$row_coach_group[id]'");
	}

}
//mysql_query("UPDATE students SET pic = '$picname' WHERE id='$_GET[id]'");
//mysql_query("DELETE from coach_groups WHERE coach_id = '$_POST[coach_id]' AND ( city_name='$_POST[city]' AND center_name='$_POST[center]') ");

//echo $groups;








}




?>
<script type="text/javascript">
function select_validate_required(field,alerttxt)
{
with (field)
  {
  if (value==null||value=="Select1"||value=="")
    {
    alert(alerttxt);return false;
    }
  else
    {
    return true;
    }
  }
}
function validate_required(field,alerttxt)
{
with (field)
  {
  if (value==null||value=="")
    {
    alert(alerttxt);return false;
    }
  else
    {
    return true;
    }
  }
}
function validate_form(thisform)
{
with (thisform)
  {
  if (select_validate_required(train_city,"Please select a city!")==false)
  {train_city.focus();return false;}
  if (select_validate_required(train_city,"Please select a center!")==false)
  {train_center.focus();return false;}
   if (validate_required(name,"Please fill the name!")==false)
  {name.focus();return false;}
   if (validate_required(username,"Please fill username!")==false)
  {area.focus();return false;}
   if (validate_required(mob,"Please fill town/city name!")==false)
  {town.focus();return false;}
  
  }
}
</script>

						<div class="top_m color1">
						Manage Coaches
						</div>
						<div style="margin:10px;">
						<?php
						$sql="SELECT * from members WHERE username='$_SESSION[SESS_MEMBER_ID]'";
						$result=mysql_query($sql);
						$row_city = mysql_fetch_array($result);
						$city = $row_city["train_city"];
						$center = $row_city["center"];
						if($priv != 'centercord' && !$_GET["var"] )
						{
							echo '<form action="manage.php?type=coach&amp;var=1" method="post">
							Select City:<select name="city" id="ctlcity">
							<option>Select</option>';
							
							
								$sql_case="SELECT * from city ";
								if($priv == 'citycord' 	)
								{
										$sql_city="SELECT * from members WHERE username='$_SESSION[SESS_MEMBER_ID]'";
										$result_city=mysql_query($sql_city);
										$row_city = mysql_fetch_array($result_city);
										$city = $row_city["train_city"];
										$sql_case = $sql_case." WHERE city_name ='$city'";
								}
								$sql_case = $sql_case.'ORDER BY city_name ASC';
								$result_case=mysql_query($sql_case);
								$count_city =1;
								while($row = mysql_fetch_array($result_case))
								{
									echo '<option value="'.$row["city_name"].'">'.$row["city_name"].'</option>';
									$count_city++;
								}
							
							
							echo '</select>';
							echo '&nbsp;&nbsp;&nbsp;&nbsp;Select Center:<select name="center" id="ctlcenter"></select>';
							echo '&nbsp;&nbsp;<input type="submit" value="GO">';
							
							echo '</form>';
						
						}
						else
						{
						?>
						Available Coaches
						<?php
						if($_GET["var"] == 1)
									{
										$city = $_POST["city"];
										$center = $_POST["center"];
									}
						?>
						<div class="gen_table">
							<table cellspacing="0" cellpadding="0" width="100%" id="myTable" class="tablesorter">
							<thead><tr >
									<td>
									SN
									</td>
									<td>
									Name
									</td>
									<td>
									Mobile
									</td>
									<td>
									City
									</td>
									<td>
									Center
									</td>
									<td>
									Groups
									</td>
									
									<td>
									Options
									</td>
								</tr>
								</thead>
								<tbody>
								<?php
								
									if($_GET["var"] == 1)
									{
										$city = $_POST["city"];
										$center = $_POST["center"];
									}
									echo $city;		
									$sql_case="SELECT * from members WHERE train_city = '$city' AND priv='coach'";
									$sql_case =$sql_case." ORDER BY name ASC";
									$result_case=mysql_query($sql_case);
									$count =1;
									while($row = mysql_fetch_array($result_case))
									{
									
									if($count%2 ==0)
									{
										echo '<tr class="color2">';
									}
									else
									{
										echo '<tr >';
									}
									echo '
									
									<td>
									<a name="count'.$count.'">'.$count.'</a>
									</td>
									<td>
									<a href="javascript:void(0)" onclick="window.open(\'group_set.php?id='.$row["id"].'\', \'Group Set\', \'width=200, height=200\')" style="text-decoration:underline;">'.$row["name"].'
									</a></td>
									<td>
									'.$row["mobile"].'
									</td>
									<td>
									'.$city.'
									</td>
									<td>
									'.$center.'
									</td>'
									;
									if($_GET["pro"] == 'edit' && $_GET["id"] == $row["id"])
									{
									$arr_group =Array();
									echo '<form action="?type=coach&amp;var=1&amp;pro=change#count'.$count.'" method="post">';
									echo '<input type="hidden" name ="city" value="'.$city.'">';
									echo '<input type="hidden" name ="center" value="'.$center.'">';
									echo '<input type="hidden" name ="coach" value="'.$row["name"].'">';
									echo '<input type="hidden" name ="coach_id" value="'.$row["id"].'">';
									echo '<td>';
									
									$sql_center="SELECT * from coach_groups WHERE (coach_id = '$row[id]' AND active='0') AND 
									(center_name='$center' AND city_name='$city') ";
									$sql_center =$sql_center." ORDER BY group_name ASC";
									$result_center=mysql_query($sql_center);
									while($row_center = mysql_fetch_array($result_center))
									{
										array_push($arr_group, $row_center["group_name"]);  
									}
									$sql_center="SELECT * from groups WHERE center_name='$center' AND city_name='$city' ";
									$sql_center =$sql_center." ORDER BY group_name ASC";
									$result_center=mysql_query($sql_center);
									while($row_center = mysql_fetch_array($result_center))
									{
										echo '<input type="checkbox" name="groups[]" value="'.$row_center["group_name"].'" style="margin:5px;"/';
										
										if(in_array($row_center["group_name"], $arr_group))
										{
											echo " checked";
										}
										
										
										echo '>'.$row_center["group_name"].'<br>';
									}
									echo'</select>
									</td>
									
									<td>
									<input type="submit" value="GO">';
									
									
									
									}
									else
									{ 
									echo '<form action="?type=coach&amp;var=1&amp;pro=edit&amp;id='.$row["id"].'#count'.$count.'" method="post">';
									echo '<td>';
									echo '<input type="hidden" name ="city" value="'.$city.'">';
									echo '<input type="hidden" name ="center" value="'.$center.'">';
									
									
									$sql_center="SELECT * from coach_groups WHERE ( coach_id = '$row[id]' AND active='0') AND 
									(center_name='$center' AND city_name='$city') ";
									$sql_center =$sql_center." ORDER BY group_name ASC";
									$result_center=mysql_query($sql_center);
									while($row_center = mysql_fetch_array($result_center))
									{
										echo $row_center["group_name"].'<br>';
									}
									echo'
									</td>
									
									<td>
									<input type="submit" value="EDIT">';
									
									
									
									
									}
									echo '</td></form>
								</tr>';
								$count++;
								}
								}
								?>
								</tbody>
							</table>
							
						</div>
						
						</div>
						
						