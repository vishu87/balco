<?php 
	 session_start();
	 require_once('auth.php');
	 include('top.php');
	 ?>
<body>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
	<script src="ckeditor/_samples/sample.js" type="text/javascript"></script>
	<link href="ckeditor/_samples/sample.css" rel="stylesheet" type="text/css" />
	<div id="wrapper">
		<div id="topmenu">
			<?php 
			
			include('top_menu.php');?>
		</div>
		<div id="header">
		   <?php include('header.php'); ?>
		</div>
	
	
	<div id="content">
		<table cellspacing="0" cellpadding="0" width="100%">
			<tr>
				<td align="left" valign="top" width="200" >
					<div id="left1">
						<div class="top_m color2">
						Schema:Select Table
						</div>
						<br>
					<?php	include('schema/left.php'); ?>
						
					</div>
				</td>
				<td align="left" valign="top">
					<div id="right1">
					<?php 
					if(!$_GET["type"])
					{
						include('schema/schema.php');
					
					}
					else
					{
						include('schema/schema_view.php');
					
					}						
					?>
					</div>
				</td>
			
			
			</tr>
		
		
		</table>
	
	
	</div>
	
	
	
	
		      
		</div>
	 
	
	</body>
</html>

