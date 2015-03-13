<? include("inc/conn.inc.php"); 
	
	$IDS = str_replace("\'","'",$_GET["IdDel"]);
	$Sql= "select * from rar_fabrica where fabri_agent_ido in (" .$IDS. ")";
	$Stmt = mysql_query($Sql);
	if(!$Rs = mysql_fetch_assoc($Stmt)) {
		$Stmt = mysql_query("DELETE FROM rar_agente WHERE agent_ido IN (" .$IDS. ")");
		header("Location: pesq_agente.php");
	}else{
		header("Location: pesq_agente.php?Erro=1");	
	}
?>