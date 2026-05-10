<?php
    session_start();
    include 'connect.php';
    require_once 'includes/header.php';
    
    if(!isset($_SESSION['userid']) || $_SESSION['role'] != 'admin'){
        echo "<script language='javascript'>
                alert('Access denied. Admins only.');
                window.location.href = 'index.php';
              </script>";
              exit();
    }

    if(isset($_GET['id'])){
        $id = (int)$_GET['id'];
        $sql = "select * from tbluser, tblstudent where tbluser.userid = tblstudent.studentid and tbluser.userid='$id'";
        $result = mysqli_query($connection, $sql);
        $row = mysqli_fetch_array($result);
    } else {
        echo "<script language='javascript'>
                alert('No ID specified.');
                window.location.href = 'dashboard.php';
              </script>";
              exit();
    }

    if(isset($_POST['btnUpdate'])){
        $id = (int)$_GET['id'];
        $username = $_POST['txtusername'];
        $program = $_POST['txtprogram'];
        $yearlevel = $_POST['txtyearlevel'];

        $sql1 = "update tbluser set username='$username' where userid='$id'";
        $sql2 = "update tblstudent set program='$program', yearlevel='$yearlevel' where studentid='$id'";

        if(mysqli_query($connection, $sql1) && mysqli_query($connection, $sql2)){
            echo "<script language='javascript'>
                    alert('Record updated successfully.');
                    window.location.href = 'dashboard.php';
                  </script>";
        } else {
            echo "<script language='javascript'>
                    alert('Error updating record: " . mysqli_error($connection) . "');
                    window.location.href = 'dashboard.php';
                  </script>";
        }
    }
?>

<div>
    <h2>Update Student Record</h2>
    <p>Updating record for: <?php echo $row['username']; ?></p>
    <form method="post">
        <pre>			
            Username:<input type="text" name="txtusername" value="<?php echo $row['username']; ?>">	
            
            Program:
            <select name="txtprogram">
            <option value="">----</option>
             <option value="BSIT" <?php if($row['program'] == 'BSIT') echo 'selected'; ?>>BSIT</option>
             <option value="BSCS" <?php if($row['program'] == 'BSCS') echo 'selected'; ?>>BSCS</option>
            </select>
            
            Year Level:
            <select name="txtyearlevel">
            <option value="">----</option>
            <option value="1" <?php if($row['yearlevel'] == '1') echo 'selected'; ?>>1</option>
            <option value="2" <?php if($row['yearlevel'] == '2') echo 'selected'; ?>>2</option>
            <option value="3" <?php if($row['yearlevel'] == '3') echo 'selected'; ?>>3</option>
            <option value="4" <?php if($row['yearlevel'] == '4') echo 'selected'; ?>>4</option>
            </select>
                                    
            
            <input type="submit" name="btnUpdate" value="Update"> 
        </pre>
    </form>
</div>

<a href="dashboard.php">Back to Dashboard</a>

<?php require_once 'includes/footer.php'; ?>
