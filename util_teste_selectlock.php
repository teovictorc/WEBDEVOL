<?
	//try {
		//$error = 'Erro encontrado';
		//throw new Exception($error);
		include("inc/conn_externa.inc.php");
		$Sql = " select * from teste ";
		$Stmt = mysql_query($Sql);
		while($Rs = mysql_fetch_assoc($Stmt)){
			echo("X = ".$Rs["teste"]."<br>");
		}
		
?>
