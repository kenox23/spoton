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

<div>
    <h2>Dashboard</h2>
    <p>Welcome, <?php echo $_SESSION['username']; ?>!</p>
</div>

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
            <th>Status</th>
        </tr>

        <?php
            $sql = "select * from tblreservation where studentid = '$userid'";
            $result = mysqli_query($connection, $sql);

            while($row = mysqli_fetch_array($result)){
                echo "<tr>";
                echo "<td>".$row['reservationid']."</td>";
                echo "<td>".$row['reservationdate']."</td>";
                echo "<td>".$row['starttime']."</td>";
                echo "<td>".$row['endtime']."</td>";
                echo "<td>".$row['purpose']."</td>";
                echo "<td>".$row['status']."</td>";
                echo "</tr>";
            }
        ?>
    </table>
<?php } ?>

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
                echo "</tr>";
            }
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
            <th>Status</th>
            <th>Action</th>
        </tr>

        <?php
            $sql = "select * from tblreservation, tbluser where tblreservation.studentid = tbluser.userid";
            $result = mysqli_query($connection, $sql);

            while($row = mysqli_fetch_array($result)){
                echo "<tr>";
                echo "<td>".$row['reservationid']."</td>";
                echo "<td>".$row['firstname']." ".$row['lastname']."</td>";
                echo "<td>".$row['reservationdate']."</td>";
                echo "<td>".$row['starttime']."</td>";
                echo "<td>".$row['endtime']."</td>";
                echo "<td>".$row['purpose']."</td>";
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