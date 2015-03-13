<? $Title = "Relatório de etapas pendentes";

	include("inc/top_imp.inc.php");



	$SQL = "select l.LANCA_NUMRAR, NOME, date_format(LANCA_DATAABERTURA,'%d/%m/%Y') LANCA_DATAABERTURA,";

	$SQL.= "       date_format(AVALI_AREZ_DATA,'%d/%m/%Y') AVALI_AREZ_DATA, AVALI_SITUACAO, ";

	$SQL.= "       C.SUFR_BENF_ICMS SUFRAMA ";

	$SQL.= " from rar_lancamento L, pessoa C, rar_avaliacao A, rar_item I";

	//if ($_POST["etapa"] == "3" || $_POST["etapa"] == "4"  || $_POST["etapa"] == "5"  || $_POST["etapa"] == "6"  || $_POST["etapa"] == "7"  || $_POST["etapa"] == "8" || $_POST["etapa"] == "9" ){

		$SQL.= "  ,rar_prenf_item , rar_prenf ";

	//}



	$SQL = "select DISTINCT PRENF_PESSOA_DESTINATARIO, PRENF_NUMPRENF, PRENF_ICMS, PRENF_DATA_NFDEVOLUCAO, PRENF_NUMNFDEVOLUCAO, NOME, PESSOA, ";

	$SQL.= "       date_format(PRENF_DATA_NFDEVOLUCAO,'%d/%m/%Y') DATA_NFDEVOLUCAO, C.SUFR_BENF_ICMS SUFRAMA ";

	$SQL.= " from rar_lancamento L, pessoa C, rar_avaliacao A, rar_item I, rar_prenf_item , rar_prenf";

	$SQL.= " where L.lanca_PESSOA = C.PESSOA ";

	$SQL.= "       and L.lanca_numrar = I.item_numrar ";

	$SQL.= "       and L.lanca_numrar = A.avali_numrar ";

	$SQL.= "       and L.lanca_status <> '4'";

	if ($_SESSION["Menu"] == "3"){

		$SQL.= "    and L.lanca_numrar like 'M%'";

	}else{

		$SQL.= "    and L.lanca_numrar not like 'M%'";

	}

	$SQL.= "       and lanca_prenfi_ido = prenfi_ido ";

	$SQL.= "       and prenf_numprenf = prenfi_numprenf";

	$SQL.= "       and prenf_numnfdevolucao is not null";

	if ($_POST['LANCA_CATEGORIA'] != "1"){

		$SQL.= "       and prenf_pessoa_emitente not in (18800,19000)";

	}

	$SQL.= "      " .$SqlCriterios;



	/*if ($_POST["etapa"] == "1"){

		$SQL.= "   and (A.AVALI_AREZ_DATA is null or A.AVALI_AREZ_DATA = '')";

	}

	if ($_POST["etapa"] == "2"){

		$SQL.= "   and (LANCA_PRENFI_IDO IS NULL)";

	}

	if ($_POST["etapa"] == "3"){

		$SQL.= "   and A.AVALI_AREZ_DATA is not null";



		$SQL.= "   AND PRENF_NUMNFDEVOLUCAO IS NULL";

	}*/



	if ($_POST["etapa"] == "4"){

		$SQL.= "   and A.AVALI_AREZ_DATA is not null";

		$SQL.= "   AND PRENF_NUMNFDEVOLUCAO IS not NULL";

		$SQL.= "   and lanca_prenfi_ido = prenfi_ido ";

		$SQL.= "   and prenf_numprenf = prenfi_numprenf";

		$SQL.= "   AND PRENF_DATA_SOLIC_COLETA IS NULL";

	}



	if ($_POST["etapa"] == "5"){

		$SQL.= "   and A.AVALI_AREZ_DATA is not null";

		$SQL.= "   AND PRENF_NUMNFDEVOLUCAO IS not NULL";

		$SQL.= "   AND PRENF_DATA_SOLIC_COLETA IS not NULL";

		$SQL.= "   and lanca_prenfi_ido = prenfi_ido ";

		$SQL.= "   and prenf_numprenf = prenfi_numprenf";

		$SQL.= "   AND PRENF_DATA_COLETA IS NULL";

	}



	if ($_POST["etapa"] == "6"){

		$SQL.= "   and A.AVALI_AREZ_DATA is not null";

		$SQL.= "   AND PRENF_NUMNFDEVOLUCAO IS not NULL";

		$SQL.= "   AND PRENF_DATA_SOLIC_COLETA IS not NULL";

		$SQL.= "   AND PRENF_DATA_COLETA IS not NULL";

		$SQL.= "   and lanca_prenfi_ido = prenfi_ido ";

		$SQL.= "   and prenf_numprenf = prenfi_numprenf";

		$SQL.= "   AND PRENF_DATA_RECEBTO_COLETA IS NULL";

	}



	if ($_POST["etapa"] == "7"){

		$SQL.= "   and A.AVALI_AREZ_DATA is not null";

		$SQL.= "   AND PRENF_NUMNFDEVOLUCAO IS not NULL";

		$SQL.= "   AND PRENF_DATA_SOLIC_COLETA IS not NULL";

		$SQL.= "   AND PRENF_DATA_COLETA IS not NULL";

		$SQL.= "   AND PRENF_DATA_RECEBTO_COLETA IS not NULL";

		$SQL.= "   and lanca_prenfi_ido = prenfi_ido ";

		$SQL.= "   and prenf_numprenf = prenfi_numprenf";

		$SQL.= "   AND PRENF_DATA_RECEBTO_AREZZO IS NULL";

	}



	if ($_POST["etapa"] == "8"){

		$SQL.= "   and A.AVALI_AREZ_DATA is not null";

		$SQL.= "   AND PRENF_NUMNFDEVOLUCAO IS not NULL";

		$SQL.= "   AND PRENF_DATA_SOLIC_COLETA IS not NULL";

		$SQL.= "   AND PRENF_DATA_COLETA IS not NULL";

		$SQL.= "   AND PRENF_DATA_RECEBTO_COLETA IS not NULL";

		$SQL.= "   AND PRENF_DATA_RECEBTO_AREZZO IS not NULL";

		$SQL.= "   and lanca_prenfi_ido = prenfi_ido ";

		$SQL.= "   and prenf_numprenf = prenfi_numprenf";

		$SQL.= "   AND PRENF_DATA_IMPORT_AREZZO IS NULL";

	}



	if ($_POST["etapa"] == "9"){

		$SQL.= "   and A.AVALI_AREZ_DATA is not null";

		$SQL.= "   and A.AVALI_AREZ_DATA is not null";

		$SQL.= "   AND PRENF_NUMNFDEVOLUCAO IS not NULL";

		$SQL.= "   AND PRENF_DATA_SOLIC_COLETA IS not NULL";

		$SQL.= "   AND PRENF_DATA_COLETA IS not NULL";

		$SQL.= "   AND PRENF_DATA_RECEBTO_COLETA IS not NULL";

		$SQL.= "   AND PRENF_DATA_RECEBTO_AREZZO IS not NULL";

		if (substr($_POST["LANCA_CATEGORIA"],0,1) == "1"){

			$SQL.= "   AND PRENF_DATA_IMPORT_AREZZO IS not NULL";

		}else{

			$SQL.= "   AND PRENF_DATA_IMPORT_AREZZO IS NULL";

		}

		$SQL.= "   and lanca_prenfi_ido = prenfi_ido ";

		$SQL.= "   and prenf_numprenf = prenfi_numprenf";

		$SQL.= "   and (PRENF_NUMNFDEVOLUCAO, PRENF_PESSOA_DESTINATARIO) not in (";

		$SQL.= "                                                                       select num_nf, pessoa";

		$SQL.= "                                                                         from creditos_pagos ";

		$SQL.= "                                                                      )";

	}



	$SQL.= "       and L.lanca_pessoa in (select usucli_pessoa from rar_usuarioxcliente where usucli_usuar_ido = "  .$_SESSION['sId']. ")";

	$SQL.= " order by PRENF_DATA_NFDEVOLUCAO, prenf_numnfdevolucao ";

	//echo($SQL);



	$Stmt = mysql_query($SQL);

?>

<!-- Objeto de controle de impressão de relatorios -->

<!-- MeadCo ScriptX Control -->

<style type="text/css">

<!--

.style1 {font-weight: bold}

-->

</style>





<object id="factory" style="display:none" viewastext

classid="clsid:1663ed61-23eb-11d2-b92f-008048fdd814"

codebase="ScriptX.cab#Version=5,60,0,360">

</object>

<script defer>

//(Header, Footer, Margins & Orientation) nesta versao so funciona

function window.onload() {

  factory.printing.header = "WFAWeb - Relatório de Etapas Pendentes"

  factory.printing.footer = "<?=$Title." - ".$Categoria?>"

  //true=potrait false=landscape

  factory.printing.portrait = false

}

</script>

<script>

function abrirDetalhe(NumPreNF){

	abrir_janela_popup('rel_gerenciamento_detalhe.php?ID='+NumPreNF,'popup_nf','width=600,height=500,top=0,left=0, scrollbars=yes,status=no,resizable=no,dependent=yes');

}

function abrir_janela_popup(theURL,winName,features) {

	window.open(theURL,winName,features);

}



</script>



<table width="100%" border="0" cellpadding="0" cellspacing="1">

  <tr>

    <td width="7%" class="imp_normal_total"><div align="center"><strong>N&ordm; NF </strong></div></td>

    <td width="8%" class="imp_normal_total"><div align="center"><strong>Data NF </strong></div></td>

    <td width="35%" class="imp_normal_total"><div align="left"><strong>Cliente</strong></div></td>

    <td width="10%" class="imp_normal_total"><div align="center"><strong>Pr&eacute;-Nota</strong></div></td>

    <td width="10%" class="imp_normal_total"><div align="center"><strong>Valor NF </strong></div></td>

    <td width="10%" class="imp_normal_total"><div align="center"><strong>Valor Royalties</strong></div></td>

    <?

	if (substr($_POST["LANCA_CATEGORIA"],0,1) == "2"){

		$Titulo1 = "Chegada Fornecedor";

		$Titulo2 = "Informado crédito";

	}else{

		$Titulo1 = "Chegada Andarella";

		$Titulo2 = "Importação Sistema Andarella";

	}

	?>

  </tr>

<?



	$TotalG = 0;

	$TotalNF = 0;

	$TotalRoyal = 0;

	while($Rs = mysql_fetch_assoc($Stmt)){

		$PRENF_NUMPRENF = $Rs["PRENF_NUMPRENF"];

		

		$SQL = "select ROUND(SUM(PRENFI_QUANTIDADE * PRENFI_VALORUNITARIO),2) + ";

		$SQL.= "               ROUND((SUM(PRENFI_QUANTIDADE * PRENFI_VALORUNITARIO) * PRENF_IPI),2) VALORTOTAL, ";

		$SQL.= "	   ROUND((SUM(PRENFI_QUANTIDADE * PRENFI_VALORUNITARIO) * PRENF_IPI),2) VALORIPI, ";

		$SQL.= "       sum(item_valor_royaltie * prenfi_quantidade) VALORROYAL";

		$SQL.= " from rar_prenf, rar_prenf_item, rar_lancamento l, rar_item i";

		$SQL.= " where prenf_numprenf = prenfi_numprenf";

		$SQL.= "       and prenfi_ido = lanca_prenfi_ido";

		$SQL.= "       and L.lanca_numrar = item_numrar";

		$SQL.= "       and prenf_numprenf = '" . $Rs["PRENF_NUMPRENF"] . "'";

		

		$SQL = " SELECT ROUND(SUM(PRENFI_QUANTIDADE * PRENFI_VALORUNITARIO),2) + ";

		$SQL.= "        ROUND((SUM(PRENFI_QUANTIDADE * PRENFI_VALORUNITARIO) * PRENF_IPI),2) VALORTOTAL, ";

		$SQL.= "        ROUND((SUM(PRENFI_QUANTIDADE * PRENFI_VALORUNITARIO) * PRENF_IPI),2) VALORIPI ";

		$SQL.= "   FROM rar_prenf_item, rar_prenf ";

		$SQL.= "  WHERE PRENFI_NUMPRENF = PRENF_NUMPRENF ";

		$SQL.= "        and prenf_numprenf = '" . $Rs["PRENF_NUMPRENF"] . "'";

		$StmtVlr = mysql_query($SQL);

		if ($Rs3 = mysql_fetch_assoc($StmtVlr)){

			if ($Rs["SUFRAMA"] == "S"){

				$PRENF_VALOR = round($Rs3["VALORTOTAL"] * (1-$Rs["PRENF_ICMS"]),2) + $Rs3["VALORIPI"];

			}else{

				$PRENF_VALOR = $Rs3["VALORTOTAL"];

			}

			

			$SQL = " SELECT SUM( ITEM_QTDE * ITEM_VALOR_ROYALTIE ) VALORROYAL ";

			//$SQL = " SELECT SUM(ITEM_VALOR_ROYALTIE ) VALORROYAL ";

			$SQL.= " FROM rar_prenf_item RI, rar_lancamento L, rar_item I ";

			$SQL.= " WHERE RI.PRENFI_NUMPRENF = '" . $Rs["PRENF_NUMPRENF"] . "'";

			$SQL.= "       AND L.LANCA_PRENFI_IDO = PRENFI_IDO ";

			$SQL.= "       AND I.ITEM_NUMRAR = L.LANCA_NUMRAR  ";

			$StmtVlr = mysql_query($SQL);

			if ($Rs4 = mysql_fetch_assoc($StmtVlr)){

				$VALORROYAL = $Rs4["VALORROYAL"];

			}else{

				$VALORROYAL = 0;

			}

		}else{

			$PRENF_VALOR = 0;

			$VALORROYAL = 0;

		}



		$TotalNF = $TotalNF + $PRENF_VALOR;

		$TotalRoyal = $TotalRoyal + $VALORROYAL;



		if ($Cor == "#DBEDF2"){

			$Cor = "#FFFFFF";

		}else{

			$Cor = "#DBEDF2";

		}

		ob_flush();

		flush();

		/*$pode = "S";

		if ($_POST["etapa"] == "9"){

			$SQL = " select concat(num_nf, pessoa) ";

			$SQL.= " from creditos_pagos ";

			$SQL.= " where num_nf = '" . $Rs["PRENF_NUMNFDEVOLUCAO"]  . "'";

			$SQL.= "       and pessoa = '" . $Rs["PRENF_PESSOA_DESTINATARIO"]  . "'";

			if($Rs = mysql_fetch_assoc($Stmt)){

				$pode = "N";

//				die("Aqui1<br>".$SQL);

			}else{

				$pode = "S";

//				die("Aqui2<br>".$SQL);

			}

		}

		if ($pode == "S")*/ {

			?>

	

			<tr valign="top" bgcolor="<?=$Cor?>">

			<td align="center" class="imp_normal"><div align="center"><?=$Rs["PRENF_NUMNFDEVOLUCAO"]?></div></td>

			<td align="center" class="imp_normal"><?=$Rs["DATA_NFDEVOLUCAO"]?>

			  <div align="center"></div></td>

			<td class="imp_normal"><?=arrumaPessoa($Rs["PESSOA"])?>			   - <?=$Rs["NOME"]?></td>

			<td width="7%" class="imp_normal"><div align="center">N.&ordm; <?=$PRENF_NUMPRENF?></div></td>

			<td width="7%" align="right" class="imp_normal"><?="R$ ".formatCurrency($PRENF_VALOR)?><div align="right"></div></td>

			<td width="7%" align="center" class="imp_normal"><?="R$ ".formatCurrency($VALORROYAL)?><div align="right"></div></td>

		<?

		}

		ob_flush();

		flush();

	} ?>

  </tr>

		<tr valign="top">

		  <td align="center" class="imp_normal">&nbsp;</td>

		  <td align="center" class="imp_normal">&nbsp;</td>

		  <td class="imp_normal">&nbsp;</td>

		  <td class="imp_normal">&nbsp;</td>

		  <td align="right" class="imp_normal">&nbsp;</td>

		  <td align="center" class="imp_normal">&nbsp;</td>

  </tr>

		<tr valign="top" >

		  <td align="center"  class="imp_normal">&nbsp;</td>

		  <td align="center"  class="imp_normal">&nbsp;</td>

		  <td class="imp_normal"><div align="right"></div></td>

		  <td bgcolor="#FFFF99" class="imp_normal"><div align="right"><strong>Total geral : </strong></div></td>

		  <td align="right" bgcolor="#FFFF99" class="imp_normal style1"><?="R$ ".formatCurrency($TotalNF)?>

	      <div align="right"></div></td>

		  <td align="center" bgcolor="#FFFF99" class="imp_normal style1"><?="R$ ".formatCurrency($TotalRoyal)?>

	      <div align="right"></div></td>

  </tr>

</table>



<table width="100%"  border="0">

  <tr>

    <th width="30%" class="imp_normal" scope="col">&nbsp;</th>

    <th width="70%" scope="col">&nbsp;</th>

  </tr>

  <tr>

    <th colspan="2" class="imp_normal" scope="col"><div align="left"></div>      <a href="javascript: window.print();"><img src="imagens/imprimir.jpg" alt="Clique aqui para fechar este relat&oacute;rio" width="52" height="22" border="0" ></a>&nbsp;<a href="javascript: window.close()"><img src="imagens/fechar.jpg" alt="Clique aqui para fechar esta janela" width="52" height="22" border="0" ></a></th>

  </tr>

</table>

<? 	include("inc/bot_imp.inc.php"); ?>