<?php
    session_start();
    include('confs\config.php');

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $errors = [];

        if(empty($_POST['useremail'])){
            $errors['email'] = "Please enter the email";

        }
        else{
            $useremail =$_POST['useremail'];
        }

        if(empty($_POST['userpassword'])){
            $errors['password'] = "Please enter the password";
        }
        else{
            $userpassword = $_POST['userpassword'];
        }

        if(empty($errors)){
            $sql = "SELECT * FROM users WHERE user_email = ?";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $useremail);

            if($stmt->execute()){
    
                $result = $stmt->get_result();
    
                if($result->num_rows === 1){
                    $row = $result->fetch_assoc();
                    /*Storing data in the session to use when appropriate*/
                    if(password_verify($userpassword, $row['password'])){
                        $_SESSION['user_name'] = $row['user_name'];
                        $_SESSION['user_id'] = $row['user_id'];
                        $_SESSION['user_email'] = $row['user_email'];
                        $_SESSION['logged_in'] = true;
    
                        header('location: ../../index.php');
                        exit;
                    }
                    else{
                        $errors['password'] = "Incorrect password;";
                        $_SESSION['errors'] = $errors;
                        header('location: ../employee_login.php');
                        exit;
                    }
                }
                else{
                    $errors['email'] = "Invalid Email! No user found!";
                    $_SESSION['errors'] = $errors;
                    header('location: ../employee_login.php');
                    exit;
                }
    
                $stmt->close();
            }
            else{
                $stmt->close();
                $_SESSION['errors']['database'] = "Login Failed! Please Try Again!";
                header('location: ../employee_login.php');
                exit;
            }
        }
        else{
            $_SESSION['errors'] = $errors;
            header('location: ../employee_login.php');
            exit;
        }
    }
?>