<?php
require 'connection.php';
session_start();

if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {

// CHECK IF FIELDS ARE NOT EMPTY
    if (!empty(trim($_POST['username'])) && !empty(trim($_POST['email'])) && !empty($_POST['password'])) {

// Escape special characters.
        $username = mysqli_real_escape_string($db, htmlspecialchars($_POST['username']));
        $email = mysqli_real_escape_string($db, htmlspecialchars($_POST['email']));

//IF EMAIL IS VALID
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

// CHECK IF EMAIL IS ALREADY REGISTERED
            $check_email = mysqli_query($db, "SELECT `email` FROM `users` WHERE email = '$email'");

            if (mysqli_num_rows($check_email) > 0) {
                $error_message = "This Email Address is already registered. Please Try another.";
            } else {
// IF EMAIL IS NOT REGISTERED

                $user_hash_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

// INSERT USER INTO THE DATABASE
                $insert_user = mysqli_query($db, "INSERT INTO `users` (username, email, password) VALUES ('$username', '$email', '$user_hash_password')");

                if ($insert_user === TRUE) {
                    $success_message = "Thanks! You have successfully signed up.";
                } else {
                    $error_message = "Oops! something wrong.";
                }
            }
        } else {
// IF EMAIL IS INVALID
            $error_message = "Invalid email address";
        }
    } else {
// IF FIELDS ARE EMPTY
        $error_message = "Please fill in all the required fields.";
    }
}
// IF USER LOGGED IN
if (isset($_SESSION['user_email'])) {
    header('Location: gallery.php');
    exit;
}
?>

<!doctype html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registration Form</title>
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
</head>
<body>
<div class="container text-center">
    <p>Registration</p>
    <form method="POST" action="" id="form-container">
        <div class="form-group">
            <label for="username"></label>
            <input type="text" name="username" placeholder="Username" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email"></label>
            <input type="email" name="email" placeholder="E-mail" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password"></label>
            <input type="password" name="password" placeholder="Password" class="form-control" required>
        </div>
        <br/>
        <button type="submit" name="register-user" id="btn-register">Registration</button>
        <br/>
        <a href="login.php">Login</a>
    </form>
    <?php
    if (isset($success_message)) {
        echo '<div class="success_message">' . $success_message . '</div>';
    }
    if (isset($error_message)) {
        echo '<div class="error_message">' . $error_message . '</div>';
    }
    ?>
</div>
</body>
</html>
