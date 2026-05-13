<?php
session_start();
include 'connect.php';
require_once 'includes/header.php';

if(!isset($_SESSION['userid'])){
    header("location: login.php");
    exit();
}

$userid = $_SESSION['userid'];

if(isset($_POST['btnChange'])){

    $oldpass = $_POST['txtold'];
    $newpass = $_POST['txtnew'];
    $confirmpass = $_POST['txtconfirm'];

    if($newpass != $confirmpass){
        echo "<script>alert('New passwords do not match.');</script>";
    } else {

        $sql = "select password from tbluser where userid='$userid'";
        $result = mysqli_query($connection, $sql);
        $row = mysqli_fetch_array($result);

        if(!password_verify($oldpass, $row['password'])){
            echo "<script>alert('Old password is incorrect.');</script>";
        } else {

            $hashed = password_hash($newpass, PASSWORD_DEFAULT);

            $update = "update tbluser set password='$hashed' where userid='$userid'";

            if(mysqli_query($connection, $update)){
                echo "<script>
                        alert('Password changed successfully.');
                        window.location.href='profile.php';
                    </script>";
            } else {
                echo "<script>alert('Error updating password.');</script>";
            }
        }
    }
}
?>

<div class="container mt-5" style="max-width:500px;">

    <div class="sis-page-header mb-4">
        <h3 class="mb-1">Change Password</h3>
        <small class="text-muted">Update your account password</small>
    </div>

    <div class="sis-card p-4">

        <form method="post">

            <div class="form-group">
                <label>Old Password</label>
                <input type="password" name="txtold" class="form-control" required>
            </div>

            <div class="form-group">
                <label>New Password</label>
                <input type="password" name="txtnew" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="txtconfirm" class="form-control" required>
            </div>

            <button type="submit" name="btnChange" class="btn btn-sis btn-block">
                Update Password
            </button>

            <a href="profile.php" class="btn btn-secondary btn-block mt-2">
                Back
            </a>

        </form>

    </div>

</div>

<?php require_once 'includes/footer.php'; ?>