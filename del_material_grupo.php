<? include("inc/conn.inc.php"); 

	$IDS = str_replace("\'","'",$_GET["IdDel"]);
	$Sql= "select * from rar_servico_solicitacaomaterial where SERSM_MATERG_IDO in (" .$IDS. ")";
	$Stmt = mysql_query($Sql);
	if(!$Rs = mysql_fetch_assoc($Stmt)) {
		$Stmt = mysql_query("DELETE FROM rar_material_grupo WHERE materg_ido IN (" .$IDS. ")");
		header("Location: pesq_material_grupo.php");
	}else{
		header("Location: pesq_material_grupo.php?Erro=1");	
	}
?>