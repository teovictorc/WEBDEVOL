<? include("inc/headerI.inc.php"); 	

verifyAcess("UTIL_ALTEREMIT_PRENF","S");?>

<script language="javascript" type="text/javascript">

<!--

function verificaForm(formObj) {





	if (formObj.prenf_numnfdevolucao.value == "") {

		alert("O Campo 'Número da NF' é Obrigatório !");

		return;

	}

	if (formObj.prenf_pessoa_destinatario.value == "") {

		alert("O Campo 'Código do cliente' é Obrigatório !");

		return;

	}

	if (formObj.prenf_pessoa_emitente.value == "") {

		alert("O Campo 'Novo código do emitente' é Obrigatório !");

		return;

	}

	document.getElementById("idButtons").style.display = "none";

	

	formObj.action = "util_alt_emitente_prenotaok.php";

	document.form.submit();

}





//-->

</script>



<form name="form" method="post" action="util_alt_emitente_prenotaok.php">

<table width="100%"  border="0" align="center">

     <tr>

       <td width="60%"><span class="titulo">:: Alteração de emitente de pré-nota ::</span></td>

       <td width="40%"><div align="right"><span class="titulo"></span></div></td>

     </tr>

  </table></td>

   <td><img name="webdevol_r7_c11" src="imagens/img/webdevol_r7_c11.jpg" width="33" height="38" border="0" alt=""></td>

  </tr>

  <tr>

   <td background="imagens/img/webdevol_r8_c1.jpg">&nbsp;</td>

   <td colspan="9"><table width="100%"  border="0" class="tabela">

     <tr>

       <td width="34%" height="10" class="style2"><strong>Número da NF:</strong></td>

       <td width="66%" height="10"><input name="prenf_numnfdevolucao" type="text" class="campo_texto" id="prenf_numnfdevolucao" size="10"></td>

     </tr>

     <tr>

       <td height="10" class="style2"><strong>C&oacute;digo do cliente: </strong></td>

       <td height="10"><input name="prenf_pessoa_destinatario" type="text" class="campo_texto" id="prenf_pessoa_destinatario" size="10"></td>

     </tr>

     <tr>

      <td class="style2"><strong>Novo código do emitente:</strong></td>

      <td colspan="6"><input name="prenf_pessoa_emitente" type="text" class="campo_texto" id="lanca_fabri_ido" value="<?=$Rs["prenf_pessoa_emitente"]?>" size="10" maxlength="10"></td>

     </tr>

     <tr>

       <td colspan="2">

	   <br> 

	   <div id="idButtons" style="display:" align="center">

	   <a href="javascript:verificaForm(document.form);" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image352','','imagens/gravar3.jpg',1)"><img src="imagens/gravar.jpg" name="Image351" width="58" height="20" border="0" id="Image351"></a><a href="principal.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image361','','imagens/cancelar2.jpg',1)"><img src="imagens/cancelar.jpg" name="Image361" width="68" height="20" border="0" id="Image361"></a></div></td>

       </tr>

   </table>

</form>

  <?

  include("inc/headerF.inc.php");

  ?>



