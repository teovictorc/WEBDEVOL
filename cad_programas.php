<? include("inc/headerI.inc.php"); 

 	verifyAcess("CONFIG_PROGRAMAS","S");

	$PROG_CODIGO = $_GET["PROG_CODIGO"];

	$PROG_DESCRICAO = $_GET["PROG_DESCRICAO"];

	$PROG_TIPO = $_GET["PROG_TIPO"];



	if (trim($_GET['Id'])) {

		$Stmt = mysql_query("SELECT * FROM RAR_PROGRAMA WHERE PROGR_CODIGO = '" .$_GET['Id']. "'");



		$ID = $_GET["Id"];

		if ($Rs = mysql_fetch_assoc($Stmt)) {

			$PROG_CODIGO = $Rs["PROGR_CODIGO"];

			$PROG_DESCRICAO = $Rs["PROGR_DESCRICAO"];

			$PROG_TIPO = $Rs["PROGR_TIPO"];

		}

	}

?>

<form name="form" method="post" action="" enctype="application/x-www-form-urlencoded">

<input type="hidden" name="ID" value="<?=$ID?>">

<table width="100%"  border="0" align="center">

     <tr>

       <td width="49%"><span class="titulo">:: Cadastro de programa ::</span></td>

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

        <td width="15%" class="style2"><strong>C&oacute;digo*</strong></td>

        <td width="85%"><input name="PROG_CODIGO" type="text" class="campo_texto" id="PROG_CODIGO" value="<?=$PROG_CODIGO?>" size="30" maxlength="30"></td>

      </tr>

      <tr>

        <td class="style2"><strong>Descri&ccedil;&atilde;o*</strong></td>

        <td><input name="PROG_DESCRICAO" type="text" class="campo_texto" id="PROG_DESCRICAO" value="<?=$PROG_DESCRICAO?>" size="100" maxlength="100"></td>

      </tr>

      <tr>

        <td class="style2"><strong>Tipo programa* </strong></td>

        <td><select name="PROG_TIPO" class="campo_texto">

		  <option value="" selected>..Selecione</option>

          <option value="M" <?=(($PROG_TIPO == "M") ? "Selected" : "")?>>M&Oacute;DULO</option>

          <option value="P" <?=(($PROG_TIPO == "P") ? "Selected" : "")?>>PROGRAMA</option>

                </select></td>

      </tr>

      <tr>

        <td>&nbsp;</td>

                <td colspan="4"> <div align="center"><a href="javascript:verificaForm(document.form);" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image351','','imagens/gravar2.jpg',1)"><img src="imagens/gravar.jpg" alt="Gravar dados" name="Image351" width="58" height="20" border="0" id="Image351"></a><a href="javascript:cancelOperation('pesq_programas.php');" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image361','','imagens/cancelar2.jpg',1)"><img src="imagens/cancelar.jpg" alt="Cancelar grava&ccedil;&atilde;o dos dados" name="Image361" width="68" height="20" border="0" id="Image361"></a></div></td>

      </tr>

    </table>

	</form>

<? include("inc/headerF.inc.php"); ?>

<script language="javascript" type="text/javascript">

<!--

function verificaForm(formObj) {

	if (formObj.PROG_CODIGO.value == "") {

		alert("Preencha o campo \"Código\"");

		formObj.PROG_CODIGO.focus();

		return;

	}

	if (formObj.PROG_DESCRICAO.value == "") {

		alert("Preencha o campo \"Descrição\"");

		formObj.PROG_DESCRICAO.focus();

		return;

	}

	if (formObj.PROG_TIPO.value == "") {

		alert("Preencha o campo \"Tipo programa\"");

		return;

	}



	formObj.action = "cad_programasok.php";		

	document.form.submit();

}

<? if (trim($_GET['PROG_CODIGO'])) { ?>

	alert("Codigo já cadastrado em nosso sistema.\nPor favor escolha outro !");

<? } ?>

//-->

</script>