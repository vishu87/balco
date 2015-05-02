<script language='JavaScript'>
    checked = false;

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
	Attendance
</div>

<br>
	<?php
		echo '<span style="padding:10px; font-size:16px; color:#0E3DCA;">'.$center.', '.$city.'</span><br>';
		if( ($month && $year) && (city && $center)){
	?>
	<br>
	<div style="margin:5px 5px 0px 5px;">
	<?php
		if($priv != 'coach') {
			$sql_groups="SELECT group_name from groups WHERE city_name='$city' AND center_name='$center'";
		} else {
			$sql_mem="SELECT id from members WHERE username='$_SESSION[SESS_MEMBER_ID]' limit 1";
			$result_mem=mysql_query($sql_mem);
			$row_mem = mysql_fetch_array($result_mem);
			$sql_groups="SELECT * from coach_groups WHERE (city_name='$city' AND center_name='$center') AND (coach_id='$row_mem[id]' AND active='0')";
		}
		$sql_groups =$sql_groups." ORDER BY group_name ASC";
		
	$result_groups=mysql_query($sql_groups);
	$count_groups =0;
	
	while($row_groups = mysql_fetch_array($result_groups)) {
		if(!$_GET["group"] && $count_groups == 0){	
			$group = $row_groups["group_name"];
		} else{
			if($_GET["group"]){
				$group = $_GET["group"];
			}
		}
		if(	$row_groups["group_name"] == $group) {
			echo '&nbsp;&nbsp;&nbsp;<span style="padding:3px; border-top:2px solid #bbb;
			border-bottom:2px solid #fff;
			border-left:2px solid #bbb;
			border-right:2px solid #bbb;"><a href="?month='.$_GET["month"].'&amp;year='.$_GET["year"].'&amp;city='.$_GET["train_city"].'&amp;train_center='.$_GET["train_center"].'&amp;group='.$row_groups["group_name"].'">'.$row_groups["group_name"].'</a></span>&nbsp;&nbsp;&nbsp;';
		} else {
			echo '&nbsp;&nbsp;&nbsp;<span style="padding:3px; background:#bbb; color:#fff; border:2px solid #bbb;"><a href="?month='.$_GET["month"].'&amp;year='.$_GET["year"].'&amp;train_city='.$_GET["train_city"].'&amp;train_center='.$_GET["train_center"].'&amp;group='.$row_groups["group_name"].'">'.$row_groups["group_name"].'</a></span>&nbsp;&nbsp;&nbsp;';
		
		}

		$count_groups++;
	}
	
	?>
	</div>
	<?php
		$sql_group = mysql_query("SELECT id from groups where city_name='$city' AND center_name ='$center' AND group_name='$group' limit 1");
		$row_group = mysql_fetch_array($sql_group);
		$groupid = $row_group["id"];

		$active_student_group = array();
		$sql_case="SELECT id, father_mob, name, dos, second_group from students WHERE first_group='$groupid' AND active='0' ";
		$sql_case =$sql_case." ORDER BY name ASC";
		$result_att=mysql_query($sql_case);
		$tot_st = mysql_num_rows($result_att);
	?>
	<div style="margin:3px 5px 5px 5px;padding:5px; border:2px solid #bbb;">

		Monthly Attendance: <?php echo $months_name[$month - 1].', '.$year;?>

	<div id="atten" align="center">

		<table cellspacing="0" cellpadding="0" width="100%" style="margin-top:10px;">

		<?php
			$sql_dummy="SELECT date from attendance WHERE student_id='dm' AND groupid='$groupid' AND month='$month' AND year='$year' ";
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
				else {
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
			for($i=0;$i<=31;$i++){
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
					if (in_array($i, $dummy_array)){ 
						echo 'font-weight:bold; color:#EEE;" class="color_sel" value="1';
					} else {
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
			$date_mon1 =strtotime( $month.'/1/'.$year);
			$date_mon = strtotime( '+1 month' ,$date_mon1);
			while($row_att = mysql_fetch_array($result_att)){
				$student_id = $row_att["id"];
				array_push($active_student_group, $student_id);
				include('attendance_table.php');
			}
			echo '<tr class="color3"><td colspan="35">OLD STUDENTS</td></tr>';
			//for old active students
			$sql_old_active = mysql_query("SELECT students.id, students.father_mob, students.name, students.dos, students.second_group from group_shift left join students on group_shift.student_id = students.id where group_shift.old_group = '$groupid' and group_shift.shift_date > '$date_mon1' and students.active = 0 ");
			while($row_att = mysql_fetch_array($sql_old_active)){
				$student_id = $row_att["id"];
				array_push($active_student_group, $student_id);
				include('attendance_table.php');
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

	<a href="atten_xl.php?city=<?php echo $city;?>&center=<?php echo $center;?>&group=<?php echo $group;?>&month=<?php echo $month;?>&year=<?php echo $year;?>">Export to excel</a>
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
			$.post("attendance/process_ajax.php?month=<?php echo $month;?>&year=<?php echo $year;?>&group=<?php echo $groupid;?>", val_data, function(data){
				
				if(++sent == $(".formstudent").length) {
					location.reload();    
                 }
			})
			count_form++;
		});
	}
</script>