<? $Title = "Índice de Reclamações X Clientes";

	include("inc/top_imp.inc.php"); 



	$SQL = "select C.NOME C_NOME, C.PESSOA C_CODIGO, ";

	$SQL.= " sum(I.item_qtde) as QTDE";

	$SQL.= " from rar_lancamento L, PESSOA C, rar_avaliacao A, rar_item I ";

	$SQL.= " where L.lanca_PESSOA = C.PESSOA ";

	$SQL.= "       and L.lanca_numrar = I.item_numrar ";

	$SQL.= "       and L.lanca_numrar = A.avali_numrar ";

	if ($_SESSION["Menu"] == "3"){

		$SQL.= "    and L.lanca_numrar like 'M%'";

	}else{

		$SQL.= "    and L.lanca_numrar not like 'M%'";

	}

	$SQL.= "       and L.lanca_pessoa in (select usucli_pessoa from rar_usuarioxcliente where usucli_usuar_ido = "  .$_SESSION['sId']. ")";

	$SQL.= "       and L.lanca_status <> '4' ".$SqlCriterios;

	$SQL.= " group by C.PESSOA,  C.NOME ";

	$SQL.= " order by QTDE desc, C.NOME, C.PESSOA";

	$Stmt = mysql_query($SQL);

	

	if ($_POST['LANCA_CATEGORIA'] == "1" || $_GET['LANCA_CATEGORIA'] == "1"){

		$UnidadeMedida = "Pares";

	}else{

		$UnidadeMedida = "Qtde";

	}

		

	

?>

<link href="wfa.css" rel="stylesheet" type="text/css">



<table width="100%" border="0" cellpadding="0" cellspacing="1">

  <tr>

    <td>&nbsp;</td>

    <td width="13%" rowspan="2" class="imp_normal_total"><div align="center"><strong><?=$UnidadeMedida?> Reclamados</strong></div>      

      <div align="center"></div>      <div align="center"></div></td>

    <td colspan="2" class="imp_normal_total"><div align="center"><strong>Procedentes</strong></div></td>

    <td colspan="2" class="imp_normal_total"><div align="center"><strong>Improcedentes</strong></div></td>

  </tr>

  <tr>

    <td class="imp_normal_total"><div align="left"><strong>Nome da loja </strong></div>      </td>

    <td width="8%" class="imp_normal_total"><div align="center"><strong><?=$UnidadeMedida?></strong></div></td>

    <td width="11%" class="imp_normal_total"><div align="center"><strong>Percentual</strong></div></td>

    <td width="8%" class="imp_normal_total"><div align="center"><strong><?=$UnidadeMedida?></strong></div></td>

    <td width="11%" class="imp_normal_total"><div align="center"><strong>Percentual</strong></div></td>

  </tr>

<?  

	$ValorIT = 0;

	$QtdeIT = 0;

	$ValorPT = 0;

	$QtdePT = 0;

	$ValorT = 0;

	$QtdeT = 0;

	$Qtde = 0;

	$QtdeP = 0;

	$QtdeI = 0;

	while($Rs = mysql_fetch_assoc($Stmt)){ 

		$QtdeI = 0;

		$QtdeP = 0;

		$SQL = "select C.NOME C_NOME, C.PESSOA C_CODIGO, sum(I.item_qtde) as QTDE ";

		$SQL.= " from rar_lancamento L, pessoa C, rar_avaliacao A, rar_item I ";

		$SQL.= " where L.lanca_PESSOA = C.PESSOA ";

		$SQL.= "       and L.lanca_numrar = I.item_numrar ";

		$SQL.= "       and L.lanca_numrar = A.avali_numrar ";

		if ($_SESSION["Menu"] == "3"){

			$SQL.= "    and L.lanca_numrar like 'M%'";

		}else{

			$SQL.= "    and L.lanca_numrar not like 'M%'";

		}

		$SQL.= "       and L.lanca_status <> '4' ".$SqlCriterios;

		$SQL.= "       and C.PESSOA = '" .$Rs["C_CODIGO"]. "' ";

		$SQL.= "       and a.avali_situacao = 'I'";

		$SQL.= "       and L.lanca_pessoa in (select usucli_pessoa from rar_usuarioxcliente where usucli_usuar_ido = "  .$_SESSION['sId']. ")";

		$SQL.= " group by C.PESSOA,  C.NOME ";

		$SQL.= " order by C.NOME, C.PESSOA";

		//die($SQL);

		$Stmt2 = mysql_query($SQL);

		if ($Rs2 = mysql_fetch_assoc($Stmt2)){

			$QtdeI=$Rs2["QTDE"];

		}

		

		$SQL = "select C.NOME C_NOME, C.PESSOA C_CODIGO, sum(I.item_qtde) as QTDE ";

		$SQL.= " from rar_lancamento L, pessoa C, rar_avaliacao A, rar_item I ";

		$SQL.= " where L.lanca_PESSOA = C.PESSOA ";

		$SQL.= "       and L.lanca_numrar = I.item_numrar ";

		$SQL.= "       and L.lanca_numrar = A.avali_numrar ";

		if ($_SESSION["Menu"] == "3"){

			$SQL.= "    and L.lanca_numrar like 'M%'";

		}else{

			$SQL.= "    and L.lanca_numrar not like 'M%'";

		}

		$SQL.= "       and L.lanca_status <> '4' ".$SqlCriterios;

		$SQL.= "       and C.PESSOA = '" .$Rs["C_CODIGO"]. "' ";

		$SQL.= "       and a.avali_situacao = 'P'";

		$SQL.= "       and L.lanca_pessoa in (select usucli_pessoa from rar_usuarioxcliente where usucli_usuar_ido = "  .$_SESSION['sId']. ")";

		$SQL.= " group by C.PESSOA,  C.NOME ";

		$SQL.= " order by C.NOME, C.PESSOA";

		$Stmt2 = mysql_query($SQL);

		if ($Rs2 = mysql_fetch_assoc($Stmt2)){

			$QtdeP=$Rs2["QTDE"];

		}

		$Qtde = $QtdeI + $QtdeP;

		$QtdeIT+= $QtdeI;

		$QtdePT+= $QtdeP;

		$QtdeT+= $Qtde; ?>

		<tr>

		<td class="imp_normal"><?=$Rs["C_CODIGO"]?>		   - <?=$Rs["C_NOME"]?></td>

		<td align="right" class="imp_normal"><?=number_format($Qtde, 0, ',', '.')?>		  </td>

		<td class="imp_normal" align="right"><?=number_format($QtdeP, 0, ',', '.')?></td>

		<td class="imp_normal" align="right"><?=number_format(($QtdeP/$Qtde) * 100, 2, ',', '.')?> %</td>

		<td class="imp_normal" align="right"><?=number_format($QtdeI, 0, ',', '.')?></td>		

		<td class="imp_normal" align="right"><?=number_format(($QtdeI/$Qtde) * 100, 2, ',', '.')?> %</td>

		</tr>

		<?

	}?>

</table>

<table width="100%" border="0" cellpadding="0" cellspacing="0">

  <tr>

    <td width="87%" class="imp_normal"><table width="100%"  border="0">

      <tr >

        <td width="49%" class="imp_normal_total"><strong>Total geral</strong></td>

        <td width="13%" class="imp_normal_total"><div align="right"><strong>

            <?=number_format($QtdeT, 0, ',', '.')?>

        </strong></div></td>

        <td width="8%" class="imp_normal_total"><div align="right"><strong>

            <?=number_format($QtdePT, 0, ',', '.')?>

        </strong></div></td>

        <td width="11%" class="imp_normal_total"><div align="right"><strong>

            <?=number_format(($QtdePT/$QtdeT) * 100, 2, ',', '.')?>

&nbsp;%        </strong></div></td>

        <td width="8%" class="imp_normal_total"><div align="right"><strong>

            <?=number_format($QtdeIT, 0, ',', '.')?>

        </strong></div></td>

        <td width="11%" class="imp_normal_total"><div align="right"><strong>

            <?=number_format(($QtdeIT/$QtdeT) * 100, 2, ',', '.')?>

&nbsp;%        </strong></div></td>

      </tr>

    </table></td>

  </tr>

  <tr>

    <td class="imp_normal">&nbsp;</td>

  </tr>

  <tr>

    <td class="imp_normal"><div align="center"><a href="javascript: window.print();"><img src="imagens/imprimir.jpg" alt="Clique aqui para fechar este relat&oacute;rio" width="52" height="22" border="0" ></a>&nbsp;<a href="javascript: window.close()"><img src="imagens/fechar.jpg" alt="Clique aqui para fechar esta janela" width="52" height="22" border="0" ></a></div></td>

  </tr>

</table>

<? 	include("inc/bot_imp.inc.php"); ?>

