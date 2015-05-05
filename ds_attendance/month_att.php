<script language='JavaScript'>
    checked = false;
	var get_type = "att_view";
    

    function checkedAll(dt, tot) {
        if (document.getElementById('cl' + dt).value == '') {
            checked = true;
            val = 1;
        } else {
            checked = false;
            val = '';
        }
        for (var i = 1; i <= tot; i++) {
            document.getElementById('cl' + dt).value = val;
            document.getElementById('st' + i + '_' + dt).value = val;
        }
    }

    function toggle_cl(dt) {
        if (document.getElementById('cl' + dt).value == 1) {

            document.getElementById('cl' + dt).value = '';
            document.getElementById('chk' + dt).checked = false;
        } else {
            document.getElementById('cl' + dt).value = 1;
            document.getElementById('chk' + dt).checked = true;
        }

    }


    function toggle(count, dt) {
        if (document.getElementById('st' + count + '_' + dt).value == 1) {

            document.getElementById('st' + count + '_' + dt).value = 0;

        } else {
            document.getElementById('st' + count + '_' + dt).value = 1;

        }

    }

    function show_date(dt) {

        document.getElementById('dt_' + dt).style.backgroundColor = '#DBDDDE';
        document.getElementById('dt2_' + dt).style.backgroundColor = '#DBDDDE';

    }

    function hide_date(dt) {

        document.getElementById('dt_' + dt).style.backgroundColor = '#5F6888';
        document.getElementById('dt2_' + dt).style.backgroundColor = '#5F6888';

    }
</script>

<div class="top_m color1">
	Development Squad Attendance
</div>

<br>
<?php
	echo '<span style="padding:10px; font-size:16px; color:#0E3DCA;">'.$centers[$center_id].', '.$cities[$city_id].'</span><br>';
		if( ($month && $year) && ($city_id && $center_id)){
	?>
	<br>
	<div style="margin:5px 5px 0px 5px;">
	<?php
	$group_ids = $priv_view[$city_id][$center_id];
	if($group_ids == '') die('You are not authorized');
	$groups = array();
	$group_names = mysql_query("SELECT id, group_name from groups where id IN (".$group_ids.") ");
	while ($row_group = mysql_fetch_array($group_names)) {
		$groups[$row_group["id"]] = $row_group["group_name"];
	}
	$count_groups =0;
	foreach($groups as $id => $group_name ) {
		if(!isset($group_id) && $count_groups == 0){	
			$group_id = $id;
		}
		if(	$id == $group_id) {
			echo '&nbsp;&nbsp;&nbsp;<span style="padding:3px; border-top:2px solid #bbb;
			border-bottom:2px solid #fff;
			border-left:2px solid #bbb;
			border-right:2px solid #bbb;"><a href="?month='.$_GET["month"].'&amp;year='.$_GET["year"].'&amp;city_id='.$city_id.'&amp;center_id='.$center_id.'&amp;group_id='.$id.'">'.$group_name.'</a></span>&nbsp;&nbsp;&nbsp;';
		} else {
			echo '&nbsp;&nbsp;&nbsp;<span style="padding:3px; background:#bbb; color:#fff; border:2px solid #bbb;"><a href="?month='.$_GET["month"].'&amp;year='.$_GET["year"].'&amp;city_id='.$city_id.'&amp;center_id='.$center_id.'&amp;group_id='.$id.'">'.$group_name.'</a></span>&nbsp;&nbsp;&nbsp;';
		
		}

		$count_groups++;
	}
	if(!array_key_exists($group_id, $groups)) die("You are not authorized");
	?>
	</div>
	<?php
		
		$groupid = $group_id;

		$sql_case="SELECT id, father_mob, name, dos from students WHERE second_group='$groupid' AND active='0'";
		$sql_case =$sql_case." ORDER BY name ASC";
		$result_att=mysql_query($sql_case);
		$tot_st = mysql_num_rows($result_att);
		
	?>
	<div style="margin:3px 5px 5px 5px;padding:5px; border:2px solid #bbb;">

		Monthly Attendance: <?php echo $months_name[$month - 1].', '.$year;?>

	<div id="atten" align="center">

		<table cellspacing="0" cellpadding="0" width="100%" style="margin-top:10px;">
				<?php
				$sql_dummy="SELECT date from attendance WHERE student_id='dm' AND groupid='$groupid' AND month='$month' AND year='$year' and ds=1 ";
				$result_dummy=mysql_query($sql_dummy);
				$dummy_array = array();
				$tot_class= 0;

				while($row_dummy = mysql_fetch_array($result_dummy)){
					array_push($dummy_array,"$row_dummy[date]");
					$tot_class++;
				}
				
				echo '<tr class="color2">';
				for($i=0;$i<=31;$i++)
				{
					if( $i== 0) echo '<td></td><td width="120"></td>';
					else 
					{
						if (in_array($i, $dummy_array)){							
										echo '<td width="20"><input type="checkbox" id="chk'.$i.'" name="checkall" onclick="checkedAll('.$i.','.$tot_st.');" checked="true"></td>';
							} else {
							echo '<td width="20"><input type="checkbox" id="chk'.$i.'" name="checkall" onclick="checkedAll('.$i.','.$tot_st.');" ></td>';
							}							
					}
		}
		echo '<td width="20">TL</td>';
		echo '<td width="20">%</td>';
		echo '</tr>';
		
		echo '<tr class="color3">';
		for($i=0;$i<=31;$i++)
		{
			if( $i== 0) echo '<td></td><td width="120"></td>';
			else echo '<td width="20" id="dt_'.$i.'">'.$i.'</td>';
		}
		echo '<td width="20">TL</td>';
		echo '<td width="20">%</td>';
		echo '</tr>';
		

		echo '<tr><form class="formclasses">';
		for($i=0;$i<=31;$i++){

			if( $i== 0) echo '<td>Classes</td><td>Number</td>';
			else {
			
			echo '<td width="20"><input type="text" name="cl'.$i.'" id="cl'.$i.'" onclick="toggle_cl('.$i.');" style="width:18px; border:none; text-align:center; cursor:pointer;';
				if (in_array($i, $dummy_array))
				{ echo 'font-weight:bold; color:#EEE;" class="color_sel" value="1';}
				else
				{
					echo '" class="color1 ';
				}
			echo '" readonly></td>';
			
			}
		}
		echo '<td class="color3">'.$tot_class.'</td>';
		echo '<td class="color3">NA</td>';
		echo '</form></tr>';
		$count=1;

		echo '<form class="formstudent">';
		while($row_att = mysql_fetch_array($result_att))
		{
			
			$date_mon1 =strtotime( $month.'/1/'.$year);
			$date_mon = strtotime( '+1 month' ,$date_mon1);
			
			
			if($row_att["dos"] > $date_mon) {
				for($i=0;$i<=31;$i++){
					if( $i== 0) {
					echo '<tr class="color2" id="tr_'.$count.'" onMouseOver="this.style.backgroundColor=\'#DBDDDE\' ; " onMouseOut="this.style.backgroundColor=\'#E3E9FF\';">';
					echo '<td>'.$row_att["name"].'</td>';
					echo '<td>'.$row_att["father_mob"].'</td>';
					} else {
						echo '<td style="background:#CCC;"></td>';
					}
				}
				echo '<td style="background:#CCC;"></td><td style="background:#CCC;"></td></tr>';
				continue;
			}
			
		
			$sql_st_at="SELECT date,attendance from attendance WHERE student_id='$row_att[id]' AND month='$month' AND year='$year' and ds=1 ";
			$result_st_at=mysql_query($sql_st_at);
			$st_at = array();
			$st_at_abs = array();
			while($row_st_at = mysql_fetch_array($result_st_at)) {
				if($row_st_at["attendance"] == 'P') {
					array_push($st_at,"$row_st_at[date]");
				} else if ($row_st_at["attendance"] == 'A') {
					array_push($st_at_abs,"$row_st_at[date]");
				}
			}
			
			
			$tot_att= 0;
			
			echo '<tr class="color2" id="tr_'.$count.'" onMouseOver="this.style.backgroundColor=\'#DBDDDE\' ; " onMouseOut="this.style.backgroundColor=\'#E3E9FF\';">';
			for($i=0;$i<=31;$i++)
			{
			if( $i== 0) {
			
			echo '<td>'.$row_att["name"].'<input type="hidden" value="'.$row_att["id"].'" name="student_ids[]"></td>';
			echo '<td>'.$row_att["father_mob"].'</td>';
			}
			else {
			
			echo '<td width="20" onMouseOver="show_date('.$i.');" onMouseOut="hide_date('.$i.');"><input type="text" name="st'.$row_att["id"].'_';
			if($i<10) echo $i;
			else echo $i;							
			echo '" id = "st'.$count.'_'.$i.'" onclick="toggle('.$count.','.$i.');" style="width:18px; border:none; text-align:center; cursor:pointer;" value="';
				if (in_array($i, $st_at))
				{ echo '1" class="present'; $tot_att++;}
				else
				{
				if(in_array($i, $st_at_abs))
				echo '0" class="absent';
				else
				echo '" class="color2';
				}
			echo '" readonly></td>';
			}
			}
			echo '<td class="color3">'.$tot_att.'</td>';
			echo '<td class="color3">';
			if($tot_class == 0)
			{
				echo '0';
			}
			else
			{
				echo ceil($tot_att/$tot_class*100);
			}
			
			
			echo '</td>';
			echo '</tr>';
			$count++;
			if($count%10 == 0 ){
				echo '</form><form class="formstudent">';				
			}
		
		}
		echo '</form>';
		echo '<tr class="color3">';
		for($i=0;$i<=31;$i++)
		{
			if( $i== 0) echo '<td></td><td width="120"></td>';
			else echo '<td width="20" id="dt2_'.$i.'">'.$i.'</td>';
		}
		echo '<td width="20">TL</td>';
		echo '<td width="20">%</td>';
		echo '</tr>';
		?>
		
	</table>

	<br>
	<div align="center" style="margin:20px 0">
		<button id="btn" style="padding:10px;" onclick="save_att()">SAVE</button>
	</div>
</form>

	</div>
	</div>

	<a href="atten_xl.php?city=<?php echo $city_id;?>&center=<?php echo $center_id;?>&group=<?php echo $group_id;?>&month=<?php echo $month;?>&year=<?php echo $year;?>">Export to excel</a>
	<?php
	} else {
		echo "Please select parameters from left";
	}
	
	?>
<script type="text/javascript">
var sent = 0;
	function save_att(){
		var data_class = $(".formclasses").serialize();
		$("#btn").html("SAVING...").removeAttr('onclick');
		var count_form = 1;
		$(".formstudent").each(function(){
			var data_st = $(this).serialize();
			var val_data =  data_class + '&' +data_st+'&count_form='+count_form;
			$.post("ds_attendance/process_ajax.php?month=<?php echo $month;?>&year=<?php echo $year;?>&group=<?php echo $groupid;?>", val_data, function(data){
				
				if(++sent == $(".formstudent").length) {
					location.reload();    
                 }
			})
			count_form++;
		});
	}
</script>