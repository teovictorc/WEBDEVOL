<? include("inc/headerI.inc.php"); 	

verifyAcess("DES_UTILITARIO_PRENF","S");?>

<form name="form" method="post" action="util_deleta_prenotaok.php" enctype="multipart/form-data">

<table width="100%"  border="0" align="center">

     <tr>

       <td width="49%"><span class="titulo">:: Excluir pr&eacute;-nota gerada :: </span></td>

       <td width="51%"><div align="right"><span class="titulo"><a href="javascript: abrir_help('#delprenf');">Help</a></span></div></td>

     </tr>

  </table></td>

   <td><img name="webdevol_r7_c11" src="imagens/img/webdevol_r7_c11.jpg" width="33" height="38" border="0" alt=""></td>

  </tr>

  <tr>

   <td background="imagens/img/webdevol_r8_c1.jpg">&nbsp;</td>

   <td colspan="9"><table width="100%"  border="0" class="tabela">

     <tr>

       <td width="15%" height="10" class="style2"><strong>N.&ordm; Pr&eacute;-nota:</strong></td>

       <td width="85%" height="10">         <input name="PRENOTA" type="text" class="campo_texto" id="PRENOTA" value="<?=$_GET['NOME']?>" size="50" maxlength="50"></td>

       </tr>

     <tr>

       <td height="10" class="style2">&nbsp;</td>

       <td height="10">&nbsp;</td>

     </tr>

     <tr>

       <td height="10" class="style2">Solicitante</td>

       <td height="10"><input name="SOLICITANTE" type="text" class="campo_texto" id="SOLICITANTE" value="<?=$_GET['SOLICITANTE']?>" size="50" maxlength="50"></td>

     </tr>

     <tr>

       <td height="10" valign="top" class="style2">Motivo</td>

       <td height="10"><input name="MOTIVO" type="text" class="campo_texto" id="MOTIVO" value="<?=$_GET['MOTIVO']?>" size="80"></td>

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

</form>

<? include("inc/headerF.inc.php"); ?>

<script language="javascript" type="text/javascript">

<!--

function verificaForm(formObj) {



	if (formObj.PRENOTA.value == "") {

		alert("Preencha o campo \"Número da pré-nota a ser excluída\"");

		formObj.PRENOTA.focus();

		return;

	}

	

	if (formObj.SOLICITANTE.value == "") {

		alert("Preencha o campo \"Solicitante\"");

		formObj.SOLICITANTE.focus();

		return;

	}

	

	if (formObj.MOTIVO.value == "") {

		alert("Preencha o campo \"Motivo\"");

		formObj.MOTIVO.focus();

		return;

	}

	document.getElementById("idButtons").style.display = "none";

	

	formObj.action = "util_deleta_prenotaok.php";

	document.form.submit();

}





//-->

</script>

