<? $Title = "Índice Geral";

	include("inc/top_imp.inc.php"); 



		$SQL = "select date_format(".$SqlAgruparPor.",'%m/%Y') data,";

		$SQL.= " sum(I.item_qtde) as PAR_RECLAMADO, round(sum(I.item_valor*I.item_qtde),2) as VLR_RECLAMADO";

		$SQL.= " from rar_lancamento L, PESSOA C, PESSOA F, rar_avaliacao A, rar_item I ";

		$SQL.= " where L.lanca_PESSOA = C.PESSOA ";

		$SQL.= "       and L.lanca_numrar = I.item_numrar ";

		$SQL.= "       and L.lanca_numrar = A.avali_numrar ";

		if ($_SESSION["Menu"] == "3"){

			$SQL.= "    and l.lanca_numrar like 'M%'";

		}else{

			$SQL.= "    and l.lanca_numrar not like 'M%'";

		}

		$SQL.= "       and L.lanca_status <> '4'";

		$SQL.= "       and AVALI_AREZ_DATA is not null";

		$SQL.= "       and AVALI_situacao is not null";

		$SQL.= "       and L.lanca_fabri_ido = F.PESSOA " .$SqlCriterios;

		$SQL.= "       and l.lanca_pessoa in (select usucli_pessoa from rar_usuarioxcliente where usucli_usuar_ido = "  .$_SESSION['sId']. ")";

		$SQL.= " group by date_format(".$SqlAgruparPor.",'%m/%Y')";

		$SQL.= " order by date_format(".$SqlAgruparPor.",'%Y/%m')";
		//echo($SQL);
		$Stmt = mysql_query($SQL);

		//die($SQL);

?>



<table width="100%" border="0" cellpadding="0" cellspacing="1">

  <tr>

    <td width="10%">&nbsp;</td>

    <td colspan="2" class="imp_normal_total"><div align="center"><strong>Reclamados</strong></div></td>

    <td colspan="3" class="imp_normal_total"><div align="center"><strong>Procedentes</strong></div></td>

    <td colspan="3" class="imp_normal_total"><div align="center"><strong>Improcedentes</strong></div></td>
	
	<td colspan="3" class="imp_normal_total"><div align="center"><strong>Consertos</strong></div></td>
	
	<td colspan="3" class="imp_normal_total"><div align="center"><strong>Em análise</strong></div></td>

  </tr>

  <tr>

    <td class="imp_normal_total"><div align="left"><strong>M&ecirc;s/Ano</strong></div></td>
    <td width="15%" class="imp_normal_total"><div align="center"><strong><?=$UnidadeMedida?></strong></div></td>
    <td width="15%" class="imp_normal_total"><div align="center"><strong>Valores</strong></div></td>
    <td width="5%" class="imp_normal_total"><div align="center"><strong><?=$UnidadeMedida?></strong></div></td>
    <td width="5%" class="imp_normal_total"><div align="center"><strong>Valores</strong></div></td>
    <td width="5%" class="imp_normal_total"><div align="center"><strong>%</strong></div></td>
    <td width="5%" class="imp_normal_total"><div align="center"><strong><?=$UnidadeMedida?></strong></div></td>
    <td width="5%" class="imp_normal_total"><div align="center"><strong>Valores</strong></div></td>
    <td width="5%" class="imp_normal_total"><div align="center"><strong>%</strong></div></td>
	<td width="5%" class="imp_normal_total"><div align="center"><strong><?=$UnidadeMedida?></strong></div></td>
    <td width="5%" class="imp_normal_total"><div align="center"><strong>Valores</strong></div></td>
    <td width="5%" class="imp_normal_total"><div align="center"><strong>%</strong></div></td>
	
	<td width="5%" class="imp_normal_total"><div align="center"><strong><?=$UnidadeMedida?></strong></div></td>
    <td width="5%" class="imp_normal_total"><div align="center"><strong>Valores</strong></div></td>
    <td width="5%" class="imp_normal_total"><div align="center"><strong>%</strong></div></td>
	

  </tr>

<?  

	$ValorIT = 0;
	$QtdeIT = 0;
	$ValorPT = 0;
	$QtdePT = 0;
	$ValorCT = 0;
	$QtdeCT = 0;
	$ValorET = 0;
	$QtdeET = 0;
	$ValorT = 0;
	$QtdeT = 0;

	while($Rs = mysql_fetch_assoc($Stmt)){

		$SQL = "select avali_situacao, ";

		$SQL.= "       sum(I.item_qtde) as PAR_RECLAMADO, sum(I.item_valor*I.item_qtde) as VLR_RECLAMADO, a.AVALI_SITUACAO";

		$SQL.= " from rar_lancamento L, PESSOA C, PESSOA F, rar_avaliacao A, rar_item I ";

		$SQL.= " where L.lanca_PESSOA = C.PESSOA ";

		$SQL.= "       and L.lanca_numrar = I.item_numrar ";

		$SQL.= "       and L.lanca_numrar = A.avali_numrar ";

		$SQL.= "       and L.lanca_status <> '4'";

		if ($_SESSION["Menu"] == "3"){

			$SQL.= "    and l.lanca_numrar like 'M%'";

		}else{

			$SQL.= "    and l.lanca_numrar not like 'M%'";

		}

		$SQL.= "       and L.lanca_fabri_ido = F.PESSOA " .$SqlCriterios;

		$SQL.= "       and l.lanca_pessoa in (select usucli_pessoa from rar_usuarioxcliente where usucli_usuar_ido = "  .$_SESSION['sId']. ")";

		$SQL.= "       and date_format(AVALI_AREZ_DATA,'%m/%Y') = '" .$Rs["data"]. "' ";

		$SQL.= " group by avali_situacao ";

		$SQL.= " order by avali_situacao";
		//echo($SQL);
		$Stmt2 = mysql_query($SQL);

		$ValorI= 0;
		$QtdeI= 0;
		$ValorE= 0;
		$QtdeE= 0;
		$ValorP= 0;
		$QtdeP= 0;
		$ValorC= 0;
		$QtdeC= 0;

		while($Rs2 = mysql_fetch_assoc($Stmt2)){

			if ($Rs2["AVALI_SITUACAO"] == "I") {

				$ValorI+= ($Rs2["VLR_RECLAMADO"]);

				$QtdeI+= ($Rs2["PAR_RECLAMADO"]);

				$ValorIT+= ($Rs2["VLR_RECLAMADO"]);

				$QtdeIT+= ($Rs2["PAR_RECLAMADO"]);

			}
			
			if ($Rs2["AVALI_SITUACAO"] == "E") {

				$ValorE+= ($Rs2["VLR_RECLAMADO"]);

				$QtdeE+= ($Rs2["PAR_RECLAMADO"]);

				$ValorET+= ($Rs2["VLR_RECLAMADO"]);

				$QtdeET+= ($Rs2["PAR_RECLAMADO"]);

			}

			if ($Rs2["AVALI_SITUACAO"] == "P") {

				$ValorP+= $Rs2["VLR_RECLAMADO"];

				$QtdeP+= ($Rs2["PAR_RECLAMADO"]);

				$ValorPT+= ($Rs2["VLR_RECLAMADO"]);

				$QtdePT+= ($Rs2["PAR_RECLAMADO"]);

			}
			
			if ($Rs2["AVALI_SITUACAO"] == "C") {

				$ValorC+= $Rs2["VLR_RECLAMADO"];

				$QtdeC+= ($Rs2["PAR_RECLAMADO"]);

				$ValorCT+= ($Rs2["VLR_RECLAMADO"]);

				$QtdeCT+= ($Rs2["PAR_RECLAMADO"]);

			}

		}

		$Qtde = $QtdeP + $QtdeI + $QtdeC + $QtdeE;
		$QtdeT+= $Qtde;
		$Valor = $Rs["VLR_RECLAMADO"];
		$Valor = $ValorP + $ValorI + $ValorC + $ValorE;
		$ValorT+= $Rs["VLR_RECLAMADO"];
		$data = $Rs["data"];

		$PercProcedente = ($Qtde <> 0 ? round(($QtdeP/$Qtde)*100,2) : 0);
		$PercImprocedente = ($Qtde <> 0 ? round(($QtdeI/$Qtde)*100,2) : 0);
		$PercConserto = ($Qtde <> 0 ? round(($QtdeC/$Qtde)*100,2) : 0);
		$PercEmAnalise = ($Qtde <> 0 ? round(($QtdeE/$Qtde)*100,2) : 0);

		

	?>

	  <tr>

		<td class="imp_normal"><?=$data?></td>
		<td class="imp_normal" align="right"><?=number_format($Qtde, 0, ',', '.')?></td>
		<td align="right" class="imp_normal"><?=number_format($Valor,2,',','.')?></td>
		<td class="imp_normal" align="right"><?=number_format($QtdeP, 0, ',', '.')?></td>
		<td align="right" class="imp_normal"><?=number_format($ValorP, 2, ',', '.')?></td>
		<td align="right" class="imp_normal"><?=number_format($PercProcedente, 2, ',', '.')?><div align="center"></div></td>
		<td class="imp_normal" align="right"><?=number_format($QtdeI, 0, ',', '.')?></td>		
		<td align="right" class="imp_normal"><?=number_format($ValorI,2,',','.')?></td>
	    <td align="right" class="imp_normal"><?=number_format($PercImprocedente,2,',','.')?><div align="center"></div></td>
		<td class="imp_normal" align="right"><?=number_format($QtdeC, 0, ',', '.')?></td>		
		<td align="right" class="imp_normal"><?=number_format($ValorC,2,',','.')?></td>
	    <td align="right" class="imp_normal"><?=number_format($PercConserto,2,',','.')?><div align="center"></div></td>
		<td class="imp_normal" align="right"><?=number_format($QtdeE, 0, ',', '.')?></td>		
		<td align="right" class="imp_normal"><?=number_format($ValorE,2,',','.')?></td>
	    <td align="right" class="imp_normal"><?=number_format($PercEmAnalise,2,',','.')?><div align="center"></div></td>

	  </tr>

	  

	<? } 

	

	if ($QtdeT == 0){

		$PercProcedente = round(0*100,2);
		$PercImprocedente = round(0*100,2);
		$PercConserto = round(0*100,2);
		$PercEmAnalise = round(0*100,2);

	}else{
		$PercProcedente = ($QtdeT == 0 ? 0 : round(($QtdePT/$QtdeT)*100,2));
		$PercImprocedente = ($QtdeT == 0 ? 0 : round(($QtdeIT/$QtdeT)*100,2));
		$PercConserto = ($QtdeC == 0 ? 0 : round(($QtdeCT/$QtdeT)*100,2));
		$PercEmAnalise = ($QtdeE == 0 ? 0 : round(($QtdeET/$QtdeT)*100,2));
	}

	

	?>

	<tr>

	    <td class="imp_normal"><strong>Total geral </strong></td>

	    <td class="imp_normal" align="right"><strong><?=number_format($QtdeT,0,',','.')?></strong></td>

	    <td align="right" class="imp_normal"><strong><?=number_format($ValorT,2,',','.')?></strong></td>

	    <td class="imp_normal" align="right"><strong><?=number_format($QtdePT,0,',','.')?></strong></td>

	    <td align="right" class="imp_normal"><strong><?=number_format($ValorPT,2,',','.')?></strong></td>

	    <td align="right" class="imp_normal"><strong><?=number_format($PercProcedente,2,',','.')?></strong></td>

	    <td class="imp_normal" align="right"><strong><?=number_format($QtdeIT,0,',','.')?></strong></td>

	    <td align="right" class="imp_normal"><strong><?=number_format($ValorIT,2,',','.')?></strong></td>

	    <td align="right" class="imp_normal"><strong><?=number_format($PercImprocedente,2,',','.')?></strong></td>
		
		<td class="imp_normal" align="right"><strong><?=number_format($QtdeCT,0,',','.')?></strong></td>

	    <td align="right" class="imp_normal"><strong><?=number_format($ValorCT,2,',','.')?></strong></td>

	    <td align="right" class="imp_normal"><strong><?=number_format($PercConserto,2,',','.')?></strong></td>
		<td class="imp_normal" align="right"><strong><?=number_format($QtdeET,0,',','.')?></strong></td>

	    <td align="right" class="imp_normal"><strong><?=number_format($ValorET,2,',','.')?></strong></td>

	    <td align="right" class="imp_normal"><strong><?=number_format($PercEmAnalise,2,',','.')?></strong></td>

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

