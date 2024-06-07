<?php 


include("r.php");
$i = $redis->incr("p"); 

$promo_kod = $_POST["p_kod"];
$mesaj = $_POST["p_mesaj"];
$tip = $_POST["p_tip"];
$adet = $_POST["p_adet"];

 $redis->del("promo_kod"); 
 $redis->del("promo_kul"); 
 $redis->rpush("promo_kul", 0); 
$redis->rpush("promo_kod", $promo_kod, $i, "$mesaj" , "$tip" , $adet); 

 echo "<script>window.location.href='panel.php?durum=p&pm=$promo_kod';</script>";








?>