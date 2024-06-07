<?php 
session_start();

 

include("d.php");


include("../r.php");



 $uid = $_POST["uid"]; 

//$uid = $_POST["uid"];
 
if($_POST["uid"] == null){echo "<script>window.location.href='panel.php?durum=shpb';</script>";}
?>
<link rel="stylesheet" type="text/css" href="../Bootstrap/dist/css/bootstrap-reboot.css">
	<link rel="stylesheet" type="text/css" href="../Bootstrap/dist/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../Bootstrap/dist/css/bootstrap-grid.css">

	<!-- Main Styles CSS -->
	<link rel="stylesheet" type="text/css" href="../css/main.css">
	<link rel="stylesheet" type="text/css" href="../css/fonts.min.css">
	
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

	<br>





  </p>
</div>
	 <div class="ui-block">
		 
				<div class="ui-block-title">
				</div>
				<div class="ui-block-content">

					<!-- W-Personal-Info -->
					
					<ul class="widget w-personal-info item-block">
						<li>
							 <h1>İsim: <?php echo $redis->lrange("uid:$uid:appearance", 0 ,0)[0];  ?> </h1>
							 <form action="gnc.php"  method="POST">
							  <h6>ID</h6>
							 <input tye="text" name="uid" style="color: #000; display:none;" value="<?php echo $uid;  ?>"> 
							 <h6>Konfor</h6>
							 <input tye="text" style="margin-top: 10px;" name="hrt" value="<?php echo $redis->get("uid:$uid:ronfor");  ?>"> 
							 <h6>İmaj</h6>
							 <input tye="text" style="margin-top: 10px;" name="crt"  value="<?php echo $redis->get("uid:$uid:crt");  ?>"> 
							 <h6>Level xp</h6>
							 <input tye="text" style="margin-top: 10px;" name="exp"  value="<?php echo $redis->get("uid:$uid:exp");  ?>"> 
							 <h6>Vip xp</h6>
							 <input tye="text" style="margin-top: 10px;" name="vexp"  value="<?php echo $redis->get("uid:$uid:vexp");  ?>"> 
							 
							 <h6>İtibar (AVAMENS)</h6>
							 <input tye="text" name="rpt"  value="<?php echo $redis->get("uid:$uid:rpt");  ?>"> 
							  <h6>Gold  </h6>
							 <input tye="text" name="gld"  value="<?php echo $redis->get("uid:$uid:gld");  ?>"> 
							  <h6>Silver  </h6>
							 <input tye="text" name="slvr"  value="<?php echo $redis->get("uid:$uid:slvr");  ?>"> <br>
							 <input value="Güncelle" class="btn btn-primary" type="submit"></form>
							 <h3><!--?php echo Henüz bir biyografi girmedin.; ?--></h3><br> <a href="ayarlar.php?ayar=profil"><!--?php echo Biyografi güncelle; ?--></a>
<?php echo "IP :".$redis->get("uid:$uid:ipadress")."<br>";  ?>		
 <?php echo "EPOSTA :".$redis->get("uid:$uid:mail")."<br>";  ?>	
<?php echo "ŞİFRE :".$redis->get("uid:$uid:panelsifre");  ?>								 
						</li>
						 
					</ul>
					
	
				</div>
			</div>

