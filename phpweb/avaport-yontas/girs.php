<?php 

session_start();
session_unset();





 


?>
<form action="" method="POST" >

<input type="text" name="a_id"><br><br>
<input type="text" name="a_sfr"><br><br>
<input type="submit">
</form>


<?php 

if($_POST["a_id"] == "Mahura2004"){
	
	if($_POST["a_sfr"] == "Mahura2004"){
	
	 
	$_SESSION["idc"] = "yetkili";
	echo "<script>window.location.href='panel.php';</script>";
	
}

	
}


?>