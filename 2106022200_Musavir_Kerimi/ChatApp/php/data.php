<?php
while ($row = mysqli_fetch_assoc($query)) { //ne kdaar veri varsa hepsine alir
    $sql2 = "SELECT * FROM messages WHERE (incoming_msg_id = {$row['unique_id']} 
                OR outgoing_msg_id = {$row['unique_id']}) AND (outgoing_msg_id = {$outgoing_id} 
                OR incoming_msg_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1"; //bu sql kodu tum gelen giden mesajlara duzenliyor olarak
    $query2 = mysqli_query($conn, $sql2); //hepsine saklar
    $row2 = mysqli_fetch_assoc($query2); //ilk yani son mesaji aliyor
    (mysqli_num_rows($query2) > 0) ? $result = $row2['msg'] : $result = "Mesaj Yok"; //burda bakar mesaj varmi varsa yazar yoksa mesaj yok diye yazdirir
    (strlen($result) > 28) ? $msg = substr($result, 0, 28) . '...' : $msg = $result; //eğer mesaj 28den buyukse 28e sadece aliyor
    if (isset($row2['outgoing_msg_id'])) { //eğer buyla mesaj varsa 
        ($outgoing_id == $row2['outgoing_msg_id']) ? $you = "Siz: " : $you = ""; //burada eğer kullanıcı mesaj atsa kullanıcıye sız olacarak yaziyor
    } else {
        $you = ""; //yokas bisey yazmaz
    }
    ($row['status'] == "Offline now") ? $offline = "offline" : $offline = ""; //burda offline olmasi yazr yoksa yazar
    ($outgoing_id == $row['unique_id']) ? $hid_me = "hide" : $hid_me = ""; //burda kontrol ediyor giden mesajlara

    $output .= '<a href="chat.php?user_id=' . $row['unique_id'] . '">
                    <div class="content">
                    <img src="php/images/' . $row['img'] . '" alt="">
                    <div class="details">
                        <span>' . $row['fname'] . " " . $row['lname'] . '</span>
                        <p>' . $you . $msg . '</p>
                    </div>
                    </div>
                    <div class="status-dot ' . $offline . '"><i class="fas fa-circle"></i></div>
                </a>'; //burda verilere yaziyor isimler soyadi ve sayri
}
?>