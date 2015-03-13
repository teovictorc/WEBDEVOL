<? include("inc/headerI.inc.php"); 	
verifyAcess("DES_UTILITARIO_RAR","S");?>
<form name="form" method="post" action="util_deleta_rarok.php" enctype="multipart/form-data">
<tr>
    <td height="100%" valign="top" class="tab_conteudo">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="32" class="tab_titulo"><h4>Excluir reclama&ccedil;&atilde;o</h4></td>
      </tr>
      </table>
	  
	<table width="100%"  border="0" class="tab_conteudo">
     <tr>
       <td height="10" class=""><strong>N.&ordm; reclama&ccedil;&atilde;o:</strong></td>
       <td height="10">
         <input name="RAR" type="text" class="form" id="RAR" value="<?=$_GET['RAR']?>" size="50" maxlength="50"></td>
     </tr>
     <tr>
       <td height="10" class="style2">&nbsp;</td>
       <td height="10">&nbsp;</td>
     </tr>
     <tr>
       <td height="10" class="">Solicitante</td>
       <td height="10"><input name="SOLICITANTE" type="text" class="form" id="SOLICITANTE" value="<?=$_GET['SOLICITANTE']?>" size="50" maxlength="50"></td>
     </tr>
     <tr>
       <td height="10" valign="top" class="">Motivo</td>
       <td height="10"><input name="MOTIVO" type="text" class="form" id="MOTIVO" value="<?=$_GET['MOTIVO']?>" size="80"></td>
     </tr>
     <tr>
       <td height="10" class="style2">&nbsp;</td>
       <td height="10">&nbsp;</td>
     </tr>
     <tr>
       <td width="100%" colspan="2"> 
	   <div id="idButtons" style="display:" align="center">
	   <a href="javascript:verificaForm(document.form);" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image351','','imagens/excluir2.jpg',1)"><img src="imagens/excluir.jpg" name="Image351" width="68" height="20" border="0" id="Image351"></a><a href="pesq_defeitos.php" ><img src="../img/bts/cancelar.jpg" name="Image361" border="0" id="Image361"></a></div></td>
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

	if (formObj.RAR.value == "") {
		alert("Preencha o campo \"N.º reclamação\"");
		formObj.RAR.focus();
		return;
	}
	
	if (formObj.SOLICITANTE.value == "") {
		alert("Preencha o campo \"Solicitante\"");
		formObj.SOLICITANTE.focus();
		return;
	}
	
	if (formObj.MOTIVO.value == "") {
		alert("Preencha o campo \"Motivo\"");
		formObj.MOTIVO.focus();
		return;
	}
	
	document.getElementById("idButtons").style.display = "none";
	
	formObj.action = "util_deleta_rarok.php";
	document.form.submit();
}


//-->
</script>
