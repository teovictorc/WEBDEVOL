<? $Title = "Índice de Devolução x Fábrica";

	include("inc/top_imp.inc.php"); 



	$SQL = " SELECT distinct P.NOME F_NOME";//, P.PESSOA F_CODIGO"; //, 0 QTDE";

	$SQL.= " FROM   produtos_recebidos pr, pessoa p";

	$SQL.= " WHERE  pr.pessoa_emitente = p.pessoa " . $SqlCriteriosData;

	if ($_POST['LANCA_CATEGORIA'] == "1"){

		$SQL.= "    and UNIDADE_MEDIDA = 'PAR'";

	}elseif ($_POST['LANCA_CATEGORIA'] == "2,3,4"){

		$SQL.= "    and UNIDADE_MEDIDA = 'PC'";

	}

	$SQL.= " union ";

	$SQL.= " select distinct F.NOME F_NOME";//, F.PESSOA F_CODIGO";//, sum(ITEM_QTDE) QTDE";

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

	$SQL.= "       and L.lanca_fabri_ido = F.PESSOA " .$SqlCriterios;

	$SQL.= "       and l.lanca_pessoa in (select usucli_pessoa from rar_usuarioxcliente where usucli_usuar_ido = "  .$_SESSION['sId']. ")";

	$SQL.= " group by F.NOME";//, F.PESSOA ";

	$SQL.= " order by f_nome";

	//die($SQL);

	$Stmt = mysql_query($SQL);

?>

<table width="100%" border="0" cellpadding="0" cellspacing="1">

  <tr>

    <td width="50%" class="imp_normal_total"><div align="left"><strong> Fabricante</strong></div></td>

    <td width="10%" class="imp_normal_total"><div align="center"><strong><?=$UnidadeMedida?> Recebidos </strong></div></td>

    <td width="10%" class="imp_normal_total"><div align="center"><strong>Devolu&ccedil;&atilde;o Bruta </strong></div></td>

    <td width="10%" class="imp_normal_total"><div align="center"><strong>Procedente</strong></div></td>

    <td width="10%" class="imp_normal_total"><div align="center"><strong>Improcedente</strong></div></td>

    <td width="10%" class="imp_normal_total"><div align="center"><strong>% Procedente x <?=$UnidadeMedida?> recebidos </strong></div></td>

  </tr>

<?  

	$QtdeIT = 0;

	$QtdePT = 0;

	$QtdeFT = 0;

	$QtdeBT = 0;

	

	$Sql = "delete from rar_relatorio where usuar_ido = '".$_SESSION['sId']."'";

	//echo($Sql);

	$Rel = mysql_query($Sql);

	

	while($Rs = mysql_fetch_assoc($Stmt)){

	

		//Incluido em 16/11/2005

		$f_nome = str_replace("'","''",$Rs["F_NOME"]);

		

		$SQL = "SELECT sum(tl_item) tl_item";

		$SQL.= " FROM   produtos_recebidos, pessoa";

		$SQL.= " WHERE  1 = 1 " . $SqlCriteriosData;

		$SQL.= "        and PESSOA_EMITENTE = PESSOA AND NOME = '".$f_nome."'";

		if ($_POST['LANCA_CATEGORIA'] == "1"){

			$SQL.= "    and UNIDADE_MEDIDA = 'PAR'";

		}elseif ($_POST['LANCA_CATEGORIA'] == "2,3,4"){

			$SQL.= "    and UNIDADE_MEDIDA = 'PC'";

		}

		//die($SQL);

		$StmtFat = mysql_query($SQL);

		$QtdeF = 0;

		if ($RsFat = mysql_fetch_assoc($StmtFat)){

			$QtdeF = $RsFat["tl_item"];

		}

		

		if ($QtdeF == ""){

			$QtdeF = 0;

		}

		

		$QtdeI = 0;

		$QtdeP = 0;	

		

		$QtdeB = 0;

		$SQL = "select L.LANCA_FABRI_IDO, F.NOME F_NOME,";

		$SQL.= " sum(I.item_qtde) as PAR_RECLAMADO, A.AVALI_SITUACAO";

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

		$SQL.= "       and L.lanca_fabri_ido = F.PESSOA " .$SqlCriterios;

		$SQL.= "       and F.NOME = '" .$f_nome. "' ";

		$SQL.= "       and L.lanca_pessoa in (select usucli_pessoa from rar_usuarioxcliente where usucli_usuar_ido = "  .$_SESSION['sId']. ")";

		$SQL.= " group by A.avali_situacao, ";

		$SQL.= "       L.LANCA_FABRI_IDO, F.NOME ";

		$SQL.= " order by f_nome";

		//die($SQL);

		$Stmt2 = mysql_query($SQL);

		while($Rs2 = mysql_fetch_assoc($Stmt2)){



			if ($Rs2["AVALI_SITUACAO"] == "I") {

				$QtdeI+= floatval($Rs2["PAR_RECLAMADO"]);

				$QtdeIT+= floatval($Rs2["PAR_RECLAMADO"]);

				$QtdeBT+= floatval($Rs2["PAR_RECLAMADO"]);

				$QtdeB+= floatval($Rs2["PAR_RECLAMADO"]);

			}

			if ($Rs2["AVALI_SITUACAO"] == "P") {

				$QtdeP+= floatval($Rs2["PAR_RECLAMADO"]);

				$QtdePT+= floatval($Rs2["PAR_RECLAMADO"]);

				$QtdeBT+= floatval($Rs2["PAR_RECLAMADO"]);

				$QtdeB+= floatval($Rs2["PAR_RECLAMADO"]);

			}

		}

		$Qtde = $Rs["PAR_RECLAMADO"];

		$QtdeT+= $Rs["PAR_RECLAMADO"];

		//$Fabrica = $Rs["F_CODIGO"] ." - ". $Rs["F_NOME"];

		$Fabrica = $Rs["F_NOME"];

		$QtdeFT+= floatval($QtdeF);

		

		$Sql = "insert into rar_relatorio (texto1, num1, num2, num3, num4, num5, usuar_ido) ";

		$Sql.= " values (";

		$Sql.= " '".str_replace("'","''",$Fabrica)."',";

		$Sql.= $QtdeF.",";

		$Sql.= $QtdeB.",";

		$Sql.= $QtdeP.",";

		$Sql.= $QtdeI.",";

		if ($QtdeF == 0){

			$Perc = 0;

		}else{

			$Perc = $QtdeP/$QtdeF;

		}

		$Sql.= round($Perc,5).",";

		$Sql.= " '".$_SESSION['sId']."')";

		$Rel = mysql_query($Sql);

		

	} 

	

	$SQL = " SELECT * from rar_relatorio ";

	$SQL.= " where usuar_ido = '".$_SESSION['sId']."'";

	if ($_POST["ORDEM"] == "A"){

		$SQL.= " order by texto1";

	}else{

		$SQL.= " order by num5 desc, texto1";

	}

	//die($SQL);

	$Stmt = mysql_query($SQL);

	$Num1T = 0;

	$Num2T = 0;

	$Num3T = 0;

	$Num4T = 0;

	while($Rs = mysql_fetch_assoc($Stmt)){

		$Num1T+= floatval($Rs["num1"]);

		$Num2T+= floatval($Rs["num2"]);

		$Num3T+= floatval($Rs["num3"]);

		$Num4T+= floatval($Rs["num4"]);

		

		if ($Rs["num1"] == 0) {

			$Perc = 0;

		}else{

			$Perc = $Rs["num3"]/$Rs["num1"];

		}

		

		?>

		<tr>

		<td class="imp_normal"><?=$Rs["texto1"]?></td>

		<td class="imp_normal"><div align="right"><?=number_format($Rs["num1"], 0, ',', '.')?></div></td>

		<td class="imp_normal"><div align="right"><?=number_format($Rs["num2"], 0, ',', '.')?></div></td>

		<td class="imp_normal"><div align="right"><?=number_format($Rs["num3"], 0, ',', '.')?></div></td>

		<td class="imp_normal"><div align="right"><?=number_format($Rs["num4"], 0, ',', '.')?></div></td>

		<td class="imp_normal"><div align="right"><?=round($Perc * 100,2)?> %</div></td>

		</tr>

	<? 

	} 

	

	?>

    <tr>

    <td class="imp_normal_bot" colspan="6">&nbsp;</td>

  </tr>

  <tr>

    <td class="imp_normal"><div align="right"><strong>Total:</strong></div></td>

    <td class="imp_normal"><div align="right"><strong><?=number_format($Num1T, 0, ',', '.')?></strong></div></td>

    <td class="imp_normal"><div align="right"><strong><?=number_format($Num2T, 0, ',', '.')?></strong></div></td>

    <td class="imp_normal"><div align="right"><strong><?=number_format($Num3T, 0, ',', '.')?></strong></div></td>

    <td class="imp_normal"><div align="right"><strong><?=number_format($Num4T, 0, ',', '.')?></strong></div></td>

    <td class="imp_normal"><div align="right"><strong><?=(($Num3T != 0 && $Num1T != 0) ? round(($Num3T/$Num1T) * 100,2) : "0")?> %</strong></div></td>

  </tr>

  <tr>

    <td class="imp_normal">&nbsp;</td>

    <td class="imp_normal">&nbsp;</td>

    <td class="imp_normal">&nbsp;</td>

    <td class="imp_normal">&nbsp;</td>

    <td class="imp_normal">&nbsp;</td>

    <td class="imp_normal">&nbsp;</td>

  </tr>

  <tr>

    <td colspan="6" class="imp_normal"><div align="center"><a href="javascript: window.print();"><img src="imagens/imprimir.jpg" alt="Clique aqui para fechar este relat&oacute;rio" width="52" height="22" border="0" ></a>&nbsp;<a href="javascript: window.close()"><img src="imagens/fechar.jpg" alt="Clique aqui para fechar esta janela" width="52" height="22" border="0" ></a></div></td>

  </tr>

</table>

<? 	include("inc/bot_imp.inc.php"); ?>

