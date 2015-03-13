<? include("inc/conn.inc.php"); 
	verifyAcess("DES_UTILITARIO_PRENF","S");
	$Sql = "SELECT COUNT(1) TOTAL";
	$Sql.= "  FROM RAR_AUTORIZACAO, RAR_PRENF ";
	$Sql.= " WHERE AUTOR_NUMAUT = PRENF_AUTOR_NUMAUT";
    $Sql.= "       AND prenf_numprenf >= " .$_POST['PRENOTA']. "";
	$Stmt = mysql_query($Sql);
	$Rs = mysql_fetch_assoc($Stmt);
	$ID = intval($Rs["TOTAL"]);
	if ($ID == 1) {
		//$Sql = "SELECT AUTOR_NUMAUT";
		//$Sql.= "  FROM RAR_AUTORIZACAO, RAR_PRENF ";
		//$Sql.= " WHERE AUTOR_NUMAUT = PRENF_AUTOR_NUMAUT";
		//$Sql.= "       AND prenf_numprenf = '" .$_POST['PRENOTA']. "'";
		//$Stmt = mysql_query($Sql);
		//$Rs = mysql_fetch_assoc($Stmt);
		//$Sql = "DELETE FROM RAR_AUTORIZACAO WHERE AUTOR_NUMAUT = '" .$Rs["AUTOR_NUMAUT"]. "'";
		//$Stmt = mysql_query($Sql);
		
		//$Sql = "UPDATE RAR_AVALIACAO SET AVALI_AUTOR_NUMAUT = NULL WHERE AVALI_AUTOR_NUMAUT = '" .$Rs["AUTOR_NUMAUT"]. "'";
		//$Stmt = mysql_query($Sql);
		
		$Sql = " UPDATE RAR_AVALIACAO ";
		$Sql.= "        SET AVALI_AUTOR_NUMAUT = NULL ";
		$Sql.= " WHERE AVALI_NUMRAR IN (SELECT L.LANCA_NUMRAR ";
		$Sql.= "                          FROM RAR_PRENF_ITEM RI, RAR_LANCAMENTO L";
		$Sql.= "                         WHERE LANCA_PRENFI_IDO = PRENFI_IDO ";
		$Sql.= "                               AND PRENFI_NUMPRENF >= " .$_POST['PRENOTA']. ")";
		$Stmt = mysql_query($Sql);
		
		$Sql = "UPDATE RAR_LANCAMENTO SET LANCA_PRENFI_IDO = NULL WHERE LANCA_PRENFI_IDO IN (SELECT PRENFI_IDO FROM RAR_PRENF_ITEM WHERE PRENFI_NUMPRENF >= " .$_POST['PRENOTA']. ")";
		$Stmt = mysql_query($Sql);
	}
	
	$Sql = "DELETE FROM RAR_PRENF_ITEM WHERE PRENFI_NUMPRENF >= " .$_POST['PRENOTA']. "";
	$Stmt = mysql_query($Sql);
	
	$Sql = "DELETE FROM RAR_PRENF WHERE PRENF_NUMPRENF >= " .$_POST['PRENOTA']. " ";
	$Stmt = mysql_query($Sql);
	
	$Sql = "insert into rar_log (log_usuar_ido, log_solicitante, log_motivo, log_data, log_tipo, log_numero) ";
	$Sql.= " values (";
	$Sql.= "'".$_SESSION['sId']."',";
	$Sql.= "'".str_replace("'","''",$_POST['SOLICITANTE'])."',";
	$Sql.= "'".str_replace("'","''",$_POST['MOTIVO'])."',";
	$Sql.= "now(),";
	$Sql.= "'P',";
	$Sql.= "'".$_POST['PRENOTA']."'";
	$Sql.= ")";
	$Stmt = mysql_query($Sql);
	

?>
<script language="javascript" type="text/javascript">
	alert("Pré-nota excluída com sucesso !");
	document.location.href = 'util_deleta_prenota.php';
</script>
