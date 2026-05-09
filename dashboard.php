<?php
include 'connect.php';

// Query to get student information from both tables using traditional method (no JOIN)
$query = "SELECT * FROM tbluser, tblstudent WHERE tbluser.userid = tblstudent.studentid";
$resultset = mysqli_query($connection, $query);

// Check if query was successful
if (!$resultset) {
    die("Query failed: " . mysqli_error($connection));
}
?>

<?php
if(isset($_POST['btnRegister'])){

    $fname = $_POST['txtfirstname'];
    $lname = $_POST['txtlastname'];
    $mname = $_POST['txtmiddlename'];

    $username = strtolower($fname . $lname);
    $password = password_hash($_POST['txtpassword'], PASSWORD_DEFAULT);

    // INSERT INTO tbluser - FIXED: changed 'middleinitial' to 'middlename'
    $sql1 = "INSERT INTO tbluser (firstname, lastname, middlename, username, password, role)
             VALUES ('$fname', '$lname', '$mname', '$username', '$password', 'student')";
    
    if(mysqli_query($connection, $sql1)){
        // GET LAST INSERTED USER ID
        $userid = mysqli_insert_id($connection);

        $sql2 = "INSERT INTO tblstudent (studentid, yearlevel, program)
                 VALUES ('$userid', '1', 'BSIT')";
        
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
    <input type="text" name="txtfirstname" required><br><br>
    
    Middlename:
    <input type="text" name="txtmiddlename"><br><br>
    
    Lastname:
    <input type="text" name="txtlastname" required><br><br>
    
    Password:
    <input type="password" name="txtpassword" required><br><br>
    
    <input type="submit" name="btnRegister" value="Register">
</form>

<h2>List of Students</h2>

<table border="1" cellpadding="10">
    <tr>
        <th>ID Number</th>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Middlename</th>
        <th>Year Level</th>
        <th>Program</th>
        <th>Actions</th>
    </tr>

    <?php 
    // Check if there are results
    if(mysqli_num_rows($resultset) > 0) {
        while($row = mysqli_fetch_assoc($resultset)) { 
    ?>
    <tr>
        <td><?php echo $row['userid']; ?></td>
        <td><?php echo $row['firstname']; ?></td>
        <td><?php echo $row['lastname']; ?></td>
        <td><?php echo $row['middlename']; ?> <!-- FIXED: changed from 'middleinitial' to 'middlename' --></td>
        <td><?php echo $row['yearlevel']; ?></td>
        <td><?php echo $row['program']; ?></td>
        <td>
            <a href="update.php?id=<?php echo $row['userid']; ?>">UPDATE</a> |
            <a href="delete.php?id=<?php echo $row['userid']; ?>" onclick="return confirm('Are you sure you want to delete this student?')">DELETE</a>
        </td>
    </tr>
    <?php 
        } 
    } else {
        echo "<tr><td colspan='7' align='center'>No students found</td></tr>";
    }
    ?>
</table>
