<? include("inc/conn.inc.php");



	verifyAcess("ARZ_AVALIPENDENTE","S");



	if ($_POST['AVALI_STAR_DEFEI_IDO'] == ""){

		$Star_defei_ido = "Null";

	}

	else

	{

		$Star_defei_ido = "'".$_POST['AVALI_STAR_DEFEI_IDO']."'";

	}


	$Sql = "INSERT INTO rar_avaliacao (
								AVALI_NUMRAR,
								AVALI_AREZ_DATA,
								AVALI_AREZ_ENCERRADO,
								AVALI_AREZ_DETALHE,
								AVALI_AREZ_USUAR_IDO,
								AVALI_SITUACAO,
								AVALI_AREZ_DEFEIG_IDO,
								AVALI_AREZ_DEFEIS_IDO,
						) VALUE (
							'{$_POST['ID']}',
							'".((trim($_POST['AVALI_AREZ_DATA'])) ? "'" .formatadata($_POST['AVALI_AREZ_DATA']). "'" : "NULL")."',
							'{$_POST['AVALI_AREZ_ENCERRADO']}',
							'{$_POST['AVALI_AREZ_DETALHE']}',
							'{$_SESSION['sId']}',
							'{$_POST['AVALI_SITUACAO']}',
							'{$_POST['AVALI_AREZ_DEFEIG_IDO']}',
							'{$_POST['AVALI_AREZ_DEFEIS_IDO']}'
						)";
	/**$Sql = "UPDATE rar_avaliacao SET ".

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

			" WHERE AVALI_NUMRAR = '" .$_POST['ID']. "'";*/
	$Stmt = mysql_query($Sql);

	if ($_POST['AVALI_SITUACAO'] == "E" || $_POST['AVALI_SITUACAO'] == "F" ){
		$Situacao = 1;
	}else{
		$Situacao = 3;
	}

	$Sql = "UPDATE rar_lancamento SET LANCA_STATUS = '" .$Situacao. "' WHERE LANCA_NUMRAR = '{$_POST['ID']}'";

	$Stmt = mysql_query($Sql);


	$Sql = "select LANCA_CATEGORIA from rar_lancamento WHERE LANCA_NUMRAR = '{$_POST['ID']}'";

	$Stmt = mysql_query($Sql);

	if($RsCat = mysql_fetch_assoc($Stmt)) {



		if ($_GET["avanca"] == "S"){

			$Sql = "SELECT L.LANCA_CATEGORIA, I.ITEM_QTDE, A.AVALI_SITUACAO, L.LANCA_NUMRAR, date_format(L.lanca_dataabertura,'%d/%m/%Y') AS DATA,F.NOME As FABRICA,P.PESSOA,P.NOME ".

				" FROM pessoa P, rar_lancamento L, pessoa F, rar_avaliacao A, rar_usuarioxcliente UC, rar_item I ".

				" WHERE L.LANCA_FABRI_IDO = F.PESSOA ".

				"       AND L.lanca_pessoa = P.PESSOA ".

				"       AND L.LANCA_NUMRAR = I.ITEM_NUMRAR ".

				"       AND (A.avali_numrar = L.lanca_numrar or a.avali_numrar is null) ".

				"       AND LANCA_STATUS = '1' ".

				"       AND UC.USUCLI_PESSOA = L.LANCA_PESSOA ".

				"       AND UC.USUCLI_USUAR_IDO = '" .$_SESSION['sId']. "'".

				"       AND L.LANCA_CATEGORIA = '" .$RsCat["LANCA_CATEGORIA"]. "'".

				" ORDER BY LANCA_DATAABERTURA, LANCA_NUMRAR";

			$Stmt = mysql_query($Sql);

			if($Rs = mysql_fetch_assoc($Stmt)) {

				//echo "AQUI - S1";

				header("Location: pesq_avaliacao_pendente.php?Id=".$Rs["LANCA_NUMRAR"]);

			}else{

				header("Location: pesq_avaliacoes_pendentes.php?DT_INICIAL=".$_POST['DT_INICIAL']."&DT_FINAL=".$_POST['DT_FINAL']."&Categoria=".$RsCat["LANCA_CATEGORIA"]);

			}

		}else{

			//echo "AQUI - N";

			header("Location: pesq_avaliacoes_pendentes.php?DT_INICIAL=".$_POST['DT_INICIAL']."&DT_FINAL=".$_POST['DT_FINAL']."&Categoria=".$RsCat["LANCA_CATEGORIA"]);

		}

	}

?>

