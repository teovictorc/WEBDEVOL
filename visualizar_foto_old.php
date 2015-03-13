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

<title>WEBDevol

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<!--Fireworks MX 2004 Dreamweaver MX 2004 target.  Created Mon Apr 25 21:07:14 GMT-0300 (Hora oficial do Brasil) 2005-->



<script language="JavaScript" type="text/JavaScript">

<!--

function MM_swapImgRestore() { //v3.0

  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;

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

<div id="Layer1" style="position:absolute; left:249px; top:57px; width:69px; height:29px; z-index:1; visibility: hidden;"><a href=http://www.milonic.com/styleproperties.php class="style1">http://www.milonic.com/styleproperties.php</a></div>



<link href="wfa.css" rel="stylesheet" type="text/css">

</head>

<body bgcolor="#ffffff" onLoad="MM_preloadImages('imagens/fechar2.jpg')">

	

<table width="760" border="0" cellpadding="0" cellspacing="0">

  <!-- fwtable fwsrc="wfa_arezzo.png" fwbase="wfa_arezzo.jpg" fwstyle="Dreamweaver" fwdocid = "2082307123" fwnested="0" -->

  <tr>

    <td width="36"><img name="webdevol_r7_c1" src="imagens/img/webdevol_r7_c1.jpg" width="35" height="38" border="0" alt=""></td>

    <td colspan="9" background="imagens/fundo_tabela_topo.jpg"><table width="100%"  border="0" align="center">

        <tr>

          <td width="49%"><span class="titulo">:: Visualiza&ccedil;&atilde;o foto ampliada:: </span></td>

          <td width="51%"><div align="right">&nbsp;</div></td>

        </tr>

    </table></td>

    <td width="34"><img name="webdevol_r7_c11" src="imagens/img/webdevol_r7_c11.jpg" width="33" height="38" border="0" alt=""></td>

  </tr>

  <tr>

    <td background="imagens/img/webdevol_r8_c1.jpg">&nbsp;</td>

    <td colspan="9"><div align="center"><img src="fotos/<?=$_GET['path']?>" name="imageZoom" width="458" height="375" id="imageZoom"></div></td>

    <td background="imagens/img/webdevol_r8_c11.jpg">&nbsp;</td>

  </tr>

  <tr>

    <td><span class="topo_listagem"><img name="webdevol_r9_c1" src="imagens/img/webdevol_r9_c1.jpg" width="35" height="25" border="0" alt=""></span></td>

    <td colspan="9" background="imagens/img/webdevol_r9_c2.jpg">&nbsp;</td>

    <td><span class="topo_listagem"><img name="webdevol_r9_c11" src="imagens/img/webdevol_r9_c11.jpg" width="33" height="25" border="0" alt=""></span></td>

  </tr>

  <tr>

    <td>&nbsp;</td>

    <td colspan="9"><div align="center"><a href="javascript:window.close()" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image3','','imagens/fechar2.jpg',1)"><img src="imagens/fechar.jpg" name="Image3" width="78" height="20" border="0"></a></div></td>

    <td>&nbsp;</td>

  </tr>

</table>

<script language="javascript" type="text/javascript">

<!--

function zoomImage(porcentagem) {

	document.images['imageZoom'].width+= (document.images['imageZoom'].width * 10) / 100;

	document.images['imageZoom'].height+= (document.images['imageZoom'].width * 10) / 100;

}

//-->

</script>

</body>

</html>

