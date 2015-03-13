<? include("inc/headerI.inc.php"); 	

verifyAcess("DES_UTIL_ALT_NNF","S");?>

<script language="javascript" type="text/javascript">

<!--

function verificaForm(formObj) {





	if (formObj.prenf.value == "") {

		alert("O Campo 'Número da Pré-Nota' é Obrigatório !");

		return;

	}

	if (formObj.novon.value == "") {

		alert("O Campo 'Novo número da nota fiscal' é Obrigatório !");

		return;

	}

	document.getElementById("idButtons").style.display = "none";

	

	formObj.action = "util_alt_nnotaok.php";

	document.form.submit();

}





//-->

</script>

<form name="form" method="post" action="util_alt_nnotaok.php">

<table width="100%"  border="0" align="center">

     <tr>

       <td width="49%"><span class="titulo">:: Alterar número da Nota Fiscal ::</span></td>

       <td width="51%"><div align="right"><span class="titulo"><a href="javascript: abrir_help('#altnumprenf');">Help</a></span></div></td>

     </tr>

  </table></td>

   <td><img name="webdevol_r7_c11" src="imagens/img/webdevol_r7_c11.jpg" width="33" height="38" border="0" alt=""></td>

  </tr>

  <tr>

   <td background="imagens/img/webdevol_r8_c1.jpg">&nbsp;</td>

   <td colspan="9"><table width="100%"  border="0" class="tabela">

     <tr>

       <td width="34%" height="10" class="style2"><strong>Número da pré-nota:</strong></td>

       <td width="66%" height="10"><input name="prenf" type="text" class="campo_texto" id="PRENOTA" size="10"></td>

     </tr>

	 <tr>

       <td width="34%" height="10" class="style2"><strong>Novo número da nota fiscal:</strong></td>

       <td width="66%" height="10"><input name="novon" type="text" class="campo_texto" id="cod_cli" size="10"></td>

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



