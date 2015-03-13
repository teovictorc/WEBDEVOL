<? include("inc/conn.inc.php"); 
	verifyAcess("ARZ_RECEBTOAREZZO","S");
	$Sql = "UPDATE rar_prenf SET PRENF_DATA_RECEBTO_AREZZO = now() WHERE PRENF_NUMPRENF IN (" .$_GET['Ids']. ")";
	$Stmt = mysql_query($Sql);
	header("Location: pesq_receb_arrezo.php");
?>