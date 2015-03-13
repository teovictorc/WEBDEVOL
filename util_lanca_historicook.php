<? include("inc/conn.inc.php"); 
	verifyAcess("DES_UTIL_HISTORICO","S");
	$Cliente = 18800;
	$Sql = "SELECT * FROM RAR_CLIENTE_COLETA WHERE CLIEN_COL_PESSOA = '" .$Cliente. "'";
	$Stmt = mysql_query($Sql);
	$Rs = mysql_fetch_assoc($Stmt);
	
	$ID = intval($Rs["CLIEN_SEQ_RECLAMACAO"]) + 1;
	$Sql = "UPDATE RAR_CLIENTE_COLETA SET CLIEN_SEQ_RECLAMACAO = CLIEN_SEQ_RECLAMACAO + 1 WHERE CLIEN_COL_PESSOA = '" .$Cliente. "'";
	$Stmt = mysql_query($Sql);
	
	$ID = arrumaPessoa($Cliente) ."-". arrumaPessoa($ID);
	
	$Sql = "INSERT INTO RAR_LANCAMENTO (
				   LANCA_NUMRAR,
				   LANCA_PESSOA,
				   LANCA_FABRI_IDO,
				   LANCA_STATUS,
				   LANCA_MOTIVO,
				   LANCA_SOLICITANTE,
				   LANCA_PESSOA_EMITENTE, 
				   LANCA_DATAABERTURA, 
				   LANCA_TIPORECLAMACAO, 
				   LANCA_CLIENTE_NOME, 
				   LANCA_CATEGORIA,
				   LANCA_CLIENTE_FONE) VALUES ('".
				   $ID. "',18800,"  .
				   $_POST['LANCA_FABRI_IDO']. ",".
				   "'3','Lançamento retroativo',".
				   "'Andarella',".
				   "'" .$_POST['LANCA_FABRI_IDO']. "','".
				   formatadata($_POST['LANCA_DATAABERTURA']). "'," .
				   "'C','".
				   "Andarella','".
				   $_POST['LANCA_CATEGORIA']."','".
				   "Andarella')" ;
	//echo("Insert: " . $Sql."<BR>");
	$Stmt = mysql_query($Sql);
	
	
	$IDO = newIDO();
	
	$Sql = "INSERT INTO RAR_ITEM (ITEM_NUMRAR,
			ITEM_NUMITEM,
			ITEM_PESSOA_EMITENTE,
			ITEM_COLECAO,
			ITEM_REFERENCIA,
			ITEM_VALOR,
			ITEM_QTDE
			) VALUES ('".
			$ID. "'," .
			$IDO. ",'" .
			$_POST['LANCA_FABRI_IDO']. "','".
			"99','" .
			"9999916506440748','" .
			str_replace(",",".",str_replace(",",".",$_POST['ITEM_VALOR'])/$_POST['ITEM_NUM33']). "','" .
			$_POST['ITEM_NUM33']. "')";
		//echo("Insert item: " . $Sql."<BR>");
	$Stmt = mysql_query($Sql);

	$Sql = "INSERT INTO RAR_AVALIACAO (AVALI_NUMRAR, AVALI_AREZ_DATA, AVALI_AREZ_DEFEIG_IDO, AVALI_AREZ_DEFEIS_IDO, AVALI_SITUACAO, AVALI_AREZ_ENCERRADO) ";
	$Sql.= " VALUES ('" .$ID. "',";
	$Sql.= "'".formatadata($_POST['LANCA_DATAABERTURA']). "',";
	$Sql.= "1398, 1400, 'P', 'S')";
	//echo("Insert avaliacao: " . $Sql."<BR>");
	$Stmt = mysql_query($Sql);

?>
<script language="javascript" type="text/javascript">
	alert("RAR N.o: <?=$ID?> incluída com sucesso !");
	document.location.href = 'util_lanca_historico.php';
</script>
