
<?php include("inc/conn.inc.php"); 



function stringToBinary($value) {
	/*$bit = array(0 => 128,64,32,16,8,4,2,1);
	$bin = array();
	for($x = 0; $x < strlen($value); $x++) {
		$str = intval(ord(substr($value,$x,1)));
		for($y = 0; $y < count($bit); $y++) {
			$str-= round($bit[$y]);
			$bin[count($bin)] = ($str >= 0) ? 1 : 0;
			if ($bin[count($bin) - 1] == 0)rez
				$str+= $bit[$y];
		}
	}

	$result = "";
	for($y = 0; $y < count($bin); $y++)
		$result.= $bin[$y];
	
	return $result;
	*/
	
	//die(urlencode($value)."<br><br>".urldecode($value));
	return ($value);
}

	switch($_GET['cmd']) {

		case "nf_dev" :

			$ID = newIDO();

			$SQL = "INSERT INTO rar_servico_nf_prod_dev (SPRNF_IDO, SPRNF_PESSOA_DESTINATARIO, SPRNF_SERVI_NUMERO, SPRNF_NF, SPRNF_QTDEVOLUME, SPRNF_DATANF) ";

			$SQL.= " VALUES ('".$ID."',".$_GET["SPRNF_PESSOA_DESTINATARIO"].",'".strtoupper($_GET["SPRNF_SERVI_NUMERO"])."','".$_GET["SPRNF_NF"]."','".$_GET["SPRNF_QTDEVOLUME"]."', '".formatadata($_GET['SPRNF_DATANF'])."')";

			mysql_query($SQL);

			

			$retorno = "document.form.VALIDADO.value = \"" ."S"."\";";
			$retorno.= "Validar();";
			echo stringToBinary($retorno);
			

		case "d_c" :
				$Sql = "select NOME, REPLACE(LOGRADOURO, '�','E') LOGRADOURO, BAIRRO, NM_MUNICIPIO, SG_UF,CONCAT (fantasia,' - ',usuar_nome) AS LANCA_SOLICITANTE
FROM rar_usuarioxcliente
inner join pessoa on rar_usuarioxcliente.usucli_pessoa=pessoa.pessoa
inner join rar_usuario on rar_usuario.usuar_ido=rar_usuarioxcliente.USUCLI_USUAR_IDO 
AND RAR_USUARIO.USUAR_IDO= '".$_SESSION['sId']."'
 WHERE PESSOA = '" .$_GET['PESSOA']. "'" ;
				$Stmt = mysql_query($Sql);
				if ($Rs = mysql_fetch_assoc($Stmt)) {
					$Sql = " select * ";
					$Sql.= " from rar_cliente_coleta ";
					$Sql.= " where (clien_cob_banco is null or clien_cob_banco = '' or clien_cob_banco = '.')";
					$Sql.= "       and clien_col_pessoa = '" .$_GET['PESSOA']. "'";
					$Stmt2 = mysql_query($Sql);
					if ($Rs2 = mysql_fetch_assoc($Stmt2)) {
						$retorno = "alert(\"" ."Os dados banc�rios da loja selecionada n�o est�o preenchidos.\\nFavor acessar CADASTROS >> CADASTRO DE CLIENTE e informe os dados.\\n\\nSem os dados preenchimentos corretamente n�o ser� poss�vel abrir reclama��o!"."\");";
						$retorno.= "document.form.LANCA_PESSOA.value = \"" .""."\";";
						$retorno.= "document.form.NOME.value = \"" .""."\";";
						$retorno.= "document.form.ENDERECO.value = \"" .""."\";";
						$retorno.= "document.form.BAIRRO.value = \"" .""."\";";
						$retorno.= "document.form.CIDADE.value = \"" .""."\";";
						$retorno.= "document.form.UF.value = \"" .""."\";";
						$retorno.= "document.form.LANCA_SOLICITANTE.value = \"" .""."\";";
						echo stringToBinary($retorno);
					}else{
						$retorno = "document.form.NOME.value = \"" .$Rs["NOME"] ."\";";
						$retorno.= "document.form.ENDERECO.value = \"" .$Rs["LOGRADOURO"] ."\";";
						$retorno.= "document.form.BAIRRO.value = \"" .$Rs["BAIRRO"] ."\";";
						$retorno.= "document.form.CIDADE.value = \"" .$Rs["NM_MUNICIPIO"] ."\";";
						$retorno.= "document.form.UF.value = \"" .$Rs["SG_UF"] ."\";";
						$retorno.= "document.form.LANCA_SOLICITANTE.value = \"" .$Rs["LANCA_SOLICITANTE"] ."\";";
						echo stringToBinary($retorno);
					
					}
			 	}
			break;

		case "d_s" :  //completa dados de pessoa - WFA Servi�os	

				$ID = newServico($_GET['PESSOA']);

				$ID = "S".arrumaPessoa($_GET['PESSOA']) ."-". arrumaPessoa($ID);

				$Sql = " SELECT CASE P.CATEGORIA_CLIENTE ";

				$Sql.= " WHEN 8 THEN 'FRANQUIA' ";

				$Sql.= " WHEN 9 THEN 'MULTIMARCA DE FRANQUIA' ";

				$Sql.= " WHEN 10 THEN 'MULTIMARCA' ";

				$Sql.= " ELSE 'SEM CATEGORIA' ";

				$Sql.= " END AS CATEGORIA, P.CATEGORIA_CLIENTE, P.NOME, P.LOGRADOURO, P.BAIRRO, P.NM_MUNICIPIO, P.SG_UF, PC.NOME CONSULTOR, ";

				$Sql.= " USUAR_IDO, USUAR_NOME ANJO ";

				$Sql.= " FROM pessoa P, rar_cliente_estrutura RE, pessoa PC, rar_anjo_coordenador, rar_usuario ";

				$Sql.= " WHERE P.PESSOA = '" .$_GET['PESSOA']. "'";

				$Sql.= "       AND P.PESSOA = CLIEN_EST_CLIENTE ";

				$Sql.= "       AND PC.PESSOA = CLIEN_EST_CONSULTOR ";

				$Sql.= "       AND ANJCO_PESSOA = CLIEN_EST_COORDENADOR ";

				$Sql.= "       AND ANJCO_USUAR_IDO = USUAR_IDO ";

				$Stmt = mysql_query($Sql);

				if ($Rs = mysql_fetch_assoc($Stmt)) {

					$Sql = " select * ";

					$Sql.= " from rar_cliente_coleta ";

					$Sql.= " where (clien_cob_banco is null or clien_cob_banco = '')";

					$Sql.= "       and clien_col_pessoa = '" .$_GET['PESSOA']. "'";

					$Stmt2 = mysql_query($Sql);

					if ($Rs2 = mysql_fetch_assoc($Stmt2)) {

						$retorno = "alert(\"" ."Os dados banc�rios da loja selecionada n�o est�o preenchidos.\\nFavor acessar CADASTROS >> CADASTRO DE CLIENTE e informe os dados.\\n\\nSem os dados preenchimentos corretamente n�o ser� poss�vel abrir reclama��o!"."\");";

						$retorno.= "document.form.SERVI_PESSO_IDO.value = \"" .""."\";";

						echo stringToBinary($retorno);

					}else{

					

						if ($_GET['PESSOA'] == 0){  //se for NOVO CLIENTE

							//verifica qual anjo est� vinculado ao seu usu�rio

							$Sql = " select clien_est_coordenador ";

							$Sql.= " from rar_cliente_estrutura, rar_usuario ";

							$Sql.= " where usuar_ido = '".$_SESSION['sId']."'";

							$Sql.= "       and usuar_consu_pessoa = clien_est_coordenador ";

							$Sql.= " union ";

							$Sql.= " select clien_est_coordenador ";

							$Sql.= " from rar_cliente_estrutura, rar_usuario ";

							$Sql.= " where usuar_ido = '".$_SESSION['sId']."'";

							$Sql.= "       and usuar_consu_pessoa = clien_est_consultor ";

							$StmtCoordenador = mysql_query($Sql);

							if ($RsCoord = mysql_fetch_assoc($StmtCoordenador)) {

								$Sql = " select * from rar_anjo_coordenador, rar_usuario ";

								$Sql.= " where anjco_pessoa = '".$RsCoord["clien_est_coordenador"]."'";

								$Sql.= "       and anjco_usuar_ido = usuar_ido ";

								$StmtAnjo = mysql_query($Sql);

								if ($RsAnjo = mysql_fetch_assoc($StmtAnjo)) {

									$Anjo = $RsAnjo["USUAR_NOME"];

									$Usuar_ido = $RsAnjo["USUAR_IDO"];

								}else{

									$Anjo = "N�o permitido";

									$Usuar_ido = "";

								}

							}

						}else{

							$Anjo = $Rs["ANJO"];

							$Usuar_ido = $Rs["USUAR_IDO"];

						}

					

					

						$retorno = "document.form.NOME.value = \"" .$Rs["NOME"] ."\";";

						$retorno.= "document.form.NUMERO.value = \"" .$ID."\";";

						$retorno.= "document.form.SERVI_NUMERO.value = \"" .$ID."\";";

						$retorno.= "document.form.CATEGORIA.value = \"" .$Rs["CATEGORIA"] ."\";";

						$retorno.= "document.form.CONSULTOR.value = \"" .$Rs["CONSULTOR"] ."\";";

						$retorno.= "document.form.ENDERECO.value = \"" .$Rs["LOGRADOURO"] ."\";";

						$retorno.= "document.form.BAIRRO.value = \"" .$Rs["BAIRRO"] ."\";";

						$retorno.= "document.form.CIDADE.value = \"" .$Rs["NM_MUNICIPIO"] ."\";";

						$retorno.= "document.form.UF.value = \"" .$Rs["SG_UF"] ."\";";

						$retorno.= "document.form.ANJO.value = \"" .$Anjo ."\";";

						$retorno.= "document.form.SERVI_USUAR_ANJO.value = \"" .$Usuar_ido."\";";

						echo stringToBinary($retorno);

					}

				}else{

					$retorno = "alert(\"" ."Aten��o, n�o foram encontrados dados referentes a estrutura de CLIENTE + CONSULTOR + COORDENADOR deste cliente ou o COORDENADOR deste cliente n�o est� vinculado a nenhum anjo.\\nFavor entrar em contato com o Suporte !"."\");";

					$retorno.= "document.form.SERVI_PESSO_IDO.value = \"" .""."\";";

					echo stringToBinary($retorno);

			 	}	

			break;

		case "d_i" :  //completa dados de pessoa - WFA IAF

				$Sql = " select * ";

				$Sql.= " from iaf_questionario ";

				$Sql.= " where QUEST_PESSOA = '".$_GET['PESSOA']."'";

				if ($_GET['IAFPQ_IDO'] != ""){

					$Sql.= "       and QUEST_IAFPQ_IDO = '".$_GET['IAFPQ_IDO']."'";

				}

				$Stmt = mysql_query($Sql);

				if($Rs = mysql_fetch_assoc($Stmt)){

					$retorno = "alert(\"" ."Aten��o, j� existe question�rio respondido para o cliente + pesquisa selecionada  !"."\");";

					$retorno.= "document.form.QUEST_PESSOA.value = \"" .""."\";";

					echo stringToBinary($retorno);

				}else{

					$Sql = " SELECT CASE P.CATEGORIA_CLIENTE ";

					$Sql.= "        WHEN 8 THEN 'FRANQUIA' ";

					$Sql.= "        WHEN 9 THEN 'MULTIMARCA DE FRANQUIA' ";

					$Sql.= "        WHEN 10 THEN 'MULTIMARCA' ";

					$Sql.= "        ELSE 'SEM CATEGORIA' ";

					$Sql.= "        END AS CATEGORIA, ";

					$Sql.= "        P.CATEGORIA_CLIENTE, P.NOME, P.LOGRADOURO, P.BAIRRO, P.NM_MUNICIPIO, P.SG_UF, PC.NOME CONSULTOR, ";

					$Sql.= "        PCOO.NOME COORDENADOR ";

					$Sql.= " FROM pessoa P, rar_cliente_estrutura RE, pessoa PC, pessoa PCOO";

					$Sql.= " WHERE P.PESSOA = '" .$_GET['PESSOA']. "'";

					$Sql.= "       AND P.PESSOA = CLIEN_EST_CLIENTE ";

					$Sql.= "       AND PC.PESSOA = CLIEN_EST_CONSULTOR ";

					$Sql.= "       AND PCOO.PESSOA = CLIEN_EST_COORDENADOR ";

					$Stmt = mysql_query($Sql);

					if ($Rs = mysql_fetch_assoc($Stmt)) {

						$retorno = "document.form.NOME.value = \"" .$Rs["NOME"] ."\";";

						$retorno.= "document.form.QUEST_IDO.value = \"" .$ID."\";";

						$retorno.= "document.form.CATEGORIA.value = \"" .$Rs["CATEGORIA"] ."\";";

						$retorno.= "document.form.CONSULTOR.value = \"" .$Rs["CONSULTOR"] ."\";";

						$retorno.= "document.form.COORDENADOR.value = \"" .$Rs["COORDENADOR"] ."\";";

						$retorno.= "document.form.ENDERECO.value = \"" .$Rs["LOGRADOURO"] ."\";";

						$retorno.= "document.form.BAIRRO.value = \"" .$Rs["BAIRRO"] ."\";";

						$retorno.= "document.form.CIDADE.value = \"" .$Rs["NM_MUNICIPIO"] ."\";";

						$retorno.= "document.form.UF.value = \"" .$Rs["SG_UF"] ."\";";
					
						echo stringToBinary($retorno);

					}else{

						$retorno = "alert(\"" ."Aten��o, n�o foram encontrados dados referentes a estrutura de CLIENTE + CONSULTOR + COORDENADOR deste cliente.\\nFavor entrar em contato com o Suporte !"."\");";

						$retorno.= "document.form.QUEST_PESSOA.value = \"" .""."\";";

						echo stringToBinary($retorno);

					}	

				}

			break;

		case "d_WFAPesq" :  //completa dados de pessoa - WFA Pesquisas

				$Sql = " select * ";

				$Sql.= " from wfa_pesquisa_respondida ";

				$Sql.= " where PQRES_PESSOA = '".$_GET['PESSOA']."'";

				$Sql.= "       and pqres_pesqu_ido = '".$_GET['PQRES_PESQU_IDO']."'";

				$Stmt = mysql_query($Sql);

				if($Rs = mysql_fetch_assoc($Stmt)){

					

					$retorno = "alert(\"" ."Aten��o, j� existe resposta para a pesquisa para o cliente selecionado !"."\");";

					$retorno.= "document.form.PQRES_PESSOA.value = \"" .""."\";";

					$retorno.= "document.form.NOME.value = \"" .""."\";";

					$retorno.= "document.form.CATEGORIA.value = \"" .""."\";";

					$retorno.= "document.form.CONSULTOR.value = \"" .""."\";";

					$retorno.= "document.form.COORDENADOR.value = \"" .""."\";";

					$retorno.= "document.form.ENDERECO.value = \"" .""."\";";

					$retorno.= "document.form.BAIRRO.value = \"" .""."\";";

					$retorno.= "document.form.CIDADE.value = \"" .""."\";";

					$retorno.= "document.form.UF.value = \"" .""."\";";
					

					echo stringToBinary($retorno);

				}else{

					$Sql = " SELECT CASE P.CATEGORIA_CLIENTE ";

					$Sql.= "        WHEN 8 THEN 'FRANQUIA' ";

					$Sql.= "        WHEN 9 THEN 'MULTIMARCA DE FRANQUIA' ";

					$Sql.= "        WHEN 10 THEN 'MULTIMARCA' ";

					$Sql.= "        ELSE 'SEM CATEGORIA' ";

					$Sql.= "        END AS CATEGORIA, ";

					$Sql.= "        P.CATEGORIA_CLIENTE, P.NOME, P.LOGRADOURO, P.BAIRRO, P.NM_MUNICIPIO, P.SG_UF, PC.NOME CONSULTOR, ";

					$Sql.= "        PCOO.NOME COORDENADOR ";

					$Sql.= " FROM pessoa P, rar_cliente_estrutura RE, pessoa PC, pessoa PCOO";

					$Sql.= " WHERE P.PESSOA = '" .$_GET['PESSOA']. "'";

					$Sql.= "       AND P.PESSOA = CLIEN_EST_CLIENTE ";

					$Sql.= "       AND PC.PESSOA = CLIEN_EST_CONSULTOR ";

					$Sql.= "       AND PCOO.PESSOA = CLIEN_EST_COORDENADOR ";

					$Stmt = mysql_query($Sql);

					if ($Rs = mysql_fetch_assoc($Stmt)) {

						$retorno = "document.form.NOME.value = \"" .$Rs["NOME"] ."\";";

						$retorno.= "document.form.CATEGORIA.value = \"" .$Rs["CATEGORIA"] ."\";";

						$retorno.= "document.form.CONSULTOR.value = \"" .$Rs["CONSULTOR"] ."\";";

						$retorno.= "document.form.COORDENADOR.value = \"" .$Rs["COORDENADOR"] ."\";";

						$retorno.= "document.form.ENDERECO.value = \"" .$Rs["LOGRADOURO"] ."\";";

						$retorno.= "document.form.BAIRRO.value = \"" .$Rs["BAIRRO"] ."\";";

						$retorno.= "document.form.CIDADE.value = \"" .$Rs["NM_MUNICIPIO"] ."\";";

						$retorno.= "document.form.UF.value = \"" .$Rs["SG_UF"] ."\";";

						echo stringToBinary($retorno);

					}else{

						$retorno = "alert(\"" ."Aten��o, n�o foram encontrados dados referentes a estrutura de CLIENTE + CONSULTOR + COORDENADOR deste cliente.\\nFavor entrar em contato com o Suporte !"."\");";

						$retorno.= "document.form.PQRES_PESSOA.value = \"" .""."\";";

						echo stringToBinary($retorno);

					}	

				}

			break;

		case "d_p" :  //completa dados de pessoa - WFA Servi�os	

				$Sql = " SELECT CASE P.CATEGORIA_CLIENTE ";

				$Sql.= "        WHEN 8 THEN 'FRANQUIA' ";

				$Sql.= "        WHEN 9 THEN 'MULTIMARCA DE FRANQUIA' ";

				$Sql.= "        WHEN 10 THEN 'FRANQUIA' ";

				$Sql.= "        ELSE 'SEM CATEGORIA' ";

				$Sql.= " END AS CATEGORIA, P.NOME, P.LOGRADOURO, P.BAIRRO, P.NM_MUNICIPIO, P.SG_UF, PC.NOME CONSULTOR ";

				//$Sql.= "       , USUAR_IDO, USUAR_NOME ANJO "; //Comentado em 12/05/2008 - IAF n�o usa Anjo

				$Sql.= " FROM pessoa P, rar_cliente_estrutura RE, pessoa PC"; //Comentado em 12/05/2008 - IAF n�o usa Anjo ", RAR_ANJO_COORDENADOR, RAR_USUARIO ";

				$Sql.= " WHERE P.PESSOA = '" .$_GET['PESSOA']. "'";

				$Sql.= "       AND P.PESSOA = CLIEN_EST_CLIENTE ";

				$Sql.= "       AND PC.PESSOA = CLIEN_EST_CONSULTOR ";

				//$Sql.= "       AND ANJCO_PESSOA = CLIEN_EST_COORDENADOR ";   	//Comentado em 12/05/2008 - IAF n�o usa Anjo

				//$Sql.= "       AND ANJCO_USUAR_IDO = USUAR_IDO ";				//Comentado em 12/05/2008 - IAF n�o usa Anjo

				$Stmt = mysql_query($Sql);

				if ($Rs = mysql_fetch_assoc($Stmt)) {

					if ($_GET['Oper'] == "S"){  //verificar se existe operador vinculado

						$Sql = " select * ";

						$Sql.= " from rar_cliente_coleta, rar_operadorloja ";

						$Sql.= " where clien_col_pessoa = '" .$_GET['PESSOA']. "'";

						$Sql.= "       and CLIEN_OPELJ_IDO = opelj_ido";

						$StmtOper = mysql_query($Sql);

						if ($RsOper = mysql_fetch_assoc($StmtOper)) {

							$OperadorNome = $RsOper["OPELJ_NOME"];

							$OperadorEmail = $RsOper["OPELJ_EMAIL"];

						}else{

							$OperadorNome = "N�O VINCULADO";

							$OperadorEmail = "N�O VINCULADO";

						}

					}

					$retorno = "document.form.NOME.value = \"" .$Rs["NOME"] ."\";";

					$retorno.= "document.form.CATEGORIA.value = \"" .$Rs["CATEGORIA"] ."\";";

					$retorno.= "document.form.ENDERECO.value = \"" .$Rs["LOGRADOURO"] ."\";";

					$retorno.= "document.form.BAIRRO.value = \"" .$Rs["BAIRRO"] ."\";";

					$retorno.= "document.form.CIDADE.value = \"" .$Rs["NM_MUNICIPIO"] ."\";";

					$retorno.= "document.form.UF.value = \"" .$Rs["SG_UF"] ."\";";

					if ($_GET['Oper'] == "S"){  //verificar se existe operador vinculado

						$retorno.= "document.form.PDVRG_OPERADOR.value = \"" .$OperadorNome."\";";

						$retorno.= "document.form.PDVRG_OPERADOR_EMAIL.value = \"" .$OperadorEmail."\";";

					}

					echo stringToBinary($retorno);

				}else{

					$retorno = "alert(\"" ."Aten��o, n�o foram encontrados dados referentes a estrutura de CLIENTE + CONSULTOR + COORDENADOR deste cliente.\\nFavor entrar em contato com o Suporte !"."\");";

					$retorno.= "document.form.PDVRG_PESSOA.value = \"" .""."\";";

					echo stringToBinary($retorno);

			 	}	

			break;

		case "r_wfapesq" :  //WFA Pesquisa

				$Sql = " SELECT * ";

				$Sql.= " FROM wfa_pesquisa_item_resposta  ";

				$Sql.= " WHERE pitre_ido = '" .$_GET['PITRE_IDO']. "'";

				$Stmt = mysql_query($Sql);

				if ($Rs = mysql_fetch_assoc($Stmt)) {

					$SQL = " update wfa_pesquisa_item_resposta set ";

					$SQL.= "        PITRE_SEQUENCIA = '". $_GET['PITRE_SEQUENCIA']. "',";

					$SQL.= "        PITRE_DESCRICAO = '". $_GET['PITRE_DESCRICAO']. "',";

					$SQL.= "        PITRE_PONTOS = '". $_GET['PITRE_PONTOS']. "',";

					$SQL.= "        PITRE_LEGENDA = '". $_GET['PITRE_LEGENDA']. "',";

					$SQL.= "        PITRE_COR = '". $_GET['PITRE_COR']. "',";

					$SQL.= "        PITRE_ATIVO = '". $_GET['PITRE_ATIVO']. "',";

					$SQL.= "        PITRE_PESQIT_IDO = '". $Rs['PITRE_PESQIT_IDO']. "',";

					$SQL.= "        PITRE_TEMCOMPLEMENTO = '". $_GET['PITRE_TEMCOMPLEMENTO']. "'";

					$SQL.= " WHERE PITRE_IDO = '". $_GET['PITRE_IDO']. "'";

					mysql_query($SQL);

					

					$retorno = "document.form.VALIDADO.value = \"" ."S"."\";";

					$retorno.= "Validar();";

					

					echo stringToBinary($retorno);

					

				}else{

					$ID = newIDO();

					$SQL = "INSERT INTO wfa_pesquisa_item_resposta (PITRE_IDO, PITRE_SEQUENCIA, PITRE_DESCRICAO, PITRE_PONTOS, PITRE_LEGENDA, ";

					$SQL.= "            PITRE_COR, PITRE_ATIVO, PITRE_PESQIT_IDO, PITRE_TEMCOMPLEMENTO) ";

					$SQL.= " VALUES ('".$ID."','".$_GET['PITRE_SEQUENCIA']."','".$_GET['PITRE_DESCRICAO']."','".$_GET['PITRE_PONTOS']."','".$_GET['PITRE_LEGENDA']."','".$_GET['PITRE_COR']."','".$_GET['PITRE_ATIVO']."','".$_GET['PITRE_PESQIT_IDO']."','".$_GET['PITRE_TEMCOMPLEMENTO']."')";

					mysql_query($SQL);

					

					$retorno = "document.form.VALIDADO.value = \"" ."S"."\";";

					$retorno.= "Validar();";

					echo stringToBinary($retorno);

			 	}	

			break;

		case "r_1" :  //procura WFA Servicos - inclusao de nota fiscal

				$Sql = " SELECT * ";

				$Sql.= " FROM nota_fiscal ";

				$Sql.= " WHERE pessoa_emitente = '" .$_GET['PESSOA_EMITENTE']. "'";

				$Sql.= "       AND num_nf = '" .$_GET['NUM_NF']. "'";

				//$Sql.= "       AND SERIE_NF = '" .$_GET['SERIE_NF']. "'";

				$Stmt = mysql_query($Sql);

				if (!$Rs = mysql_fetch_assoc($Stmt)) {

					$retorno = "alert(\"" ."N�o foi localizada nenhuma nota fiscal para os dados informados.\\nFavor verificar !"."\");";

					$retorno.= "document.form.VALIDADO.value = \"" ."N"."\";";

					$retorno.= "Validar();";

					echo stringToBinary($retorno);

				}else{

					$ID = newIDO();

					$SQL = "INSERT INTO rar_servico_nf (SERNF_IDO, SERNF_NUM_NF, SERNF_SERIE_NF, SERNF_PESSOA_EMITENTE, SERNF_SERVI_NUMERO) ";

					$SQL.= " VALUES ('".$ID."','".$Rs["NUM_NF"]."','".strtoupper($Rs["SERIE_NF"])."','".$Rs["PESSOA_EMITENTE"]."','".$_GET["SERVI_NUMERO"]."')";

					mysql_query($SQL);

					

					$retorno = "document.form.VALIDADO.value = \"" ."S"."\";";

					$retorno.= "Validar();";

					echo stringToBinary($retorno);

			 	}	

			break;

		case "r_2" :  //procura WFA Servicos - inclusao de nota fiscal + PRODUTO

				$Sql = " SELECT * ";

				$Sql.= " FROM item_nota_fiscal ";

				$Sql.= " WHERE pessoa_emitente = '" .$_GET['PESSOA_EMITENTE']. "'";

				$Sql.= "       AND num_nf = '" .$_GET['NUM_NF']. "'";

				//$Sql.= "       AND SERIE_NF = '" .$_GET['SERIE_NF']. "'";

				$Sql.= "       AND CD_ITEM_MATERIAL = '" .$_GET['CD_ITEM_MATERIAL']. "'";

				$Stmt = mysql_query($Sql);

				if (!$Rs = mysql_fetch_assoc($Stmt)) {

					$retorno = "alert(\"" ."N�o foi localizada nenhum produto + nota fiscal para os dados informados.\\nFavor verificar !"."\");";

					$retorno.= "document.form.VALIDADO.value = \"" ."N"."\";";

					$retorno.= "Validar();";

					echo stringToBinary($retorno);

				}else{

					$ID = newIDO();

					$SQL = "INSERT INTO rar_servico_nf_prod (SERPR_IDO, SERPR_NUM_NF, SERPR_SERIE_NF, SERPR_PESSOA_EMITENTE, SERPR_SERVI_NUMERO, SERPR_CD_ITEM_MATERIAL) ";

					$SQL.= " VALUES ('".$ID."','".$Rs["NUM_NF"]."','".strtoupper($Rs["SERIE_NF"])."','".$Rs["PESSOA_EMITENTE"]."','".$_GET["SERVI_NUMERO"]."','".$Rs["CD_ITEM_MATERIAL"]."')";

					mysql_query($SQL);

					

					$retorno = "document.form.VALIDADO.value = \"" ."S"."\";";

					$retorno.= "Validar();";

					echo stringToBinary($retorno);

			 	}	

			break;

		case "r_3" :  //procura WFA Servicos - inclusao de nota fiscal de devolu��o

				$Sql = " SELECT * ";

				$Sql.= " FROM nota_fiscal ";

				$Sql.= " WHERE pessoa_emitente = '" .$_GET['PESSOA_EMITENTE']. "'";

				$Sql.= "       AND pessoa_destinatario = '" .$_GET['PESSOA_DESTINATARIO']. "'";

				$Sql.= "       AND num_nf = '" .$_GET['NUM_NF']. "'";

				//$Sql.= "       AND SERIE_NF = '" .$_GET['SERIE_NF']. "'";

				$Stmt = mysql_query($Sql);

				if (!$Rs = mysql_fetch_assoc($Stmt)) {

					$retorno = "alert(\"" ."N�o foi localizada nenhuma nota fiscal para os dados informados.\\nFavor verificar !"."\");";

					$retorno.= "document.form.VALIDADO.value = \"" ."N"."\";";

					$retorno.= "Validar();";

					echo stringToBinary($retorno);

				}else{

					$ID = newIDO();

					$SQL = "INSERT INTO rar_servico_nf_dev (SERDV_IDO, SERDV_NUM_NF, SERDV_SERIE_NF, SERDV_PESSOA_EMITENTE, SERDV_SERVI_NUMERO) ";

					$SQL.= " VALUES ('".$ID."','".$Rs["NUM_NF"]."','".strtoupper($Rs["SERIE_NF"])."','".$Rs["PESSOA_DESTINATARIO"]."','".$_GET["SERVI_NUMERO"]."')";

					mysql_query($SQL);

					

					$retorno = "document.form.VALIDADO.value = \"" ."S"."\";";

					$retorno.= "Validar();";

					echo stringToBinary($retorno);

			 	}	

			break;

		case "r_4" :  //procura WFA Servicos - inclusao de duplicata

				$Sql = " SELECT * ";

				$Sql.= " FROM duplicata ";

				$Sql.= " WHERE pessoa_emitente = '" .$_GET['PESSOA_EMITENTE']. "'";

				$Sql.= "       AND num_nf = '" .$_GET['NUM_NF']. "'";

				$Sql.= "       AND SERIE_NF = '" .$_GET['SERIE_NF']. "'";

				$Sql.= "       AND parcela = '" .$_GET['PARCELA']. "'";

				$Stmt = mysql_query($Sql);

				if (!$Rs = mysql_fetch_assoc($Stmt)) {

					$retorno = "alert(\"" ."N�o foi localizada nenhuma duplicata para os dados informados.\\nFavor verificar !"."\");";

					$retorno.= "document.form.VALIDADO.value = \"" ."N"."\";";

					$retorno.= "Validar();";

					echo stringToBinary($retorno);

				}else{

					$ID = newIDO();

					$SQL = "INSERT INTO rar_servico_duplicata (SERDP_IDO, SERDP_NUM_NF, SERDP_SERIE_NF, SERDP_PESSOA_EMITENTE, SERDP_SERVI_NUMERO, SERDP_PARCELA) ";

					$SQL.= " VALUES ('".$ID."','".$_GET["NUM_NF"]."','".strtoupper($_GET["SERIE_NF"])."','".$_GET["PESSOA_EMITENTE"]."','".$_GET["SERVI_NUMERO"]."','".$_GET["PARCELA"]."')";

					mysql_query($SQL);

					

					$retorno = "document.form.VALIDADO.value = \"" ."S"."\";";

					$retorno.= "Validar();";

					echo stringToBinary($retorno);

			 	}	

			break;

		case "r_5" :  //procura WFA Servicos - inclusao de pedido de venda

				$Sql = " SELECT * ";

				$Sql.= " FROM pedido_venda ";

				$Sql.= " WHERE pessoa_empresa = '" .$_GET['PESSOA_EMITENTE']. "'";

				$Sql.= "       AND NUM_PEDD_VENDA = '" .$_GET['PEDIDO']. "'";

				$Sql.= "       AND PESSOA_CLIENTE = '" .$_GET['PESSOA_CLIENTE']. "'";

				$Stmt = mysql_query($Sql);

				if (!$Rs = mysql_fetch_assoc($Stmt)) {

					$retorno = "alert(\"" ."N�o foi localizado nenhum pedido de venda para os dados informados.\\nFavor verificar !"."\");";

					$retorno.= "document.form.VALIDADO.value = \"" ."N"."\";";

					$retorno.= "Validar();";

					echo stringToBinary($retorno);

				}else{

					$ID = newIDO();

					$SQL = "INSERT INTO rar_servico_pedido (SERPD_IDO, SERPD_NUM_PEDD_VENDA, SERPD_PESSOA_EMPRESA, SERPD_SERVI_NUMERO) ";

					$SQL.= " VALUES ('".$ID."','".$_GET["PEDIDO"]."','".strtoupper($_GET["PESSOA_EMITENTE"])."','".$_GET["SERVI_NUMERO"]."')";

					mysql_query($SQL);

					

					$retorno = "document.form.VALIDADO.value = \"" ."S"."\";";

					$retorno.= "Validar();";

					

					//$retorno = "alert(\"" .$SQL."\");";

					echo stringToBinary($retorno);

			 	}	

			break;

		case "r_7" :  //procura WFA Servicos - inclusao de pedido de venda + produto

				$Sql = " SELECT * ";

				$Sql.= " FROM pedido_venda P, item_pedido_venda IP ";

				$Sql.= " WHERE P.pessoa_empresa = '" .$_GET['PESSOA_EMITENTE']. "'";

				$Sql.= "       AND P.NUM_PEDD_VENDA = '" .$_GET['PEDIDO']. "'";

				$Sql.= "       AND PESSOA_CLIENTE = '" .$_GET['PESSOA_CLIENTE']. "'";

				$Sql.= "       AND cd_item_material = '" .$_GET['CD_ITEM_MATERIAL']. "'";

				$Sql.= "       AND P.pessoa_empresa = IP.pessoa_empresa";

				$Sql.= "       AND P.NUM_PEDD_VENDA = IP.NUM_PEDD_VENDA";

				$Stmt = mysql_query($Sql);

				if (!$Rs = mysql_fetch_assoc($Stmt)) {

					$retorno = "alert(\"" ."N�o foi localizado nenhum pedido de venda + produto para os dados informados.\\nFavor verificar !"."\");";

					$retorno.= "document.form.VALIDADO.value = \"" ."N"."\";";

					$retorno.= "Validar();";

					echo stringToBinary($retorno);

				}else{

					$ID = newIDO();

					$SQL = "INSERT INTO rar_servico_pedido_prod (SERPP_IDO, SERPP_NUM_PEDD_VENDA, SERPP_PESSOA_EMPRESA, SERPP_SERVI_NUMERO, SERPP_CD_ITEM_MATERIAL) ";

					$SQL.= " VALUES ('".$ID."','".$_GET["PEDIDO"]."','".strtoupper($_GET["PESSOA_EMITENTE"])."','".$_GET["SERVI_NUMERO"]."','".$_GET["CD_ITEM_MATERIAL"]."')";

					mysql_query($SQL);

					

					$retorno = "document.form.VALIDADO.value = \"" ."S"."\";";

					$retorno.= "Validar();";

					

					//$retorno = "alert(\"" .$SQL."\");";

					echo stringToBinary($retorno);

			 	}	

			break;

		case "r_8" :  //procura WFA Servicos - inclusao de nota fiscal + PRODUTO

				$Sql = " SELECT * ";

				$Sql.= " FROM item_nota_fiscal ";

				$Sql.= " WHERE pessoa_emitente = '" .$_GET['PESSOA_EMITENTE']. "'";

				$Sql.= "       AND num_nf = '" .$_GET['NUM_NF']. "'";

				$Sql.= "       AND CD_ITEM_MATERIAL = '" .$_GET['CD_ITEM_MATERIAL']. "'";

				$Stmt = mysql_query($Sql);

				if (!$Rs = mysql_fetch_assoc($Stmt)) {

					$retorno = "alert(\"" ."N�o foi localizada nenhum produto + nota fiscal para os dados informados.\\nFavor verificar !"."\");";

					$retorno.= "document.form.VALIDADO.value = \"" ."N"."\";";

					$retorno.= "Validar();";

					echo stringToBinary($retorno);

				}else{

					$ID = newIDO();

					$SQL = "INSERT INTO rar_servico_nf_prod_qtde (";

					$SQL.= "       SERPQ_IDO, SERPQ_NUM_NF, SERPQ_SERIE_NF, SERPQ_PESSOA_EMITENTE, ";

					$SQL.="        SERPQ_SERVI_NUMERO, SERPQ_CD_ITEM_MATERIAL, SERPQ_QTDE, SERPQ_GRADE) ";

					$SQL.= " VALUES (";

					$SQL.= "'".$ID."',";

					$SQL.= "'".$Rs["NUM_NF"]."',";

					$SQL.= "'".strtoupper($Rs["SERIE_NF"])."',";

					$SQL.= "'".$Rs["PESSOA_EMITENTE"]."',";

					$SQL.= "'".$_GET["SERVI_NUMERO"]."',";

					$SQL.= "'".$Rs["CD_ITEM_MATERIAL"]."',";

					$SQL.= "'".$_GET["QUANTIDADE"]."',";

					$SQL.= "'".$_GET["GRADE"]."'";

					$SQL.= ")";

					mysql_query($SQL);

					

					$retorno = "document.form.VALIDADO.value = \"" ."S"."\";";

					$retorno.= "Validar();";

					echo stringToBinary($retorno);

			 	}	

			break;

		case "r_9" :  //procura WFA Servicos - inclusao de nota fiscal + PRODUTO

			$Sql = " SELECT * ";

				$Sql.= " FROM item_material ";

				$Sql.= " WHERE CD_ITEM_MATERIAL = '" .$_GET['PRODUTO']. "'";

				$Stmt = mysql_query($Sql);

				if (!$Rs = mysql_fetch_assoc($Stmt)) {

					$retorno = "alert(\"" ."N�o foi localizado produto informado.\\nFavor verificar !"."\");";

					$retorno.= "document.form.VALIDADO.value = \"" ."N"."\";";

					$retorno.= "Validar();";

					echo stringToBinary($retorno);

				}else{

					$ID = newIDO();

					$SQL = "INSERT INTO rar_servico_prod_rec (";

					$SQL.= "       SERPC_IDO, SERPC_SERVI_NUMERO, SERPC_PRODUTO, SERPC_QTDE, ";

					$SQL.="        SERPC_VALOR) ";

					$SQL.= " VALUES (";

					$SQL.= "'".$ID."',";

					$SQL.= "'".$_GET["SERVI_NUMERO"]."',";

					$SQL.= "'".$_GET["PRODUTO"]."',";

					$SQL.= "'".$_GET["QUANTIDADE"]."',";

					$SQL.= "'".str_replace(",",".",$_GET["VALOR"])."'";

					$SQL.= ")";

					mysql_query($SQL);

					

					$retorno = "document.form.VALIDADO.value = \"" ."S"."\";";

					$retorno.= "Validar();";

					echo stringToBinary($retorno);

			 	}	

			break;

			

		case "r_10" :  //procura WFA Servicos - inclusao de nota fiscal + PRODUTO

			$ID = newIDO();

			$SQL = "INSERT INTO rar_servico_coleta (";

			$SQL.= "       SERCO_IDO, SERCO_SERVI_NUMERO, SERCO_VOLUME, SERCO_NF, SERCO_CATEGORIA) ";

			$SQL.= " VALUES (";

			$SQL.= "'".$ID."',";

			$SQL.= "'".$_GET["SERVI_NUMERO"]."',";

			$SQL.= "'".$_GET["VOLUME"]."',";

			$SQL.= "'".$_GET["NUM_NF"]."',";

			$SQL.= "'".$_GET["CATEGORIA"]."'";

			$SQL.= ")";

			mysql_query($SQL);

				

			$retorno = "document.form.VALIDADO.value = \"" ."S"."\";";

			$retorno.= "Validar();";

			echo stringToBinary($retorno);



			break;

		case "r_11" :  //procura WFA Servicos - inclusao de nota fiscal + PRODUTO + n.� par

				$Sql = " SELECT * ";

				$Sql.= " FROM item_nota_fiscal ";

				$Sql.= " WHERE pessoa_emitente = '" .$_GET['PESSOA_EMITENTE']. "'";

				$Sql.= "       AND num_nf = '" .$_GET['NUM_NF']. "'";

				$Sql.= "       AND CD_ITEM_MATERIAL = '" .$_GET['CD_ITEM_MATERIAL']. "'";

				$Stmt = mysql_query($Sql);

				if (!$Rs = mysql_fetch_assoc($Stmt)) {

					$retorno = "alert(\"" ."N�o foi localizada nenhum produto + nota fiscal para os dados informados.\\nFavor verificar !"."\");";

					$retorno.= "document.form.VALIDADO.value = \"" ."N"."\";";

					$retorno.= "Validar();";

					echo stringToBinary($retorno);

				}else{

					$ID = newIDO();

					$SQL = "INSERT INTO rar_servico_nf_prod_qtde_par (";

					$SQL.= "       SERPP_IDO, SERPP_NUM_NF, SERPP_SERIE_NF, SERPP_PESSOA_EMITENTE, ";

					$SQL.="        SERPP_SERVI_NUMERO, SERPP_CD_ITEM_MATERIAL, SERPP_QTDE, SERPP_PAR) ";

					$SQL.= " VALUES (";

					$SQL.= "'".$ID."',";

					$SQL.= "'".$Rs["NUM_NF"]."',";

					$SQL.= "'".strtoupper($Rs["SERIE_NF"])."',";

					$SQL.= "'".$Rs["PESSOA_EMITENTE"]."',";

					$SQL.= "'".$_GET["SERVI_NUMERO"]."',";

					$SQL.= "'".$Rs["CD_ITEM_MATERIAL"]."',";

					$SQL.= "'".$_GET["QUANTIDADE"]."',";

					$SQL.= "'".$_GET["PAR"]."'";

					$SQL.= ")";

					mysql_query($SQL);

					

					$retorno = "document.form.VALIDADO.value = \"" ."S"."\";";

					$retorno.= "Validar();";

					echo stringToBinary($retorno);

			 	}	

			break;

		case "r_12" :  //procura WFA Servicos - inclusao de nota fiscal + valor royaltie

				$Sql = " SELECT * ";

				$Sql.= " FROM nota_fiscal ";

				$Sql.= " WHERE pessoa_emitente = '" .$_GET['PESSOA_EMITENTE']. "'";

				$Sql.= "       AND num_nf = '" .$_GET['NUM_NF']. "'";

				$Stmt = mysql_query($Sql);

				if (!$Rs = mysql_fetch_assoc($Stmt)) {

					$retorno = "alert(\"" ."N�o foi localizada nenhuma nota fiscal para os dados informados.\\nFavor verificar !"."\");";

					$retorno.= "document.form.VALIDADO.value = \"" ."N"."\";";

					$retorno.= "Validar();";

					echo stringToBinary($retorno);

				}else{

					$ID = newIDO();

					$SQL = "INSERT INTO rar_servico_nf_royaltie (SERRO_IDO, SERRO_NUM_NF, SERRO_SERIE_NF, SERRO_PESSOA_EMITENTE, SERRO_SERVI_NUMERO, SERRO_VALOR) ";

					$SQL.= " VALUES ('".$ID."','".$Rs["NUM_NF"]."','".strtoupper($Rs["SERIE_NF"])."','".$Rs["PESSOA_EMITENTE"]."','".$_GET["SERVI_NUMERO"]."','".str_replace(",",".",$_GET["VALOR"])."')";

					mysql_query($SQL);

					

					$retorno = "document.form.VALIDADO.value = \"" ."S"."\";";

					$retorno.= "Validar();";

					echo stringToBinary($retorno);

			 	}	

			break;

		case "r_13" :  //procura WFA Servicos - inclusao de solicitacao de material

			if ($_POST['SERSM_IDO'] == ""){

				$Sql = " SELECT * ";

				$Sql.= " FROM item_material ";

				$Sql.= " WHERE CD_ITEM_MATERIAL = '" .$_POST['REFERENCIA']. "'";
                                echo $Sql;die;

				$Stmt = mysql_query($Sql);

				if (!$Rs = mysql_fetch_assoc($Stmt)) {

					//$retorno = "alert(\"" ."Refer�ncia de produto n�o localizada no banco de dados.\\nFavor verificar !"."\");";

					//$retorno.= "document.form.VALIDADO.value = \"" ."N"."\";";

					//$retorno.= "Validar();";

					//echo stringToBinary($retorno);

					header("Location: pesq_wfarec_inclusao_registro.php?validado=N&operacao=erro_referencia");

				}else{

					$ID = newIDO();

					

					$FP = "";

					if ($_FILES['fileSolicitacaoMaterial']['name']!=""){

						$FP = str_replace("-","_",$ID). "_SM." .substr($_FILES['fileSolicitacaoMaterial']['name'],strrpos($_FILES['fileSolicitacaoMaterial']['name'],".") + 1);

						copy($_FILES['fileSolicitacaoMaterial']['tmp_name'],$PathImagens .$FP);

					}

					

					$SQL = "INSERT INTO rar_servico_solicitacaomaterial (";

					$SQL.= "       SERSM_IDO, SERSM_SERVI_NUMERO, SERSM_DESCRICAO, SERSM_REFERENCIA, SERSM_QUANTIDADE, SERSM_FABRICANTE, SERSM_MATERG_IDO, SERSM_IMAGEM) ";

					$SQL.= " VALUES (";

					$SQL.= "'".$ID."',";

					$SQL.= "'".$_POST["SERVI_NUMERO"]."',";

					$SQL.= "'".strtoupper($_POST["DESCRICAO"])."',";

					$SQL.= "'".$_POST["REFERENCIA"]."',";

					$SQL.= "'".$_POST["QUANTIDADE"]."',";

					$SQL.= "".CodigoFabricante($_POST["REFERENCIA"]).",";

					$SQL.= "'".$_POST["SERSM_MATERG_IDO"]."',";

					$SQL.= "'".$FP."'";

					$SQL.= ")";

					mysql_query($SQL);

					header("Location: pesq_wfarec_inclusao_registro.php?validado=S&operacao=fechar");

				}

				

			}else{

				$SQL = " UPDATE rar_servico_solicitacaomaterial ";

				$SQL.= "        set SERSM_MATERG_IDO = '".$_POST["SERSM_MATERG_IDO"]."' ";

				$SQL.="  where sersm_ido = '".$_POST["SERSM_IDO"]."'";

				mysql_query($SQL);

				header("Location: pesq_wfarec_inclusao_registro.php?validado=SS");

			}

			

			break;

		case "pdv_5" :  //WFA PDV - inclusao de telemarketing

			$ID = newIDO();

			$SQL = "INSERT INTO rar_pdv_registro_telemarketing (";

			$SQL.= "       REGTL_IDO, REGTL_PDVRG_IDO, REGTL_PESSOA, REGTL_QTDE) ";

			$SQL.= " VALUES (";

			$SQL.= "'".$ID."',";

			$SQL.= "'".$_GET["NUMERO"]."',";

			$SQL.= "'".$_GET["PESSOA"]."',";

			$SQL.= "'".$_GET["QUANTIDADE"]."'";

			$SQL.= ")";

			mysql_query($SQL);

				

			$retorno = "document.form.VALIDADO.value = \"" ."S"."\";";

			$retorno.= "Validar();";

			echo stringToBinary($retorno);



			break;

		

		case "r_rarcom" :  //inclusao de produto - rar comercial

				$Sql = " SELECT * ";

				$Sql.= " FROM item_nota_fiscal ";

				$Sql.= " WHERE pessoa_emitente = '" .$_GET['PESSOA_EMITENTE']. "'";

				$Sql.= "       AND num_nf = '" .$_GET['NUM_NF']. "'";

				//$Sql.= "       AND CD_ITEM_MATERIAL = '" .$_GET['CD_ITEM_MATERIAL']. "'";

				$Stmt = mysql_query($Sql);

				if (!$Rs = mysql_fetch_assoc($Stmt)) {

					$retorno = "alert(\"" ."N�o foi localizada nenhum produto + nota fiscal para os dados informados.\\nFavor verificar !"."\");";

					$retorno.= "document.form.VALIDADO.value = \"" ."N"."\";";

					$retorno.= "Validar();";

					echo stringToBinary($retorno);

				}else{

					$ID = newIDO();

					$SQL = "INSERT INTO rar_servico_rarcom (";

					$SQL.= "       SERRC_IDO, SERRC_NUM_NF, SERRC_SERIE_NF, SERRC_PESSOA_EMITENTE, ";

					$SQL.="        SERRC_SERVI_NUMERO, SERRC_CD_ITEM_MATERIAL, SERRC_QTDE) ";

					$SQL.= " VALUES (";

					$SQL.= "'".$ID."',";

					$SQL.= "'".$Rs["NUM_NF"]."',";

					$SQL.= "'".strtoupper($Rs["SERIE_NF"])."',";

					$SQL.= "'".$Rs["PESSOA_EMITENTE"]."',";

					$SQL.= "'".$_GET["SERVI_NUMERO"]."',";

					//$SQL.= "'".$Rs["CD_ITEM_MATERIAL"]."',";

					$SQL.= "'".$_GET['CD_ITEM_MATERIAL']."',";

					$SQL.= "'".$_GET["QUANTIDADE"]."'";

					$SQL.= ")";

					mysql_query($SQL);

					

					$retorno = "document.form.VALIDADO.value = \"" ."S"."\";";

					$retorno.= "Validar();";

					echo stringToBinary($retorno);

			 	}	

			break;

		

		case "r_prorrogacao" :  //inclusao de produto - rar comercial

				$ID = newIDO();

				$SQL = "INSERT INTO rar_servico_prorrogacao_item (";

				$SQL.= "       SPROI_IDO, SPROI_SPROR_IDO, SPROI_DUPLICATA, SPROI_HISTORICO, ";

				$SQL.= "       SPROI_NUMBANCARIO, SPROI_BANCO, SPROI_EMISSAO, SPROI_VENCIMENTO, ";

				$SQL.= "       SPROI_VENCIMENTO_PRORROGACAO, SPROI_VALOR) ";

				$SQL.= " VALUES (";

				$SQL.= "'".$ID."',";

				$SQL.= "'".$_GET["ID"]."',";

				$SQL.= "'".$_GET["SPROI_DUPLICATA"]."',";

				$SQL.= "'".$_GET["SPROI_HISTORICO"]."',";

				$SQL.= "'".$_GET["SPROI_NUMBANCARIO"]."',";

				$SQL.= "'".$_GET["SPROI_BANCO"]."',";

				$SQL.= "'".formatadata($_GET["SPROI_EMISSAO"])."',";

				$SQL.= "'".formatadata($_GET["SPROI_VENCIMENTO"])."',";

				$SQL.= "'".formatadata($_GET["SPROI_VENCIMENTO_PRORROGACAO"])."',";

				$SQL.= "'".str_replace(",",".",$_GET["SPROI_VALOR"])."')";

				mysql_query($SQL);

					

				$retorno = "document.form.VALIDADO.value = \"" ."S"."\";";

				$retorno.= "Validar();";

				echo stringToBinary($retorno);

				

			break;

		

		

		case "iaf_pa_inc" :  //inclusao de plano de a��o - iaf

				if ($_GET['QUEPA_IDO'] != ""){

					$SQL = " UPDATE iaf_questionario_item_planoacao SET ";

					$SQL.= "        QUEPA_QUEIT_IDO = '".$_GET["QUEPA_QUEIT_IDO"]."',";

					$SQL.= "        QUEPA_DESCRICAO = '".str_replace("'","''",$_GET["QUEPA_DESCRICAO"])."',";

					$SQL.= "        QUEPA_DATAPREVISTA = '".formatadata($_GET["QUEPA_DATAPREVISTA"])."'";

					$SQL.= " where quepa_ido = '".$_GET['QUEPA_IDO']."'";

					mysql_query($SQL);

				}else{

					$ID = newIDO();

					$SQL = "INSERT INTO iaf_questionario_item_planoacao (";

					$SQL.= "       QUEPA_IDO, QUEPA_QUEIT_IDO, QUEPA_DESCRICAO, QUEPA_DATAPREVISTA) ";

					$SQL.= " VALUES (";

					$SQL.= "'".$ID."',";

					$SQL.= "'".$_GET["QUEPA_QUEIT_IDO"]."',";

					$SQL.= "'".str_replace("'","''",$_GET["QUEPA_DESCRICAO"])."',";

					$SQL.= "'".formatadata($_GET["QUEPA_DATAPREVISTA"])."'";

					$SQL.= ")";

					mysql_query($SQL);

				}

				$retorno = "document.form.VALIDADO.value = \"" ."S"."\";";

				$retorno.= "Validar();";

				echo stringToBinary($retorno);

			break;

		case "iaf_paacomp_inc" :  //inclusao de acompanhamento - plano de a��o - iaf

				if ($_GET['QUEAC_IDO'] != ""){

					$SQL = " UPDATE iaf_questionario_item_planoacao_acomp SET ";

					$SQL.= "        QUEAC_QUEPA_IDO = '".$_GET["QUEAC_QUEPA_IDO"]."',";

					$SQL.= "        QUEAC_DATA = NOW(),";

					$SQL.= "        QUEAC_USUAR_IDO = '".$_SESSION['sId']."',";

					$SQL.= "        QUEAC_ACOMPANHAMENTO = '".str_replace("'","''",$_GET["QUEAC_ACOMPANHAMENTO"])."',";

					$SQL.= "        QUEAC_STATUS = '".$_GET["QUEAC_STATUS"]."'";

					if ($_GET["QUEAC_STATUS"] == 0){

						$SQL.= "        ,QUEAC_DATAPREVISTA = '".formatadata($_GET["QUEPA_DATAPREVISTA"])."'";

					}else{

						$SQL.= "        ,QUEAC_DATAPREVISTA = Null";

					}

					$SQL.= " where QUEAC_IDO = '".$_GET['QUEAC_IDO']."'";

					mysql_query($SQL);

				}else{

					$ID = newIDO();

					$SQL = "INSERT INTO iaf_questionario_item_planoacao_acomp (";

					$SQL.= "       QUEAC_IDO, QUEAC_USUAR_IDO, QUEAC_DATA, QUEAC_QUEPA_IDO, QUEAC_ACOMPANHAMENTO, QUEAC_STATUS, QUEAC_DATAPREVISTA) ";

					$SQL.= " VALUES (";

					$SQL.= "'".$ID."',";

					$SQL.= "'".$_SESSION['sId']."',";

					$SQL.= "now(),";

					$SQL.= "'".$_GET["QUEAC_QUEPA_IDO"]."',";

					$SQL.= "'".str_replace("'","''",$_GET["QUEAC_ACOMPANHAMENTO"])."',";

					$SQL.= "'".$_GET["QUEAC_STATUS"]."'";

					if ($_GET["QUEAC_STATUS"] == 0){

						$SQL.= ",'".formatadata($_GET["QUEPA_DATAPREVISTA"])."'";

					}else{

						$SQL.= ",Null";

					}

					$SQL.= ")";

					mysql_query($SQL);

				}

				

				if ($_GET['QUEAC_STATUS'] == 0){

					$SQL = " UPDATE iaf_questionario_item_planoacao SET ";

					$SQL.= "        QUEPA_DATAPREVISTA = '".formatadata($_GET["QUEPA_DATAPREVISTA"])."'";

					$SQL.= " where QUEPA_IDO = '".$_GET['QUEAC_QUEPA_IDO']."'";

					mysql_query($SQL);

				}

				if ($_GET['QUEAC_STATUS'] == 1){

					$SQL = " UPDATE iaf_questionario_item_planoacao SET ";

					$SQL.= "        QUEPA_DATAREALIZADA = now()";

					$SQL.= " where QUEPA_IDO = '".$_GET['QUEAC_QUEPA_IDO']."'";

					mysql_query($SQL);

				}

				

				$retorno = "document.form.VALIDADO.value = \"" ."S"."\";";

				$retorno.= "Validar();";

				echo stringToBinary($retorno);

			break;

		case "remover" :  //Remove WFA Servicos

			if ($_GET['Tipo'] == 1){

				$SQL = "delete from rar_servico_nf ";

				$SQL.= " where SERNF_IDO = '".$_GET['Ids']."'";

				mysql_query($SQL);

			}

			

			if ($_GET['Tipo'] == 2){

				$SQL = "delete from rar_servico_nf_prod ";

				$SQL.= " where SERPR_IDO = '".$_GET['Ids']."'";

				mysql_query($SQL);

			}

			

			if ($_GET['Tipo'] == 3){

				$SQL = "delete from rar_servico_nf_dev ";

				$SQL.= " where SERDV_IDO = '".$_GET['Ids']."'";

				mysql_query($SQL);

			}

			

			if ($_GET['Tipo'] == 4){

				$SQL = "delete from rar_servico_duplicata ";

				$SQL.= " where SERDP_IDO = '".$_GET['Ids']."'";

				mysql_query($SQL);

			}

			

			if ($_GET['Tipo'] == 5){

				$SQL = "delete from rar_servico_pedido ";

				$SQL.= " where SERPD_IDO = '".$_GET['Ids']."'";

				mysql_query($SQL);

			}

			

			if ($_GET['Tipo'] == 6){

				$SQL = "delete from rar_servico_nf_prod_dev ";

				$SQL.= " where SPRNF_IDO = '".$_GET['Ids']."'";

				mysql_query($SQL);

			}

			

			if ($_GET['Tipo'] == 8){

				$SQL = "delete from rar_servico_nf_prod_qtde ";

				$SQL.= " where SERPQ_IDO = '".$_GET['Ids']."'";

				mysql_query($SQL);

			}

			

			if ($_GET['Tipo'] == 9){

				$SQL = "delete from rar_servico_prod_rec ";

				$SQL.= " where serpc_ido = '".$_GET['Ids']."'";

				mysql_query($SQL);

			}

			

			if ($_GET['Tipo'] == 10){

				$SQL = "delete from rar_servico_coleta ";

				$SQL.= " where serco_ido = '".$_GET['Ids']."'";

				mysql_query($SQL);

			}

			

			if ($_GET['Tipo'] == 11){

				$SQL = "delete from iaf_questionario_item_planoacao ";

				$SQL.= " where QUEPA_IDO = '".$_GET['Ids']."'";

				mysql_query($SQL);

			}

			

			if ($_GET['Tipo'] == 12){

				$SQL = "delete from rar_servico_nf_prod_qtde_par ";

				$SQL.= " where SERPP_IDO = '".$_GET['Ids']."'";

				mysql_query($SQL);

			}

			

			if ($_GET['Tipo'] == 13){

				$SQL = "delete from rar_servico_nf_royaltie ";

				$SQL.= " where SERRO_IDO = '".$_GET['Ids']."'";

				mysql_query($SQL);

			}

			

			if ($_GET['Tipo'] == 14){

				$Sql = " select * from iaf_questionario_item_planoacao_acomp";

				$Sql.= " where queac_ido = '".$_GET['Ids']."'";

				$Stmti = mysql_query($Sql);

				if ($Rsi = mysql_fetch_assoc($Stmti)) {

					$QUEAC_QUEPA_IDO = $Rsi["QUEAC_QUEPA_IDO"];

					echo("QUEAC_QUEPA_IDO = ".$QUEAC_QUEPA_IDO."<br>");

				}

				

				$SQL = "delete from iaf_questionario_item_planoacao_acomp ";

				$SQL.= " where QUEAC_IDO = '".$_GET['Ids']."'";

				mysql_query($SQL);

				

				//procura ultimo registro de acompanhamento para o plano de a��o em quest�o

				$Sql = " select * from iaf_questionario_item_planoacao_acomp";

				$Sql.= " where QUEAC_QUEPA_IDO = '".$QUEAC_QUEPA_IDO."'";

				$Sql.= " order by queac_data desc";

				$Stmti = mysql_query($Sql);

				if ($Rsi = mysql_fetch_assoc($Stmti)) {

					if ($Rsi["QUEAC_STATUS"] == "1"){ //se status = concluido, atualiza DATAREALIZADA = DATA ACOMPANHAMENTO

						$Sql = " update iaf_questionario_item_planoacao set";

						$Sql.= "        quepa_datarealizada = '".($Rsi["QUEAC_DATA"])."'";

						$Sql.= " where quepa_ido = '".$QUEAC_QUEPA_IDO."'";

						mysql_query($Sql);

					}else{  //se status = PENDENTE, atualiza DATAPREVISTA = DATA ACOMPANHAMENTO e zera campo DATAREALIZADA

						$Sql = " update iaf_questionario_item_planoacao set";

						$Sql.= "        quepa_dataprevista = '".($Rsi["QUEAC_DATAPREVISTA"])."'";

						$Sql.= "        , quepa_datarealizada = null ";

						$Sql.= " where quepa_ido = '".$QUEAC_QUEPA_IDO."'";

						mysql_query($Sql);

					}

				}else{ //se nao houver mais nenhum registro, limpa DATAREALIZADA e seta DATAPREVISTA = DATA ORIGINAL

					$Sql = " update iaf_questionario_item_planoacao set";

					$Sql.= "        quepa_dataprevista = quepa_dataprevistainicial, quepa_datarealizada = null";

					$Sql.= " where quepa_ido = '".$QUEAC_QUEPA_IDO."'";

					mysql_query($Sql);

				}

			}

			

			if ($_GET['Tipo'] == 15){

				$SQL = "delete from rar_servico_solicitacaomaterial ";

				$SQL.= " where SERSM_IDO = '".$_GET['Ids']."'";

				mysql_query($SQL);

			}

			

			if ($_GET['Tipo'] == "rarcom"){

				$SQL = "delete from rar_servico_rarcom ";

				$SQL.= " where SERRC_IDO = '".$_GET['Ids']."'";

				mysql_query($SQL);

			}

			

			if ($_GET['Tipo'] == "prorrogacao"){

				$SQL = "delete from rar_servico_prorrogacao_item ";

				$SQL.= " where SPROI_IDO = '".$_GET['Ids']."'";

				mysql_query($SQL);

			}

			

			if ($_GET['Tipo'] == "pdv"){

				$SQL = "delete from rar_pdv_registro_telemarketing ";

				$SQL.= " where REGTL_IDO = '".$_GET['Ids']."'";

				mysql_query($SQL);

			}

			

			if ($_GET['Tipo'] == "wfapesq"){

				$SQL = "delete from wfa_pesquisa_item_resposta ";

				$SQL.= " where PITRE_IDO = '".$_GET['Ids']."'";

				mysql_query($SQL);

			}

			

			echo stringToBinary($retorno);

			break;

		case "p_r" :

                                $Sql = "SELECT ref_mat.GRUPO_MATERIAL,
                                             p.NOME,
                                             item_nf.CD_ITEM_MATERIAL,
                                             nf.PESSOA_EMITENTE,
                                             nf.NUM_NF,
                                             nf.SERIE_NF, 
                                             date_format(nf.dt_emis_nf,'%d/%m/%Y') as DT_EMIS_NF , 
                                             datediff(CURRENT_DATE(),dt_emis_nf) as DIAS,
                                             nf.NUM_NF,
                                             item_nf.CD_ITEM_MATERIAL ,
                                             item_nf.CD_COLECAO ,
                                             item_nf.LANCAMENTO ,
                                             item_nf.VL_UNITARIO_ITEM ,
                                             item_nf.VL_ROYL_CLIN_NORMAL,
                                             sum(item_nf.TL_ITEM) as TL_ITEM
                                    FROM item_nota_fiscal item_nf
                                    INNER JOIN nota_fiscal nf ON item_nf.NUM_NF = nf.NUM_NF
                                    JOIN item_material item_mat ON item_nf.cd_item_material = item_mat.cd_item_material
                                    JOIN referencia_material ref_mat ON ref_mat.rf_material = item_mat.rf_material
                                    JOIN pessoa p ON	p.PESSOA = item_nf.pessoa_emitente
                                    WHERE nf.pessoa_destinatario = '" .@$_GET['PESSOA']. "' AND item_nf.cd_item_material = " . $_GET['REFERENCIA']. " AND datediff(CURRENT_DATE(),dt_emis_nf) <= 180
                                    GROUP BY ref_mat.GRUPO_MATERIAL, 
                                                            p.nome, 
                                                            nf.PESSOA_EMITENTE, 
                                                            nf.NUM_NF,
                                                            nf.SERIE_NF,
                                                            nf.DT_EMIS_NF ,
                                                            item_nf.CD_ITEM_MATERIAL ,
                                                            item_nf.CD_COLECAO ,
                                                            item_nf.LANCAMENTO ,
                                                            item_nf.VL_UNITARIO_ITEM ,
                                                            item_nf.VL_ROYL_CLIN_NORMAL";
				$Stmt = mysql_query($Sql);
				if (@$Rs = mysql_fetch_assoc($Stmt)) { 
						/*$Stmt = mysql_query($Sql);
						$Rs = mysql_fetch_assoc($Stmt);
						if ($Rs["DIAS"]  > 9999 && $_GET['PESSOA'] != "18500"){
							$retorno.= "alert(\"" ."A NF selecionada foi comercializada a mais de 6 meses. Selecione outra NF !"."\");";
						}else{
							if ($Rs["grupo_material"]  != $_GET['Categoria']){
								$retorno.= "alert(\"" ."A categoria selecionada n�o pertence a refer�ncia informada !"."\");";
							}else{
								$retorno = "document.form.ITEM_COLECAO.value = \"" .$Rs["CD_COLECAO"] ."\";";
								$retorno.= "document.form.ITEM_DATA_EMISSAO.value = \"" .$Rs["DT_EMIS_NF"] ."\";";
								$retorno.= "document.form.ITEM_VALOR_UNITARIO.value = 'R$ ' + arredondaNumber(\"" .str_replace(",",".",$Rs["VL_UNITARIO_ITEM"]) ."\",',',2,true);";
								$retorno.= "document.form.ITEM_VALOR_ROYALTIE.value = 'R$ ' + arredondaNumber(\"" .str_replace(",",".",$Rs["VL_ROYL_CLIN_NORMAL"]) ."\",',',2,true);";
								$retorno.= "document.form.ITEM_PESSOA_EMITENTE.value = \"" .$Rs["PESSOA_EMITENTE"] ."\";";
								$retorno.= "document.form.ITEM_SERIE.value = \"" .$Rs["SERIE_NF"] ."\";";
								$retorno.= "document.form.TOTAL_ITENS.value = \"" .$Rs["TL_ITEM"] ."\";";
								$retorno.= "document.form.ITEM_NF.value = \"" .$Rs["NUM_NF"] ."\";";
								$retorno.= "document.form.DIAS.value = \"" .$Rs["DIAS"] ."\";";
								$retorno.= "updateFabrica();";
							}
						}*/
                                            /*if ((int)$Rs["GRUPO_MATERIAL"] !== (int)$_GET['Categoria']){
                                                    $retorno.= "alert(\"" ."A categoria selecionada n�o pertence a refer�ncia informada !"."\");";
                                            }else{*/
                                                $retorno = "abrir_janela_popup('consulta_nf.php?Pessoa=" .urlencode($_GET['PESSOA']). "&Referencia=" .urlencode($_GET['REFERENCIA']). "&ClienteNome=" .urlencode($_GET['NOMECLIENTE']). "','popup_nf','width=500,height=280,top=0,left=0, scrollbars=yes,status=yes,resizable=no,dependent=yes');";
                                                $retorno.= "selectCategoria(".$Rs["GRUPO_MATERIAL"].");";
                                                $retorno.= "clearNF();";
                                            //}

				}else{

					//incluido em 17/11/2005

					//motivo: se nao achar pela loja atual, o sistema busca ainda pela loja antiga

					$Sql =  "select r.grupo_material, clien_col_lojaant_1, clien_col_lojaant_2, clien_col_lojaant_3, clien_col_lojaant_4,".

					        "       clien_col_lojaant, P.NOME, nofi.PESSOA_EMITENTE,nofi.NUM_NF,nofi.SERIE_NF,".

							"       date_format(nofi.dt_emis_nf,'%d/%m/%Y') DT_EMIS_NF ". 

							"       ,datediff(CURRENT_DATE(),dt_emis_nf) DIAS ".

							"	    ,itnf.CD_ITEM_MATERIAL ". 

							"       ,itnf.CD_COLECAO ". 

							"       ,itnf.LANCAMENTO ". 

							"       ,itnf.VL_UNITARIO_ITEM ".

							"       ,itnf.VL_ROYL_CLIN_NORMAL ". 

							"       ,sum(itnf.TL_ITEM) as TL_ITEM ". 

							" from item_nota_fiscal     itnf ". 

							"     ,nota_fiscal          nofi ".

							"     ,pessoa               P ".

							"     ,item_material        im ".

							"     ,referencia_material  r ".

							"     ,rar_cliente_coleta   cc ".

							"where nofi.pessoa_emitente = itnf.pessoa_emitente ". 

							"  and nofi.serie_nf        = itnf.serie_nf ". 

							"  and P.PESSOA             = itnf.pessoa_emitente ". 



							"  and nofi.num_nf          = itnf.num_nf ". 

							"  and itnf.cd_item_material = im.cd_item_material ".

							"  and r.rf_material         = im.rf_material ".

							"  and cc.clien_col_pessoa  = '" .$_GET['PESSOA']. "' ".

							" AND ( ".

							"       nofi.pessoa_destinatario = cc.clien_col_lojaant or ".

							"       nofi.pessoa_destinatario = cc.clien_col_lojaant_1 or ".

							"       nofi.pessoa_destinatario = cc.clien_col_lojaant_2 or ". 

							"       nofi.pessoa_destinatario = cc.clien_col_lojaant_3 or ". 

							"       nofi.pessoa_destinatario = cc.clien_col_lojaant_4 ) ";

							if (trim($_GET['NF'])) {

								$Sql.= "  and nofi.num_nf  = '" .$_GET['NF']. "'";

							}

							$Sql.= "  and itnf.cd_item_material = '" . $_GET['REFERENCIA']. "' ". 

							" group by r.grupo_material, clien_col_lojaant, ".

							"       clien_col_lojaant_1, clien_col_lojaant_2, clien_col_lojaant_3, clien_col_lojaant_4,".

							"       P.NOME, nofi.PESSOA_EMITENTE, nofi.NUM_NF,nofi.SERIE_NF,".

							"       DT_EMIS_NF ". 

							"	    ,itnf.CD_ITEM_MATERIAL ". 

							"       ,itnf.CD_COLECAO ". 

							"       ,itnf.LANCAMENTO ". 

							"       ,itnf.VL_UNITARIO_ITEM ".

							"       ,itnf.VL_ROYL_CLIN_NORMAL ";

							//echo($Sql."<br>");

					$Stmt = mysql_query($Sql);

					if ($Rs = mysql_fetch_assoc($Stmt)) {  

						if (!$Rs = mysql_fetch_assoc($Stmt)) {

							$Stmt = mysql_query($Sql);

							$Rs = mysql_fetch_assoc($Stmt);

							if ($Rs["DIAS"]  > 9999 && $_GET['PESSOA'] != "18500"){

								$retorno.= "alert(\"" ."A NF selecionada foi comercializada a mais de 6 meses. Selecione outra NF !"."\");";

							}else{

								if ($Rs["grupo_material"]  != $_GET['Categoria']){

									$retorno.= "alert(\"" ."A categoria selecionada n�o pertence a refer�ncia informada !"."\");";

								}else{

									$retorno = "document.form.ITEM_COLECAO.value = \"" .$Rs["CD_COLECAO"] ."\";";

									$retorno.= "document.form.ITEM_DATA_EMISSAO.value = \"" .$Rs["DT_EMIS_NF"] ."\";";

									$retorno.= "document.form.ITEM_VALOR_UNITARIO.value = 'R$ ' + arredondaNumber(\"" .str_replace(",",".",$Rs["VL_UNITARIO_ITEM"]) ."\",',',2,true);";

									$retorno.= "document.form.ITEM_VALOR_ROYALTIE.value = 'R$ ' + arredondaNumber(\"" .str_replace(",",".",$Rs["VL_ROYL_CLIN_NORMAL"]) ."\",',',2,true);";

									$retorno.= "document.form.ITEM_PESSOA_EMITENTE.value = \"" .$Rs["PESSOA_EMITENTE"] ."\";";

									$retorno.= "document.form.ITEM_SERIE.value = \"" .$Rs["SERIE_NF"] ."\";";

									$retorno.= "document.form.TOTAL_ITENS.value = \"" .$Rs["TL_ITEM"] ."\";";

									$retorno.= "document.form.ITEM_NF.value = \"" .$Rs["NUM_NF"] ."\";";

									$retorno.= "document.form.DIAS.value = \"" .$Rs["DIAS"] ."\";";

									$retorno.= "updateFabrica();";

								}

							}

						}else{

							$Loja = "";

							if ($Rs["clien_col_lojaant"] != ""){

								$Loja=$Loja.$Rs["clien_col_lojaant"] .",";

							}

							if ($Rs["clien_col_lojaant_1"] != ""){

								$Loja=$Loja.$Rs["clien_col_lojaant_1"] .",";

							}

							if ($Rs["clien_col_lojaant_2"] != ""){

								$Loja=$Loja.$Rs["clien_col_lojaant_2"] .",";

							}

							if ($Rs["clien_col_lojaant_3"] != ""){

								$Loja=$Loja.$Rs["clien_col_lojaant_3"] .",";

							}

							if ($Rs["clien_col_lojaant_4"] != ""){

								$Loja=$Loja.$Rs["clien_col_lojaant_4"] .",";

							}

							if ($Loja != ""){

								//$Loja = substr($Loja,1,strlen($Loja)-1);

							}

								

								

							//$retorno = "abrir_janela_popup('consulta_nf.php?Pessoa=" .urlencode($Rs["clien_col_lojaant"]). "&Referencia=" .urlencode($_GET['REFERENCIA']). "&ClienteNome=" .urlencode($_GET['NOMECLIENTE']). "','popup_nf','width=500,height=280,top=0,left=0, scrollbars=yes,status=yes,resizable=no,dependent=yes');";

							$retorno = "abrir_janela_popup('consulta_nf.php?Pessoa=" .urlencode($Loja). "&Referencia=" .urlencode($_GET['REFERENCIA']). "&ClienteNome=" .urlencode($_GET['NOMECLIENTE']). "','popup_nf','width=500,height=280,top=0,left=0, scrollbars=yes,status=yes,resizable=no,dependent=yes');";

							$retorno.= "clearNF();";

						}

					}else{

						$retorno = "alert('A nota fiscal informada n�o foi localizada no banco e dados !');";				

						$retorno.= "clearNF();";

					}

				}

				$retorno.= "calcAll();";

				echo stringToBinary($retorno);

			break;

			

		case "p_f" :

			/*$Sql = "select distinct".

							   " peco.PESSOA_FORNECEDOR as CODIGO_PESSOA".

							   " ,pess.NOME as NOME".

							   " ,pess.CGCCPF as CNPJ".

							   " ,itpv.CD_ITEM_MATERIAL as REFERENCIA".

						" from item_pedido_compra itpv".

		 " inner join pedido_compra peco on peco.num_pedd_compra  = itpv.NUM_PEDD_COMPRA ".
		 " and peco.pessoa_empresa    = itpv.pessoa_empresa ".
		 " inner join pessoa pess on  peco.pessoa_fornecedor = pess.pessoa ".
         " where   itpv.cd_item_material = '".$_GET['REFERENCIA']. "' ";*/
		 
			
					$Sql = "select pessoa as CODIGO_PESSOA". 
					
					      ",PESSOA.nome as NOME".
						  
						  ",pessoa.CGCCPF as CNPJ".
						  
						 ",ITEM_MATERIAL.CD_ITEM_MATERIAL as REFERENCIA".

						" from ITEM_MATERIAL INNER JOIN PESSOA ON ITEM_MATERIAL.FABRICANTE=PESSOA.FANTASIA".

					    " WHERE ITEM_MATERIAL.CD_ITEM_MATERIAL = '".$_GET['REFERENCIA']. "' ";

					

			$Stmt = mysql_query($Sql);

			$x = 0;

			while($Rs = mysql_fetch_assoc($Stmt))

				$x++;

			

			/* $Sql = "select distinct".

						   " peco.PESSOA_FORNECEDOR as CODIGO_PESSOA".

						   " ,pess.NOME as NOME".

						   " ,pess.CGCCPF as CNPJ".

						   " ,itpv.CD_ITEM_MATERIAL as REFERENCIA".

					" from item_pedido_compra itpv".

						  " inner join pedido_compra peco on peco.num_pedd_compra   = itpv.num_pedd_compra ".

						  " inner join pessoa pess on  peco.pessoa_empresa    = itpv.pessoa_empresa  ".                          " and peco.pessoa_fornecedor = pess.pessoa".

					" where  itpv.cd_item_material = '".$_GET['REFERENCIA']. "' "; */
					
					$Sql = "select pessoa as CODIGO_PESSOA". 
					
					          ",PESSOA.nome as NOME".

							  ",pessoa.CGCCPF as CNPJ".
							  
							  ",ITEM_MATERIAL.CD_ITEM_MATERIAL as REFERENCIA".

						" from ITEM_MATERIAL INNER JOIN PESSOA ON ITEM_MATERIAL.FABRICANTE=PESSOA.FANTASIA".

					    " WHERE ITEM_MATERIAL.CD_ITEM_MATERIAL = '".$_GET['REFERENCIA']. "' ";

					

			$Stmt = mysql_query($Sql);

			$retorno = "for (x = 0;x < document.form.LANCA_FABRI_IDO.length; x++)";

			$retorno.= "	document.form.LANCA_FABRI_IDO.options[0] = null;";

			if ($x > 1){

				$retorno.= "document.form.LANCA_FABRI_IDO.options[document.form.LANCA_FABRI_IDO.length] = new Option(\"" ."-- Selecione --"."\",\"" .""."\",true);";

			}else{

				if ($x == 0 && ($_GET['PESSOA'] == "16763" || $_GET['PESSOA'] == "18500")){

					$retorno.= "document.form.LANCA_FABRI_IDO.options[document.form.LANCA_FABRI_IDO.length] = new Option(\"" ."Andarella"."\",\"" ."0"."\",true);";

				}

			}

			while($Rs = mysql_fetch_assoc($Stmt))

				$retorno.= "document.form.LANCA_FABRI_IDO.options[document.form.LANCA_FABRI_IDO.length] = new Option(\"" .$Rs["CODIGO_PESSOA"]." - ".$Rs["NOME"] ."\",\"" .$Rs["CODIGO_PESSOA"] ."\",true);";

				

			if ($x > 1){

				$retorno.= "alert('Aten��o!!! Esta refer�ncia foi produzida por mais um fabricante. Favor verificar o c�digo do fabricante na sola do cal�ado.');";

			}

			echo stringToBinary($retorno);

		break;

		

	}

?>