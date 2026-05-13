<?php
require_once 'includes/header2.php';
?>

<div style="background-color:#8a252c; height:10px; width:100%;"></div>

<div class="container-fluid p-0 position-relative">

    <img src="images/library.png"
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
                About 
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

            <p class="lead mb-0">
                Find the perfect study spot anytime on campus
            </p>

        </div>

    </div>

</div>

<div class="container my-5" style="max-width:900px;">

    <div class="sis-card p-4 p-md-5" style="border:none;">

        <h3 class="font-weight-bold mb-4">
            What is SpotON?
        </h3>

        <p>
            SpotON is a web application designed to help students of
            Cebu Institute of Technology – University (CITU) easily locate
            available and comfortable study spaces within the campus.
        </p>

        <p>
            Whether students need a quiet place to focus, a collaborative
            area for group work, or a convenient spot between classes,
            SpotON makes it easier to discover study environments that
            match their needs.
        </p>

        <p>
            The platform was created to improve accessibility to study
            spaces and help students become more productive by saving
            time and reducing the difficulty of finding available areas.
        </p>

        <div class="mt-4 p-4"
                 style="
                     background:#f8f9fa;
                     border-left:5px solid #8a252c;
                     border-radius:10px;
                 ">

            <h5 class="font-weight-bold mb-2">
                Our Goal
            </h5>

            <p class="mb-0">
                To improve the overall study experience at CITU by helping
                students quickly find suitable study environments around campus.
            </p>

        </div>

    </div>

</div>

<?php include 'includes/footer.php'; ?> 