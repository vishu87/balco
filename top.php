<?php

$inactive = 1800; // Set timeout period in seconds

if (isset($_SESSION['timeout'])) {
    $session_life = time() - $_SESSION['timeout'];
    if ($session_life > $inactive) {
        session_destroy();
        header("Location: access-denied.php");
    }
}
$_SESSION['timeout'] = time();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
   "http://www.w3.org/TR/html4/strict.dtd">
<?php 

	 include('login.php');
	$priv = $_SESSION['PRIV'];
	 ?>
<html>
	<head>
	<title>BHAICHUNG BHUTIA FOOTBALL SCHOOLS</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<link href="template.css" rel="stylesheet" type="text/css" />
		<script src="js/jquery1.js"></script>
		<script src="js/jquery.tablesorter.js"></script>
		<?php
		
		if($_GET["type"] == 'sms')
		{
			echo '<script type="text/javascript" src="ckeditor/ckeditor.js"></script>

	<script src="ckeditor/_samples/sample.js" type="text/javascript"></script>

	<link href="ckeditor/_samples/sample.css" rel="stylesheet" type="text/css" />';
		}
		

		?>
		<link rel="stylesheet" type="text/css" media="all" href="jsDatePick_ltr.min.css" />
		<link rel="stylesheet" type="text/css" media="all" href="sorter/style.css" />
		<script type="text/javascript" src="jsDatePick.min.1.3.js"></script>
		<script type="text/javascript" src="js/docs.js"></script>
<style type="text/css">
.invisi
{
visibility:hidden;
height: 0px;
}
.visi
{
visibility:visible;
margin:-3px 10px 10px 10px;
}
.mark_in1
{
color:#fff; padding:3px 5px 3px 5px; background:#5F6888;
}
.mark_in2
{
color:#000; padding:3px 5px 9px 5px; background:#FF0;
}
</style>
<script type="text/javascript">
	$(document).ready(function() {
	$("table").tablesorter({
		// pass the headers argument and assing a object
		headers: {
			// assign the secound column (we start counting zero)
			1: {
				// disable it by setting the property sorter to false
				sorter: false
			},
			// assign the third column (we start counting zero)
			12: {
				// disable it by setting the property sorter to false
				sorter: false
			}
		}
	});
});
</script>
<script type="text/javascript">
	window.onload = function(){
		new JsDatePick({
			useMode:2,
			target:"inputField",
			dateFormat:"%d-%m-%Y"
		});
		new JsDatePick({
			useMode:2,
			target:"inputField1",
			dateFormat:"%d-%m-%Y"
		});
		new JsDatePick({
			useMode:2,
			target:"inputField2",
			dateFormat:"%d-%m-%Y"
		});



	};
</script>

<script type="text/javascript" charset="utf-8">
		$(function(){
		
			$("select#ctlcity").change(function(){
				$.getJSON("select.php",{id: $(this).val()}, function(j){
					var options = '';
					for (var i = 0; i < j.length; i++) {
						options += '<option value="' + j[i].optionValue + '">' + j[i].optionDisplay + '</option>';
					}
					$("#ctlcenter").html(options);
					//$('#ctlcenter option:first').attr('selected', 'selected');
				})
			})	
			
			$("select#ct1center").change(function(){
				$.getJSON("select_group.php",{id: $(this).val(), city: $("#ct1city").val()}, function(j){
					var options = '';
					for (var i = 0; i < j.length; i++) {
						options += '<option value="' + j[i].optionValue + '">' + j[i].optionDisplay + '</option>';
					}
					$("#ct1group").html(options);
					//$('#ctlcenter option:first').attr('selected', 'selected');
				})
			})

			$("select#ctlcityid").change(function(){
				$.getJSON("select_id.php",{id: $(this).val()}, function(j){
					var options = '';
					for (var i = 0; i < j.length; i++) {
						options += '<option value="' + j[i].optionValue + '">' + j[i].optionDisplay + '</option>';
					}
					$("#ctlcenterid").html(options);
					//$('#ctlcenter option:first').attr('selected', 'selected');
				})
			})	
			
			$("select#ct1centerid").change(function(){
				$.getJSON("select_group_id.php",{id: $(this).val()}, function(j){
					var options = '';
					for (var i = 0; i < j.length; i++) {
						options += '<option value="' + j[i].optionValue + '">' + j[i].optionDisplay + '</option>';
					}
					$("#ct1groupid").html(options);
					//$('#ctlcenter option:first').attr('selected', 'selected');
				})
			})

			$("select#ctlcityidtype").change(function(){
				$.getJSON("select_id_type.php",{id: $(this).val(),type:get_type}, function(j){
					var options = '';
					for (var i = 0; i < j.length; i++) {
						options += '<option value="' + j[i].optionValue + '">' + j[i].optionDisplay + '</option>';
					}
					$("#ctlcenteridtype").html(options);
				})
			})	
			
			$("select#ctlcenteridtype").change(function(){
				$.getJSON("select_group_id_type.php",{id: $(this).val(),type:get_type}, function(j){
					var options = '';
					for (var i = 0; i < j.length; i++) {
						options += '<option value="' + j[i].optionValue + '">' + j[i].optionDisplay + '</option>';
					}
					$("#ct1groupidtype").html(options);
				})
			})


			$("select#ct2city").change(function(){
				window.location.replace("?stu_city=" +$(this).val() )
			})
			
			$("select#ct3city").change(function(){
				window.location.replace("?type=edit&id=<?php echo $_GET["id"];?>&stu_city=" +$(this).val() )
			})
			
			$("select#ct2center").change(function(){
				window.location.replace("?stu_center=" +$(this).val() +"&stu_city=" +$("#ct2city").val()  )
			})
			
			$("select#ct3center").change(function(){
				window.location.replace("?type=edit&id=<?php echo $_GET["id"];?>&stu_center=" +$(this).val() +"&stu_city=" +$("#ct3city").val()  )
			})
			
			
			$("#calculate").click(function(){
				$.post("cal_date.php", { dos: $("#inputField").val(), mplan:$("#mplan").val(),adjust:$("#adjust").val() },
					  function(data){
						$("#sub_end").val(data);
					  });


			})
			
			$("#a_inactive").click(function(){
			
			
			  //add message and change the class of the box and start fading
			  $("#inactive_div").removeClass().addClass('visi');
			   $("#a_inactive").removeClass().addClass('mark_in2');
			
	})
			
		})
		
		
			
		
		
		
		</script>



		</head>
		