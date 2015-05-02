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
   if (validate_required(file,"Please Select a File!")==false)
  {file.focus();return false;}
    
  }
}
</script>

						<div class="top_m color1">
						Images:
						</div>
						<div style="margin:5px;">
						New Image
						<form action="image/process_image.php" method="post" onsubmit="return validate_form(this)" enctype="multipart/form-data">
						<div align="center">
						<input type="file" name="file">&nbsp;&nbsp;&nbsp;
						<input type="SUBMIT" name="add" Value="ADD" style="padding:4px;">
						</div>
						</form>
						</div>
						<div class="gen_table">
						Existing Images:<br>
						<table width="100%" cellpadding="3"  cellspacing="2">
						<tr class="color3" ><td style="width:150px;">Icon</td><td>Link</td><td style="width:150px;">Delete</td>
						
						</tr>
						<?php
						$sql_case="SELECT * from images ORDER BY id DESC ";
						$result_case=mysql_query($sql_case);
						while($row = mysql_fetch_array($result_case))
						{
						echo '<tr>
						<td style="width:150px;"><img src="http://www.bbfootballschools.com/image_email/tn_'.$row["image"].'"></td>';
						echo '
						<td><b>http://www.bbfootballschools.com/image_email/'.$row["image"].'</b></td>';
						echo '<td style="width:150px;"><a href="image/process_image.php?type=delete&amp;id='.$row["id"].'">Delete</a></td></tr>';
						}
						
						?>
						</table>
						</div>
						
						