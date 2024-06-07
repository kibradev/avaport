<form action="" method="POST">
<br>Kod<br><br>
<input name="kod" type="text">
<br>Başlık<br><br>
<input name="ad" type="text">
<br>Resim<br><br>
<input name="img" type="text">
<br>Link<br><br>
<input name="link" type="text">
<br>İçerik<br><br>
<input name="icerik" type="text" ><br>
<input type="submit">

</form>

<?php 


if($_POST["kod"] != null){
   $kod = $_POST["kod"];
   
   
   include("r.php");
   $redis->sadd("offers", $kod);
   $redis->rpush("offers:$kod", $_POST["kod"],$_POST["ad"],$_POST["img"],$_POST["link"],$_POST["icerik"]);
 
}







?>