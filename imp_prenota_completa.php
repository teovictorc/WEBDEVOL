<? include("inc/conn_externa.inc.php"); 

	if (trim($_GET['Id'])) {
			$Sql = "SELECT RAR_CLIENTE_COLETA.*, RAR_PRENF.*, ".
							" date_format(PRENF_DATA_INFNFDEVOLUCACAO,'%d/%m/%Y') DATANF, ".
							" concat(substr(P.cgccpf,1,2),'.',substr(P.cgccpf,3,3),'.',substr(P.cgccpf,6,3),'/',substr(P.cgccpf,9,4), '-',substr(P.cgccpf,13,2)) as CNPJ, ".
							" date_format(CLIEN_COL_HRINI,'%H:%i') As HRINI, ".
		                    " date_format(CLIEN_COL_HRFIM,'%H:%i') As HRFIM, ".
							" PRENF_OBSTRANSPORTADORA, ".
							" P.IE AS INSCRICAOESTADUAL,".
							" PD.NOME NOMECLIENTE,  ".
							" concat(substr(PD.cgccpf,1,2),'.',substr(PD.cgccpf,3,3),'.',substr(PD.cgccpf,6,3),'/',substr(PD.cgccpf,9,4), '-',substr(PD.cgccpf,13,2)) as CNPJCLIENTE, ".
							" CONCAT(ROUND(PRENF_ICMS*100,0),'%') AS ICMS, ".
							" CONCAT(ROUND(PRENF_IPI*100,0),'%') AS IPI, ".
							" PD.PESSOA CLIENTE,  ".
							" PRENF_CFOP,  ".
							" P.NOME,  ".
							" P.LOGRADOURO RUA, ".
							" P.BAIRRO,  ".
							" P.SG_UF,  ".
							" P.CEP, ".
							" PD.SUFR_BENF_ICMS SUFRAMA, ". 
							" ROUND(PRENF_QTDEVOLUME,0) AS QTDEVOLUME, ".
							" PD.OPTT_SIMPLES_ESTD SIMPLES, ".
							" P.IE AS INSCRICAOESTADUAL,".
							" (SELECT ROUND(SUM(PRENFI_QUANTIDADE * PRENFI_VALORUNITARIO),2) + ROUND((SUM(PRENFI_QUANTIDADE * PRENFI_VALORUNITARIO) * PRENF_IPI),2) VALORTOTAL ".
						   "    FROM RAR_PRENF_ITEM ".
					       "   WHERE PRENFI_NUMPRENF = PRENF_NUMPRENF ".
						   "GROUP BY PRENF_PESSOA_EMITENTE) VALORTOTAL, ".
						   " (SELECT ROUND(SUM(PRENFI_QUANTIDADE * PRENFI_VALORUNITARIO),2) BASEICMS ".
						   "    FROM RAR_PRENF_ITEM ".
					       "   WHERE PRENFI_NUMPRENF = PRENF_NUMPRENF ".
						   "GROUP BY PRENF_PESSOA_EMITENTE) BASEICMS, ".
							" (SELECT SUM(PRENFI_QUANTIDADE) QTDETOTAL  ".
							"    FROM RAR_PRENF_ITEM ".
							"	WHERE PRENFI_NUMPRENF = PRENF_NUMPRENF  ".
							"GROUP BY PRENF_PESSOA_EMITENTE) QTDETOTAL, ".
							" (SELECT round((SUM(PRENFI_QUANTIDADE * PRENFI_VALORUNITARIO) * PRENF_ICMS),2) VALORICMS  ".
							"    FROM RAR_PRENF_ITEM ".
							"   WHERE PRENFI_NUMPRENF = PRENF_NUMPRENF  ".
							"GROUP BY PRENF_PESSOA_EMITENTE) VALORICMS, ".
							" (SELECT round((SUM(PRENFI_QUANTIDADE * PRENFI_VALORUNITARIO) * PRENF_IPI),2) VALORIPI  ".
							"    FROM RAR_PRENF_ITEM ".
							"   WHERE PRENFI_NUMPRENF = PRENF_NUMPRENF  ".
							"GROUP BY PRENF_PESSOA_EMITENTE) VALORIPI, ".
							" P.NM_MUNICIPIO CIDADE,  ".
							" O.DS_OPER,  ".
							" P.SG_UF UF  ".
				    " FROM RAR_PRENF, PESSOA P, PESSOA PD, RAR_CLIENTE_COLETA, OPERACAO O ".
					" WHERE PRENF_PESSOA_EMITENTE = P.PESSOA  ".
					        " AND PD.PESSOA = PRENF_PESSOA_DESTINATARIO  ".
							" AND O.CD_OPER = PRENF_OPER_IDO ".
							" AND PD.PESSOA = CLIEN_COL_PESSOA ".
					        " AND PRENF_NUMPRENF = '" .$_GET['Id']. "'";
		//die($Sql);
		$Stmt = mysql_query($Sql);
		$ID = $_GET["Id"];
		$Rs = mysql_fetch_assoc($Stmt);
		
		$Peso = round($Rs["QTDETOTAL"]*0.750,3);
		$Peso = $Peso." Kg";
		
		if ($Rs["CLIEN_COL_DIAINI"] == "D") {
			$DIAINI = "DOMINGO";
		}
		
		if ($Rs["CLIEN_COL_DIAINI"] == "S") {
			$DIAINI = "SEGUNDA-FEIRA";
		}
		
		if ($Rs["CLIEN_COL_DIAINI"] == "T") {
			$DIAINI = "TERÇA-FEIRA";
		}
		if ($Rs["CLIEN_COL_DIAINI"] == "Q") {
			$DIAINI = "QUARTA-FEIRA";
		}
		if ($Rs["CLIEN_COL_DIAINI"] == "I") {
			$DIAINI = "QUINTA-FEIRA";
		}
		if ($Rs["CLIEN_COL_DIAINI"] == "X") {
			$DIAINI = "SEXTA-FEIRA";
		}
		if ($Rs["CLIEN_COL_DIAINI"] == "B") {
			$DIAINI = "SÁBADO";
		}
		
		if ($Rs["CLIEN_COL_DIAFIM"] == "D") {
			$DIAFIM = "DOMINGO";
		}
		
		if ($Rs["CLIEN_COL_DIAFIM"] == "S") {
			$DIAFIM = "SEGUNDA-FEIRA";
		}
		
		if ($Rs["CLIEN_COL_DIAFIM"] == "T") {
			$DIAFIM = "TERÇA-FEIRA";
		}
		if ($Rs["CLIEN_COL_DIAFIM"] == "Q") {
			$DIAFIM = "QUARTA-FEIRA";
		}
		if ($Rs["CLIEN_COL_DIAFIM"] == "I") {
			$DIAFIM = "QUINTA-FEIRA";
		}
		if ($Rs["CLIEN_COL_DIAFIM"] == "X") {
			$DIAFIM = "SEXTA-FEIRA";
		}
		if ($Rs["CLIEN_COL_DIAFIM"] == "B") {
			$DIAFIM = "SÁBADO";
		}
	}
?>

<html>
<script language="JavaScript" type="text/JavaScript">
<!--
function abrir_janela_popup(theURL,winName,features) { //v2.0
window.open(theURL,winName,features);
}
//-->
</script><script language="JavaScript" type="text/JavaScript">
<!--


function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
//-->
</script>
<head>
<title>WEBDevol</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<!--Fireworks MX 2004 Dreamweaver MX 2004 target.  Created Mon Apr 25 21:07:14 GMT-0300 (Hora oficial do Brasil) 2005-->
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
<style type="text/css">
<!--
.style3 {font-weight: bold}
-->
</style>
<div id="Layer1" style="position:absolute; left:249px; top:57px; width:69px; height:29px; z-index:1; visibility: hidden;"><a href=http://www.milonic.com/styleproperties.php class="style1">http://www.milonic.com/styleproperties.php</a></div>

<link href="wfa.css" rel="stylesheet" type="text/css">
</head>
<body onLoad="MM_preloadImages('imagens/imprimir2.jpg','imagens/fechar2.jpg')">

<table width="95%"  border="0" align="center" class="style1">
  <tr>
    <td height="25" colspan="4" class="listagem_azul"><img src="imagens/logotipo_impressao.jpg" width="141" height="41"></td>
  </tr>
  <tr>
    <td height="25" colspan="4" class="listagem_azul">&nbsp;</td>
  </tr>
  <tr class="listagem_azul">
    <td height="25" colspan="4" class="listagem_azul"><strong>&nbsp;:: Impress&atilde;o de pr&eacute; nota - N&ordm; <?=$ID?> :: </strong></td>
  </tr>
  <tr class="style1">
    <td width="20%" class="style2"><strong>C&oacute;digo</strong></td>
    <td colspan="3" class="style1">      <?=$Rs["CLIENTE"]?></td>
  </tr>
  <tr class="style1">
    <td class="style2"><strong>Nome Cliente</strong></td>
    <td class="style1"><?=$Rs["NOMECLIENTE"]?></td>
    <td class="style1"><div align="right"><strong>CNPJ</strong></div></td>
    <td class="style1"><?=$Rs["CNPJCLIENTE"]?></td>
  </tr>
  <tr class="listagem_azul">
    <td height="25" colspan="4" class="style2"><strong>&nbsp;:: Dados da NF de devolu&ccedil;&atilde;o :: </strong></td>
  </tr>
  <tr class="style1">
    <td class="style2"><strong>N&ordm; NF devolu&ccedil;&atilde;o </strong></td>
    <td class="style1"><?=$Rs["PRENF_NUMNFDEVOLUCAO"]?></td>
    <td class="style2"><div align="right"><strong>N&ordm; s&eacute;rie </strong></div></td>
    <td class="style1"><?=$Rs["PRENF_SERIE"]?></td>
  </tr>
  <tr class="style1">
    <td class="style2"><strong>Data NF devolu&ccedil;&atilde;o</strong></td>
    <td colspan="3" class="style1"><?=$Rs["DATANF"]?></td>
  </tr>
  <tr class="style1">
    <td class="style2"><strong>CFOP </strong></td>
    <td colspan="3" class="style1"><?=$Rs["PRENF_CFOP"].' - '.$Rs["DS_OPER"]?></td>
  </tr>
  <tr class="style1">
    <td class="style2"><strong>Destinat&aacute;rio</strong></td>
    <td colspan="3" class="style1">       <?=$Rs["NOME"]?></td>
  </tr>
  <tr class="style1">
    <td class="style2"><strong>Endere&ccedil;o</strong></td>
    <td class="style1"><?=$Rs["RUA"]?></td>
    <td class="style2"><div align="right"><strong>Bairro</strong></div></td>
    <td><?=$Rs["BAIRRO"]?></td>
  </tr>
  <tr class="style1">
    <td class="style2"><div align="left"><strong>Cidade</strong></div></td>
    <td><?=$Rs["CIDADE"]?>
</td>
    <td width="19%" class="style2"><div align="right"><strong>Estado</strong></div></td>
    <td width="30%" class="style1"><?=$Rs["SG_UF"]?></td>
  </tr>
  <tr class="style1">
    <td class="style2"><strong>CEP</strong></td>
    <td><?=$Rs["CEP"]?></td>
    <td class="style2"><div align="right"></div></td>
    <td class="style1">&nbsp;</td>
  </tr>
  <tr class="style1">
    <td class="style2"><strong>CNPJ</strong></td>
    <td class="style1"><?=$Rs["CNPJ"]?></td>
    <td class="style2"><div align="right"><strong>Inscri&ccedil;&atilde;o estadual</strong></div></td>
    <td class="style1"><?=$Rs["INSCRICAOESTADUAL"]?></td>
  </tr>
  
</table>
<span class="style1"> </span>
<table width="95%"  border="0" align="center" class="style1">
  <tr>
    <td colspan="4">
      <div align="center"></div></td>
  </tr>
  <tr class="listagem_azul">
    <td height="30" colspan="4"><div align="left"><strong> &nbsp;:: Listagens dos produtos da pr&eacute;-nota :: </strong></div></td>
  </tr>
  <tr>
    <td colspan="4"><table width="100%"  border="0" align="center">
      <tr class="topo_listagem" >
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
			"WHERE PRENFI_NUMPRENF = '" .$ID. "'".
			"      AND PRENFI_REFERENCIA = CD_ITEM_MATERIAL ".
			"      AND PRENFI_NUMPRENF = PRENF_NUMPRENF".
			" ORDER BY PRENFI_IDO";
	$Stmt2 = mysql_query($Sql);
	//die($Sql);
	while ($RsI = mysql_fetch_assoc($Stmt2)) { ?>
      <tr valign="top" bordercolor="#00CCFF" class="listagem">
        <td><div align="center">
          <?=$RsI["PRENFI_REFERENCIA"]?>
        </div></td>
        <td><?=$RsI["DESCRICAO"]?></td>
        <?
			$Sql = "SELECT lanca_numrar, item_serie, item_nf FROM rar_lancamento, rar_item ";
			$Sql.= " WHERE lanca_numrar = item_numrar and lanca_prenfi_ido='".$RsI["PRENFI_IDO"]."'";
			$Stmt3 = mysql_query($Sql);
			$NUMRARS = "";
			while ($RsR = mysql_fetch_assoc($Stmt3))
			 	$NUMRARS.= $RsR["lanca_numrar"]." - ".$RsR["item_nf"]."/".$RsR["item_serie"]."<BR>";
			$NUMRARS = substr($NUMRARS,0,strlen($NUMRARS)-4);
			?>
        <td><div align="center">
          <?=$NUMRARS?>
        </div></td>
        <td width="11%"><div align="center">
          <?=$RsI["PRENFI_CLASSIFICACAOFISCAL"]?>
        </div></td>
        <td width="6%"><div align="center">
          <?=$RsI["PRENFI_UNIDADE"]?>
        </div></td>
        <td width="6%"><div align="right">
          <?=$RsI["PRENFI_QUANTIDADE"]?>
        </div></td>
        <td width="9%"><div align="right">
          <?=formatCurrency($RsI["VALOR_UNITARIO"])?>
        </div></td>
        <td width="7%" align="right"><?=formatCurrency($RsI["VALOR"])?></td>
        <td width="5%" align="center"><?=$Rs["ICMS"]?></td>
        <td width="4%" align="center"><?=$Rs["IPI"]?></td>
      </tr>
      <? } ?>
    </table>
    <table width="100%"  border="0" align="center">
      <tr class="listagem">
        <td >&nbsp;</td>
        <td >&nbsp;</td>
        <td a href="cad_defeitos.htm">&nbsp;</td>
        <td a href="cad_defeitos.htm">&nbsp;</td>
        <td a href="cad_defeitos.htm">&nbsp;</td>
        <td a href="cad_defeitos.htm">&nbsp;</td>
      </tr>
      <tr class="listagem">
        <td width="20%" >
          <div align="right" class="style3">Base c&aacute;lculo ICMS </div></td>
        <td width="10%" ><div align="left"><span class="style3">
          <input name="textfield2323222223" type="text" disabled class="campo_amarelo" value="R$ <?=formatCurrency($Rs["BASEICMS"])?>" size="10" maxlength="20">
</span></div></td>
        <td width="25%" a href="cad_defeitos.htm"><div align="right"><strong>Valor do ICMS</strong></div></td>
        <td width="11%" a href="cad_defeitos.htm"><div align="left"><span class="style3">
          <input name="textfield232322224" type="text" disabled class="campo_amarelo" value="R$ <?=formatCurrency($Rs["VALORICMS"])?>" size="10" maxlength="20">
</span></div></td>
        <td width="30%" a href="cad_defeitos.htm"><div align="right"><strong>Valor total dos produtos</strong></div></td>
        <td width="11%" a href="cad_defeitos.htm"><div align="left"><span class="style3">
          <input name="textfield2323222224" type="text" disabled class="campo_amarelo" value="R$ <?=formatCurrency($Rs["BASEICMS"])?>" size="10" maxlength="20">
</span></div></td>
      </tr>
	  <?
	   if ($Rs["SUFRAMA"] == "S"){
			$Sql = "SELECT distinct aliq_icms";
			$Sql.= " FROM rar_prenf_item, item_nota_fiscal, rar_item";
			$Sql.= " WHERE lanca_numrar = item_numrar ";
			$Sql.= " AND num_nf = item_nf ";
			$Sql.= " AND serie_nf = item_serie ";
			$Sql.= " AND cd_item_material = item_referencia ";
			$Sql.= " AND prenfi_numprenf = '" .$_GET['Id']. "'";
			$Stmt = mysql_query($Sql);
			$RsIcms = mysql_fetch_assoc($Stmt);
			$ValorTotal = round($Rs["VALORTOTAL"] * (1-$RsIcms["aliq_icms"]),2);
		}else{
			$ValorTotal = $Rs["VALORTOTAL"];
		}
		$ValorTotal = $Rs["VALORIPI"] + $ValorTotal;
		$ValorTotal = str_replace(".",",",$ValorTotal);
		$ValorTotal = number_format($ValorTotal, 2, ',', '');
	   ?>
      <tr class="listagem">
        <td >&nbsp;</td>
        <td >&nbsp;</td>
        <td a href="cad_defeitos.htm"><div align="right"><strong>Valor do IPI</strong></div></td>
        <td a href="cad_defeitos.htm"><span class="style3">
          <input name="textfield2323222242" type="text" disabled class="campo_amarelo" value="R$ <?=formatCurrency($Rs["VALORIPI"])?>" size="10" maxlength="20">
        </span></td>
        <td a href="cad_defeitos.htm"><div align="right" class="style3">Valor total da NF</div></td>
        <td a href="cad_defeitos.htm"><div align="left"><span class="style3">
          <input name="textfield2323222222" type="text" disabled class="campo_amarelo" value="R$ <?=formatCurrency($Rs["VALORTOTAL"])?>" size="10" maxlength="20">
</span></div></td>
      </tr>
      <tr class="listagem">
        <td colspan="6" >
		
		<?
		 if ($Rs["SIMPLES"] == "S"){
		 	//Substituido o select abaixo pelos outros dois selects em separado. - 21/11/2007
			//Motivo: se na NF tinha mais de um ítem da mesma referencia e na PRENF havia somente um, o sistema acabava multiplicando
			//        pela qtde de vezes que tinha de itens da NF
			/*$sql = " SELECT sum( (item_valor * item_qtde) * it.aliq_icms ) AS valor";
			$sql.= " FROM rar_prenf_item p, rar_lancamento l, rar_item i, item_nota_fiscal it ";
			$sql.= " WHERE PRENFI_NUMPRENF = '" .$_GET['Id']. "'";
			$sql.= " AND l.lanca_prenfi_ido = prenfi_ido ";
			$sql.= " AND i.item_numrar = l.lanca_numrar ";
			$sql.= " AND it.num_nf = i.item_nf ";
			$sql.= " AND it.serie_nf = i.item_serie ";
			$sql.= " AND it.cd_item_material = item_referencia ";*/
		 
		 	//Busca primeiro a aliq de ICMS
			$sql = " SELECT distinct it.aliq_icms aliq_icms";
			$sql.= " FROM rar_prenf_item p, rar_lancamento l, rar_item i, item_nota_fiscal it ";
			$sql.= " WHERE PRENFI_NUMPRENF = '" .$_GET['Id']. "'";
			$sql.= " AND l.lanca_prenfi_ido = prenfi_ido ";
			$sql.= " AND i.item_numrar = l.lanca_numrar ";
			$sql.= " AND it.num_nf = i.item_nf ";
			$sql.= " AND it.serie_nf = i.item_serie ";
			$sql.= " AND it.cd_item_material = item_referencia ";
			$Stmt = mysql_query($sql);
			$Rs = mysql_fetch_assoc($Stmt);
			$PercIcms = str_replace(",",".",$Rs["aliq_icms"]);
			
			//Multiplica somatório de ítens da pré-nota x Percentual ICMS
		 	$sql = " SELECT sum( (item_valor * item_qtde) * " . $PercIcms .") AS valor";
			$sql.= " FROM rar_prenf_item p, rar_lancamento l, rar_item i";
			$sql.= " WHERE PRENFI_NUMPRENF = '" .$_GET['Id']. "'";
			$sql.= " AND l.lanca_prenfi_ido = prenfi_ido ";
			$sql.= " AND i.item_numrar = l.lanca_numrar ";
			$Stmt = mysql_query($sql);
			$Rs = mysql_fetch_assoc($Stmt);
			$Icms = $Rs["valor"];

		 ?>
           <table width="100%"  border="0" align="center" class="listagem_procedente">
             <tr>
               <td width="100%"><div align="center">
                 <p class="topo_listagem">Caro franqueado, por sua empresa estar enquadrada como ME/EPP, favor inserir nos <strong>“Dados Adicionais”</strong><br>
  					da nota fiscal a base de c&aacute;lculo e o valor de ICMS, conforme segue abaixo:<br>
Base de C&aacute;lculo: R$ <?=formatCurrency($BaseIcms)?> <br>
Valor do ICMS: R$ <?=formatCurrency($Icms)?>
<br>
<br>
Obrigado!</p>
                 </div></td>
              </tr>
           </table>
		   <?
		   }
		   ?>
		
		</td>
        </tr>
    </table></td>
  </tr>
  <tr class="">
    <td height="25" colspan="4" class="">&nbsp;</td>
  </tr>
  <tr class="listagem_azul">
    <td height="25" colspan="4" class="style2"><strong>&nbsp;:: Dados de coleta:: </strong></td>
  </tr>
  <tr class="">
    <td height="" class="style2"><strong class="listagem">Endere&ccedil;o</strong></td>
    <td height="" colspan="3" class="style2"><?=$Rs["CLIEN_COL_ENDER"]?></td>
  </tr>
  <tr class="">
    <td height="" class="style2"><strong>Bairro</strong></td>
    <td height="" class="style2"><?=$Rs["CLIEN_COL_BAIRRO"]?></td>
    <td height="" class="style2"><div align="right"><span body="bold"><strong>Cidade&nbsp;</strong></span></div></td>
    <td height="" class="style2"><?=$Rs["CLIEN_COL_CIDADE"]?></td>
  </tr>
  <tr class="">
    <td height="" class="style2"><strong>UF</strong></td>
    <td height="" class="style2"><?=$Rs["CLIEN_COL_UF"]?></td>
    <td height="" class="style2"><div align="right"><span body="bold"><strong>Fone&nbsp;</strong></span></div></td>
    <td height="" class="style2"><?=$Rs["CLIEN_COL_FONE"]?></td>
  </tr>
  <tr class="">
    <td height="" class="style2"><strong>Dias para coleta</strong></td>
    <td height="" class="style2"><strong>De: </strong><?=$DIAINI?> <strong>&agrave; </strong><?=$DIAFIM?></td>
    <td height="" class="style2"><div align="right"><strong>Hor&aacute;rio para coleta&nbsp;</strong></div></td>
    <td height="" class="style2"><strong>Das</strong>
      <?=$Rs["HRINI"]?>
      <strong>&agrave;s</strong>
      <?=$Rs["HRFIM"]?></td>
  </tr>
  <tr class="">
    <td height="" class="style2"><strong>Qtde volumes</strong></td>
    <td height="" class="style2"><?=$Rs["QTDEVOLUME"]?></td>
    <td height="" class="style2"><div align="right"><strong>Peso aproximado&nbsp; </strong></div></td>
    <td height="" class="style2"><?=$Peso?></td>
  </tr>
  <tr class="">
    <td height="" class="style2"><strong>OBS para transportadora</strong></td>
    <td height="" colspan="3" class="style2"><?=$Rs["PRENF_OBSTRANSPORTADORA"]?></td>
  </tr>
  <tr class="style1">
    <td class="style2">&nbsp;</td>
    <td class="style1">&nbsp;</td>
    <td class="style2">&nbsp;</td>
    <td class="style1">&nbsp;</td>
  </tr>
  <tr class="listagem_azul">
    <td height="25" colspan="4" class="listagem_azul"><strong>&nbsp;:: Confirma&ccedil;&atilde;o de coleta :: </strong></td>
  </tr>
  <tr>
    <td class="style1"><strong>Dados da coleta </strong></td>
    <td height="25" class="style1"><input name="textfield232322223" type="text" disabled class="campo_texto" value="__/__/____" size="20" maxlength="20"></td>
    <td class="style1"><strong>RG do motorista </strong></td>
    <td><input name="textfield2323222232" type="text" disabled class="campo_texto" size="30" maxlength="30"></td>
  </tr>
  <tr>
    <td class="style1"><strong>Nome da transportadora</strong></td>
    <td height="30" colspan="3" class="style1"><input name="textfield23232222332" type="text" disabled class="campo_texto" size="95" maxlength="30"></td>
  </tr>
  <tr>
    <td class="style1"><strong>Nome leg&iacute;vel do motorista </strong></td>
    <td class="style1"><input name="textfield2323222233" type="text" disabled class="campo_texto" size="30" maxlength="30"></td>
    <td class="style1"><strong>Assinatura do motorista </strong></td>
    <td height="30">_____________________________________</td>
  </tr>
</table>
<div align="center">
  <p><div id="idButtons" style="display:"><a href="javascript:printDocument();" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image2','','imagens/imprimir2.jpg',1)"><img src="imagens/imprimir.jpg" name="Image2" width="78" height="20" border="0"></a>&nbsp;<a href="javascript:window.close()" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image3','','imagens/fechar2.jpg',1)"><img src="imagens/fechar.jpg" name="Image3" width="78" height="20" border="0"></a></div>
  </p>
</div>
<script language="javascript" type="text/javascript">
	function printDocument() {
		document.getElementById("idButtons").style.display = "none";
		self.print();
		document.getElementById("idButtons").style.display = "";
	}
	window.focus();
</script>
</body>
</html>
