<?php  session_start(); session_unset();session_destroy(); include("inc/r.php");?>
<!DOCTYPE html>
<html>
<head>
  <title>Avaport - Oyun</title>
  <meta charset="UTF-8">
  <meta name="description" content="Avaport Avataria Private Server">
  <meta name="keywords" content="HTML, CSS, PYTHON">
  <meta name="author" content="Avaport">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://avagoom.ru/files/css/bootstrap.min.css">
<script src="https://avagoom.ru/files/js/jquery-3.2.1.slim.min.js"></script>
<script src="https://avagoom.ru/files/js/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://avagoom.ru/files/js/jquery.js"></script>
<link href="https://avagoom.ru/files/css/main2.css" rel="stylesheet">
<!---- menu -->
<style>
body {
      background-image:url(https://i.hizliresim.com/2yMyTK.png);
      background-repeat:no-repeat;
      background-size: cover;
   }
</style>
<script type="text/javascript">
  $(".change-menu-bar").bind("click", function(e){
    e.preventDefault();

    let page = e.target.href;
    let idPage = this.id;

    if (idPage == "shop") {
      $(".section-menu").hide();
      $("." + idPage).show();
    }
    else {
      $(".section-menu").hide();
      $("." + idPage).show();
    }

    window.history.pushState(null, null, page);

    $(".change-menu-bar").removeClass("active");
    $( this ).addClass("active");
  });
</script>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="/">Avaport</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/">Anasayfa <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="https://www.instagram.com/avaportoyun">Instagram</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="/oyna.php">Oyna</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/kurallar.php">Kurallar</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/update.php">Güncellemeler</a>
      </li>
      <!---
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>-->
 
   
<style>
  .trans {
    background: transparent; 
    width: 400px;
    height: 350px;
    border: 5px;
    border-radius: 5px;
    margin-top: 20px;
  }
</style>
</nav>
<center>  <div class="trans"><form action="doLogin.php" method="post">
<img src="https://i.hizliresim.com/hgyDYv.png" style="width: 450px; height: 200px;"/>
  <input type="text" name="g_mail" placeholder="E Posta Adresiniz" required class="form-control" style="margin-left: 20px; width: 300px;">
  <input type="password" name="g_sifre" placeholder="Şifreniz" required class="form-control" style="margin-left: 20px; margin-top: 10px; width: 300px;">
  <input type="submit" class="btn btn-primary" value="Giriş Yap" style="font-size: 20px; width: 300px; margin-left: 20px; margin-top: 10px;"/>

  </form>
<p style="margin-left: 20px; margin-top: 20px; color: #6c757d;">Avaport hesabınız yok mu ?<br><a href="/register.php"><button type="submit" class="btn btn-danger" style="width: 300px; margin-top: 10px; font-size: 20px;">Hesap Oluştur</button></a>
  <p style="margin-left: 30px; margin-top: 30px;" class="text-muted">2020, Avaport. <a href="#">Tüm Hakları Saklıdır.</a></span>
  </p></p>
<button style="margin-left: 10px;" type="button"class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter">Sunucu Bilgi</button></div>
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Avaport Online Sunucu İstatiskleri</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h1>
        Avaport Kayıtlı Oyuncu: <font class="text-muted"> <?php echo $redis->get("uids") ; ?></font>
        <hr>
        Avaport Online Oyuncu: <font class="text-muted"><?php    $ary = $redis->smembers("online_tr"); echo count($ary);  ?></font>
        </h1>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-dark" data-dismiss="modal">Kapat</button>
      </div>
    </div>
  </div>
</div>
</center>
</body>
</html>