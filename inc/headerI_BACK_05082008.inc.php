<? include("conn.inc.php"); 
if($_SESSION['Menu'] == 2){ 
	$ImagemTopo = "wfa_arezzo_r4_c4_s.jpg";
}elseif($_SESSION['Menu'] == 3){ 
	$ImagemTopo = "wfa_arezzo_r4_c4_tm.jpg";
}elseif($_SESSION['Menu'] == 4){ 
	$ImagemTopo = "wfa_arezzo_r4_c4_r.jpg";
}elseif($_SESSION['Menu'] == 5){ 
	$ImagemTopo = "wfa_arezzo_r4_c4_iaf.jpg";
}elseif($_SESSION['Menu'] == 6){ 
	$ImagemTopo = "wfa_arezzo_r4_c4_pesq.jpg";
}else{
	$ImagemTopo = "wfa_arezzo_r4_c4_t.jpg";
}
?>
<html>
<script language="JavaScript" type="text/JavaScript">
<!--
function abrir_janela_popup(theURL,winName,features) { //v2.0
window.open(theURL,winName,features);
}

function abrir_help(theURL,winName,features) { //v2.0
	theURL = 'help/assistenteconteudo.htm'+theURL;
	window.open(theURL,'help','width=800,height=540,top=0,left=0, scrollbars=yes,status=yes,resizable=no,dependent=no');
	}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

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
<head>
<title>WFA Arezzo</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<!--Fireworks MX 2004 Dreamweaver MX 2004 target.  Created Mon Apr 25 21:07:14 GMT-0300 (Hora oficial do Brasil) 2005-->
<div id="Layer1" style="position:absolute; left:249px; top:57px; width:69px; height:29px; z-index:1; visibility: hidden;"><a href=http://www.milonic.com/styleproperties.php class="style1">http://www.milonic.com/styleproperties.php</a></div>

<link href="wfa.css" rel="stylesheet" type="text/css">
</head>
<body onLoad="MM_preloadImages('imagens/gravar2.jpg','imagens/cancelar2.jpg')">
<script type="text/javascript" src="js/validacao.js"></script>
<script type="text/javascript" src="js/util.js"></script>
<script type="text/javascript" src="menu/milonic_src.js"></script>
<script	type="text/javascript">
if(ns4)_d.write("<scr"+"ipt type=text/javascript src=menu/mmenuns4.js><\/scr"+"ipt>");		
  else _d.write("<scr"+"ipt type=text/javascript src=menu/mmenudom.js><\/scr"+"ipt>"); 
  
function deleteById(sPage,FormID) {
	if(confirm("Confirma a exclusão do(s) registro(s)")==true){
		var Ids = "";
		if (FormID) {
			if (FormID.length == undefined) {
				if (FormID.checked)
					Ids = "'" + escape(FormID.value) + "'";
			}else{
				for(x = 0; x < FormID.length; x++) {
					if (FormID[x].checked) 
						Ids+= ((Ids.length == 0) ? "" : ",") + "'" + escape(FormID[x].value) + "'";
				}
			}
			if (Ids == "")
				alert("Deve haver pelo menos um item selecionado !");
			else{
				document.location.href = sPage + ((sPage.indexOf("?") == -1) ? "?" : "&") + "IdDel=" + Ids;
			}
		}else
			alert("Não há registros !");
	}
}
function cancelOperation(pageDest) {
	if(confirm("Tem certeza que deseja cancelar a operacao ?"))
		document.location.href = pageDest;
}
</script>
<script type="text/javascript" src="menu/menu_data.php"></script>	
<table border="0" cellpadding="0" cellspacing="0" width="777">
<!-- fwtable fwsrc="wfa_arezzo.png" fwbase="wfa_arezzo.jpg" fwstyle="Dreamweaver" fwdocid = "2082307123" fwnested="0" -->
  <tr>
   <td><img src="imagens/img/spacer.gif" width="35" height="1" border="0" alt=""></td>
   <td><img src="imagens/img/spacer.gif" width="3" height="1" border="0" alt=""></td>
   <td><img src="imagens/img/spacer.gif" width="176" height="1" border="0" alt=""></td>
   <td><img src="imagens/img/spacer.gif" width="263" height="1" border="0" alt=""></td>
   <td><img src="imagens/img/spacer.gif" width="48" height="1" border="0" alt=""></td>
   <td><img src="imagens/img/spacer.gif" width="74" height="1" border="0" alt=""></td>
   <td><img src="imagens/img/spacer.gif" width="9" height="1" border="0" alt=""></td>
   <td><img src="imagens/img/spacer.gif" width="44" height="1" border="0" alt=""></td>
   <td><img src="imagens/img/spacer.gif" width="86" height="1" border="0" alt=""></td>
   <td><img src="imagens/img/spacer.gif" width="6" height="1" border="0" alt=""></td>
   <td><img src="imagens/img/spacer.gif" width="33" height="1" border="0" alt=""></td>
   <td><img src="imagens/img/spacer.gif" width="1" height="1" border="0" alt=""></td>
  </tr>

  <tr>
   <td rowspan="3" colspan="4"><img name="wfa_arezzo_r1_c1" src="imagens/img/wfa_arezzo_r1_c1.jpg" width="477" height="37" border="0" alt=""></td>
   <td rowspan="3"><img name="wfa_arezzo_r1_c5" src="../imagens/img/wfa_arezzo_r1_c5.jpg" width="48" height="37" border="0" alt=""></td>
   <td colspan="2"><img name="wfa_arezzo_r1_c6" src="imagens/img/wfa_arezzo_r1_c6.jpg" width="83" height="15" border="0" alt=""></td>
   <td rowspan="3"><img name="wfa_arezzo_r1_c8" src="imagens/img/wfa_arezzo_r1_c8.jpg" width="44" height="37" border="0" alt=""></td>
   <td><img name="wfa_arezzo_r1_c9" src="imagens/img/wfa_arezzo_r1_c9.jpg" width="86" height="15" border="0" alt=""></td>
   <td colspan="2"><img name="wfa_arezzo_r1_c10" src="imagens/img/wfa_arezzo_r1_c10.jpg" width="39" height="15" border="0" alt=""></td>
  </tr>
  <tr>
   <td><div align="center"><span class="style2"><?=$_SESSION['sNome']?></span></div></td>
   <td rowspan="2"><img name="wfa_arezzo_r2_c7" src="imagens/img/wfa_arezzo_r2_c7.jpg" width="9" height="22" border="0" alt=""></td>
   <td><div align="center"><span class="style2"><a href="login.php">logout</a></span></div></td>
   <td rowspan="2" colspan="2"><img name="wfa_arezzo_r2_c10" src="imagens/img/wfa_arezzo_r2_c10.jpg" width="39" height="22" border="0" alt=""></td>
  </tr>
  <tr>
   <td><img name="wfa_arezzo_r3_c6" src="imagens/img/wfa_arezzo_r3_c6.jpg" width="74" height="5" border="0" alt=""></td>
   <td><img name="wfa_arezzo_r3_c9" src="imagens/img/wfa_arezzo_r3_c9.jpg" width="86" height="5" border="0" alt=""></td>
   <td><img src="imagens/img/spacer.gif" width="1" height="5" border="0" alt=""></td>
  </tr>
  <tr>
   <td colspan="2"><img name="wfa_arezzo_r4_c1" src="imagens/img/wfa_arezzo_r4_c1.jpg" width="38" height="45" border="0" alt=""></td>
   <td><img name="wfa_arezzo_r4_c3" src="imagens/img/wfa_arezzo_r4_c3.jpg" width="176" height="45" border="0" alt=""></td>
   <td colspan="6"><img name="wfa_arezzo_r4_c4" src="imagens/img/<?=$ImagemTopo?>" width="524" height="45" border="0" alt=""></td>
   <td rowspan="2" colspan="2"><img name="wfa_arezzo_r4_c10" src="imagens/img/wfa_arezzo_r4_c10.jpg" width="39" height="62" border="0" alt=""></td>
  </tr>
  <tr>
   <td colspan="2"><img name="wfa_arezzo_r5_c1" src="imagens/img/wfa_arezzo_r5_c1.jpg" width="38" height="17" border="0" alt=""></td>
   <td colspan="7"><img name="wfa_arezzo_r5_c3" src="imagens/img/wfa_arezzo_r5_c3.jpg" width="700" height="17" border="0" alt=""></td>
  </tr>
  <tr>
   <td height="25" colspan="11">&nbsp;</td>
  </tr>
  <tr>
   <td><img name="wfa_arezzo_r7_c1" src="imagens/img/wfa_arezzo_r7_c1.jpg" width="35" height="38" border="0" alt=""></td>
   <td colspan="9" background="imagens/fundo_tabela_topo.jpg">