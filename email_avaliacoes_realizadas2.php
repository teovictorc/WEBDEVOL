<? include("inc/conn_externa.inc.php"); ?>

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
<form name="form" method="post" action="email.php?Id=<?=$_GET['Referencia']?>">
<input type="hidden" name="ID" value="">
<table width="100%"  border="0" class="style1">
  <tr class="listagem_azul">
    <td height="25" colspan="2" class="listagem_azul"><strong>Encaminhar avalia&ccedil;&atilde;o RAR para agenciador</strong></td>
  </tr>
  <tr class="style1">
    <td colspan="2" class="style2"><div align="center"><strong>Assinale abaixo para quem dever&aacute; ser encaminhado o email com avalia&ccedil;&atilde;o da RAR foto </strong></div></td>
  </tr>
  <tr>
    <td colspan="2" class="style2">&nbsp;</td>
  </tr>
  <tr>
    <td><strong>N&ordm; reclama&ccedil;&atilde;o </strong></td>
    <td><input name="textfield" type="text" class="campo_amarelo" value="<?=$_GET['Referencia']?>" readonly></td>
  </tr>
 </table>
 <hr>	
  <table width="100%"  border="0">
     <?
      $Stmt = mysql_query("SELECT * FROM RAR_CONTATO ORDER BY CONT_NOME");
        	  while($Rs = mysql_fetch_assoc($Stmt)) 
			   { 
                $CONT_IDO = ucwords($Rs['CONT_IDO']);
	            $CONT_NOME = ucwords($Rs['CONT_NOME']);
				$CONT_EMAIL = strtolower($Rs['CONT_EMAIL']);
	?>
      <tr>
        <td align="center">
		  <input type="checkbox" name="MAIL" id="MAIL" value="<? echo $CONT_EMAIL;?>">
        </td>
        <td class="style1"><? echo $CONT_NOME;?></td>
        <td><input name="textfield2" type="text"  class="campo_texto_email" value="<? echo $CONT_EMAIL;?>" size="50" readonly></td>
      </tr>
   <? } ?>
  </table>
  <hr>
  <table>
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
<script language="javascript" type="text/javascript">
<!--
function sendMail() {
	var Values = chk_checkedAllValues(document.form.MAIL,true,"|",true);
	if (Values == "") {
		alert("Nenhum destinatário selecionado !");
		return;
	}
	document.form.ID.value = Values;
	document.form.submit();
}

function chk_checkAll(elementForm,checked) {
	if (elementForm) {
		if (elementForm.length == undefined)
			elementForm.checked = checked;
		else{
			for(x = 0; x < elementForm.length; x++)
				elementForm[x].checked = checked;
		}
	}
}

function isCheckedAll() {
	document.form.IDS.checked = chk_isCheckedAll(document.form.ID,true);
}
function chk_isCheckedAll(elementForm,checked) {
	if (elementForm){
		if (elementForm.length == undefined)
			return (elementForm.checked == checked);
		else{
			for(x = 0; x < elementForm.length; x++) {
				if (elementForm[x].checked != checked) 
					return false;
			}
			return true;
		}
	}
	return false;
}

function chk_checkedAllValues(elementForm,checked,optionDiv,valueEncode) {
	if (elementForm) {
		if (elementForm.length == undefined) {
			if (elementForm.checked == checked)
				return elementForm.value;
			return "";
		}else{
			var Values = "";
			optionDiv = (optionDiv == undefined) ? "," : optionDiv;
			valueEncode = (valueEncode == undefined) ? false : valueEncode;
			for(x = 0; x < elementForm.length; x++) {
				if (elementForm[x].checked == checked) 
					Values+= ((Values.length > 0) ? optionDiv : "") + ((valueEncode) ? escape(elementForm[x].value) : elementForm[x].value);
			}
			return Values;
		}
	}
	return "";
}

//-->
</script>
</body>
</html>
