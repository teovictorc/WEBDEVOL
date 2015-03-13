<? include("inc/conn_externa.inc.php"); 

	
	
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
              <td width="75%" class="xl24">Nome do fabricante</td>
            </tr>
			<?
			$Sql = " select F.*, P.PESSOA, P.NOME ";
			$Sql.= " from RAR_FABRICA F, PESSOA P ";
			$Sql.= " WHERE P.PESSOA = F.FABRI_PESSOA ";
			$Sql.= " ORDER BY FABRI_CODSOLA";
			$Stmt = mysql_query($Sql);
			$Cor = "#E2F0FE";
			while($Rs = mysql_fetch_assoc($Stmt)) { 
				if ($Cor == "#E2F0FE"){
					$Cor = "#FFFFFF";
				}else{
					$Cor = "#E2F0FE";
				}
				?>
				<tr bgcolor="<?=$Cor?>" >
				  <td class="xl25"><div align="center"><?=$Rs["FABRI_CODSOLA"]?></div></td>
				  <td class="xl24"><?=$Rs["PESSOA"]." - ".$Rs["NOME"]?></td>
				</tr>
				<? } ?>
            
          </table></td>
    </tr>
  </table>
      <p><div id="idButtons" style="display:"><a href="javascript:printDocument();" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image2','','imagens/imprimir.jpg',1)"><img src="imagens/imprimir.jpg" name="Image2" width="78" height="20" border="0"></a>&nbsp;<a href="javascript:window.close()" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image3','','imagens/fechar.jpg',1)"><img src="imagens/fechar.jpg" name="Image3" width="78" height="20" border="0"></a></div>
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