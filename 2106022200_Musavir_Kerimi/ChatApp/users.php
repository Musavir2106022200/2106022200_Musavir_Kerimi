<?php
session_start();
include_once "php/config.php"; //mysql burayaa aliyrouz
if (!isset($_SESSION['unique_id'])) { //kullanıcılara verillen uniqye idlerine bakiyoruz
  header("location: login.php"); //yanlişlik varsa bu sayfaya yonlendiriyor
}
?>
<?php include_once "header.php"; ?> <!--burda header ekliyour-->

<body>
  <!-- tum sayfa -->
  <div class="sayfa">
    <!-- kullanıcılara ayit class-->
    <section class="users">
      <header>
        <!-- bilgiler-->
        <div class="content">
          <?php
          //mysql yanni veri tabanına bakarak hangi kullanıcı oldugu belirtiyoruz
          $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
          //burda eğer hata yoksa bir değişgeni atiyoruz
          if (mysqli_num_rows($sql) > 0) {
            $row = mysqli_fetch_assoc($sql);
          }
          ?>
          <!--burda veri tabaninden aldiğimiz verilere karşilaştirerek kullancının fotgrafina yazdriyoruz.-->
          <img src="php/images/<?php echo $row['img']; ?>" alt="">
          <div class="details">
            <span>
              <!-- kullanıcının ad ve soyadinine yazdriyoruz-->
              <?php echo $row['fname'] . " " . $row['lname'] ?>
            </span>
            <p>
              <!-- kullanıcının durumunu yazdriyourz-->
              <?php echo $row['status']; ?>
            </p>
          </div>
        </div>
        <a href="php/logout.php?logout_id=<?php echo $row['unique_id']; ?>" class="logout">Çikiş</a>
      </header>
      <!--bu başka kullancilere aramak için kullanilir-->
      <div class="search">
        <!--bu sayfa yerinde arama yapıces-->
        <span class="text">Sohbete başlamak için tiklayiniz</span>
        <!--burda kullanicnin adina irdiğimiz yer-->
        <input type="text" placeholder="Kullanıcının Adına Giriniz">
        <!--bu botun tekleyerk arama yapabilirz-->
        <button>Kullanıcı Ara</button>
      </div>
      <!--kbaşka kullaıcılarin listesi-->
      <div class="users-list">

      </div>
    </section>
  </div>
  <!--bu java kodu butonlarin komutlarina ve kolanicilerin adlarine ve başka komutlara yapicek-->
  <script src="javascript/users.js"></script>


</body>

</html>