<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee| Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div class="container">
        <div class="user-form">
        <h1 class="text-center fw-bold mb-5">Login Now!</h1>
        <?php if(isset($_SESSION['errors']['database'])): ?>
        <p class="text-danger">
            <?= $_SESSION['errors']['database'] ?>
        </p>
        <?php
            unset($_SESSION['errors']);
            endif; 
        ?>
            <form action="backend/employee_login_process.php" method="post">
                <?php
                    if(isset($_SESSION['errors']['email'])):
                ?>
                <p class="text-danger fw-semibold">
                    <?= $_SESSION['errors']['email'] ?>
                </p>
                <?php
                    unset($_SESSION['errors']);
                    endif;
                ?>
                <div class="form-floating mb-5">
                    <input type="text" class="form-control" id="useremail" name="useremail" placeholder="Useremail">
                    <label for="useremail">User Email</label>
                </div>
                <?php
                    if(isset($_SESSION['errors']['password'])):
                ?>
                <p class="text-danger fw-semibold">
                    <?= $_SESSION['errors']['password'] ?>
                </p>
                <?php
                    unset($_SESSION['errors']);
                    endif;
                ?>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="userpassword" name="userpassword" placeholder="Userpassword">    
                    <label for="userpassword">User Password</label>
                </div>
                <div class="mb-5">
                    <p>Doesn't have an account? <a href="employee_register.php">Register Now!</a></p>
                </div>
                <div class="d-flex justify-content-center">
                    <input type="submit" type="button" value="Login" class="btn btn-success fs-5 fw-bold px-5" id="entry-btn" name="loginbtn">
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>