<? include("inc/headerI.inc.php"); 	
verifyAcess("ARZ_CONS_PRENF","S");?>
<form name="form" method="post" action="util_deleta_rarok.php" enctype="multipart/form-data">
<tr>
    <td height="100%" valign="top" class="tab_conteudo">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="32" class="tab_titulo"><h4>Consulta de pr&eacute;-nota emitida</h4></td>
      </tr>
      </table>  

	<table width="100%"  border="0" class="tab_inclusao">
     <tr>
       <td width="39%" height="10" class=""><strong>Informe o n&uacute;mero da NF a ser consultada:</strong></td>
       <td width="61%" height="10">         <input name="Id" type="text" class="form" id="Id" value="<?=$_GET['Id']?>" size="12" maxlength="11"></td>
       </tr>
     <tr>
       <td height="10" class=""><strong>Informe o c&oacute;digo do cliente: </strong></td>
       <td height="10">
         <input name="Pessoa" type="text" class="form" id="Pessoa" value="<?=$_GET['Pessoa']?>" size="12" maxlength="11"></td>
     </tr>
     <tr>
       <td colspan="2"> 
	   <div id="idButtons" style="vertical-align:top;" align="center">
	   <a href="javascript:verificaForm(document.form);" ><img src="../img/bts/buscar.jpg" name="Image351" border="0" id="Image351"></a><a href="javascript:voltar();"><img src="../img/bts/cancelar.jpg" name="Image361" border="0" id="Image361"></a></div></td>
       </tr>
   </table>
   <input type="hidden" name="TOTAL_ITENS" value="15">
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

	if (formObj.Id.value == "") {
		alert("Preencha o campo \"Número da NF a ser consultada\"");
		return;
	}
	
	if (formObj.Pessoa.value == "") {
		alert("Preencha o campo \"Código do cliente\"");
		return;
	}
	document.getElementById("idButtons").style.display = "none";
	
	formObj.action = "pesq_retaguarda_prenotaok.php?Id="+formObj.Id.value+"&Pessoa="+formObj.Pessoa.value;
	document.form.submit();
}


//-->
</script>
