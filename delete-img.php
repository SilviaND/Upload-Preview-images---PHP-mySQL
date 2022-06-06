<?php
require "connection.php";

$id=$_GET["id"];

$sql = "DELETE FROM images WHERE id=$id";

if ($db->query($sql) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $db->error;
}

unlink($id);

$db->close();


?>

<script>
    window.location="index.php";
</script>
