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
   if (validate_required(updates,"Please fill updatesouncement!")==false)
  {updates.focus();return false;}
   
  }
}
</script>
<?php
$sql_case="SELECT * from updates where id='$_GET[id]'";
$result_case=mysql_query($sql_case);
$row_a = mysql_fetch_array($result_case);
$dob=date("j/n/Y", $row_a["timestamp"]);
$dob_str = explode("/", $dob);
?>

						<div class="top_m color1">
						Latest Updates
						</div>
						<div style="margin:5px;">
						EDIT Update
						<form action="updates/process_updates.php?type=edit&amp;id=<?php echo $_GET["id"];?>" method="post" onsubmit="return validate_form(this)" enctype="multipart/form-data">
						
						
						<div align="left">
						Title:<br>
			<textarea cols="100" id="editor1" name="title" rows="2"><?php echo stripslashes($row_a["title"]); ?></textarea><br><br><br>
			Front Page Text:<br>
			<textarea cols="100" id="editor1" name="content_front" rows="2"><?php echo stripslashes($row_a["content_front"]); ?></textarea><br><br><br>
			Content:
						<p>
			</p><p>
			<textarea cols="50" id="editor1" class="ckeditor" name="content" rows="20"><?php echo stripslashes($row_a["content"]); ?></textarea>
			
		</p>
						</div>
						
						
						
						<div align="center">
						Date <select name="date">
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
							for($i=2012; $i<2020;$i++)
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
							</select><br><br>
							<p>Image: <input type="file" name="file"><br>(Not more than 700kb.. Jpeg,png preferable)
			</p>
			<p>Current Image: <img src="../update_image/<?php echo 'tn2_'.$row_a["image"]; ?>">
			</p>
						<input type="SUBMIT" name="add" Value="UPDATE">&nbsp;&nbsp;&nbsp;&nbsp;<input onclick="javascript:window.history.back()" type="BUTTON" name="cancel" value="CANCEL">
						</div>
						</form>
						</div>
						
						