<? include("inc/conn.inc.php"); 
	
	$IDS = str_replace("\'","'",$_GET["IdDel"]);
	$Sql = "DELETE FROM rar_defeito_subgrupo WHERE DEFEIS_IDO IN (" .$IDS. ")";
	$Stmt = mysql_query($Sql);
	header("Location: pesq_defeitos_subgrupo.php");	
?>