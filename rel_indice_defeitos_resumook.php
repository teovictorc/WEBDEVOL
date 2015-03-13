<? $Title = "Índice de Defeitos - Resumo";

	include("inc/top_imp.inc.php"); 

		

		$SQL = "select F.NOME F_NOME, F.PESSOA F_CODIGO, ";

		$SQL.= "      sum(I.item_qtde) as QTDE ";

		$SQL.= " from rar_lancamento L, rar_defeito_subgrupo D, pessoa F, rar_avaliacao A, rar_item I ";

		$SQL.= " where L.LANCA_FABRI_IDO = F.PESSOA ";

		$SQL.= "       and L.lanca_numrar = I.item_numrar ";

		$SQL.= "       and L.lanca_numrar = A.avali_numrar ";

		$SQL.= "       and L.lanca_status <> '4'";

		if ($_SESSION["Menu"] == "3"){

			$SQL.= "    and L.lanca_numrar like 'M%'";

		}else{

			$SQL.= "    and L.lanca_numrar not like 'M%'";

		}

		$SQL.= "       and a.AVALI_SITUACAO <> 'I'";

		$SQL.= "       and L.lanca_pessoa in (select usucli_pessoa from rar_usuarioxcliente where usucli_usuar_ido = "  .$_SESSION['sId']. ")";

		$SQL.= "       and A.AVALI_AREZ_DEFEIS_IDO = defeis_ido " .$SqlCriterios;

		if ($_POST['TEMPO'] != "3" && $_POST['TEMPO'] != ""){ //todos ou nenhum selecionado

			if ($_POST['TEMPO'] == "1"){

				$SQL.= "       and datediff(lanca_dataabertura,item_data)/30 <= 9 ";

			}else{

				$SQL.= "       and datediff(lanca_dataabertura,item_data)/30 > 9 ";

			}

		}

		$SQL.= " group by F.NOME, F.PESSOA ";

		$SQL.= " order by QTDE desc, F.PESSOA, F.NOME ";

		//die($SQL);

		$Stmt = mysql_query($SQL);

		//ociexecute($Stmt); ?>

<link href="wfa.css" rel="stylesheet" type="text/css">





<table width="100%" border="0" cellpadding="0" cellspacing="1">

<? $Total = 0;

	while($Rs = mysql_fetch_assoc($Stmt)){ 

		$SQL = "select round(i.item_valor,2) ITEM_VALOR, date_format(item_data,'%d/%m/%Y') As ITEM_DATA,";

		$SQL.= "       concat(substring(item_referencia,1,4),'-',substring(item_referencia,5,4),'-',substring(item_referencia,9,4),'-',substring(item_referencia,13,4)) ITEM_REFERENCIA,";

	    $SQL.= "       ITEM_COLECAO, ITEM_NF, ITEM_PAR, ITEM_QTDE, ITEM_NUMRAR, ";

		$SQL.= "       round(datediff(lanca_dataabertura,item_data)/30,0) MESES,";

		$SQL.= "       date_format(AVALI_AREZ_DATA ,'%d/%m/%Y') As AVALI_DATA";

		$SQL.= " from rar_lancamento L, rar_defeito_subgrupo D, pessoa F, rar_avaliacao A, rar_item I ";

		$SQL.= " where L.LANCA_FABRI_IDO = F.PESSOA ";

		$SQL.= "       and L.lanca_numrar = I.item_numrar ";

		$SQL.= "       and L.lanca_numrar = A.avali_numrar ";

		$SQL.= "       and a.AVALI_SITUACAO <> 'I'";

		if ($_SESSION["Menu"] == "3"){

		$SQL.= "    and L.lanca_numrar like 'M%'";

		}else{

			$SQL.= "    and L.lanca_numrar not like 'M%'";

		}

		$SQL.= "       and F.PESSOA = '" .$Rs["F_CODIGO"]. "' ";

		$SQL.= "       and L.lanca_pessoa in (select usucli_pessoa from rar_usuarioxcliente where usucli_usuar_ido = "  .$_SESSION['sId']. ")";

		$SQL.= "       and A.AVALI_AREZ_DEFEIS_IDO = defeis_ido " .$SqlCriterios;

		if ($_POST['TEMPO'] != "3" && $_POST['TEMPO'] != ""){ //todos ou nenhum selecionado

			if ($_POST['TEMPO'] == "1"){

				$SQL.= "       and datediff(lanca_dataabertura,item_data)/30 <= 9 ";

			}else{

				$SQL.= "       and datediff(lanca_dataabertura,item_data)/30 > 9 ";

			}

		}

		//$SQL.= " group by substr(I.item_referencia,1,4), D.DEFEIs_DESCRICAO";

		$SQL.= " order by MESES desc, item_referencia ";

		

		$Stmt2 = mysql_query($SQL);

		//ociexecute($Stmt2);

		$Total+= intval($Rs["QTDE"]);

?>

  <tr class="tabela">

    <td height="25" colspan="6" class="imp_normal"><div align="right"></div>      

    <div align="left"><strong>Fabricante:&nbsp;</strong><?=$Rs["F_CODIGO"]?> - <?=$Rs["F_NOME"]?></div>      

    <div align="right"></div></td>

    <td class="imp_normal"><strong>Quantidade:&nbsp; </strong><?=$Rs["QTDE"]?></td>

  </tr>

   <tr class="campo_amarelo">

    <td height="20" class="imp_normal" align="center">RAR</td>

    <td width="12%" class="imp_normal" align="center">DATA NF</td>

    <td width="10%" class="imp_normal" align="center">N&deg; NF</td>

    <td width="19%" class="imp_normal" align="center">REFER&Ecirc;NCIA</td>

    <td width="11%" class="imp_normal" align="center">VALOR NF</td>

    <td width="17%" class="imp_normal" align="center">DATA AVALIA&Ccedil;&Atilde;O</td>

    <td width="17%" class="imp_normal" align="center">TEMPO (MESES)</td>

  </tr>

<? 

	$TotalF = 0;

	while($Rs2 = mysql_fetch_assoc($Stmt2)){ 

		$TotalF+= intval($Rs["QTDE"]);

	?>

 

  <tr>

    <td width="11%" class="imp_normal" align="center"><?=$Rs2["ITEM_NUMRAR"]?></td>

    <td class="imp_normal" align="center"><?=$Rs2["ITEM_DATA"]?></td>

    <td class="imp_normal" align="center"><?=$Rs2["ITEM_NF"]?></td>

    <td class="imp_normal" align="center"><?=$Rs2["ITEM_REFERENCIA"]?></td>

    <td class="imp_normal" align="center"><?=$Rs2["ITEM_VALOR"]?></td>

    <td class="imp_normal" align="center"><?=$Rs2["AVALI_DATA"]?></td>

    <td class="imp_normal" align="center"><?=$Rs2["MESES"]?></td>

  </tr>

  

<?  } ?>

<tr>

    <td class="imp_normal">&nbsp;</td>

    <td colspan="5" class="imp_normal">&nbsp;</td>

    <td class="imp_normal">&nbsp;</td>

  </tr>

<? } ?>

    <tr>

    <td class="imp_normal_bot" colspan="7">&nbsp;</td>

  </tr>

  <tr>

    <td colspan="6" class="imp_normal"><div align="right"></div>      <div align="right"><strong>Total:</strong></div></td>

    <td class="imp_normal"><div align="left"><strong>&nbsp;&nbsp;<?=$Total?></strong></div></td>

  </tr>

  <tr>

    <td colspan="6" class="imp_normal">&nbsp;</td>

    <td class="imp_normal">&nbsp;</td>

  </tr>

  <tr>

    <td colspan="7" class="imp_normal"><div align="center"><a href="javascript: window.print();"><img src="imagens/imprimir.jpg" alt="Clique aqui para fechar este relat&oacute;rio" width="52" height="22" border="0" ></a>&nbsp;<a href="javascript: window.close()"><img src="imagens/fechar.jpg" alt="Clique aqui para fechar esta janela" width="52" height="22" border="0" ></a></div></td>

  </tr>

</table>

<? 	include("inc/bot_imp.inc.php"); ?>

