<?php
session_start();
if (isset($_SESSION['unique_id'])) { //unique id lerine kontrol ediyor
    include_once "config.php"; //veri tabanine bağlar
    $logout_id = mysqli_real_escape_string($conn, $_GET['logout_id']); //cikiş için kullancinin id sine aliyor 
    if (isset($logout_id)) { //var olduğunda yani null olmadiğinda
        $status = "Çevirimdışı"; //statusu durumunu bunu çeviriyoruz
        $sql = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id={$_GET['logout_id']}"); //burda veri tabanide kişinin durmunu gunceliyoruz
        if ($sql) { //eğer doğru bir şekilde çaliştaysa
            session_unset();
            session_destroy(); //sayfaya kapat
            header("location: ../login.php"); //bu sayfya yonlendir
        }
    } else {
        header("location: ../users.php"); //hata olursa bu sayfaya yonlendirefek
    }
} else {
    header("location: ../login.php"); //hata olunca buraya gelecek
}
?>