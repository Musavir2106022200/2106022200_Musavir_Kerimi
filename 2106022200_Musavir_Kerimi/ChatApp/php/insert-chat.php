<?php
session_start();
if (isset($_SESSION['unique_id'])) { //burda kullanici giriş yapiği diye kontrol ediyor
    include_once "config.php"; //veritabanine baglandik
    $outgoing_id = $_SESSION['unique_id']; //bu satir mesaja kim gonderine bakiyor
    $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']); //burda mysqle daha uygun hale gitirdik karakterlerine
    $message = mysqli_real_escape_string($conn, $_POST['message']); //burdada sql için karakterlerina daha uygun hale gitirdik
    if (!empty($message)) { //burada bakiliyor bir mesaj varmi diye
        $sql = mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg) 
                                        VALUES ({$incoming_id}, {$outgoing_id}, '{$message}')") or die(); //burdada mesaja veri tabanine yukledik
    }
} else {
    header("location: ../login.php"); //doğru bir şekilde giriş yapmadiysa başka sayfaya yonlndiriyor
}



?>