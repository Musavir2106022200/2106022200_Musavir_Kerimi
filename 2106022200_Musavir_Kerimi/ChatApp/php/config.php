<?php // burdada mysqle baglandik 
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "chatapp";

$conn = mysqli_connect($hostname, $username, $password, $dbname);
if (!$conn) {
  echo "Mysql error" . mysqli_connect_error(); //hata varsa bunu yapicek
}
?>