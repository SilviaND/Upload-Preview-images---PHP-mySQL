<?php
require 'connection.php';
session_start();

// IF USER LOGGED IN
if (isset($_SESSION['email'])) {
    header('Location: gallery.php');
    exit;
}

if (isset($_POST['email']) && isset($_POST['password'])) {

// CHECK IF FIELDS ARE NOT EMPTY
    if (!empty(trim($_POST['email'])) && !empty(trim($_POST['password']))) {

// Escape special characters.
        $email = mysqli_real_escape_string($db, htmlspecialchars(trim($_POST['email'])));
        $query = mysqli_query($db, "SELECT * FROM `users` WHERE email = '$email'");

        if (mysqli_num_rows($query) > 0) {
            $row = mysqli_fetch_assoc($query);
            $user_db_pass = $row['password'];

// VERIFY PASSWORD
            $check_password = password_verify($_POST['password'], $user_db_pass);

            if ($check_password === TRUE) {
                session_regenerate_id(true);
                $_SESSION['email'] = $email;
                header('Location: gallery.php');
                exit;
            } else {
// INCORRECT PASSWORD
                $error_message = "Incorrect Email Address or Password.";
            }
        } else {
// EMAIL NOT REGISTERED
            $error_message = "Incorrect Email Address or Password.";
        }
    } else {

// IF FIELDS ARE EMPTY
        $error_message = "Please fill in all the required fields.";
    }
}

?>

<!doctype html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Form</title>
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
</head>
<body>
<div class="container text-center">
    <p>Log-In</p>

    <form method="POST" action="" id="form-container">
        <div class="form-group">
            <label for="email"></label>
            <input type="email" name="email" placeholder="E-mail" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password"></label>
            <input type="password" name="password" placeholder="Password" class="form-control" required>
        </div>
        <br/>
        <button type="submit" name="login" id="btn-login">Login</button>
        <br/>
        <a href="register.php">Register</a>
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
