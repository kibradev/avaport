<?php

include("r.php");


include("bakimci.php");




 if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}

 
 
$err = null;
$v = $redis->smembers("aypi");

  for ($x = 0; $x <= count($v); $x+=1) {

         // echo  $v[$x]."<br>";
		 
		 if($ip == $v[$x]){$err = "ban"; break;}
		  
		  
  }
if($bakim != False){ 
  if($err == null){include("anapage.php");}
  if($err == "ban"){include("inc/err.php");}}else {include("bakim.php");}

?>