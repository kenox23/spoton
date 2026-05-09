<?php
include 'connect.php';

if(isset($_POST['btnRegister'])){

    $fname = $_POST['txtfirstname'];
    $lname = $_POST['txtlastname'];
    $mname = $_POST['txtmiddlename'];

    $username = strtolower($fname.$lname);

    $password = password_hash($_POST['txtpassword'], PASSWORD_DEFAULT);

    // INSERT INTO tbluser
    $sql1 = "INSERT INTO tbluser
    (firstname, lastname, middleinitial, username, password)

    VALUES
    ('$fname','$lname','$mname','$username','$password')";

    mysqli_query($connection, $sql1);

    // GET LAST INSERTED USER ID
    $userid = mysqli_insert_id($connection);

    // INSERT INTO tblstudent
    $sql2 = "INSERT INTO tblstudent
    (studentid, yearlevel, enrollmentstatus, departmentid)

    VALUES
    ('$userid','1','Active','1')";

    mysqli_query($connection, $sql2);

    echo "<script>
            alert('Student Registered Successfully');
            window.location='dashboard.php';
          </script>";
}
?>

<form method="POST">

    Firstname:
    <input type="text" name="txtfirstname"><br><br>

    Middlename:
    <input type="text" name="txtmiddlename"><br><br>

    Lastname:
    <input type="text" name="txtlastname"><br><br>

    Password:
    <input type="password" name="txtpassword"><br><br>

    <input type="submit" name="btnRegister" value="Register">

</form>
