<?php
session_start();
if (isset($_SESSION['unique_id'])) { //kullanıcnın id hatali olmamasi için kontrol ediliyor
  header("location: users.php");
}
?>
<!-- bu kod config.php sayfaya buryaya aliyor o sayfada head ve html kodlari yaziyor -->
<?php include_once "header.php"; ?>

<body>
  <!--burda sayfanin tumunu oluştruyoruz -->
  <div class="sayfa">
    <!-- bu işlem yapan yerdir bilgilara aliyoru -->
    <section class="form signup">
      <header>Hoşgeldiniz</header>
      <!-- burada iççindekilere post metodu ile başka sayfalarda işlem yapabilmemiz için post yapiyoruz tum verilere almak için-->
      <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
        <!--burada hata vermek işleme duzeltiyoruz-->
        <div class="error-text"></div>
        <div class="name-details">
          <div class="field input">
            <!--burda ad soyad ve başka bilgilara aliyoruz -->
            <label>Adiniz</label>
            <input type="text" name="fname" placeholder="Adınıza giriniz" required>
          </div>
          <div class="field input">
            <label>Soyadınız</label>
            <input type="text" name="lname" placeholder="Soyadınıza giriniz" required>
          </div>
        </div>
        <div class="field input">
          <label>E-Posta</label>
          <input type="text" name="email" placeholder="E-postanıza giriniz" required>
        </div>
        <div class="field input">
          <label>Şifre</label>
          <input type="password" name="password" placeholder="Yeni şifrenize giriniz" required>
          <i class="fas fa-eye"></i>
        </div>
        <!--burada da fotograf aliyoruz ve bu bilgilara almak zorunda -->
        <div class="field image">
          <label>Fotoğraf Seçiniz</label>
          <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg" required
            value="Continue to Chat">
        </div>
        <div class="field button">
          <!--tum bililara gondermek için button oluşturuyoruz-->
          <input type="submit" name="submit" value="Sohbete başlat">
        </div>
      </form>
      <!--burada son olarak hesab olma durumu yazdiriyoruz varsa başka sayfaya yonlendiriyoru-->
      <div class="link">Hesabınız Varmı? <a href="login.php">Giriş yap</a></div>
    </section>
  </div>
  <!-- bu java kodu şifreye baka bilmek için kullanillmiştir-->
  <script src="javascript/pass-show-hide.js"></script>
  <!-- bu kod ajax programmine kullanarak egere veriler basari bir şekilde alindiysa başka sayfaya yonlendriyor-->
  <script src="javascript/signup.js"></script>

</body>

</html>