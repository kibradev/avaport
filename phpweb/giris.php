
<?php $ip = $_SERVER['HTTP_HOST'];   require_once("inc/r.php"); session_start(); $id = $_SESSION["id"];?>
<form style="display:none;" id="giris" action="<?php echo  "//$ip:27015/login" ?>" method="POST" >
<input type="text" name="login" value="<?php echo $id; ?>" >
<input type="text" name="password" value="<?php echo $redis->get("uid:$id:sifre"); ?>" >
<input type="submit">

</form>
<script>
window.onload = function(){
  document.forms['giris'].submit();
}
</script>