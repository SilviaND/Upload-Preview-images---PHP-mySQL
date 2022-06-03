

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

    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
//            echo "Файлът е снимка - " . $check["mime"] . ".";
            echo "<br/>";
            $uploadOk = 1;
        } else {
            echo "Фaйлът не е снимка.";
            echo "<br/>";
            $uploadOk = 0;
        }
    }
        if (file_exists($target_file)) {
            echo "Файлът вече съществува.";
            echo "<br/>";
            $uploadOk = 0;
        }

        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "Файлът е прекалено голям.";
            echo "<br/>";
            $uploadOk = 0;
        }

        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Можете да изберете само файл с JPG, PNG, JPEG & GIF формат.";
            echo "<br/>";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "Файлът не е качен.";
            echo "<br/>";
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "Файл ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " е качен.";
                echo "<br/>";
                $sql = "INSERT INTO images (image) VALUES ('{$_FILES["fileToUpload"]["name"]}')";

                if (mysqli_query($db, $sql)) {
                    echo "New record created successfully";
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($db);
                }

            } else {
                echo "Възникна грешка при качването на файла.";
                echo "<br/>";
            }

        }

    ?>


    <div id="file-list">

    </div>

    <button type="button" class="btn" onclick="window.location.href='index.php'" id="backBtn">Назад</button>
</div>
</body>
</html>


