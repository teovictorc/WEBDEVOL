<? $Title = "Índice Geral";

	include("inc/top_imp.inc.php"); 



		$SQL = "select substr(C.NOME,1,35) C_NOME, C.PESSOA C_CODIGO, L.LANCA_FABRI_IDO, substr(F.NOME,1,30) F_NOME,";

		$SQL.= " sum(I.item_qtde) as PAR_RECLAMADO, round(sum(I.item_valor*I.item_qtde),2) as VLR_RECLAMADO";

		$SQL.= " from rar_lancamento L, PESSOA C, PESSOA F, rar_avaliacao A, rar_item I ";

		$SQL.= " where L.lanca_PESSOA = C.PESSOA ";

		$SQL.= "       and L.lanca_numrar = I.item_numrar ";

		$SQL.= "       and L.lanca_numrar = A.avali_numrar ";

		$SQL.= "       and L.lanca_status <> '4'";

		$SQL.= "       and L.lanca_fabri_ido = F.PESSOA " .$SqlCriterios;

		$SQL.= "       and l.lanca_pessoa in (select usucli_pessoa from rar_usuarioxcliente where usucli_usuar_ido = "  .$_SESSION['sId']. ")";

		$SQL.= " group by C.PESSOA, L.LANCA_PESSOA, C.NOME, ";

		$SQL.= "       L.LANCA_FABRI_IDO, F.NOME ";

		$SQL.= " order by c_nome, c_codigo, f_nome";

		$Stmt = mysql_query($SQL);

		//die($SQL);

?>

<table width="100%" border="0" cellpadding="0" cellspacing="1">

  <tr>

    <td width="5%">&nbsp;</td>

    <td width="26%">&nbsp;</td>

    <td width="21%">&nbsp;</td>

    <td colspan="2" class="imp_normal_total"><div align="center"><strong>Reclamado</strong></div></td>

    <td colspan="2" class="imp_normal_total"><div align="center"><strong>Procedente</strong></div></td>

    <td colspan="2" class="imp_normal_total"><div align="center"><strong>Improcedente</strong></div></td>

  </tr>

  <tr>

    <td class="imp_normal_total"><div align="left"><strong>C&oacute;digo</strong></div></td>

    <td class="imp_normal_total"><div align="left"><strong>Nome da loja </strong></div></td>

    <td class="imp_normal_total"><div align="left"><strong>F&aacute;brica</strong></div></td>

    <td width="8%" class="imp_normal_total"><div align="center"><strong>Pares</strong></div></td>

    <td width="8%" class="imp_normal_total"><div align="center"><strong>Valores</strong></div></td>

    <td width="8%" class="imp_normal_total"><div align="center"><strong>Pares</strong></div></td>

    <td width="8%" class="imp_normal_total"><div align="center"><strong>Valores</strong></div></td>

    <td width="8%" class="imp_normal_total"><div align="center"><strong>Pares</strong></div></td>

    <td width="8%" class="imp_normal_total"><div align="center"><strong>Valores</strong></div></td>

  </tr>

<?  

	$ValorIT = 0;

	$QtdeIT = 0;

	$ValorPT = 0;

	$QtdePT = 0;

	$ValorT = 0;

	$QtdeT = 0;

	while($Rs = mysql_fetch_assoc($Stmt)){

		$SQL = "select C.NOME C_NOME, C.PESSOA C_CODIGO, L.LANCA_FABRI_IDO, F.NOME F_NOME,";

		$SQL.= " sum(I.item_qtde) as PAR_RECLAMADO, round(sum(I.item_valor*I.item_qtde),2) as VLR_RECLAMADO, a.AVALI_SITUACAO";

		$SQL.= " from rar_lancamento L, PESSOA C, PESSOA F, rar_avaliacao A, rar_item I ";

		$SQL.= " where L.lanca_PESSOA = C.PESSOA ";

		$SQL.= "       and L.lanca_numrar = I.item_numrar ";

		$SQL.= "       and L.lanca_numrar = A.avali_numrar ";

		$SQL.= "       and L.lanca_status <> '4'";

		$SQL.= "       and L.lanca_fabri_ido = F.PESSOA " .$SqlCriterios;

		$SQL.= "       and C.PESSOA = '" .$Rs["C_CODIGO"]. "' ";

		$SQL.= "       and L.LANCA_FABRI_IDO = '" .$Rs["LANCA_FABRI_IDO"]."' ";

		$SQL.= " group by C.PESSOA, L.LANCA_PESSOA, C.NOME, ";

		$SQL.= "       L.LANCA_FABRI_IDO, F.NOME, a.AVALI_SITUACAO ";

		$SQL.= " order by c_nome, c_codigo, f_nome";

		$Stmt2 = mysql_query($SQL);

		$ValorI= 0;

		$QtdeI= 0;

		$ValorP= 0;

		$QtdeP= 0;

		while($Rs2 = mysql_fetch_assoc($Stmt2)){

			if ($Rs2["AVALI_SITUACAO"] == "I") {

				$ValorI+= floatval($Rs2["VLR_RECLAMADO"]);

				$QtdeI+= floatval($Rs2["PAR_RECLAMADO"]);

				$ValorIT+= floatval($Rs2["VLR_RECLAMADO"]);

				$QtdeIT+= floatval($Rs2["PAR_RECLAMADO"]);

			}

			if ($Rs2["AVALI_SITUACAO"] == "P") {

				$ValorP+= floatval($Rs2["VLR_RECLAMADO"]);

				$QtdeP+= floatval($Rs2["PAR_RECLAMADO"]);

				$ValorPT+= floatval($Rs2["VLR_RECLAMADO"]);

				$QtdePT+= floatval($Rs2["PAR_RECLAMADO"]);

			}

		}

		$Qtde = $Rs["PAR_RECLAMADO"];

		$QtdeT+= $Rs["PAR_RECLAMADO"];

		$Valor = $Rs["VLR_RECLAMADO"];

		$ValorT+= $Rs["VLR_RECLAMADO"];

		$Cliente = $Rs["C_NOME"];

		$Fabrica = $Rs["F_NOME"];

		$codCliente = $Rs["C_CODIGO"];

		$Fabrica = $Rs["F_NOME"];

		

	?>

	  <tr>

		<td class="imp_normal"><?=$codCliente?></td>

		<td class="imp_normal"><?=$Cliente?></td>

		<td class="imp_normal"><?=$Fabrica?></td>

		<td class="imp_normal" align="right"><?=$Qtde?></td>

		<td class="imp_normal" align="right"><?=formatCurrencyPrint($Valor)?></td>

		<td class="imp_normal" align="right"><?=$QtdeP?></td>

		<td class="imp_normal" align="right"><?=formatCurrencyPrint($ValorP)?></td>

		<td class="imp_normal" align="right"><?=$QtdeI?></td>		

		<td class="imp_normal" align="right"><?=formatCurrencyPrint($ValorI)?></td>

	  </tr>

	<? } ?>

</table>

<table width="100%" border="0" cellpadding="0" cellspacing="0">

  <tr>

    <td colspan="3" class="imp_normal">&nbsp;</td>

  </tr>

  <tr>

    <td colspan="3" class="imp_normal_total"><strong>Total geral </strong></td>

  </tr>

  <tr>

    <td width="17%" class="imp_normal">Pares reclamados: <strong><?=$QtdeT?></strong></td>

    <td><span class="imp_normal">Pares procedentes: <strong><?=$QtdePT?></strong></span></td>

    <td><span class="imp_normal">Pares improcedentes: <strong><?=$QtdeIT?></strong></span></td>

  </tr>

  

  <?

  //setlocale(LC_MONETARY, 'pt_BR');

  ?>

  <tr>

    <td class="imp_normal">Valor reclamado: <strong><?=money_format('%.2n',$ValorT)?></strong></td>

    <td width="33%"><span class="imp_normal">Valor procedente: <strong><?=money_format('%.2n',$ValorPT)?></strong></span></td>

    <td width="37%"><span class="imp_normal">Valor improcedente: <strong><?=money_format('%.2n',$ValorIT)?></strong></span></td>

  </tr>

  <tr>

    <td class="imp_normal">&nbsp;</td>

    <td>&nbsp;</td>

    <td>&nbsp;</td>

  </tr>

  <tr>

    <td colspan="3" class="imp_normal"><div align="center"><a href="javascript: window.print();"><img src="imagens/imprimir.jpg" alt="Clique aqui para fechar este relat&oacute;rio" width="52" height="22" border="0" ></a>&nbsp;<a href="javascript: window.close()"><img src="imagens/fechar.jpg" alt="Clique aqui para fechar esta janela" width="52" height="22" border="0" ></a></div></td>

  </tr>

</table>

<? 	include("inc/bot_imp.inc.php"); ?>

