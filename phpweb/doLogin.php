<?php 

 
 if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}
 



include("bakimci.php");
$masey_ferguson = "?";
if($bakim == True){$masey_ferguson ="?bakim=False";}
			include("inc/r.php");
	$yenikullanici = $redis->get("uids");  
 
	 for ($x = 0; $x <= $yenikullanici; $x+=1) {
		 
		if($redis->get("uid:$x:mail") == $_POST["g_mail"]){
			 
			 $id = $x;
			 break;
	    }  
		 
	 }
	 
	 if($id != null){
		 
		 if($redis->get("uid:$x:panelsifre") == $_POST["g_sifre"]){
			 echo  $sonuc  = "basarili"; 
			 session_start();
    $_SESSION["sifre"] = $_POST["g_sifre"];
	$_SESSION["id"] = $x;
			 
			 $redis->set("uid:$x:ipadress", $ip);
header("location: oyun.php$masey_ferguson");
		 echo "<script>window.location.href='oyun.php$masey_ferguson';</script>";}else{ echo "<script>window.location.href='park.php?hata=501';</script>";}
	 }else {header("location: park.php"); echo "<script>window.location.href='park.php';</script>";}
			 
 
?>