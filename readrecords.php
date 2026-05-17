<?php
	
	include 'connect.php';
	
	if (!$connection) {
	    die('Could not connect: ' . mysqli_connect_error());
}
	
	$query = 'select * from tbluser, tblstudent where tbluser.userid = tblstudent.studentid';
	$resultset = mysqli_query($connection, $query);
	

		
	
?>