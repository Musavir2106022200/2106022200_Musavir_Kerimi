<?php
session_start();
include_once "config.php"; //veri tabanına baglandik
$outgoing_id = $_SESSION['unique_id']; //kullanıcın idsine aldik
$sql = "SELECT * FROM users WHERE NOT unique_id = {$outgoing_id} ORDER BY user_id DESC"; //girilmiş kullanıcıdan başka  kullanıcılara hepsine aldik
$query = mysqli_query($conn, $sql); //veriler sakllaniyor
$output = "";
if (mysqli_num_rows($query) == 0) { //eger hiç kullancıcı yoksa 
    $output .= "Kullanıcı mevcut yoktur"; //kullanıc yoksa bu hata vericek
} elseif (mysqli_num_rows($query) > 0) { //eğer kullanıcı varsa 
    include_once "data.php"; //hepsi aldik
}
echo $output;
?>