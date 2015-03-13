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

							" P.IE AS INSCRICAOESTADUAL,".

							" (SELECT ROUND(SUM(PRENFI_QUANTIDADE * PRENFI_VALORUNITARIO),2) + ROUND((SUM(PRENFI_QUANTIDADE * PRENFI_VALORUNITARIO) * PRENF_IPI),2) VALORTOTAL ".

						   "    FROM rar_prenf_item ".

					       "   WHERE PRENFI_NUMPRENF = PRENF_NUMPRENF ".

						   "GROUP BY PRENF_PESSOA_EMITENTE) VALORTOTAL, ".

						   " (SELECT ROUND(SUM(PRENFI_QUANTIDADE * PRENFI_VALORUNITARIO),2) BASEICMS ".

						   "    FROM rar_prenf_item ".

					       "   WHERE PRENFI_NUMPRENF = PRENF_NUMPRENF ".

						   "GROUP BY PRENF_PESSOA_EMITENTE) BASEICMS, ".

							" (SELECT SUM(PRENFI_QUANTIDADE) QTDETOTAL  ".

							"    FROM rar_prenf_item ".

							"	WHERE PRENFI_NUMPRENF = PRENF_NUMPRENF  ".

							"GROUP BY PRENF_PESSOA_EMITENTE) QTDETOTAL, ".

							" (SELECT round((SUM(PRENFI_QUANTIDADE * PRENFI_VALORUNITARIO) * PRENF_ICMS),2) VALORICMS  ".

							"    FROM rar_prenf_item ".

							"   WHERE PRENFI_NUMPRENF = PRENF_NUMPRENF  ".

							"GROUP BY PRENF_PESSOA_EMITENTE) VALORICMS, ".

							" (SELECT round((SUM(PRENFI_QUANTIDADE * PRENFI_VALORUNITARIO) * PRENF_IPI),2) VALORIPI  ".

							"    FROM rar_prenf_item ".

							"   WHERE PRENFI_NUMPRENF = PRENF_NUMPRENF  ".

							"GROUP BY PRENF_PESSOA_EMITENTE) VALORIPI, ".

							" P.NM_MUNICIPIO CIDADE,  ".

							" O.DS_OPER,  ".

							" P.SG_UF UF, PRENF_TRANSP_IDO  ".

				    " FROM rar_prenf, pessoa P, pessoa PD, rar_cliente_coleta, operacao O ".

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
		
		$Sql = "select * from rar_transportadoras where transp_ido = '".$Rs["PRENF_TRANSP_IDO"]."'";
		$StmtTrans = mysql_query($Sql);
		$RsTransp = mysql_fetch_assoc($StmtTrans);
		$Transportadora = $RsTransp["transp_nome"];
		if ($Transportadora == "") { 
			$Transportadora = "Não informada";
		};

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

<title><?=$NomeSistema?></title>

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
<div id="Layer1" style="position:absolute; left:249px; top:57px; width:69px; height:29px; z-index:1; visibility: hidden;"><a href=http://www.milonic.com/styleproperties.php class="style1">http://www.milonic.com/styleproperties.php</a></div>



<link href="wfa.css" rel="stylesheet" type="text/css">

<link href="../css/global.css" rel="stylesheet" type="text/css" />

</head>

<body onLoad="MM_preloadImages('imagens/imprimir2.jpg','imagens/fechar2.jpg')">



<table width="95%"  border="0" align="center" class="">

  <tr>

    <td height="25" colspan="4" class=""><?=$NomeSistema?></td>
  </tr>

  <tr>

    <td height="25" colspan="4" class="">&nbsp;</td>
  </tr>

  <tr class="">

    <td height="25" colspan="4" class="tab_titulo"><strong>Impress&atilde;o de pr&eacute; nota - N&ordm; <?=$ID?></strong></td>
  </tr>

  <tr class="">

    <td width="20%" class="style1"><strong>C&oacute;digo</strong></td>

    <td colspan="3" class="email">      <?=arrumaPessoa($Rs["CLIENTE"])?></td>
  </tr>

  <tr class="">

    <td class="style1"><strong>Nome Cliente</strong></td>

    <td class="email"><?=$Rs["NOMECLIENTE"]?></td>

    <td class=""><div align="right"><strong class="style1">CNPJ</strong></div></td>

    <td class="email"><?=$Rs["CNPJCLIENTE"]?></td>
  </tr>

  <tr class="">
    <td height="25" colspan="4">&nbsp;</td>
  </tr>
  <tr class="">

    <td height="25" colspan="4" class="tab_titulo"><strong class="tab_titulo">Dados da NF de devolu&ccedil;&atilde;o</strong></td>
  </tr>

  <tr class="">

    <td class="style1"><strong>N&ordm; NF devolu&ccedil;&atilde;o </strong></td>

    <td class="email"><?=$Rs["PRENF_NUMNFDEVOLUCAO"]?></td>

    <td class=""><div align="right"><strong class="style1">N&ordm; s&eacute;rie </strong></div></td>

    <td class="email"><?=$Rs["PRENF_SERIE"]?></td>
  </tr>

  <tr class="">

    <td class="style1"><strong>Data NF devolu&ccedil;&atilde;o</strong></td>

    <td colspan="3" class="email"><?=$Rs["DATANF"]?></td>
  </tr>

  <tr class="">

    <td class="style1"><strong>CFOP </strong></td>

    <td colspan="3" class="email"><?=$Rs["PRENF_CFOP"].' - '.$Rs["DS_OPER"]?></td>
  </tr>

  <tr class="">

    <td class="style1"><strong>Destinat&aacute;rio</strong></td>

    <td colspan="3" class="email">       <?=$Rs["NOME"]?></td>
  </tr>

  <tr class="">

    <td class="style1"><strong>Endere&ccedil;o</strong></td>

    <td class="email"><?=$Rs["RUA"]?></td>

    <td class="style1"><div align="right"><strong>Bairro</strong></div></td>

    <td class="email"><?=$Rs["BAIRRO"]?></td>
  </tr>

  <tr class="">

    <td class="style1"><div align="left"><strong>Cidade</strong></div></td>

    <td class="email"><?=$Rs["CIDADE"]?></td>

    <td width="19%" class="style1"><div align="right"><strong>Estado</strong></div></td>

    <td width="30%" class="email"><?=$Rs["SG_UF"]?></td>
  </tr>

  <tr class="">

    <td class="style1"><strong>CEP</strong></td>

    <td class="email"><?=$Rs["CEP"]?></td>

    <td class="style1"><div align="right"></div></td>

    <td class="email">&nbsp;</td>
  </tr>

  <tr class="">

    <td class="style1"><strong>CNPJ</strong></td>

    <td class="email"><?=$Rs["CNPJ"]?></td>

    <td class="style1"><div align="right"><strong>Inscri&ccedil;&atilde;o estadual</strong></div></td>

    <td class="email"><?=$Rs["INSCRICAOESTADUAL"]?></td>
  </tr>
  <tr class="">
    <td class="style1"><strong>Transportadora</strong></td>
    <td class="email"><?=$Transportadora?></td>
    <td class="style1">&nbsp;</td>
    <td class="email">&nbsp;</td>
  </tr>
</table>

<span class=""> </span>

<table width="95%"  border="0" align="center" class="style1">

  <tr>

    <td colspan="4">

      <div align="center"></div></td>

  </tr>

  <tr class="">

    <td height="30" colspan="4" class="tab_titulo"><div align="left"><strong>Listagens dos produtos da pr&eacute;-nota</strong></div></td>

  </tr>

  <tr>

    <td colspan="4"><table width="100%"  border="0" align="center">

      <tr class="tab_usuarios" >

        <td width="15%" ><div align="center">Refer&ecirc;ncia</div></td>

        <td width="15%" ><div align="center">N&ordm; RAR - NF/S&eacute;rie Origem </div></td>
        <td width="10%" ><div align="center">Class. fiscal</div></td>

        <td width="10%" ><div align="center">Unidade Medida </div></td>

        <td width="10%" ><div align="center">Quantidade</div></td>

        <td width="10%" ><div align="center">Valor Unit&aacute;rio </div></td>

        <td width="10%" ><div align="center">Valor Total</div></td>

        <td width="10%" ><div align="center">% ICMS </div></td>

        <td width="10%" ><div align="center">% IPI </div></td>
      </tr>

      <? 

	$Sql = "SELECT PRENFI_IDO, PRENFI_CLASSIFICACAOFISCAL, ".

	             " concat(substring(PRENFI_REFERENCIA,1,4),'-',substring(PRENFI_REFERENCIA,5,4),'-',substring(PRENFI_REFERENCIA,9,4),'-',substring(PRENFI_REFERENCIA,13,4)) PRENFI_REFERENCIA, ".

				 " PRENFI_UNIDADE, ".

				 " ROUND(PRENFI_QUANTIDADE,0) AS PRENFI_QUANTIDADE,  ".

				 " ROUND(PRENFI_VALORUNITARIO,2) VALOR_UNITARIO,  ".

				 " ROUND((PRENFI_QUANTIDADE * PRENFI_VALORUNITARIO),2) VALOR  ".

		    " FROM rar_prenf_item ".

			"WHERE PRENFI_NUMPRENF = '" .$ID. "'";

	$Stmt2 = mysql_query($Sql);



	while($RsI = mysql_fetch_assoc($Stmt2)) { ?>

      <tr bordercolor="#00CCFF" class="tab_usuarios_info">

        <td class="style1"><div align="center">

            <?=$RsI["PRENFI_REFERENCIA"]?>

        </div></td>
		
		<?

			$Sql = "SELECT lanca_numrar, item_serie, item_nf FROM rar_lancamento, rar_item ";

			$Sql.= " WHERE lanca_numrar = item_numrar and lanca_prenfi_ido='".$RsI["PRENFI_IDO"]."'";

			$Stmt3 = mysql_query($Sql);

			$NUMRARS = "";

			while ($RsR = mysql_fetch_assoc($Stmt3))

			 	$NUMRARS.= $RsR["lanca_numrar"]." - ".$RsR["item_nf"]."/".$RsR["item_serie"]."<BR>";

			$NUMRARS = substr($NUMRARS,0,strlen($NUMRARS)-4);

			?>

        <td class="style1"><div align="center"> <?=$NUMRARS?></div></td>
        <td class="style1"><div align="center">

            <?=$RsI["PRENFI_CLASSIFICACAOFISCAL"]?>

        </div></td>

        <td class="style1"><div align="center">

            <?=$RsI["PRENFI_UNIDADE"]?>

        </div></td>

        <td class="style1"><div align="right">

            <?=$RsI["PRENFI_QUANTIDADE"]?>

        </div></td>

        <td class="style1"><div align="right">

            <?=formatCurrency($RsI["VALOR_UNITARIO"])?>

        </div></td>

        <td align="right" class="style1"><?=formatCurrency($RsI["VALOR"])?></td>

        <td align="right" class="style1"><?=$Rs["ICMS"]?></td>

        <td align="right" class="style1"><?=$Rs["IPI"]?></td>
      </tr>

      <? } ?>

    </table>

    <table width="100%"  border="0" align="center" >

      <tr class=""> 

        <td width="15%" >&nbsp;</td>

        <td width="17%" >&nbsp;</td>

        <td width="15%" a href="cad_defeitos.htm">&nbsp;</td>

        <td width="17%" a href="cad_defeitos.htm">&nbsp;</td>

        <td width="20%" a href="cad_defeitos.htm">&nbsp;</td>

        <td width="17%" a href="cad_defeitos.htm">&nbsp;</td>

      </tr>

      <tr class="">

        <td >

          <div align="right" class="style1"><strong>Base c&aacute;lculo ICMS </strong></div></td>

        <td ><div align="left" class="email"> &nbsp;R$ <?=formatCurrency($Rs["BASEICMS"])?> </div></td>

        <td class="style1" a href="cad_defeitos.htm"><div align="right" class="style1"><strong>Valor do ICMS</strong></div></td>

        <td a href="cad_defeitos.htm"><div align="left" class="email">R$ 
            <?=formatCurrency($Rs["VALORICMS"])?>
</div></td>

        <td class="style1" a href="cad_defeitos.htm"><div align="right" class="style1"><strong>Valor total dos produtos</strong></div></td>

        <td a href="cad_defeitos.htm"><div align="left" class="email">R$ 
            <?=formatCurrency($Rs["BASEICMS"])?>
</div></td>

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

      <tr class="">

        <td >&nbsp;</td>

        <td >&nbsp;</td>

        <td class="style1" a href="cad_defeitos.htm"><div align="right" class="style1"><strong>Valor do IPI</strong></div></td>

        <td a href="cad_defeitos.htm"><span class="email">

        R$ 
            <?=formatCurrency($Rs["VALORIPI"])?>
        </span></td>

        <td class="style1" a href="cad_defeitos.htm"><div align="right" class="style1"><strong>Valor total da NF</strong></div></td>

        <td a href="cad_defeitos.htm"><div align="left" class="email">R$ 
            <?=formatCurrency($Rs["VALORTOTAL"])?>
</div></td>

      </tr>

    </table></td>

  </tr>

  <tr class="">

    <td height="25" colspan="4" class="">&nbsp;</td>

  </tr>

  <tr class="">

    <td height="25" colspan="4" class="tab_titulo"><strong>Dados de coleta</strong></td>

  </tr>

  <tr class="">

    <td height="" class=""><strong class="">Endere&ccedil;o</strong></td>

    <td height="" colspan="3" class=""><?=$Rs["CLIEN_COL_ENDER"]?></td>

  </tr>

  <tr class="">

    <td height="" class=""><strong>Bairro</strong></td>

    <td height="" class=""><?=$Rs["CLIEN_COL_BAIRRO"]?></td>

    <td height="" class=""><div align="right"><span body="bold"><strong>Cidade&nbsp;</strong></span></div></td>

    <td height="" class=""><?=$Rs["CLIEN_COL_CIDADE"]?></td>

  </tr>

  <tr class="">

    <td height="" class=""><strong>UF</strong></td>

    <td height="" class=""><?=$Rs["CLIEN_COL_UF"]?></td>

    <td height="" class=""><div align="right"><span body="bold"><strong>Fone&nbsp;</strong></span></div></td>

    <td height="" class=""><?=$Rs["CLIEN_COL_FONE"]?></td>

  </tr>

  <tr class="">

    <td height="" class=""><strong>Dias para coleta</strong></td>

    <td height="" class=""><strong>De: </strong><?=$DIAINI?> <strong>&agrave; </strong><?=$DIAFIM?></td>

    <td height="" class=""><div align="right"><strong>Hor&aacute;rio para coleta&nbsp;</strong></div></td>

    <td height="" class=""><strong>Das</strong>

      <?=$Rs["HRINI"]?>

      <strong>&agrave;s</strong>

      <?=$Rs["HRFIM"]?></td>

  </tr>

  <tr class="">

    <td height="" class=""><strong>Qtde volumes</strong></td>

    <td height="" class=""><?=$Rs["QTDEVOLUME"]?></td>

    <td height="" class=""><div align="right"><strong>Peso aproximado&nbsp; </strong></div></td>

    <td height="" class=""><?=$Peso?></td>

  </tr>

  <tr class="">

    <td height="" class=""><strong>OBS para transportadora</strong></td>

    <td height="" colspan="3" class=""><?=$Rs["PRENF_OBSTRANSPORTADORA"]?></td>

  </tr>

  <tr class="">

    <td class="">&nbsp;</td>

    <td class="">&nbsp;</td>

    <td class="">&nbsp;</td>

    <td class="">&nbsp;</td>

  </tr>

  <tr class="">

    <td height="25" colspan="4" class="tab_titulo"><strong>Confirma&ccedil;&atilde;o de coleta</strong></td>

  </tr>

  <tr>

    <td class=""><strong>Dados da coleta </strong></td>

    <td height="25" class=""><input name="textfield232322223" type="text" disabled class="form" value="__/__/____" size="20" maxlength="20"></td>

    <td class=""><strong>RG do motorista </strong></td>

    <td><input name="textfield2323222232" type="text" disabled class="form" size="30" maxlength="30"></td>

  </tr>

  <tr>

    <td class=""><strong>Nome da transportadora</strong></td>

    <td height="30" colspan="3" class=""><input name="textfield23232222332" type="text" disabled class="form" size="95" maxlength="30"></td>

  </tr>

  <tr>

    <td class=""><strong>Nome leg&iacute;vel do motorista </strong></td>

    <td class=""><input name="textfield2323222233" type="text" disabled class="form" size="30" maxlength="30"></td>

    <td class=""><strong>Assinatura do motorista </strong></td>

    <td height="30">_____________________________________</td>

  </tr>

</table>

<div align="center">

  <p><div id="idButtons" style="display:"><a href="javascript:printDocument();"><img src="imagens/imprimir.jpg" name="Image2" width="52" height="22" border="0"></a>&nbsp;<a href="javascript:window.close()"><img src="imagens/fechar.jpg" name="Image3" width="52" height="22" border="0"></a></div>

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

