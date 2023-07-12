<?php
$conn = mysqli_connect("localhost", "root", "", "db_usim") or die(mysqli_error($conn));
$id = $_REQUEST['id'];
$query = "DELETE FROM files WHERE id='$id'";
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

if ($result) {
  header("Location: subject1.php");
  exit;
} else {
  echo "Error deleting the file. Please try again.";
}
?>

