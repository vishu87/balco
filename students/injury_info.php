<script type="text/javascript">
function validate_required(field,alerttxt)
{
with (field)
  {
  if (value==null||value=="Select"|| value=="")
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
   if (validate_required(in_dos,"Please fill the date!")==false)
  {in_dos.focus();return false;}

  
  }
}
</script>

<?php 
function Duration2($s , $e){

/* Find out the seconds between each dates */
$timestamp = $e - $s;

/* Cleaver Maths! */
$days=floor($timestamp/(60*60*24));

$str = $days;
return $str;

}
?>
<form action="students/process_student.php?type=<?php 
if($_GET["update"] == 'injury')
{
echo 'injury_update';
}
else
{
echo 'injury_add';
}
?>
&id=<?php echo $_GET["id"]; ?>&inj_id=<?php echo $_GET["inj_id"]; ?>" method="post" onsubmit="return validate_form(this)" enctype="multipart/form-data">
<?php
$sql_case="SELECT * from injury_history WHERE id='$_GET[inj_id]'";
$sql_case =$sql_case." ORDER BY id DESC";
$result_case=mysql_query($sql_case);
$num_rows = mysql_num_rows($result_case);
if($_GET["update"] == 'injury')
{
$row_injury_edit = mysql_fetch_array($result_case);
}
?>
<table cellspacing="0" cellpadding="0" width="100%" style="margin-top:10px;">
							<tr class="color2">
								<td align="left" valign="top" colspan="2">
								Mark As Injured
								</td></tr>
							<tr>
							<td align="right" width="30%">Injured On
							</td>
							<td align="left" ><input type="text" size="12" name="in_dos" id="inputField" value="<?php  if($_GET["update"] == 'injury')
{echo date("d-m-Y", $row_injury_edit["dos"]); }?>" /></td></tr>
<?php

if($_GET["update"] == 'injury')
{
?>
<tr>
							<td align="right" width="30%">Recovered On
							</td>
							<td align="left" ><input type="text" size="12" name="in_doe" id="inputField1" value="<?php  if($row_injury_edit["doe"])
{echo date("d-m-Y", $row_injury_edit["doe"]); }?>" /></td></tr>
<?php
}
?>
<tr>
<td align="right" width="30%">Remark
							</td>
							<td align="left" ><input type="text" size="20" name="remark"  value="<?php echo $row_injury_edit["remark"]; ?>" /></td>
							</tr>
							<tr><td></td><td>&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="SUBMIT" Value="<?php if($_GET["update"] == 'injury')
							echo 'UPDATE';
							else echo 'MARK';
							?>">
							
							<?php if($_GET["update"] == 'injury')
							{
							echo '<input type="button" Value="CANCEL" onClick="location.href=\'students.php?type=browse&id='.$_GET["id"].'\'">';
							
							
							
							}
							
							?>
							</td>
							</tr>
							
							
</table>
</form>


<?php
$sql_case="SELECT * from injury_history WHERE student_id='$_GET[id]'";
$sql_case =$sql_case." ORDER BY dos DESC";
$result_case=mysql_query($sql_case);
$num_rows = mysql_num_rows($result_case);
if($num_rows == 0)
{
	echo 'No Injury History';
}							
else
{	
?>

							
							Injury Details :
							<br>
							
							<table cellspacing="1" cellpadding="0" width="100%">
							<tr class="color3">
									<td>
									SN
									</td>
									<td>
									Injured ON
									</td>
									<td>
									Recoverd On
									</td>
									<td>
									Days
									</td>
									
									
									<td>
									Remark<br><font style="font-size:10px;"></font>
									</td><td>Edit</td>	
<td>Delete</td>									
								</tr>
								<?php
								$num_pay =1;
								$result_case=mysql_query($sql_case);
								while($row_injury = mysql_fetch_array($result_case))
								{
									
									if($num_pay%2 ==1)
										{
									echo '<tr class="color2">';
									}
									else
									{
									echo '<tr>';
									}
									echo'
									
									<td>
									'.($num_pay).'
									</td>
									<td>
									';
									 echo date("d M Y", $row_injury["dos"]);
									
									echo '
									</td>
									<td>
									';
									if($row_injury["doe"])
									{echo date("d M Y", $row_injury["doe"]);}
									echo'
									</td>
									<td>
									';
                                                                      if($row_injury["doe"]){
									$in_days = Duration2($row_injury["dos"] ,$row_injury["doe"]);
									echo $in_days;
									}
else
{
echo Duration2($row_injury["dos"] ,strtotime("now"))." till now";
}
									
									echo '
									</td>
									
									
									<td>
									'.$row_injury["remark"].'
									</td>
									<td align="center"><a href= "students.php?type=browse&amp;id='.$_GET["id"].'&amp;inj_id='.$row_injury["id"].'&amp;update=injury" ><img src="edit.png"></a></td>
									<td align="center"><a href= "students/process_student.php?type=injury_del&amp;id='.$_GET["id"].'&amp;inj_id='.$row_injury["id"].'"  onclick="return confirm(\'Do You Really Want to Delete? \');"><img src="erase.png"></a></td>
								</tr>';
								$num_pay--;
								}
								
								?>
							</table>
							
<?php
}
?>
