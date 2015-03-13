<? 	include("inc/headerI.inc.php");
	verifyAcess("ARZ_AVALIPENDENTE","S");
$Stmts = mysql_query("SELECT * FROM rar_defeito_subgrupo WHERE DEFEIS_DEFEIG_IDO = '" .$_GET['Grupo']. "' ORDER BY DEFEIS_DESCRICAO");
?>
	
		
<script language="javascript" type="text/javascript">
<!--
		a = 0;
		total = parent.document.form.AVALI_AREZ_DEFEIS_IDO.length;
		for(x=0;x <= total; x++) {
			parent.document.form.AVALI_AREZ_DEFEIS_IDO[a] = null;
		}
		parent.document.form.AVALI_AREZ_DEFEIS_IDO[0] = new Option("..selecione subgrupo","",true);
		<? 
		$X = 1;
		while($Rs = mysql_fetch_assoc($Stmts)) {
		
		//IF ($_GET['Grupo'] == $Rs["DEFEIS_IDO"]){
		//	$SELECTi = $X
		//}
		?>
			parent.document.form.AVALI_AREZ_DEFEIS_IDO[<?=$X?>] = new Option('<?=$Rs["DEFEIS_DESCRICAO"]?>','<?=$Rs["DEFEIS_IDO"]?>',true); 
		<?   
		$X++;
		}
		?>
		//parent.document.form.codfuncionario.selectedIndex = <?=$SELECTi?>;
//-->
</script>