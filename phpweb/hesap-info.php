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
  .konubar {
    background-color: #000;
    width: 1200px;
    height: 500px;
    border: 1px;
    margin-top: 2%;
    border-radius: 5px;

  }
</style>
</nav>
<center><div class="konubar">
<img src="https://i.hizliresim.com/7CrzG8.png" style="width: 450px; height: 200px;"/> 
<h1>Avaport'a hoşgeldin <?php echo $_SESSION["id"]; ?>
</div></center>
<script>
function sifre() {
document.getElementById("sifre").style.display = "block";
 
}

function sifrekp() {
document.getElementById("sifre").style.display = "none";
 
}
</script>
<?php

 $t = $_SESSION["id"];
if($_POST["s_esk"] != null){
   $t = $_SESSION["id"];
  
  if($redis->get("uid:$t:panelsifre") == $_POST["s_esk"]){
    
    $redis->set("uid:$t:panelsifre", $_POST["s_yen"]); 
    
    echo "<script type='text/javascript'>alert('Şifreniz başarılı bir şekilde değiştirildi.');</script>";
    
    }else {
      
        echo "<script type='text/javascript'>alert('Eski şifrede hata!');</script>";
      
    }
}
 if($redis->get("uid:$t:role") != 0){
   
  // include("inc/mod.php");
   
 }
 
 ?>
</body>
</html>