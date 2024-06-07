<?php 
$yenikullanici = $redis->incr("uids");  

 
 if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}



	 $pi = 31415926;

$sonucx = $yenikullanici *	 $pi;



     $redis->set("auth:$sonucx", "$yenikullanici"); 
     $redis->set("uid:$yenikullanici:slvr", 100); 
     $redis->set("uid:$yenikullanici:gld", 100); 
     $redis->set("uid:$yenikullanici:enrg", 100); 
	 $redis->set("uid:$yenikullanici:rpt", 0); 
	 $redis->set("uid:$yenikullanici:ronfor", 0); 
	 $redis->set("uid:$yenikullanici:crt", 10); 
	  $redis->set("uid:$yenikullanici:hrt", 1); 
	 $redis->set("uid:$yenikullanici:act", 1); 
	 if($cinsiyet == 1){$exp = 36309;}
	 if($cinsiyet == 2){$exp = 44247;}
	 
     $redis->set("uid:$yenikullanici:exp", $exp); 
	 $redis->set("uid:$yenikullanici:vexp", 0); 
     $redis->set("uid:$yenikullanici:emd", 0); 
	 $redis->set("uid:$yenikullanici:gameid", $sonucx); 
     $redis->set("uid:$yenikullanici:lvt", 0); 
	 $redis->set("uid:$yenikullanici:actrt", 0); 
	 $redis->set("uid:$yenikullanici:mail", "$eposta"); 
	 $redis->set("uid:$yenikullanici:adiniz", "$adsoyad"); 
	 
	 $redis->set("uid:$yenikullanici:username", "$username"); 
	 $redis->set("uid:$yenikullanici:sifre", "$sonucx"); 
	 $redis->set("uid:$yenikullanici:panelsifre", "$sifre"); 
	 $redis->set("uid:$yenikullanici:ipadress", $ip);
     $redis->set("uid:$yenikullanici:ip_adress", "$ip"); 
     $redis->sadd("uid:$yenikullanici:items", "blackMobileSkin"); 
     $redis->rpush("uid:$yenikullanici:items:blackMobileSkin", "gm" , 1); 
	 
	 $redis->sadd("uid:$yenikullanici:items", "blueMobileSkin"); 
     $redis->rpush("uid:$yenikullanici:items:blueMobileSkin", "gm" , 1); 
	 $redis->sadd("uid:$yenikullanici:items", "greenMobileSkin"); 
     $redis->rpush("uid:$yenikullanici:items:greenMobileSkin", "gm" , 1); 
	 $redis->sadd("uid:$yenikullanici:items", "pinkMobileSkin"); 
     $redis->rpush("uid:$yenikullanici:items:pinkMobileSkin", "gm" , 1); 
	 $redis->sadd("uid:$yenikullanici:items", "purpleMobileSkin"); 
     $redis->rpush("uid:$yenikullanici:items:purpleMobileSkin", "gm" , 1); 
	 $redis->sadd("uid:$yenikullanici:items", "whiteMobileSkin"); 
     $redis->rpush("uid:$yenikullanici:items:whiteMobileSkin", "gm" , 1); 
	 $redis->sadd("uid:$yenikullanici:items", "yellowMobileSkin"); 
     $redis->rpush("uid:$yenikullanici:items:yellowMobileSkin", "gm" , 1); 
	 
	 	 $redis->sadd("uid:$yenikullanici:items", "angelMobileAccessory"); 
     $redis->rpush("uid:$yenikullanici:items:angelMobileAccessory", "gm" , 1); 
	 
	  $redis->sadd("uid:$yenikullanici:items", "bowMobileAccessory"); 
     $redis->rpush("uid:$yenikullanici:items:bowMobileAccessory", "gm" , 1); 
	 
	  $redis->sadd("uid:$yenikullanici:items", "devilMobileAccessory"); 
     $redis->rpush("uid:$yenikullanici:items:devilMobileAccessory", "gm" , 1); 
	 
	  $redis->sadd("uid:$yenikullanici:items", "catEarsMobileAccessory"); 
     $redis->rpush("uid:$yenikullanici:items:catEarsMobileAccessory", "gm" , 1); 
	 
	  $redis->sadd("uid:$yenikullanici:items", "mouseEarsMobileAccessory"); 
     $redis->rpush("uid:$yenikullanici:items:mouseEarsMobileAccessory", "gm" , 1); 
	 
	  $redis->sadd("uid:$yenikullanici:items", "starMobileAccessory"); 
     $redis->rpush("uid:$yenikullanici:items:starMobileAccessory", "gm" , 1); 
	 
	  $redis->sadd("uid:$yenikullanici:items", "tentaclesMobileAccessory"); 
     $redis->rpush("uid:$yenikullanici:items:tentaclesMobileAccessory", "gm" , 1); 
 
  $redis->sadd("uid:$yenikullanici:items", "steampunkMobileAccessory"); 
     $redis->rpush("uid:$yenikullanici:items:steampunkMobileAccessory", "gm" , 1); 


  $redis->sadd("uid:$yenikullanici:items", "stopSignMobileAccessory"); 
     $redis->rpush("uid:$yenikullanici:items:stopSignMobileAccessory", "gm" , 1); 
	 
	   $redis->sadd("uid:$yenikullanici:items", "totemMobileAccessory"); 
     $redis->rpush("uid:$yenikullanici:items:totemMobileAccessory", "gm" , 1); 
	 
	   $redis->sadd("uid:$yenikullanici:items", "ghostMobileAccessory"); 
     $redis->rpush("uid:$yenikullanici:items:ghostMobileAccessory", "gm" , 1); 
	 
     $redis->sadd("rooms:$yenikullanici", "livingroom"); 
     $redis->rpush("rooms:$yenikullanici:livingroom", "#livingRoom" , 1); 
	 
	 
	 	 $redis->sadd("rooms:$yenikullanici:livingroom:items", "rtrCfDr_4", "carLtsRd_30525113", "rtrCfFlr_13103963","rtrCfWll_40780253","rtrCfWll_40780252","rtrCfWnd_52102488","rtrCfWnd_99770419","rtrCfWnd_71623459"); 
     $redis->rpush("rooms:$yenikullanici:livingroom:items:rtrCfWll_40780253", 13.0,0.0,0.0,5); 
	 $redis->rpush("rooms:$yenikullanici:livingroom:items:rtrCfWll_40780252", 0.0, 0.0 , 0.0, 3); 
	 $redis->rpush("rooms:$yenikullanici:livingroom:items:rtrCfFlr_13103963", 0.0, 0.0 , 0.0, 5); 
	 $redis->rpush("rooms:$yenikullanici:livingroom:items:rtrCfDr_4", 3.0, 0.0 , 0.0, 3, "outside"); 
	 
	 $redis->rpush("rooms:$yenikullanici:livingroom:items:rtrCfWnd_52102488", 12.95, 1.421875 , 1.5, 5 ); 
	 $redis->rpush("rooms:$yenikullanici:livingroom:items:rtrCfWnd_99770419", 7.53125, 0, 1.5, 3 ); 
	 $redis->rpush("rooms:$yenikullanici:livingroom:items:rtrCfWnd_71623459", 12.95, 6.9375 , 1.5, 5 ); 
	 $redis->rpush("rooms:$yenikullanici:livingroom:items:carLtsRd_30525113", 5, 3 , 0, 3 ); 
	 
	 
 
	 $redis->lpush("uid:$yenikullanici:appearance", 0,1,0,1,0,1,0,1,0,rand(0,27),rand(0,25),1, 0, 0, 0, rand(0,16),  rand(0,10), rand(0,20), rand(0,27), rand(0,24),rand(0,27),rand(0,100),$cinsiyet, 0 , $username); 
	 if($cinsiyet == 1){
	

	
	
	
	         $e = rand(1,1);
             include("cns/erkek/$e.php");
			 
			 
	 }
	 if($cinsiyet == 2){
		 
		   $k = rand(1,1);
           include("cns/kiz/$k.php");
		 
	 }
   
    




 foreach (range(1, 6) as $number) {
      $number;
	    $redis->sadd("rooms:$yenikullanici", $number); 
	    $redis->rpush("rooms:$yenikullanici:$number", "Oda $number" , 2); 
}




$_SESSION["sifre"] = $sifre;
$_SESSION["id"] = $yenikullanici;
header("location: oyun.php");




?>