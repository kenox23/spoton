<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/site.css">

    <title>SIS - <?php echo $title ?></title>
</head>

<body>

<div class="container">

<nav class="navbar navbar-expand-lg navbar-light bg-light">

    <a class="navbar-brand" href="dashboard.php">
        <img src="images/logospoton.png" width="50" height="40">
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <ul class="navbar-nav mr-auto">


            <li class="nav-item">
                <a class="nav-link" href="dashboard.php">Dashboard</a>
            </li>

            <?php if($_SESSION['role'] == 'admin'){ ?>


                <li class="nav-item">
                    <a class="nav-link" href="manage_students.php">Students</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="registration.php">Register</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="reports.php">Reports</a>
                </li>

            <?php } else { ?>


                <li class="nav-item">
                    <a class="nav-link" href="profile.php">Profile</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="records.php">Records</a>
                </li>

            <?php } ?>

        </ul>


        <div class="form-inline">
            <a href="logout.php" class="btn btn-danger btn-sm">
                Logout
            </a>
        </div>

    </div>

</nav>