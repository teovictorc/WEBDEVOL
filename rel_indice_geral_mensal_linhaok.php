<? $Title = "Índice Geral Mensal - Linha";

	include("inc/top_imp.inc.php"); 

	

		$SQL = "select ";

		$SQL.= " sum(I.item_qtde) as PAR_RECLAMADO, round(sum(I.item_valor*I.item_qtde),2) as VLR_RECLAMADO";

		$SQL.= " from rar_lancamento L, pessoa C, pessoa F, rar_avaliacao A, rar_item I ";

		$SQL.= " where L.lanca_PESSOA = C.PESSOA ";

		$SQL.= "       and L.lanca_numrar = I.item_numrar ";

		$SQL.= "       and L.lanca_numrar = A.avali_numrar ";

		$SQL.= "       and L.lanca_status <> '4'";

		if ($_SESSION["Menu"] == "3"){

			$SQL.= "    and L.lanca_numrar like 'M%'";

		}else{

			$SQL.= "    and L.lanca_numrar not like 'M%'";

		}

		$SQL.= "       and AVALI_AREZ_DATA is not null";

		$SQL.= "       and AVALI_SITUACAO = 'P'";

		$SQL.= "       and L.lanca_fabri_ido = F.PESSOA " .$SqlCriterios;

		$SQL.= "       and L.lanca_pessoa in (select usucli_pessoa from rar_usuarioxcliente where usucli_usuar_ido = "  .$_SESSION['sId']. ")";

		$Stmt = mysql_query($SQL);

		while($Rs = mysql_fetch_assoc($Stmt)){

			$ValorTotal = $Rs["VLR_RECLAMADO"];

			$QtdeTotal = $Rs["PAR_RECLAMADO"];

		}



		$SQL = "select date_format(".$SqlAgruparPor.",'%m/%Y') data,";

		$SQL.= " sum(I.item_qtde) as PAR_RECLAMADO, round(sum(I.item_valor*I.item_qtde),2) as VLR_RECLAMADO";

		$SQL.= " from rar_lancamento L, pessoa C, pessoa F, rar_avaliacao A, rar_item I ";

		$SQL.= " where L.lanca_PESSOA = C.PESSOA ";

		$SQL.= "       and L.lanca_numrar = I.item_numrar ";

		$SQL.= "       and L.lanca_numrar = A.avali_numrar ";

		$SQL.= "       and L.lanca_status <> '4'";

		if ($_SESSION["Menu"] == "3"){

			$SQL.= "    and L.lanca_numrar like 'M%'";

		}else{

			$SQL.= "    and L.lanca_numrar not like 'M%'";

		}

		$SQL.= "       and AVALI_AREZ_DATA is not null";

		$SQL.= "       and AVALI_SITUACAO = 'P'";

		$SQL.= "       and L.lanca_fabri_ido = F.PESSOA " .$SqlCriterios;

		$SQL.= "       and L.lanca_pessoa in (select usucli_pessoa from rar_usuarioxcliente where usucli_usuar_ido = "  .$_SESSION['sId']. ")";

		$SQL.= " group by date_format(".$SqlAgruparPor.",'%m/%Y')";

		$SQL.= " order by date_format(".$SqlAgruparPor.",'%Y/%m')";

		$Stmt = mysql_query($SQL);

		//die($SQL);

?>

<link href="wfa.css" rel="stylesheet" type="text/css">





<table width="100%" border="0" cellpadding="0" cellspacing="1">

  <tr>

    <td>&nbsp;</td>

    <td colspan="3" class="imp_normal_total"><div align="center"><strong>Procedentes</strong></div></td>

  </tr>

  <tr>

    <td class="imp_normal_total"><div align="left"><strong>M&ecirc;s/Ano</strong></div></td>

    <td width="20%" class="imp_normal_total"><div align="center"><strong>

      <?=$UnidadeMedida?>

    </strong></div></td>

    <td width="20%" class="imp_normal_total"><div align="center"><strong>Valores</strong></div></td>

    <td width="20%" class="imp_normal_total"><div align="center"><strong>% sobre 

      <?=$UnidadeMedida?>

    </strong></div></td>

  </tr>

<?  

	$ValorIT = 0;

	$QtdeIT = 0;

	$ValorPT = 0;

	$QtdePT = 0;

	$ValorT = 0;

	$QtdeT = 0;

	while($Rs = mysql_fetch_assoc($Stmt)){

		$data = $Rs["data"];

		$Valor = $Rs["VLR_RECLAMADO"];

		$Qtde = $Rs["PAR_RECLAMADO"];

		$Perc = round(($Rs["PAR_RECLAMADO"]/$QtdeTotal)*100,2);

		?>

		<tr class="imp_normal_total_fundoamarelo">

			<td class="imp_normal_total_fundoamarelo"><?=$Rs["data"]?></td>

			<td class="imp_normal_total_fundoamarelo" align="right"><?=number_format($Rs["PAR_RECLAMADO"], 0, ',', '.')?></td>

			<td align="right" class="imp_normal_total_fundoamarelo"><?=number_format($Rs["VLR_RECLAMADO"], 2, ',', '.')?></td>

			<td align="center" class="imp_normal_total_fundoamarelo"><?=number_format($Perc, 2, ',', '.')?>		      % 

			  <div align="center"></div></td>

  </tr>

		  <tr>

			  <td colspan="4" class="imp_normal"><table width="95%"  border="0" align="right">

                <tr>

                  <td width="37%" class="imp_normal_total"><strong>Linha</strong></td>

                  <td width="21%" class="imp_normal_total"><div align="center"><strong>

                    <?=$UnidadeMedida?>

                  </strong></div></td>

                  <td width="21%" class="imp_normal_total"><div align="center"><strong>Valores</strong></div></td>

                  <td width="21%" class="imp_normal_total" align="center"><div ><strong>% sobre 

                    <?=$UnidadeMedida?>

                  </strong></div></td>

                </tr>

		<?

	

		$SQL = "select substr(item_referencia,1,4) linha, ";

		$SQL.= "       sum(I.item_qtde) as PAR_RECLAMADO, sum(I.item_valor*I.item_qtde) as VLR_RECLAMADO, a.AVALI_SITUACAO";

		$SQL.= " from rar_lancamento L, pessoa C, pessoa F, rar_avaliacao A, rar_item I ";

		$SQL.= " where L.lanca_PESSOA = C.PESSOA ";

		$SQL.= "       and L.lanca_numrar = I.item_numrar ";

		$SQL.= "       and L.lanca_numrar = A.avali_numrar ";

		$SQL.= "       and L.lanca_status <> '4'";

		if ($_SESSION["Menu"] == "3"){

			$SQL.= "    and L.lanca_numrar like 'M%'";

		}else{

			$SQL.= "    and L.lanca_numrar not like 'M%'";

		}

		$SQL.= "       and a.avali_situacao = 'P'";

		$SQL.= "       and L.lanca_fabri_ido = F.PESSOA " .$SqlCriterios;

		$SQL.= "       and date_format(".$SqlAgruparPor.",'%m/%Y') = '" .$Rs["data"]. "' ";

		$SQL.= "       and L.lanca_pessoa in (select usucli_pessoa from rar_usuarioxcliente where usucli_usuar_ido = "  .$_SESSION['sId']. ")";

		$SQL.= " group by substr(item_referencia,1,4) ";

		$SQL.= " order by 2 desc";

		$Stmt2 = mysql_query($SQL);

		$ValorI= 0;

		$QtdeI= 0;

		$ValorP= 0;

		$QtdeP= 0;

		while($Rs2 = mysql_fetch_assoc($Stmt2)){

			$ValorP+= $Rs2["VLR_RECLAMADO"];

			$QtdeP+= ($Rs2["PAR_RECLAMADO"]);

			$ValorPT+= ($Rs2["VLR_RECLAMADO"]);

			$QtdePT+= ($Rs2["PAR_RECLAMADO"]);

			$Perc = round(($Rs2["PAR_RECLAMADO"]/$Rs["PAR_RECLAMADO"])*100,2);

			?>

                <tr class="imp_normal">

                  <td><?=$Rs2["linha"]?></td>

                  <td align="right"><?=number_format($Rs2["PAR_RECLAMADO"], 0, ',', '.')?></td>

                  <td align="right"><?=number_format($Rs2["VLR_RECLAMADO"], 2, ',', '.')?></td>

                  <td align="center"><?=number_format($Perc, 2, ',', '.')?>                    % </td>

                </tr>

			<? } ?>

		    	</table>		    

				</td>

  			</tr>

	  		<tr>

			  <td colspan="4" class="imp_normal">&nbsp;</td>

			</tr>

	<? } ?>

	<tr>

	    <td class="imp_normal_total"><strong>Total geral </strong></td>

	    <td class="imp_normal_total" align="right"><strong><?=number_format($QtdeTotal,0,',','.')?></strong></td>

	    <td class="imp_normal_total" align="right"><strong><?=number_format($ValorTotal,2,',','.')?></strong></td>

	    <td align="right" class="imp_normal_total"><strong>100,00 %</strong></td>

  </tr>

</table>

<table width="100%" border="0" cellpadding="0" cellspacing="0">

  <tr>

    <td width="87%" class="imp_normal">&nbsp;</td>

  </tr>

  

  <?

  //setlocale(LC_MONETARY, 'pt_BR');

  ?>

  <tr>

    <td class="imp_normal"><div align="center"><a href="javascript: window.print();"><img src="imagens/imprimir.jpg" alt="Clique aqui para fechar este relat&oacute;rio" width="52" height="22" border="0" ></a>&nbsp;<a href="javascript: window.close()"><img src="imagens/fechar.jpg" alt="Clique aqui para fechar esta janela" width="52" height="22" border="0" ></a></div></td>

  </tr>

</table>

<? 	include("inc/bot_imp.inc.php"); ?>

