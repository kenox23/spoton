<?php
session_start();
include 'connect.php';
require_once 'includes/header2.php';
?>

<div style="background-color:#8a252c; height:10px; width:100%;"></div>

<div class="container my-5" style="max-width:600px;">

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

                <option value="" disabled selected hidden>Select Program</option>

                <optgroup label="Engineering & Architecture">
                    <option value="BSARCH">BS Architecture</option>
                    <option value="BSCHE">BS Chemical Engineering</option>
                    <option value="BSCE">BS Civil Engineering</option>
                    <option value="BSCpE">BS Computer Engineering</option>
                    <option value="BSEE">BS Electrical Engineering</option>
                    <option value="BSECE">BS Electronics Engineering</option>
                    <option value="BSIE">BS Industrial Engineering</option>
                    <option value="BSME">BS Mechanical Engineering</option>
                    <option value="BSME-CS">BS Mechanical Engineering (Computational Science)</option>
                    <option value="BSME-MECH">BS Mechanical Engineering (Mechatronics)</option>
                    <option value="BSMINING">BS Mining Engineering</option>
                </optgroup>

                <optgroup label="Management, Business & Accountancy">
                    <option value="BSA">BS Accountancy</option>
                    <option value="BSAIS">BS Accounting Information Systems</option>
                    <option value="BSMA">BS Management Accounting</option>
                    <option value="BSBA">BS Business Administration</option>
                    <option value="BSBA-BFM">Banking & Financial Management</option>
                    <option value="BSBA-BUSAN">Business Analytics</option>
                    <option value="BSBA-GEN">General Business Management</option>
                    <option value="BSBA-HRM">Human Resource Management</option>
                    <option value="BSBA-MKTG">Marketing Management</option>
                    <option value="BSBA-OPS">Operations Management</option>
                    <option value="BSBA-QM">Quality Management</option>
                    <option value="BSHM">BS Hospitality Management</option>
                    <option value="BSTM">BS Tourism Management</option>
                    <option value="BSOA">BS Office Administration</option>
                    <option value="ABPA">Bachelor in Public Administration</option>
                </optgroup>

                <optgroup label="Arts, Sciences & Education">
                    <option value="ABCOMM">AB Communication</option>
                    <option value="ABENG">AB English (Applied Linguistics)</option>
                    <option value="BEED">Bachelor of Elementary Education</option>
                    <option value="BSED">Bachelor of Secondary Education</option>
                    <option value="BMM">Bachelor of Multimedia Arts</option>
                    <option value="BSBIO">BS Biology</option>
                    <option value="BSMATH">BS Mathematics (Applied Industrial Mathematics)</option>
                    <option value="BSPSYCH">BS Psychology</option>
                    <option value="BSN-SEN">Bachelor of Special Needs Education</option>
                </optgroup>

                <optgroup label="Nursing & Allied Health Sciences">
                    <option value="BSN">BS Nursing</option>
                    <option value="BSPHARMA">BS Pharmacy</option>
                    <option value="BSMT">BS Medical Technology</option>
                </optgroup>

                <optgroup label="Computer Studies">
                    <option value="BSCS">BS Computer Science</option>
                    <option value="BSIT">BS Information Technology</option>
                </optgroup>

                <optgroup label="Criminal Justice">
                    <option value="BSCRIM">BS Criminology</option>
                </optgroup>

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

    $fname = $_POST['txtfirstname'];
    $mname = $_POST['txtmiddlename'];
    $lname = $_POST['txtlastname'];
    $program = $_POST['txtprogram'];
    $yearlevel = $_POST['txtyearlevel'];

    $username = strtolower($_POST['txtusername']);
    $password = password_hash($_POST['txtpassword'], PASSWORD_DEFAULT);

    $sql = "insert into tbluser(firstname,middlename,lastname,username,password,role)
            values('$fname','$mname','$lname','$username','$password','student')";
    mysqli_query($connection, $sql);

    $userid = mysqli_insert_id($connection);

    $sql2 = "insert into tblstudent(studentid,program,yearlevel)
            values('$userid','$program','$yearlevel')";
    mysqli_query($connection, $sql2);

    $_SESSION['userid'] = $userid;
    $_SESSION['username'] = $username;
    $_SESSION['role'] = 'student';

    echo "<script>
        alert('registration successful');
        window.location.href='dashboard.php';
    </script>";
}
?>

<?php require_once 'includes/footer.php'; ?>