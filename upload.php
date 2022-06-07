<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
</head>
<body>

<div class="container text-center" id="upload-info">

    <?php
    require 'connection.php';

    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {

            echo "<br/>";
            $uploadOk = 1;
        } else {
            echo "The file is not an image.";
            echo "<br/>";
            $uploadOk = 0;
        }
    }
        if (file_exists($target_file)) {
            echo "The file already exist.";
            echo "<br/>";
            $uploadOk = 0;
        }

        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "The file is too large.";
            echo "<br/>";
            $uploadOk = 0;
        }

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "You can choose only JPG, PNG, JPEG & GIF file format.";
            echo "<br/>";
            $uploadOk = 0;
        }
        if ($uploadOk == 0) {
            echo "The file is not uploaded.";
            echo "<br/>";
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "File ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " is uploaded.";
                echo "<br/>";
                $sql = "INSERT INTO images (image) VALUES ('{$_FILES["fileToUpload"]["name"]}')";

                if (mysqli_query($db, $sql)) {
                    echo "New record created successfully";
                    echo "<br/>";
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($db);
                }
            } else {
                echo "An error occurred while uploading the file.";
                echo "<br/>";
            }
        }
    ?>
    <button type="button" class="btn" onclick="window.location.href='gallery.php'" id="backBtn">Back</button>
</div>
</body>
</html>


