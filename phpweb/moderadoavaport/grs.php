<<form action="" id="member_signup" style="display:none;" method="POST" >

<input type="text" name="a_id"  value="abc"><br><br>
<input type="text" name="a_sfr" value="ava_1x"><br><br>
<input type="submit">
</form>

<script>
window.onload = function(){
  document.forms['member_signup'].submit();
}

</script>

<?php 

if($_POST["a_id"] == "abc"){
	
	if($_POST["a_sfr"] == "ava_1x"){
	
	 
	$_SESSION["idc"] = "yetkili";
	echo "<script>window.location.href='panel.php';</script>";
	
}

	
}


?>