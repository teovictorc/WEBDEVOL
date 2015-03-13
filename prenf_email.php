<? include("inc/conn_externa.inc.php"); ?>

<?

	$Sql = "select * from rar_usuario where usuar_ido = '" . $_SESSION['sId'] . "'";
	$Stmt = mysql_query($Sql);
	if ($Rs2 = mysql_fetch_assoc($Stmt)){
		if ($Rs2["USUAR_EMAILPADRAO"] == "1"){
			$Remetente = $Rs2["USUAR_EMAIL1"];
		}else{
			$Remetente = $Rs2["USUAR_EMAIL2"];
		}
	}else{
		$Remetente = $MailDefault;
	}

?>


<html>
<script language="JavaScript" type="text/JavaScript">
<!--
function abrir_janela_popup(theURL,winName,features) { //v2.0
window.open(theURL,winName,features);
}
//-->
</script><script language="JavaScript" type="text/JavaScript">
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
<body onLoad="MM_preloadImages('imagens/fechar2.jpg','imagens/gravar2.jpg')">
<form name="form" method="post" action="email_prenota.php?Id=<?=$_GET['Id']?>">
<input type="hidden" name="ID" value="">
<table width="100%"  border="0" class="style1">
  <tr class="listagem_azul">
    <td height="25" colspan="3" class="listagem_azul"><strong>Encaminhar pr&eacute;-nota via email </strong></td>
  </tr>
  <tr>
    <td colspan="3" class="style2">&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Pr&eacute;-nota n.&ordm; </strong></td>
    <td><?=$_GET['Id']?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="27%"><strong>Remetente</strong></td>
    <td width="58%">      <input name="remetente" type="text" class="campo_texto" id="remetente" value="<?=$Remetente?>" size="50" maxlength="100"></td>
    <td width="15%">&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Destinat&aacute;rio</strong></td>
    <td>      <input name="destinatario" type="text" class="campo_texto" id="destinatario" value="" size="50" maxlength="100"></td>
    <td>&nbsp;</td>
  </tr>
 </table>
 <hr>	
  <table align="center">
  <tr>
    <td class="style2" valign="top"><strong>Mensagem</strong></td>
    <td><textarea name="MENSAGEM" cols="50" rows="5" class="campo_texto" id="MENSAGEM"></textarea></td>
  </tr>
  <tr>
    <td colspan="2"><div align="center"><a href="javascript:sendMail()" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image351','','imagens/enviar2.jpg',1)"><img src="imagens/enviar.jpg" alt="Gravar dados" name="Image351" width="64" height="20" border="0" id="Image351"></a><a href="javascript:window.close()" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image31','','imagens/fechar2.jpg',1)"><img src="imagens/fechar.jpg" name="Image31" width="78" height="20" border="0" id="Image31"></a></div></td>
  </tr>
</table>
<div align="center">
  <p>&nbsp;</p>
</div>
</form>
<script type="text/javascript" src="js/validacao.js"></script>
<script type="text/javascript" src="js/util.js"></script>
<script type="text/javascript" src="menu/milonic_src.js"></script>
<script language="javascript" type="text/javascript">
<!--
function sendMail() {
	pode = true;
	if (document.form.remetente.value == ""){
		alert("Informe um email válido para o remetente !");
		document.form.remetente.focus();
		pode = false;
		return;
	}
	
	if (Verifica_Email("remetente", 0) == false){
		pode = false;
		document.form.remetente.focus();
		return;
	}
	
	if (Verifica_Email("destinatario", 0) == false){
		pode = false;
		document.form.destinatario.focus();
		return;
	}
	
	if (document.form.destinatario.value == ""){
		alert("Informe um email válido para o destinatário !");
		document.form.destinatario.focus();
		pode = false;
		return;
	}
	
	if (pode == true){
		document.form.submit();
	}
}

//-->
</script>
</body>
</html>
