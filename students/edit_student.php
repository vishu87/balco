<?php
$row_student = mysql_fetch_array($result_top);

if(!in_array($row_student["first_group"], $all_groups_access_edit)) die('You are not authorized to edit');

$city = $row_student["train_city"];
$center = $row_student["center"];
$group = $row_student["groupid"];
$dob=date("j/n/Y", $row_student["dob"]);
$dob_str = explode("/", $dob);
$tr_city = array('Sikkim','New Delhi', 'Guwahati');
$tr_state = array('Andaman and Nicobar','Andhra Pradesh', 'Arunachal Pradesh', 'Assam', 'Bihar', 'Chandigarh', 'Chhattisgarh', 'Dadra and Nagar Haveli', 'Daman and Diu', 'Delhi', 'Goa', 'Gujarat', 'Haryana', 'Himachal Pradesh', 'Jammu and Kashmir', 'Jharkhand', 'Karnataka', 'Kerala', 'Lakshadweep', 'Madhya Pradesh', 'Maharashtra', 'Manipur', 'Meghalaya', 'Mizoram', 'Nagaland', 'Orissa', 'Pondicherry', 'Punjab', 'Rajasthan', 'Sikkim', 'Tamil Nadu', 'Tripura', 'Uttar Pradesh', 'Uttrakhand', 'West Bengal');
?>

<div class="top_m color1">
	<a href="students.php?type=browse" class="deco">Students</a> : 
</div>
	<div style="margin:10px;">
	Edit Student Information
	
	<table cellspacing="0" cellpadding="0" width="100%" style="margin-top:10px;">
		<tr>
			<td align="left" valign="top" width="50%">
				<div id="gen_form">
				
				<form action="students/process_student.php?type=2&id=<?php echo $_GET["id"]?>" method="post" onsubmit="return validate_form(this)" enctype="multipart/form-data">
				
					<table cellspacing="0" cellpadding="0" width="100%" style="margin-top:10px;">
		<tr class="color2">
			<td align="left" valign="top" colspan="2">
			Genral Information
			</td>
			
		</tr>
		
		
		
		<tr><td width="40%" align="right">Current Group:</td><td><?php echo $row_student["groupid"].', '.$row_student["center"].', '.$row_student["train_city"] ?></td></tr>
		
		
		
		
		<tr>
		<td width="40%" align="right">Name
		</td>
		<td><input type="text" name="name" value="<?php echo $row_student["name"];?>" ></td>
		</tr>
		<tr>
		<td align="center" colspan="2">
		DOB:&nbsp;&nbsp;&nbsp;Date <select name="date">
		<?php
		for($i=1; $i<32;$i++)
		{
		if($i == $dob_str[0])
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
			if($i == $dob_str[1])
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
		for($i=1990; $i<2012;$i++)
		{
			if($i == $dob_str[2])
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
		</td></tr>
		<tr>
		<td align="right">School Name
		</td>
		<td ><input type="text" name="school" value="<?php echo $row_student["school"];?>"></td>
		</tr>
		<tr>
		<td align="right">Email
		</td>
		<td ><input type="text"name="email" value="<?php echo $row_student["email"];?>" >&nbsp;&nbsp;<input type="checkbox" name="status_email" value="1" <?php
		
		if($row_student["status_email"] == '1')
		{
		echo 'checked ="true"';
		}
		
		?>>&nbsp;&nbsp;Use for communication</td>
		</tr>
		<tr>
		<td align="right">Mobile Number
		<td ><input type="text" name="mobile" value="<?php echo $row_student["mobile"].$row_student["status_mob"];?>" >&nbsp;&nbsp;<input type="checkbox" name="status_mob" value="1" <?php
		
		if($row_student["status_mob"] == '1')
		{
		echo 'checked ="true"';
		}
		
		?>>&nbsp;&nbsp;Use for communication</td>
		</tr>
		
		<tr>
		<td align="right">Father's Name
		</td>
		<td ><input type="text" name="father" value="<?php echo $row_student["father"];?>"></td>
		</tr>
		<tr>
		<td align="right">Father's Mobile No.
		</td>
		<td ><input type="text" name="father_mob" value="<?php echo $row_student["father_mob"];?>">&nbsp;&nbsp;<input type="checkbox" name="father_status_mob" value="1"<?php
		
		if($row_student["father_status_mob"] == '1')
		{
		echo 'checked ="true"';
		}
		
		?>>&nbsp;&nbsp;Use for communication</td>
		</tr>
		<tr>
		<td align="right">Father's Email
		</td>
		<td ><input type="text" name="father_email" value="<?php echo $row_student["father_email"];?>">&nbsp;&nbsp;<input type="checkbox" name="father_status_email" value="1" <?php
		
		if($row_student["father_status_email"] == '1')
		{
		echo 'checked ="true"';
		}
		
		?>>&nbsp;&nbsp;Use for communication</td>
		</tr>
		<tr>
		<td align="right">Mother's Name
		</td>
		<td ><input type="text" name="mother" value="<?php echo $row_student["mother"];?>"></td>
		</tr>
		<tr>
		<td align="right">Mother's Mob No.
		</td>
		<td ><input type="text" name="mother_mob" value="<?php echo $row_student["mother_mob"];?>">&nbsp;&nbsp;<input type="checkbox" name="mother_status_mob" value="1" <?php
		
		if($row_student["mother_status_mob"] == '1')
		{
		echo 'checked ="true"';
		}
		
		?>>&nbsp;&nbsp;Use for communication</td>
		</tr>
		<tr>
		<td align="right">Mother's Email
		</td>
		<td ><input type="text" name="mother_email" value="<?php echo $row_student["mother_email"];?>">&nbsp;&nbsp;<input type="checkbox" name="mother_status_email" value="1" <?php
		
		if($row_student["mother_status_email"] == '1')
		{
		echo 'checked ="true"';
		}
		
		?>>&nbsp;&nbsp;Use for communication</td>
		</tr>
		
		<tr>
		<td align="right">Second Group
		</td>
		<td >
			<select name="second_group">
				<option value="0">Select</option>
				<?php 
					$query_groups = mysql_query("SELECT * from groups order by group_name asc");
					while ($row_grp = mysql_fetch_array($query_groups)) {
						echo '<option value="'.$row_grp["id"].'" ';
						if($row_grp["id"] == $row_student["second_group"]) echo ' selected';
						echo '>'.$row_grp["group_name"].', '.$row_grp["center_name"].'</option>';
					}

				?>
			</select>
		</td>
		</tr>

		<tr>
		<td align="right">Address
		</td>
		<td ><input type="text" name="address" value="<?php echo $row_student["address"];?>"></td>
		</tr>
		<tr>
		<td align="right">City
		</td>
		<td ><input type="text" name="city" value="<?php echo $row_student["city"];?>"></td>
		</tr>
		<tr>
		<td align="right">State
		</td>
		<td ><select name="state" id="state" class="input_field" value="<?php echo $row_student["state"];?>">
		<?php
		foreach($tr_state as $tr)
			{
				if($tr == $row_student["state"] )
				{
				echo '<option selected>'.$tr.'</option>';
				}
				else
				{
				echo '<option>'.$tr.'</option>';
				}
			
			}
		?>
		</select></td>
		</tr>
		
		
		<?php 
		if($row_student["pic"]){
		echo '<tr><td align="center" colspan="2"><img src="images/tn_'.$row_student["pic"].'">
		</td></tr>';} ?>
		<tr>
		<td align="right">Upload Pic
		</td>
		<td ><input type="file" name="file"></td>
		</tr>
			
		</table>
		<div align="center">
	<input type="SUBMIT" Value="SUBMIT">
	&nbsp;&nbsp;&nbsp;&nbsp;<input onclick="javascript:window.history.back()" type="button" Value="CANCEL">
	</div>
			</form>	
				</div>
			  </td>
			
		</tr>
		
	</table>

	<div class="top_m color2" style="">Shift group</div>
	<?php if($_GET["err"]) echo '<span style="color:#f00">'.urldecode(base64_decode($_GET["err"])).'</span>'; ?>
		<div style="padding:20px;min-height:200px">
			<form action="students/process_student.php?type=shift&amp;id=<?php echo $_GET["id"]?>" method="post">
				

			Old group <select name="old_group">
				<option value="0">Select</option>
				<?php 
					$query_groups = mysql_query("SELECT groups.id, groups.group_name, center.center_name, city.city_name from groups join center on groups.center_id = center.id join city on center.city_id = city.id order by group_name asc");
					while ($row_grp = mysql_fetch_array($query_groups)) {
						echo '<option value="'.$row_grp["id"].'" ';
						if($row_student["first_group"] == $row_grp["id"]) echo 'selected';
						echo '>'.$row_grp["group_name"].', '.$row_grp["center_name"].', '.$row_grp["city_name"].'</option>';
					}

				?>
			</select><br><br>


			Change Group To <select name="first_group">
				<option value="0">Select</option>
				<?php 
					$query_groups = mysql_query("SELECT groups.id, groups.group_name, center.center_name, city.city_name from groups join center on groups.center_id = center.id join city on center.city_id = city.id order by group_name asc");
					while ($row_grp = mysql_fetch_array($query_groups)) {
						echo '<option value="'.$row_grp["id"].'" ';
						echo '>'.$row_grp["group_name"].', '.$row_grp["center_name"].', '.$row_grp["city_name"].'</option>';
					}

				?>
			</select><br><br>
			Group Change Date (For attendance etc) <input type="text" size="12" name="doc" id="inputField" value=""><br><br>

			<button type="Submit">Submit</button>
			<div style="margin:20px 0 10px 0">Group Shift History</div>
			<div id="gen_form">
				<table cellspacing="0" cellpadding="0" width="100%" style="margin-top:10px;">
					<tr class="color3">
						<td>ID</td>
						<td>Old group</td>
						<td>New Group</td>
						<td>Shift Date</td>
						<td>Delete</td>
					</tr>
				<?php 
					$q_shift = mysql_query("SELECT * from group_shift where student_id='$_GET[id]' order by shift_date desc "); 
					while ($r_shift = mysql_fetch_array($q_shift)) {
						echo '<tr>';
						$old_group_sql = mysql_query("SELECT * from groups where id='$r_shift[old_group]' limit 1");
						if(mysql_num_rows($old_group_sql) == 0){
							$old_group_sql = mysql_query("SELECT * from deleted_groups where id='$r_shift[old_group]' limit 1");
						}
						$old_group = mysql_fetch_array($old_group_sql);

						$new_group_sql = mysql_query("SELECT * from groups where id='$r_shift[new_group]' limit 1");
						if(mysql_num_rows($new_group_sql) == 0){
							$new_group_sql = mysql_query("SELECT * from deleted_groups where id='$r_shift[new_group]' limit 1");
						}
						$new_group = mysql_fetch_array($new_group_sql);
						?>
							<td><?php echo $r_shift["id"]?></td>
							<td><?php echo $old_group["group_name"].', '.$old_group["center_name"].', '.$old_group["city_name"] ?></td>
							<td><?php echo $new_group["group_name"].', '.$new_group["center_name"].', '.$new_group["city_name"] ?></td>
							<td><?php echo date("d-M-Y",$r_shift["shift_date"]) ?></td>
							<td><a href="students/process_student.php?type=del_shift&amp;id=<?php echo $_GET["id"]?>&amp;shift_id=<?php echo $r_shift["id"] ?>">Delete</a></td>

						<?php

						echo '</tr>';
					}
				?>
				</table>
			</div>
		</form>



		<?php if($priv == 'admin') { ?>
	<div class="top_m color2" style="">FORCE SET first group</div>
	<?php if($_GET["err"]) echo '<span style="color:#f00">'.urldecode(base64_decode($_GET["err"])).'</span>'; ?>
		<div style="padding:20px;min-height:200px">
			<form action="students/process_student.php?type=force_shift&amp;id=<?php echo $_GET["id"]?>" method="post">
				

			Select Group <select name="first_group">
				<option value="0">Select</option>
				<?php 
					$query_groups = mysql_query("SELECT * from groups order by group_name asc");
					while ($row_grp = mysql_fetch_array($query_groups)) {
						echo '<option value="'.$row_grp["id"].'" ';
						if($row_student["first_group"] == $row_grp["id"]) echo 'selected';
						echo '>'.$row_grp["group_name"].', '.$row_grp["center_name"].', '.$row_grp["city_name"].'</option>';
					}

				?>
			</select><br><br>


			<button type="Submit">Submit</button>

		</form>
		</div>
		<?php } ?>
	</div>
