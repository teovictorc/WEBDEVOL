<?
	//try {
		//$error = 'Erro encontrado';
		//throw new Exception($error);
		include("inc/conn_externa.inc.php");
		for($x = 0; $x < 10000000; $x++) {
			$sql = "insert into teste (teste) values ('".$x."')";
			$Stmt = mysql_query($sql);
			$x++;
			echo("X = ".$x."<br>");
		}
		
?>
