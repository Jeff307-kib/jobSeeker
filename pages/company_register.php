<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container">
        <div class="user-form">
        <h1 class="text-center fw-bold mb-5">Register Now!</h1>
        <?php if(isset($_SESSION['errors']['database'])): ?>
        <p class="text-danger">
            <?= $_SESSION['errors']['database'] ?>
        </p>
        <?php
            unset($_SESSION['errors']);
            endif; 
        ?>
            <form action="backend/company_register_process.php" method="post">
                <?php
                    if(isset($_SESSION['errors']['name'])):
                ?>
                <p class="text-danger fw-semibold">
                    <?= $_SESSION['errors']['name'] ?>
                </p>
                <?php
                    unset($_SESSION['errors']);
                    endif;
                ?>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="companyname" name="companyname" placeholder="Company Name">
                    <label for="companyname">Company Name</label>
                </div>

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
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="companyemail" name="companyemail" placeholder="Company Email">
                    <label for="companyemail">Company Email</label>
                </div>

                <?php
                    if(isset($_SESSION['errors']['phone'])):
                ?>
                <p class="text-danger fw-semibold">
                    <?= $_SESSION['errors']['phone'] ?>
                </p>
                <?php
                    unset($_SESSION['errors']);
                    endif;
                ?>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="companyphonenumber" name="companyphonenumber" placeholder="Company Phone Number">
                    <label for="companyphonenumber">Phone Number</label>
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
                    <input type="password" class="form-control" id="companypassword" name="companypassword" placeholder="Password">    
                    <label for="companypassword">Password</label>
                </div>

                <?php
                    if(isset($_SESSION['errors']['confirmpassword'])):
                ?>
                <p class="text-danger fw-semibold">
                    <?= $_SESSION['errors']['confirmpassword']?>
                </p>
                <?php
                    unset($_SESSION['errors']);
                    endif;
                ?>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="companyconfirmpassword" name="companyconfirmpassword" placeholder="Confirm Password">    
                    <label for="companyconfirmpassword">Confirm Password</label>
                </div>

                <div class="mb-3">
                    <input type="checkbox" id="terms_policy" name="terms_policy">
                    <label for="terms_policy">Agree with our <a href="#">terms</a> & <a href="#">policy</a>.</label>
                    <?php if(isset($_SESSION['errors']['terms_policy'])): ?>
                        <p class='text-danger fw-semibold'><?= $_SESSION['errors']['terms_policy'] ?></p>
                    <?php
                        unset($_SESSION['errors']); 
                        endif;
                    ?>
                </div>

                <div class="mb-5">
                    <p>Already have an account? <a href="employee_register.php">Log In Now!</a></p>
                </div>
                <div class="d-flex justify-content-center">
                    <input type="submit" type="button" value="Register" class="btn btn-success fs-5 fw-bold px-5" id="entry-btn" name="loginbtn">
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>
</html>