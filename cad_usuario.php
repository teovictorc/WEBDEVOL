<? include("inc/headerI.inc.php"); ?>
<?
	verifyAcess("CADUSUARIO","S");
	$ID = $_GET["ID"];
	//$USUAR_NOME = $_GET["USUAR_NOME"];
	$USUAR_LOGIN = $_GET["USUAR_LOGIN"];
	$USUAR_SENHA = $_GET["USUAR_SENHA"];
	$USUAR_EMAIL1 = $_GET["USUAR_EMAIL1"];
	$USUAR_EMAIL2 = $_GET["USUAR_EMAIL2"];
	$USUAR_BLOQUEADO = $_GET["USUAR_BLOQUEADO"];
	$USUAR_RESPONSAVELAUTOMATIVO = $_GET["USUAR_RESPONSAVELAUTOMATIVO"];
	$USUAR_EMAIL_PADRAO = $_GET["USUAR_EMAIL_PADRAO"];
	$USUAR_ELOGISTICA = $_GET["USUAR_ELOGISTICA"];
	$USUAR_EFRANQUEADO = $_GET["USUAR_EFRANQUEADO"];
	$USUAR_ACESSATODACARTEIRA = $_GET["USUAR_ACESSATODACARTEIRA"];
	$USUAR_ENVIAEMAILAUTOMATICO = $_GET["USUAR_ENVIAEMAILAUTOMATICO"];
	$ACESS = $_POST['ACESS'];

	if (trim($_GET['Id'])) {
		$Stmt = mysql_query("SELECT * FROM rar_usuario WHERE USUAR_IDO = '" .$_GET['Id']. "'",$Conn);
		$ID = $_GET["Id"];
		if ($Rs = mysql_fetch_assoc($Stmt)) {
			$USUAR_NOME = $Rs["USUAR_NOME"];
			$USUAR_LOGIN = $Rs["USUAR_LOGIN"];
			$USUAR_SENHA = $Rs["USUAR_SENHA"];
			$USUAR_EMAIL1 = $Rs["USUAR_EMAIL1"];
			$USUAR_EMAIL2 = $Rs["USUAR_EMAIL2"];
			$USUAR_BLOQUEADO = $Rs["USUAR_BLOQUEADO"];
			$USUAR_EMAIL_PADRAO = $Rs["USUAR_EMAILPADRAO"];
			$USUAR_ECONSULTOR = $Rs["USUAR_ECONSULTOR"];
			$USUAR_ELOGISTICA = $Rs["USUAR_ELOGISTICA"];
			$USUAR_EFRANQUEADO = $Rs["USUAR_EFRANQUEADO"];
			$USUAR_CONSU_PESSOA = $Rs["USUAR_CONSU_PESSOA"];
			$USUAR_RESPONSAVELAUTOMATIVO = $Rs["USUAR_RESPONSAVELAUTOMATIVO"];
			$USUAR_RECEBEAUTOVINCULACAO =  $Rs["USUAR_RECEBEAUTOVINCULACAO"];
			$USUAR_ACESSATODACARTEIRA = $Rs["USUAR_ACESSATODACARTEIRA"];
			$USUAR_MODULOPADRAO = $Rs["USUAR_MODULOPADRAO"];
			$USUAR_ENVIAEMAILAUTOMATICO = $Rs["USUAR_ENVIAEMAILAUTOMATICO"];
			$Stmt = mysql_query("SELECT ACESS_PROGR_CODIGO FROM rar_acesso WHERE ACESS_USUAR_IDO = '" .$_GET['Id']. "'",$Conn);
			$x = 0;
			$ACESS = "";
			while ($Rs = mysql_fetch_assoc($Stmt)) {
				$ACESS.= (($x == 0) ? "" : ",") ."'". $Rs["ACESS_PROGR_CODIGO"]. "'";
				$x++;
			}
		}
	}

?>

<form name="form" method="post" action="" enctype="application/x-www-form-urlencoded">
<input type="hidden" name="ID" value="<?=$ID?>">
<input type="hidden" name="ACESS" value="<?=$ACESS?>">
<tr>
    <td height="100%" valign="top" class="tab_conteudo">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="100%" class="tab_titulo"><h4>Cadastro de usu&aacute;rio</h4></td>
      </tr>
    </table>
	
<table width="748" border="0" class="tab_inclusao">
      <tr>
        <td width="22%" class=""><strong>Nome do usu&aacute;rio *</strong></td>
        <td colspan="4"><input name="USUAR_NOME" type="text" class="form" id="USUAR_NOME" value="<?=$USUAR_NOME?>" size="50" maxlength="50"></td>
  </tr>
      <tr>
        <td class=""><strong>Usu&aacute;rio*</strong></td>
        <td width="25%"><input name="USUAR_LOGIN" type="text" class="form" id="USUAR_LOGIN" value="<?=$USUAR_LOGIN?>" size="25" maxlength="20"></td>
        <td width="8%" class=""><div align="right"><strong>Senha*</strong></div></td>
        <td colspan="2"><input name="USUAR_SENHA" type="password" class="form" id="USUAR_SENHA" value="<?=$USUAR_SENHA?>" size="25" maxlength="20"></td>
      </tr>
      <tr>
        <td class=""><strong>Email 1* </strong></td>
        <td colspan="4"><input name="USUAR_EMAIL1" type="text" class="form" id="USUAR_EMAIL1" value="<?=$USUAR_EMAIL1?>" size="100" maxlength="100"></td>
      </tr>
      <tr>
        <td class=""><strong>Email </strong></td>
        <td><input name="USUAR_EMAIL2" type="text" class="form" id="USUAR_EMAIL2" value="<?=$USUAR_EMAIL2?>" size="40" maxlength="100"></td>
        <td colspan="2" class=""><div align="right"><strong>&Eacute; Franqueado</strong></div></td>
        <td width="15%"><input name="USUAR_EFRANQUEADO" type="checkbox" class="form" id="USUAR_EFRANQUEADO2" value="S" <?=(($USUAR_EFRANQUEADO == "S") ? "Checked" : "")?>></td>
      </tr>
      <tr>
        <td class=""><strong>Email padr&atilde;o*</strong></td>
        <td><select name="USUAR_EMAIL_PADRAO" class="form" id="EMAIL_PADRAO">
			  <option value="" selected>..Selecione</option>
			  <option value="1"<?=(($USUAR_EMAIL_PADRAO == "1") ? " Selected" : "")?>>Email 1</option>
          	  <option value="2"<?=(($USUAR_EMAIL_PADRAO == "2") ? " Selected" : "")?>>Email 2</option>
            </select></td>
        <td colspan="2" class=""><div align="right"><strong>Login bloqueado</strong></div></td>
        <td><input name="USUAR_BLOQUEADO" type="checkbox" class="form" id="USUAR_BLOQUEADO2" value="S" <?=(($USUAR_BLOQUEADO == "S") ? "Checked" : "")?>></td>
      </tr>
      <tr>
        <td class=""><strong>Tipo usu&aacute;rio* </strong></td>
        <td><select name="USUAR_TIPOUSUARIO" class="form" id="USUAR_TIPOUSUARIO">
			<option value="A"<?=(($USUAR_TIPOUSUARIO == "A") ? " Selected" : "")?>>Ambos</option>
			<option value="C"<?=(($USUAR_TIPOUSUARIO == "C") ? " Selected" : "")?>>Calçados</option>
			<option value="L"<?=(($USUAR_TIPOUSUARIO == "L") ? " Selected" : "")?>>Bolsas - Carteiras - Cintos</option>
		</select></td>
        <td colspan="2" class=""><div align="right"><strong>Assinala consultor automaticamente</strong>&nbsp;</div></td>
        <td><input name="USUAR_RESPONSAVELAUTOMATIVO" type="checkbox" class="form" id="USUAR_RESPONSAVELAUTOMATIVO4" value="S" <?=(($USUAR_RESPONSAVELAUTOMATIVO == "S") ? "Checked" : "")?>></td>
      </tr>
      <tr>
        <td class=""><div align="left"><strong>Recebe auto-vincula&ccedil;&atilde;o de cliente </strong></div></td>
        <td><input name="USUAR_RECEBEAUTOVINCULACAO" type="checkbox" class="form" id="USUAR_RECEBEAUTOVINCULACAO" value="S" <?=(($USUAR_RECEBEAUTOVINCULACAO == "S") ? "Checked" : "")?>></td>
        <td colspan="2" class=""><div align="right"><strong>Envia email automaticamente ap&oacute;s registrar RV</strong></div></td>
        <td><input name="USUAR_ENVIAEMAILAUTOMATICO" type="checkbox" class="form" id="USUAR_ENVIAEMAILAUTOMATICO2" value="S" <?=(($USUAR_ENVIAEMAILAUTOMATICO == "S") ? "Checked" : "")?>></td>
      </tr>
      <tr>
        <td class=""><strong>&Eacute; consultor </strong></td>
        <td><select name="USUAR_ECONSULTOR" class="form" id="USUAR_ECONSULTOR" onChange="MostraConsultor();">
         	<option value="N"<?=(($USUAR_ECONSULTOR == "N") ? " Selected" : "")?>>Não</option>
			<option value="S"<?=(($USUAR_ECONSULTOR == "S") ? " Selected" : "")?>>Sim</option>
                </select></td>
        <td colspan="2" class=""><div align="right"><strong>&Eacute; operador log&iacute;stico&nbsp;</strong></div></td>
        <td><select name="USUAR_ELOGISTICA" class="form" id="select" onChange="MostraConsultor();">
          <option value="N"<?=(($USUAR_ELOGISTICA == "N") ? " Selected" : "")?>>N&atilde;o</option>
          <option value="S"<?=(($USUAR_ELOGISTICA == "S") ? " Selected" : "")?>>Sim</option>
        </select></td>
      </tr>
      <tr>
        <td class=""><strong>M&oacute;dulo WFA  padr&atilde;o </strong></td>
        <td><select name="USUAR_MODULOPADRAO" class="form" id="USUAR_MODULOPADRAO">
          <option value="1"<?=(($USUAR_MODULOPADRAO == "1") ? " Selected" : "")?>>WFA Técnico - Franquia</option>
          <option value="3"<?=(($USUAR_MODULOPADRAO == "3") ? " Selected" : "")?>>WFA Técnico - Multimarca</option>
		  <option value="2"<?=(($USUAR_MODULOPADRAO == "2") ? " Selected" : "")?>>WFA Serviços</option>
		  <option value="4"<?=(($USUAR_MODULOPADRAO == "4") ? " Selected" : "")?>>WFA RV</option>
		  <option value="5"<?=(($USUAR_MODULOPADRAO == "5") ? " Selected" : "")?>>WFA IAF</option>
		  <option value="6"<?=(($USUAR_MODULOPADRAO == "6") ? " Selected" : "")?>>WFA Pesquisas</option>
        </select></td>
        <td colspan="2" class="style2">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="5" class="">
		
		</td>
        </tr>
      <tr>
        <td colspan="5"><div align="center"></div></td>
      </tr>
	</table>

	<div id="Consultor" style="display:none">
		<table width="748"  border="0">
          <tr>
            <td width="22%" class=""><strong>C&oacute;digo de consultor*</strong></td>
            <td width="78%"><select name="USUAR_CONSU_PESSOA" class="form" id="USUAR_CONSU_PESSOA">
              		<option value="">-- Selecione --</option>
					<?
					$Sql = " select distinct CLIEN_EST_CONSULTOR CODIGO, NOME ";
					$Sql.= " from rar_cliente_estrutura, pessoa ";
					$Sql.= " where CLIEN_EST_CONSULTOR = pessoa ";
					$Sql.= " union ";
					$Sql.= " select distinct CLIEN_EST_COORDENADOR CODIGO, NOME ";
					$Sql.= " from rar_cliente_estrutura, pessoa ";
					$Sql.= " where CLIEN_EST_COORDENADOR = pessoa ";
					$Sql.= " order by CODIGO";

					$Stmt = mysql_query($Sql);
					while($Rs = mysql_fetch_assoc($Stmt)) {
						?>
						<option value="<?=$Rs["CODIGO"]?>" <? if ($USUAR_CONSU_PESSOA == $Rs["CODIGO"]){?> selected <? }?>><?=$Rs["CODIGO"] . " - ".$Rs["NOME"]?></option>
					<?
					}
					?>
				</select>
			</td>
          </tr>
          <tr>
            <td class=""><strong>Acessa toda carteira da coordena&ccedil;&atilde;o:</strong></td>
            <td><input name="USUAR_ACESSATODACARTEIRA" type="checkbox" class="form" id="USUAR_ACESSATODACARTEIRA" value="S" <?=(($USUAR_ACESSATODACARTEIRA == "S") ? "Checked" : "")?>></td>
          </tr>
        </table>
		</div>
	
	<table width="748" border="0" class="tab_inclusao">
	  <tr >
		<td width="45%" class=""><div align="center">Acessos dispon&iacute;veis</div></td>
		<td width="10%" class=""><div align="center"></div></td>
		<td width="45%" class=""><div align="center">Acessos selecionados</div></td>
	  </tr>
	  <tr>
		<td rowspan="3" valign="top" class="campo_texto">
		  <div align="center">
			<select name="USUAR_ACESS_FREE" multiple class="campo_texto" id="USUAR_ACESS_FREE" style="overflow:auto; width:350px; height:150px">
			<? if (trim($ACESS)) {
					$Stmt = mysql_query("SELECT PROGR_DESCRICAO, PROGR_CODIGO FROM rar_programa WHERE PROGR_CODIGO NOT IN (" .$ACESS. ") ORDER BY PROGR_DESCRICAO",$Conn);
			   }else{
					$Stmt = mysql_query("SELECT PROGR_DESCRICAO, PROGR_CODIGO FROM rar_programa ORDER BY PROGR_DESCRICAO",$Conn);
			   }
	
			   while($Rs = mysql_fetch_assoc($Stmt)) {  ?>
			   <option value="<?=$Rs["PROGR_CODIGO"]?>"><?=$Rs["PROGR_DESCRICAO"]?></option>
			<? } ?>
			</select>
		  </div></td>
		<td width="5%" height="94" class="campo_texto"><div align="center">
		  <p><a href="javascript:moveListOByListD('USUAR_ACESS_FREE','USUAR_ACESS',true);"><img src="imagens/seta_direita.gif" alt="Adicionar acesso(s) selecionado(s)" width="33" height="15" border="0"></a></p>
		  <p><a href="javascript:moveListOByListD('USUAR_ACESS','USUAR_ACESS_FREE',false);"><img src="imagens/seta_esquerda.gif" alt="Remover acesso(s) selecionado(s)" width="33" height="15" border="0"></a></p>
		</div></td>
		<td rowspan="3" class="campo_texto"><div align="center"></div>              <div align="center">
		  <select name="USUAR_ACESS" size="10" multiple class="campo_texto" id="USUAR_ACESS" onChange="viewType(this);" style="overflow:auto; width:350px; height:150px;">
			<? if (trim($ACESS)) {
					$Stmt = mysql_query("SELECT P.PROGR_DESCRICAO, P.PROGR_CODIGO, A.ACESS_TIPOACESSO FROM rar_acesso A, rar_programa P WHERE P.PROGR_CODIGO IN (" .$ACESS. ") AND A.ACESS_PROGR_CODIGO = P.PROGR_CODIGO AND A.ACESS_USUAR_IDO = " .$ID. " ORDER BY P.PROGR_DESCRICAO");
			   }else{
					$Stmt = mysql_query("SELECT P.PROGR_DESCRICAO, P.PROGR_CODIGO, A.ACESS_TIPOACESSO FROM rar_acesso A, rar_programa P WHERE P.PROGR_CODIGO = -222 AND A.ACESS_PROGR_CODIGO = P.PROGR_CODIGO ORDER BY P.PROGR_DESCRICAO");
			   }
			   while($Rs = mysql_fetch_assoc($Stmt)) {  ?>
			   <option value="<?=$Rs["ACESS_TIPOACESSO"]?>|<?=$Rs["PROGR_CODIGO"]?>"><?=$Rs["PROGR_DESCRICAO"]?></option>
			<? } ?>
		  </select>
		</div>              <div align="center"></div></td>
	  </tr>
	  <tr>
		<td class="topo_listagem"><div align="center">
		  Tipo de acesso
			  <select class="form" name="tp_acesso">
			<option value="T">Total</option>
			<option value="S">Somente Consulta</option>
		  </select>
		</div></td>
	  </tr>
	</table>	  
	<br />
	<table width="748" border="0" class="tab_inclusao">
	  <tr>
        <td colspan="5">
		<div align="center">
		<? if (returnAcess("CADUSUARIO") == "T") { ?>
		<a href="javascript:verificaForm(document.form);" ><img src="../img/bts/gravar.jpg" alt="Gravar dados" name="Image351" border="0" id="Image351"></a>
		<? } ?>
		<a href="javascript:cancelOperation('pesq_usuarios.php');"><img src="../img/bts/cancelar.jpg" alt="Cancelar grava&ccedil;&atilde;o dos dados" name="Image361" border="0" id="Image361"></a></div></td>
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
function viewType(elementList) {
	document.form.tp_acesso.value = (elementList.value.split("|"))[0];
}

function MostraConsultor(){
	if (document.form.USUAR_ECONSULTOR.value == "S"){
		document.getElementById("Consultor").style.display = "block";
	}else{
		document.getElementById("Consultor").style.display = "none";
		document.form.USUAR_CONSU_PESSOA.value = "";
	}
}


function moveListOByListD(ListO,ListD,isListFRE) {
	var iTotal = document.forms['form'].elements[ListO].length;
	for (x = 0; x < iTotal; x++) {
		if (document.forms['form'].elements[ListO].options[x].selected) {
			if (isListFRE)
				var sValue = document.forms['form'].tp_acesso.value + "|" + document.forms['form'].elements[ListO].options[x].value;
			else
				var sValue = document.forms['form'].elements[ListO].options[x].value.substring(document.forms['form'].elements[ListO].options[x].value.indexOf("|") + 1);

			var sText = document.forms['form'].elements[ListO].options[x].text;
			document.forms['form'].elements[ListD].options[document.forms['form'].elements[ListD].length] = new Option(sText,sValue,true);
			document.forms['form'].elements[ListO].options[x] = null;
			iTotal--;
			x--;
		}
	}
}
function verificaForm(formObj) {
	if (formObj.USUAR_NOME.value == "") {
		alert("Preencha o campo \"Nome do usuário\"");
		formObj.USUAR_NOME.focus();
		return;
	}
	if (formObj.USUAR_LOGIN.value == "") {
		alert("Preencha o campo \"Usuário\"");
		formObj.USUAR_LOGIN.focus();
		return;
	}else if (formObj.USUAR_LOGIN.value.indexOf("'") != -1) {
		alert("O campo \"Usuário\" não pode conter aspas simples");
		formObj.USUAR_LOGIN.focus();
		return;
	}
	if (formObj.USUAR_SENHA.value == "") {
		alert("Preencha o campo \"Senha\"");
		formObj.USUAR_SENHA.focus();
		return;
	}else if (formObj.USUAR_SENHA.value.indexOf("'") != -1) {
		alert("O campo \"Senha\" não pode conter aspas simples");
		formObj.USUAR_SENHA.focus();
		return;
	}
	if (formObj.USUAR_EMAIL1.value == "") {
		alert("Preencha o campo \"E-mail 1\"");
		formObj.USUAR_EMAIL1.focus();
		return;
	}else if (!JSValidacaoeml(formObj.USUAR_EMAIL1,false)) {
		alert("Preencha o campo \"E-mail 1\" com um E-mail válido");
		formObj.USUAR_EMAIL1.focus();
		return;
	}
	if (!JSValidacaoeml(formObj.USUAR_EMAIL2,false)) {
		alert("Preencha o campo \"E-mail\" com um E-mail válido");
		formObj.USUAR_EMAIL2.focus();
		return;
	}
	if (formObj.USUAR_EMAIL_PADRAO.value == "") {
		alert("Preencha o campo \"E-mail padrão\"");
		formObj.USUAR_EMAIL1.focus();
		return;
	}else if (formObj.elements["USUAR_EMAIL" + formObj.USUAR_EMAIL_PADRAO.value].value == "") {
		alert("Você deve prencher o e-mail padrão");
		formObj.USUAR_EMAIL1.focus();
		return;
	}

	if (formObj.USUAR_ECONSULTOR.value == "S") {
		if (formObj.USUAR_CONSU_PESSOA.value == "") {
			alert("Preencha o campo \"Código de consultor\"");
			formObj.USUAR_CONSU_PESSOA.focus();
			return;
		}
	}

	//Seleciona tudo para mandar ...
	document.form.ACESS.value = "";
	for(x = 0; x < document.form.USUAR_ACESS.options.length; x++)
		document.form.ACESS.value+= ((x == 0) ? "" : ",") + document.form.USUAR_ACESS.options[x].value;

	formObj.action = "cad_usuariook.php";
	document.form.submit();
}
<? if (trim($_GET['ID'])) { ?>
	alert("Usuário já cadastrado em nosso sistema.\nPor favor escolha outro !");
<? } ?>
//-->
MostraConsultor();
</script>
</body>
</html>