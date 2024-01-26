<php 
<?php
$servername = "localhost";
$username = "root";
$password = "";
$database="disscuss";
try {
    $conn = mysqli_connect($servername, $username, $password,$database);
    if (!$conn) {
        throw new Exception("There is a connection error: " . mysqli_connect_error());
    }
} catch (Exception $e) {
   echo "could not connect" . $e->getMessage();
   exit();
}
?>

?>