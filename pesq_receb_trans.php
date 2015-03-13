<? include("inc/headerI.inc.php");
verifyAcess("TRANS_CONFTRANSCONT","S");?>
<form name="form" method="post" action="#">
<tr>
    <td height="100%" valign="top" class="tab_conteudo">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="100%" class="tab_titulo"><h4>Confirma&ccedil;&atilde;o de recebimento</h4></td>
      </tr>
    </table>
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="100%"> <div align="center">
          <table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
            <tr class="tab_usuarios" >
              <td width="3%" ><div align="center"><img src="../img/bts/selecionar.jpg" border="0" /></div></td>
              <td width="7%" ><div align="center"><a href="pesq_receb_trans.php?Ordem=1&Categoria=<?=$_GET["Categoria"]?>">N&ordm; NF</a></div></td>
              <td width="10%" ><div align="center"><a href="pesq_receb_trans.php?Ordem=2&Categoria=<?=$_GET["Categoria"]?>">Data NF</a></div></td>
              <td width="5%" ><div align="center">Qtde <br>
                Vol.</div></td>
              <td width="5%" ><div align="center">Qtde <br>
                Pares </div></td>
              <td width="10%" ><div align="center">Valor <br>
                total </div></td>
              <td width="40%" >Nome do Cliente </td>
              <td width="25%" >Cidade/UF</td>
            </tr>
<?
	if ($_GET["Categoria"] == "1"){
		$Criterio = " AND PRENF_PESSOA_EMITENTE IN (18800,19000)";
	}else{
		$Criterio = " AND PRENF_PESSOA_EMITENTE NOT IN (18800,19000)";
	}
	
	$_pagi_sql = "SELECT CGCCPF CNPJ, PRENF_PESSOA_DESTINATARIO, ".
	               " PRENF_NUMPRENF, ".
			       " PRENF_NUMNFDEVOLUCAO, ".
			       " date_format(PRENF_DATA_INFNFDEVOLUCACAO,'%d/%m/%Y') DATANF, ".
			       " ROUND(PRENF_QTDEVOLUME,0) AS PRENF_QTDEVOLUME, ".
				   " NOME NOMECLIENTE, ".
				   " NM_MUNICIPIO CIDADE, ".
				   " SG_UF UF, ".
			       " (SELECT ROUND(SUM(PRENFI_QUANTIDADE),0) QTDE FROM rar_prenf_item WHERE PRENFI_NUMPRENF = PRENF_NUMPRENF GROUP BY PRENF_PESSOA_EMITENTE) QTDE, ".
			       " (SELECT ROUND(SUM(PRENFI_QUANTIDADE * PRENFI_VALORUNITARIO),2) VALOR FROM rar_prenf_item WHERE PRENFI_NUMPRENF = PRENF_NUMPRENF GROUP BY PRENF_PESSOA_EMITENTE) VALOR ".
			" FROM rar_prenf, pessoa, rar_usuarioxcliente ".
			" WHERE PESSOA = PRENF_PESSOA_DESTINATARIO ".
			        " AND PRENF_DATA_COLETA IS NOT NULL ".
					" AND PRENF_DATA_RECEBTO_COLETA IS NULL ".
			        " AND USUCLI_PESSOA = PRENF_PESSOA_DESTINATARIO ".
					//" AND PRENF_CATEGORIA = ".$_GET["Categoria"].
				   $Criterio.
					" AND PRENF_PESSOA_EMITENTE IN (SELECT USUFOR_PESSOA FROM rar_usuarioxfornecedor WHERE USUFOR_USUAR_IDO = '" .$_SESSION['sId']. "')".
					" AND USUCLI_USUAR_IDO = '" .$_SESSION['sId']. "'";
			if ($_GET["Ordem"] == ""){
		    	$Sql.= " ORDER BY PRENF_DATA_INFNFDEVOLUCACAO, PRENF_NUMNFDEVOLUCAO";
			}

			if ($_GET["Ordem"] == 1){
		    	$Sql.= " ORDER BY PRENF_NUMNFDEVOLUCAO, PRENF_DATA_NFDEVOLUCAO";
			}

			if ($_GET["Ordem"] == 2){
		    	$Sql.= " ORDER BY PRENF_DATA_INFNFDEVOLUCACAO, PRENF_NUMNFDEVOLUCAO";
			}

	include_once("inc/paginator.inc.php");

	//$Stmt = mysql_query($Sql);
	while($Rs = mysql_fetch_assoc($_pagi_result)) { 
		if ($Cor == ""){
			$Cor = "#f5f5f5";
		}else{
			$Cor = "";
		}
		?>
            <tr bgcolor="<?=$Cor?>" class="tab_usuarios_info">
              <td><div align="center"><input type="checkbox" name="ID" value="<?=$Rs["PRENF_NUMPRENF"]?>"></div></td>
              <td class="listagem" ><div align="center"><?=$Rs["PRENF_NUMNFDEVOLUCAO"]?></div></td>
              <td ><div align="center"><?=$Rs["DATANF"]?></div></td>
              <td ><div align="center"><?=$Rs["PRENF_QTDEVOLUME"]?></div></td>
              <td><div align="right"><?=$Rs["QTDE"]?></div></td>
              <td><div align="right"><?=formatCurrency($Rs["VALOR"])?></div></td>
              <td><?=$Rs["PRENF_PESSOA_DESTINATARIO"]?> -                 <?=$Rs["NOMECLIENTE"]?>
                (
                <?=FormataCnpj($Rs["CNPJ"])?>
) </td>
              <td><?=$Rs["CIDADE"]?>
                /
                  <?=$Rs["UF"]?></td>
            </tr>
	<? } ?>
          </table>
		  <? if (returnAcess('TRANS_CONFTRANS_CON') == 'N'){ ?>
          	<div align="left">&nbsp;<a href="javascript:confirmar();" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image34','','imagens/confirmar2.jpg',1)"><img src="imagens/confirmar.jpg" alt="Confirmar recebimento da NF assinalada" name="Image34" width="79" height="22" border="0"></a><br></div>
			<? } ?>
        </div></td>
        </tr>
    </table>
</form>
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

<script language="javascript" type="text/javascript">
<!--
function confirmar() {
	Values = chk_checkedAllValues(document.form.ID,true);
	if (Values == "") {
		alert("Nenhuma reclamção assinalada !");
		return;
	}
	document.location.href = "pesq_receb_transok.php?Categoria=<?=$_GET['Categoria']?>&Ordem=<?=$_GET['Ordem']?>&Ids=" + Values;
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