<? include("inc/conn.inc.php"); 
	verifyAcess("ARZ_CONS_INDIV","S");
	$Sql = "SELECT * ";
	$Sql.= "  FROM rar_prenf_item ";
	$Sql.= " WHERE LANCA_NUMRAR = '" .$_GET['RAR']. "'";
	$Stmt = mysql_query($Sql);
	$Rs = mysql_fetch_assoc($Stmt);
	if ($Rs = mysql_fetch_assoc($Stmt)){
		?>
		<script>
		alert("A reclamação informada já foi autorizada coleta !");
		document.location.href = 'util_deleta_rar.php';
		</script>
	<?
	}else{
		$Sql = "SELECT * ";
		$Sql.= "  FROM rar_lancamento ";
		$Sql.= " WHERE LANCA_NUMRAR = '" .$_GET['RAR']. "'";
		$Stmt = mysql_query($Sql);
		if ($Rs = mysql_fetch_assoc($Stmt)) {
			$Sql = "UPDATE rar_avaliacao set AVALI_AREZ_DEFEI_IDO = null, AVALI_AREZ_USUAR_IDO = null, AVALI_AREZ_DATA = null, AVALI_AREZ_ENCERRADO= null, AVALI_AREZ_DETALHE = null, AVALI_AREZ_DEFEIG_IDO = null, AVALI_AREZ_DEFEIS_IDO = null, AVALI_SITUACAO = null WHERE AVALI_NUMRAR = '" .$_GET['RAR']. "'";
			$Stmt = mysql_query($Sql);
			
			$Sql = "UPDATE rar_lancamento set lanca_status = '1' WHERE LANCA_NUMRAR = '" .$_GET['RAR']. "'";
			$Stmt = mysql_query($Sql);
		}else{
		?>
		<script>
		alert("A reclamação informada não foi localizada no banco de dados !");
		document.location.href = 'pesq_avaliacoes_individual_arz.php';
		</script>
		<?
		}
	}
?>
<script language="javascript" type="text/javascript">
	alert("Reclamação reaberta com sucesso !");
	document.location.href = 'pesq_avaliacoes_individual_arz.php';
</script>
