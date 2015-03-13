<? include("inc/headerI.inc.php"); 

	if ($_GET["Categoria"] == "1"){

		$Categoria = "Calçados";

	}elseif ($_GET["Categoria"] == "2,3,4"){

		$Categoria = "Bolsa - Cinto - Carteira";

	}



?>

<form name="form" method="post" action="rel_indice_geral_mensal_modelook.php" target="windowPrint">

<table width="100%"  border="0" align="center">

     <tr class="">

		 <td width="49%" class="tab_titulo" style="padding-top:15px;"><h4>Índice geral mensal - modelo</h4></td>

	</tr>

</table>

<? 
$ExibeFiltroAgruparPor = "S";
require_once("rel_filtros_inc.php"); ?>

<tr  class="">

  <td colspan="3" ><div align="center">

	  <input name="Button" type="button" class="campo_texto" value="Imprimir" onClick="validaForm(document.form);">

	  &nbsp;

	  <input name="Submit2" type="reset" class="campo_texto" value="Limpar" onClick="clearForm();">

  </div></td>

</tr>

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

	abrir_janela_popup('','windowPrint','width=800,height=540,top=0,left=0, scrollbars=yes,status=yes,resizable=yes,dependent=yes');

	document.form.submit();

}

//-->

</script>