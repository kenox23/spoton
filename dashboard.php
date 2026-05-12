<?php
    session_start();
    include 'connect.php';
    require_once 'includes/header.php';

    if(!isset($_SESSION['userid'])) {
        header("location: login.php");
        exit();
    }

    $userid = $_SESSION['userid'];
    $role = $_SESSION['role'];
?>

<div style="background-color:#8a252c; height:10px; width:100%;"></div>

<div>
    <h2>Dashboard</h2>
    <p>Welcome, <?php echo $_SESSION['username']; ?>!</p>
</div>

<!-- if the user is a student, show their reservations and option to make new reservations. -->
<?php if($role == 'student') { ?>
    <a href="reservation.php">Make a Reservation</a><br>
    <h3>My Reservations</h3>

    <table border="1">
        <tr>
            <th>Reservation ID</th>
            <th>Date</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th>Purpose</th>
            <th>Waiting Area</th>
            <th>Status</th>
        </tr>

        <?php
            $sql = "select * from tblreservation where studentid = '$userid'";
            $result = mysqli_query($connection, $sql);

            while($row = mysqli_fetch_array($result)){
                
                $waitingareaid = $row['waitingareaid'];
                $sql2 = "select * from tblwaitingarea where waitingareaid = '$waitingareaid'";
                $result2 = mysqli_query($connection, $sql2);
                $waitingarea = mysqli_fetch_assoc($result2);

                echo "<tr>";
                echo "<td>".$row['reservationid']."</td>";
                echo "<td>".$row['reservationdate']."</td>";
                echo "<td>".$row['starttime']."</td>";
                echo "<td>".$row['endtime']."</td>";
                echo "<td>".$row['purpose']."</td>";
                echo "<td>".$waitingarea['areaname']."</td>";
                echo "<td>".$row['status']."</td>";
                echo "</tr>";
            }
        ?>
    </table>
<?php } ?>

<!-- if the user is an admin, show all reservations and option to manage users. -->
<?php if($role == 'admin') { ?>
    <h3>Welcome, Admin <?php echo $_SESSION['username']; ?>!</h3>

    <table border="1">
        <tr>
            <th>Student ID</th>
            <th>Name</th>
            <th>Program</th>
            <th>Year Level</th>
            <th>Action</th>
        </tr>

        <?php
            $sql = "select * from tbluser, tblstudent where tbluser.userid = tblstudent.studentid";
            $result = mysqli_query($connection, $sql);

            while($row = mysqli_fetch_array($result)){
                echo "<tr>";
                echo "<td>".$row['userid']."</td>";
                echo "<td>".$row['firstname']." ".$row['lastname']."</td>";
                echo "<td>".$row['program']."</td>";
                echo "<td>".$row['yearlevel']."</td>";
                echo "<td><a href='delete.php?id=".$row['userid']."'>Delete</a></td>";
                echo "<td><a href='update.php?id=".$row['userid']."'>Update</a></td>";
                echo "</tr>";
            }
            echo "<tr>";
            echo "<td colspan='5'><a href='register.php'>Add New</a></td>";
            echo "</tr>";
        ?>
    </table>

    <h3>Reservations</h3>
    <table border="1">
        <tr>
            <th>Reservation ID</th>
            <th>Student Name</th>
            <th>Date</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th>Purpose</th>
            <th>Waiting Area</th>
            <th>Status</th>
            <th>Action</th>
        </tr>

        <?php
            $sql = "select * from tblreservation, tbluser, tblwaitingarea where tblreservation.studentid = tbluser.userid and tblreservation.waitingareaid = tblwaitingarea.waitingareaid";
            $result = mysqli_query($connection, $sql);

            while($row = mysqli_fetch_array($result)){
                echo "<tr>";
                echo "<td>".$row['reservationid']."</td>";
                echo "<td>".$row['firstname']." ".$row['lastname']."</td>";
                echo "<td>".$row['reservationdate']."</td>";
                echo "<td>".$row['starttime']."</td>";
                echo "<td>".$row['endtime']."</td>";
                echo "<td>".$row['purpose']."</td>";
                echo "<td>".$row['areaname']."</td>";
                echo "<td>".$row['status']."</td>";

                echo "<td>
                    <a href='updatestatus.php?id=".$row['reservationid']."&status=approved'>Approve</a> | 
                    <a href='updatestatus.php?id=".$row['reservationid']."&status=rejected'>Reject</a>
                </td>";
                echo "</tr>";
            }
        ?>
    </table>
<?php } ?>

<a href="logout.php">Logout</a>

<?php require_once 'includes/footer.php'; ?>