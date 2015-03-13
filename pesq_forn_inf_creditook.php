<? include("inc/conn.inc.php");

	verifyAcess("FORN_CREDITOPEND","S");

	$ID = trim($_POST['ID']);

	if (($_FILES['fileComprovante']['size'] / 1024) > 200) {

		$Sql = "Location: pesq_forn_inf_credito.php?ID=" .urlencode($_POST['ID']). "&Erro=1";

		header($Sql);

	}else{

		if (trim($_POST['ID'])) {
			$Sql = "SELECT *";

			$Sql.= " FROM rar_cliente_coleta";

			$Sql.= " WHERE clien_col_pessoa = '" .$_POST["PESSOA"]. "'";

			$StmtBanco = mysql_query($Sql);

			$RsBanco = mysql_fetch_assoc($StmtBanco);

			$Banco = $RsBanco["CLIEN_COB_BANCO"];

			$Agencia = $RsBanco["CLIEN_COB_AGENCIA_CODIGO"];

			$Agencia_Nome = $RsBanco["CLIEN_COB_AGENCIA_NOME"];

			$Conta = $RsBanco["CLIEN_COB_CONTA"];

			$Titular = $RsBanco["CLIEN_COB_TITULAR"];

			

			$File = strtoupper(str_replace("-","_",$ID). "_COMPROVANTE.".substr($_FILES['fileComprovante']['name'],strrpos($_FILES['fileComprovante']['name'],".") + 1));

			//die($File."----".$_FILES['fileComprovante']['tmp_name']."----".$PathImagens.$File);
			copy($_FILES['fileComprovante']['tmp_name'],$PathImagens .$File);

			$ValorOrig = str_replace(".","",$_POST['ValorOrig']);

			$ValorOrig = str_replace(",",".",$ValorOrig);

		

			$Sql = "INSERT INTO creditos_pagos (

						PESSOA,

						SERIE_NF,

						NUM_NF,

						VALOR_NOTA,

						EMPRESA,

						VALOR_PAGO,

						DATA_LIQUIDACAO, 

						FORMA_PAGAMENTO,

						categoria,

						BANCO, 

						AGENCIA_CODIGO, 

						AGENCIA_NOME, 

						CONTA,

						TITULAR) VALUES (".

						"'".$_POST["PESSOA"]. "'," .

						"'".$_POST['PRENF_SERIE']. "',".

						"'".$_POST['PRENF_NUMNFDEVOLUCAO']. "',".

						$ValorOrig. "," .

						"'" .$_POST['FORNECEDOR']. "',".

						$ValorOrig. "," .

						"'".formatadata($_POST['DATA'])."',".

						"'CRÉDITO EM CONTA CORRENTE',".

						"'2',".

						"'" .$Banco. "',".

						"'" .$Agencia. "',".

						"'" .$Agencia_Nome. "',".

						"'" .$Conta. "',".

						"'" .$Titular. "')" ;

						$Stmt = mysql_query($Sql);
						
						

				$Sql = "UPDATE rar_prenf SET ".

						"PRENF_DATA_IMPORT_AREZZO = NOW()  ".

						"WHERE PRENF_NUMPRENF = '" .$_POST['ID']. "'";
			$Stmt = mysql_query($Sql);
		}

		header("Location: pesq_forne_credito.php");

	}

?>