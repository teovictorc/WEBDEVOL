<? include("inc/headerI.inc.php"); 	

verifyAcess("DES_UTIL_CONFIG","S");



	$Sql = "SELECT * FROM RAR_CONFIG ";

	$Stmt = mysql_query($Sql);

	

	if ($Rs = mysql_fetch_assoc($Stmt)) {

		$CONFIG_MM_LIMITECOLETA = $Rs["CONFIG_MM_LIMITECOLETA"];

		$CONFIG_FR_LIMITECOLETA = $Rs["CONFIG_FR_LIMITECOLETA"];

	}



?>

<form name="form" method="post" action="util_configok.php" enctype="multipart/form-data">

<table width="100%"  border="0" align="center">

     <tr>

       <td width="49%"><span class="titulo">:: Configura&ccedil;&otilde;es gerais:: </span></td>

       <td width="51%"><div align="right"><span class="titulo"><a href="javascript: abrir_help('#delprenf');">Help</a></span></div></td>

     </tr>

  </table></td>

   <td><img name="webdevol_r7_c11" src="imagens/img/webdevol_r7_c11.jpg" width="33" height="38" border="0" alt=""></td>

  </tr>

  <tr>

   <td background="imagens/img/webdevol_r8_c1.jpg">&nbsp;</td>

   <td colspan="9"><table width="100%"  border="0" class="tabela">

     <tr>

       <td width="50%" height="10" class="style2"><strong>Qtde pares para pr&eacute;-nota autom&aacute;tica Franquia:</strong></td>

       <td width="66%" height="10">         <input name="CONFIG_FR_LIMITECOLETA" type="text" class="campo_texto" id="CONFIG_FR_LIMITECOLETA" value="<?=$CONFIG_FR_LIMITECOLETA?>" size="5" maxlength="5"></td>

       </tr>

     <tr>

       <td height="10" class="style2"><strong>Qtde pares para pr&eacute;-nota autom&aacute;tica Multimarca:</strong></td>

       <td height="10">

         <input name="CONFIG_MM_LIMITECOLETA" type="text" class="campo_texto" id="CONFIG_MM_LIMITECOLETA" value="<?=$CONFIG_MM_LIMITECOLETA?>" size="5" maxlength="5"></td>

     </tr>

     <tr>

       <td colspan="2"> 

	   <div id="idButtons" style="display:" align="center">

	   <a href="javascript:verificaForm(document.form);" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image351','','imagens/gravar2.jpg',1)"><img src="imagens/gravar.jpg" name="Image351" width="58" height="20" border="0" id="Image351"></a></div></td>

       </tr>

   </table>

   <input type="hidden" name="TOTAL_ITENS" value="15">

</form>

<? include("inc/headerF.inc.php"); ?>

<script language="javascript" type="text/javascript">

<!--

function verificaForm(formObj) {



	if (formObj.CONFIG_MM_LIMITECOLETA.value == "" || formObj.CONFIG_MM_LIMITECOLETA.value == "0") {

		alert("Preencha o campo \"Qtde pares pré-nota multimarca\"");

		return;

	}

	if (formObj.CONFIG_FR_LIMITECOLETA.value == "" || formObj.CONFIG_FR_LIMITECOLETA.value == "0") {

		alert("Preencha o campo \"Qtde pares pré-nota Franquia\"");

		return;

	}

	document.getElementById("idButtons").style.display = "none";

	

	formObj.action = "util_configok.php";

	document.form.submit();

}





//-->

</script>

