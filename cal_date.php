<?php
	$dos = strtotime($_POST["dos"]);
	if($_POST["mplan"]){
	$dos = strtotime('+'.$_POST["mplan"].' month',$dos);}
	if($_POST["adjust"]){
	$dos = strtotime('+'.$_POST["adjust"].' days',$dos);}
	echo date("d M Y", $dos);
?>