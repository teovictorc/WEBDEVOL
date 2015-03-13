<? include("inc/conn.inc.php"); 
	
	$IDS = str_replace("\'","'",$_GET["IdDel"]);
	
	$Sql = "DELETE FROM RAR_ANJO_COORDENADOR WHERE ANJCO_IDO IN (" .$IDS. ")";
	$Stmt = mysql_query($Sql);

	header("Location: pesq_anjoxcoordenador.php?USUAR_IDO=" .$_GET['Usuar_Ido']);	
?>