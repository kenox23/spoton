<?php
    include 'connect.php';

    if(isset($_GET['id']) && isset($_GET['status'])){
        $id = (int)$_GET['id'];
        $status = $_GET['status'];

        if($status != 'approved' && $status != 'rejected'){
            echo "<script language='javascript'>
                    alert('Invalid status value.');
                    window.location.href = 'dashboard.php';
                  </script>";
                  exit();
        }

        $sql = "UPDATE tblreservation SET status='$status' WHERE reservationid='$id'";
        if(mysqli_query($connection, $sql)){
            echo "<script language='javascript'>
                    alert('Status updated successfully.');
                    window.location.href = 'dashboard.php';
                  </script>";
        } else {
            echo "<script language='javascript'>
                    alert('Error updating status: " . mysqli_error($connection) . "');
                    window.location.href = 'dashboard.php';
                  </script>";
        }
    } else {
        echo "<script language='javascript'>
                alert('Invalid request.');
                window.location.href = 'dashboard.php';
              </script>";
    }