<?php 
    include 'connect.php';
    session_start();

    if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin'){
        echo "<script language='javascript'>
                alert('Access denied. Admins only.');
                window.location.href = 'index.php';
              </script>";
              exit();
    }

    if(isset($_GET['id'])){
        $id = $_GET['id'];

        
        $sql1 = "DELETE FROM tblstudent WHERE studentid = '$id'";
        mysqli_query($connection, $sql1);

        
        $sql2 = "DELETE FROM tbluser WHERE userid = '$id'";
        mysqli_query($connection, $sql2);

        echo "<script language='javascript'>
                alert('Record deleted successfully.');
                window.location.href = 'dashboard.php';
              </script>";
    } else {
        echo "<script language='javascript'>
                alert('No ID specified.');
                window.location.href = 'dashboard.php';
              </script>";
    }