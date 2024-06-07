<?php 

 session_start();
 include("inc/kdn.php");
 include("bakimci.php");
 
 
 if($bakim != True){ require_once("inc/r.php");} else {header("location: index.php");}
 

?>
<title>AVAPORT</title>
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
    
   }
</style>
      <script src="https://kit.fontawesome.com/768ddcae19.js" crossorigin="anonymous"></script>

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
</head>  
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
        <!--
        <a class="nav-link" href="/kurallar.php">Kurallar</a>
      </li>-->
      <li class="nav-item">
        <a class="nav-link" href="/">Çıkış Yap</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/"><?php echo $redis->lrange("uid:$uid:appearance", 0 ,0)[0];  ?></a>
      </li>
   

    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="modal" data-target="#myModal">Hesap Ayarları</a>
      </li>
          <li class="nav-item">
        <a class="nav-link" href="#"><i class="fas fa-users"></i> <?php    $ary = $redis->smembers("online_tr"); echo count($ary);  ?></a>
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

<iframe src="giris.php" style="border:0px #ffffff none; width:100%;" name="myiFrame" scrolling="no" frameborder="1" marginheight="0px" marginwidth="0px" height="1000px"   allowfullscreen></iframe>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Avaport Şifre Değiştirme</h4>
      </div>
      <div class="modal-body">
        <form action="" method="post">
          <center><input type="text" class="form-control" placeholder="Eski Şifre" required="" name="s_esk"/>
          <input style="margin-top: 10px;" type="text" class="form-control" max="8" placeholder="Yeni Şifre" required="" name="s_yen"/>
        </center>
      </div>
      <div class="modal-footer">
        <input type="button" class="btn btn-primary" value="Şifreyi Değiştir">
        </form>
     <button type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>

      </div>
    </div>
  </div>
</div>

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
