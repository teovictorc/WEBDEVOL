<? include("inc/headerI.inc.php"); 	

verifyAcess("DES_UTIL_VINCCLIENTE","S");

	$Sql = "select date_format(CONFIG_VINC_USUARIOXCLIENTE,'%d/%m/%Y %h:%i') CONFIG_VINC_USUARIOXCLIENTE from rar_config";

	$Stmt = mysql_query($Sql);

	if($Rs = mysql_fetch_assoc($Stmt)){

		if ($Rs["CONFIG_VINC_USUARIOXCLIENTE"] != ""){

			$Data = $Rs["CONFIG_VINC_USUARIOXCLIENTE"];

		}else{

			$Data = "Nenhuma vinculação realizada ainda!";

		}

	}





?>

<link href="wfa.css" rel="stylesheet" type="text/css">



<form name="form" method="post" action="util_usuariosxlojaok.php" enctype="multipart/form-data">

<table width="100%"  border="0" align="center">

     <tr>

       <td width="49%"><span class="titulo">:: Vincula&ccedil;&atilde;o de usu&aacute;rios x clientes:: </span></td>

       <td width="51%"><div align="right"><span class="titulo"><a href="javascript: abrir_help('#delprenf');">Help</a></span></div></td>

     </tr>

  </table></td>

   <td><img name="webdevol_r7_c11" src="imagens/img/webdevol_r7_c11.jpg" width="33" height="38" border="0" alt=""></td>

  </tr>

  <tr>

   <td background="imagens/img/webdevol_r8_c1.jpg">&nbsp;</td>

   <td colspan="9"><table width="100%"  border="0" class="tabela">

     <tr>

       <td width="30%" height="10" class="style2"><strong>Data/hora &uacute;ltima vincula&ccedil;&atilde;o:</strong></td>

       <td width="79%" height="10" class="campo_amarelo"><?=$Data?></td>

       </tr>

     <tr>

       <td height="10" colspan="2" class="style2">Obs.: o processo de vincula&ccedil;&atilde;o demorar&aacute; alguns minutos. </td>

       </tr>

     <tr>

       <td colspan="2">&nbsp;</td>

     </tr>

     <tr>

       <td colspan="2"> 

	   <div id="idButtons" style="display:" align="center">	   

	     <input name="Submit" type="submit" class="campo_texto" value="Executar vincula&ccedil;&atilde;o">

	   </div></td>

       </tr>

   </table>

   <input type="hidden" name="TOTAL_ITENS" value="15">

</form>

<? include("inc/headerF.inc.php"); ?>

<script language="javascript" type="text/javascript">

<!--

function verificaForm(formObj) {



	if (formObj.PRENOTA.value == "") {

		alert("Preencha o campo \"Número da pré-nota a ser excluída\"");

		formObj.PRENOTA.focus();

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

	

	formObj.action = "util_deleta_prenotaok.php";

	document.form.submit();

}





//-->

</script>

