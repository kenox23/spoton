<?php    
	session_start();
    include 'connect.php';    
    require_once 'includes/header.php'; 
?>

<div style="background-color:#8a252c; height:10px; width:100%;"></div>

<div style="background-color:#8a252c; height:10px; width:100%;"></div>

<div class="container mt-5" style="max-width:600px;">

    <h3 class="text-center mb-4">Register</h3>

    <form method="post">

        <div class="form-row">

            <div class="form-group col-md-4">
                <label>First Name</label>
                <input type="text" name="txtfirstname" class="form-control" required>
            </div>

            <div class="form-group col-md-4">
                <label>Middle Name</label>
                <input type="text" name="txtmiddlename" class="form-control">
            </div>

            <div class="form-group col-md-4">
                <label>Last Name</label>
                <input type="text" name="txtlastname" class="form-control" required>
            </div>

        </div>

        <div class="form-group">
            <label>Username</label>
            <input type="text" name="txtusername" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="txtpassword" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Program</label>
            <select name="txtprogram" class="form-control" required>
                <option value="BSCS">BSIT</option>
                <option value="BSIT">BSCS</option>
            </select>
        </div>

        <div class="form-group">
            <label>Year Level</label>
            <select name="txtyearlevel" class="form-control" required>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
            </select>
        </div>

        <button type="submit" name="btnRegister" class="btn btn-sis btn-block">
            Register
        </button>

    </form>

</div>


<?php	
	if(isset($_POST['btnRegister'])){		
		//retrieve data from form and save the value to a variable
		//for tblstudent
		$fname = $_POST['txtfirstname'];		
		$mname = $_POST['txtmiddlename'];
		$lname = $_POST['txtlastname'];
		$program = $_POST['txtprogram'];
		$yearlevel = $_POST['txtyearlevel'];
		// strtolower to convert the username to lowercase before saving to database to avoid case sensitivity issues during login
		$username = strtolower($_POST['txtusername']);
		// hash the password before saving to database
		$password = password_hash($_POST['txtpassword'], PASSWORD_DEFAULT);
			
						
		// save data to tbluser
		$sql1 ="Insert into tbluser(firstname,middlename,lastname,username,password,role) values('".$fname."','".$mname."','".$lname."','".$username."','".$password."','student')";
		mysqli_query($connection,$sql1);

		$userid = mysqli_insert_id($connection);
		
		// save data to tblstudent
		$sql2 ="insert into tblstudent(studentid,program,yearlevel)
        values('".$userid."','".$program."','".$yearlevel."')";
		mysqli_query($connection,$sql2);

		$_SESSION['userid'] = $userid;
		$_SESSION['username'] = $username;
		$_SESSION['role'] = 'student';

		echo "<script language='javascript'>
				alert('Registration successful. You are now logged in.');
				window.location.href = 'dashboard.php';
			  </script>";
		exit();		
	}
?>

<?php require_once 'includes/footer.php'; ?>