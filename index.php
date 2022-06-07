<?php
require 'connection.php';
?>

<!doctype html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Summer - Gallery</title>
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
</head>
<body>
<div class="container text-center">
    <div id="users-forms" class="d-flex flex-row justify-content-around">
        <div id="register-form">
            <div class="user-form p-2" onclick="window.location.href='register.php'">
                Register
            </div>
        </div>
        <div id="login-form">
            <div class="user-form p-2" onclick="window.location.href='login.php'">
                Log In
            </div>
        </div>
    </div>
    <div id="file-list">
        <p>File List:</p>
        <?php
        require 'connection.php';

        $sql = "SELECT id, image FROM images";
        $result = $db->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<ul class='list-group'>";
                echo "<li class='list-group-item m-2'> id: " . $row["id"] . "<br/>" . " File name: " . $row["image"] . "<p>";
                echo "</ul>";
            }
        } else {
            echo "0 results";
        }
        ?>
    </div>
</div>
<script src="./js/script.js"></script>
<script src="./js/bootstrap.min.js"></script>
</body>
</html>