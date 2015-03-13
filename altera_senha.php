<? include("inc/headerI.inc.php"); 



	$Sql = "select * from rar_usuario where usuar_ido = '".$_SESSION['sId']."'";

	$Stmt = mysql_query($Sql);

	if($Rs = mysql_fetch_assoc($Stmt)){

	

	}

	

?>

<link href="wfa.css" rel="stylesheet" type="text/css">

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

<body onLoad="MM_preloadImages('imagens/gravar2.jpg','imagens/cancelar2.jpg')">



<form name="form" method="post" action="altera_senhaok.php" enctype="multipart/form-data">

<table width="100%"  border="0" align="center">

     <tr>

       <td width="49%"><span class="titulo">:: Altera&ccedil;&atilde;o de senha :: </span></td>

       <td width="51%"><div align="right"><span class="titulo"></span></div></td>

     </tr>

  </table></td>

   <td><img name="webdevol_r7_c11" src="imagens/img/webdevol_r7_c11.jpg" width="33" height="38" border="0" alt=""></td>

  </tr>

  <tr>

   <td background="imagens/img/webdevol_r8_c1.jpg">&nbsp;</td>

   <td colspan="9"><table width="100%"  border="0" class="tabela">

     <tr>

       <td height="10" class="style2"><strong>Usu&aacute;rio</strong></td>

       <td height="10" class="campo_amarelo"><?=$Rs["USUAR_NOME"]?></td>

     </tr>

     <tr>

       <td height="10" class="style2"><strong>Login</strong></td>

       <td height="10" class="campo_amarelo"><?=$Rs["USUAR_LOGIN"]?></td>

     </tr>

     <tr>

       <td height="10" class="style2"><strong>Senha atual </strong></td>

       <td height="10"><input name="SENHA_ATUAL" type="password" class="campo_texto" id="SENHA_ATUAL" value="<?=$_GET['SENHA_ATUAL']?>" size="30" maxlength="30">

         <input name="SENHA_ATUAL_BD" type="hidden" class="campo_texto" id="SENHA_ATUAL_BD" value="<?=$Rs["USUAR_SENHA"]?>" size="50" maxlength="50"></td>

     </tr>

     <tr>

       <td width="34%" height="10" class="style2"><strong>Nova senha </strong></td>

       <td width="66%" height="10">         <input name="SENHA" type="password" class="campo_texto" id="SENHA" value="<?=$_GET['SENHA']?>" size="30" maxlength="30"></td>

       </tr>

     <tr>

       <td height="10" class="style2"><strong>Repita nova senha </strong></td>

       <td height="10"><input name="SENHA2" type="password" class="campo_texto" id="SENHA2" value="<?=$_GET['SENHA2']?>" size="30" maxlength="30"></td>

     </tr>

     <tr>

       <td colspan="2"> 

	   <div id="idButtons" style="display:" align="center">

	   <a href="javascript:verificaForm(document.form);" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image351','','imagens/gravar2.jpg',1)"><img src="imagens/gravar.jpg" name="Image351" width="58" height="20" border="0" id="Image351"></a><a href="pesq_defeitos.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image361','','imagens/cancelar2.jpg',1)"><img src="imagens/cancelar.jpg" name="Image361" width="68" height="20" border="0" id="Image361"></a></div></td>

       </tr>

   </table>

   <input type="hidden" name="TOTAL_ITENS" value="15">

</form>

<? include("inc/headerF.inc.php"); ?>

<script language="javascript" type="text/javascript">

<!--

function verificaForm(formObj) {



	if (formObj.SENHA_ATUAL.value == "") {

		alert("Informe a senha atual !");

		formObj.SENHA_ATUAL.focus();

		return;

	}

	

	if (formObj.SENHA_ATUAL.value.toUpperCase() != formObj.SENHA_ATUAL_BD.value.toUpperCase()) {

		alert("Senha atual incorreta !");

		formObj.SENHA_ATUAL.focus();

		return;

	}

	

	if (formObj.SENHA.value == "") {

		alert("Informe a nova senha !");

		formObj.SENHA.focus();

		return;

	}

	

	if (formObj.SENHA2.value == "") {

		alert("Informe o campo REPITA NOVA SENHA !");

		formObj.SENHA2.focus();

		return;

	}

	

	if (formObj.SENHA.value.toUpperCase() != formObj.SENHA2.value.toUpperCase()) {

		alert("As senhas informadas estão diferentes !");

		formObj.SENHA2.focus();

		return;

	}

	

	document.getElementById("idButtons").style.display = "none";

	

	formObj.action = "altera_senhaok.php";

	document.form.submit();

}





//-->

</script>

