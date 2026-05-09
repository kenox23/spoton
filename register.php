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
			Lastname:<input type="text" name="txtlastname">			
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
		$fname=$_POST['txtfirstname'];		
		$lname=$_POST['txtlastname'];
		$program=$_POST['txtprogram'];
		$yearlevel=$_POST['txtyearlevel'];
			
						
		//save data to tblstudent		
		$sql1 ="Insert into tblstudent(firstname,lastname,program,yearlevel) values('".$fname."','".$lname."','".$program."',".$yearlevel.")";
		mysqli_query($connection,$sql1);
		
		
		echo "<script language='javascript'>
			alert('New record saved.');
		      </script>";
		header("location: dashboard.php");
		
			
		
	}
		

?>


<?php require_once 'includes/footer.php'; ?>