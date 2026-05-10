
<?php
    session_start();
    include 'connect.php';
    include 'readrecords.php';   
    require_once 'includes/header.php'; 

    // Check if the user is logged in, if not redirect to login page
    if(!isset($_SESSION['userid'])){
        header("location: login.php");
        exit();
    }

    if(isset($_POST['btnReserve'])){
        $studentid = $_SESSION['userid'];
        $date = $_POST['date'];
        $start = $_POST['starttime'];
        $end = $_POST['endtime'];
        $purpose = $_POST['purpose'];

        $sql = "insert into tblreservation
                (studentid, reservationdate, starttime, endtime, purpose, status)
                values
                ('$studentid', '$date', '$start', '$end', '$purpose', 'pending')";

        mysqli_query($connection, $sql);

        echo "<script>
            alert('Reservation submitted successfully!');
            window.location.href='reservations.php';
        </script>";
    }
?>

<div>
    <h2>Make a Reservation</h2>

    <form method="post">

        Date:
        <input type="date" name="date" required><br><br>

        Start Time:
        <input type="time" name="starttime" required><br><br>

        End Time:
        <input type="time" name="endtime" required><br><br>

        Purpose:
        <input type="text" name="purpose" required><br><br>

        <input type="submit" name="btnReserve" value="Submit">
    </form>
</div>

<?php require_once 'includes/footer.php'; ?>