			 <?php 
				 
				 
				 
				 
	$x = $_POST["uid"];
$hrt = $_POST["hrt"];
$crt = $_POST["crt"];
$exp = $_POST["exp"];
$vexp = $_POST["vexp"];
$rpt = $_POST["rpt"];	
$gld = $_POST["gld"];	
$slvr = $_POST["slvr"];	
 
if($_POST["uid"] != null){
 include("r.php");
$redis->set("uid:$x:ronfor", $hrt);
$redis->set("uid:$x:crt", $crt);
$redis->set("uid:$x:exp", $exp);
$redis->set("uid:$x:vexp", $vexp);
$redis->set("uid:$x:rpt", $rpt);
$redis->set("uid:$x:gld", $gld);
$redis->set("uid:$x:slvr", $slvr);
 
 echo "<script>window.location.href='panel.php?durum=k_b';</script>";
} else { echo "<script>window.location.href='panel.php?durum=k_h';</script>";}

				 
				 
				 
				 
				 ?>