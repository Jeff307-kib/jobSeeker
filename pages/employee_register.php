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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
<div class="container">
  <div class="user-form">
    <h1 class="text-center fw-bold mb-5">Explore Jobs!</h1>
    <?php if(isset($_SESSION['errors']['database'])): ?>
      <p class='text-danger fw-semibold'><?= $_SESSION['errors']['database'] ?></p>
    <?php 
      unset($_SESSION['errors']);
      endif;
     ?>
    <form action="backend/employee_register_process.php" method="post">
      <div class="form-floating mb-3">
        <input 
          type="text" 
          class="form-control" 
          id="user_name" 
          name="user_name" 
          placeholder="User Name">
        <label for="user_name">User Name</label>
        <?php if(isset($_SESSION['errors']['user_name'])): ?>
          <p class='text-danger fw-semibold'><?= $_SESSION['errors']['user_name'] ?></p>
        <?php
          unset($_SESSION['errors']); 
          endif;
         ?>
      </div>
      <div class="form-floating mb-3">
        <input 
          type="text" 
          class="form-control" 
          id="email_address" 
          name="email_address" 
          placeholder="Email Address">
        <label for="email_address">Email Address</label>
        <?php if(isset($_SESSION['errors']['email'])): ?>
          <p class='text-danger fw-semibold'><?= $_SESSION['errors']['email'] ?></p>
        <?php
          unset($_SESSION['errors']); 
          endif;
        ?>
      </div>
      <div class="form-floating mb-3">
        <input 
          type="password" 
          class="form-control" 
          id="password" 
          name="password" 
          placeholder="Password">
        <label for="password">Password</label>
        <?php if(isset($_SESSION['errors']['password'])): ?>
          <p class='text-danger fw-semibold'><?= $_SESSION['errors']['password'] ?></p>
        <?php
          unset($_SESSION['errors']); 
          endif;
        ?>
      </div>
      <div class="form-floating mb-3">
        <input 
          type="password" 
          class="form-control" 
          id="confirmpassword" 
          name="confirmpassword" 
          placeholder="Confirm Password">
        <label for="confirmpassword">Confirm Password</label>
        <?php if(isset($_SESSION['errors']['confirmpassword'])): ?>
          <p class='text-danger fw-semibold'><?= $_SESSION['errors']['confirmpassword'] ?></p>
        <?php
          unset($_SESSION['errors']); 
          endif;
        ?>
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
        <p>Already have an account? <a href="employee_login.php">Log In!</a></p>
      </div>
      <div class="d-flex justify-content-center">
        <input 
          type="submit" 
          value="Register" 
          class="btn btn-success fs-5 fw-bold px-5" 
          id="entry-btn">
      </div>
    </form>
  </div>
</div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"crossorigin="anonymous"></script>
</body>

</html>