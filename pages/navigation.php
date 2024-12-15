
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <?php
        $active_page = basename($_SERVER['PHP_SELF']);;
    ?>  

    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid d-flex">
            <a class="navbar-brand fs-3 fw-bold" href="../index.php">
                <!-- <img src="../images/logo.png" alt="" style="height: 42px;" class="d-inline-block align-text-bottom me-1"> -->
                Job Seeker
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse d-lg-flex justify-content-between p-3" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link fs-5 fw-semibold <?php echo $active_page === 'explore_jobs.php' ? 'active'  : '' ; ?> "  href="#">Explore Jobs</a>
                    <a class="nav-link fs-5 fw-semibold <?php echo $active_page === 'about_us.php' ? 'active'  : '' ; ?> " href="#">About Us</a>
                    <a class="nav-link fs-5 fw-semibold <?php echo $active_page === 'our_services.php' ? 'active'  : '' ; ?> " href="#">Our Services</a>
                </div>
                <hr>

                <?php
                    if(isset($_SESSION['logged_in'])){
                        echo('
                                <div class="navbar-nav">
                                    <a href="pages/employee_profile.php"> <img src="../images/user.png" alt="" style="height:42px; cursor:pointer;"> </a>
                                </div>
                            ');
                    }
                    else{
                        echo('
                                <div class="navbar-nav grid gap-3">
                                    <a href="pages/employee_login.php" type="button" class="btn btn-primary fs-5 fw-semibold" style="border:none;"  >
                                        Log In
                                    </a>
                                    <a href="pages/employee_register.php" type="button" class="btn btn-success fs-5 fw-semibold">
                                        Register
                                    </a>
                                </div>
                            ');
                    }
                ?>

            </div>
        </div>
    </nav>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>