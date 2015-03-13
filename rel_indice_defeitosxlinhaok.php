<? $Title = "Índice de Defeitos x Linha";



	include("inc/top_imp.inc.php"); 

	

	$SQL = "select sum(I.item_qtde) as QTDE ";

	$SQL.= " from rar_lancamento L, rar_defeito_grupo D, pessoa F, rar_avaliacao A, rar_item I ";

	$SQL.= " where L.lanca_fabri_ido = F.PESSOA ";

	$SQL.= "       and L.lanca_numrar = I.item_numrar ";

	$SQL.= "       and L.lanca_numrar = A.avali_numrar ";

	$SQL.= "       and L.lanca_status <> '4'";

	if ($_SESSION["Menu"] == "3"){

		$SQL.= "    and L.lanca_numrar like 'M%'";

	}else{

		$SQL.= "    and L.lanca_numrar not like 'M%'";

	}

	$SQL.= "       and A.AVALI_AREZ_DEFEIg_IDO = defeig_ido " .$SqlCriterios;

	$SQL.= "       and L.lanca_pessoa in (select usucli_pessoa from rar_usuarioxcliente where usucli_usuar_ido = "  .$_SESSION['sId']. ")";

	$Stmt = mysql_query($SQL);

	if ($Rs = mysql_fetch_assoc($Stmt)){

		$TotalDefeitos = $Rs["QTDE"];

	}

		

	$SQL = "select substr(ITEM_referencia,1,4) as LINHA, sum(I.item_qtde) as QTDE ";

	$SQL.= " from rar_lancamento L, rar_defeito_grupo D, pessoa F, rar_avaliacao A, rar_item I ";

	$SQL.= " where L.lanca_fabri_ido = F.PESSOA ";

	$SQL.= "       and L.lanca_numrar = I.item_numrar ";

	$SQL.= "       and L.lanca_numrar = A.avali_numrar ";

	$SQL.= "       and L.lanca_status <> '4'";

	if ($_SESSION["Menu"] == "3"){

		$SQL.= "    and L.lanca_numrar like 'M%'";

	}else{

		$SQL.= "    and L.lanca_numrar not like 'M%'";

	}

	$SQL.= "       and A.AVALI_AREZ_DEFEIg_IDO = defeig_ido " .$SqlCriterios;

	$SQL.= "       and L.lanca_pessoa in (select usucli_pessoa from rar_usuarioxcliente where usucli_usuar_ido = "  .$_SESSION['sId']. ")";

	$SQL.= " group by substr(ITEM_referencia,1,4) ";

	$SQL.= " order by QTDE DESC, LINHA ";

	$Stmt = mysql_query($SQL);

?>

<link href="wfa.css" rel="stylesheet" type="text/css">



<table width="100%" border="0" cellpadding="0" cellspacing="1">

<? $Total = 0;

	//while(ocifetch($Stmt)) {

	while($Rs = mysql_fetch_assoc($Stmt)){ 

		$SQL = "select D.DEFEIG_IDO, D.DEFEIg_DESCRICAO D_NOME, sum(I.item_qtde) as QTDE ";

		$SQL.= " from rar_lancamento L, rar_defeito_grupo D, pessoa F, rar_avaliacao A, rar_item I ";

		$SQL.= " where L.lanca_fabri_ido = F.PESSOA ";

		$SQL.= "       and L.lanca_numrar = I.item_numrar ";

		$SQL.= "       and L.lanca_numrar = A.avali_numrar ";

		$SQL.= "       and L.lanca_status <> '4'";

		if ($_SESSION["Menu"] == "3"){

			$SQL.= "    and L.lanca_numrar like 'M%'";

		}else{

			$SQL.= "    and L.lanca_numrar not like 'M%'";

		}

		$SQL.= "       and substr(ITEM_referencia,1,4) = '" .$Rs["LINHA"]. "' ";

		$SQL.= "       and A.AVALI_AREZ_DEFEIg_IDO = defeig_ido " .$SqlCriterios;

		$SQL.= "       and L.lanca_pessoa in (select usucli_pessoa from rar_usuarioxcliente where usucli_usuar_ido = "  .$_SESSION['sId']. ")";

		$SQL.= " group by D.DEFEIG_IDO, D.DEFEIG_DESCRICAO";

		$SQL.= " order by QTDE DESC, D.DEFEIG_DESCRICAO";

		$Stmt2 = mysql_query($SQL);

		$Total+= intval($Rs["QTDE"]); ?>

		  <tr>

			<td colspan="3" bgcolor="#f5f5f5" class="imp_normal"><div align="right"></div>      

			<div align="left" class="imp_normal_total_fundoamarelo"><strong>Linha:&nbsp;</strong><?=$Rs["LINHA"]?></div>      

			<div align="right"></div></td>

			<td bgcolor="#f5f5f5" class="imp_normal_total_fundoamarelo"><strong>Quantidade:&nbsp;</strong><?=number_format($Rs["QTDE"], 0, ',', '.')?></td>

		    <td width="16%" bgcolor="#f5f5f5" class="imp_normal_total_fundoamarelo"><div align="right">

                <?=round(($Rs["QTDE"]/$TotalDefeitos) * 100,2)?>

&nbsp;% sobre total </div></td>

		  </tr>

		<? while($Rs2 = mysql_fetch_assoc($Stmt2)){ ?>

			<tr>

				<td width="5%" class="imp_normal">&nbsp;</td>

				<td colspan="2" bgcolor="#f5f5f5" class="imp_normal_total">Grupo de defeito:&nbsp;<?=$Rs2["D_NOME"]?></td>

				<td width="17%" bgcolor="#f5f5f5" class="imp_normal_total">Quantidade:&nbsp;<?=number_format($Rs2["QTDE"], 0, ',', '.')?></td>

			    <td bgcolor="#f5f5f5" class="imp_normal_total"><div align="right">

                    <?=round(($Rs2["QTDE"]/$Rs["QTDE"]) * 100,2)?>

&nbsp;% sobre linha </div></td>

			</tr>

			<?

			$SQL = "select D.DEFEIS_DESCRICAO D_NOME, sum(I.item_qtde) as QTDE ";

			$SQL.= "  from rar_lancamento L, rar_defeito_subgrupo D, pessoa F, rar_avaliacao A, rar_item I ";

			$SQL.= " where L.lanca_fabri_ido = F.PESSOA ";

			$SQL.= "       and L.lanca_numrar = I.item_numrar ";

			$SQL.= "       and L.lanca_numrar = A.avali_numrar ";

			$SQL.= "       and L.lanca_status <> '4'";

			if ($_SESSION["Menu"] == "3"){

				$SQL.= "    and L.lanca_numrar like 'M%'";

			}else{

				$SQL.= "    and L.lanca_numrar not like 'M%'";

			}

			$SQL.= "       and substr(ITEM_referencia,1,4) = '" .$Rs["LINHA"]. "' ";

			$SQL.= "       and A.AVALI_AREZ_DEFEIG_IDO = '" .$Rs2["DEFEIG_IDO"]. "' ";

			$SQL.= "       and A.AVALI_AREZ_DEFEIS_IDO = defeis_ido " .$SqlCriterios;

			$SQL.= "       and L.lanca_pessoa in (select usucli_pessoa from rar_usuarioxcliente where usucli_usuar_ido = "  .$_SESSION['sId']. ")";

			$SQL.= " group by D.DEFEIS_DESCRICAO";

			$SQL.= " order by QTDE DESC, DEFEIS_DESCRICAO";

			$Stmt3 = mysql_query($SQL);

			while($Rs3 = mysql_fetch_assoc($Stmt3)){

			?>

			<tr>

			  <td class="imp_normal">&nbsp;</td>

			  <td width="6%" class="imp_normal">&nbsp;</td>

			  <td width="54%" class="imp_normal">Sub-grupo de defeito:&nbsp;<?=$Rs3["D_NOME"]?></td>

			  <td class="imp_normal">Quantidade:&nbsp;<?=number_format($Rs3["QTDE"], 0, ',', '.')?></td>

			  <td class="imp_normal"><div align="right">

                  <?=round(($Rs3["QTDE"]/$Rs2["QTDE"]) * 100,2)?>

&nbsp;% sobre o grupo </div></td>

			</tr>

			<?  } 

			}?>

		<tr>

			<td class="imp_normal_bot" colspan="5">&nbsp;</td>

		  </tr>

		<? } ?>

    <tr>

    <td class="imp_normal_bot" colspan="5">&nbsp;</td>

  </tr>

  <tr>

    <td colspan="3" class="imp_normal"><div align="right"></div>      

	<div align="right"><strong>Total:</strong></div></td>

    <td colspan="2" class="imp_normal"><div align="left">&nbsp;&nbsp;<?=number_format($Total, 0, ',', '.')?></div></td>

  </tr>

  <tr>

    <td colspan="3" class="imp_normal">&nbsp;</td>

    <td colspan="2" class="imp_normal">&nbsp;</td>

  </tr>

  <tr>

    <td colspan="5" class="imp_normal"><div align="center"><a href="javascript: window.print();"><img src="imagens/imprimir.jpg" alt="Clique aqui para fechar este relat&oacute;rio" width="52" height="22" border="0" ></a>&nbsp;<a href="javascript: window.close()"><img src="imagens/fechar.jpg" alt="Clique aqui para fechar esta janela" width="52" height="22" border="0" ></a></div></td>

  </tr>

</table>

<? 	include("inc/bot_imp.inc.php"); ?>

