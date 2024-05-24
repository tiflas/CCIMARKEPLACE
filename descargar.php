<?php
	$file = file("aplicacion/Iconstruye Colombia.msi");
	$file2 = implode("", $file);
	header('Content-type: application/octet-stream');
	header("Content-Transfer-Encoding: Binary"); 
	header("Content-disposition: attachment; filename=Iconstruye Colombia.msi");

	echo $file2;
?>