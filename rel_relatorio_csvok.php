<? $Title = "Relatório Geral - Geração de arquivo CSV";

	include("inc/top_imp.inc.php"); 

?>

<link href="wfa.css" rel="stylesheet" type="text/css" />



<table width="100%" border="0" cellpadding="0" cellspacing="0">

  <tr>

    <td class="imp_normal"><table border="0" class="style1">

      <!--<tr>

        <td class="imp_normal_total">Reclamação</td>

		<td class="imp_normal_total">Cod_Cliente</td>

		<td class="imp_normal_total">Nome_Cliente</td>

		<td class="imp_normal_total">Cidade</td>

		<td class="imp_normal_total">UF</td>

		<td class="imp_normal_total">Região</td>

		<td class="imp_normal_total">Tempo_Compra</td>

		<td class="imp_normal_total">Categoria</td>

		<td class="imp_normal_total">Solicitante</td>

		<!--<td class="imp_normal_total">Motivo_Solicitação</td>

		<td class="imp_normal_total">Tipo_Reclamação</td>

		<td class="imp_normal_total">Referência</td>

		<td class="imp_normal_total">Linha</td>

		<td class="imp_normal_total">Modelo</td>

		<td class="imp_normal_total">Material</td>

		<td class="imp_normal_total">Cor</td>

		<td class="imp_normal_total">Coleção</td>

		<td class="imp_normal_total">Lç</td>

		<td class="imp_normal_total">Desc_Produto</td>

		<td class="imp_normal_total">Desc_Material</td>

		<td class="imp_normal_total">Desc_Cor</td>

		<td class="imp_normal_total">NF_Origem</td>

		<td class="imp_normal_total">DT_NF_Origem</td>

		<td class="imp_normal_total">Quantidade</td>

		<td class="imp_normal_total">Tamanho33</td>

		<td class="imp_normal_total">Tamanho34</td>

		<td class="imp_normal_total">Tamanho35</td>

		<td class="imp_normal_total">Tamanho36</td>

		<td class="imp_normal_total">Tamanho37</td>

		<td class="imp_normal_total">Tamanho38</td>

		<td class="imp_normal_total">Tamanho39</td>

		<td class="imp_normal_total">Tamanho40</td>

		<td class="imp_normal_total">VL_Unitário</td>

		<td class="imp_normal_total">VL_Total</td>

		<td class="imp_normal_total">DT_Avaliação</td>

		<td class="imp_normal_total">Encerrada</td>

		<td class="imp_normal_total">Responsável</td>

		<td class="imp_normal_total">Situação</td>

		<td class="imp_normal_total">Status</td>

		<td class="imp_normal_total">Pré_Nota</td>

		<td class="imp_normal_total">NF_Devolução</td>

		<td class="imp_normal_total">Série</td>

		<td class="imp_normal_total">DT_NF_Devolução</td>

		<td class="imp_normal_total">DT_Abertura</td>

		<td class="imp_normal_total">DT_Pré_Nota</td>

		<td class="imp_normal_total">DT_Preenchimento_NF</td>

		<td class="imp_normal_total">DT_Solicitação_Coleta</td>

		<td class="imp_normal_total">DT_Coleta</td>

		<td class="imp_normal_total">DT_Chegada_Transp</td>

		<td class="imp_normal_total">DT_Chegada_ARZ</td>

		<td class="imp_normal_total">DT_Importação</td>

		<td class="imp_normal_total">DT_Crédito</td>

		<td class="imp_normal_total">Agente</td>

		<td class="imp_normal_total">Cod_Fábrica</td>

		<td class="imp_normal_total">Nome_Fábrica</td>

		<td class="imp_normal_total">Grupo_Defeito</td>

		<td class="imp_normal_total">SubGrupo_Defeito</td>

      </tr>-->

	  <?

	  

	  	if (trim($_POST['LANCA_NUMRAR'])) {

			$SqlCriterio.= "AND reclamacao = '" .$_POST['LANCA_NUMRAR']. "' ";

		}

		

		if (trim($_POST['LANCA_FABRI_IDO'])) {

			$SqlCriterio.= "AND Cod_Fabrica = '" .$_POST['LANCA_FABRI_IDO']. "' ";

		}

		if (trim($_POST['LANCA_PESSOA'])) {

			$SqlCriterio.= "AND Cod_Cliente = '" .$_POST['LANCA_PESSOA']. "' ";

		}

		

		if (trim($_POST['GRUPO_EMPRESARIAL'])) {

			$SqlCriterio.= "AND GrupoEmpresarial = '" .$_POST['GRUPO_EMPRESARIAL']. "' ";

		}

		

		if (trim($_POST['LINHA'])) {

			$SqlCriterio.= "AND Linha = '" .$_POST['LINHA']. "' ";

		}

		if (trim($_POST['MODELO'])) {

			$SqlCriterio.= "AND Modelo = '" .$_POST['MODELO']. "' ";

		}

		if (trim($_POST['LANCA_DATAABERTURAI']) && trim($_POST['LANCA_DATAABERTURAF'])) {

			$DataIni = substr($_POST['LANCA_DATAABERTURAI'],6,4)."-".substr($_POST['LANCA_DATAABERTURAI'],3,2)."-".substr($_POST['LANCA_DATAABERTURAI'],0,2);

			$DataFim = substr($_POST['LANCA_DATAABERTURAF'],6,4)."-".substr($_POST['LANCA_DATAABERTURAF'],3,2)."-".substr($_POST['LANCA_DATAABERTURAF'],0,2);

			

			$SqlCriterio.= " AND (DT_Abertura BETWEEN date_format('" .$DataIni. "','%Y-%m-%d') ".

				   " AND date_format('" .$DataFim. "','%Y-%m-%d'))";

			//$SqlCriterio.= " and DT_Abertura between '".$_POST['LANCA_DATAABERTURAI']."' and '".$_POST['LANCA_DATAABERTURAF']."'";

		}

		if (trim($_POST['AVALI_AREZ_DATAI']) && trim($_POST['AVALI_AREZ_DATAF'])) {

			$DataIni = substr($_POST['AVALI_AREZ_DATAI'],6,4)."-".substr($_POST['AVALI_AREZ_DATAI'],3,2)."-".substr($_POST['AVALI_AREZ_DATAI'],0,2);

			$DataFim = substr($_POST['AVALI_AREZ_DATAF'],6,4)."-".substr($_POST['AVALI_AREZ_DATAF'],3,2)."-".substr($_POST['AVALI_AREZ_DATAF'],0,2);

			$SqlCriterio.= " AND (Dt_Avaliacao BETWEEN date_format('" .$DataIni. "','%Y-%m-%d') ".

				   " AND date_format('" .$DataFim. "','%Y-%m-%d'))";

			//$SqlCriterio.= " and Dt_Avaliacao between '".$_POST['AVALI_AREZ_DATAI']."' and '".$_POST['AVALI_AREZ_DATAF']."'";

		}

		if (trim($_POST['LANCA_STATUS'])) {

			$SqlCriterio.= "AND Status = '" .$_POST['LANCA_STATUS']. "' ";

			$Criterios.= ((strlen($Criterios) == 0) ? "" : " - ") ."Status da reclamação: " .status($_POST['LANCA_STATUS']);

		}

		if (trim($_POST['AVALI_SITUACAO'])) {

			$SqlCriterio.= "AND Situacao = '" .$_POST['AVALI_SITUACAO']. "' ";

			$Criterios.= ((strlen($Criterios) == 0) ? "" : " - ") ."Situação da reclamação: " .situacao($_POST['AVALI_SITUACAO']);

		}

		

		if (trim($_POST['CATEGORIA'])) {

			$SqlCriterio.= "AND Categoria in (" .$_POST['CATEGORIA']. ") ";

		}

		

		if (trim($_POST['AVALI_AREZ_DEFEIG_IDO'])) {

			$SqlCriterios.= "AND A.AVALI_AREZ_DEFEIG_IDO = '" .$_POST['AVALI_AREZ_DEFEIG_IDO']. "' ";

			$Sql = "SELECT DEFEIG_DESCRICAO FROM rar_defeito_grupo WHERE DEFEIG_IDO = '" .$_POST['AVALI_AREZ_DEFEIG_IDO']. "'";

			$Stmt = mysql_query($Sql);

			if ($Rs = mysql_fetch_assoc($Stmt))

				$Criterios.= ((strlen($Criterios) == 0) ? "" : " - ") ."Grupo de defeito: " .$Rs["DEFEIG_DESCRICAO"];

		}

		

		$Sql = " select *, date_format(Dt_Abertura,'%d/%m/%Y') as Dt_abertura, date_format(Dt_Avaliacao,'%d/%m/%Y') as Dt_Avaliacao";

		$Sql.= " from vw_rar_lancamento_geral";

		$Sql.= " where 1 = 1 ";

		$Sql.= $SqlCriterio;

		//die($Sql);

		$Stmt = mysql_query($Sql);

		

		$Data = date('d-m-Y');

		$Filename = $PathImportacao."RELATORIO_GERAL_".$_POST['ID'].$Data.".csv";

		$FilenameVirtual = $PathImportacaoVirtual."RELATORIO_GERAL_".$_POST['ID'].$Data.".csv";

		if (file_exists($Filename))

		{	if (unlink($Filename))

			{}else{}

		}

		$File = fopen($Filename,"a");

		fputs ($File,"Reclamação;");

		fputs ($File,"Cod_Cliente;");

		fputs ($File,"Nome_Cliente;");

		fputs ($File,"Cidade;");

		fputs ($File,"UF;");

		fputs ($File,"Região;");

		fputs ($File,"Tempo_Compra;");

		fputs ($File,"Categoria;");

		fputs ($File,"Solicitante;");

		//fputs ($File,"Motivo_Solicitação;");

		fputs ($File,"Tipo_Reclamação;");

		fputs ($File,"Referência;");

		fputs ($File,"Linha;");

		fputs ($File,"Modelo;");

		fputs ($File,"Material;");

		fputs ($File,"Cor;");

		fputs ($File,"Coleção;");

		fputs ($File,"Lç;");

		fputs ($File,"Desc_Produto;");

		fputs ($File,"Desc_Material;");

		fputs ($File,"Desc_Cor;");

		fputs ($File,"NF_Origem;");

		fputs ($File,"DT_NF_Origem;");

		fputs ($File,"Quantidade;");

		fputs ($File,"Tamanho33;");

		fputs ($File,"Tamanho34;");

		fputs ($File,"Tamanho35;");

		fputs ($File,"Tamanho36;");

		fputs ($File,"Tamanho37;");

		fputs ($File,"Tamanho38;");

		fputs ($File,"Tamanho39;");

		fputs ($File,"Tamanho40;");

		fputs ($File,"VL_Unitário;");

		fputs ($File,"VL_Total;");

		fputs ($File,"DT_Avaliação;");

		fputs ($File,"Encerrada;");

		fputs ($File,"Responsável;");

		fputs ($File,"Situação;");

		//fputs ($File,"Status;");

		fputs ($File,"Pré_Nota;");

		fputs ($File,"NF_Devolução;");

		fputs ($File,"Série;");

		fputs ($File,"DT_NF_Devolução;");

		fputs ($File,"DT_Abertura;");

		fputs ($File,"DT_Pré_Nota;");

		fputs ($File,"DT_Preenchimento_NF;");

		fputs ($File,"DT_Solicitação_Coleta;");

		fputs ($File,"DT_Coleta;");

		fputs ($File,"DT_Chegada_Transp;");

		fputs ($File,"DT_Chegada_ARZ;");

		fputs ($File,"DT_Importação;");

		fputs ($File,"DT_Crédito;");

		fputs ($File,"Agente;");

		fputs ($File,"Cod_Fábrica;");

		fputs ($File,"Nome_Fábrica;");

		fputs ($File,"Grupo_Defeito;");

		fputs ($File,"SubGrupo_Defeito;");

		fputs ($File,"GrupoEmpresarial;");

		fputs ($File,"\n"); // PARA QUEBRAR A LINHA

		$x = 0;

		while($Rs = mysql_fetch_assoc($Stmt)) {

			//echo($Rs["reclamacao"]."--->".BuscaMotivo($Rs["reclamacao"]));

	  ?>

		  <!--<tr>

			<td class="imp_normal_total"><?=$Rs["reclamacao"]?></td>

			<td class="imp_normal_total"><?=$Rs["Cod_Cliente"]?></td>

			<td class="imp_normal_total"><?=$Rs["Nome_Cliente"]?></td>

			<td class="imp_normal_total"><?=$Rs["Cidade"]?></td>

			<td class="imp_normal_total"><?=$Rs["UF"]?></td>

			<td class="imp_normal_total"><?=Regiao($Rs["UF"])?></td>

			<td class="imp_normal_total"><?=$Rs["Tempo_Compra"]?></td>

			<td class="imp_normal_total"><?=$Rs["Categoria"]?></td>

			<td class="imp_normal_total"><?=$Rs["Solicitante"]?></td>

			<!--<td class="imp_normal_total"><?=str_replace("\n","",$Rs["Motivo_Solicitacao"])?></td>

			<td class="imp_normal_total"><?=$Rs["Tipo_Reclamacao"]?></td>

			<td class="imp_normal_total"><?=$Rs["Referencia"]?></td>

			<td class="imp_normal_total"><?=$Rs["Linha"]?></td>

			<td class="imp_normal_total"><?=$Rs["Modelo"]?></td>

			<td class="imp_normal_total"><?=$Rs["Material"]?></td>

			<td class="imp_normal_total"><?=$Rs["Cor"]?></td>

			<td class="imp_normal_total"><?=$Rs["Colecao"]?></td>

			<td class="imp_normal_total"><?=BuscaLancamento($Rs["Cod_Cliente"],$Rs["PRENF_PESSOA_EMITENTE_ORIGINAL"],$Rs["NF_Origem"],$Rs["Serie_Origem"],$Rs["Referencia"],$Rs["Colecao"])?></td>

			<td class="imp_normal_total"><?=$Rs["Desc_Produto"]?></td>

			<td class="imp_normal_total"><?=$Rs["Desc_Material"]?></td>

			<td class="imp_normal_total"><?=$Rs["Desc_Cor"]?></td>

			<td class="imp_normal_total"><?=$Rs["NF_Origem"]?></td>

			<td class="imp_normal_total"><?=$Rs["Dt_NF_Origem"]?></td>

			<td class="imp_normal_total"><?=$Rs["Quantidade"]?></td>

			<td class="imp_normal_total"><?=$Rs["Tamanho33"]?></td>

			<td class="imp_normal_total"><?=$Rs["Tamanho34"]?></td>

			<td class="imp_normal_total"><?=$Rs["Tamanho35"]?></td>

			<td class="imp_normal_total"><?=$Rs["Tamanho36"]?></td>

			<td class="imp_normal_total"><?=$Rs["Tamanho37"]?></td>

			<td class="imp_normal_total"><?=$Rs["Tamanho38"]?></td>

			<td class="imp_normal_total"><?=$Rs["Tamanho39"]?></td>

			<td class="imp_normal_total"><?=$Rs["Tamanho40"]?></td>

			<td class="imp_normal_total"><?=$Rs["Vl_Unitario"]?></td>

			<td class="imp_normal_total"><?=$Rs["Vl_Total"]?></td>

			<td class="imp_normal_total"><?=$Rs["Dt_Avaliacao"]?></td>

			<td class="imp_normal_total"><?=$Rs["Encerrada"]?></td>

			<td class="imp_normal_total"><?=$Rs["Responsavel"]?></td>

			<td class="imp_normal_total"><?=$Rs["Situacao"]?></td>

			<td class="imp_normal_total"><?=$Rs["Status"]?></td>

			<td class="imp_normal_total"><?=$Rs["Pre_Nota"]?></td>

			<td class="imp_normal_total"><?=$Rs["NF_Devolucao"]?></td>

			<td class="imp_normal_total"><?=$Rs["Serie"]?></td>

			<td class="imp_normal_total"><?=$Rs["DT_NF_Devolucao"]?></td>

			<td class="imp_normal_total"><?=$Rs["DT_Abertura"]?></td>

			<td class="imp_normal_total"><?=$Rs["DT_Pre_nota"]?></td>

			<td class="imp_normal_total"><?=$Rs["DT_Preenchimento_NF"]?></td>

			<td class="imp_normal_total"><?=$Rs["DT_Solicitacao_Coleta"]?></td>

			<td class="imp_normal_total"><?=$Rs["DT_Coleta"]?></td>

			<td class="imp_normal_total"><?=$Rs["DT_Chegada_Transp"]?></td>

			<td class="imp_normal_total"><?=$Rs["DT_Chegada_ARZ"]?></td>

			<td class="imp_normal_total"><?=$Rs["DT_Importacao"]?></td>

			<td class="imp_normal_total"><?=$Rs["DT_Credito"]?></td>

			<td class="imp_normal_total"><?=BuscaAgente($Rs["Cod_Fabrica"])?></td>

			<td class="imp_normal_total"><?=$Rs["Cod_Fabrica"]?></td>

			<td class="imp_normal_total"><?=$Rs["Nome_Fabrica"]?></td>

			<td class="imp_normal_total"><?=$Rs["Grupo_Defeito"]?></td>

			<td class="imp_normal_total"><?=$Rs["SubGrupo_Defeito"]?></td>-->

			

			<?

			// Escreve as informacoes dentro do arquivo CSV

			fputs ($File,$Rs["reclamacao"].";");

			fputs ($File,$Rs["Cod_Cliente"].";");

			fputs ($File,$Rs["Nome_Cliente"].";");

			fputs ($File,$Rs["Cidade"].";");

			fputs ($File,$Rs["UF"].";");

			fputs ($File,Regiao($Rs["UF"]).";");

			fputs ($File,$Rs["Tempo_Compra"].";");

			fputs ($File,RetornaCategoriaRAR($Rs["Categoria"]).";");

			fputs ($File,$Rs["Solicitante"].";");

			//fputs ($File,str_replace(chr(10)," ",BuscaMotivo($Rs["reclamacao"]).";"),5000);

			fputs ($File,$Rs["Tipo_Reclamacao"].";");

			fputs ($File,"'".$Rs["Referencia"].";");

			fputs ($File,$Rs["Linha"].";");

			fputs ($File,$Rs["Modelo"].";");

			fputs ($File,$Rs["Material"].";");

			fputs ($File,$Rs["Cor"].";");

			fputs ($File,$Rs["Colecao"].";");

			fputs ($File,BuscaLancamento($Rs["Cod_Cliente"],$Rs["PRENF_PESSOA_EMITENTE_ORIGINAL"],$Rs["NF_Origem"],$Rs["Serie_Origem"],$Rs["Referencia"],$Rs["Colecao"]).";");

			fputs ($File,$Rs["Desc_Produto"].";");

			fputs ($File,$Rs["Desc_Material"].";");

			fputs ($File,$Rs["Desc_Cor"].";");

			fputs ($File,$Rs["NF_Origem"].";");

			fputs ($File,$Rs["Dt_NF_Origem"].";");

			fputs ($File,$Rs["Quantidade"].";");

			fputs ($File,$Rs["Tamanho33"].";");

			fputs ($File,$Rs["Tamanho34"].";");

			fputs ($File,$Rs["Tamanho35"].";");

			fputs ($File,$Rs["Tamanho36"].";");

			fputs ($File,$Rs["Tamanho37"].";");

			fputs ($File,$Rs["Tamanho38"].";");

			fputs ($File,$Rs["Tamanho39"].";");

			fputs ($File,$Rs["Tamanho40"].";");

			fputs ($File,formatCurrency($Rs["Vl_Unitario"]).";");

			fputs ($File,formatCurrency($Rs["Vl_Total"]).";");

			fputs ($File,$Rs["Dt_Avaliacao"].";");

			fputs ($File,$Rs["Encerrada"].";");

			fputs ($File,$Rs["Responsavel"].";");

			fputs ($File,$Rs["Situacao"].";");

			//fputs ($File,$Rs["Status"].";");

			fputs ($File,$Rs["Pre_Nota"].";");

			fputs ($File,$Rs["NF_Devolucao"].";");

			fputs ($File,$Rs["Serie"].";");

			fputs ($File,$Rs["DT_NF_Devolucao"].";");

			fputs ($File,$Rs["DT_Abertura"].";");

			fputs ($File,$Rs["DT_Pre_nota"].";");

			fputs ($File,$Rs["DT_Preenchimento_NF"].";");

			fputs ($File,$Rs["DT_Solicitacao_Coleta"].";");

			fputs ($File,$Rs["DT_Coleta"].";");

			fputs ($File,$Rs["DT_Chegada_Transp"].";");

			fputs ($File,$Rs["DT_Chegada_ARZ"].";");

			fputs ($File,$Rs["DT_Importacao"].";");

			fputs ($File,$Rs["DT_Credito"].";");

			fputs ($File,BuscaAgente($Rs["Cod_Fabrica"]).";");

			fputs ($File,$Rs["Cod_Fabrica"].";");

			fputs ($File,$Rs["Nome_Fabrica"].";");

			fputs ($File,$Rs["Grupo_Defeito"].";");

			fputs ($File,$Rs["SubGrupo_Defeito"].";");

			fputs ($File,$Rs["GrupoEmpresarial"].";");

			fputs ($File,"\n"); // PARA QUEBRAR A LINHA

			$x++;

			?>

		  <!--</tr>-->

	  <? } ?>

    </table></td>

  </tr>

  

  

  <?

  //setlocale(LC_MONETARY, 'pt_BR');

  ?>

  <tr>

    <td class="imp_normal"><p align="center">N&ordm; registros exportados: <?=$x?> </p>

      <p align="center">Para download do arquivo <a href="<?=$FilenameVirtual?>" target="_blank">clique aqui</a></p>

    <p>&nbsp;</p></td>

  </tr>

  <tr>

    <td class="imp_normal"><div align="center"><a href="javascript: window.print();"></a>&nbsp;<a href="javascript: window.close()"><img src="imagens/fechar.jpg" alt="Clique aqui para fechar esta janela" width="52" height="22" border="0" ></a></div></td>

  </tr>

</table>

<? 	include("inc/bot_imp.inc.php"); ?>

