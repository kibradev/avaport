<?php  session_start(); session_unset();session_destroy(); include("inc/r.php");?>

<!DOCTYPE html>
<html>
<head>
  <title>
    Avaport
  </title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
      <script src="https://kit.fontawesome.com/768ddcae19.js" crossorigin="anonymous"></script>
<link href="https://fonts.googleapis.com/css2?family=Rubik:wght@500&display=swap" rel="stylesheet">

</head>
<body style="background: #242533;">
  <style>
    ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #1a1a24;
}

li {
  float: left;
}

li a {
  display: block;
  color: white;
  text-align: center;
  font-family: 'Poppins', sans-serif;
  font-weight: 400;
  font-size: 20px;
  padding: 14px 16px;
  text-decoration: none;
}

/* Change the link color to #111 (black) on hover */
li a:hover {
  background-color: #111;
transition: 0.8s;
}

.mence {
  background: #1a1a24;
  width: 400px;
  height: 500px;
  border: 5px;
  border-radius: 10px;
  margin-top: 40px;

}


  </style>
  <ul>
  <li><a style="font-size: 20px; font-weight: 500;" href="/">Avaport</a></li>
  <li><a href="/park.php">Anasayfa</a></li>
  <li><a target="blank" href="https://www.instagram.com/avaportoyun"><i class="fab fa-instagram"></i> Instagram</li></a>
  <li><a target="blank" href="https://discord.gg/EtDF5be"><i class="fab fa-discord"></i> Discord</li></a>

  <li style="float:right"><a style="font-family: 'Rubik', sans-serif; font-size: 20px; 
"class="active" href="#about">Şu An <font color="#00d415"><?php    $ary = $redis->smembers("online_tr"); echo count($ary);  ?> kişi </font> Avaport Oynuyor</a></li>
</ul>
<center><div class="mence">
  <img src="https://i.hizliresim.com/hgyDYv.png" style="margin-left: -10px; margin-top: -20px; width: 450px; height: 200px;"/>
<form method="POST" action="doLogin.php">
<input class="form-control" style="  
width: 300px; 
background-color: #fff; 
color: #fff; 
border: 2px;
margin-top: 20px;" name="g_mail" type="email" placeholder="E Posta Adresiniz" required />
<input  class="form-control" style="  
width: 300px; 
background-color: #fff; 
color: #fff; 
border: 2px;
margin-top: 10px;" type="password"  name="g_sifre" placeholder="Şifrenizi Girin" />
<style>
  .neun {
    float: left; margin-top: 10px; margin-left: 50px;background-color: #00bfff; width: 150px; height: 45px; color: #fff;   font-family: 'Poppins', sans-serif;
font-weight: 500; 
  }

  .neun:hover {
    background-color: transparent;
    border: 2px solid #00bfff;
    transition: 0.8s;
    color: #00bfff;
  }

  .neun-red{
    float: left; margin-top: 10px; margin-left: 5px;background-color: #cc1212; width: 150px; height: 45px; color: #fff;   font-family: 'Poppins', sans-serif;
font-weight: 500; 
  }

  .neun-red:hover {
    background-color: transparent;
    border: 2px solid #cc1212;
    transition: 0.8s;
    color: #cc1212;
  }
  </style>
<input  class="btn neun" type="submit" value="Giriş Yap">
</form>
<a href="/register.php"><button class="neun-red btn" type="submit">Kayıt Ol</button></a>
<center><p style="margin-top: 160px;"><font color="white">2020 Avaport</font> <a href="">Tüm Hakları Saklıdır</a></p></center></div></center>
</body>
</html>