<?php  session_start(); session_unset();session_destroy(); include("inc/r.php");?>
 <link rel="stylesheet" href="net.css?<?php echo rand(1,1000); ?>" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
  
  
  
  <title>AVAPORT</title>
  


<center><span>Avaport &copy; <?php echo date("Y"); ?></span></center>

</div>




<h1>Giriş Yap!</h1>

<form method="POST" action="doLogin.php">
<input id="kns"  name="g_mail" type="email" placeholder="Eposta girin." required />
<input type="password"  name="g_sifre" placeholder="Şifre girin." />
<input type="submit"  value="Giriş Yap">

<a href="javascript:kayit();">Kayıt</a>
</form>
<hr>

<a href="javascript:oyunda_olan();">Aktif oyuncu : <?php    $ary = $redis->smembers("online_tr"); echo count($ary);  ?></a>
<a href="">Kayıtlı oyuncu : <?php echo $redis->get("uids") ; ?></a>

</div>
</div>


<h1>Kayıt!</h1>

<form  method="POST" action="kayit.php">
<input name="adsoyad" maxlength="10"   type="text" placeholder="Ad Soyad girin."  required />
<input name="eposta" type="email" placeholder="Eposta girin." required />
<input name="sifre" type="password" placeholder="Şifre girin." required  />
<select  name="cinsiyet">
 <option value="1">Erkek</option>
 <option value="2">Kadın</option>
 </select>
<input type="submit" value="Kayıt">

<a href="javascript:giris();" class="btn">< Geri Dön</a>
</form>
 
</div>

 


</div>
</div>


<div id="liste" class="kutu" style="display:none;">
<div class="ic_duzen" style="overflow-y: auto;
    max-height: 460px;">
 
<h1 style="    font-size: 24px;"><span style="color:white;">Oyuncular</h1>
 
<table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Oyuncu</th>
     
       <th scope="col">Ping</th>
    </tr>
  </thead>
  <tbody>
     <?php 
				
 
				
				 for ($x = 0; $x <= count($ary); $x+=1) {
					 
					 $c = $ary[$x];
					 $tr =  $redis->lrange("uid:$c:appearance" ,  0, 0)[0];
					 
 $rand = rand(10,50);
					 
					if($tr != null and $tr != "[TAG SILINDI]"){
					
					echo"<tr>";
					echo "<th scope='row'>".$c."</th>";
					echo "<td scope='row'>".strip_tags($tr)."</td>";
					echo "<td scope='row'>".$rand."ms</td>";
				    echo "</tr>";}
					 
				 }
				?>
      
    
  </tbody>
</table>

 <a href="javascript:kapat_oyunda();" style="margin-top: 10px;" class="btn">Kapat!</a>
</div>
</div>
<script>
function kayit() {
document.getElementById("giris").style.display = "none";
document.getElementById("kayit").style.display = "block";
}

function giris() {
document.getElementById("giris").style.display = "block";
document.getElementById("kayit").style.display = "none";
}


function oyunda_olan() {
document.getElementById("liste").style.display = "block";
document.getElementById("kapat").style.display = "none";
}

function kapat_oyunda() {
document.getElementById("liste").style.display = "none";
document.getElementById("kapat").style.display = "block";
}
</script>
 



 </div>