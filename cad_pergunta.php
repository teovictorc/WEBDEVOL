<? include("inc/headerI.inc.php"); 

	verifyAcess("CADPDV_PERGUNTA","S");

	$PERGU_ATIVO = "S";

	if (trim($_GET['Id'])) {

		$Sql = "SELECT * FROM RAR_PDV_PERGUNTA WHERE PERGU_IDO = '" .$_GET['Id']. "'";

		$Stmt = mysql_query($Sql,$Conn);

		$ID = $_GET["Id"];

		if ($Rs = mysql_fetch_assoc($Stmt)) {

			$PERGU_IDO 			= $Rs["PERGU_IDO"];

			$PERGU_PERGUNTA 	= $Rs["PERGU_PERGUNTA"];

			$PERGU_LEGENDA 		= $Rs["PERGU_LEGENDA"];

			$PERGU_ATIVO		= $Rs["PERGU_ATIVO"];

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







<link href="wfa.css" rel="stylesheet" type="text/css">

<body onLoad="MM_preloadImages('imagens/gravar2.jpg','imagens/cancelar2.jpg')">

<form name="form" method="post" action="cad_perguntaok.php">

<input type="hidden" name="ID" value="<?=$ID?>">

<table width="100%"  border="0" align="center">

     <tr>

       <td width="49%"><span class="titulo">:: Cadastro de perguntas ::</span></td>

       <td width="51%"><div align="right"><span class="titulo"><a href="javascript: abrir_help('#cadequipe');">Help</a></span></div></td>

     </tr>

  </table></td>

   <td><img name="webdevol_r7_c11" src="imagens/img/webdevol_r7_c11.jpg" width="33" height="38" border="0" alt=""></td>

  </tr>

  <tr>

   <td background="imagens/img/webdevol_r8_c1.jpg">&nbsp;</td>

   <td colspan="9">

    <table width="100%"  border="0" class="tabela">

      <tr>

        <td width="17%" class="style2"><strong>Pergunta</strong></td>

        <td width="83%"><input name="PERGU_PERGUNTA" type="text" class="campo_texto" id="PERGU_PERGUNTA" value="<?=$PERGU_PERGUNTA?>" size="50" maxlength="50"></td>

      </tr>

      <tr>

        <td class="style2"><strong>Legenda</strong></td>

        <td><textarea name="PERGU_LEGENDA" cols="100%" rows="5" class="campo_texto" id="PERGU_LEGENDA"><?=$PERGU_LEGENDA?>

        </textarea></td>

      </tr>

      <tr>

        <td class="style2"><strong>Ativo</strong></td>

        <td class="style2">

		<select name="PERGU_ATIVO" class="campo_texto" id="PERGU_ATIVO">

            <option value="S" <? if ($PERGU_ATIVO == "S"){?> selected <? }?>>Sim</option>

            <option value="N" <? if ($PERGU_ATIVO == "N"){?> selected <? }?>>N�o</option>

        </select></td>

      </tr>

      <tr>

        <td class="style2">&nbsp;</td>

        <td>&nbsp;</td>

      </tr>

      <tr>

        <td>&nbsp;</td>

        <td> <a href="javascript:verificaForm();" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image351','','imagens/gravar2.jpg',1)">

          <? if (returnAcess("CADPDV_PERGUNTA") == "T") { ?>

        </a><a href="javascript:verificaForm(document.form)" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image351','','imagens/gravar2.jpg',1)"><img src="imagens/gravar.jpg" alt="Gravar dados" name="Image351" width="58" height="20" border="0" id="Image351"></a><a href="javascript:verificaForm();" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image351','','imagens/gravar2.jpg',1)">

        <? } ?>

        </a><a href="pesq_tiposervico.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image361','','imagens/cancelar2.jpg',1)"><img src="imagens/cancelar.jpg" alt="Cancelar grava&ccedil;&atilde;o dos dados" name="Image361" width="68" height="20" border="0" id="Image361"></a></td>

      </tr>

    </table>

</form>

<? include("inc/headerF.inc.php"); ?>

<script language="javascript" type="text/javascript">

<!--

function verificaForm(formObj) {

	

	if (formObj.PERGU_PERGUNTA.value == "") {

		alert("Preencha o campo \"Pergunta\"");

		formObj.PERGU_PERGUNTA.focus();

		return;

	}

	

	if (formObj.PERGU_LEGENDA.value == "") {

		alert("Preencha o campo \"LEGENDA\"");

		formObj.PERGU_LEGENDA.focus();

		return;

	}

	

	if (formObj.PERGU_ATIVO.value == "") {

		alert("Preencha o campo \"ATIVO\"");

		formObj.PERGU_ATIVO.focus();

		return;

	}

	

	formObj.action = "cad_perguntaok.php";		

	document.form.submit();

}



//-->

</script>