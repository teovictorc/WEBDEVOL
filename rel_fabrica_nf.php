<? include("inc/headerI.inc.php"); 
verifyAcess("REL_PARES_FABRICA","S");
?>
<style type="text/css">
<!--
.style1 {font-weight: bold}
-->
</style>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
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
<link href="wfa.css" rel="stylesheet" type="text/css">
<body onLoad="MM_preloadImages('imagens/pesquisar2.jpg')">
<form name="form" method="get" action="rel_fabrica_nf.php">
<tr>
    <td height="100%" valign="top" class="tab_conteudo">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="32" class="tab_titulo"><h4>Relat&oacute;rio de pares x f&aacute;brica</h4></td>
      </tr>
    </table>

    <table width="100%" border="0">
      <tr>
        <td width="22%" class=""><strong >Per&iacute;odo de pesquisa: </strong></td>
        <td width="76%"><span class="style2"><strong>de&nbsp;
		 <input name="DT_INICIAL" type="text" class="form" onKeyPress="return JSUtilApenasNumero(event);" onKeyUp="JSUtilMascara(this,event,'__/__/____');" value="<?=$_GET['DT_INICIAL']?>" size="9" maxlength="10">&nbsp;&nbsp;a&nbsp;
         <input name="DT_FINAL" type="text" class="form" onKeyPress="return JSUtilApenasNumero(event);" onKeyUp="JSUtilMascara(this,event,'__/__/____');" value="<?=$_GET['DT_FINAL']?>" size="9" maxlength="10">
         <span class="style1"><a href="javascript:FilterSearch();" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image341','','imagens/pesquisar2.jpg',1)"><img src="imagens/pesquisar.jpg" name="Image341" width="78" height="20" border="0" align="middle" id="Image341"></a></span> </strong></span>
	    </td>
</form>
<? if($_GET['DT_INICIAL']<>"")
    {
?>
<form name="form1" method="post" action="#" target="windowPrint">
     <td width="2%">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="3"> <div align="center">
          <table width="100%"  border="0" align="center">
            <tr class="tab_usuarios" >
              <td width="3%" ><div align="center"></div></td>
              <td width="7%" ><div align="center">N&ordm; NF</div></td>
              <td width="10%" ><div align="center">Data NF </div></td>
              <td width="10%" ><div align="center">Qtde Volumes</div></td>
              <td width="10%" ><div align="center">Qtde Pares </div></td>
              <td width="10%" ><div align="center">Valor total </div></td>
              <td width="10%" ><div align="center">C&oacute;digo cliente </div>                <div align="center"></div></td>
              <td width="40%" >Nome do Cliente </td>
              </tr>
<? 
	$Sql = "SELECT PRENF_PESSOA_DESTINATARIO, ".
	               " PRENF_NUMPRENF, ".
			       " PRENF_NUMNFDEVOLUCAO, ".
			       " date_format(PRENF_DATA_NFDEVOLUCAO,'%d/%m/%Y') DATANF, ".
			       " round(PRENF_QTDEVOLUME,0) PRENF_QTDEVOLUME, ".
				   " NOME NOMECLIENTE, ".
			       "(SELECT round(SUM(PRENFI_QUANTIDADE),0) QTDE FROM RAR_PRENF_ITEM WHERE PRENFI_NUMPRENF = PRENF_NUMPRENF GROUP BY PRENF_PESSOA_EMITENTE) QTDE, ".
			       "(SELECT round(SUM(PRENFI_QUANTIDADE * PRENFI_VALORUNITARIO),2) VALOR FROM RAR_PRENF_ITEM WHERE PRENFI_NUMPRENF = PRENF_NUMPRENF GROUP BY PRENF_PESSOA_EMITENTE) VALOR ".
			" FROM rar_prenf, pessoa, rar_usuarioxcliente ".
			"WHERE PESSOA = PRENF_PESSOA_DESTINATARIO ".
			       //" AND PRENF_DATA_IMPORT_AREZZO IS NULL ".
				   " AND PRENF_DATA_RECEBTO_AREZZO IS NOT NULL ".
			       " AND USUCLI_PESSOA = PRENF_PESSOA_DESTINATARIO ".
				   " AND (PRENF_CATEGORIA = '1' or (PRENF_CATEGORIA = 2 AND PRENF_PESSOA_EMITENTE IN (18800, 19000)))".
				   " AND USUCLI_USUAR_IDO = '" .$_SESSION['sId']. "'";
		if (trim($_GET['DT_INICIAL']) && trim($_GET['DT_FINAL']))
    		$Sql.= " AND PRENF_DATA_RECEBTO_AREZZO BETWEEN '" . strdata2db($_GET['DT_INICIAL']). "' AND '" . strdata2db($_GET['DT_FINAL']). "' ";
            $Sql.= " ORDER BY PRENF_NUMNFDEVOLUCAO, PRENF_SERIE";
	
	//$Stmt = mysql_query($Sql);
	
	$_pagi_sql = $Sql;
	
	include_once("inc/paginator.inc.php");
	
	while($Rs = mysql_fetch_assoc($_pagi_result)) { ?>
            <tr bordercolor="#00CCFF" class="tab_usuarios_info">
              <td width="3%"><div align="center"><input type="checkbox" name="ID" value="<?=$Rs["PRENF_NUMPRENF"]?>"></div></td>
              <td width="7%" class="listagem" ><div align="center"><?=$Rs["PRENF_NUMNFDEVOLUCAO"]?></div></td>
              <td width="10%" ><div align="center"><?=$Rs["DATANF"]?></div></td>
              <td width="10%" ><div align="center"><?=$Rs["PRENF_QTDEVOLUME"]?></div></td>
              <td width="10%"><div align="right"><?=$Rs["QTDE"]?></div></td>
              <td width="10%"><div align="right"><?=formatCurrency($Rs["VALOR"])?></div></td>
              <td width="10%"><div align="center"><?=$Rs["PRENF_PESSOA_DESTINATARIO"]?></div></td>
              <td width="40%"><?=$Rs["NOMECLIENTE"]?></td>
              </tr>
	<? } ?>
          </table>
          <div align="left">&nbsp;<a href="javascript:confirmar();" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image34','','imagens/imprimir2.jpg',1)"><img src="imagens/imprimir.jpg" alt="Imprimir relatório" name="Image34" width="78" height="20" border="0"></a><br>
          </div>
        </div>
		<? } ?>
		</td>
        </tr>
    </table>
</form>
	<br/ >
    <table width="748" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><p>P&aacute;ginas:&nbsp;<?= $_pagi_navegacion ?></p></td>
      </tr>
    </table>

	<br/ ><br/ >
	</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="100%" bgcolor="#333333" class="rodape"><?=$RodapeDesenvolvedor?></td>
    <td bgcolor="#333333">&nbsp;</td>
  </tr>
</table>

<script language="javascript" type="text/javascript">
<!--
function confirmar() {
	Values = chk_checkedAllValues(document.form1.ID,true);
	if (Values == "") {
		alert("Nenhuma nota fiscal assinalada !");
		return;
	}
	//document.location.href = "rel_fabrica_nfok.php?Ids=" + Values;
	document.form1.action = "rel_fabrica_nfok.php?Ids=" + Values;
	abrir_janela_popup('','windowPrint','width=800,height=540,top=0,left=0, scrollbars=yes,status=yes,resizable=yes,dependent=yes');
	document.form1.submit();
	
}

function chk_checkedAllValues(elementForm,checked,optionDiv,valueEncode) {
	if (elementForm) {
		if (elementForm.length == undefined) {
			if (elementForm.checked == checked)
				return elementForm.value;
			return "";
		}else{
			var Values = "";
			optionDiv = (optionDiv == undefined) ? "," : optionDiv;
			valueEncode = (valueEncode == undefined) ? false : valueEncode;
			for(x = 0; x < elementForm.length; x++) {
				if (elementForm[x].checked == checked) 
					Values+= ((Values.length > 0) ? optionDiv : "") + ((valueEncode) ? escape(elementForm[x].value) : elementForm[x].value);
			}
			return Values;
		}
	}
	return "";
}
//-->
</script>
<script language="javascript" type="text/javascript">
<!--
function FilterSearch() {
	if (!JSUtilValidaData(document.form.DT_INICIAL.value,false) || !JSUtilValidaData(document.form.DT_FINAL.value,false)) {
		alert("As datas informadas devem ser datas válidas !");
		return;
	}
	document.form.submit();
}
</script>