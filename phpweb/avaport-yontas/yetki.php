<?php 

 
session_start();

 

include("d.php");


 
echo $x = $_POST["uid"]; 

echo $yetki = $_POST["yetki"];

if($_POST["uid"] != null){
 include("r.php");
$redis->set("uid:$x:role", $yetki);
 echo "<script>window.location.href='panel.php?durum=yetki_basar';</script>";
}else {
  echo "<script>window.location.href='panel.php?durum=yetki_hata';</script>";
}


?>