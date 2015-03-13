<? include("inc/conn.inc.php"); 
	verifyAcess("DES_UTIL_CONFIG","S");

	$Sql = " UPDATE RAR_CONFIG ";
	$Sql.= "        SET CONFIG_MM_LIMITECOLETA = " .$_POST['CONFIG_MM_LIMITECOLETA']. ",";
	$Sql.= "        CONFIG_FR_LIMITECOLETA = " .$_POST['CONFIG_FR_LIMITECOLETA']. "";
	$Stmt = mysql_query($Sql);
?>
<script language="javascript" type="text/javascript">
	alert("Configurações atualizadas com sucesso !");
	document.location.href = 'util_config.php';
</script>
