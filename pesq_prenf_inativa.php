<? include("inc/headerI.inc.php");
if ("S" == $_GET['cliente']){
	verifyAcess("CLIEN_INATIVAPRENF","S");
}else{
	verifyAcess("ADMV_INATIVAPRENF","S");
}
?>
<link href="wfa.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/JavaScript">
<!--



function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
//-->
</script>
<form name="form" method="get" action="pesq_nf_emitir.php">
<tr>
    <td height="100%" valign="top" class="tab_conteudo">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="100%" class="tab_titulo"><h4>Consulta de pr&eacute;-notas inativas</h4></td>
      </tr>
    </table>
    <table width="100%"  border="0" class="tab_inclusao">
      <tr>
        <td width="100%"> <div align="center">
          <table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
        <td colspan="8"><div align="center" class="tab_conteudo"><strong>Assinale as pr&eacute;-notas que deseja ativar e clique em CONFIRMAR</strong></div></td>
      </tr>
            <tr class="tab_usuarios" >
				<? if ("S" != $_GET['cliente']){ ?>
              		<td width="3%" ><div align="center"><img src="../img/bts/selecionar.jpg" border="0" /></div></td>
			  	<? } ?>
              <td width="10%" ><div align="center">Dias atraso</div></td>
              <td width="12%" height="25" ><div align="center">N&ordm; Pr&eacute;-nota</div></td>
              <td width="9%" ><div align="center">Data inativa&ccedil;&atilde;o </div></td>
              <td width="38%" >Cliente</td>
              <td width="5%" ><div align="center">CFOP</div></td>
              <td width="8%" ><div align="center">Qtde Pares </div></td>
              <td width="15%" ><div align="right">Valor total </div></td>
            </tr>
<?
	$Sql = "SELECT PRENF_PESSOA_DESTINATARIO, ".
	               " PRENF_NUMPRENF, ".
				   " PRENF_AUTOR_NUMAUT, ".
			       " PRENF_NUMNFDEVOLUCAO,".
				   " PRENF_CFOP, ".
			       " date_format(PRENF_INATIVADO_DATA,'%d/%m/%Y') PRENF_INATIVADO_DATA, ".
				   " datediff(PRENF_INATIVADO_DATA, prenf_data_envio) DIAS_ATRASO, ".
			       " PRENF_QTDEVOLUME, ".
				   " NOME NOMECLIENTE, ".
			       " (SELECT round(SUM(PRENFI_QUANTIDADE),0) QTDE ".
				   "    FROM rar_prenf_item ".
			       "   WHERE PRENFI_NUMPRENF = PRENF_NUMPRENF ".
				   "GROUP BY PRENF_PESSOA_EMITENTE) QTDE, ".
			       " (SELECT round(SUM(PRENFI_QUANTIDADE * PRENFI_VALORUNITARIO),2) VALOR ".
				   "    FROM rar_prenf_item ".
			       "   WHERE PRENFI_NUMPRENF = PRENF_NUMPRENF ".
				   "GROUP BY PRENF_PESSOA_EMITENTE) VALOR ".
			  " FROM rar_prenf, pessoa, rar_autorizacao, rar_usuarioxcliente ".
			 " WHERE PESSOA = PRENF_PESSOA_DESTINATARIO ".
			 "       AND PRENF_AUTOR_NUMAUT = AUTOR_NUMAUT ".
			 "       AND PRENF_NUMNFDEVOLUCAO IS NULL ".
			 "       AND USUCLI_PESSOA = PRENF_PESSOA_DESTINATARIO ".
			 "       AND PRENF_STATUS = 'I'".
			 "       AND USUCLI_USUAR_IDO = '" .$_SESSION['sId']. "'";

	
	$Sql.= " ORDER BY AUTOR_DATAAUTORIZACAO, AUTOR_NUMAUT, PRENF_NUMPRENF";
	
	$_pagi_sql = $Sql;
	
	include_once("inc/paginator.inc.php");
	
	//$Stmt = mysql_query($Sql);
	$TotalReclamacao = 0;
	$TotalPares = 0;
	while($Rs = mysql_fetch_assoc($_pagi_result)) {
			$TotalReclamacao = $TotalReclamacao + 1;
		    $TotalPares = $TotalPares + $Rs["QTDE"];
		    ?>
			<tr bordercolor="#00CCFF" class="tab_usuarios_info" >
				<? if ("S" != $_GET['cliente']){ ?>
			  		<td align="center"><input type="checkbox" name="ID" value="<?=$Rs["PRENF_NUMPRENF"]?>"></td>
			  	<? } ?>
			  <td align="center"><div align="center"><a href="consulta_pre_nota.php?cliente=<?=$_GET['cliente']?>&Destino=2&Id=<?=$Rs["PRENF_NUMPRENF"]?>">
                  <?=$Rs["DIAS_ATRASO"]?>
              </a></div></td>
              <td align="center"><?=$Rs["PRENF_NUMPRENF"]?></td>
              <td align="center"><?=$Rs["PRENF_INATIVADO_DATA"]?></td>
              <td><?=$Rs["PRENF_PESSOA_DESTINATARIO"]?> - <?=$Rs["NOMECLIENTE"]?></td>
              <td align="center"><?=$Rs["PRENF_CFOP"]?></td>
              <td align="right"><?=$Rs["QTDE"]?></td>
              <td><div align="right">R$<?=formatCurrency($Rs["VALOR"])?></div></td>
            </tr>

<? } ?>
          </table>
          <table width="100%"  border="0" align="center" class="">
            <tr>
              <td width="20%"><div align="center"> </div></td>
              <td width="20%"><div align="right"></div></td>
              <td width="60%"><div align="center" class="style1">
				<div align="right"><strong class="style1">Resumo da pesquisa</strong>: Total de pr&eacute;-notas:<?=$TotalReclamacao?>&nbsp;- Total de pares:<?=$TotalPares?>
                  </div>
                </div>
                  <div align="center" class="style1">
                    <div align="right"></div>
                </div></td>
            </tr>
          </table>
        </div></td>
        </tr>
      <tr>
        <td><a href="javascript:confirmar();" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image34','','imagens/confirmar2.jpg',1)"><img src="imagens/confirmar.jpg" alt="Confirmar recebimento da NF assinalada" name="Image34" width="79" height="22" border="0"></a></td>
      </tr>
    </table>
	<br/ >
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
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

</form>

<script language="javascript" type="text/javascript">
<!--

function confirmar() {
	Values = chk_checkedAllValues(document.form.ID,true);
	if (Values == "") {
		alert("Nenhuma reclamção assinalada !");
		return;
	}
	document.location.href = "pesq_prenf_inativaok.php?Ids=" + Values;
}

function FilterSearch() {
	if (document.form.DT_INICIAL.value == "" || document.form.DT_FINAL.value == "") {
		alert("Preencha os campos data final e inicial");
		return;
	}
	if (!JSUtilValidaData(document.form.DT_INICIAL.value,false) || !JSUtilValidaData(document.form.DT_FINAL.value,false)) {
		alert("As datas informadas devem ser datas validas !");
		return;
	}
	document.form.submit();
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