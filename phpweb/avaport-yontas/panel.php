<?php 
session_start();

 
include("r.php");
include("d.php");

?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
	
	<br>
	
<script>
$(document).ready(function(){
 
  <?php if($_GET["durum"] != null){echo '$("#myModal").modal();';} ?> 
   
});
</script>
<div class="jumbotron">
  <h1 class="display-4">Kullanıcı Ayarları</h1>
  <hr class="my-4">
  <form action="durum.php"  method="POST">
  <input type="text" name="uid" class="form-control" placeholder="Kullanıcı ID" style="width: 250px;"/>
  <input class="btn btn-danger" style="margin-top: 10px;" value="Kullanıcıyı Bul" type="submit" class="btn btn-danger"></form>
  </p>
</div>
	<div id="myModal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Durum</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h3><?php 
		$q = $_GET["durum"];
		$pm = $_GET["pm"];
		
		if($q == "yetki_basar"){echo "Yetki verme başarılı.";}
		if($q == "yetki_hata"){echo "Yetki verme sırasında hata!";}
		
		if($q == "k_b"){echo "Kullanıcı güncellemeri başarılı.";}
		if($q == "k_h"){echo "Kullanıcı güncellemeri yapılırkan bir hata meydana geldi.";}
		if($q == "shpb"){echo "Sohbet geçmişi görüntülenemedi.";}
		if($q == "p"){echo "OLUŞTURULDU<BR> KOD:  $pm";}
		
		
		
		?></h3>
      </div>
      <div class="modal-footer">
  
        <button type="button" style="width:100%;" class="btn btn-secondary" data-dismiss="modal">Tamam</button>
      </div>
    </div>
  </div>
</div>
	
	
<div class="jumbotron">
  <h1 class="display-4">Kullanıcı Yetki Ayarları</h1>
  <hr class="my-4">
  <form action="yetki.php"  method="POST">
  <input type="text" name="uid" class="form-control" placeholder="Kullanıcı ID" style="width: 250px;"/>
  <select name="yetki" style="margin-top: 10px;" class="form-control">
  	<option value="0" selected>USER</option>
							 <option value="1">Denemelik Moderatör</option>
							 <option value="2">Moderatör</option>
							 <option value="3">Baş Moderatör</option>
							 <option value="4">Admin</option>
							 <option value="5">Gizli Admin</option>
							 </select>
  <input class="btn btn-danger" style="margin-top: 10px;" value="Yetkiyi Yükle" type="submit" class="btn btn-danger"></form>
  							 <h3><!--?php echo Henüz bir biyografi girmedin.; ?--></h3><br> <a href="ayarlar.php?ayar=profil"><!--?php echo Biyografi güncelle; ?--></a>						 

  </p>
</div>
	
	 

			
					<?php 
					
					
					$smembers = $redis->smembers("online_tr");
					
			 
				    for ($x = 0; $x <= count($smembers); $x+=1) {
						
						$w = $smembers[$x];
						 echo   $redis->lrange("uid:$w:appearance" ,  0, 0)[0]."    |  ID : $w <br>  ";
					}
					?>
					
						ONLINE KULLANICILAR (UV) :<BR>
					<?php 
					
					
					$smembers1 = $redis->smembers("online_uv");
					
			 
				    for ($x = 0; $x <= count($smembers1); $x+=1) {
						
						$w1 = $smembers1[$x];
												 echo   $redis->lrange("uid:$w1:appearance" ,  0, 0)[0]."    |  ID : $w <br>  ";

					}
					?>
						
				<br>	Yetkili listesi : <br>
					<?php 
					
					
					
					
						  $yenikullanici = $redis->get("uids");  
	         for ($x = 0; $x <= $yenikullanici; $x+=1) { 
			 
			 if($redis->get("uid:$x:role") > 0){
				 
				 
				 
    
 $llg = $redis->lrange("uid:$x:appearance" ,  0, 0)[0];
				 echo "$x $llg<br>";
				  
				 
			 }
			 
			 }
					
					?>
				 
				</div>
			</div>
			
			<!---
			<div class="ui-block">
		 
				<div class="ui-block-title">
					<h6 class="title">Sohbet geçmişi</h6>
				</div>
				<div class="ui-block-content">

					
					
					<ul class="widget w-personal-info item-block">
						<li>
							 
							 <form action="sohbet.php"  method="POST">
							 <h6 class="title">Kullanıcı id </h6>
							 <input tye="text" name="uid" placeholder="kullanıcı id"> 
							 
							 <input value="Sohbet geçmişini gör" type="submit" class="btn btn-danger"></form>
							 <h3><!--?php echo Henüz bir biyografi girmedin.; ?--></h3><br> <a href="ayarlar.php?ayar=profil"><!--?php echo Biyografi güncelle; ?</a>						 
						</li>
						 
					</ul>
					
				 
				</div>
			</div>
			<!---
				<div class="ui-block">
		 
				<div class="ui-block-title">
					<h6 class="title">Promo manager</h6>
				</div>
				<div class="ui-block-content">

					
					<ul class="widget w-personal-info item-block">
						<li>
							 
							 <form action="promo.php"  method="POST">
							 <h6 class="title">Promo kod :</h6>
							 <input tye="text" name="p_kod" value="AVATR_<?php echo   rand(0,1000); ?>"> 
							 
							 <h6 class="title">Promo Mesaj :</h6>
							 <input tye="text" name="p_mesaj" value="TEBRİKLER .......  KAZANDINIZ!"> 
							  <h6 class="title">Promo Tip :</h6><br>
<select name="p_tip">

<option value="crt">IMAJ</option>
<option value="rpt">ITIBAR</option>
<option value="gld">GOLD</option>
<option value="slvr">SILVER</option>
</select>
  <h6 class="title">ADET :</h6>
   <input type="number" id="quantity" name="p_adet" min="1" ><br>
							 <input value="OLUŞTUR" type="submit" class="btn btn-danger"></form>
							 <h3>?php echo Henüz bir biyografi girmedin.; ?</h3><br> <a href="ayarlar.php?ayar=profil">?php echo Biyografi güncelle; ?</a>						 
						</li>
						 
					</ul>
					
				 
				</div>
			</div>
			--->