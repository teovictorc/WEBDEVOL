<? include("inc/conn.inc.php"); 
	verifyAcess("DES_UTILITARIO_RAR","S");
	$Sql = "SELECT * ";
	$Sql.= "  FROM rar_prenf_item ";
	$Sql.= " WHERE LANCA_NUMRAR = '" .$_POST['RAR']. "'";
	$Stmt = mysql_query($Sql);
	$Rs = mysql_fetch_assoc($Stmt);
	if ($Rs = mysql_fetch_assoc($Stmt)){
		?>
		<script>
		alert("A reclamação informada já foi autorizada coleta !");
		document.location.href = 'util_deleta_rar.php';
		</script>
	<?
	}
	
	
	$Sql = "SELECT * ";
	$Sql.= "  FROM rar_lancamento ";
	$Sql.= " WHERE LANCA_NUMRAR = '" .$_POST['RAR']. "'";
	$Stmt = mysql_query($Sql);
	if ($Rs = mysql_fetch_assoc($Stmt)) {
		$Sql = "DELETE FROM rar_avaliacao WHERE AVALI_NUMRAR = '" .$_POST['RAR']. "'";
		$Stmt = mysql_query($Sql);
		
		$Sql = "DELETE FROM rar_item WHERE ITEM_NUMRAR = '" .$_POST['RAR']. "'";
		$Stmt = mysql_query($Sql);
		
		$Sql = "DELETE FROM rar_lancamento WHERE LANCA_NUMRAR = '" .$_POST['RAR']. "'";
		$Stmt = mysql_query($Sql);
		
		$Sql = "insert into rar_log (log_usuar_ido, log_solicitante, log_motivo, log_data, log_tipo, log_numero) ";
		$Sql.= " values (";
		$Sql.= "'".$_SESSION['sId']."',";
		$Sql.= "'".str_replace("'","''",$_POST['SOLICITANTE'])."',";
		$Sql.= "'".str_replace("'","''",$_POST['MOTIVO'])."',";
		$Sql.= "now(),";
		$Sql.= "'R',";
		$Sql.= "'".$_POST['RAR']."'";
		$Sql.= ")";
		$Stmt = mysql_query($Sql);
		
		
	}else{
	?>
	<script>
	alert("A reclamação informada não foi localizada no banco de dados !");
	document.location.href = 'util_deleta_rar.php';
	</script>
	<?
	}
	
	

?>
<script language="javascript" type="text/javascript">
	alert("Reclamação excluída com sucesso !");
	document.location.href = 'util_deleta_rar.php';
</script>
