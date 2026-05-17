<?php
session_start();
include 'connect.php';
require_once 'includes/header.php';

if(!isset($_SESSION['userid']) || $_SESSION['role'] != 'admin'){
    echo "<script>
            alert('Access denied. Admins only.');
            window.location.href = 'index.php';
          </script>";
    exit();
}

if(isset($_GET['id'])){
    $id = (int)$_GET['id'];

        $sqlUser = "select username from tbluser where userid = '$id'";
        $resultUser = mysqli_query($connection, $sqlUser);
        $user = mysqli_fetch_assoc($resultUser);

        $sqlStudent = "select program, yearlevel from tblstudent where studentid = '$id'";
        $resultStudent = mysqli_query($connection, $sqlStudent);
        $student = mysqli_fetch_assoc($resultStudent);

        $row = array_merge((array)$user, (array)$student);

} else {
    echo "<script>
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

    $sql1 = "update tbluser 
             set username='$username' 
             where userid='$id'";

    $sql2 = "update tblstudent 
             set program='$program', yearlevel='$yearlevel' 
             where studentid='$id'";

    if(mysqli_query($connection, $sql1) && mysqli_query($connection, $sql2)){
        echo "<script>
                alert('Record updated successfully.');
                window.location.href = 'dashboard.php';
              </script>";
    } else {
        echo "<script>
                alert('Error updating record.');
                window.location.href = 'dashboard.php';
              </script>";
    }
}
?>

<div class="container mt-5" style="max-width:600px;">

    <h3 class="text-center mb-4">Update Student Record</h3>

    <p class="text-center mb-4">
        Updating record for: <strong><?= htmlspecialchars($row['username']) ?></strong>
    </p>

    <form method="post">


        <div class="form-group">
            <label>Username</label>
            <input type="text"
                   name="txtusername"
                   class="form-control"
                   value="<?= htmlspecialchars($row['username']) ?>"
                   required>
        </div>


        <div class="form-group">
            <label>Program</label>
            <select name="txtprogram" class="form-control" required>

                <option value="" disabled hidden>Select Program</option>

                <optgroup label="Engineering & Architecture">
                    <option value="BSARCH" <?= ($row['program'] == 'BSARCH') ? 'selected' : '' ?>>BS Architecture</option>
                    <option value="BSCHE" <?= ($row['program'] == 'BSCHE') ? 'selected' : '' ?>>BS Chemical Engineering</option>
                    <option value="BSCE" <?= ($row['program'] == 'BSCE') ? 'selected' : '' ?>>BS Civil Engineering</option>
                    <option value="BSCpE" <?= ($row['program'] == 'BSCpE') ? 'selected' : '' ?>>BS Computer Engineering</option>
                    <option value="BSEE" <?= ($row['program'] == 'BSEE') ? 'selected' : '' ?>>BS Electrical Engineering</option>
                    <option value="BSECE" <?= ($row['program'] == 'BSECE') ? 'selected' : '' ?>>BS Electronics Engineering</option>
                    <option value="BSIE" <?= ($row['program'] == 'BSIE') ? 'selected' : '' ?>>BS Industrial Engineering</option>
                    <option value="BSME" <?= ($row['program'] == 'BSME') ? 'selected' : '' ?>>BS Mechanical Engineering</option>
                    <option value="BSME-CS" <?= ($row['program'] == 'BSME-CS') ? 'selected' : '' ?>>BS Mechanical Engineering (Computational Science)</option>
                    <option value="BSME-MECH" <?= ($row['program'] == 'BSME-MECH') ? 'selected' : '' ?>>BS Mechanical Engineering (Mechatronics)</option>
                    <option value="BSMINING" <?= ($row['program'] == 'BSMINING') ? 'selected' : '' ?>>BS Mining Engineering</option>
                </optgroup>

                <optgroup label="Management, Business & Accountancy">
                    <option value="BSA" <?= ($row['program'] == 'BSA') ? 'selected' : '' ?>>BS Accountancy</option>
                    <option value="BSAIS" <?= ($row['program'] == 'BSAIS') ? 'selected' : '' ?>>BS Accounting Information Systems</option>
                    <option value="BSMA" <?= ($row['program'] == 'BSMA') ? 'selected' : '' ?>>BS Management Accounting</option>
                    <option value="BSBA" <?= ($row['program'] == 'BSBA') ? 'selected' : '' ?>>BS Business Administration</option>
                    <option value="BSBA-BFM" <?= ($row['program'] == 'BSBA-BFM') ? 'selected' : '' ?>>Banking & Financial Management</option>
                    <option value="BSBA-BUSAN" <?= ($row['program'] == 'BSBA-BUSAN') ? 'selected' : '' ?>>Business Analytics</option>
                    <option value="BSBA-HRM" <?= ($row['program'] == 'BSBA-HRM') ? 'selected' : '' ?>>Human Resource Management</option>
                    <option value="BSBA-MKTG" <?= ($row['program'] == 'BSBA-MKTG') ? 'selected' : '' ?>>Marketing Management</option>
                    <option value="BSHM" <?= ($row['program'] == 'BSHM') ? 'selected' : '' ?>>BS Hospitality Management</option>
                    <option value="BSTM" <?= ($row['program'] == 'BSTM') ? 'selected' : '' ?>>BS Tourism Management</option>
                    <option value="BSOA" <?= ($row['program'] == 'BSOA') ? 'selected' : '' ?>>BS Office Administration</option>
                    <option value="ABPA" <?= ($row['program'] == 'ABPA') ? 'selected' : '' ?>>Bachelor in Public Administration</option>
                </optgroup>

                <optgroup label="Computer Studies">
                    <option value="BSCS" <?= ($row['program'] == 'BSCS') ? 'selected' : '' ?>>BS Computer Science</option>
                    <option value="BSIT" <?= ($row['program'] == 'BSIT') ? 'selected' : '' ?>>BS Information Technology</option>
                </optgroup>

            </select>
        </div>


        <div class="form-group">
            <label>Year Level</label>
            <select name="txtyearlevel" class="form-control" required>
                <option value="1" <?= ($row['yearlevel'] == '1') ? 'selected' : '' ?>>1</option>
                <option value="2" <?= ($row['yearlevel'] == '2') ? 'selected' : '' ?>>2</option>
                <option value="3" <?= ($row['yearlevel'] == '3') ? 'selected' : '' ?>>3</option>
                <option value="4" <?= ($row['yearlevel'] == '4') ? 'selected' : '' ?>>4</option>
            </select>
        </div>


        <button type="submit" name="btnUpdate" class="btn btn-sis btn-block">
            Update
        </button>

        <a href="dashboard.php" class="btn btn-secondary btn-block mt-2">
            Back to Dashboard
        </a>

    </form>

</div>

<?php require_once 'includes/footer.php'; ?>