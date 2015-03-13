<? include("inc/headerI.inc.php"); 
	verifyAcess("CADCLIENTE","S");

	if (trim($_GET['Id'])) {
		$Sql = "SELECT date_format(CLIEN_COL_HRINI,'%H:%i') As HRINI, ".
		              " date_format(CLIEN_COL_HRFIM,'%H:%i') As HRFIM,".
					  " CLIEN_COL_PESSOA,CLIEN_QTDELINHANF,CLIEN_COL_ENDER,".
					  " CLIEN_COL_BAIRRO,CLIEN_COL_CIDADE,CLIEN_COL_FONE,".
					  " CLIEN_COL_UF,CLIEN_COL_DIAINI,CLIEN_COL_DIAFIM, ".
					  " CLIEN_QTDELINHANF, CLIEN_COL_LOJAANT, CLIEN_COB_BANCO, CLIEN_COB_AGENCIA_CODIGO, ".
					  " CLIEN_COB_AGENCIA_NOME, CLIEN_COB_CONTA, CLIEN_COB_TITULAR, CLIEN_COB2_BANCO, CLIEN_COB2_AGENCIA_CODIGO, ".
					  " CLIEN_COB2_AGENCIA_NOME, CLIEN_COB2_CONTA, CLIEN_COB2_TITULAR".
					  " ,CLIEN_COL_LOJAANT_1".
					  " ,CLIEN_COL_LOJAANT_2".
					  " ,CLIEN_COL_LOJAANT_3".
					  " ,CLIEN_COL_LOJAANT_4, CLIEN_OPELJ_IDO, CLIEN_COL_LOJAPROPRIA, FANTASIA".
			   " FROM rar_cliente_coleta, pessoa ".
			   " WHERE CLIEN_COL_PESSOA = '" .$_GET['Id']. "' and clien_col_pessoa = pessoa";

		$Stmt = mysql_query($Sql);
		$ID = $_GET["Id"];
		$NOME = $_GET["Nome"];
		
		if ($Rs = mysql_fetch_assoc($Stmt)) {
			$CLIEN_COL_PESSOA = $Rs["CLIEN_COL_PESSOA"];
			$CLIEN_QTDELINHANF = $Rs["CLIEN_QTDELINHANF"];
			$CLIEN_COL_ENDER = $Rs["CLIEN_COL_ENDER"];
			$CLIEN_COL_BAIRRO = $Rs["CLIEN_COL_BAIRRO"];
			$CLIEN_COL_CIDADE = $Rs["CLIEN_COL_CIDADE"];
			$CLIEN_COL_FONE = $Rs["CLIEN_COL_FONE"];
			$CLIEN_COL_UF = $Rs["CLIEN_COL_UF"];
			$CLIEN_COL_DIAINI = $Rs["CLIEN_COL_DIAINI"];
			$CLIEN_COL_DIAFIM = $Rs["CLIEN_COL_DIAFIM"];
			$CLIEN_COL_HRINI = $Rs["HRINI"];
			$CLIEN_COL_HRFIM = $Rs["HRFIM"];
			$CLIEN_QTDELINHANF = $Rs["CLIEN_QTDELINHANF"];
			$CLIEN_COL_LOJAANT = $Rs["CLIEN_COL_LOJAANT"];
			$CLIEN_COL_LOJAANT_1 = $Rs["CLIEN_COL_LOJAANT_1"];
			$CLIEN_COL_LOJAANT_2 = $Rs["CLIEN_COL_LOJAANT_2"];
			$CLIEN_COL_LOJAANT_3 = $Rs["CLIEN_COL_LOJAANT_3"];
			$CLIEN_COL_LOJAANT_4 = $Rs["CLIEN_COL_LOJAANT_4"];
			$CLIEN_COB_BANCO = $Rs["CLIEN_COB_BANCO"]; 
			$CLIEN_COB_AGENCIA_CODIGO = $Rs["CLIEN_COB_AGENCIA_CODIGO"];
			$CLIEN_COB_AGENCIA_NOME = $Rs["CLIEN_COB_AGENCIA_NOME"]; 
			$CLIEN_COB_CONTA = $Rs["CLIEN_COB_CONTA"]; 
			$CLIEN_COB_TITULAR = $Rs["CLIEN_COB_TITULAR"];
			
			$CLIEN_COB2_BANCO 			= $Rs["CLIEN_COB2_BANCO"]; 
			$CLIEN_COB2_AGENCIA_CODIGO 	= $Rs["CLIEN_COB2_AGENCIA_CODIGO"];
			$CLIEN_COB2_AGENCIA_NOME 	= $Rs["CLIEN_COB2_AGENCIA_NOME"]; 
			$CLIEN_COB2_CONTA 			= $Rs["CLIEN_COB2_CONTA"]; 
			$CLIEN_COB2_TITULAR 		= $Rs["CLIEN_COB2_TITULAR"];
			
			$CLIEN_OPELJ_IDO = $Rs["CLIEN_OPELJ_IDO"];
			$CLIEN_COL_LOJAPROPRIA = $Rs["CLIEN_COL_LOJAPROPRIA"];						$FANTASIA 		= $Rs["FANTASIA"];
		}
	}

?>
<link href="wfa.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
<body onLoad="MM_preloadImages('imagens/gravar2.jpg','imagens/cancelar2.jpg')">
<tr>
    <td height="100%" valign="top" class="tab_conteudo">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="32" class="tab_titulo"><h4>Cadastro de cliente</h4></td>
      </tr>
      </table>  

<form name="form" method="post" action="#">
<input type="hidden" name="CLIEN_COL_PESSOA" value="<?=$ID?>">
    <table width="100%"  border="0" class="tab_inclusao">
      <tr>
        <td width="18%" ><strong>C&oacute;digo*</strong></td>
        <td colspan="3"><input name="textfield" type="text" class="campo_texto" value="<?=$FANTASIA?>" size="30" disabled></td>
      </tr>
      <tr>
        <td ><strong>Nome*</strong></td>
        <td colspan="3"><input name="textfield2" type="text" class="campo_texto" value="<?=$NOME?>" size="50" maxlength="50" disabled></td>
      </tr>
      <tr>
        <td ><strong>Loja pr&oacute;pria </strong></td>
        <td colspan="3"><input name="CLIEN_COL_LOJAPROPRIA" type="checkbox" id="CLIEN_COL_LOJAPROPRIA" <? if ($CLIEN_COL_LOJAPROPRIA == 1){?> checked="checked" <? } ?> value="1"></td>
      </tr>
      <tr>
        <td ><strong>Operador loja </strong></td>
        <td colspan="3">
		<select name="CLIEN_OPELJ_IDO" class="form" id="CLIEN_OPELJ_IDO">
		<option value="">-- Selecione --</option>
		<?
		$Sql = "select * from rar_operadorloja order by OPELJ_NOME";
		$StmtOper = mysql_query($Sql);
		while ($RsOper = mysql_fetch_assoc($StmtOper)) {
		?>
         	<option value="<?=$RsOper["OPELJ_IDO"]?>" <?=(($CLIEN_OPELJ_IDO == $RsOper["OPELJ_IDO"]) ? " selected" : "")?>><?=$RsOper["OPELJ_NOME"]?></option>
		<?
		}
		?>
        </select></td>
      </tr>
      <tr class="tabela">
        <td colspan="4" ></td>
      </tr>
	  
	  <? 
	  if (returnAcess('CADAQUISICAOLOJA') != 'N') { ?>
		  <tr class="tit_form">
			<td colspan="4" class="tit_form"><strong>Dados de aquisi&ccedil;&atilde;o da loja </strong></td>
		  </tr>
		  <tr >
			<td ><strong>Aquisi&ccedil;&atilde;o da loja</strong></td>
			<td ><input name="CLIEN_COL_LOJAANT" type="text" class="form" size="7" maxlength="5" value="<?=$CLIEN_COL_LOJAANT?>"></td>
			<td >&nbsp;</td>
			<td >&nbsp;</td>
		  </tr>
                  <tr >
			<td ><strong>Aquisi&ccedil;&atilde;o da loja</strong></td>
			<td ><input name="CLIEN_COL_LOJAANT_1" type="text" class="form" size="7" maxlength="5" value="<?=$CLIEN_COL_LOJAANT_1?>"></td>
			<td >&nbsp;</td>
			<td >&nbsp;</td>
		  </tr>
                  <tr >
			<td ><strong>Aquisi&ccedil;&atilde;o da loja</strong></td>
			<td ><input name="CLIEN_COL_LOJAANT_2" type="text" class="form" size="7" maxlength="5" value="<?=$CLIEN_COL_LOJAANT_2?>"></td>
			<td >&nbsp;</td>
			<td >&nbsp;</td>
		  </tr>

                  <tr >
			<td ><strong>Aquisi&ccedil;&atilde;o da loja</strong></td>
			<td ><input name="CLIEN_COL_LOJAANT_3" type="text" class="form" size="7" maxlength="5" value="<?=$CLIEN_COL_LOJAANT_3?>"></td>
			<td >&nbsp;</td>
			<td >&nbsp;</td>
		  </tr>
                  <tr >
			<td ><strong>Aquisi&ccedil;&atilde;o da loja</strong></td>
			<td ><input name="CLIEN_COL_LOJAANT_4" type="text" class="form" size="7" maxlength="5" value="<?=$CLIEN_COL_LOJAANT_4?>"></td>
			<td >&nbsp;</td>
			<td >&nbsp;</td>
		  </tr>

		<? }?> 
      <tr class="">
        <td colspan="4" class="tit_form"><strong>Dados de coleta</strong></td>
      </tr>
      <tr>
        <td ><strong>Endere&ccedil;o*</strong></td>
        <td colspan="3"><input name="CLIEN_COL_ENDER" type="text" class="form" size="80" maxlength="80" value="<?=$CLIEN_COL_ENDER?>"></td>
      </tr>
      <tr>
        <td ><strong>Bairro*</strong></td>
        <td width="33%"><input name="CLIEN_COL_BAIRRO" type="text" class="form" size="30" maxlength="30" value="<?=$CLIEN_COL_BAIRRO?>"></td>
        <td width="19%" ><div align="right"><strong>Cidade*</strong></div></td>
        <td width="30%"><input name="CLIEN_COL_CIDADE" type="text" class="form" size="40" maxlength="40" value="<?=$CLIEN_COL_CIDADE?>"></td>
      </tr>
      <tr>
        <td ><strong>UF*</strong></td>
        <td><input name="CLIEN_COL_UF" type="text" class="form" size="2" maxlength="2" value="<?=$CLIEN_COL_UF?>"></td>
        <td ><div align="right"><strong>Fone*</strong></div></td>
        <td><input name="CLIEN_COL_FONE" type="text" class="form" value="<?=$CLIEN_COL_FONE?>" size="20" maxlength="20">        </td>
      </tr>
      <tr>
        <td ><strong>Dias para coleta*</strong></td>
        <td colspan="3" class="" valign="bottom">
          <strong>De: </strong>          <select name="CLIEN_COL_DIAINI" class="form">
            <option value="">...Selecione</option>
			<option value="D"<?=(($CLIEN_COL_DIAINI == "D") ? " Selected" : "")?>>DOMINGO</option>
            <option value="S"<?=(($CLIEN_COL_DIAINI == "S") ? " Selected" : "")?>>SEGUNDA-FEIRA</option>
            <option value="T"<?=(($CLIEN_COL_DIAINI == "T") ? " Selected" : "")?>>TER&Ccedil;A-FEIRA</option>
            <option value="Q"<?=(($CLIEN_COL_DIAINI == "Q") ? " Selected" : "")?>>QUARTA-FEIRA</option>
            <option value="I"<?=(($CLIEN_COL_DIAINI == "I") ? " Selected" : "")?>>QUINTA-FEIRA</option>
            <option value="X"<?=(($CLIEN_COL_DIAINI == "X") ? " Selected" : "")?>>SEXTA-FEIRA</option>
            <option value="B"<?=(($CLIEN_COL_DIAINI == "B") ? " Selected" : "")?>>S&Aacute;BADO</option>
			</select> 
          <strong>&agrave;</strong>          <select name="CLIEN_COL_DIAFIM" class="form">
            <option value="">...Selecione</option>
			<option value="D"<?=(($CLIEN_COL_DIAFIM == "D") ? " Selected" : "")?>>DOMINGO</option>
            <option value="S"<?=(($CLIEN_COL_DIAFIM == "S") ? " Selected" : "")?>>SEGUNDA-FEIRA</option>
            <option value="T"<?=(($CLIEN_COL_DIAFIM == "T") ? " Selected" : "")?>>TER&Ccedil;A-FEIRA</option>
            <option value="Q"<?=(($CLIEN_COL_DIAFIM == "Q") ? " Selected" : "")?>>QUARTA-FEIRA</option>
            <option value="I"<?=(($CLIEN_COL_DIAFIM == "I") ? " Selected" : "")?>>QUINTA-FEIRA</option>
            <option value="X"<?=(($CLIEN_COL_DIAFIM == "X") ? " Selected" : "")?>>SEXTA-FEIRA</option>
            <option value="B"<?=(($CLIEN_COL_DIAFIM == "B") ? " Selected" : "")?>>S&Aacute;BADO</option>
          </select>        </td>
        </tr>
      <tr>
        <td ><strong>Hor&aacute;rio para coleta* </strong></td>
        <td colspan="3" class=""><strong>Das</strong>          <input name="CLIEN_COL_HRINI" type="text" class="form" size="5" maxlength="5" value="<?=$CLIEN_COL_HRINI?>" onKeyUp="JSUtilMascara(this,event,'__:__');" onKeyPress="return JSUtilApenasNumero(event);"> 
          <strong>&agrave;s</strong>          <input name="CLIEN_COL_HRFIM" type="text" class="form" value="<?=$CLIEN_COL_HRFIM?>" size="5" maxlength="5" onKeyUp="JSUtilMascara(this,event,'__:__');" onKeyPress="return JSUtilApenasNumero(event);"></td>
      </tr>
      <tr>
        <td ><strong>N.&deg; de linhas x nf*</strong></td>
        <td colspan="3" class="">          <input name="CLIEN_QTDELINHANF" type="text" id="CLIEN_QTDELINHANF" value="<?=$CLIEN_QTDELINHANF?>" class="form" size="2" maxlength="2"></td>
      </tr>
      <tr class="">
        <td colspan="4" class="tit_form"><strong>Dados banc&aacute;rios</strong></td>
      </tr>
      <tr>
        <td ><strong>Banco</strong></td>
        <td colspan="3"><input name="CLIEN_COB_BANCO" type="text" class="form" id="CLIEN_COB_BANCO" value="<?=$CLIEN_COB_BANCO?>" size="5" maxlength="3"></td>
      </tr>
      <tr>
        <td ><strong>Ag&ecirc;ncia</strong></td>
        <td colspan="3" class=""><input name="CLIEN_COB_AGENCIA_CODIGO" type="text" class="form" id="CLIEN_COB_AGENCIA_CODIGO" value="<?=$CLIEN_COB_AGENCIA_CODIGO?>" size="7" maxlength="5"> 
          - 
          <input name="CLIEN_COB_AGENCIA_NOME" type="text" class="form" id="CLIEN_COB_AGENCIA_NOME" value="<?=$CLIEN_COB_AGENCIA_NOME?>" size="52" maxlength="50"></td>
      </tr>
      <tr>
        <td ><strong>N.&deg; da conta </strong></td>
         <td colspan="3" class=""><input name="CLIEN_COB_CONTA" type="text" class="form" id="CLIEN_COB_CONTA" value="<?=$CLIEN_COB_CONTA?>" size="22" maxlength="20"></td>
      </tr>
      <tr>
        <td ><strong>Titular da conta </strong></td>
        <td colspan="3" class=""><input name="CLIEN_COB_TITULAR" type="text" class="form" id="CLIEN_COB_AGENCIA_NOME3" value="<?=$CLIEN_COB_TITULAR?>" size="52" maxlength="50"></td>
      </tr>
	  
	  <tr class="">
        <td colspan="4" class="tit_form"><strong>Dados banc&aacute;rios 2</strong></td>
      </tr>
      <tr>
        <td ><strong>Banco</strong></td>
        <td colspan="3"><input name="CLIEN_COB2_BANCO" type="text" class="form" id="CLIEN_COB2_BANCO" value="<?=$CLIEN_COB2_BANCO?>" size="5" maxlength="3"></td>
      </tr>
      <tr>
        <td ><strong>Ag&ecirc;ncia</strong></td>
        <td colspan="3" class=""><input name="CLIEN_COB2_AGENCIA_CODIGO" type="text" class="form" id="CLIEN_COB2_AGENCIA_CODIGO" value="<?=$CLIEN_COB2_AGENCIA_CODIGO?>" size="7" maxlength="5"> 
          - 
          <input name="CLIEN_COB2_AGENCIA_NOME" type="text" class="form" id="CLIEN_COB2_AGENCIA_NOME" value="<?=$CLIEN_COB2_AGENCIA_NOME?>" size="52" maxlength="50"></td>
      </tr>
      <tr>
        <td ><strong>N.&deg; da conta </strong></td>
         <td colspan="3" class=""><input name="CLIEN_COB2_CONTA" type="text" class="form" id="CLIEN_COB2_CONTA" value="<?=$CLIEN_COB2_CONTA?>" size="22" maxlength="20"></td>
      </tr>
      <tr>
        <td ><strong>Titular da conta </strong></td>
        <td colspan="3" class=""><input name="CLIEN_COB2_TITULAR" type="text" class="form" id="CLIEN_COB2_AGENCIA_NOME3" value="<?=$CLIEN_COB2_TITULAR?>" size="52" maxlength="50"></td>
      </tr>
	  
      <tr>
        <td colspan="4"> <div align="center"><a href="javascript:verificaForm(document.form);">          
          <? if (returnAcess("CADCLIENTE") == "T") { ?>
          <img src="../img/bts/gravar.jpg" alt="Gravar dados" name="Image351" border="0" id="Image351">
        </a><a href="pesq_cliente.php">
        <? } ?>
        <img src="../img/bts/cancelar.jpg" alt="Cancelar grava&ccedil;&atilde;o dos dados" name="Image361" border="0" id="Image361"></a></div></td>
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
	if (formObj.CLIEN_COL_ENDER.value == "") {
		alert("Preencha o campo \"Endereço\"");
		formObj.CLIEN_COL_ENDER.focus();
		return;
	}
	if (formObj.CLIEN_COL_BAIRRO.value == "") {
		alert("Preencha o campo \"Bairro\"");
		formObj.CLIEN_COL_BAIRRO.focus();
		return;
	}
	if (formObj.CLIEN_COL_CIDADE.value == "") {
		alert("Preencha o campo \"Cidade\"");
		formObj.CLIEN_COL_CIDADE.focus();
		return;
	}
	if (formObj.CLIEN_COL_UF.value == "") {
		alert("Preencha o campo \"UF\"");
		formObj.CLIEN_COL_UF.focus();
		return;
	}
	if (formObj.CLIEN_COL_FONE.value == "") {
		alert("Preencha o campo \"FONE\"");
		formObj.CLIEN_COL_FONE.focus();
		return;
	}
	
	if (formObj.CLIEN_COL_DIAINI.value == "" || formObj.CLIEN_COL_DIAFIM.value == "") {
		alert("Preencha o campo \"Dias para coleta\"");
		return;
	}
	if (formObj.CLIEN_COL_DIAINI.selectedIndex > formObj.CLIEN_COL_DIAFIM.selectedIndex) {
		alert("O campo \"Dias para coleta\" está com valores inválidos !");
		return;
	}
	if (!JSValidacaohrs(formObj.CLIEN_COL_HRINI.value,true)) {
		alert("Preencha o campo \"Horário para coleta\"");
		formObj.CLIEN_COL_HRINI.focus();
		return;
	}
	if (!JSValidacaohrs(formObj.CLIEN_COL_HRFIM.value,true)) {
		alert("Preencha o campo \"Horário para coleta\"");
		formObj.CLIEN_COL_HRFIM.focus();
		return;
	}
	
	if (formObj.CLIEN_QTDELINHANF.value == "") {
		alert("Preencha o campo \"N.° LINHAS X NF\"");
		formObj.CLIEN_QTDELINHANF.focus();
		return;
	}
	
	if (formObj.CLIEN_COB_BANCO.value == "") {
		alert("Preencha o campo \"Dados bancários - código do banco\"");
		formObj.CLIEN_COB_BANCO.focus();
		return;
	}
	
	if (formObj.CLIEN_COB_AGENCIA_CODIGO.value == "") {
		alert("Preencha o campo \"Dados bancários - código da agência\"");
		formObj.CLIEN_COB_AGENCIA_CODIGO.focus();
		return;
	}
	
	if (formObj.CLIEN_COB_AGENCIA_NOME.value == "") {
		alert("Preencha o campo \"Dados bancários - nome da agência\"");
		formObj.CLIEN_COB_AGENCIA_NOME.focus();
		return;
	}
	
	if (formObj.CLIEN_COB_CONTA.value == "") {
		alert("Preencha o campo \"Dados bancários - número da conta\"");
		formObj.CLIEN_COB_CONTA.focus();
		return;
	}
	
	if (formObj.CLIEN_COB_TITULAR.value == "") {
		alert("Preencha o campo \"Dados bancários - titular da conta\"");
		formObj.CLIEN_COB_TITULAR.focus();
		return;
	}

	formObj.action = "cad_clienteok.php";		
	document.form.submit();
}
//-->
</script>