<?php 
    session_start(); 
    include('backend/confs/config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee| Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php
        $sql = "SELECT * FROM users WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $_SESSION['user_id']);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();

        $links = explode('|', $row['social_links']);

        $linkedIn = $links[0] ?? '';
        $facebook = $links[1] ?? '';
        $instagram = $links[2] ?? '';
        $youtube = $links[3] ?? '';
        $github = $links[4] ?? '';
        $twitter = $links[5] ?? '';

        //Handling profile image. Showing default image if user hasn't add the profile photo.
        if($row['profile_image'] != null){
            $profile = "../uploads/".$row['profile_image'];
        }
        else{
            $profile = "../images/logo.png";
        }


    ?>
    <?php include('navigation.php'); ?>
    <div class="container-fluid">
        <div class="row px-5 my-4 grid gap-5 ">
            <div class="col-8" style="height: 350px; background-color:#662E9B; border-radius:14px;">
                <div class="my-3 mx-1 p-3 d-inline-block rounded bg-white" style="">
                <img 
                    src="<?= $profile; ?>" 
                    alt="Profile image" 
                    style="width:128px; height:128px;"
                >
                </div>
                <p class="fs-1 fw-bold text-black"><?= $row['user_name'] ?></p>
                <p class="fs-4 fw-semibold text-black"> <?= $row['career'] ?? 'Prefered Career' ; ?></p>
                <div class="d-flex justify-content-between">
                    <p class="text-white"><?=  $row['user_email']; ?></p>
                    <p class="text-white"> <?= $row['phone_number'] ?? ''; ?> </p>
                    <p class="text-white"> <?= $row['address'] ?? ''; ?> </p>
                </div>
            </div>
            <div class="col-3 d-flex flex-column align-items-end">
                <div>
                    <a href="#" type="btn" class="btn btn-success fs-5 fw-semibold" style="min-width:180px;">
                        View Resume
                        <img src="../images/resume.png" alt="Edit Icon" class="ms-2 mb-1" style="width:24px;">
                    </a>
                </div>
                <div class="my-3">
                    <a href="edit_profile.php" type="button" class="btn btn-success fs-5 fw-semibold" style="width:180px;">
                        Edit Profile 
                        <img src="../images/edit.png" alt="Edit Icon" class="ms-2 mb-1" style="width:24px;"> 
                    </a>
                </div>
                <div>
                    <a href="backend/logout.php" type="button" class="btn btn-danger fs-5 fw-semibold" style="width:180px;">
                        Log Out
                        <img src="../images/logout.png" alt="Logout Icon" class="ms-2 mb-1" style="width:24px;"> 
                    </a>
                </div>
            </div>
        </div>
        <div class="row px-5 mb-3">
            <div class="col" style="min-height:100px;  border-radius:14px;">
                <p class="fs-1 fw-semibold">About</p>
                <p class="fs-3"> <?= $row['about'] ?? '- - -'; ?> </p>
            </div>
        </div>
        <div class="row px-5 mb-3">
            <div class="col" style="min-height:100px;">
                <p class="fs-1 fw-semibold">Skills</p>
                <p class="fs-3"> <?= $row['skills'] ?? '- - -'; ?> </p>
            </div>
        </div>
        <div class="row px-5 mb-3">
            <div class="col" style="min-height:100px;">
                <p class="fs-1 fw-semibold">Experiences</p>
                <p class="fs-3"> <?= $row['experiences'] ?? '- - -'; ?> </p>
            </div>
        </div>
        <div class="row px-5 mb-5">
            <p class="fs-1 fw-semibold">Social Links</p>
            <?php 
                if(!empty($linkedIn)){
                    echo"<div class='col d-block'>
                            <a href= '" .$linkedIn. "'><img src='../images/linkedin.png' alt='Linkedin Icon' style='width: 42px;'></a>
                        </div>";
                }
                if(!empty($facebook)){
                    echo"<div class='col d-block'>
                            <a href= '" .$facebook. "'><img src='../images/facebook.png' alt='Facebook Icon' style='width: 42px;'></a>
                        </div>";
                }
                if(!empty($instagram)){
                    echo"<div class='col d-block'>
                            <a href= '" .$instagram. "'><img src='../images/instagram.png' alt='Instagram Icon' style='width: 42px;'></a>
                        </div>";
                }
                if(!empty($youtube)){
                    echo"<div class='col d-block'>
                            <a href= '" .$youtube. "'><img src='../images/youtube.png' alt='Youtube Icon' style='width: 42px;'></a>
                        </div>";
                }
                if(!empty($github)){
                    echo"<div class='col d-block'>
                            <a href= '" .$github. "'><img src='../images/social.png' alt='Github Icon' style='width: 42px;'></a>
                        </div>";
                }
                if(!empty($twitter)){
                    echo"<div class='col d-block'>
                            <a href= '" .$twitter. "'><img src='../images/twitter.png' alt='Twitter Icon' style='width: 42px;'></a>
                        </div>";
                }
            ?>     
        </div>     
    </div>
    <?php include('footer.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>
</html>