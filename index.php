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
            <p class="text-center">Choose an image for upload:</p>
            <input type="file" name="fileToUpload" id="fileToUpload" class="form-control text-center"><br/>
            <input type="submit" value="Upload the file" name="submit" class="form-control text-center" id="submit-btn">
        </form>
    </div>
</div>
<div class="container text-center">
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
<div class="container text-center">
    <div class="gallery">
        <?php
        $query = $db->query("SELECT * FROM images");
        if ($query->num_rows > 0) {
            while ($row = $query->fetch_assoc()) {
                $imageURL = 'uploads/' . $row["image"];
                ?>
                <div class="img-thumbnail"
                     id="gallery-item">
                    <img id="img"
                         class="img-thumbnail"
                         src="<?php echo $imageURL; ?>"/>
                    <br/>
                    <a class="btn"
                       href="delete-img.php?id=<?php echo $row["id"]; ?>">
                        Delete image
                    </a>
                </div>
                <?php
            }
        } else {
            ?>
            <p>
                No image(s) found...
            </p>
            <?php
        }

        ?>
    </div>
</div>
</div>
<script src="./js/script.js"></script>
<script src="./js/bootstrap.min.js"></script>
</body>
</html>