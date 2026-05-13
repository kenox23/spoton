<?php    
include 'connect.php'; 
require_once 'includes/header2.php'; 
?>

<div style="background-color:#8a252c; height:10px; width:100%;"></div>

<div class="container-fluid p-0 position-relative">

    <img src="images/library2.png"
         class="img-fluid w-100"
         style="height:350px; object-fit:cover;">

    <div style="
        position:absolute;
        top:0;
        left:0;
        width:100%;
        height:100%;
        background:rgba(0,0,0,0.45);
    "></div>

    <div class="position-absolute text-white"
         style="top:50%; left:50%; transform:translate(-50%, -50%); width:100%;">

        <div class="container text-center">

            <h1 class="font-weight-bold mb-3">
                Contact 
                <span style="
                    color:#8a252c;
                    text-shadow:
                        0 1px 2px rgba(255,255,255,0.9),
                        0 -1px 2px rgba(255,255,255,0.9),
                        1px 0 2px rgba(255,255,255,0.9),
                        -1px 0 2px rgba(255,255,255,0.9);
                ">
                    Us
                </span>
            </h1>

            <p class="lead mb-0">
                Send your questions, suggestions, or feedback
            </p>

        </div>

    </div>

</div>

<div class="container my-5" style="max-width:700px;">

    <div class="sis-card p-4 p-md-5">

        <h3 class="font-weight-bold mb-4">Get in Touch</h3>

        <?php
        if(isset($_POST['btnSend'])){

            $firstname = $_POST['first_name'];
            $lastname = $_POST['last_name'];
            $email = $_POST['email'];
            $message = $_POST['message'];

            $sql = "insert into tblcontact(firstname, lastname, email, message)
                    values('$firstname', '$lastname', '$email', '$message')";

            mysqli_query($connection, $sql);

            echo "<div class='alert alert-success'>message sent successfully</div>";
        }
        ?>

        <form method="post">

            <div class="form-row">

                <div class="form-group col-md-6">
                    <label>First Name</label>
                    <input type="text" name="first_name" class="form-control" required>
                </div>

                <div class="form-group col-md-6">
                    <label>Last Name</label>
                    <input type="text" name="last_name" class="form-control" required>
                </div>

            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Message</label>
                <textarea name="message" rows="5" class="form-control" required></textarea>
            </div>

            <button type="submit" name="btnSend" class="btn btn-sis btn-block">
                Send Message
            </button>

        </form>

    </div>

</div>

<?php require_once 'includes/footer.php'; ?>