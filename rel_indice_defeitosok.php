<? $Title = "Índice de Defeitos";

	include("inc/top_imp.inc.php");



	$SQL = "select sum(I.item_qtde) as QTDE";

	$SQL.= " From rar_lancamento L, rar_avaliacao A, rar_item I, rar_defeito_subgrupo D";

	$SQL.= " Where L.lanca_numrar = I.item_numrar";

	$SQL.= "       and L.lanca_status <> '4'";

	if ($_SESSION["Menu"] == "3"){

		$SQL.= "    and L.lanca_numrar like 'M%'";

	}else{

		$SQL.= "    and L.lanca_numrar not like 'M%'";

	}

	$SQL.= "       and A.avali_numrar = lanca_numrar";

	$SQL.= "       and A.AVALI_AREZ_DEFEIS_IDO = defeis_ido " .$SqlCriterios;

	$SQL.= "       and L.lanca_pessoa in (select usucli_pessoa from rar_usuarioxcliente where usucli_usuar_ido = "  .$_SESSION['sId']. ")";

	$Stmt = mysql_query($SQL);

	if ($Rs = mysql_fetch_assoc($Stmt)){

		$TotalDefeitos = $Rs["QTDE"];

	}



	$SQL = "select D.DEFEIG_DESCRICAO, D.DEFEIG_IDO, sum(I.item_qtde) as QTDE";

	$SQL.= " From rar_lancamento L, rar_avaliacao A, rar_item I, rar_defeito_grupo D";

	$SQL.= " Where L.lanca_numrar = I.item_numrar";

	$SQL.= "       and L.lanca_status <> '4'";

	if ($_SESSION["Menu"] == "3"){

		$SQL.= "    and L.lanca_numrar like 'M%'";

	}else{

		$SQL.= "    and L.lanca_numrar not like 'M%'";

	}

	$SQL.= "       and A.avali_numrar = lanca_numrar";

	$SQL.= "       and A.AVALI_AREZ_DEFEIG_IDO = defeig_ido " .$SqlCriterios;

	$SQL.= "       and L.lanca_pessoa in (select usucli_pessoa from rar_usuarioxcliente where usucli_usuar_ido = "  .$_SESSION['sId']. ")";

	$SQL.= " group by D.defeiG_descricao, D.DEFEIG_IDO";

	$SQL.= " order by qtde desc, D.defeiG_descricao";

	//die($SQL);

	$Stmt = mysql_query($SQL);

	$Qtde = 0;

	?>

<link href="wfa.css" rel="stylesheet" type="text/css">





<table width="100%" border="0" cellpadding="0" cellspacing="1">

  <tr>

    <td width="56%" class="imp_normal_total"><div align="left"><strong>Grupo de Defeito</strong></div></td>

    <td width="22%" class="imp_normal_total"><div align="center"><strong>Quantidade de <?=$UnidadeMedida?> </strong></div></td>

    <td width="22%" class="imp_normal_total"><div align="center"><strong>% sobre total defeitos </strong></div></td>

  </tr>

<? while($Rs = mysql_fetch_assoc($Stmt)) {

	$Qtde+= intval($Rs["QTDE"]); ?>

  <tr bgcolor="#f5f5f5">

    <td class="imp_normal"><?=$Rs["DEFEIG_DESCRICAO"]?></td>

    <td class="imp_normal"><div align="right"><?=$Rs["QTDE"]?></div></td>

    <td class="imp_normal"><div align="right"><?=round(($Rs["QTDE"]/$TotalDefeitos) * 100,2)?>&nbsp;%</div></td>

  </tr>

  <tr>

    <td colspan="3" class="imp_normal"><table width="95%"  border="0" align="right">

      <tr>

        <td width="54%" class="imp_normal_total"><strong>Sub-grupo de defeito</strong></td>

        <td width="23%" class="imp_normal_total"><div align="center"><strong>Quantidade de <?=$UnidadeMedida?> </strong></div></td>

        <td width="23%" class="imp_normal_total" align="center"><div ><strong>% sobre grupo de defeitos </strong></div></td>

      </tr>

      <?



		$SQL = "select D.DEFEIs_DESCRICAO, sum(I.item_qtde) as QTDE";

		$SQL.= " From rar_lancamento L, rar_avaliacao A, rar_item I, rar_defeito_subgrupo D";

		$SQL.= " Where L.lanca_numrar = I.item_numrar";

		$SQL.= "       and L.lanca_status <> '4'";

		if ($_SESSION["Menu"] == "3"){

			$SQL.= "    and L.lanca_numrar like 'M%'";

		}else{

			$SQL.= "    and L.lanca_numrar not like 'M%'";

		}

		$SQL.= "       and A.avali_numrar = lanca_numrar ";

		$SQL.= "       and A.AVALI_AREZ_DEFEIs_IDO = defeis_ido " .$SqlCriterios;

		$SQL.= "       and d.DEFEIS_DEFEIG_IDO = ".$Rs["DEFEIG_IDO"];

		$SQL.= "       and L.lanca_pessoa in (select usucli_pessoa from rar_usuarioxcliente where usucli_usuar_ido = "  .$_SESSION['sId']. ")";

		$SQL.= " group by D.defeis_descricao";

		$SQL.= " order by qtde desc, D.defeis_descricao";

		//die($SQL);

		$Stmt2 = mysql_query($SQL);

		$TotalGrupo = $Rs["QTDE"];

		while($Rs2 = mysql_fetch_assoc($Stmt2)){

			$Perc = round(($Rs2["QTDE"]/$Rs["QTDE"])*100,2);

			?>

			  <tr class="imp_normal">

				<td><?=$Rs2["DEFEIs_DESCRICAO"]?></td>

				<td align="right"><?=number_format($Rs2["QTDE"], 0, ',', '.')?></td>

				<td align="center"><?=number_format($Perc, 2, ',', '.')?>%</td>

			  </tr>

      <? } ?>

    </table></td>

  </tr>

<? } ?>

    <tr>

    <td class="imp_normal_bot" colspan="3">&nbsp;</td>

  </tr>

  <tr>

    <td class="imp_normal"><div align="right"><strong>Total:</strong></div></td>

    <td class="imp_normal"><div align="right"><strong><?=number_format($Qtde, 0, ',', '.')?></strong></div></td>

    <td class="imp_normal"><div align="right"><strong><?=(($Qtde != 0 && $TotalDefeitos != 0) ? round(($Qtde/$TotalDefeitos) * 100,2) : "0")?>&nbsp;%</strong></div></td>

  </tr>

  <tr>

    <td class="imp_normal">&nbsp;</td>

    <td class="imp_normal">&nbsp;</td>

    <td class="imp_normal">&nbsp;</td>

  </tr>

  <tr>

    <td colspan="3" class="imp_normal"><div align="center"><a href="javascript: window.print();"><img src="imagens/imprimir.jpg" alt="Clique aqui para fechar este relat&oacute;rio" width="52" height="22" border="0" ></a>&nbsp;<a href="javascript: window.close()"><img src="imagens/fechar.jpg" alt="Clique aqui para fechar esta janela" width="52" height="22" border="0" ></a></div></td>

  </tr>

</table>

<? 	include("inc/bot_imp.inc.php"); ?>

