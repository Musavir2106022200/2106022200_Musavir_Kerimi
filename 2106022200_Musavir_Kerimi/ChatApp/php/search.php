<?php
session_start();
include_once "config.php"; //veri tabanine baglar

$outgoing_id = $_SESSION['unique_id']; //kontrol idne yapiyor
$searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']); //bu kullanıcı arama yaptiği zaman yaptiği arama buraya aldiriyoruz

//burda sql kodlar veri tabanindan arama yaptiriyouruz ad soyad gibi isimlere
$sql = "SELECT * FROM users WHERE NOT unique_id = {$outgoing_id} AND (fname LIKE '%{$searchTerm}%' OR lname LIKE '%{$searchTerm}%') ";
$output = "";
$query = mysqli_query($conn, $sql);
if (mysqli_num_rows($query) > 0) {
    include_once "data.php";
} else { //eğer arama sonucunda nir şey yoksa bu soncu verecek
    $output .= 'Sonuc Bulunamadi';
}
echo $output;
?>