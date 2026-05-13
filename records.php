<?php
session_start();
include 'connect.php';
require_once 'includes/header.php';

if(!isset($_SESSION['userid'])){
    header("location: login.php");
    exit();
}

$userid = $_SESSION['userid'];

$sql = "select * from tblreservation where studentid='$userid'";
$result = mysqli_query($connection, $sql);
?>

<div style="background-color:#8a252c; height:10px; width:100%;"></div>

<div class="container mt-4">

    <div class="sis-page-header mb-4">
        <h3 class="mb-1">Records</h3>
    </div>

    <div class="sis-card p-3">

        <table class="table table-bordered table-sm">

            <tr>
                <th>id</th>
                <th>date</th>
                <th>start</th>
                <th>end</th>
                <th>purpose</th>
                <th>waiting area</th>
                <th>status</th>
            </tr>

            <?php
            while($row = mysqli_fetch_array($result)){

                $waitingareaid = $row['waitingareaid'];
                $sql2 = "select * from tblwaitingarea where waitingareaid='$waitingareaid'";
                $result2 = mysqli_query($connection, $sql2);
                $waitingarea = mysqli_fetch_assoc($result2);

                $date = date("F d, Y", strtotime($row['reservationdate']));
                $start = date("h:i A", strtotime($row['starttime']));
                $end = date("h:i A", strtotime($row['endtime']));
                $status = strtolower($row['status']);

                echo "<tr>";
                echo "<td>".$row['reservationid']."</td>";
                echo "<td>".$date."</td>";
                echo "<td>".$start."</td>";
                echo "<td>".$end."</td>";
                echo "<td>".$row['purpose']."</td>";
                echo "<td>".$waitingarea['areaname']."</td>";
                echo "<td><span class='status-".$status."'>".$status."</span></td>";
                echo "</tr>";
            }
            ?>

        </table>

    </div>

</div>

<?php require_once 'includes/footer.php'; ?>