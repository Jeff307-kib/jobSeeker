<?php
    session_start();
    include('confs/config.php');

    if($_SERVER['REQUEST_METHOD'] === "POST"){
        $error = [];
        
        //Validation check for company name
        if(empty($_POST['companyname'])){
            $error['name'] = 'Company name is required!';
        }
        else if(!preg_match('/^[a-zA-Z0-9&.\'’\- ]{2,100}$/', $_POST['companyname'])){
            $error['name'] = 'Invalid company name!';
        }   
        else{
            $name = $_POST['companyname'];
        }    

        //validation check for company email
        if(empty($_POST['companyemail'])){
            $error['email'] = 'Company email is required!';
        }
        else if(!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $_POST['companyemail'])){
            $error['email'] = 'Invalid email format!';
        }   
        else{
            $email = $_POST['companyemail'];
        }

        //validation check for company phone number
        if(empty($_POST['companyphonenumber'])){
            $error['phone'] = 'Company phone number is required!';
        }
        else if(!preg_match('/^\d{10,15}$/', $_POST['companyphonenumber'])){
            $error['phone'] = 'Invalid Phone Number';
        }
        else{
            $phone = $_POST['companyphonenumber'];
        }

        //validation check for password
        if (empty($_POST["companypassword"])) {
            $error["password"] = "Please enter password!";
        } else if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,}$/", $_POST["companypassword"])) {
            $error["password"] = "Password must contain at least one small letter, one capital letter, one digit, one special character and must have at least 8 characters.";
        } else if (empty($_POST["companyconfirmpassword"])) {
            $error["confirmpassword"] = "Please enter this field!";
        } else if ($_POST["companyconfirmpassword"] != $_POST["companypassword"]) {
            $error["confirmpassword"] = "Passwords do not match!";
        } else {
            $password = password_hash($_POST["companypassword"], PASSWORD_BCRYPT);
        }

        //Check if the checkbox of terms_policy is checked or not
        if(!isset($_POST["terms_policy"])){
            $error["terms_policy"] = "Please agree to our terms and policy!";
        }


        if(!empty($error)){
            $_SESSION['errors'] = $error;
            header('location: ../company_register.php');
            exit;
        }
        else{
            //Check if the email is already registerd or not
            $sql = "SELECT company_email FROM company WHERE company_email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if($result->num_rows > 0){
                $_SESSION['errors']['email'] = 'This email is already registered!';
                header('location: ../company_register.php');
                exit;
            }

            $stmt->close();

            //Insert new company into the database
            $sql = "INSERT INTO company (company_name, company_email, company_phone_number, company_password) VALUES (?,?,?,?) ";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssss", $name, $email, $phone, $password);
            
            if($stmt->execute()){
                $company_id = $stmt->insert_id;

                $_SESSION['company_id'] = $company_id;
                $_SESSION['company_name'] = $name;
                $_SESSION['company_email'] = $email;
                $_SESSION['logged_in'] = true;

                $stmt->close();
                header('location: ../company_profile.php');
                exit;
            }
            else{
                $stmt->close();
                $_SESSION['errors']['database'] = 'Registered Failed! Please try again!';
                header('location: ../company_register.php');
                exit;
            }
        }
    }
?>