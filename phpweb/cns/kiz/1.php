<?php 
	 
		 $redis->sadd("uid:$yenikullanici:items", "girlGlssHp"); 
         $redis->rpush("uid:$yenikullanici:items:girlGlssHp", "cls" , 1); 
		 
		 $redis->sadd("uid:$yenikullanici:items", "girlTShrtHp"); 
		 $redis->rpush("uid:$yenikullanici:items:girlTShrtHp", "cls" , 1); 
		 
		 $redis->sadd("uid:$yenikullanici:items", "girlPntsHp"); 
		 $redis->rpush("uid:$yenikullanici:items:girlPntsHp", "cls" , 1); 
		 
         $redis->sadd("uid:$yenikullanici:items", "girlErrHp"); 
		 $redis->rpush("uid:$yenikullanici:items:girlErrHp", "cls" , 1); 
		 
		 $redis->sadd("uid:$yenikullanici:items", "girlCtHp"); 
		 $redis->rpush("uid:$yenikullanici:items:girlCtHp", "cls" , 1); 
		 
         $redis->sadd("uid:$yenikullanici:items", "girlHtHp"); 
		 $redis->rpush("uid:$yenikullanici:items:girlHtHp", "cls" , 1); 
         
		 $redis->sadd("uid:$yenikullanici:items", "girlBtsHp"); 
		 $redis->rpush("uid:$yenikullanici:items:girlBtsHp", "cls" , 1); 
		 
		 $redis->sadd("uid:$yenikullanici:wearing", "girlGlssHp","girlTShrtHp","girlPntsHp","girlErrHp","girlCtHp","girlHtHp","girlBtsHp");





?>