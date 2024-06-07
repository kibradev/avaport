
<?php 
	 
		 $redis->sadd("uid:$yenikullanici:items", "boyHlwn3"); 
         $redis->rpush("uid:$yenikullanici:items:boyHlwn3", "cls" , 1); 
		 
		 $redis->sadd("uid:$yenikullanici:items", "boyHlwn23"); 
		 $redis->rpush("uid:$yenikullanici:items:boyHlwn23", "cls" , 1); 
		 
		 $redis->sadd("uid:$yenikullanici:items", "boyHlwn15"); 
		 $redis->rpush("uid:$yenikullanici:items:boyHlwn15", "cls" , 1); 
		 
         $redis->sadd("uid:$yenikullanici:items", "boyHlwn20"); 
		 $redis->rpush("uid:$yenikullanici:items:boyHlwn20", "cls" , 1); 
		 
		 
		 
		 $redis->sadd("uid:$yenikullanici:wearing", "boyHlwn3","boyHlwn23","boyHlwn15","boyHlwn20" );





?>