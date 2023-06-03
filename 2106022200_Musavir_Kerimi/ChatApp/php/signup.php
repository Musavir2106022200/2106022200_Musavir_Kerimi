<?php
session_start();
include_once "config.php"; //bu veri tabanine yukler
$fname = mysqli_real_escape_string($conn, $_POST['fname']); //kullaniciden alindiği isim 
$lname = mysqli_real_escape_string($conn, $_POST['lname']); //kullaniciden alindiği soyadi
$email = mysqli_real_escape_string($conn, $_POST['email']); //kullanıcıden alindiği e posta
$password = mysqli_real_escape_string($conn, $_POST['password']); //kullaniciden alindiği şifre
if (!empty($fname) && !empty($lname) && !empty($email) && !empty($password)) { //egerr tum bilgiler bos ise hata vericek
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) { //burada e postaya control ediyoruz 
        $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'"); //burada sql den e postalara alarak karşilaştriyoruz
        if (mysqli_num_rows($sql) > 0) { //burada e postanin varmi yokmu diye kontrol edeceğiz
            echo "$email - Bu E-posta Mevcuttut"; //e posta varsa bu hataya vericek
        } else {
            if (isset($_FILES['image'])) { //burada kullanıcı bir veri atmişmidir diye bakicez
                $img_name = $_FILES['image']['name']; //burada kullannıcının verdiği fottografın adıne aldık
                $img_type = $_FILES['image']['type']; //burada kullanıcın fotogranfın sekline aldik 
                $tmp_name = $_FILES['image']['tmp_name']; //bu fotogrfalara kayit etmek için 

                $img_explode = explode('.', $img_name); //fotografainn son kelimelerine aliyruz yabi jpg yada png gibi
                $img_ext = end($img_explode); //burdada 

                $extensions = ["jpeg", "png", "jpg"]; //bu bizim için kabul ve alabilen şekillerdir
                if (in_array($img_ext, $extensions) === true) { //eger fotograf bizim şekillere uygun ise
                    $types = ["image/jpeg", "image/jpg", "image/png"];
                    if (in_array($img_type, $types) === true) {
                        $time = time(); //burda zaman aliyruz cunku kullnıcınınn gotograflarine aldiktensonra onun adine degıstıreces ve kayıt edecez o yuzden bize zaman lazim
                        $new_img_name = $time . $img_name;
                        if (move_uploaded_file($tmp_name, "images/" . $new_img_name)) { //eger kullancının ftotgrafları dogru bir şekilde kayit edildiğine
                            $ran_id = rand(time(), 100000000); // kallıcıler için restgele id yazicez
                            $status = "Çevirimiçi"; //kullanıcı giriş yaptikten sonra bu durum çevirimiçi yazilecek 
                            $encrypt_pass = md5($password);
                            //burada kullancının verilerine mysqle yaziriryoruz
                            $insert_query = mysqli_query($conn, "INSERT INTO users (unique_id, fname, lname, email, password, img, status)
                                VALUES ({$ran_id}, '{$fname}','{$lname}', '{$email}', '{$encrypt_pass}', '{$new_img_name}', '{$status}')");
                            if ($insert_query) { // eger tum bilgiler dogru bir şekilde kayit olduysa
                                $select_sql2 = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
                                if (mysqli_num_rows($select_sql2) > 0) { //eğerer başarili ise 
                                    $result = mysqli_fetch_assoc($select_sql2); //bilgilere yazar
                                    $_SESSION['unique_id'] = $result['unique_id']; //ve idlerine karşilaştir
                                    echo "başarili"; //basarili yazar
                                } else {
                                    echo "Bu E-Posta mevcuttur!"; //bu hataya verir
                                }
                            } else {
                                echo "Hata!"; //olmasa hata verir
                            }
                        }
                    } else {
                        #echo "Please upload an image file - jpeg, png, jpg";
                        exit;
                    }
                } else {
                    #echo "Please upload an image file - jpeg, png, jpg";
                    exit;
                }
            }
        }
    } else { //eger e posta dogru degılse
        echo "$email - Bu E-Posta Doğru deiğldir";
    }
} else { //egere tum alan bos ise bu hataya vericek
    echo "Lütfen Tum Alanı doldurunuz";
}
?>