<?php 
session_start();

 

include("d.php");


include("../r.php");


if($_POST["uid"] != 1){$uid = $_POST["uid"];}



 
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
</head>
<body>
 <a href="memberpage.php" class="btn">Geri</a>
<h2>ID GİR OYUNCU BİLGİLERİNİ GÖR</h2> 
 <center>
<?php
 $input = $_POST['id'];    

	
	
$redis = new Redis(); 
 $redis->connect("127.0.0.1", 6379); 
 
 
$llg = $redis->lrange("uid:$input:appearance" ,  0, -1);
$oyuncu_ismi = $llg[0]; 
 
 
 echo "<h1>".$oyuncu_ismi." ";
?>
<span style="color:red;">Kullanıcısının mesaj geçmişi</span></h1>
<html>
<body>    
   
</body>
</html>  
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
</head>
<body>
 <a href="memberpage.php" class="btn">Geri</a>
<h2>Oyuncular</h2> 

<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Ada göre ara.." title="Type in a name">

<table id="myTable">
  <tr class="header">
   <th style="width:5%;">İSİM</th>
   <th style="width:5%;">ID</th>
   <th style="width:5%;">MESAJ</th>
   
 
  </tr>
  
 
 	 
  <?php 
  
  error_reporting(0);
  
   $yen = $redis->get("uids"); 
 
  
    
  
  for ($x = 0; $x <= $yen; $x+=1) {
    $msj = $redis->llen("uid:$x:mesaj");  
    $llg = $redis->lrange("uid:$x:mesaj" ,  0, -1);
	for ($xc = 0; $xc <= $msj; $xc+=1) {
		if($llg[$xc] != null){
			
		$iksce = $redis->lrange("uid:$x:appearance" ,  0, 0);
		$WG = implode(",", $iksce);

		echo "<tr><td>$WG</td><td>$x</td><td>".$cg = $llg[$xc]; 
		echo "</td></tr>";}
	}
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

