<?php
session_start();
if (isset($_SESSION['unique_id'])) { //kontrol ediliyor kullanıcının idleri doğrumu
    include_once "config.php"; //veri tabanine ukliyor
    $outgoing_id = $_SESSION['unique_id']; //giden mesajin id
    $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']); //gelen mesajin id
    $output = "";
    //burada veri tabanine mesajlara kişilerin idlerine bakarak kim kimden one göre yazdiriyoruz
    $sql = "SELECT * FROM messages LEFT JOIN users ON users.unique_id = messages.outgoing_msg_id
                WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id})
                OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) ORDER BY msg_id";
    $query = mysqli_query($conn, $sql); //veriler veri tabanine yuklenir
    if (mysqli_num_rows($query) > 0) { //eğer başarili bir şekilde olduysa
        while ($row = mysqli_fetch_assoc($query)) { //mesajlar bir bir yerine gidiyor
            if ($row['outgoing_msg_id'] === $outgoing_id) { //bu mesaj gonderin kişidir
                $output .= '<div class="chat outgoing">
                                <div class="details">
                                    <p>' . $row['msg'] . '</p>
                                </div>
                                </div>';
            } else { //bu mesaja alan kişidir
                $output .= '<div class="chat incoming">
                                <img src="php/images/' . $row['img'] . '" alt="">
                                <div class="details">
                                    <p>' . $row['msg'] . '</p>
                                </div>
                                </div>';
            }
        }
    } else {
        $output .= '<div class="text">Mesajiniz Yok.</div>'; //burda eğer hiçbir mesaj yoksa bu measja verecek
    }
    echo $output;
} else {
    header("location: ../login.php"); //kontrolda bir hata çiksa bu sayfaya yonlendirecek
}

?>