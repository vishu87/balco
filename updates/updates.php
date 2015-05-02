

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
   if (validate_required(ann,"Please fill announcement!")==false)
  {ann.focus();return false;}
   
  }
}
</script>


						<div class="top_m color1">
						Latest Updates
						</div>
						<div style="margin:5px;">
						Add Update<br><br>
						<form action="updates/process_updates.php?type=1" method="post" onsubmit="return validate_form(this)" enctype="multipart/form-data">
						<div align="left">
						Date <select name="date">
							<?php
							for($i=1; $i<32;$i++)
							{
								echo '<option>'.$i.'</option>';
							}
							?>
							</select>
							Month <select name="month">
							<?php
							for($i=1; $i<13;$i++)
							{
								echo '<option>'.$i.'</option>';
							}
							?>
							</select>
							Year <select name="year">
							<?php
							for($i=2012; $i<2020;$i++)
							{
								echo '<option>'.$i.'</option>';
							}
							?>
							</select><br><br>
						
						</div>
						
						<div align="left">
						<p>Image: <input type="file" name="file"><br>(Not more than 700kb.. Jpeg,png preferable)
			</p><p>
			Title:<br>
			<textarea cols="100" id="editor1" name="title" rows="2"></textarea><br><br><br>
			Front Page Text:<br>
			<textarea cols="100" id="editor1" name="content_front" rows="2"></textarea><br><br><br>
			Content:<br>
			<textarea cols="50" id="editor" class="ckeditor" name="content" rows="20"></textarea>
			
		</p>
						</div>
						<div align="center">
						<input type="SUBMIT" name="add" Value="ADD">&nbsp;&nbsp;&nbsp;&nbsp;<input onclick="javascript:window.history.back()" type="BUTTON" name="cancel" value="CANCEL">
						</div>
						
						
						</form>
						</div>
						
						