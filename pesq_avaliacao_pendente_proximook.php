<? include("inc/conn.inc.php"); 
	verifyAcess("ARZ_AVALIPENDENTE","S");
	
	if ($_POST['AVALI_STAR_DEFEI_IDO'] == ""){
		$Star_defei_ido = "Null";
	}
	else
	{
		$Star_defei_ido = "'".$_POST['AVALI_STAR_DEFEI_IDO']."'";
	}

	$Sql = "UPDATE RAR_AVALIACAO SET ".
			"AVALI_AREZ_DATA = " .((trim($_POST['AVALI_AREZ_DATA'])) ? "'" .formatadata($_POST['AVALI_AREZ_DATA']). "'" : "NULL"). " , ".
			"AVALI_AREZ_ENCERRADO = '" .$_POST['AVALI_AREZ_ENCERRADO']. "', ".
			"AVALI_AREZ_DETALHE = '" .$_POST['AVALI_AREZ_DETALHE']. "', ".
			"AVALI_AREZ_USUAR_IDO = " .$_SESSION['sId']. ", ".
			//"AVALI_STAR_DEFEI_IDO = " .$Star_defei_ido. ", ".
			//"AVALI_STAR_DATA = " .((trim($_POST['AVALI_STAR_DATA'])) ? "'" .formatadata($_POST['AVALI_STAR_DATA']). "'" : "NULL"). " , ".
			//"AVALI_STAR_ENCERRADO = '" .$_POST['AVALI_STAR_ENCERRADO']. "', ".
			//"AVALI_STAR_DETALHE = '" .$_POST['AVALI_STAR_DETALHE']. "', ".
			//"AVALI_STAR_USUAR_IDO = " .$_SESSION['sId']. ", ".
			"AVALI_SITUACAO = '" .$_POST['AVALI_SITUACAO']. "', ".
			"AVALI_AREZ_DEFEIG_IDO = '" .$_POST['AVALI_AREZ_DEFEIG_IDO']. "', ".
			"AVALI_AREZ_DEFEIS_IDO = '" .$_POST['AVALI_AREZ_DEFEIS_IDO']. "' ".			
			" WHERE AVALI_NUMRAR = '" .$_POST['ID']. "'";

	//die($Sql);
	$Stmt = mysql_query($Sql);
	
	$Sql = "UPDATE RAR_LANCAMENTO SET LANCA_STATUS = '" .(($_POST['AVALI_SITUACAO'] == "E") ? "1" : "3"). "' WHERE LANCA_NUMRAR = '" .$_POST['ID']. "'";
	$Stmt = mysql_query($Sql);
	
	if ($_GET["avanca"] == "S"){
		$Sql = "SELECT I.ITEM_QTDE, A.AVALI_SITUACAO, L.LANCA_NUMRAR, date_format(L.lanca_dataabertura,'%d/%m/%Y') AS DATA,F.NOME As FABRICA,P.PESSOA,P.NOME ".
	        " FROM PESSOA P, RAR_LANCAMENTO L, PESSOA F, RAR_AVALIACAO A, RAR_USUARIOXCLIENTE UC, RAR_ITEM I ".
			" WHERE L.LANCA_FABRI_IDO = F.PESSOA ".
			"       AND L.lanca_pessoa = P.PESSOA ".
			"       AND L.LANCA_NUMRAR = I.ITEM_NUMRAR ".
			"       AND (A.avali_numrar = L.lanca_numrar or a.avali_numrar is null) ".
			"       AND LANCA_STATUS = '1' ".
			"       AND UC.USUCLI_PESSOA = L.LANCA_PESSOA ".
			"       AND UC.USUCLI_USUAR_IDO = '" .$_SESSION['sId']. "'".
			" ORDER BY LANCA_DATAABERTURA, LANCA_NUMRAR";
		$Stmt = mysql_query($Sql);
		if($Rs = mysql_fetch_assoc($Stmt)) {
			header("Location: pesq_avaliacao_pendente_proximo.php?Id=".$Rs["LANCA_NUMRAR"]);
		}else{
			header("Location: pesq_avaliacoes_pendentes.php");
		}
	}else{
		header("Location: pesq_avaliacoes_pendentes.php");
	}
?>
