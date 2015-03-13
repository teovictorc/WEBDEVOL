<? include("inc/headerI.inc.php"); 	

verifyAcess("DES_UTIL_IMPORT_DATA","S");?>



<form name="form" method="post" action="util_import_dataok.php">

<table width="100%"  border="0" align="center">

     <tr>

       <td width="49%"><span class="titulo">:: Voltar pré-nota para importação ::</span></td>

       <td width="51%"><div align="right"><span class="titulo"><a href="javascript: abrir_help('#delprenf');">Help</a></span></div></td>

     </tr>

  </table></td>

   <td><img name="webdevol_r7_c11" src="imagens/img/webdevol_r7_c11.jpg" width="33" height="38" border="0" alt=""></td>

  </tr>

  <tr>

   <td background="imagens/img/webdevol_r8_c1.jpg">&nbsp;</td>

   <td colspan="9"><table width="100%"  border="0" class="tabela">

     <tr>

       <td width="34%" height="10" class="style2"><strong>Número da nota fiscal:</strong></td>

       <td width="66%" height="10"><input name="nf" type="text" class="campo_texto" id="PRENOTA" value="<?=$_GET['NOME']?>" size="10"></td>

     </tr>

	 <tr>

       <td width="34%" height="10" class="style2"><strong>Código do cliente:</strong></td>

       <td width="66%" height="10"><input name="cod_cli" type="text" class="campo_texto" id="cod_cli" value="<?=$_GET['cod_cli']?>" size="10"></td>

     </tr>

     <tr>

       <td colspan="2"> 

	   <div id="idButtons" style="display:" align="center">

	   <a href="javascript:verificaForm(document.form);" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image351','','imagens/gravar2.jpg',1)"><img src="imagens/gravar.jpg" name="Image351" width="58" height="20" border="0" id="Image351"></a><a href="principal.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image361','','imagens/cancelar2.jpg',1)"><img src="imagens/cancelar.jpg" name="Image361" width="68" height="20" border="0" id="Image361"></a></div></td>

       </tr>

   </table>

</form>

<? include("inc/headerF.inc.php"); ?>

<script language="javascript" type="text/javascript">

<!--

function verificaForm(formObj) {





	if (formObj.nf.value == "") {

		alert("O Campo 'Número da nota fical' é Obrigatório !");

		return;

	}

	if (formObj.cod_cli.value == "") {

		alert("O Campo 'Código do cliente' é Obrigatório !");

		return;

	}

	document.getElementById("idButtons").style.display = "none";

	

	formObj.action = "util_import_dataok.php";

	document.form.submit();

}





//-->

</script>

