<? include("inc/conn.inc.php");
	verifyAcess("TRANS_COLETACLIENTE","S");
	$Sql = "UPDATE rar_prenf SET PRENF_DATA_COLETA = now() WHERE PRENF_NUMPRENF IN (" .$_GET['Ids']. ")";
	$Stmt = mysql_query($Sql);
	header("Location: pesq_conf_coleta.php?Ordem=".$_GET['Ordem']."&Categoria=".$_GET['Categoria']);
?>