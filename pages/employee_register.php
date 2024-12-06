<?php 
  session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee| Register</title>
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<body>
    <div class="container-fluid d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="row d-flex justify-content-between mx-1">
            <div class="col-lg-6 col-md-12 user-form  border border-black p-5 rounded w-lg-100 w-md-100" style="--bs-border-opacity: .3;">
                <h1 class="text-center mb-4">Explore jobs!</h1>
                <?php
                  if(isset($_SESSION['errors']['database'])){
                    echo "<p class='text-danger'>".$_SESSION['errors']['database']."</p>";
                  }
                ?>
                <form action="backend/employee_register_process.php" method="post">
                    <?php
                      if(isset($_SESSION['errors']['user_name'])){
                        echo "<p class='text-danger'>".$_SESSION['errors']['user_name']."</p>";
                      }
                    ?>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" placeholder=""  name="user_name">
                        <label for="floatingInput" >User Name</label>
                    </div>
                    <?php
                      if(isset($_SESSION['errors']['email_address'])){
                        echo "<p class='text-danger'>".$_SESSION['errors']['email_address']."</p>";
                      }
                    ?>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="floatingInput" placeholder="" name="email_address">
                        <label for="floatingInput" >Email address</label>
                    </div>
                    <?php
                      if(isset($_SESSION['errors']['password'])){
                        echo "<p class='text-danger'>".$_SESSION['errors']['password']."</p>";
                      }
                    ?>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="floatingPassword" placeholder="" name="password">
                        <label for="floatingPassword">Password</label>
                    </div>
                    <?php
                      if(isset($_SESSION['errors']['confirmpassword'])){
                        echo "<p class='text-danger'>".$_SESSION['errors']['confirmpassword']."</p>";
                      }
                    ?>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="floatingPassword" placeholder="" name="confirmpassword">
                        <label for="floatingPassword">Confirm Password</label>
                    </div>
                    <?php
                      if(isset($_SESSION['errors']['terms_policy'])){
                        echo "<p class='text-danger'>".$_SESSION['errors']['terms_policy']."</p>";
                      }
                    ?>
                    <div class="mb-5">
                        <input type="checkbox" id="checkbox" name="terms_policy">
                        <label for="checkbox">Agree with our <a href="#">terms</a> & <a href="#">policy.</a></label>
                    </div>
                    <div class="d-flex justify-content-center">
                        <input type="submit" value="Register" type="button" class="btn border border-success px-5 py-2" name="register_btn">
                    </div>
                </form>
            </div>
            <div class="col-lg-6 d-none d-lg-flex align-items-center "id="register-image">
                <img src="https://www.wellable.co/blog/wp-content/uploads/2022/12/Employee-Engagement.png" style="width: 100%;" alt="People networking image." class="d-none d-lg-block">
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous">
    </script>
</body>

</html>l