<? include("inc/headerI.inc.php");

verifyAcess("CADFABRICANTE","S");?>

<?



	if (trim($_GET['Id'])) {

		$Stmt = mysql_query("SELECT * FROM rar_fabrica WHERE FABRI_IDO = '" .$_GET['Id']. "'");

		$ID = $_GET["Id"];

		if ($Rs = mysql_fetch_assoc($Stmt)) {

			$FABRI_CODSOLA = $Rs["FABRI_CODSOLA"];

			$FABRI_PESSOA = $Rs["FABRI_PESSOA"];

			$FABRI_AGENT_IDO = $Rs["FABRI_AGENT_IDO"];
			
			$FABRI_EMAIL = $Rs["FABRI_EMAIL"];

		}

	}



?>

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

<tr>

    <td height="100%" valign="top" class="tab_conteudo">

    <table width="100%" border="0" cellspacing="0" cellpadding="0">

      <tr>

        <td height="100%" class="tab_titulo"><h4>Cadastro de fabricante</h4></td>

      </tr>

    </table>

<form name="form" method="post" action="" enctype="application/x-www-form-urlencoded">

<input type="hidden" name="ID" value="<?=$ID?>">

	

	<table width="748" border="0" class="tab_inclusao">

      <tr>

        <td width="22%" class=""><strong>Selecione o fabricante:</strong></td>

        <td><select name="FABRI_PESSOA" class="form" id="FABRI_PESSOA">

				<option value="" selected>..Selecione</option>

				<? $Stmt = mysql_query("SELECT NOME,PESSOA FROM pessoa WHERE EFORNECEDOR = 'S' ORDER BY PESSOA, NOME");

				   while($Rs = mysql_fetch_assoc($Stmt)) {  ?>

		   		<option value="<?=$Rs["PESSOA"]?>"<?=(($FABRI_PESSOA == $Rs["PESSOA"]) ? " Selected" : "")?>><?=$Rs["PESSOA"]?> - <?=$Rs["NOME"]?></option>

				<? } ?>

        </select>		</td>
      </tr>

      <tr>

        <td class=""><strong>C&oacute;digo da sola:</strong></td>

        <td width="78%"><input name="FABRI_CODSOLA" type="text" class="form" value="<?=$FABRI_CODSOLA?>" size="6" maxlength="4"></td>
      </tr>

	  <tr>

        <td class=""><strong>Agente</strong></td>

        <td width="78%"><select name="FABRI_AGENT_IDO" class="form" id="FABRI_AGENT_IDO">

							<option value="" selected>..Selecione</option>

							<? $Stmt = mysql_query("SELECT * FROM rar_agente ORDER BY AGENT_NOME");

							   while($Rs = mysql_fetch_assoc($Stmt)) {  ?>

							<option value="<?=$Rs["AGENT_IDO"]?>"<?=(($FABRI_AGENT_IDO == $Rs["AGENT_IDO"]) ? " Selected" : "")?>><?=$Rs["AGENT_NOME"]?></option>

							<? } ?>

						</select>		</td>
      </tr>
	  <tr>
	    <td><strong>Email</strong></td>
	    <td><input name="FABRI_EMAIL" type="text" class="form" id="FABRI_EMAIL" value="<?=$FABRI_EMAIL?>" size="30" maxlength="50" /></td>
	    </tr>

	  <tr>

        <td colspan="2">			

			<div align="center"><a href="javascript:verificaForm();" >

          	<? if (returnAcess("CADFABRICANTE") == "T") { ?>

        	</a><a href="javascript:verificaForm(document.form);" ><img src="../img/bts/gravar.jpg" alt="Gravar dados" name="Image351" border="0" id="Image351"></a><a href="javascript:verificaForm();" >

        <? } ?>

        </a><a href="pesq_fabricante.php" ><img src="../img/bts/cancelar.jpg" alt="Cancelar grava&ccedil;&atilde;o dos dados" name="Image361" border="0" id="Image361"></a></div>        </td>
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

	if (formObj.FABRI_PESSOA.value == "") {

		alert("Preencha o campo \"Fábrica\"");

		formObj.FABRI_PESSOA.focus();

		return;

	}

	if (formObj.FABRI_CODSOLA.value == "") {

		alert("Preencha o campo \"Código da sola\"");

		formObj.FABRI_CODSOLA.focus();

		return;

	}

	

	if (formObj.FABRI_AGENT_IDO.value == "") {

		alert("Preencha o campo \"Agente\"");

		formObj.FABRI_AGENT_IDO.focus();

		return;

	}



	formObj.action = "cad_fabricasok.php";

	document.form.submit();

}



//-->

</script>

</body>

</html>