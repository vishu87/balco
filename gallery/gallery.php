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
   if (validate_required(name,"Please fill the name!")==false)
  {name.focus();return false;}
   if (validate_required(train_city,"Please fill Training City!")==false)
  {train_city.focus();return false;}
   if (validate_required(train_center,"Please fill Center Name!")==false)
  {train_center.focus();return false;}
   if (validate_required(groupid,"Please fill Group Name!")==false)
  {groupid.focus();return false;}
  
  }
}
</script>

						<div class="top_m color1">
						Add New Photos
						</div>
						<div style="margin:5px;">
						New Photo
						<form action="gallery/process_gallery.php?type=1" method="post" onsubmit="return validate_form(this)" enctype="multipart/form-data">
						<div align="center">
						<?php
						if($_GET["msg"] == 1)
						{
							echo '<span class="green">Picture is added successfully</span><br>';
						}
						if($_GET["msg"] == 2)
						{
							echo '<span class="red">Re-upload the picture</span><br>';
						}
						if($_GET["msg"] == 3)
						{
							echo '<span class="red">Picture Deleted</span><br>';
						}
						if($_GET["msg"] == 4)
						{
							echo '<span class="red">File format is not supported</span><br>';
						}
						
						?>
						
						
						</div>
						<table cellspacing="0" cellpadding="0" width="100%" style="margin-top:10px;">
							<tr>
								
									<td align="left" valign="top" width="50%">
								     <div id="gen_form">
										<table cellspacing="0" cellpadding="0" width="100%" style="margin-top:10px;">
							<tr class="color2">
								<td align="left" valign="top" colspan="2">
								Images
								</td>
								
							</tr>
							<tr>
							<td width="40%" align="right">Choose New Pic (Max 700KB)
							</td>
							<td><input type="file" name="file" style="text-align:right"></td>
							</tr>
							<tr>
							<td width="40%" align="right">Caption
							</td>
							<td><input type="text" name="caption" style="text-align:right"></td>
							</tr>
							<tr>
							<td width="40%" align="right">Gallery/Event
							</td>
							<td><select name="place">
							<option value="gallery">Main Gallery</option>
							<?php
							$result_event = mysql_query("select id,title from updates order by title asc");
							while($row_event = mysql_fetch_array($result_event))
							{
							echo '<option value='.$row_event["id"].'>'.substr($row_event["title"],0,30).'</option>';
							}
							
							
							?>
							
							</select>
							</td>
							</tr>
							
							
							</table>
									
									</div>
								  
								</td>
							</tr>
							
						</table>
						<div align="center">
						<input type="SUBMIT" name="add" Value="ADD">&nbsp;&nbsp;&nbsp;&nbsp;<input onclick="javascript:window.history.back()" type="BUTTON" name="cancel" value="CANCEL">
						</div>
						</form>
						</div>
						
						<div>
						<?php $sql_case_img="SELECT * from gallery";
                                               
                                                $result_case_img = mysql_query($sql_case_img);
                                                while($row_img = mysql_fetch_array($result_case_img))
												{
													echo '<div style="float:left; border:2px solid #aaa; padding:5px; margin:5px;"><a href="../gallery/tn2_'.$row_img["img"].'" target="_blank" style="margin:10px;"><img src="../gallery/tn_'.$row_img["image"].'"></a>';
if($_GET["pic_id"] == $row_img["id"])
{
echo '<form action="gallery/process_gallery.php?type=3&amp;pic_id='.$row_img["id"].'" method="post" >
<input type="text" name="caption" value="'.$row_img["caption"].'">
<input type="submit" value="change">
</form>
';
}
else
{
echo '<br>'.$row_img["caption"].'
													<br><a href="gallery.php?pic_id='.$row_img["id"].'">Edit Caption</a>';
}
													
echo '<a href="gallery/process_gallery.php?type=2&amp;pic_id='.$row_img["id"].'"><img src="gallery/delete.png"></a> &nbsp;&nbsp;Place:'.$row_img["place"].'
													</div>';
												}
												?>
						</div>