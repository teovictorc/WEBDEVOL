<? include("inc/headerI.inc.php"); 
	if ($_GET["Categoria"] == "1"){
		$Categoria = "Cal�ados";
	}elseif ($_GET["Categoria"] == "2,3,4"){
		$Categoria = "Bolsa - Cinto - Carteira";
	}

?>
<form name="form" method="post" action="rel_indice_defeitos_resumook.php" target="windowPrint">
<table width="100%"  border="0" align="center">
     <tr class="">
		 <td width="49%" class="tab_titulo" style="padding-top:15px;"><h4>�ndice de defeitos - resumo</h4></td>
	</tr>
</table>
<? require_once("rel_filtros_inc.php"); ?>
<table width="100%"  border="0" align="center">
        <tr  class="listagem">
          <td width="11%" >
            <div align="center">
              <input name="C_TEMPO" type="checkbox" onClick="checkControl(this.checked,new Array('TEMPO'))" class="style1" id="C_TEMPO" value="radiobutton">
        </div></td>
          <td width="16%" a href="cad_defeitos.php">Tempo</td>
          <td width="73%" a href="cad_defeitos.php">
            <select name="TEMPO" class="campo_texto" id="TEMPO" disabled>
              <option value="">...Selecione</option>
              <option value="1">At&eacute; 9 meses</option>
              <option value="2">Mais que 9 meses</option>
              <option value="3">Todos</option>
          </select>
        </td>
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
		alert("Preencha o campo \"Data de abertura\" ou desabilite a op��o !");
		formObj.LANCA_DATAABERTURAI.focus();
		return;
	}
	if (!JSUtilValidaData(formObj.AVALI_AREZ_DATAI.value,formObj.C_AVALI_AREZ_DATA.checked)
		|| !JSUtilValidaData(formObj.AVALI_AREZ_DATAF.value,formObj.C_AVALI_AREZ_DATA.checked)) {
		alert("Preencha o campo \"Data de abertura\" ou desabilite a op��o !");
		formObj.AVALI_AREZ_DATAI.focus();
		return;
	}
	abrir_janela_popup('','windowPrint','width=800,height=540,top=0,left=0, scrollbars=yes,status=yes,resizable=yes,dependent=yes');
	document.form.submit();
}
//-->
</script>