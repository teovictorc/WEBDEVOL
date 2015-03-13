<? include("inc/headerI.inc.php"); 
 	verifyAcess("CADAGENTE","S");
	$agent_nome    = $_GET["agent_nome"];
	$agent_email   = $_GET["agent_email"];

	if (trim($_GET['Id'])) {
		$Stmt = mysql_query("SELECT * FROM rar_agente WHERE agent_ido = '" .$_GET['Id']. "'");

		$ID = $_GET["Id"];
		if ($Rs = mysql_fetch_assoc($Stmt)) {
			$agent_ido     = $Rs["AGENT_IDO"];
			$agent_nome    = $Rs["AGENT_NOME"];
			$agent_email   = $Rs["AGENT_EMAIL"];
		}
	}
?>
<tr>
    <td height="100%" valign="top" class="tab_conteudo">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="100%" class="tab_titulo"><h4>Cadastro de agente</h4></td>
      </tr>
    </table>
<form name="form" method="post" action="" enctype="application/x-www-form-urlencoded">
<input type="hidden" name="ID" value="<?=$ID?>">
	
	<table width="748" border="0" class="tab_inclusao">
      <tr>
        <td width="16%" class=""><strong>Nome:</strong></td>
        <td><input name="agent_nome" type="text" class="form" id="agent_nome" value="<?=$agent_nome?>" size="50" maxlength="50"></td>
      </tr>
      <tr>
        <td class=""><strong>E-mail:</strong></td>
        <td width="84%"><input name="agent_email" type="text" class="form" id="agent_email" value="<?=$agent_email?>" size="50" maxlength="50"></td>
      </tr>
	  <tr>
        <td colspan="2">
			<div align="center"><a href="javascript:verificaForm(document.form);"><img src="../img/bts/gravar.jpg" alt="Gravar dados" name="Image351" border="0" id="Image351"></a><a href="javascript:cancelOperation('pesq_agente.php');" ><img src="../img/bts/cancelar.jpg" alt="Cancelar grava&ccedil;&atilde;o dos dados" name="Image361" border="0" id="Image361"></a></div>
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
	if (formObj.agent_nome.value == "") {
		alert("Preencha o campo \"NOME\"");
		formObj.agent_nome.focus();
		return;
	}
	if (formObj.agent_email.value == "") {
		alert("Preencha o campo \"E-MAIL\"");
		formObj.agent_email.focus();
		return;
	}

	formObj.action = "cad_agenteok.php";		
	document.form.submit();
}
//-->
<? if ($_GET["Erro"] != ""){ ?>
	if (<?=$_GET["Erro"]%> == "1"){
		alert("Endereço de e-mail inválido !");
		document.form.agent_email.focus();
	}
<? } ?>
</script>
</body>
</html>