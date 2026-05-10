<?php    
    include 'connect.php';    
    require_once 'includes/header.php'; 
?>

<div style='background-color:#ffff00'>
    <center>
        <p style="color:white"><h2>User Registration Page</h2></p>
    </center>
</div>  

<div>
	<form method="post">
		<pre>
			Firstname:<input type="text" name="txtfirstname">
			Middle Name:<input type="text" name="txtmiddlename">
			Lastname:<input type="text" name="txtlastname">	
			Username:<input type="text" name="txtusername">
			Password:<input type="password" name="txtpassword">		
			Program:
			<select name="txtprogram">
			 <option value="">----</option>
			 <option value="BSCS">BSCS</option>
			 <option value="BSIT">BSIT</option>
			</select>
			
			Year Level:
			<select name="txtyearlevel">
			<option value="">----</option>
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			</select>
									
			
			<input type="submit" name="btnRegister" value="Register"> 
		</pre>
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

		echo "<script language='javascript'>
			alert('New record saved.');
		      </script>";
		header("location: dashboard.php");
		
			
		
	}
		

?>


<?php require_once 'includes/footer.php'; ?>