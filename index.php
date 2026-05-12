<?php    
    include 'connect.php';    
    require_once 'includes/header2.php'; 
?>

<div style="background-color:#8a252c; height:10px; width:100%;"></div>

<div class="container-fluid p-0 position-relative">
    <img src="images/glebuilding.png" alt="GLE Building"
         class="img-fluid w-100"
         style="max-height:500px; object-fit:cover;">

    <div style="
        position:absolute;
        top:0;
        left:0;
        width:100%;
        height:100%;
        background:rgba(0,0,0,0.4);
    "></div>

    <div class="position-absolute text-center text-white"
        style="top:50%; left:50%; transform:translate(-50%, -50%);">

        <h1 class="display-4 font-weight-bold">
            Welcome to 
            <span style="
                color:#8a252c;
                text-shadow:
                    0 1px 2px rgba(255,255,255,0.9),
                    0 -1px 2px rgba(255,255,255,0.9),
                    1px 0 2px rgba(255,255,255,0.9),
                    -1px 0 2px rgba(255,255,255,0.9);
            ">
                SpotON
            </span>
        </h1>

        <p class="lead">Find a spot easily and reserve in seconds</p>

        <a href="login.php" class="btn btn-sis btn-lg mt-2">
            Get Started
        </a>

    </div>
</div>
<?php require_once 'includes/footer.php'; ?>    