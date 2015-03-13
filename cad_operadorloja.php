<? include("inc/headerI.inc.php"); 
 	verifyAcess("CADOPERADORLOJA","S");
	$opelj_nome    = $_GET["opelj_nome"];
	$opelj_email   = $_GET["opelj_email"];

	if (trim($_GET['Id'])) {
		$Stmt = mysql_query("SELECT * FROM rar_operadorloja WHERE opelj_ido = '" .$_GET['Id']. "'");

		$ID = $_GET["Id"];
		if ($Rs = mysql_fetch_assoc($Stmt)) {
			$opelj_ido     = $Rs["OPELJ_IDO"];
			$opelj_nome    = $Rs["OPELJ_NOME"];
			$opelj_email   = $Rs["OPELJ_EMAIL"];
		}
	}
?>
<tr>
    <td height="100%" valign="top" class="tab_conteudo">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="100%" class="tab_titulo"><h4>Cadastro de operador loja</h4></td>
      </tr>
    </table>
<form name="form" method="post" action="" enctype="application/x-www-form-urlencoded">
<input type="hidden" name="ID" value="<?=$ID?>">
	
	<table width="748" border="0" class="tab_inclusao">
      <tr>
        <td width="14%" class=""><strong>Nome:</strong></td>
        <td><input name="opelj_nome" type="text" class="form" id="opelj_nome" value="<?=$opelj_nome?>" size="50" maxlength="50"></td>
      </tr>
      <tr>
        <td class=""><strong>E-mail:</strong></td>
        <td width="86%"><input name="opelj_email" type="text" class="form" id="opelj_email" value="<?=$opelj_email?>" size="50" maxlength="50"></td>
      </tr>
	  <tr>
        <td colspan="2">
			<div align="center"><a href="javascript:verificaForm(document.form);" ><img src="../img/bts/gravar.jpg" alt="Gravar dados" name="Image351" border="0" id="Image351"></a><a href="javascript:cancelOperation('pesq_operadorloja.php');" ><img src="../img/bts/cancelar.jpg" alt="Cancelar grava&ccedil;&atilde;o dos dados" name="Image361" border="0" id="Image361"></a></div>
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
	if (formObj.opelj_nome.value == "") {
		alert("Preencha o campo \"NOME\"");
		formObj.opelj_nome.focus();
		return;
	}
	if (formObj.opelj_email.value == "") {
		alert("Preencha o campo \"E-MAIL\"");
		formObj.opelj_email.focus();
		return;
	}

	formObj.action = "cad_operadorlojaok.php";		
	document.form.submit();
}
//-->
<? if ($_GET["Erro"] != ""){ ?>
	if (<?=$_GET["Erro"]%> == "1"){
		alert("Endereço de e-mail inválido !");
		document.form.opelj_email.focus();
	}
<? } ?>
</script>
</body>
</html>