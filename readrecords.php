<?php
	
	include 'connect.php';
	
	if (!$connection) {
	    die('Could not connect: ' . mysqli_connect_error());
	}
	
	// Query to get ALL student data including program and yearlevel
	$query = 'SELECT * FROM tbluser, tblstudent WHERE tbluser.userid = tblstudent.studentid';
	$resultset = mysqli_query($connection, $query);
	
	if(!$resultset) {
	    die('Query failed: ' . mysqli_error($connection));
	}
?>
