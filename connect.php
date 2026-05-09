<?php 
	$connection = new mysqli('localhost', 'root','','dbBacus');
	
	if (!$connection){
		die (mysqli_error($mysqli));
	}
		
?>