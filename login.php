<?php    
session_start();
include 'connect.php'; 
require_once 'includes/header2.php'; 
?>

<div style="background-color:#8a252c; height:10px; width:100%;"></div>

<div class="container my-5" style="max-width:400px;">

    <h3 class="text-center mb-4">Login</h3>

    <div class="sis-card p-4">

        <form method="post">

            <div class="form-group">
                <label>Username</label>
                <input type="text" name="txtusername" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="txtpassword" class="form-control" required>
            </div>

            <button type="submit" name="btnLogin" class="btn btn-sis btn-block">
                Login
            </button>

        </form>

    </div>

</div>


<?php	
	if(isset($_POST['btnLogin'])){
		$uname=$_POST['txtusername'];
		$pwd=$_POST['txtpassword'];
		

		$sql ="Select * from tbluser where username='".$uname."'";
		
		$result = mysqli_query($connection,$sql);	
		
		$count = mysqli_num_rows($result);
		$row = mysqli_fetch_array($result);
		
		if($count== 0){
			echo "<script language='javascript'>
						alert('username not existing.');
				  </script>";
				  


		}else if(!password_verify($pwd,$row['password'])){
			echo "<script language='javascript'>
				alert('Incorrect password');
			     </script>";
		}else {		
			$_SESSION['userid']=$row['userid'];
			$_SESSION['username']=$row['username'];
			$_SESSION['role']=$row['role'];

			$_SESSION['firstname']=$row['firstname'];
			$_SESSION['middlename']=$row['middlename'];
			$_SESSION['lastname']=$row['lastname'];
			header("location: dashboard.php");
			exit();
		}
			
		
	}
		

?>

<?php require_once 'includes/footer.php'; ?>