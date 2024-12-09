<?php
    session_start();
    include('confs\config.php');

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $errors = [];
        /*Checking name format*/
        if(empty($_POST["user_name"])){
            $errors["user_name"] = "User name is required!";
        }
        else if(!preg_match("/^[a-zA-Z0-9_ ]+$/", $_POST["user_name"])){
            $errors["user_name"] = "User name must start wit a-z or A-Z or 0-9 or _ . ";
        }
        else{
            $username = trim($_POST["user_name"]);
        }

        /*Checking Email format*/
        if(empty($_POST["email_address"])){
            $errors["email_address"] = "Email address is required!";
        }
        else if(!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $_POST["email_address"]) ){
            $errors["email_address"] = "Invaid Email. Please enter the valid email address.";
        }
        else 
        {
            $useremail = $_POST["email_address"];
        }

        if(empty($_POST["password"])){
            $errors["password"] = "Please enter password!";
        }
        /*Checking password format! Password must contain one small letter, one capital letter, one digit, one special character and must have at least 8 characters. */
        else if(!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,}$/", $_POST["password"])){
            $errors["password"] = "Please enter a strong password! Password must contains at least one small letter, one capital letter, one digit, one special character and must have at least 8 characters.";
        }
        else{
            /*Checking if the passwords match or not*/
            if(empty($_POST["confirmpassword"])){
                $errors["confirmpassword"] = "Please enter this field!";
            }
            else if($_POST["confirmpassword"] != $_POST["password"]){
                $errors["confirmpassword"] = "Passwords do not match!";
            }
            else{
                $userpassword = password_hash($_POST["confirmpassword"], PASSWORD_BCRYPT);
            }
        }

        /*Check if the checkbox for terms and privacy is checked or not*/
        if(!isset($_POST["terms_policy"])){
            $errors["terms_policy"] = "Please agree to our terms and policy!";
        }
        
        if(empty($errors)){

            /* Checking if the email has already registered or not*/
            $sql = "SELECT user_email FROM users WHERE user_email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s",$useremail);
            $stmt->execute();

            if($stmt->num_rows > 0){
                $_SESSION['errors']['email'] = "This email is already registered!";
                header('location: ../employee_register.php');
                exit;
            }

            $stmt->close();

            /*adding the new user into database*/
            $sql = "INSERT INTO users (user_name,user_email,password) VALUES
                    (?, ?, ?)";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $username, $useremail, $userpassword);
            if($stmt->execute()){
                $stmt->close();
                header('location: ../../index.php');
                exit;

            }
            else{
                $stmt->close();
                $_SESSION['errors']['database'] = "Register Failed! Please Try Again!";
                header('location: ../employee_register.php');
                exit;
            }
        }
        else{
            /*remember to unset $_SESSION["errors"] after showing on the form because the session will persist to all of the pages*/
            $_SESSION["errors"] = $errors;
            header('location: ../employee_register.php');
            exit;
        }
    }
?>