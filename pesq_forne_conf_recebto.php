<? include("inc/headerI.inc.php"); 

verifyAcess("FORN_CONFRECBTO","S");

?>

<form name="form" method="post" action="#">

<tr>

    <td height="100%" valign="top" class="tab_conteudo">

    <table width="100%" border="0" cellspacing="0" cellpadding="0">

      <tr>

        <td height="32" class="tab_titulo"><h4>Confirma&ccedil;&atilde;o de recebimento NF</h4></td>

		<td height="32" class="tab_titulo">Assinale a NF que deseja confirmar o recebto e clique em CONFIRMAR</td>

      </tr>

      </table>  



    <table width="100%"  border="0">

      <tr>

        <td width="100%"> <div align="center">

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

			       " date_format(PRENF_DATA_INFNFDEVOLUCACAO,'%d/%m/%Y') DATANF, ".

			       " round(PRENF_QTDEVOLUME,0) PRENF_QTDEVOLUME, ".

				   " NOME NOMECLIENTE, ".

			       "(SELECT round(SUM(PRENFI_QUANTIDADE),0) QTDE FROM rar_prenf_item WHERE PRENFI_NUMPRENF = PRENF_NUMPRENF GROUP BY PRENF_PESSOA_EMITENTE) QTDE, ".

			       "(SELECT round(SUM(PRENFI_QUANTIDADE * PRENFI_VALORUNITARIO),2) VALOR FROM rar_prenf_item WHERE PRENFI_NUMPRENF = PRENF_NUMPRENF GROUP BY PRENF_PESSOA_EMITENTE) VALOR ".

			" FROM rar_prenf, pessoa, rar_usuarioxcliente ".

			"WHERE PESSOA = PRENF_PESSOA_DESTINATARIO ".

			       " AND PRENF_DATA_RECEBTO_COLETA IS NOT NULL ".

				   " AND PRENF_DATA_RECEBTO_AREZZO IS NULL ".

			       " AND USUCLI_PESSOA = PRENF_PESSOA_DESTINATARIO ".

				   //" AND PRENF_CATEGORIA = '2'".

				   " AND PRENF_PESSOA_EMITENTE IN (SELECT USUFOR_PESSOA FROM rar_usuarioxfornecedor WHERE USUFOR_USUAR_IDO = '" .$_SESSION['sId']. "')". 

				   " AND USUCLI_USUAR_IDO = '" .$_SESSION['sId']. "'".

				   " AND PRENF_PESSOA_EMITENTE NOT IN (18800, 19000)".

		    " ORDER BY PRENF_NUMNFDEVOLUCAO, PRENF_SERIE";
	//die($Sql);
	$Stmt = mysql_query($Sql);

	while($Rs = mysql_fetch_assoc($Stmt)) { ?>

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

          <div align="left">&nbsp;<a href="javascript:confirmar();"><img src="imagens/confirmar.jpg" alt="Confirmar recebimento da NF assinalada" name="Image34" width="59" height="22" border="0"></a><br>

          </div>

        </div></td>

        </tr>

    </table>

</form>

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

	document.location.href = "pesq_forne_conf_recebtook.php?Ids=" + Values;

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