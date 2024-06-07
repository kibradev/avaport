<?php  session_start(); session_unset();session_destroy(); include("inc/r.php");?>

<!DOCTYPE html>
<html>
<head>
	<title>
		Avaport Türkiye
	</title>
	  <meta name="description" content="Avaport'a Hoşgeldiniz! Kaliteli Avataria Serveri">
  <meta name="keywords" content="HTML,PYTHON,PIP,CSS">
  <meta name="author" content="Emir Kibar">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;600;700&display=swap" rel="stylesheet">

</head>
<body>	
	<center><img src="https://i.hizliresim.com/hgyDYv.png" style="margin-top: 2%; width: 650px; height: 270px;" /></center>
	<center><h1><font style="font-weight: 600;">Avaport'a hoşgeldiniz. Toplam Oyuncu: <?php echo $redis->get("uids") ; ?></font><font color="#00ddff">       Sunucu hatalarını gidermek için çalışıyoruz. <br> En yakın zamanda hatalar giderilip düzenli oyun hizmetine geçeceğiz.
</font></h1></center>
<center><a href="/park.php"><button type="submit" for="gizli-checkbox" class="calma-sikerim">Avaport Oyna</button></a></center>
<!--<center><label for="gizli-checkbox" class="yarad"><u>Bilgilendirme Metni</u></label></center>-->
<input id="gizli-checkbox" type="checkbox"/>
<div class="cerceve">
  <div class="modal">
  	    <label for="gizli-checkbox" class="kapat">✖</label>

  	 <div class="fantezi">
   
    <center><h2>Avaport Bilgilendirme</h2></center>
</div>
<div class="icerik">
    <p>
      Avaport Türkiye Sunucusu İspanyol, Sunucu hatalarını gidermek için çalışıyoruz. En yakın zamanda hatalar giderilip düzenli oyun hizmetine
    </p></div>
    <center><a href="/oyna"><button type="button" class="devamke">Avaport'a devam et</button></a></center>
  </div>
</div>
	<style>
.yarad {
			    font-family: 'Rubik', sans-serif;
color: #fff;
font-weight: 500;
font-size: 25px;
position:relative;
top: 20px;
}
		.devamke {
			background-color: transparent;
			color: #00ddff;
			font-size: 20px;
		    font-family: 'Rubik', sans-serif;
		    font-weight: 500;
		    width: 250px;
		    height: 45px;
		    border: 2px solid #00ddff;
		    border-radius: 15px;
		    margin-top: 20px;

		}

		.devamke:hover {
			background-color: #00ddff;
			color: #fff;
			border: 2px solid #00ddff;
			transition: 0.4s;
		}
.fantezi {
	background-color: #00ddff;
	width: 100%;
	height: 50px;
	text-align: center;
	border-radius: 5px;


}
.icerik {
	background-color:#00ddff;
	width: 100%;
	height: 170px;
	text-align: center;
	border-radius: 5px;

}

p {
		font-family: 'Rubik', sans-serif;
		font-size: 20px;
		color: #fff;
		font-weight: 500;
		position:relative;
		top: 20px;

}
		input[type='checkbox']#gizli-checkbox{
 display:none;
}
.cerceve {
  background: rgba(5, 10, 30, 0.5);
  opacity:0;
  visibility:hidden;
  z-index: 99999;
  -moz-transition: all .2s ease-out;
  -webkit-transition: all .2s ease-out;
  -o-transition: all .2s ease-out;
  transition: all .2s ease-out;
}

.modal{
  background-color:#1b1f38;
  width: 45%;
  height: 60%;
  overflow: auto;
  margin: auto;
  position: absolute;
  border: 2px solid   #00ddff;
  top: 0; left: 0; bottom: 0; right: 0;
  border-radius:5px;
  padding:10px 15px;
}
 
.modal .kapat{
  float:right;
  color:#666;
  cursor:pointer;
}
input[type='checkbox']#gizli-checkbox:checked ~ .cerceve{
  position:absolute;
  z-index:9999;
  top:0;bottom:0;left:0; right:0;
  opacity:1;
  visibility:visible;
}
@media (max-width:1280px){.modal{width:70%; height:70%;}}
@media (max-width:768px){.modal{width:90%; height:90%;}}

		body {
			background-image: url("https://i.hizliresim.com/0m1tWA.png");
	-webkit-background-size: cover;
	-moz-background-size: cover;
	-o-background-size: cover;
	background-size: cover;
		

		}
.cemal {
	background: #3b3c3d;
width: 100%;
height: 700px;
    opacity: 0.4;
}

h1 {
	color: #fff;
	font-size: 20px;
		font-family: 'Rubik', sans-serif;
		font-weight: 400;
}

h2 {
	color: #fff;
	font-size: 25px;
		font-family: 'Rubik', sans-serif;
		font-weight: 500;
		text-align: center;
		margin-top: 50px;
		position:relative;
		top: 10px;



}
.calma-sikerim
{
	background-color: transparent;
	width: 350px;
	height: 45px;
	border: 2px solid #00ddff;
	border-radius: 15px;
	color: #00ddff;
	font-family: 'Rubik', sans-serif;
	font-size: 20px;
	font-weight: 500;



}

.calma-sikerim:hover {
	color: #000;
	transition: 0.4s;
	background: #00ddff;
	border: 2px solid #00ddff;
}

	</style>
</div>
</body>
</html>