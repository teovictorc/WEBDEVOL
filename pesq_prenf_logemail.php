<? include("inc/headerI.inc.php");
verifyAcess("CLIEN_PRENFLOGEMAIL","S");
?>
<link href="wfa.css" rel="stylesheet" type="text/css">
<form name="form" method="get" action="pesq_prenf_logemail.php">
<tr>
    <td height="100%" valign="top" class="tab_conteudo">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="100%" class="tab_titulo"><h4>Consulta de log de e-mail de pré-notas</h4></td>
      </tr>
    </table>
    <table width="100%"  border="0" class="tab_conteudo">

      
      <tr>
        <td width="100%"> <div align="center">
          <table width="100%"  border="0" align="center" class="tab_conteudo" cellpadding="0" cellspacing="0">
            <tr class="tab_usuarios" >
				<? if ("S" != $_GET['cliente']){ ?>
           		  <? } ?>
              <td width="10%" ><div align="center">N&ordm; Pr&eacute;-nota</div></td>
              <td width="12%" height="25" ><div align="center">Data/hora envio </div></td>
              <td width="10%" ><div align="left">Usu&aacute;rio</div></td>
              <td width="20%" >Cliente</td>
              <td width="35%" >Mensagem</td>
              <td width="13%" ><div align="left">Destinat&aacute;rio</div></td>
              </tr>
<?
	$_pagi_sql = "SELECT *, ".
	               " date_format(PRENFE_DATA,'%d/%m/%Y %H:%I') DATA ".
			  " FROM rar_prenf, pessoa, rar_usuarioxcliente, rar_prenf_email, rar_usuario ".
			 " WHERE PESSOA = PRENF_PESSOA_DESTINATARIO ".
			 "       AND USUCLI_PESSOA = PRENF_PESSOA_DESTINATARIO ".
			 "       AND PRENF_NUMPRENF = PRENFE_NUMPRENF ".
			 "       AND USUAR_IDO = PRENFE_USUAR_IDO ".
			 "       AND USUCLI_USUAR_IDO = '" .$_SESSION['sId']. "'";
	$_pagi_sql.= " ORDER BY PRENFE_DATA DESC, PRENF_NUMPRENF";

	include_once("inc/paginator.inc.php");

	$Stmt = mysql_query($Sql);
	$TotalReclamacao = 0;
	$TotalPares = 0;
	while($Rs = mysql_fetch_assoc($_pagi_result)) {
			$TotalReclamacao = $TotalReclamacao + 1;
		    $TotalPares = $TotalPares + $Rs["QTDE"];
		    ?>
			<tr bordercolor="#00CCFF" class="tab_usuarios_info" >
			  <td align="center"><div align="center"><a href="consulta_pre_nota.php?Destino=3&Id=<?=$Rs["PRENF_NUMPRENF"]?>">
                  <?=$Rs["PRENFE_NUMPRENF"]?>
              </a></div></td>
              <td align="center"><?=$Rs["DATA"]?></td>
              <td align="left"><?=$Rs["USUAR_NOME"]?></td>
              <td><?=$Rs["PESSOA"]." - ".$Rs["NOME"]?></td>
              <td><?=$Rs["PRENFE_MENSAGEM"]?></td>
              <td align="left"><?=$Rs["PRENFE_REMETENTE"]?></td>
              </tr>

<? } ?>
          </table>
          </div></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table>
	<br/ >
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><p>P&aacute;ginas:&nbsp;<?= $_pagi_navegacion ?></p></td>
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

function confirmar() {
	Values = chk_checkedAllValues(document.form.ID,true);
	if (Values == "") {
		alert("Nenhuma reclamção assinalada !");
		return;
	}
	document.location.href = "pesq_prenf_inativaok.php?Ids=" + Values;
}

function FilterSearch() {
	if (document.form.DT_INICIAL.value == "" || document.form.DT_FINAL.value == "") {
		alert("Preencha os campos data final e inicial");
		return;
	}
	if (!JSUtilValidaData(document.form.DT_INICIAL.value,false) || !JSUtilValidaData(document.form.DT_FINAL.value,false)) {
		alert("As datas informadas devem ser datas validas !");
		return;
	}
	document.form.submit();
}

function chk_checkedAllValues(elementForm,checked,optionDiv,valueEncode) {
	if (elementForm) {
		if (elementForm.length == undefined) {
			if (elementForm.checked == checked)
				return elementForm.value;
			return "";
		}else{
			var Values = "";
			optionDiv = (optionDiv == undefined) ? "," : optionDiv;
			valueEncode = (valueEncode == undefined) ? false : valueEncode;
			for(x = 0; x < elementForm.length; x++) {
				if (elementForm[x].checked == checked) 
					Values+= ((Values.length > 0) ? optionDiv : "") + ((valueEncode) ? escape(elementForm[x].value) : elementForm[x].value);
			}
			return Values;
		}
	}
	return "";
}
//-->
</script>