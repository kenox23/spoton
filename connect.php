<?php
$connection = mysqli_connect('localhost', 'root', '', 'dbspoton');

if (!$connection) {
    die('Could not connect: ' . mysqli_connect_error());
}
?>
