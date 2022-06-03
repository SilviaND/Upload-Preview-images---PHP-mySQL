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
        <div id="file-upload-form" class="text-center m-5">
            <form action="./upload.php" method="post" enctype="multipart/form-data">
                <p class="text-center">Избери снимка за качване:</p>
<!--                --><?php //if(!empty($statusMsg)){ ?>
<!--                    <p class="status --><?php //echo $status; ?><!--">--><?php //echo $statusMsg; ?><!--</p>-->
<!--                --><?php //} ?>
                <input type="file" name="fileToUpload" id="fileToUpload" class="form-control text-center"><br/>
                <input type="submit" value="Качи снимката" name="submit" class="form-control text-center" id="submit-btn">
            </form>
        </div>
    <div class="gallery">

    </div>
</div>
<script src="./js/script.js"></script>
<script src="./js/bootstrap.min.js"></script>
</body>
</html>