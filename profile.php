<?php
session_start();
include 'connect.php';
require_once 'includes/header.php';

if(!isset($_SESSION['userid'])){
    header("location: login.php");
    exit();
}

$userid = $_SESSION['userid'];

$sql1 = "select * from tbluser where userid='$userid'";
$result1 = mysqli_query($connection, $sql1);
$user = mysqli_fetch_array($result1);

$sql2 = "select * from tblstudent where studentid='$userid'";
$result2 = mysqli_query($connection, $sql2);
$student = mysqli_fetch_array($result2);
?>

<div class="container mt-4">

    <div class="sis-page-header mb-4">
        <h3 class="mb-1">Profile</h3>
        <small class="text-muted">Your personal information</small>
    </div>

    <div class="sis-card p-4">

        <div class="row">

            <div class="col-md-6 mb-3">
                <p><b>Name</b><br>
                    <?php echo $user['firstname'] . " " . $user['lastname']; ?>
                </p>
            </div>

            <div class="col-md-6 mb-3">
                <p><b>Username</b><br>
                    <?php echo $user['username']; ?>
                </p>
            </div>

            <div class="col-md-6 mb-3">
                <p><b>Program</b><br>
                    <?php echo $student['program']; ?>
                </p>
            </div>

        </div>

        <div class="mt-3">
            <a href="changepassword.php" class="btn btn-sis">
                Change Password
            </a>
        </div>

    </div>

</div>

<?php require_once 'includes/footer.php'; ?>