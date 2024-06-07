<?php 
	 
		 $redis->sadd("uid:$yenikullanici:items", "boyTShrtHp"); 
         $redis->rpush("uid:$yenikullanici:items:boyTShrtHp", "cls" , 1); 
		 
		 $redis->sadd("uid:$yenikullanici:items", "boyGlssHp"); 
		 $redis->rpush("uid:$yenikullanici:items:boyGlssHp", "cls" , 1); 
		 
		 $redis->sadd("uid:$yenikullanici:items", "boyPntsHp"); 
		 $redis->rpush("uid:$yenikullanici:items:boyPntsHp", "cls" , 1); 
		 
         $redis->sadd("uid:$yenikullanici:items", "boyBtsHp"); 
		 $redis->rpush("uid:$yenikullanici:items:boyBtsHp", "cls" , 1); 
		 
		 $redis->sadd("uid:$yenikullanici:items", "boyErrHp"); 
		 $redis->rpush("uid:$yenikullanici:items:boyErrHp", "cls" , 1); 
		 
		 $redis->sadd("uid:$yenikullanici:wearing", "boyTShrtHp","boyGlssHp","boyPntsHp","boyBtsHp","boyErrHp");





?>