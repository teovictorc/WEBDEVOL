<? include("inc/conn.inc.php"); 
	verifyAcess("ARZ_CONS_PRENF","S");

	$Sql = "SELECT * ";
	$Sql.= "  FROM rar_prenf ";
	$Sql.= " WHERE prenf_numnfdevolucao = '" .$_GET['Id']. "'";
	$Sql.= "       and prenf_pessoa_destinatario = '" .$_GET['Pessoa']. "'";

	$Stmt = mysql_query($Sql);
	if ($Rs = mysql_fetch_assoc($Stmt)) {
		?>
		<script>
		document.location.href = 'confirmacao_nf_emitir.php?Destino=1&Id=' + <?=$Rs["PRENF_NUMPRENF"]?>;
		</script>
		<? 

	}else{
	?>
	<script>
	alert("A pré-nota informada não foi localizada no banco de dados !");
	document.location.href = 'pesq_retaguarda_prenota.php';
	</script>
	<?
	}
	
	

?>
<script language="javascript" type="text/javascript">
	alert("Reclamação reaberta com sucesso !");
	document.location.href = 'pesq_avaliacoes_individual_arz.php';
</script>
