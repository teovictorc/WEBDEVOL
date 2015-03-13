<html>

<script language="JavaScript" type="text/JavaScript">

<!--

function abrir_janela_popup(theURL,winName,features) { //v2.0

window.open(theURL,winName,features);

}

//-->

</script>

<script language="JavaScript" type="text/JavaScript">

<!--







function MM_preloadImages() { //v3.0

  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();

    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)

    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}

}

//-->

</script>

<head>

<title>WEBDevol</title>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<!--Fireworks MX 2004 Dreamweaver MX 2004 target.  Created Mon Apr 25 21:07:14 GMT-0300 (Hora oficial do Brasil) 2005-->



<link href="wfa.css" rel="stylesheet" type="text/css">

<form name="form" method="post" action="">

<div id="Layer1" style="position:absolute; left:249px; top:57px; width:69px; height:29px; z-index:1; visibility: hidden;"><a href=http://www.milonic.com/styleproperties.php class="style1">http://www.milonic.com/styleproperties.php</a></div>



<link href="wfa.css" rel="stylesheet" type="text/css">

</head>

<body bgcolor="#ffffff">

	

<table width="760" border="0" cellpadding="0" cellspacing="0">

  <!-- fwtable fwsrc="wfa_arezzo.png" fwbase="wfa_arezzo.jpg" fwstyle="Dreamweaver" fwdocid = "2082307123" fwnested="0" -->

  <tr>

    <td width="36"><img name="webdevol_r7_c1" src="imagens/img/webdevol_r7_c1.jpg" width="35" height="38" border="0" alt=""></td>

    <td background="imagens/fundo_tabela_topo.jpg"><table width="100%"  border="0" align="center">

        <tr>

          <td width="49%"><span class="titulo">:: Visualiza&ccedil;&atilde;o foto ampliada:: </span></td>

          <td width="51%"><div align="right">&nbsp;</div></td>

        </tr>

    </table></td>

    <td width="34"><img name="webdevol_r7_c11" src="imagens/img/webdevol_r7_c11.jpg" width="33" height="38" border="0" alt=""></td>

  </tr>

  <tr>

    <td background="imagens/img/webdevol_r8_c1.jpg">&nbsp;</td>

    <td align="center" valign="middle"><div align="center"><span class="style1">Redimensionar imagem em:</span>

        <input name="percentual" type="text" class="campo_texto" id="percentual" value="900" size="4" maxlength="3">

        <span class="style1">%</span>          <input name="Button" type="button" class="campo_texto" onClick="zoomImage(document.form.percentual.value);" value="Redimensionar imagem">

        <input name="original" type="button" class="campo_texto" id="original" onClick="tamanhoOriginal();" value="Tamanho original">

    

        <input name="original2" type="button" class="campo_texto" id="original2" onClick="window.close();" value="Fechar janela">

    </div></td>

    <td background="imagens/img/webdevol_r8_c11.jpg">&nbsp;</td>

  </tr>

  <tr>

    <td background="imagens/img/webdevol_r8_c1.jpg">&nbsp;</td>

    <td>&nbsp;</td>

    <td background="imagens/img/webdevol_r8_c11.jpg">&nbsp;</td>

  </tr>

  <tr>

    <td background="imagens/img/webdevol_r8_c1.jpg">&nbsp;</td>

    <td><div align="center"><img src="fotos/<?=$_GET['path']?>" name="imageZoom" width="458" height="375" id="imageZoom"></div></td>

    <td background="imagens/img/webdevol_r8_c11.jpg">&nbsp;</td>

  </tr>

  <tr>

    <td><span class="topo_listagem"><img name="webdevol_r9_c1" src="imagens/img/webdevol_r9_c1.jpg" width="35" height="25" border="0" alt=""></span></td>

    <td background="imagens/img/webdevol_r9_c2.jpg">&nbsp;</td>

    <td><span class="topo_listagem"><img name="webdevol_r9_c11" src="imagens/img/webdevol_r9_c11.jpg" width="33" height="25" border="0" alt=""></span></td>

  </tr>

</table>

</form>

<script language="javascript" type="text/javascript">

<!--

function zoomImage(porcentagem) {

	if (document.form.percentual.value == ""){

		alert("Informe o percentual que deseja ampliar a foto !");

		document.form.percentual.focus();

	}else{

		document.images['imageZoom'].width+= (document.images['imageZoom'].width * 10) / 100;

		document.images['imageZoom'].height+= (document.images['imageZoom'].width * 10) / 100;

	}

}



function tamanhoOriginal() {

	document.images['imageZoom'].width=458;

	document.images['imageZoom'].height=375;

}

//-->

</script>

</body>

</html>

