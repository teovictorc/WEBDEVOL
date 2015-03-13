<? include("inc/headerI.inc.php"); 

verifyAcess("INCRECLAMACAO","S");



$_pagi_sql = "SELECT LANCA_NUMRAR, PESSOA,  ".

			       " date_format(LANCA_DATAABERTURA,'%d/%m/%Y') DATANF, ".

				   " NOME NOMECLIENTE ".

			"FROM rar_lancamento, pessoa, rar_usuarioxcliente, rar_avaliacao ".

			"WHERE PESSOA = LANCA_PESSOA ".

			       " AND AVALI_NUMRAR = LANCA_NUMRAR ".

				   " AND AVALI_SITUACAO IS NULL ".

			       " AND USUCLI_PESSOA = LANCA_PESSOA ".

				   " AND USUCLI_USUAR_IDO = '" .$_SESSION['sId']. "'".

		    " ORDER BY LANCA_NUMRAR";



include_once("inc/paginator.inc.php");

?>

<form name="form" method="post" action="#">

<tr>

    <td height="100%" valign="top" class="tab_conteudo">

    <table width="100%" border="0" cellspacing="0" cellpadding="0">

      <tr>

        <td height="100%" class="tab_titulo"><h4>Cancelamento de reclama&ccedil;&atilde;o</h4></td>

      </tr>

    </table>

    <table width="100%"  border="0">

      <tr>

        <td width="100%"> <div align="center">

        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tab_cadastro">

		  <tr>

		<!--	<td width="250" colspan="3" align="left"><a href="#" onClick="javascript: deleteById('pesq_cancelamentook.php', document.form.ID);"><img src="../img/bts/apagar.jpg" width="20" height="20" border="0" align="absmiddle" alt="Apagar selecionadas" /></a> Apagar selecionadas</td>-->

			<td width="220"><?=mysql_num_rows($_pagi_result)?> Registros</td>

			<td><input type="text" name="busca" id="textfield" class="busca" value="<?=$_GET["busca"];?>" /> <a href="#" onClick="javascript: if (document.form.textfield.value.length >0 ){ setSubmit('procurar', document.form.textfield.value); }"><img src="../img/bts/buscar.jpg" alt="Buscar" border="0" align="absmiddle" /></a><a href="cad_operadorloja.php"><img src="../img/bts/incluir.jpg" alt="Incluir" border="0" align="absmiddle" /></a></td>

		  </tr>

		</table>

		  <table width="100%"  border="0" align="center" class="tab_inclusao" cellpadding="0" cellspacing="0">

            <tr class="tab_usuarios" >

              <td width="2%" ><div align="center"><img src="../img/bts/selecionar.jpg" border="0" /></div></td>

              <td width="12%" ><div align="center">N&ordm; Reclama&ccedil;&atilde;o </div></td>

              <td width="10%" ><div align="center">Data Abertura </div></td>

              <td width="12%" ><div align="center">C&oacute;digo cliente </div></td>

              <td width="56%" >Nome do Cliente </td>

			  <td width="8%" align="center"><strong>Op&ccedil;&otilde;es</strong></td>

            </tr>

<? 

	while($Rs = mysql_fetch_assoc($_pagi_result)) { ?>

            <tr bordercolor="#00CCFF" class="tab_usuarios_info">

              <td width="2%"><div align="center"><input type="checkbox" name="ID" value="'<?=$Rs["LANCA_NUMRAR"]?>'">

              </div></td>

              <td width="12%" class="listagem" ><div align="center"><?=$Rs["LANCA_NUMRAR"]?></div></td>

              <td width="10%" ><div align="center"><?=$Rs["DATANF"]?></div></td>

              <td width="12%"><div align="center"><?=$Rs["PESSOA"]?></div></td>

              <td width="56%"><?=$Rs["NOMECLIENTE"]?></td>

              <td><a href="#" onClick="javascript: deleteById('pesq_cancelamentook.php', '<?=$Rs["LANCA_NUMRAR"]?>');"><img src="../img/bts/apagar.jpg" alt="Excluir" width="20" height="20" border="0" /></a></td>

			  </tr>

	<? } ?>

          </table>

          <!--<div align="left">&nbsp;<a href="javascript:confirmar();" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image34','','imagens/excluir2.jpg',1)"><img src="imagens/excluir.jpg" alt="Confirmar recebimento da NF assinalada" name="Image34" width="68" height="20" border="0"></a><br>

          </div>

        </div>-->

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

	Values = chk_checkedAllValues(document.form.ID,true);

	if (Values == "") {

		alert("Nenhuma reclamção assinalada !");

		return;

	}

	document.location.href = "pesq_cancelamentook.php?Ids=" + Values;

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

</body>

</html>