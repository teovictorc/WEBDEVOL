<? include("inc/headerI.inc.php"); 	

verifyAcess("DES_UTIL_HISTORICO","S");?>

<form name="form" method="post" action="util_lanca_historico_impok.php" enctype="multipart/form-data">

<table width="100%"  border="0" align="center">

     <tr>

       <td width="49%"><span class="titulo">:: Inser&ccedil;&atilde;o de reclama&ccedil;&atilde;o anterior - Improcedente:: </span></td>

       <td width="51%"><div align="right"><span class="titulo"><a href="javascript: abrir_help('#delprenf');">Help</a></span></div></td>

     </tr>

  </table></td>

   <td><img name="webdevol_r7_c11" src="imagens/img/webdevol_r7_c11.jpg" width="33" height="38" border="0" alt=""></td>

  </tr>

  <tr>

   <td background="imagens/img/webdevol_r8_c1.jpg">&nbsp;</td>

   <td colspan="9"><table width="100%"  border="0" class="tabela">

     <tr>

       <td width="19%" height="10" class="style2"><strong>C&oacute;digo do fabricante:</strong></td>

       <td width="81%" height="10">	   <span class="style2"><strong>18800</strong></span></td>

       </tr>

     <tr>

       <td height="10" class="style2"><strong>Categoria:</strong></td>

       <td height="10">         <select name="LANCA_CATEGORIA" class="campo_texto" id="LANCA_CATEGORIA">

         <option value="" selected>..Selecione</option>

         <option value="1">Cal&ccedil;ados</option>

         <option value="2">Bolsas-Cintos-Carteiras</option>

       </select></td>

     </tr>

     <tr>

       <td height="10" class="style2"><strong>C&oacute;digo do cliente: </strong></td>

       <td height="10"> <span class="style2"><strong>18800</strong></span></td>

     </tr>

     <tr>

       <td height="10" class="style2"><strong><strong>Data de avalia&ccedil;&atilde;o</strong>: </strong></td>

       <td height="10">         <input name="LANCA_DATAABERTURA" type="text" class="campo_texto" id="LANCA_DATAABERTURA" onKeyPress="return JSUtilApenasNumero(event);" onKeyUp="JSUtilMascara(this,event,'__/__/____');" size="11" maxlength="11"></td>

     </tr>

     <tr>

       <td height="10" class="style2"><strong>Quantidade:</strong></td>

       <td height="10">         <input name="ITEM_NUM33" type="text" align="center" class="campo_texto" id="ITEM_NUM33" size="10" maxlength="10" onKeyPress="return JSUtilApenasNumero(event);""></td>

     </tr>

     <tr>

       <td height="10" class="style2"><strong>Valor total: </strong></td>

       <td height="10">

         <input name="ITEM_VALOR" type="text" align="center" class="campo_texto" id="ITEM_VALOR" size="10" maxlength="10" onKeyPress="return JSUtilApenasNumero(event);""></td>

     </tr>

     <tr>

       <td height="10" class="style2">&nbsp;</td>

       <td height="10">&nbsp;</td>

     </tr>

     <tr>

       <td colspan="2"> 

	   <div id="idButtons" style="display:" align="center">

	   <a href="javascript:verificaForm(document.form);" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image351','','imagens/gravar2.jpg',1)"><img src="imagens/gravar.jpg" name="Image351" width="58" height="20" border="0" id="Image351"></a><a href="pesq_defeitos.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image361','','imagens/cancelar2.jpg',1)"><img src="imagens/cancelar.jpg" name="Image361" width="68" height="20" border="0" id="Image361"></a></div></td>

       </tr>

   </table>

   <input type="hidden" name="TOTAL_ITENS" value="15">



<? include("inc/headerF.inc.php"); ?>

<script language="javascript" type="text/javascript">

<!--

function verificaForm(formObj) {

	if (formObj.LANCA_CATEGORIA.value == "") {

		alert("Preencha o campo \"CATEGORIA\"");

		return;

	}

	

	if (formObj.LANCA_DATAABERTURA.value == "") {

		alert("Preencha o campo \"DATA DE AVALIAÇÃO\"");

		return;

	}

	

	if (formObj.ITEM_NUM33.value == "") {

		alert("Preencha o campo \"QUANTIDADE\"");

		return;

	}

	

	if (formObj.ITEM_VALOR.value == "") {

		alert("Preencha o campo \"VALOR\"");

		return;

	}

	

	document.getElementById("idButtons").style.display = "none";

	

	formObj.action = "util_lanca_historico_impok.php";

	document.form.submit();

}





//-->

</script>

</form>