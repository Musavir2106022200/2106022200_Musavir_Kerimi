<?php
session_start();
include_once "config.php"; //sqlla baglanma
$email = mysqli_real_escape_string($conn, $_POST['email']); //burda baska sayfadan girilen maile aliyoruz
$password = mysqli_real_escape_string($conn, $_POST['password']); //baska sayfada girirlen şifreye aliyoruz
if (!empty($email) && !empty($password)) { //eger 2  alanlar boş değilse 
    $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'"); //burda mysql yani veri tabani bakarak bu eposta mevcutmudur diye bakicez
    if (mysqli_num_rows($sql) > 0) { //eger girelen e-posta mevcut ise
        $row = mysqli_fetch_assoc($sql); //veriye alir
        $user_pass = md5($password); //bu password yani sakli yapar şifreye 
        $enc_pass = $row['password']; //burda şifreyey alir
        if ($user_pass === $enc_pass) { //eğer şifreler ayni ise
            $status = "Çevrimiçi"; //durum değişir
            $sql2 = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id = {$row['unique_id']}"); //veri tabanma durumu değiştiririz
            if ($sql2) { //eğer başarili ise
                $_SESSION['unique_id'] = $row['unique_id']; //idye aliriz
                echo "başarili"; //başarili yazaar
            } else {
                echo "Br hata oluştu"; //olmasa bu hataya verir
            }
        } else {
            echo "E-Posta yada Şifre Yanliş"; //olmasa bu hataya verir
        }
    } else {
        echo "E-Posta yada Şifre Yanliş"; //eger hatali e-posta girilirsa bu hata verilecek
    }
} else {
    echo "Lütfen Tüm alanı doldurunuz"; //eger alanlar boş ise bu hatayı verecek
}
?>