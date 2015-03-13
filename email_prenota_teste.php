<? 	include('inc/conn.inc.php');

	$Sql = "SELECT RAR_PRENF.*, ".
					   " concat(substr(P.cgccpf,1,2),'.',substr(P.cgccpf,3,3),'.',substr(P.cgccpf,6,3),'/',substr(P.cgccpf,9,4), '-',substr(P.cgccpf,13,2)) as CNPJ, ".
					   " concat(substr(PD.cgccpf,1,2),'.',substr(PD.cgccpf,3,3),'.',substr(PD.cgccpf,6,3),'/',substr(PD.cgccpf,9,4), '-',substr(PD.cgccpf,13,2)) as CNPJC, ".
					   " date_format(PRENF_DATA_INFNFDEVOLUCACAO,'%d/%m/%Y') DATANF, ".
					   " PRENF_OBSTRANSPORTADORA, ".
					   " ROUND(PRENF_QTDEVOLUME,0) AS QTDEVOLUME, ".
					   " CONCAT(ROUND(PRENF_ICMS*100,0),'%') AS ICMS, ".
					   " CONCAT(ROUND(PRENF_IPI*100,0),'%') AS IPI, ".
					   " PD.NOME NOMECLIENTE, ".
					   " PD.PESSOA CLIENTE, ".
					   " PRENF_CFOP, ".
					   " PRENF_ICMS, ".
					   " P.NOME, ".
					   " P.IE AS INSCRICAOESTADUAL,".
					   " P.CEP AS CEP,".
					   " P.LOGRADOURO RUA, ".
					   " P.BAIRRO, ".
					   " P.CEP, ".
					   " PD.SUFR_BENF_ICMS SUFRAMA, ".
					   " PD.OPTT_SIMPLES_ESTD SIMPLES, ".
					   " (SELECT ROUND(SUM(PRENFI_QUANTIDADE * PRENFI_VALORUNITARIO),2) + ROUND((SUM(PRENFI_QUANTIDADE * PRENFI_VALORUNITARIO) * PRENF_IPI),2) VALORTOTAL ".
					   "    FROM RAR_PRENF_ITEM ".
					   "   WHERE PRENFI_NUMPRENF = PRENF_NUMPRENF ".
					   "GROUP BY PRENF_PESSOA_EMITENTE) VALORTOTAL, ".
					   " (SELECT ROUND(SUM(PRENFI_QUANTIDADE * PRENFI_VALORUNITARIO),2) BASEICMS ".
					   "    FROM RAR_PRENF_ITEM ".
					   "   WHERE PRENFI_NUMPRENF = PRENF_NUMPRENF ".
					   "GROUP BY PRENF_PESSOA_EMITENTE) BASEICMS, ".
					   " (SELECT ROUND((SUM(PRENFI_QUANTIDADE * PRENFI_VALORUNITARIO) * PRENF_ICMS),2) VALORICMS ".
					   "    FROM RAR_PRENF_ITEM ".
					   "   WHERE PRENFI_NUMPRENF = PRENF_NUMPRENF ".
					   "GROUP BY PRENF_PESSOA_EMITENTE) VALORICMS, ".
					   " (SELECT ROUND((SUM(PRENFI_QUANTIDADE * PRENFI_VALORUNITARIO) * PRENF_IPI),2) VALORIPI ".
					   "    FROM RAR_PRENF_ITEM ".
					   "   WHERE PRENFI_NUMPRENF = PRENF_NUMPRENF ".
					   "GROUP BY PRENF_PESSOA_EMITENTE) VALORIPI, ".
					   " O.DS_OPER, ".
					   " P.NM_MUNICIPIO CIDADE, ".
					   " P.SG_UF UF, PRENF_MOTIVODEVOLUCAO".
				" FROM RAR_PRENF, PESSOA P, PESSOA PD, OPERACAO O".
				" WHERE PRENF_PESSOA_EMITENTE = P.PESSOA ".
				"      AND CD_OPER = PRENF_OPER_IDO".
				"      AND PD.PESSOA = PRENF_PESSOA_DESTINATARIO ".
				"      AND PRENF_NUMPRENF = '" .$_GET['Id']. "'";
	$Stmt = mysql_query($Sql);
	$ID = $_GET["Id"];
	$DESTINO = $_GET["Destino"];
	$Rs = mysql_fetch_assoc($Stmt);
	$PRENF_MOTIVODEVOLUCAO = $Rs["PRENF_MOTIVODEVOLUCAO"];

	//verificar se base de calculo é reduzida
	if ($Rs["PRENF_CATEGORIA"] == "2"){
		if ($Rs["UF"] == "RS" && $Rs["PRENF_CFOP"] == "5.201"){
			$BaseIcms = $Rs["BASEICMS"] * 0.70589;
			$Icms = $BaseIcms * $Rs["PRENF_ICMS"];
		}else{
			$BaseIcms = $Rs["BASEICMS"];
			$Icms = $Rs["VALORICMS"];
		}
	}else{
		$BaseIcms = $Rs["BASEICMS"];
		$Icms = $Rs["VALORICMS"];
	}

	?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
.style1 {font-family: "Trebuchet MS"}
.style2 {font-size: 10px}
.style3 {
	font-family: "Trebuchet MS";
	font-size: 12px;
	font-weight: bold;
	color: #FFFFFF;
}
.style4 {font-size: 11px}
.style5 {
	font-family: "Trebuchet MS";
	font-size: 11px;
	font-weight: bold;
}
.style6 {font-weight: bold}
.style7 {font-weight: bold; font-family: "Trebuchet MS"; }
.style9 {font-size: 11px; font-family: "Trebuchet MS"; }
.style10 {font-size: 12px; color: #FFFFFF; font-family: "Trebuchet MS";}
-->
</style>
</head>

<body>
<table width="100%"  border="0">
  <tr bgcolor="#0873D5">
    <td colspan="2" class="style3">:: Mensagem :: </td>
  </tr>
  <tr>
    <td colspan="2"><span class="style1 style2">
      <?=$_POST["MENSAGEM"]?>
    </span></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr bgcolor="#0873D5">
    <td colspan="2" class="style3">:: Informa&ccedil;&otilde;es a serem repassadas ap&oacute;s a emiss&atilde;o da nota fiscal :: </td>
  </tr>
  <tr>
    <td bgcolor="#f5f5f5" class="style5">N.&ordm; NF </td>
    <td class="style4">____________</td>
  </tr>
  <tr>
    <td bgcolor="#f5f5f5" class="style5">S&eacute;rie NF </td>
    <td class="style4">____________</td>
  </tr>
  <tr>
    <td bgcolor="#f5f5f5" class="style5">Data NF </td>
    <td class="style4">___/____/______</td>
  </tr>
  <tr>
    <td bgcolor="#f5f5f5" class="style5">Qtde Volumes </td>
    <td class="style4">____________</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr bgcolor="#0873D5">
    <td colspan="2"><span class="style3">&nbsp;:: Dados da NF de devolu&ccedil;&atilde;o :: </span></td>
  </tr>
  <tr>
    <td width="20%"><span class="style1"></span></td>
    <td width="80%"><span class="style1"></span></td>
  </tr>
  <tr>
    <td bgcolor="#f5f5f5"><span class="style1 style4"><strong>CFOP</strong></span></td>
    <td><span class="style1 style2"><?=$Rs["PRENF_CFOP"].' - '.$Rs["DS_OPER"]?></span></td>
  </tr>
  <tr>
    <td bgcolor="#f5f5f5" class="style2"><span class="style5">Destinat&aacute;rio</span></td>
    <td><span class="style1 style2"><?=$Rs["NOME"]?></span></td>
  </tr>
  <tr>
    <td bgcolor="#f5f5f5" class="style2"><span class="style5">Endere&ccedil;o</span></td>
    <td><span class="style1 style2"><?=$Rs["RUA"]." - Bairro: ".$Rs["BAIRRO"]?></span></td>
  </tr>
  <tr>
    <td bgcolor="#f5f5f5" class="style2"><span class="style5">Cidade</span></td>
    <td><span class="style1 style2"><?=$Rs["CIDADE"]." - UF: ".$Rs["UF"]." - CEP: ".$Rs["CEP"]?></span></td>
  </tr>
  <tr>
    <td bgcolor="#f5f5f5" class="style2"><span class="style5">CNPJ</span></td>
    <td><span class="style1 style2"><?=$Rs["CNPJ"]?></span></td>
  </tr>
  <tr>
    <td bgcolor="#f5f5f5"><div align="right" class="style1 style4">
      <div align="left"><strong>Inscri&ccedil;&atilde;o estadual</strong></div>
    </div></td>
    <td><span class="style1 style2"><?=$Rs["INSCRICAOESTADUAL"]?></span></td>
  </tr>
  <tr>
    <td><span class="style1"></span></td>
    <td><span class="style1"></span></td>
  </tr>
  <tr bgcolor="#0873D5">
    <td colspan="2"><span class="style1"></span><span class="style3"><strong>&nbsp;:: Listagens dos produtos da pr&eacute;-nota :: </strong></span></td>
  </tr>
  <tr>
    <td colspan="2"><table width="100%"  border="0" align="center">
      <tr bgcolor="#FFFF99" class="style5" >
        <td width="17%" ><div align="center">Refer&ecirc;ncia</div></td>
        <td width="16%" ><div align="left">Descri&ccedil;&atilde;o</div></td>
        <td width="19%" ><div align="center">N&ordm; RAR - NF/S&eacute;rie Origem</div></td>
        <td width="11%" ><div align="center">Class. fiscal</div></td>
        <td width="6%" ><div align="center">U.M.</div></td>
        <td width="6%" ><div align="center">Qtde</div></td>
        <td width="9%" ><div align="center">Valor Unit.</div></td>
        <td width="7%" ><div align="center">Valor Total</div></td>
        <td width="5%" ><div align="center">% ICMS </div></td>
        <td width="4%" ><div align="center">% IPI </div></td>
      </tr>
      <?
	$Sql = "SELECT PRENFI_IDO, PRENFI_CLASSIFICACAOFISCAL, ".
	             " concat(substring(PRENFI_REFERENCIA,1,4),'-',substring(PRENFI_REFERENCIA,5,4),'-',substring(PRENFI_REFERENCIA,9,4),'-',substring(PRENFI_REFERENCIA,13,4)) PRENFI_REFERENCIA, ".
				 " PRENFI_UNIDADE, ".
				 " ROUND(PRENFI_QUANTIDADE,0) AS PRENFI_QUANTIDADE,  ".
				 " ROUND(PRENFI_VALORUNITARIO,2) VALOR_UNITARIO,  ".
				 " DS_RESUMIDA_ITEM DESCRICAO, ".
				 //" ROUND((PRENFI_QUANTIDADE * PRENFI_VALORUNITARIO) * PRENF_IPI,2) + ROUND((PRENFI_QUANTIDADE * PRENFI_VALORUNITARIO),2) VALOR".
				 " ROUND((PRENFI_QUANTIDADE * PRENFI_VALORUNITARIO),2) VALOR".
		    " FROM RAR_PRENF_ITEM, ITEM_MATERIAL, RAR_PRENF ".
			"WHERE PRENFI_NUMPRENF = '" .$_GET['Id']. "'".
			"      AND PRENFI_REFERENCIA = CD_ITEM_MATERIAL ".
			"      AND PRENFI_NUMPRENF = PRENF_NUMPRENF".
			" ORDER BY PRENFI_IDO";
	$Stmt2 = mysql_query($Sql);
	//die($Sql);
	while ($RsI = mysql_fetch_assoc($Stmt2)) { ?>
      <tr valign="top" bordercolor="#00CCFF" class="style2">
        <td><div align="center" class="style1">
            <?=$RsI["PRENFI_REFERENCIA"]?>
        </div></td>
        <td><span class="style1">
          <?=$RsI["DESCRICAO"]?>
        </span></td>
        <?
			$Sql = "SELECT lanca_numrar, item_serie, item_nf FROM rar_lancamento, rar_item ";
			$Sql.= " WHERE lanca_numrar = item_numrar and lanca_prenfi_ido='".$RsI["PRENFI_IDO"]."'";
			$Stmt3 = mysql_query($Sql);
			$NUMRARS = "";
			while ($RsR = mysql_fetch_assoc($Stmt3))
			 	$NUMRARS.= $RsR["lanca_numrar"]." - ".$RsR["item_nf"]."/".$RsR["item_serie"]."<BR>";
			$NUMRARS = substr($NUMRARS,0,strlen($NUMRARS)-4);
			?>
        <td><div align="center" class="style1">
            <?=$NUMRARS?>
        </div></td>
        <td width="11%"><div align="center" class="style1">
            <?=$RsI["PRENFI_CLASSIFICACAOFISCAL"]?>
        </div></td>
        <td width="6%"><div align="center" class="style1">
            <?=$RsI["PRENFI_UNIDADE"]?>
        </div></td>
        <td width="6%"><div align="right" class="style1">
            <?=$RsI["PRENFI_QUANTIDADE"]?>
        </div></td>
        <td width="9%"><div align="right" class="style1">
            <?=formatCurrency($RsI["VALOR_UNITARIO"])?>
        </div></td>
        <td width="7%" align="right"><span class="style1">
          <?=formatCurrency($RsI["VALOR"])?>
        </span></td>
        <td width="5%" align="center"><span class="style1">
          <?=$Rs["ICMS"]?>
        </span></td>
        <td width="4%" align="center"><span class="style1">
          <?=$Rs["IPI"]?>
        </span></td>
      </tr>
      <? } ?>
    </table></td>
  </tr>
  <tr>
    <td colspan="2"><table width="100%"  border="0" align="center">
      <tr class="style5">
        <td width="20%" bgcolor="#FFFF99" >
          <div align="right" class="style6">Base c&aacute;lculo ICMS </div></td>
        <td width="10%" class="style2" ><div align="left" class="style1"><span class="style6">
            <?=formatCurrency($BaseIcms)?>
        </span></div></td>
        <td width="25%" bgcolor="#FFFF99" a href="cad_defeitos.htm"><div align="right"><strong>Valor do ICMS</strong></div></td>
        <td width="11%" class="style2" a href="cad_defeitos.htm"><div align="left" class="style1"><strong>
            <?=formatCurrency($Icms)?>
                </strong></div></td>
        <td width="30%" bgcolor="#FFFF99" a href="cad_defeitos.htm"><div align="right"><strong>Valor total dos produtos</strong></div></td>
        <td width="11%" class="style2" a href="cad_defeitos.htm"><div align="left" class="style1"><strong>
            <?=formatCurrency($Rs["BASEICMS"])?>
                </strong></div></td>
      </tr>
      <?
		   if ($Rs["SUFRAMA"] == "S"){
				$Sql = "SELECT distinct aliq_icms";
				$Sql.= " FROM rar_lancamento l, rar_prenf_item i, item_nota_fiscal, rar_item";
				$Sql.= " WHERE l.lanca_numrar = item_numrar ";
				$Sql.= "       AND num_nf = item_nf ";
				$Sql.= "       AND prenfi_ido = lanca_prenfi_ido";
				$Sql.= "       AND serie_nf = item_serie ";
				$Sql.= "       AND cd_item_material = item_referencia ";
				$Sql.= "       AND prenfi_numprenf = '" .$_GET['Id']. "'";
				$Stmt = mysql_query($Sql);
				$RsIcms = mysql_fetch_assoc($Stmt);
				$ValorTotal = round($Rs["VALORTOTAL"] * (1-$RsIcms["aliq_icms"]),2) + $Rs["VALORIPI"];
				//echo(round($ValorTotal,2));
			}else{
				$ValorTotal = $Rs["VALORTOTAL"];
			}
			//$ValorTotal = $Rs["VALORIPI"] + $ValorTotal;
			$ValorTotal = str_replace(".",",",$ValorTotal);
			//echo($ValorTotal);
			//$ValorTotal = number_format($ValorTotal, 2, ',', '');

		   ?>
      <tr class="style5">
        <td >&nbsp;</td>
        <td class="style2 style1" >&nbsp;</td>
        <td bgcolor="#FFFF99" class="style6"><div align="right">Valor do IPI</div></td>
        <td class="style2"><span class="style7"><?=formatCurrency($Rs["VALORIPI"])?></span></td>
        <td bgcolor="#FFFF99"><div align="right" class="style6">Valor total da NF</div></td>
        <td class="style2"><div align="left" class="style1"><strong>
          <?=$ValorTotal?>
        </strong></div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><?
		 if ($Rs["SIMPLES"] == "S"){

		 	$sql = " SELECT sum( (item_valor * item_qtde) * it.aliq_icms ) AS valor";
			$sql.= " FROM rar_prenf_item p, rar_lancamento l, rar_item i, item_nota_fiscal it ";
			$sql.= " WHERE PRENFI_NUMPRENF = '" .$_GET['Id']. "'";
			$sql.= " AND l.lanca_prenfi_ido = prenfi_ido ";
			$sql.= " AND i.item_numrar = l.lanca_numrar ";
			$sql.= " AND it.num_nf = i.item_nf ";
			$sql.= " AND it.serie_nf = i.item_serie ";
			$sql.= " AND it.cd_item_material = item_referencia ";
			$Stmt = mysql_query($sql);
			$Rs = mysql_fetch_assoc($Stmt);
			$Icms = $Rs["valor"];

		 ?>
      <table width="100%"  border="0" align="center" class="listagem_procedente">
        <tr>
          <td width="100%" bgcolor="#FF0000"><div align="center">
              <p class="style10">Caro franqueado, por sua empresa estar enquadrada como ME/EPP, favor inserir nos “Dados Adicionais”<br>
          da nota fiscal a base de c&aacute;lculo e o valor de ICMS, conforme segue abaixo:<br>
          Base de C&aacute;lculo: R$
          <?=formatCurrency($BaseIcms)?>
          <br>
          Valor do ICMS: R$
          <?=formatCurrency($Icms)?>
          <br>
          <br>
          Obrigado!</p>
          </div></td>
        </tr>
      </table>
    <?
		   }
		   ?>
    <?
		 if ($Rs["SUFRAMA"] == "S"){
		 ?>
    <table width="100%"  border="0" align="center">
      <tr>
        <td width="107%" class="tabela"><div align="center" class="style9">Mencionar o texto abaixo no campo de observa&ccedil;&otilde;es da nota fiscal:<br>
        Desconto referente ao ICMS (Zona Franca):
            <?=$RsIcms["aliq_icms"]*100?>
            %</div></td>
      </tr>
    </table>
    <?
		   }
		   ?></td>
  </tr>
</table>
</body>
</html>
