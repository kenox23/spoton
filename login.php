<?php    
    include 'connect.php'; 
    require_once 'includes/header.php'; 
?>

<div>
	<form method="post">
		<pre>			
			Username:<input type="text" name="txtusername">	
			Password:<input type="password" name="txtpassword">				
			
			<input type="submit" name="btnLogin" value="Login"> 
		</pre>
	</form>
</div>


<?php	
	if(isset($_POST['btnLogin'])){
		$uname=$_POST['txtusername'];
		$pwd=$_POST['txtpassword'];
		
		//check tbluser if username is existing
		$sql ="Select * from tbluser where username='".$uname."'";
		
		$result = mysqli_query($connection,$sql);	
		
		$count = mysqli_num_rows($result);
		$row = mysqli_fetch_array($result);
		
		if($count== 0){
			echo "<script language='javascript'>
						alert('username not existing.');
				  </script>";
				  
		//}else if($row[3] != $pwd) {		
		// since we hashed the password during registration, we need to use password_verify to compare the entered password with the hashed password in database
		}else if(!password_verify($pwd,$row['password'])){
			echo "<script language='javascript'>
				alert('Incorrect password');
			     </script>";
		}else {		
			$_SESSION['username']=$row[0];
			header("location: dashboard.php");
		}
			
		
	}
		

?>

<?php require_once 'includes/footer.php'; ?>