<?php 
session_start();

 

include("d.php");


include("../r.php");


if($_POST["uid"] == 1){$uid = 0;}else{$uid = $_POST["uid"];}

//if($_POST["uid"] == 1149){$uid = 0;}


 
if($_POST["uid"] == null){echo "<script>window.location.href='panel.php?durum=shpb';</script>";}
?>
<link rel="stylesheet" type="text/css" href="../Bootstrap/dist/css/bootstrap-reboot.css">
	<link rel="stylesheet" type="text/css" href="../Bootstrap/dist/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../Bootstrap/dist/css/bootstrap-grid.css">

	<!-- Main Styles CSS -->
	<link rel="stylesheet" type="text/css" href="../css/main.css">
	<link rel="stylesheet" type="text/css" href="../css/fonts.min.css">
	
	
	<br>
	 <div class="ui-block">
		 
				<div class="ui-block-title">
					<h6 class="title">Sohbet geçmişi</h6>
				</div>
				<div class="ui-block-content">
				 <style>
* {
  box-sizing: border-box;
}

#myInput {
  background-image: url('/css/searchicon.png');
  background-position: 10px 10px;
  background-repeat: no-repeat;
  width: 100%;
  font-size: 16px;
  padding: 12px 20px 12px 40px;
  border: 1px solid #ddd;
  margin-bottom: 12px;
}

#myTable {
  border-collapse: collapse;
  width: 100%;
  border: 1px solid #ddd;
  font-size: 18px;
}

#myTable th, #myTable td {
  text-align: left;
  padding: 12px;
}

#myTable tr {
  border-bottom: 1px solid #ddd;
}

#myTable tr.header, #myTable tr:hover {
  background-color: #f1f1f1;
}
</style>
<h1><?php
 

	
	
$redis = new Redis(); 
 $redis->connect("127.0.0.1", 6379); 
 
 
$llg = $redis->lrange("uid:$uid:appearance" ,  0, -1);
$oyuncu_ismi = $llg[0]; 
 
 
 echo "<h1>".$oyuncu_ismi."</h1>";
?>
					<!-- W-Personal-Info -->
	<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Ada göre ara.." title="Type in a name">

<table id="myTable">
  <tr class="headerr">
   <th style="width:5%;">MESAJ</th>
   
 
  </tr>
  
 
 	 
  <?php 
  
  error_reporting(0);
  
  
 if($uid != 10){
   $msj = $redis->llen("uid:$uid:mesaj");  
    
 $llg = $redis->lrange("uid:$uid:mesaj" ,  0, -1);}else { $uid = null;}
  for ($x = 0; $x <= $msj; $x+=1) {
   
   
   echo "<tr><td>".$cg = $llg[$x]; 
   echo "</td></tr>"; 
   
  }
   
 
  
  ?>
   
     
  
  
   
</table>

<script>
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>
					
	
				</div>
			</div>

