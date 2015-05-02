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
						Structure
						</div>
						<div style="margin:5px;">
						Please select from left
						</div>

						
						