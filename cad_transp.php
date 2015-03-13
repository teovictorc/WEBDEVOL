<? include("inc/headerI.inc.php"); 
 	verifyAcess("CADTRANSP","S");
	$transp_nome    = $_GET["transp_nome"];
	$transp_contato = $_GET["transp_contato"];
	$transp_email   = $_GET["transp_email"];

	if (trim($_GET['Id'])) {
		$Stmt = mysql_query("SELECT * FROM rar_transportadoras WHERE transp_ido = '" .$_GET['Id']. "'");

		$ID = $_GET["Id"];
		if ($Rs = mysql_fetch_assoc($Stmt)) {
			$transp_ido     = $Rs["transp_ido"];
			$transp_nome    = $Rs["transp_nome"];
			$transp_contato = $Rs["transp_contato"];
			$transp_email   = $Rs["transp_email"];
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
        <td width="22%" class=""><strong>Transportadora:</strong></td>
        <td><input name="transp_nome" type="text" class="form" id="transp_nome" value="<?=$transp_nome?>" size="50" maxlength="50"></td>
      </tr>
      <tr>
        <td class=""><strong>Contato:</strong></td>
        <td width="78%"><input name="transp_contato" type="text" class="form" id="transp_contato" value="<?=$transp_contato?>" size="50" maxlength="50"></td>
      </tr>
	  <tr>
        <td class=""><strong>E-mail:</strong></td>
        <td width="78%"><input name="transp_email" type="text" class="form" id="transp_email" value="<?=$transp_email?>" size="50" maxlength="50"></td>
      </tr>
	  <tr>
        <td colspan="2">
			<div align="center"><a href="javascript:verificaForm(document.form);" ><img src="../img/bts/gravar.jpg" alt="Gravar dados" name="Image351" border="0" id="Image351"></a><a href="javascript:cancelOperation('pesq_transportadoras.php');"><img src="../img/bts/cancelar.jpg" alt="Cancelar grava&ccedil;&atilde;o dos dados" name="Image361" border="0" id="Image361"></a></div>
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
	if (formObj.transp_nome.value == "") {
		alert("Preencha o campo \"TRANSPORTADORA\"");
		formObj.transp_nome.focus();
		return;
	}
	if (formObj.transp_contato.value == "") {
		alert("Preencha o campo \"CONTATO\"");
		formObj.transp_contato.focus();
		return;
	}
	if (formObj.transp_email.value == "") {
		alert("Preencha o campo \"E-MAIL\"");
		return;
	}

	formObj.action = "cad_transpok.php";		
	document.form.submit();
}
//-->
</script>
</body>
</html>