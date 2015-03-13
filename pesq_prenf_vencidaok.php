<? include("inc/conn.inc.php"); 
	verifyAcess("ADMV_INATIVAPRENF","S");
	
	$Sql = "UPDATE rar_lancamento SET LANCA_STATUS = 'I' ";
	$Sql.= " WHERE LANCA_NUMRAR IN (";
	$Sql.="                         SELECT LANCA_NUMRAR ";
	$Sql.="                           FROM rar_prenf_item ";
	$Sql.="                          WHERE PRENFI_NUMPRENF IN (" .$_GET['Ids']. ") ";
	$Sql.="                         )";
	$Stmt = mysql_query($Sql);
	
	$Sql = "UPDATE rar_prenf SET PRENF_STATUS = 'I', ";
	$Sql.= "                     PRENF_INATIVADO_DATA = now(), ";
	$Sql.= "                     PRENF_INATIVADO_USUARIO = " .$_SESSION['sId'];
	$Sql.= " WHERE PRENF_NUMPRENF IN (" .$_GET['Ids']. ")";
	$Stmt = mysql_query($Sql);
	header("Location: pesq_prenf_vencida.php");
?>