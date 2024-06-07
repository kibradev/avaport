 

<style>


.kutu {
	
width: 700px;
    background: white;
    border-radius: 2px;
    height: 500px;
    text-align: center;
    color: black;
    padding: 5px;
    font-family: monospace;
}


.btn {
	    background: black;
    padding: 5px;
    color: white;
    text-decoration: none;
    font-size: 24px;
    display: block;
	border:none;border:5px solid gray;
}
</style>
<center>
<div class="kutu">

<h1 >MODERATÖR</h1>


<a class="btn" href="">BANLI LİSTESİ</a><br><a class="btn" href="">OYUN İÇİ ŞİKAYET</a>
<br>
<form action="" method="POST"><a style="float:left;" class="btn" href="#">BAN KALDIR - ID:</a><input style="float:left;" name="bank" class="btn" value="1" type="number"><input style="float:left;" class="btn" type="submit"></form>
<?php


if($_POST["bank"] != null){ $i = $_POST["bank"]; $redis->del("uid:$i:banned");}



 ?>
</div>