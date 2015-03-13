<? include("inc/headerI.inc.php"); 
 	verifyAcess("CADCONTATO","S");
	$CONT_NOME = $_GET["CONT_NOME"];
	$CONT_EMAIL = $_GET["CONT_EMAIL"];

	if (trim($_GET['Id'])) {
		$Stmt = mysql_query("SELECT * FROM rar_contato WHERE CONT_IDO = '" .$_GET['Id']. "'");

		$ID = $_GET["Id"];
		if ($Rs = mysql_fetch_assoc($Stmt)) {
			$CONT_IDO = $Rs["CONT_IDO"];
			$CONT_NOME = $Rs["CONT_NOME"];
			$CONT_EMAIL = $Rs["CONT_EMAIL"];
		}
	}
?>
<tr>
    <td height="100%" valign="top" class="tab_conteudo">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="100%" class="tab_titulo"><h4>Cadastro de contatos</h4></td>
      </tr>
    </table>
<form name="form" method="post" action="" enctype="application/x-www-form-urlencoded">
<input type="hidden" name="ID" value="<?=$ID?>">
	
	<table width="748" border="0" class="tab_inclusao">
      <tr>
        <td width="16%" class=""><strong>Nome:</strong></td>
        <td><input name="CONT_NOME" type="text" class="form" id="CONT_NOME" value="<?=$CONT_NOME?>" size="50" maxlength="50"></td>
      </tr>
      <tr>
        <td class=""><strong>E-mail:</strong></td>
        <td width="84%"><input name="CONT_EMAIL" type="text" class="form" id="CONT_EMAIL" value="<?=$CONT_EMAIL?>" size="50" maxlength="50"></td>
      </tr>
	  <tr>
        <td colspan="2">
			<div align="center"><a href="javascript:verificaForm(document.form);" ><img src="../img/bts/gravar.jpg" alt="Gravar dados" name="Image351" border="0" id="Image351"></a><a href="javascript:cancelOperation('pesq_contato.php');"><img src="../img/bts/cancelar.jpg" alt="Cancelar grava&ccedil;&atilde;o dos dados" name="Image361" border="0" id="Image361"></a></div>
        </td>
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
function verificaForm(formObj) {
	if (formObj.CONT_NOME.value == "") {
		alert("Preencha o campo \"Nome\"");
		formObj.CONT_NOME.focus();
		return;
	}
	if (formObj.CONT_EMAIL.value == "") {
		alert("Preencha o campo \"E-mail\"");
		return;
	}

	formObj.action = "cad_contatosok.php";		
	document.form.submit();
}
//-->
</script>
</body>
</html>