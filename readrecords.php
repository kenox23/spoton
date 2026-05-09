<?php
include 'connect.php';

// Query to get student information from both tables without JOIN
$query = "SELECT * FROM tbluser, tblstudent WHERE tbluser.userid = tblstudent.studentid";
$resultset = mysqli_query($connection, $query);

// Check if query was successful
if (!$resultset) {
    die("Query failed: " . mysqli_error($connection));
}
?>
