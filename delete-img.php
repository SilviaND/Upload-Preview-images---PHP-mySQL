<?php
require "connection.php";
$id = $_GET["id"];
$query = $db->query("SELECT * from images WHERE id=$id");

if ($query->num_rows > 0) {
    $row = $query->fetch_assoc();
    $path = 'uploads/' . $row['image'];

    if (file_exists($path)) {
        unlink($path);
    } else {
        echo "File does not exist!";
    }
}

$sql = "DELETE FROM images WHERE id=$id";

if ($db->query($sql) === TRUE) {
    echo "<script>alert('Record deleted successfully')</script>";
} else {
    echo "<script>alert('Error deleting record: ' . $db->error)</script>";
}

$db->close();

?>

<script>
    window.location = "gallery.php";
</script>
