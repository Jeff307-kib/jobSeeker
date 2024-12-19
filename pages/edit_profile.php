<?php 
    session_start();
    include('backend/confs/config.php');
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
    ?>
    <a href="employee_profile.php">
        <img src="../images/back.png" alt="Go Back" style="width:32px;" class="goback">
    </a>
    <a href="">
        <img src="../images/question.png" alt="Help" title="Help" style="width:32px;" class="help">
    </a>
    <div class="container">
        <p class="text-center fs-1 fw-bold" style="color: #662E9B;">Edit Your Profile</p>
        <?php if(isset($_SESSION['errors']['database'])) : ?>
        <p><?= $_SESSION['errors']['databae'] ?></p>
        <?php endif; ?>
        <form action="backend\edit_profile_process.php" method="post"  enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" value="<?= $row['user_name']; ?>" name="name">
            </div>
            <div class="d-flex justify-content-between">
                <div class="w-50 me-1 mb-3">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" value="<?= $row['user_email']; ?>" name="email">
                </div>
                <div class="w-50 mb-3">
                    <label for="phone">Phone Number</label>
                    <input type="text" class="form-control" id="phone" placeholder="e.g. 09-123456789" value="<?= $row['phone_number'] ?>" name="phone">
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <div class="w-50 me-1 mb-3">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" placeholder="e.g. Mandalay" value="<?= $row['address'] ?>" name="address">
                </div>
                <div class="w-50 mb-3">
                    <label for="career">Prefered Career</label>
                    <input type="text" class="form-control" id="career" placeholder="e.g. backend-developer" value="<?= $row['career'] ?>" name="career">
                </div>
            </div>
            <div class="d-flex justify-content-between align-items-end">
                <div class="w-50 me-1 mb-3">
                    <label for="profile">Profile Picture</label>
                    <input type="file" class="form-control" id="profile" placeholder="eg" name="profile" value="<?= $row['profile_image'] ?>">
                </div>
                <div class="w-50 mb-3">
                    <p>Leave blank to keep the old profile picture.</p>
                </div>
            </div>
            
            <!-- Showing error message for profile image -->
            <?php
                if(isset($_SESSION['errors']['image'])):
            ?>
            <p class="text-danger fw-semibold">
                <?= $_SESSION['errors']['image'] ?>
            </p>
            <?php
                unset($_SESSION['errors']);
                endif;
            ?>

            <div class="mb-3">
                <label for="about">About</label>
                <textarea id="about" class="form-control" rows="3" placeholder="Write" name="about"><?= $row['about'] ?></textarea>
            </div>
            <div class="mb-3">
                <label for="skills">Skills</label>
                <textarea id="skills" class="form-control" rows="3" placeholder="Write" name="skills" ><?= $row['skills'] ?></textarea>
            </div>
            <div class="mb-3">
                <label for="experiences">Experiences</label>
                <textarea id="experiences" class="form-control" rows="3" placeholder="Write" name="experiences" ><?= $row['experiences'] ?></textarea>
            </div>
            <div class="d-flex justify-content-between">
                <div class="w-50 me-1 mb-3">
                    <label for="linkedin">Linkedin</label>
                    <input type="text" class="form-control" id="linkedin" name="linkedin" placeholder="Enter your profile link" value="<?= $linkedIn ?>">
                </div>

                <!-- Showing error message for invalid link -->
                <?php
                    if(isset($_SESSION['errors']['linkedin'])):
                ?>
                <p class="text-danger fw-semibold">
                    <?= $_SESSION['errors']['linkedin'] ?>
                </p>
                <?php
                    unset($_SESSION['errors']);
                    endif;
                ?>

                <div class="w-50 mb-3">
                    <label for="facebook">Facebook</label>
                    <input type="text" class="form-control" id="career" name="facebook" placeholder="Enter your profile link"  value="<?= $facebook ?>" >
                </div>

                <!-- Showing error message for invalid link -->
                <?php
                    if(isset($_SESSION['errors']['facebook'])):
                ?>
                <p class="text-danger fw-semibold">
                    <?= $_SESSION['errors']['facebook'] ?>
                </p>
                <?php
                    unset($_SESSION['errors']);
                    endif;
                ?>

            </div>
            <div class="d-flex justify-content-between">
                <div class="w-50 me-1 mb-3">
                    <label for="instagram">Instagram</label>
                    <input type="text" class="form-control" id="instagram" name="instagram" placeholder="Enter your profile link"  value="<?= $instagram ?>">
                </div>                

                <!-- Showing error message for invalid link -->
                <?php
                    if(isset($_SESSION['errors']['instagram'])):
                ?>
                <p class="text-danger fw-semibold">
                    <?= $_SESSION['errors']['instagram'] ?>
                </p>
                <?php
                    unset($_SESSION['errors']);
                    endif;
                ?>

                <div class="w-50 mb-3">
                    <label for="youtube">Youtube</label>
                    <input type="text" class="form-control" id="youtube" name="youtube" placeholder="Enter your profile link"  value="<?= $youtube ?>">
                </div>                

                <!-- Showing error message for invalid link -->
                <?php
                    if(isset($_SESSION['errors']['youtube'])):
                ?>
                <p class="text-danger fw-semibold">
                    <?= $_SESSION['errors']['youtube'] ?>
                </p>
                <?php
                    unset($_SESSION['errors']);
                    endif;
                ?>
            </div>
            <div class="d-flex justify-content-between">
                <div class="w-50 me-1 mb-3">
                    <label for="github">Github</label>
                    <input type="text" class="form-control" id="github" name="github" placeholder="Enter your profile link"  value="<?= $github ?>">
                </div>                

                <!-- Showing error message for invalid link -->
                <?php
                    if(isset($_SESSION['errors']['github'])):
                ?>
                <p class="text-danger fw-semibold">
                    <?= $_SESSION['errors']['github'] ?>
                </p>
                <?php
                    unset($_SESSION['errors']);
                    endif;
                ?>
                <div class="w-50 mb-3">
                    <label for="twitter">Twitter</label>
                    <input type="text" class="form-control" id="twitter" name="twitter" placeholder="Enter your profile link"  value="<?= $twitter ?>">
                </div>                

                <!-- Showing error message for invalid link -->
                <?php
                    if(isset($_SESSION['errors']['twitter'])):
                ?>
                <p class="text-danger fw-semibold">
                    <?= $_SESSION['errors']['twitter'] ?>
                </p>
                <?php
                    unset($_SESSION['errors']);
                    endif;
                ?>
            </div>

            <div class="mb-3">
                <input type="submit" value="Confirm">
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>
</html>