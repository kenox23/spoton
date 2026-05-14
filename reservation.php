<?php
session_start();
include 'connect.php';
require_once 'includes/header.php';

if(!isset($_SESSION['userid'])){
    header("location: login.php");
    exit();
}

if(isset($_POST['btnreserve'])){

    $studentid = $_SESSION['userid'];
    $date = $_POST['date'];
    $start = $_POST['starttime'];
    $end = $_POST['endtime'];
    $purpose = $_POST['purpose'];
    $waitingarea = $_POST['waitingarea'];

    $sql = "insert into tblreservation
            (studentid, reservationdate, starttime, endtime, purpose, status, waitingareaid)
            values
            ('$studentid', '$date', '$start', '$end', '$purpose', 'pending', '$waitingarea')";

    mysqli_query($connection, $sql);

    echo "<script>
        alert('reservation submitted successfully');
        window.location.href='dashboard.php';
    </script>";
}
?>

<div style="background-color:#8a252c; height:10px; width:100%;"></div>

<div class="container mt-4">

    <div class="sis-page-header mb-4">
        <h3 class="mb-1">Make Reservation</h3>
    </div>

    <div class="sis-card p-4">

        <form method="post">

            <div class="form-group">
                <label>date</label>
                <input type="date" name="date" class="form-control" required>
            </div>

            <div class="form-group">
                <label>start time</label>
                <input type="time" name="starttime" class="form-control" required>
            </div>

            <div class="form-group">
                <label>end time</label>
                <input type="time" name="endtime" class="form-control" required>
            </div>

            <div class="form-group">
                <label>purpose</label>
                <input type="text" name="purpose" class="form-control" required>
            </div>

            <div class="form-group">
                <label>waiting area</label>
                <select name="waitingarea" class="form-control" required>

                    <?php
                        $sql = "select * from tblwaitingarea";
                        $result = mysqli_query($connection, $sql);

                        while($row = mysqli_fetch_array($result)){
                            echo "<option value='".$row['waitingareaid']."'>".$row['areaname']."</option>";
                        }
                    ?>

                </select>
            </div>

            <button type="submit" name="btnreserve" class="btn btn-sis btn-block">
                submit
            </button>

        </form>

    </div>

</div>

<?php require_once 'includes/footer.php'; ?>