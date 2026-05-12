<?php    
include 'connect.php'; 
require_once 'includes/header.php'; 
?>

<div class="container" style="max-width:600px; margin:40px auto;">
    <h2>Contact Us</h2>

    <form method="POST" action="contact.php">

        <div style="display:flex; gap:10px;">
            <div style="flex:1;">
                <label>First Name</label>
                <input type="text" name="first_name" required style="width:100%; padding:8px;" placeholder="Firstname">
            </div>

            <div style="flex:1;">
                <label>Last Name</label>
                <input type="text" name="last_name" required style="width:100%; padding:8px;" placeholder = "Lastname">
            </div>
        </div>

        <br>

        <label>Email</label>
        <input type="email" name="email" required style="width:100%; padding:8px;" placeholder = "juandelacruz.@gmail.com"><br><br>

        <label>Message</label>
        <textarea name="message" rows="5" required style="width:100%; padding:8px;" placeholder = "Send us your recommendations or inquiry..."></textarea><br><br>

        <button type="submit" style="padding:10px 20px; background-color:#8a353c; color:#fff; border:none; cursor:pointer;">
            Send Message
        </button>
    </form>


    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $firstname = htmlspecialchars($_POST['first_name']);
        $lastname  = htmlspecialchars($_POST['last_name']);
        $email     = htmlspecialchars($_POST['email']);
        $message   = htmlspecialchars($_POST['message']);

        $fullname = $firstname . " " . $lastname;

        echo "<p style='color:green; margin-top:20px;'>thank you, $fullname! your message has been sent.</p>";
    }
    ?>  
</div>


<?php require_once 'includes/footer.php'; ?>