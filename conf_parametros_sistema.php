<? include("inc/headerI.inc.php"); 

	verifyAcess("CONFIG_PARAMETRO","S");

	$Stmt = mysql_query("SELECT * FROM RAR_CONFIG");



	if ($Rs = mysql_fetch_assoc($Stmt)) {

		$CONFIG_EMAIL_ASSISTENTE = $Rs["CONFIG_EMAIL_ASSISTENTE"];

		$CONFIG_EMAIL_REVISOR = $Rs["CONFIG_EMAIL_REVISOR"];

		$CONFIG_EMAIL_GERENTE = $Rs["CONFIG_EMAIL_GERENTE"];

		$CONFIG_EMAIL_DIRETOR = $Rs["CONFIG_EMAIL_DIRETOR"];

		$CONFIG_EMAIL_PRESIDENTE = $Rs["CONFIG_EMAIL_PRESIDENTE"];

		$CONFIG_EMAIL_TRANSPORTADORA = $Rs["CONFIG_EMAIL_TRANSPORTADORA"];

	} ?>

<form name="form" method="post" action="" enctype="application/x-www-form-urlencoded">

<table width="100%"  border="0" align="center">

     <tr>

       <td width="49%"><span class="titulo">:: Configura&ccedil;&atilde;o de par&acirc;metros do sistema::</span></td>

       <td width="51%"><div align="right"></div></td>

     </tr>

   </table></td>

   <td><img name="webdevol_r7_c11" src="imagens/img/webdevol_r7_c11.jpg" width="33" height="38" border="0" alt=""></td>

  </tr>

  <tr>

   <td background="imagens/img/webdevol_r8_c1.jpg">&nbsp;</td>

   <td colspan="9">

    <table width="100%"  border="0" class="tabela">

      <tr>

        <td width="25%" class="style2"><strong>Email da transportadora*</strong></td>

        <td width="75%"><input name="CONFIG_EMAIL_TRANSPORTADORA" type="text" class="campo_texto_email" id="CONFIG_EMAIL_TRANSPORTADORA" value="<?=$CONFIG_EMAIL_TRANSPORTADORA?>" size="80" maxlength="80"></td>

      </tr>

      <tr>

        <td class="style2"><strong>Email assistente </strong></td>

        <td><input name="CONFIG_EMAIL_ASSISTENTE" type="text" class="campo_texto_email" id="CONFIG_EMAIL_ASSISTENTE" value="<?=$CONFIG_EMAIL_ASSISTENTE?>" size="80" maxlength="80"></td>

      </tr>

      <tr>

        <td class="style2"><strong>Email revisor </strong></td>

        <td><input name="CONFIG_EMAIL_REVISOR" type="text" class="campo_texto_email" id="CONFIG_EMAIL_REVISOR" value="<?=$CONFIG_EMAIL_REVISOR?>" size="80" maxlength="80"></td>

      </tr>

      <tr>

        <td class="style2"><strong>Email gerente </strong></td>

        <td><input name="CONFIG_EMAIL_GERENTE" type="text" class="campo_texto_email" id="CONFIG_EMAIL_GERENTE" value="<?=$CONFIG_EMAIL_GERENTE?>" size="80" maxlength="80"></td>

      </tr>

      <tr>

        <td class="style2"><strong>Email diretor </strong></td>

        <td><input name="CONFIG_EMAIL_DIRETOR" type="text" class="campo_texto_email" id="CONFIG_EMAIL_DIRETOR" value="<?=$CONFIG_EMAIL_DIRETOR?>" size="80" maxlength="80"></td>

      </tr>

      <tr>

        <td class="style2"><strong>Email presidente </strong></td>

        <td><input name="CONFIG_EMAIL_PRESIDENTE" type="text" class="campo_texto_email" id="CONFIG_EMAIL_PRESIDENTE" value="<?=$CONFIG_EMAIL_PRESIDENTE?>" size="80" maxlength="80"></td>

      </tr>

      <tr>

        <td>&nbsp;</td>

		<td colspan="4"> <div align="center"><a href="javascript:verificaForm(document.form);" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image351','','imagens/gravar2.jpg',1)"><img src="imagens/gravar.jpg" alt="Gravar dados" name="Image351" width="58" height="20" border="0" id="Image351"></a><a href="javascript:cancelOperation('principal.php')" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image361','','imagens/cancelar2.jpg',1)"><img src="imagens/cancelar.jpg" alt="Cancelar grava&ccedil;&atilde;o dos dados" name="Image361" width="68" height="20" border="0" id="Image361"></a></div></td>

      </tr>

      </table>

	</form>

<? include("inc/headerF.inc.php"); ?>

<script language="javascript" type="text/javascript">

<!--

function verificaForm(formObj) {

	if (formObj.CONFIG_EMAIL_TRANSPORTADORA.value == "") {

		alert("Preencha o campo \"E-mail da transportadora\"");

		formObj.CONFIG_EMAIL_TRANSPORTADORA.focus();

		return;

	}



	formObj.action = "conf_parametros_sistemaok.php";		

	document.form.submit();

}

<? if (trim($_GET['ID'])) { ?>

	alert("Usuário já cadastrado em nosso sistema.\nPor favor escolha outro !");

<? } ?>

//-->

</script>