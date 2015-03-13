<? include("inc/conn.inc.php");
	verifyAcess("ARZ_GERAIMPORTACAO","S");

	if (trim($_POST['ID'])) {
			$Sql = "UPDATE RAR_PRENF SET ".
					"PRENF_DATA_IMPORT_AREZZO = NOW()  ".
					"WHERE PRENF_NUMPRENF = '" .$_POST['ID']. "'";
		$Stmt = mysql_query($Sql);

		$Sql = "SELECT distinct prenf_pessoa_emitente ALMOXARIFADO,".
                       " prenf_pessoa_destinatario EMITENTE,".
                       " prenf_serie SERIE_NFDEVOLUCAO,".
                       " PRENF_NUMNFDEVOLUCAO NUM_NFDEVOLUCAO,".
                       " 'E' as TIPO_MOVIMENTO,".
                       " date_format(prenf_data_INFNFDEVOLUCACAO,'%d%m%Y') as DATA_NF_DEVOLUCAO,".
                       " date_format(now(),'%d%m%Y') as DATA_NF_ENTRADA,".
                       " prenf_pessoa_emitente DESTINATARIO,".
                       " prenf_oper_ido OPERACAO,".
                       " PRENF_CFOP,".
					   " SUFR_BENF_ICMS SUFRAMA, ".
					   " PRENF_ICMS, ".
                       " (SELECT ROUND(SUM(PRENFI_QUANTIDADE * PRENFI_VALORUNITARIO),2) VALOR FROM RAR_PRENF_ITEM WHERE PRENFI_NUMPRENF = PRENF_NUMPRENF GROUP BY PRENF_PESSOA_EMITENTE) BASE_CALC_ICMS,".
                       " (SELECT ROUND(SUM(PRENFI_QUANTIDADE * PRENFI_VALORUNITARIO)*PRENF_ICMS,2) VALOR FROM RAR_PRENF_ITEM WHERE PRENFI_NUMPRENF = PRENF_NUMPRENF GROUP BY PRENF_PESSOA_EMITENTE) VALOR_ICMS,".
                       " (SELECT ROUND(SUM(PRENFI_QUANTIDADE * PRENFI_VALORUNITARIO),2) VALOR FROM RAR_PRENF_ITEM WHERE PRENFI_NUMPRENF = PRENF_NUMPRENF GROUP BY PRENF_PESSOA_EMITENTE) VALOR_TOTAL_PRODUTOS,".
                       " (SELECT ROUND(SUM(PRENFI_QUANTIDADE * PRENFI_VALORUNITARIO),2) VALOR FROM RAR_PRENF_ITEM WHERE PRENFI_NUMPRENF = PRENF_NUMPRENF GROUP BY PRENF_PESSOA_EMITENTE) VALOR_TOTAL_NOTA".
			   " FROM rar_prenf, pessoa".
			  " WHERE prenf_numprenf = '" .$_POST['ID']. "'".
			  "       and pessoa = prenf_pessoa_destinatario";
		//die($Sql);
		$Stmt = mysql_query($Sql);
		$Data = date('d-m-Y');
		$Filename = $PathImportacao."PRENF".$_POST['ID']."-".$Data.".txt";
		if (file_exists($Filename))
		{	if (unlink($Filename))
			{}else{}
		}
		$File = fopen($Filename,"a");
		while($Rs = mysql_fetch_assoc($Stmt)) {
			if ($Rs["ALMOXARIFADO"] == "18800"){
				$Almoxarifado = "111";
			}else{
				$Almoxarifado = "211";
			}
			if (substr($Rs["PRENF_CFOP"],0,1) == "5") {
				$Cfop = "1".substr($Rs["PRENF_CFOP"],2,3);
			}

			if (substr($Rs["PRENF_CFOP"],0,1) == "6") {
				$Cfop = "2".substr($Rs["PRENF_CFOP"],2,3);
			}
			fputs ($File,"01");   //capa do arquivo
			//$Almoxarifado = trim($Rs["ALMOXARIFADO"]).str_repeat(" ",5-strlen(trim($Rs["ALMOXARIFADO"])));
			$Almoxarifado = trim($Almoxarifado).str_repeat(" ",5-strlen(trim($Almoxarifado)));
			$Emitente = trim($Rs["EMITENTE"]).str_repeat(" ",5-strlen(trim($Rs["EMITENTE"])));
			$Serie_Devolucao = trim($Rs["SERIE_NFDEVOLUCAO"]).str_repeat(" ",3-strlen(trim($Rs["SERIE_NFDEVOLUCAO"])));
			$Num_Devolucao = trim($Rs["NUM_NFDEVOLUCAO"]).str_repeat(" ",6-strlen(trim($Rs["NUM_NFDEVOLUCAO"])));
			$Tipo_Movimento = trim($Rs["TIPO_MOVIMENTO"]).str_repeat(" ",1-strlen(trim($Rs["TIPO_MOVIMENTO"])));
			$Data_Nf_Devolucao = trim($Rs["DATA_NF_DEVOLUCAO"]).str_repeat(" ",8-strlen(trim($Rs["DATA_NF_DEVOLUCAO"])));
			$Data_Nf_Entrada = trim($Rs["DATA_NF_ENTRADA"]).str_repeat(" ",8-strlen(trim($Rs["DATA_NF_ENTRADA"])));
			$Destinatario = trim($Rs["DESTINATARIO"]).str_repeat(" ",5-strlen(trim($Rs["DESTINATARIO"])));
			$Operacao = trim($Rs["OPERACAO"]).str_repeat(" ",5-strlen(trim($Rs["OPERACAO"])));
			$CfopVar = trim($Cfop).str_repeat(" ",5-strlen(trim($Cfop)));
			if (trim($Rs["VALOR_ICMS"]) == 0) {
				$BaseIcms = "0.00";
			}else{
				$BaseIcms = trim($Rs["BASE_CALC_ICMS"]);
			}
			$BaseIcms = str_repeat("0",10-strlen($BaseIcms)).trim($BaseIcms);
			$ValorIcms = str_repeat("0",10-strlen(trim($Rs["VALOR_ICMS"]))).trim($Rs["VALOR_ICMS"]);
			$ValorTotalProdutos = str_repeat("0",10-strlen(trim($Rs["VALOR_TOTAL_PRODUTOS"]))).trim($Rs["VALOR_TOTAL_PRODUTOS"]);

			if ($Rs["SUFRAMA"] == "S"){
				$Sql = "SELECT distinct aliq_icms";
				$Sql.= " FROM rar_prenf_item, item_nota_fiscal, rar_item";
				$Sql.= " WHERE lanca_numrar = item_numrar ";
				$Sql.= " AND num_nf = item_nf ";
				$Sql.= " AND serie_nf = item_serie ";
				$Sql.= " AND cd_item_material = item_referencia ";
				$Sql.= " AND prenfi_numprenf = '" .$_POST['ID']. "'";
				$Stmt = mysql_query($Sql);
				$RsIcms = mysql_fetch_assoc($Stmt);
				$ValorTotal = round($Rs["VALOR_TOTAL_NOTA"] * (1-$RsIcms["aliq_icms"]),2);
			}else{
				$ValorTotal = $Rs["VALOR_TOTAL_NOTA"];
			}
			$ValorTotalNota = str_repeat("0",10-strlen(trim($ValorTotal))).trim($ValorTotal);
			$Tipo_Frete = trim($Rs["TIPO_FRETE"]).str_repeat(" ",1-strlen(trim($Rs["TIPO_FRETE"])));
			$Condicao_Pagamento = trim($Rs["CONDICAO_PAGAMENTO"]).str_repeat(" ",3-strlen(trim($Rs["CONDICAO_PAGAMENTO"])));
			fputs ($File,$Almoxarifado);
			fputs ($File,$Emitente);
			fputs ($File,$Serie_Devolucao);
			fputs ($File,$Num_Devolucao);
			fputs ($File,$Tipo_Movimento);
			fputs ($File,$Data_Nf_Devolucao);
			fputs ($File,$Data_Nf_Entrada);
			fputs ($File,$Destinatario);
			fputs ($File,$Operacao);
			fputs ($File,$CfopVar);
			fputs ($File,$BaseIcms);
			fputs ($File,$ValorIcms);
			fputs ($File,$ValorTotalProdutos);
			fputs ($File,$ValorTotalNota);
			fputs ($File,$Tipo_Frete);
			fputs ($File,$Condicao_Pagamento);
			fputs ($File,"\n"); // PARA QUEBRAR A LINHA
			
			$Sql = "SELECT   prenfi_referencia PRODUTO ".
			         " , max(item_colecao) COLECAO".
					 " , PRENF_PESSOA_DESTINATARIO ". 
					 " , PRENF_PESSOA_EMITENTE ".
					 " , PRENF_PESSOA_EMITENTE_ORIGINAL ".
					 " , prenfi_unidade UNIDADE_MEDIDA ".
					 " , ROUND(sum(item_qtde), 0) QUANTIDADE ".
					 " , ROUND(prenfi_valorunitario, 2) VALOR_UNITARIO ".
					 " , ROUND(prenfi_valorunitario * sum(item_qtde), 2) VALOR_TOTAL ".
					 " , ROUND(prenfi_valorunitario * sum(item_qtde), 2) BASE_ICMS ".
					 " , ROUND((prenfi_valorunitario * sum(item_qtde)) * prenf_icms, 2) VALOR_ICMS ".
					 " , ROUND(prenf_icms, 2) ALIQ_ICMS ".
					 " , max(item_nf) NUM_NF_ORIGEM ".
					 " , max(item_serie) SERIE_NF_ORIGEM ".
					 " , 16 MOTIVO_DEVOLUCAO ".
					 " , sum(item_qtde) QUANTIDADE_ACATADA ".
					 //" , min(lancamento) LANCAMENTO".
				" FROM rar_prenf".
					 " , rar_prenf_item".
					 " , rar_item".
					 //" , item_nota_fiscal i".
					 " , rar_lancamento l".
			   " WHERE item_numrar = l.lanca_numrar".
				 " AND prenf_numprenf = prenfi_numprenf".
				 " AND prenfi_ido = lanca_prenfi_ido".
				 //" AND i.num_nf = item_nf".
				 //" AND i.serie_nf = item_serie".
				 //" AND i.cd_item_material = item_referencia".
				 " AND l.lanca_numrar = item_numrar".
				 " AND prenf_numprenf = '" .$_POST['ID']. "'".
			" GROUP BY prenfi_referencia,".
					 " prenfi_unidade,".
					 " prenf_pessoa_destinatario,".
					 " prenf_pessoa_emitente,".
					 " prenfi_valorunitario,".
					 " prenf_icms";
			//die($Sql);
			$Stmti = mysql_query($Sql);
			while($RsI = mysql_fetch_assoc($Stmti)) {
				$Sql = " select min(lancamento) LANCAMENTO";
				$Sql.= " from item_nota_fiscal it, nota_fiscal nf";
				$Sql.= " where it.num_nf = nf.num_nf ";
				$Sql.= "       and it.serie_nf = nf.serie_nf ";
				$Sql.= "       and it.pessoa_emitente = nf.pessoa_emitente ";
				//$Sql.= "       and nf.pessoa_destinatario = ".$RsI["PRENF_PESSOA_DESTINATARIO"];
				
				$Sql.= "       and nf.pessoa_destinatario in (";
				$Sql.= "                                     select CLIEN_COL_PESSOA from rar_cliente_coleta where clien_col_pessoa = ".$RsI["PRENF_PESSOA_DESTINATARIO"];
				$Sql.= "                                     union select CLIEN_COL_LOJAANT from rar_cliente_coleta where clien_col_pessoa = ".$RsI["PRENF_PESSOA_DESTINATARIO"];
				$Sql.= "                                     union select CLIEN_COL_LOJAANT_1 from rar_cliente_coleta where clien_col_pessoa = ".$RsI["PRENF_PESSOA_DESTINATARIO"];
				$Sql.= "                                     union select CLIEN_COL_LOJAANT_2 from rar_cliente_coleta where clien_col_pessoa = ".$RsI["PRENF_PESSOA_DESTINATARIO"];
				$Sql.= "                                     union select CLIEN_COL_LOJAANT_3 from rar_cliente_coleta where clien_col_pessoa = ".$RsI["PRENF_PESSOA_DESTINATARIO"];
				$Sql.= "                                     union select CLIEN_COL_LOJAANT_4 from rar_cliente_coleta where clien_col_pessoa = ".$RsI["PRENF_PESSOA_DESTINATARIO"];
				$Sql.= "                                     )";
				$Sql.= "       and nf.pessoa_emitente = ".$RsI["PRENF_PESSOA_EMITENTE_ORIGINAL"];
				$Sql.= "       and nf.num_nf = ".$RsI["NUM_NF_ORIGEM"];
				$Sql.= "       and nf.serie_nf = '".$RsI["SERIE_NF_ORIGEM"]."'";
				$Sql.= "       and cd_item_material = '".$RsI["PRODUTO"]."'";
				$Sql.= "       and cd_colecao = '".$RsI["COLECAO"]."'";  //incluida essa linha em 15/01/2008
				//die($Sql);
				$StmtNF = mysql_query($Sql);
				while($RsNF = mysql_fetch_assoc($StmtNF)) {
					$Lancamento = trim($RsNF["LANCAMENTO"]);
				}
				//die($Lancamento);
				
				//die("aqui agora ->".$RsI["COLECAO"]);
				fputs ($File,"02");   //ítem do arquivo
				$Produto = trim($RsI["PRODUTO"]).str_repeat(" ",20-strlen(trim($RsI["PRODUTO"])));
				$Colecao = trim($RsI["COLECAO"]).str_repeat(" ",10-strlen(trim($RsI["COLECAO"])));
				$Lancamento = trim($Lancamento).str_repeat(" ",2-strlen(trim($Lancamento)));
				$Unidade_Medida = trim($RsI["UNIDADE_MEDIDA"]).str_repeat(" ",10-strlen(trim($RsI["UNIDADE_MEDIDA"])));
				$Quantidade = str_repeat("0",10-strlen(trim($RsI["QUANTIDADE"]))).trim($RsI["QUANTIDADE"]);
				$Valor_Unitario = str_repeat("0",10-strlen(trim($RsI["VALOR_UNITARIO"]))).trim($RsI["VALOR_UNITARIO"]);
				$Valor_Total = str_repeat("0",10-strlen(trim($RsI["VALOR_TOTAL"]))).trim($RsI["VALOR_TOTAL"]);
				if (trim($RsI["VALOR_ICMS"]) == 0) {
					$BaseIcmsI = "0.00";
				}else{
					$BaseIcmsI = trim($RsI["BASE_ICMS"]);
				}
				$BaseIcmsI = str_repeat("0",10-strlen($BaseIcmsI)).trim($BaseIcmsI);
				$Valor_Icms = str_repeat("0",10-strlen(trim($RsI["VALOR_ICMS"]))).trim($RsI["VALOR_ICMS"]);
				$Aliq_Icms = str_repeat("0",5-strlen(trim($RsI["ALIQ_ICMS"]))).trim($RsI["ALIQ_ICMS"]);
				$Num_NF_Origem = trim($RsI["NUM_NF_ORIGEM"]).str_repeat(" ",6-strlen(trim($RsI["NUM_NF_ORIGEM"])));
				$Serie_NF_Origem = trim($RsI["SERIE_NF_ORIGEM"]).str_repeat(" ",3-strlen(trim($RsI["SERIE_NF_ORIGEM"])));
				$Motivo_Devolucao = trim($RsI["MOTIVO_DEVOLUCAO"]).str_repeat(" ",5-strlen(trim($RsI["MOTIVO_DEVOLUCAO"])));
				$Quantidade_Acatada = str_repeat("0",5-strlen(trim($RsI["QUANTIDADE_ACATADA"]))).trim($RsI["QUANTIDADE_ACATADA"]);
				fputs ($File,$Produto);
				fputs ($File,$Colecao);
				fputs ($File,$Unidade_Medida);
				fputs ($File,$Quantidade);
				fputs ($File,$Valor_Unitario);
				fputs ($File,$Valor_Total);
				fputs ($File,trim($BaseIcmsI));
				fputs ($File,$Valor_Icms);
				fputs ($File,$Aliq_Icms);
				fputs ($File,$Num_NF_Origem);
				fputs ($File,$Serie_NF_Origem);
				fputs ($File,$Motivo_Devolucao);
				fputs ($File,$Quantidade_Acatada);
				fputs ($File,$Lancamento);
				fputs ($File,"\n"); // PARA QUEBRAR A LINHA
			}
		}
		fputs ($File,"FIM DE ARQUIVO");
		fclose($File); // PARA FINALIZAR A ESCRITA NO ARQUIVO
	}
	header("Location: pesq_impor_arezzo.php");
?>