<?php
	
	include 'connect.php';
	
	if (!$connection) {
	    die('Could not connect: ' . mysqli_connect_error());
}
	
	$query = 'SELECT * FROM tbluser, tblstudent WHERE tbluser.userid = tblstudent.studentid';
	$resultset = mysqli_query($connection, $query);
	

		
	
?>