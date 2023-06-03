<?php
session_start();
include_once "php/config.php"; //veri tabanina yuladik
if (!isset($_SESSION['unique_id'])) { //burda kontorl ediliyor kullanicinin idsi hatali olmamasna
  header("location: login.php");
}
?>
<?php include_once "header.php"; ?> <!--headerlere aldik-->

<body>
  <!--sayfanin diş hepsi-->
  <div class="wrapper">
    <!--mesajlama yeri-->
    <section class="chat-area">
      <header>
        <?php
        $user_id = mysqli_real_escape_string($conn, $_GET['user_id']); //isteğimiz kişiye mesajlama için id lerine aldik 
        $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}"); //veri tababnınden aldik
        if (mysqli_num_rows($sql) > 0) { //eğer kullanicinin idleri bulundaysa
          $row = mysqli_fetch_assoc($sql); //mesajlama ve herşey kayit ediliyor
        } else {
          header("location: users.php"); //hata olursa bu sayfaya yonlendriyor
        }
        ?>
        <!--bu satir mesajlamdan geri sayfaya donmek içindir-->
        <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
        <!--bu satir kullaniciniz fotografi dir-->
        <img src="php/images/<?php echo $row['img']; ?>" alt="">
        <div class="details">
          <span>
            <!--kullanicinin adi ve soyadi-->
            <?php echo $row['fname'] . " " . $row['lname'] ?>
          </span>
          <p>
            <!-- kullanıcının durumu -->
            <?php echo $row['status']; ?>
          </p>
        </div>
      </header>
      <!--mesajlaşma yere-->
      <div class="chat-box">

      </div>
      <!--mesaj gondermek için her şey-->
      <form action="#" class="typing-area">
        <!--bu başka kullanicilerin gelen mesajlar içindir-->
        <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
        <!-- burda bizim yazdiğimiz mesajlar-->
        <input type="text" name="message" class="input-field" placeholder="Mesajinize Yaziniz" autocomplete="off">
        <!--bu buton mesaja gondermek içindir-->
        <button><i class="fab fa-telegram-plane"></i></button>
      </form>
    </section>
  </div>
  <!--burda java script kullanark gelen mesajlar giden mesajlar ve butonlara komut verdik-->
  <script src="javascript/chat.js"></script>

</body>

</html>