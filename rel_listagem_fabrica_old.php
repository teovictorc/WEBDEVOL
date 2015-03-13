<? include("inc/conn_externa.inc.php"); 

	$reclamacao = $_GET['Valor'];
	$valor = str_replace("-","",$_GET['Valor']);
	$Quantidade = $_GET['Qtde'];
	$Fabrica = $_GET['Fabrica'];
	$referencia = substr($_GET['Referencia'],0,4).'-'.substr($_GET['Referencia'],4,4).'-'.substr($_GET['Referencia'],8,4).'-'.substr($_GET['Referencia'],12,4);
	
	$Sql = "select NOME AS FABRICA ";
	$Sql.= " from pessoa";
	$Sql.= " where pessoa in (".$Fabrica.")";
	$Stmt2 = mysql_query($Sql);
	while($RsI = mysql_fetch_assoc($Stmt2)) { 
		$Fabrica = $RsI["FABRICA"];
	}
	
include("barcode.php");
?>
<html>
<head>
<title>Listagem de fabricantes</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
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
<style type="text/css">
<!--
-->
</style>
<link href="wfa.css" rel="stylesheet" type="text/css">
</head>

<body onLoad="MM_preloadImages('imagens/imprimir2.jpg','imagens/fechar2.jpg')">
<div align="center">

  <table width="100%" border="0" class="bordaSimples">
		<tr>
		  <td><span class="listagem_azul"><img src="imagens/logotipo_impressao.jpg" width="141" height="41"></span></td>
    </tr>
		<tr>
		  <td height="30" class="campo_amarelo"><div align="center" class="titulo">lISTAGEM DE FABRICANTES</div></td>
		</tr>
		<tr>
		  <td><table width="100%" cellpadding="0" cellspacing="0" class="style1">
            <tr bgcolor="#F5F5F5" class="TextNormal_12Negrito">
              <td width="25%" height="20" class="xl25"><div align="center">C&oacute;digo sola</div></td>
              <td width="75%" class="xl24">Nome do fabricante </td>
            </tr>
            <tr>
              <td class="xl25"><div align="center">A 01 </div></td>
              <td class="xl24">ANDARELLA </td>
            </tr>
            <tr bgcolor="#E2F0FE">
              <td class="xl25"><div align="center">A 25 </div></td>
              <td class="xl24">XAMMA CAL&Ccedil;ADOS </td>
            </tr>
            <tr>
              <td class="xl25"><div align="center">A 28 </div></td>
              <td class="xl24">MADUGE </td>
            </tr>
            <tr bgcolor="#E2F0FE">
              <td class="xl25"><div align="center">A 29 </div></td>
              <td class="xl24">JANE A PEZZI </td>
            </tr>
            <tr>
              <td class="xl25"><div align="center">A 30 </div></td>
              <td class="xl26">P.J. CAL&Ccedil;ADOS </td>
            </tr>
            <tr bgcolor="#E2F0FE">
              <td class="xl25"><div align="center">A06 </div></td>
              <td class="xl26">FEISTAUER </td>
            </tr>
            <tr>
              <td class="xl25"><div align="center">A31 </div></td>
              <td class="xl24">ANDRAC&Aacute;S </td>
            </tr>
            <tr bgcolor="#E2F0FE">
              <td class="xl25"><div align="center">A32 </div></td>
              <td class="xl24">IMPORTA&Ccedil;&Atilde;O CHINA </td>
            </tr>
            <tr>
              <td class="xl25"><div align="center">A33 </div></td>
              <td class="xl24">GUILHERME E SANTOS </td>
            </tr>
            <tr bgcolor="#E2F0FE">
              <td class="xl25"><div align="center">A34 </div></td>
              <td class="xl26">FERANELE </td>
            </tr>
            <tr>
              <td class="xl25"><div align="center">F 01 </div></td>
              <td class="xl24">MALU LTDA. </td>
            </tr>
            <tr>
              <td class="xl25"><div align="center">F 05 </div></td>
              <td class="xl24">FLOREN&Ccedil;A CAL&Ccedil;ADOS LTDA. </td>
            </tr>
            <tr>
              <td class="xl25"><div align="center">F 07 </div></td>
              <td class="xl24">FIRST LINE CAL&Ccedil;. </td>
            </tr>
            <tr bgcolor="#E2F0FE">
              <td class="xl25"><div align="center">F 11 </div></td>
              <td class="xl24">CAL&Ccedil;ADOS COOPERSINOS. </td>
            </tr>
            <tr>
              <td class="xl25"><div align="center">F 12 </div></td>
              <td class="xl24">ZENGLEIN CAL&Ccedil;. </td>
            </tr>
            <tr bgcolor="#E2F0FE">
              <td class="xl25"><div align="center">F 17 </div></td>
              <td class="xl24">PAULINA LTDA. </td>
            </tr>
            <tr>
              <td class="xl25"><div align="center">F 21 </div></td>
              <td class="xl24">BRILAC IND. CAL&Ccedil;. LTDA. </td>
            </tr>
            <tr bgcolor="#E2F0FE">
              <td class="xl25"><div align="center">F 23 </div></td>
              <td class="xl24">BLIP </td>
            </tr>
            <tr>
              <td class="xl25"><div align="center">F 24 </div></td>
              <td class="xl24">ORQU&Iacute;DEA LTDA. </td>
            </tr>
            <tr bgcolor="#E2F0FE">
              <td class="xl25"><div align="center">F 26 </div></td>
              <td class="xl24">PLUS PORT LTDA. </td>
            </tr>
            <tr>
              <td class="xl25"><div align="center">F 29 </div></td>
              <td class="xl24">UNIFLEX IND. COM. LTDA. </td>
            </tr>
            <tr bgcolor="#E2F0FE">
              <td class="xl25"><div align="center">F 30 </div></td>
              <td class="xl24">CRIA&Ccedil;&Otilde;ES 2000 CAL&Ccedil;. LTDA. </td>
            </tr>
            <tr>
              <td class="xl25"><div align="center">F 31 </div></td>
              <td class="xl24">MTN IND. CAL&Ccedil;. LTDA. </td>
            </tr>
            <tr bgcolor="#E2F0FE">
              <td class="xl25"><div align="center">F 34 </div></td>
              <td class="xl24">INJETADOS KS LTDA. </td>
            </tr>
            <tr>
              <td class="xl25"><div align="center">F 35 </div></td>
              <td class="xl24">BRASIL LABELS LTDA. </td>
            </tr>
            <tr bgcolor="#E2F0FE">
              <td class="xl25"><div align="center">F 37 </div></td>
              <td class="xl24">LIBERTY CAL&Ccedil;. LTDA. </td>
            </tr>
            <tr>
              <td class="xl25"><div align="center">F 38 </div></td>
              <td class="xl24">BORTOLOSSI LTDA. </td>
            </tr>
            <tr bgcolor="#E2F0FE">
              <td class="xl25"><div align="center">F 39 </div></td>
              <td class="xl24">ALMANESS CAL&Ccedil;. LTDA. </td>
            </tr>
            <tr>
              <td class="xl25"><div align="center">F 40 </div></td>
              <td class="xl24">WIRTH LTDA. </td>
            </tr>
            <tr bgcolor="#E2F0FE">
              <td class="xl25"><div align="center">F 41 </div></td>
              <td class="xl24">CK IND. CAL&Ccedil;. LTDA. </td>
            </tr>
            <tr>
              <td class="xl25"><div align="center">F 42 </div></td>
              <td class="xl24">HENRICH &amp; CIA. LTDA. </td>
            </tr>
            <tr bgcolor="#E2F0FE">
              <td class="xl25"><div align="center">F 43 </div></td>
              <td class="xl24">TITTON LTDA. </td>
            </tr>
            <tr>
              <td class="xl25"><div align="center">F 44 </div></td>
              <td class="xl24">DEJUNEL CAL&Ccedil;. LTDA. </td>
            </tr>
            <tr bgcolor="#E2F0FE">
              <td class="xl25"><div align="center">F 45 </div></td>
              <td class="xl24">STORESHOES LTDA. </td>
            </tr>
            <tr>
              <td class="xl25"><div align="center">F 46 </div></td>
              <td class="xl24">ZMCO CAL&Ccedil;ADOS LTDA. </td>
            </tr>
            <tr bgcolor="#E2F0FE">
              <td class="xl25"><div align="center">F 47 </div></td>
              <td class="xl24">TELL CAL&Ccedil;ADOS. </td>
            </tr>
            <tr>
              <td class="xl25"><div align="center">F 48 </div></td>
              <td class="xl24">DECKALL LTDA. </td>
            </tr>
            <tr bgcolor="#E2F0FE">
              <td class="xl25"><div align="center">F 49 </div></td>
              <td class="xl24">DI FIUGGIO CAL&Ccedil;. LTDA. </td>
            </tr>
            <tr>
              <td class="xl25"><div align="center">F 50 </div></td>
              <td class="xl24">TENSON CAL&Ccedil;ADOS LTDA. </td>
            </tr>
            <tr bgcolor="#E2F0FE">
              <td class="xl25"><div align="center">F 51 </div></td>
              <td class="xl24">MAJOLO LTDA. </td>
            </tr>
            <tr>
              <td class="xl25"><div align="center">F 52 </div></td>
              <td class="xl24">TALITA BY SANDRA. </td>
            </tr>
            <tr bgcolor="#E2F0FE">
              <td class="xl25"><div align="center">F 53 </div></td>
              <td class="xl24">DISPORT DO BRASIL LTDA. </td>
            </tr>
            <tr>
              <td class="xl25"><div align="center">F 54 </div></td>
              <td class="xl24">RICHTER CAL&Ccedil;ADOS LTDA. </td>
            </tr>
            <tr bgcolor="#E2F0FE">
              <td class="xl25"><div align="center">F 55 </div></td>
              <td class="xl24">FUTURA CAL&Ccedil;ADOS LTDA. </td>
            </tr>
            <tr>
              <td class="xl25"><div align="center">F 56 </div></td>
              <td class="xl24">VERKAUFER IND. COM. LTDA. </td>
            </tr>
            <tr bgcolor="#E2F0FE">
              <td class="xl25"><div align="center">F 57 </div></td>
              <td class="xl24">CARDOSO &amp; OLIVEIRAS ( RB ) </td>
            </tr>
            <tr>
              <td class="xl25"><div align="center">F 58 </div></td>
              <td class="xl24">NIANSO LTDA. </td>
            </tr>
            <tr bgcolor="#E2F0FE">
              <td class="xl25"><div align="center">F 59 </div></td>
              <td class="xl24">SAP SCHUTZ </td>
            </tr>
            <tr>
              <td class="xl25"><div align="center">F 60 </div></td>
              <td class="xl24">JEAN LTDA. </td>
            </tr>
            <tr bgcolor="#E2F0FE">
              <td class="xl25"><div align="center">F 61 </div></td>
              <td class="xl24">CAL&Ccedil;. MENFIS LTDA. </td>
            </tr>
            <tr>
              <td class="xl25"><div align="center">F 62 </div></td>
              <td class="xl24">J.A CAL&Ccedil;ADOS </td>
            </tr>
            <tr bgcolor="#E2F0FE">
              <td class="xl25"><div align="center">F 63 </div></td>
              <td class="xl24">DIESA CAL&Ccedil;ADOS </td>
            </tr>
            <tr>
              <td class="xl25"><div align="center">F 64 </div></td>
              <td class="xl24">CAL&Ccedil;. PRICAWI </td>
            </tr>
            <tr bgcolor="#E2F0FE">
              <td class="xl25"><div align="center">F 65 </div></td>
              <td class="xl24">CAL&Ccedil;. DI PIACINI </td>
            </tr>
            <tr>
              <td class="xl25"><div align="center">F 66 </div></td>
              <td class="xl24">STAR BENE </td>
            </tr>
            <tr bgcolor="#E2F0FE">
              <td class="xl25"><div align="center">F 67 </div></td>
              <td class="xl24">JANI BEL </td>
            </tr>
            <tr>
              <td class="xl25"><div align="center">F 68 </div></td>
              <td class="xl24">CAL&Ccedil;ADOS H. G. </td>
            </tr>
            <tr bgcolor="#E2F0FE">
              <td class="xl25"><div align="center">F 70 </div></td>
              <td class="xl24">DANDARA </td>
            </tr>
            <tr>
              <td class="xl25"><div align="center">F 71 </div></td>
              <td class="xl24">TAMULI </td>
            </tr>
            <tr bgcolor="#E2F0FE">
              <td class="xl25"><div align="center">F 72 </div></td>
              <td class="xl24">PAR E PASSO </td>
            </tr>
            <tr>
              <td class="xl25"><div align="center">F 73 </div></td>
              <td class="xl24">FOXPORT </td>
            </tr>
            <tr bgcolor="#E2F0FE">
              <td class="xl25"><div align="center">F 74 </div></td>
              <td class="xl26">DE BORBA </td>
            </tr>
            <tr>
              <td class="xl25"><div align="center">F 75 </div></td>
              <td class="xl26">BCA CAL&Ccedil;ADOS </td>
            </tr>
            <tr bgcolor="#E2F0FE">
              <td class="xl25"><div align="center">F 76 </div></td>
              <td class="xl26">CAL&Ccedil;ADOS DAIELY </td>
            </tr>
            <tr>
              <td class="xl25"><div align="center">F77 </div></td>
              <td class="xl26">STUDIO ARTE NACIONAL </td>
            </tr>
            <tr bgcolor="#E2F0FE">
              <td class="xl25"><div align="center">F78 </div></td>
              <td class="xl26">LUCA CUCA CAL&Ccedil;ADO ARTEZANAL LTDA. </td>
            </tr>
            <tr>
              <td class="xl25"><div align="center">F79 </div></td>
              <td class="xl26">GATA BRASIL </td>
            </tr>
          </table></td>
    </tr>
  </table>
      <p><div id="idButtons" style="display:"><a href="javascript:printDocument();" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image2','','imagens/imprimir2.jpg',1)"><img src="imagens/imprimir.jpg" name="Image2" width="78" height="20" border="0"></a>&nbsp;<a href="javascript:window.close()" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image3','','imagens/fechar2.jpg',1)"><img src="imagens/fechar.jpg" name="Image3" width="78" height="20" border="0"></a></div>
  </p>
</div>
<script language="javascript" type="text/javascript">
	function printDocument() {
		document.getElementById("idButtons").style.display = "none";
		self.print();
		document.getElementById("idButtons").style.display = "";
	}
	window.focus();
</script>
</body>
</html>