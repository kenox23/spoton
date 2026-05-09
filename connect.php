<?php 
	$connection = new mysqli('localhost', 'root','','dbspoton');
	
	if (!$connection){
		die (mysqli_error($mysqli));
	}
		
?>
