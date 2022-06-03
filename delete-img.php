<?php
require "connection.php";

//$id=$_GET["id"];
//
//$res=mysqli_query("SELECT * from images WHERE id=$id");
//while($row=mysqli_fetch_array($res)){
//    $img=$row["image"];
//}
//unlink($img);
//
//mysqli_query("DELETE FROM images where id=$id");

$db = "DELETE FROM images WHERE id=$id";

if ($conn->query($db) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>

<script>
    window.location="index.php";
</script>