<?php 
	 session_start();
	 
	 ?>
<body>
	<div id="wrapper">
		<div id="topmenu">
			
		</div>
		<div align="center">
		  <img src="logo_small.png" width="100" height="100" />
		</div>
		<div align="center">
	
		<form id="loginForm" name="loginForm" method="post" action="login-exec.php">
  <table width="400" border="0" align="center" cellpadding="2" cellspacing="5"
  style="font-size:13px; color:#666;font-family:arial;font-weight:bold;  margin:10px; text-align:center;">
    <tr>
	<td rowspan="3"><img src="lock_icon.png" valign="middle"></td>
      <td width="112" align="right" style="padding:5px; "valign="middle">Username</td>
      <td width="188" align="left" style="padding:5px; "valign="middle"><input name="login" type="text" class="textfield" id="login" style="border-style: none;
		background-color: darkred; padding:5px;
		color: white;
		font-weight: bold;
		padding-left: 2px;"/></td>
    </tr>
    <tr>
      <td align="right" style="padding:5px; "valign="middle">Password</td>
      <td align="left " style="padding:5px; "valign="middle"><input name="password" type="password" class="textfield" id="password" style="border-style: none;
		background-color: darkred; padding:5px;
		color: white;
		font-weight: bold;
		padding-left: 2px;"/></td>
    </tr>
    <tr>
      <td valign="middle">&nbsp;</td>
      <td align="right" valign="middle"><input type="submit" name="Submit" value="Login" style="cursor:pointer;
		border:outset 1px #ccc;
		background:#999;
		color:#666;
		font-weight:bold;
		padding: 1px 2px;
		background:url(formbg.gif) repeat-x left top;"/></td>
    </tr>
  </table>
</form>
		 </div>     
		</div>
	 
	
	</body>
</html>

