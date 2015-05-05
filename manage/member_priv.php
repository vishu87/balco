<style type="text/css">
#priv{
	margin: 20px;
}
	#priv td, #priv th{
		border: 1px solid #CCC;
		padding:5px;
	}
</style>


<?php
$privledges = array("admin"=>'Admin',"citycord"=>'City Coordinator',"cntercord"=>"Center Coordinator","coach"=>"Coach");
?>
<?php
if($_GET["id"]){
	$params = array("sp_view","sp_edit","eval_view","eval_edit","att_view","att_edit","c_att_view","c_att_edit","payments","adjustment");

	$qry="SELECT id, name FROM members WHERE id='$_GET[id]'";
	$result=mysql_query($qry);
	$row_edit = mysql_fetch_array($result);

	$array_group = array();
	$query_group = mysql_query("SELECT id, group_name, center_id from groups ");
	while ($row_group = mysql_fetch_array($query_group)) {
		$array_group[$row_group["center_id"]][$row_group["id"]] = $row_group["group_name"];
	}
	$query_priv = mysql_query("SELECT * from members_priv where user_id='$_GET[id]' ");
	$priv = array();
	while ($row_priv = mysql_fetch_array($query_priv)) {

		$priv[$row_priv["center_id"]]["groups"] = explode(',', $row_priv["groups"]);
		foreach ($params as $param) {
			$priv[$row_priv["center_id"]][$param] = $row_priv[$param];
		}
	}

?>
			<div class="top_m color1">Member Priviledge: <?php  echo $row_edit["name"]?></div>
				<form action="manage/member_priv_process.php?user_id=<?php echo $_GET["id"] ?>" method="post">
					<h3 style="margin:20px; font-weight:normal; font-size:30px"><?php  echo $row_edit["name"]?></h3>
				<table cellspacing="0" cellpadding="0" style="border:1px solid #888;" id="priv">

						<tr>
							<th></th>
							<th style="min-width:100px"></th>
							<th></th>
							<th colspan="2">Student Profile</th>
							<th colspan="2">Student Evaluation</th>
							<th colspan="2">Student Attendance</th>
							<th colspan="2">Coach Attendance</th>
							<th>Payments</th>
							<th>Adjustments</th>
						</tr>
						<tr>
							
							<th>City</th>
							<th><input type="checkbox" value="1" class="center">&nbsp;&nbsp;&nbsp;Centers</th>
							<th><input type="checkbox" value="1" class="change_it" data-type="group">&nbsp;&nbsp;&nbsp;Groups</th>
							<th><input type="checkbox" value="1" class="change_it" data-type="sp_view">&nbsp;&nbsp;&nbsp;View</th>
							<th><input type="checkbox" value="1" class="change_it" data-type="sp_edit">&nbsp;&nbsp;&nbsp;Edit</th>
							<th><input type="checkbox" value="1" class="change_it" data-type="eval_view">&nbsp;&nbsp;&nbsp;View</th>
							<th><input type="checkbox" value="1" class="change_it" data-type="eval_edit">&nbsp;&nbsp;&nbsp;Edit</th>
							<th><input type="checkbox" value="1" class="change_it" data-type="att_view">&nbsp;&nbsp;&nbsp;View</th>
							<th><input type="checkbox" value="1" class="change_it" data-type="att_edit">&nbsp;&nbsp;&nbsp;Edit</th>
							<th><input type="checkbox" value="1" class="change_it" data-type="c_att_view">&nbsp;&nbsp;&nbsp;View</th>
							<th><input type="checkbox" value="1" class="change_it" data-type="c_att_edit">&nbsp;&nbsp;&nbsp;Edit</th>
							<th><input type="checkbox" value="1" class="change_it" data-type="payments">&nbsp;&nbsp;&nbsp;</th>
							<th><input type="checkbox" value="1" class="change_it" data-type="adjustment">&nbsp;&nbsp;&nbsp;</th>
						</tr>

				<?php

					$query_center = mysql_query("SELECT center.*, city.city_name from center join city on center.city_id = city.id order by city.city_name, center.center_name asc");
					while($row_center = mysql_fetch_array($query_center)){
						?>
						<tr>
							<td><?php echo $row_center["city_name"] ?></td>
							<td><input type="checkbox" name="centers[]" class="centers" data-id=<?php echo $row_center["id"] ?>  value="<?php echo $row_center["id"] ?>" <?php if(isset($priv[$row_center["id"]])) echo 'checked'; ?>><?php echo $row_center["center_name"] ?></td>
							<td>
								<?php
								if(isset($array_group[$row_center["id"]])){
									foreach ($array_group[$row_center["id"]] as $key => $value) {
										?>
											<input type="checkbox" name="groups_<?php echo $row_center["id"] ?>[]" value="<?php echo $key ?>" class="click_change" data-type="group" <?php

											if(isset($priv[$row_center["id"]])) 
											{ if(in_array($key, $priv[$row_center["id"]]["groups"])) echo 'checked'; }
								 			?> 

											> <?php echo $value ?>&nbsp;&nbsp;&nbsp;
										<?php
									}
								}
								?>
							</td>
							<?php
								foreach ($params as $param) { ?>
							<td align="center"><input type="checkbox" value="1" name="<?php echo $param.'_'.$row_center["id"]?>" class="click_change" data-type="<?php echo $param ?>" <?php 
								if(isset($priv[$row_center["id"]])) 
								{ if($priv[$row_center["id"]][$param] == 1) echo 'checked'; }
								?>></td>
							<?php } ?>
						</tr>
						<?php

					}
				?>
				</table>
				<input type="submit" value="SUBMIT" style="margin:0 20px">
				</form>
<?php } else {
?>
<div class="top_m color1">Member Priviledge: <?php  echo $row_edit["name"]?></div>
<?php

} ?>
				<br><br>
			
			<h3 style="margin:10px">Available Members</h3>
			<?php
						
								$qry="SELECT members.*, city.city_name, center.center_name FROM members left join city on members.city_id = city.id left join center on members.center_id = center.id order by members.priv, members.name asc ";
								$result=mysql_query($qry);

			?>
			<div id="gen_form">
			<table cellspacing="2" width="100%" >
			<tr class="top_m color1"><td width="150"  align="center">Name</td><td width="100"  align="center">Username</td><td width="100"  align="center">Privledge</td><td>City</td><td>Center</td><td>Edit Privledge</td>
			</tr>
			<?php
			$count_mem =0;
			while($row = mysql_fetch_array($result))
			{
			if($count_mem%2 == 0)
			{
			echo '<tr >';
			}
			else
			{
			echo '<tr style="background:#EEE">';
			}
			  echo '<td width="150" align="left">'.$row["name"].'</td><td align="center">'.$row["username"].'</td><td align="center">'.$privledges[$row["priv"]].'</td><td align="center">'.$row["city_name"].'</td><td align="center">'.$row["center_name"].'</td><td><a href="?type=member_priv&amp;id='.$row["id"].'" target="_blank"><img src="edit.png"></a></td>';
			  echo '</tr>';
			$count_mem++;
			}
			
			 ?>
			 </table></div>
			</div>
			</div>
<script type="text/javascript">
	$(".center").change(function(){
		var check = $(this).is(":checked");
		if(check){
			$('.centers').attr('checked','checked');
		} else {
			$('.centers').removeAttr('checked');
		}
     });

	$(".change_it").change(function(){
		var check = $(this).is(":checked");
		var data = $(this).attr('data-type');
		if(check){
			$(".centers:checked").each(function(){
				console.log(data);
				$(this).parent().parent().find('input[data-type='+data+']').attr('checked','checked');
			});
		} else {
			$('input[data-type='+data+']').removeAttr('checked');
		}
     });
</script>