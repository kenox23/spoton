<?php
include 'connect.php';
include 'readrecords.php';
?>

<?php
if(isset($_POST['btnRegister'])){

    $fname = $_POST['txtfirstname'];
    $lname = $_POST['txtlastname'];
    $mname = $_POST['txtmiddlename'];

    $username = strtolower($fname . $lname);
    $password = password_hash($_POST['txtpassword'], PASSWORD_DEFAULT);

    // INSERT INTO tbluser
    $sql1 = "INSERT INTO tbluser (firstname, lastname, middleinitial, username, password)
             VALUES ('$fname', '$lname', '$mname', '$username', '$password')";
    
    if(mysqli_query($connection, $sql1)){
        // GET LAST INSERTED USER ID
        $userid = mysqli_insert_id($connection);

        // INSERT INTO tblstudent
        $sql2 = "INSERT INTO tblstudent (studentid, yearlevel, enrollmentstatus, departmentid)
                 VALUES ('$userid', '1', 'Active', '1')";
        
        if(mysqli_query($connection, $sql2)){
            echo "<script>
                    alert('Student Registered Successfully');
                    window.location='dashboard.php';
                  </script>";
        } else {
            echo "Error in tblstudent insert: " . mysqli_error($connection);
        }
    } else {
        echo "Error in tbluser insert: " . mysqli_error($connection);
    }
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

<h2>List of Students</h2>

<table border="1" cellpadding="10">
    <tr>
        <th>ID Number</th>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Middlename</th>
        <th>Actions</th>
    </tr>

    <?php while($row = mysqli_fetch_assoc($resultset)) { ?>
    <tr>
        <td><?php echo $row['userid']; ?></td>
        <td><?php echo $row['firstname']; ?></td>
        <td><?php echo $row['lastname']; ?></td>
        <td><?php echo $row['middleinitial']; ?></td>
        <td>
            <a href="update.php?id=<?php echo $row['userid']; ?>">UPDATE</a> |
            <a href="delete.php?id=<?php echo $row['userid']; ?>">DELETE</a>
        </td>
    </tr>
    <?php } ?>
</table>
