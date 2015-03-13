<? include("inc/conn.inc.php"); 
	verifyAcess("DES_MANUT_GRUPOMAT","S");
	$Sql = "SELECT * ";
	$Sql.= "  FROM RAR_SERVICO_SOLICITACAOMATERIAL ";
	$Sql.= " WHERE SERSM_IDO = '" .$_POST['SERSM_IDO']. "'";
	$Stmt = mysql_query($Sql);
	if ($Rs = mysql_fetch_assoc($Stmt)) {
		$Sql = "UPDATE RAR_SERVICO_SOLICITACAOMATERIAL SET SERSM_MATERG_IDO = '".$_POST['SERSM_MATERG_IDO']."'";
		if ($_POST['SERSM_ENTREGUE'] != ""){
			$Sql.= " , SERSM_ENTREGUE = '".$_POST['SERSM_ENTREGUE']."'";
		}
		$Sql.= " WHERE SERSM_IDO = '" .$_POST['SERSM_IDO']. "'";
		$Stmt = mysql_query($Sql);
	}
	

?>
<script language="javascript" type="text/javascript">
	alert("Dados atualizados com sucesso !");
	document.location.href = 'util_manut_grupo_material.php?PESQUISAR=S&SERVI_DATAABERTURAI=<?=$_POST['SERVI_DATAABERTURAI']?>&SERVI_DATAABERTURAF=<?=$_POST['SERVI_DATAABERTURAF']?>';
</script>

