<?php
    session_start();
    include('confs/config.php');
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $errors = [];

        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $career = $_POST['career'];
        $about = $_POST['about'];
        $skills = $_POST['skills'];
        $experiences = $_POST['experiences'];

        //Handling proile image

        $sql = "SELECT profile_image FROM users WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $_SESSION['user_id']);
        $stmt->execute();

        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();

        if(!empty($_POST['profile'])){
            $target = "../../uploads/";
            $image_name = basename($_FILES['profile']['name']);
            $tmp_name = $_FILES['profile']['tmp_name'];
            $image_size = $_FILES['profile']['size'];
            $image_type = strtolower(pathinfo($image_name,PATHINFO_EXTENSION));
            $unique_image_name = time(). '.' .$image_type;
            $target_file_path = $target.$unique_image_name;
            $allowed_image_type = ['jpg','jpeg','png'];
            $fileError = $_FILES['profile']['error'];
    
            if($fileError !== UPLOAD_ERR_OK){
                $_SESSION['errors']['image'] = "Error uploading the image. Error code: $fileError";
                header('location: ../edit_profile.php');
                exit;
            }
            //Checking if the image is jpg, jpeg or png.
            else if(!in_array($image_type, $allowed_image_type)){
                $_SESSION['errors']['image'] = "Invalid imgae type! Only JPG, JPEG and PNG are allowed.";
                header('location: ../edit_profile.php');
                exit;           
            }
            //Checking file size of the image
            else if($image_size > 2 * 1024 * 1024){
                $_SESSION['errors']['image'] = "File is too large. Maximum image size is 2MB.";
                header('location: ../edit_profile.php');
                exit;             
            }
            else{
                move_uploaded_file($tmp_name, $target_file_path);
            }
        }
        else{
            $unique_image_name = $row['profile_image'];
        }


        //Checking if the link is valid for LinkedIn and store in the database
        if(empty($_POST['linkedin'])){
            $linkedin = null;
        }
        else if(!preg_match('/^(https?:\/\/)?(www\.)?linkedin\.com\/in\/[A-Za-z0-9-]+\/?$/',$_POST['linkedin'])){
            $errors['linkedin'] = 'The input is not a LinkedIn link. Please enter a valid link';
        }
        else {
            $linkedin = $_POST['linkedin'];
        }

        //Checking if the link is valid for Facebook and store in the database
        if(empty($_POST['facebook'])){
            $facebook = null;
        }
        else if(!preg_match('/^(https?:\/\/)?(www\.)?facebook\.com\/[A-Za-z0-9.]+\/?$/',$_POST['facebook'])){
            $errors['facebook'] = 'The input is not a Facebook link. Please enter a valid link';
        }
        else {
            $facebook = $_POST['facebook'];
        }

        //Checking if the link is valid for Instagram and store in the database
        if(empty($_POST['instagram'])){
            $instagram = null;
        }
        else if(!preg_match('/^(https?:\/\/)?(www\.)?instagram\.com\/[A-Za-z0-9._]+\/?$/',$_POST['instagram'])){
            $errors['instagram'] = 'The input is not a Instagram link. Please enter a valid link';
        }
        else {
            $instagram = $_POST['instagram'];
        }

        //Checking if the link is valid for Youtube and store in the database
        if(empty($_POST['youtube'])){
            $youtube = null;
        }
        else if(!preg_match('/^(https?:\/\/)?(www\.)?youtube\.com\/(channel|user|c)\/[A-Za-z0-9_-]+\/?$/',$_POST['youtube'])){
            $errors['youtube'] = 'The input is not a Youtube link. Please enter a valid link';
        }
        else {
            $youtube = $_POST['youtube'];
        }
        
        //Checking if the link is valid for Github and store in the database
        if(empty($_POST['github'])){
            $github = null;
        }
        else if(!preg_match('/^(https?:\/\/)?(www\.)?github\.com\/[A-Za-z0-9-]+\/?$/',$_POST['github'])){
            $errors['github'] = 'The input is not a Github link. Please enter a valid link';
        }
        else {
            $github = $_POST['github'];
        }

        //Checking if the link is valid for Twitter and store in the database
        if(empty($_POST['twitter'])){
            $twitter = null;
        }
        else if(!preg_match('/^(https?:\/\/)?(www\.)?(x\.com|twitter\.com)\/[A-Za-z0-9_]+\/?$/',$_POST['twitter'])){
            $errors['twitter'] = 'The input is not a Twitter or X link. Please enter a valid link';
        }
        else {
            $twitter = $_POST['twitter'];
        }

        if(empty($errors)){
            //Store all the links as a string to make queries eaiser
            $profileLinks = implode('|', [$linkedin, $facebook, $instagram, $youtube, $github, $twitter]);
    
            $sql = "UPDATE users  
                    SET user_name = ?,
                        user_email = ?,
                        about = ?,
                        skills = ?,
                        experiences = ?,
                        social_links = ?,
                        phone_number = ?,
                        address = ?,
                        career = ?,
                        profile_image = ? 
                    WHERE user_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ssssssssssi', $name, $email, $about, $skills, $experiences, $profileLinks, $phone, $address, $career, $unique_image_name, $_SESSION['user_id']);
            if($stmt->execute()){
                $stmt->close();
                header('location: ../employee_profile.php');
                exit;
            }
            else{
                $_SESSION['errors']['database'] = "Oops! Something went wrong. Please Try Again!";
                header('location: ../edit_profile.php');
                exit;
            }
        }
        else{
            $_SESSION['errors'] = $errors;
            header('location: ../edit_profile.php');
            exit;
        }

    }
?>