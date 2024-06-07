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
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<link rel="stylesheet" href="/files/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<!---- menu -->
<style>
body {
      background-image:url(https://i.hizliresim.com/2yMyTK.png);
    
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
<center>  <div class="trans"><form action="kayit.php" method="post">
<img src="https://i.hizliresim.com/hgyDYv.png" style="margin-top: 10px; width: 450px; height: 200px;"/>
<input type="text" name="adsoyad" placeholder="Adınız Soyadınız" required class="form-control" style="margin-left: 20px; width: 300px;">
<input type="password" name="sifre" placeholder="Şifreniz" required class="form-control" style="margin-left: 20px; margin-top: 10px; width: 300px;">
<input type="email" name="eposta" placeholder="E Posta Adresiniz" required class="form-control" style="margin-left: 20px; margin-top: 10px; width: 300px;">
<select name="cinsiyet" class="form-control" style="margin-left: 20px; margin-top: 10px; width: 300px;">
  <option value="1">Erkek</option>
  <option value="2">Kadın</option>
</select>

  <input type="submit" class="btn btn-primary" value="Kayıt Ol" style="font-size: 20px; width: 300px; margin-left: 20px; margin-top: 10px;"/>
  </form>
<p style="margin-left: 20px; margin-top: 20px; color: #6c757d;">Avaport hesabınız yok mu ?<br><a href="/register.php"><button type="submit" class="btn btn-danger" style="width: 300px; margin-top: 10px; font-size: 20px;">Hesap Oluştur</button></a>
  <p style="margin-left: 30px; margin-top: 30px;" class="text-muted">2020, Avaport. <a href="#">Tüm Hakları Saklıdır.</a></span>
  </p></p>
</center>
</body>
</html>