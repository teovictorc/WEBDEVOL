<? include("inc/headerI.inc.php"); 	
verifyAcess("DES_UTILITARIO_RAR","S");?>
<form name="form" method="post" action="util_deleta_rarok.php" enctype="multipart/form-data">
<tr>
    <td height="100%" valign="top" class="tab_conteudo">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="32" class="tab_titulo"><h4>Consulta individual de reclama&ccedil;&atilde;o</h4></td>
      </tr>
    </table>
	
	<table width="100%"  border="0" class="tab_cadastro">
     <tr>
       <td width="48%" height="10" class=""><strong>Informe o n&uacute;mero da reclama&ccedil;&atilde;o a ser consultada:</strong></td>
       <td width="52%" height="10">         <input name="Id" type="text" class="form" id="Id" value="<?=$_GET['Id']?>" size="13" maxlength="12"></td>
       </tr>
     <tr>
       <td colspan="2"> 
	   <div id="idButtons" style="display:" align="center">
	   <a href="javascript:verificaForm(document.form);" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image351','','imagens/pesquisar2.jpg',1)"><img src="imagens/pesquisar.jpg" name="Image351" width="78" height="20" border="0" id="Image351"></a><a href="javascript:voltar();" ><img src="../img/bts/cancelar.jpg" name="Image361" border="0" id="Image361"></a></div></td>
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
		alert("Preencha o campo \"Número da reclamação a ser consultada\"");
		return;
	}
	document.getElementById("idButtons").style.display = "none";
	
	formObj.action = "pesq_avaliacao_realizada.php?Destino=1&Id="+formObj.Id.value;
	document.form.submit();
}


//-->
</script>
</body>
</html>