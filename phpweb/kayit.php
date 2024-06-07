 <?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

if($_POST["adsoyad"] != null){
	include("inc/r.php");
 
 $adsoyad  = $_POST["adsoyad"];
 $eposta  = $_POST["eposta"];
 $sifre  = $_POST["sifre"];

 $cinsiyet  = $_POST["cinsiyet"];



 	 

 function seo($text) {
    $find = array('Ç', 'Ş', 'Ğ', 'Ü', 'İ', 'Ö', 'ç', 'ş', 'ğ', 'ü', 'ö', 'ı', '+', '#');
    $replace = array('c', 's', 'g', 'u', 'i', 'o', 'c', 's', 'g', 'u', 'o', 'i', 'plus', 'sharp');
    $text = strtolower(str_replace($find, $replace, $text));
    $text = preg_replace("@[^A-Za-z0-9\-_\.\+]@i", ' ', $text);
    $text = trim(preg_replace('/\s+/', ' ', $text));
    $text = str_replace(' ', '-', $text);

    return $text;
}








  $username  = seo($adsoyad);

 $redis->get("uids");
$v = 0 ;
 
	for ($x = 0; $x <= 10; $x++) {
    
     
	 
 
		  
		
		if($redis->get("uid:$x:mail") == $eposta){
			echo "YAYGIN EPOSTA";
			
			$v = 1;
			
			break;
	     } 





	 }
 
//if(strlen($adsoyad) > 12){$v = 1;}
//if($adsoyad == Null){$v = 1;}


if($v == 0){include("inc/devam.php");}

if($v == 1){header("location: hata.php");}



}

 ?>