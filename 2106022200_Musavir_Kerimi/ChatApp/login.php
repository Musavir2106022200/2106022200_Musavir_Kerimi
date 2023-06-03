<?php
session_start();
if (isset($_SESSION['unique_id'])) { //kullanıcnın id hatali olmamasi için kontrol ediliyor
  header("location: users.php");
}
?>
<!-- bu sayfa giriş yapmak içn dir ve alt kodta header kodlarina başka sayfadan aliyrouz -->
<?php include_once "header.php"; ?>

<body>
  <!-- bu tum saf için class tanimladik-->
  <div class="sayfa">
    <!-- bu satir bilgiler alindiği yerdir-->
    <section class="form login">
      <header>Tekrar Hoş Geldiniz</header>
      <!-- burdad post metodunu kullanarak verilere kullanıcıden alindikten sonra baska yere kullanmak içn gondermek için kullnadik-->
      <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
        <!-- bu satir hata verme için kullnilmiştir -->
        <div class="error-text"></div>
        <!--burada da veriler alinmiştir-->
        <div class="field input">
          <label>E-Posta</label>
          <input type="text" name="email" placeholder="E-pstanıza giriniz" required>
        </div>
        <div class="field input">
          <label>Şifre</label>
          <input type="password" name="password" placeholder="Şifrenize giriniz" required>
          <i class="fas fa-eye"></i>
        </div>
        <!--veriler gondermek için kullanilmiştir-->
        <div class="field button">
          <input type="submit" name="submit" value="Sohbete Devam et">
        </div>
      </form>
      <!-- eger Hesabı yoksa buraya tiklayar hesab oluşabilir -->
      <div class="link">Hesabınız Yokmu? <a href="index.php">Şimdi oluştur</a></div>
    </section>
  </div>
  <!-- bu java kodu şifreye gormek ve saklamak için kullanilmiştir-->
  <script src="javascript/pass-show-hide.js"></script>
  <!--burdadada veriler xml kullanarak kontrol ederek başka sayfaya almaya çakişiyoruz -->
  <script src="javascript/login.js"></script>

</body>

</html>