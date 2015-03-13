<? include("inc/conn.inc.php"); 
	
	$IDS = str_replace("\'","'",$_GET["IdDel"]);

	$Stmt = mysql_query("DELETE FROM rar_usuarioxcliente WHERE USUCLI_IDO IN (" .$IDS. ")");

	header("Location: pesq_usuarioxcliente.php?USUAR_IDO=" .$_GET['Usuar_Ido']);	
?>