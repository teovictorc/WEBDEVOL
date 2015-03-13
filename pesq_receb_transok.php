<? include("inc/conn.inc.php");
	verifyAcess("TRANS_CONFTRANSCONT","S");
	$Sql = "UPDATE RAR_PRENF SET PRENF_DATA_RECEBTO_COLETA = now() WHERE PRENF_NUMPRENF IN (" .$_GET['Ids']. ")";
	$Stmt = mysql_query($Sql);
	header("Location: pesq_receb_trans.php?Ordem=".$_GET['Ordem']."&Categoria=".$_GET['Categoria']);
?>