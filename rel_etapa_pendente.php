<? include("inc/headerI.inc.php"); 
	if ($_GET["Categoria"] == "1"){
		$Categoria = "Calçados";
		$Chegada = "na Andarella";
	}elseif ($_GET["Categoria"] == "2,3,4"){
		$Categoria = "Bolsa - Cinto - Carteira";
		$Chegada = "no Fornecedor";
	}

?>
<link href="wfa.css" rel="stylesheet" type="text/css">

<form name="form" method="post" action="rel_etapa_pendenteok.php" target="windowPrint">
<table width="100%"  border="0" align="center">
     <tr class="">
		 <td width="49%" class="tab_titulo" style="padding-top:15px;"><h4>Relat&oacute;rio de etapas pendentes</h4></td>
	</tr>
</table>
<? require_once("rel_filtros_inc.php"); ?>

<table width="100%"  border="0" align="center">
        <tr  class="">
          <td width="4%" >
            <div align="center">
              <input name="C_CHEGADA" onClick="checkControl(this.checked,new Array('CHEGADAI','CHEGADAF'))" type="checkbox" id="C_CHEGADA" value="radiobutton">
        </div></td>
          <td width="23%" a href="cad_defeitos.php">Chegada transportadora</td>
          <td width="73%" a href="cad_defeitos.php"> <span class="style1">de
                <input name="CHEGADAI" type="text" id="CHEGADAI" class="form" style="border: 1px solid #999; color: #072A66; font-size: 11px; padding: 3px; vertical-align: middle; width: auto; font-family: tahoma; line-height: 10px; font-style: normal;" size="9" maxlength="10" disabled onKeyPress="return JSUtilApenasNumero(event);" onKeyUp="JSUtilMascara(this,event,'__/__/____');" #invalid_attr_id="#FFF">
    a
    <input name="CHEGADAF" type="text" id="CHEGADAF" class="form" style="border: 1px solid #999; color: #072A66; font-size: 11px; padding: 3px; vertical-align: middle; width: auto; font-family: tahoma; line-height: 10px; font-style: normal;" size="9" maxlength="10"  disabled onKeyPress="return JSUtilApenasNumero(event);" onKeyUp="JSUtilMascara(this,event,'__/__/____');" #invalid_attr_id="#FFF">
        </span> </td>
        </tr>
        <tr  class="listagem"
>
          <td >
            <div align="center">
              <input name="C_CHEGADA2" onClick="checkControl(this.checked,new Array('CHEGADA2I','CHEGADA2F'))" type="checkbox"  id="C_CHEGADA2" value="radiobutton">
          </div></td>
          <td a href="cad_defeitos.php">Chegada <?=$Chegada?></td>
          <td a href="cad_defeitos.php"> <span class="style1">de
                <input name="CHEGADA2I" type="text" id="CHEGADA2I" class="form" style="border: 1px solid #999; color: #072A66; font-size: 11px; padding: 3px; vertical-align: middle; width: auto; font-family: tahoma; line-height: 10px; font-style: normal;" size="9" maxlength="10" disabled onKeyPress="return JSUtilApenasNumero(event);" onKeyUp="JSUtilMascara(this,event,'__/__/____');" #invalid_attr_id="#FFF">
    a
    <input name="CHEGADA2F" type="text" id="CHEGADA2F" class="form" style="border: 1px solid #999; color: #072A66; font-size: 11px; padding: 3px; vertical-align: middle; width: auto; font-family: tahoma; line-height: 10px; font-style: normal;" size="9" maxlength="10"  disabled onKeyPress="return JSUtilApenasNumero(event);" onKeyUp="JSUtilMascara(this,event,'__/__/____');" #invalid_attr_id="#FFF">
          </span> </td>
        </tr>
        <tr  class="listagem"
>
          <td >&nbsp;</td>
          <td a href="cad_defeitos.php">Listar pend&ecirc;ncia etapa: </td>
          <td a href="cad_defeitos.php"><select name="etapa" class="form" id="etapa">
            <option>-- Selecione --</option>
            <!--<option value="1">AVALIA&Ccedil;&Atilde;O</option>
            <option value="2">PR&Eacute;-NOTA</option>
            <option value="3">NF DEVOLU&Ccedil;&Atilde;O</option>-->
            <option value="4">SOLICITA&Ccedil;&Atilde;O COLETA</option>
            <option value="5">COLETA DE CLIENTE</option>
            <option value="6">CHEGADA TRANSPORTADORA</option>
			<?
			if ($_GET["Categoria"] == "1"){
				?>
				<option value="7">CHEGADA ANDARELLA</option>								<option value="8">CHEGADA FORNECEDOR</option>
				<!--<option value="8">IMPORTA&Ccedil;&Atilde;O SISTEMA ANDARELLA</option>-->
				<option value="9">CR&Eacute;DITO CONCEDIDO</option>
			<? } else {?>
				<option value="7">CHEGADA FORNECEDOR</option>
				<option value="8">INFORMAÇÃO CRÉDITO</option>
				<option value="9">CR&Eacute;DITO CONCEDIDO</option>
            <? } ?>        
			</select></td>
        </tr>
        <tr  class="listagem">
          <td >&nbsp;</td>
          <td a href="cad_defeitos.php">&nbsp;</td>
          <td a href="cad_defeitos.php"><span class="style1">
            <input name="LANCA_CATEGORIA" type="hidden" id="LANCA_CATEGORIA" value="<?=$_GET["Categoria"]?>">
          </span></td>
        </tr>
        <tr  class="listagem">
          <td colspan="3" ><div align="center">
              <input name="Button" type="button" class="campo_texto" value="Imprimir" onClick="validaForm(document.form);">
              &nbsp;
              <input name="Submit2" type="reset" class="campo_texto" value="Limpar" onClick="clearForm();">
          </div></td>
        </tr>
      </table>
</form>

<script language="javascript" type="text/javascript">
<!--
function checkControl(option,elements) {
	for (x = 0; x < elements.length; x++) {
		document.form.elements[elements[x]].disabled = !option;
		if (!option)
			document.form.elements[elements[x]].value = "";
	}
}
function clearForm() {
	for(x = 0; x < document.form.elements.length - 2; x++) {
		if (document.form.elements[x].name.substring(0,2) != "C_")
			document.form.elements[x].disabled = true;
	}
}
function validaForm(formObj) {
	if (!JSUtilValidaData(formObj.LANCA_DATAABERTURAI.value,formObj.C_LANCA_DATAABERTURA.checked)
		|| !JSUtilValidaData(formObj.LANCA_DATAABERTURAF.value,formObj.C_LANCA_DATAABERTURA.checked)) {
		alert("Preencha o campo \"Data de abertura\" ou desabilite a opção !");
		formObj.LANCA_DATAABERTURAI.focus();
		return;
	}
	if (!JSUtilValidaData(formObj.AVALI_AREZ_DATAI.value,formObj.C_AVALI_AREZ_DATA.checked)
		|| !JSUtilValidaData(formObj.AVALI_AREZ_DATAF.value,formObj.C_AVALI_AREZ_DATA.checked)) {
		alert("Preencha o campo \"Data de abertura\" ou desabilite a opção !");
		formObj.AVALI_AREZ_DATAI.focus();
		return;
	}
	
	if (formObj.etapa.value == ""){
		alert("Preencha o campo \"Listar pendência etapa\" !");
		formObj.etapa.focus();
		return;
	}
	abrir_janela_popup('','windowPrint','width=800,height=540,top=0,left=0, scrollbars=yes,status=yes,resizable=yes,dependent=yes');
	document.form.submit();
}
//-->
</script>