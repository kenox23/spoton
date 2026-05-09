<?php    
    include 'connect.php';    
    require_once 'includes/header.php'; 
?>

<div style='background-color:#8a353c'>
    <center>
        <p style="color:white"><h2>User Registration Page</h2></p>
    </center>
</div>  

<div>
	<form method="post">
		<pre>
			Firstname:<input type="text" name="txtfirstname">
			Middlename:<input type="text" name="txtmiddlename">
			Lastname:<input type="text" name="txtlastname">	
			Username:  <input type="text" name="txtusername">
			Password:  <input type="password" name="txtpassword">
			Confirm Password: <input type="password" name="txtconfirmpassword">
			Birthdate: <input type="text" name="txtbirthdate">
			Gender:
			<select name="txtgender">
			 <option value="gender">Gender</option>
			 <option value="Male">Male</option>
			 <option value="Female">Female</option>
			 <option value="Other">Other</option>
			</select>
			Contact Number: <input type="text" name="txtcontactnumber">
			Street Address: <input type="text" name="txtstreetaddress">
			City: <input type ="text" name="txtcity"> Province : <input type="text" name ="txtprovince">
			ZIP Code: <input type="text" name="txtzipcode">
			<input type="submit" name="btnRegister" value="Register"> 
		</pre>
	</form>
</div>

<?php	
	if(isset($_POST['btnRegister'])){		
		//retrieve data from form and save the value to a variable
		//for tblstudent
		$fname = $_POST['txtfirstname'];		
		$lname = $_POST['txtlastname'];
		$mname = $_POST['txtmiddlename'];
		
		// strtolower to convert the username to lowercase before saving to database to avoid case sensitivity issues during login
		$username = strtolower($fname.$lname);
		// hash the password before saving to database
		$password = password_hash($_POST['txtpassword'], PASSWORD_DEFAULT);
			
						
		// save data to tbluser
		$sql1 ="Insert into tbluser(firstname,lastname,username,password,role) values('".$fname."','".$lname."','".$mname"','".$password."','student')";
		mysqli_query($connection,$sql1);

		$userid = mysqli_insert_id($connection);
		
		// save data to tblstudent
		$sql2 ="insert into tblstudent(studentid,program,yearlevel)
        values('".$userid."','".$program."','".$yearlevel."')";
		mysqli_query($connection,$sql2);

		echo "<script language='javascript'>
			alert('New record saved.');
		      </script>";
		header("location: dashboard.php");
		
			
		
	}
		

?>


<?php require_once 'includes/footer.php'; ?>
