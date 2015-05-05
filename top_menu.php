	<style type="text/css">
a
{
color:#000;
border:0px;
}
img
{
border:0px;
}

.menu{
	border:none;
	border:0px;
	margin:0px 0px 20px 0px;
	padding:0px;
	font: 67.5% "Lucida Sans Unicode", "Bitstream Vera Sans", "Trebuchet Unicode MS", "Lucida Grande", Verdana, Helvetica, sans-serif;
	font-size:12px;
	font-weight:bold;
	}
.menu ul{
	background:#333333;
	height:30px;
	list-style:none;
	margin:0;
	padding:0;
	}
	.menu li{
		float:left;
		padding:0px;
		}
	.menu li a{
		background:#333333 url("images/seperator.gif") bottom right no-repeat;
		color:#cccccc;
		display:block;
		font-weight:normal;
		line-height:30px;
		margin:0px;
		padding:0px 10px;
		text-align:center;
		text-decoration:none;
		}
		.menu li a:hover, .menu ul li:hover a{
			background: #2580a2 url("images/hover.gif") bottom center no-repeat;
			color:#FFFFFF;
			text-decoration:none;
			}
	.menu li ul{
		background:#333333;
		display:none;
		height:auto;
		padding:0px;
		margin:0px;
		border:0px;
		position:absolute;
		width:225px;
		z-index:200;
		/*top:1em;
		/*left:0;*/
		}
	.menu li:hover ul{
		display:block;
		
		}
	.menu li li {
		background:url('images/sub_sep.gif') bottom left no-repeat;
		display:block;
		float:none;
		margin:0px;
		padding:0px;
		width:225px;
		}
	.menu li:hover li a{
		background:none;
		
		}
	.menu li ul a{
		display:block;
		height:35px;
		font-size:12px;
		font-style:normal;
		margin:0px;
		padding:0px 10px 0px 15px;
		text-align:left;
		}
		.menu li ul a:hover, .menu li ul li:hover a{
			background:#2580a2 url('images/hover_sub.gif') center left no-repeat;
			border:0px;
			color:#ffffff;
			text-decoration:none;
			}
	.menu p{
		clear:left;
		}	

	.rotat
{
-webkit-transform: rotate(-90deg); 
-moz-transform: rotate(-90deg);
filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=3);
width:20px;
margin-bottom:20px;
color:#000;
}
	.rotat_rev
{
-webkit-transform: rotate(90deg); 
-moz-transform: rotate(90deg);
filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=1);
width:20px;
margin-bottom:20px;
}	

.yellow
{
background:#F7ED7B;
}

.green
{
background:#7CFE9D;
}
.red
{
background:#FB9576;
}
.magenta
{
background:#D97EFB;
}
.blue
{
background:#90FFF8;
}
</style>

<div class="menu" >

		<ul>
		<li>
			<a href="students.php?type=browse" >Students</a>
		</li>
		<?php if($_SESSION["attendance"] > 0 || $priv == 'admin' ): ?>
			<li><a href="attendance.php" >Students' Attendance</a></li>
			<li><a href="ds_attendance.php" >DS' Attendance</a></li>
		<?php endif;?>

		<?php if($_SESSION["evalution"] > 0 || $priv == 'admin' ): ?>
			<li><a href="performance.php" >Students' Evaluations</a></li>
		<?php endif;?>
		<li><a href="manage.php" >Manage</a></li>
		<?php if($_SESSION["coach"] > 0 || $priv == 'admin' ): ?>
			<li><a href="coach.php" >Coaches' Attenance</a></li>
		<?php endif;?>

		<?php if($_SESSION["payments"] > 0 || $priv == 'admin' ): ?>
			<li><a href="payments.php" >Payments</a></li>
		<?php endif;?>


		<?php
		if($priv == 'admin' && $_SESSION['SUPER_ADMIN'] == 1){
			?>
			<li><a href="updates.php" >Updates</a>
			<li><a href="gallery.php" >Update Gallery</a></li>
			<li><a href="query.php" >Query</a></li>
		<?php 
		} ?>
		<?php if($_SESSION["attendance"] > 0 || $priv == 'admin' ){ ?>
			<li><a href="adjustment.php" >Adjustment</a></li>
		<?php } ?>

		<?php
		if($priv == 'admin' && $_SESSION['SUPER_ADMIN'] == 1){
		?>
			<li><a href="schema.php" >Structure</a>
			
		</li>
		<li><a href="images.php" target="_blank" >Images</a>
			
		</li>
		<?php } ?>
		<li><a href="logout.php" >Logout</a>
			
		</li>
		</ul>
	</div>