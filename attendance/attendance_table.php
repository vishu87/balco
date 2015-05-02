<?php


//check if student was in this group before he joined, check is done by date of start of his training with last date of the month
if($row_att["dos"] > $date_mon) {
	for($i=0;$i<=1;$i++){
		if( $i== 0) {
		echo '<tr class="color2" id="tr_'.$count.'" onMouseOver="this.style.backgroundColor=\'#DBDDDE\' ; " onMouseOut="this.style.backgroundColor=\'#E3E9FF\';">';
		echo '<td>'.$row_att["name"].'</td>';
		echo '<td>'.$row_att["father_mob"].'</td>';
		} else {
			echo '<td style="background:#CCC;" colspan="31">JOINED AFTER THIS MONTH</td>';
		}
	}
	echo '<td style="background:#CCC;"></td><td style="background:#CCC;"></td></tr>';
} else {

// check if the student joined this group in this month
$result_check = mysql_query("SELECT id,shift_date from group_shift WHERE student_id='$student_id' AND new_group = '$groupid' AND shift_date >= '$date_mon1' limit 1");
$flag_new = mysql_num_rows($result_check);
if($flag_new){
	$row_shift = mysql_fetch_array($result_check);
	$shift_date_new = $row_shift["shift_date"];
}
// check if the student leave this group in this month
$result_check = mysql_query("SELECT id,shift_date from group_shift WHERE student_id='$student_id' AND old_group = '$groupid' AND shift_date >= '$date_mon1' AND shift_date < $date_mon limit 1");
$flag_old = mysql_num_rows($result_check);
if($flag_old){
	$row_shift = mysql_fetch_array($result_check);
	$shift_date_old = $row_shift["shift_date"];
}

$sql_st_at="SELECT date,attendance,ds from attendance WHERE student_id='$student_id' AND month='$month' AND year='$year' ";
$result_st_at=mysql_query($sql_st_at);
$st_at = array();
$ds_st_at = array();
$st_at_abs = array();
while($row_st_at = mysql_fetch_array($result_st_at)) {
	if($row_st_at["attendance"] == 'P') {
		array_push($st_at,"$row_st_at[date]");
		if($row_st_at["ds"] == 1) array_push($ds_st_at, $row_st_at["date"]);
	} else if ($row_st_at["attendance"] == 'A') {
		array_push($st_at_abs,"$row_st_at[date]");
	}
}


$tot_att= 0;
echo '<tr class="color2" id="tr_'.$count.'" onMouseOver="this.style.backgroundColor=\'#DBDDDE\' ; " onMouseOut="this.style.backgroundColor=\'#E3E9FF\';">';
for($i=0;$i<=31;$i++){
	$timedate = $date_mon1 + ($i-1)*86400;
	if( $i== 0) {					
		echo '<td>'.$row_att["name"].'<input type="hidden" value="'.$row_att["id"].'" name="student_ids[]"></td>';
		echo '<td>'.$row_att["father_mob"].' '.$flag_new.$flag_old.'</td>';
	} else {					
		
		echo '<td width="20" onMouseOver="show_date('.$i.');" onMouseOut="hide_date('.$i.');"><input type="text" ';
		$str_ok  = ' name="st'.$row_att["id"].'_'.$i.'" onclick="toggle('.$count.','.$i.');" style="width:18px; border:none; text-align:center; cursor:pointer;" ';
		$str_not_ok = ' style="width:18px; border:none; background:#888; text-align:center; " ';

		if($flag_old == 0 && $flag_new == 0){
			echo  $str_ok;
		} else if($flag_new != 0){
			if($timedate < $shift_date_new){
				echo $str_not_ok;
			} else echo $str_ok;
		} elseif ($flag_old != 0) {
			if($timedate >= $shift_date_old){
				echo $str_not_ok;
			} else echo $str_ok;
		}
		

		echo ' id = "st'.$count.'_'.$i.'" value="';
			if (in_array($i, $st_at))
			{ 
				if (in_array($i, $ds_st_at)){
					echo '1" class="ds_present'; 
				} else {
					echo '1" class="present'; 
				}								
				$tot_att++;

			} else {
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
if($tot_class == 0) {
	echo '0';
} else {
	echo ceil($tot_att/$tot_class*100);
}
echo '</td></tr>';
$count++;
if($count%10 == 0 ){
	echo '</form><form class="formstudent">';				
}
}
?>