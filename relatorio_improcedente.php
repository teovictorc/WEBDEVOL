<?    include("inc/conn.inc.php");

		$Sql = "SELECT L.LANCA_NUMRAR, ITEM_REFERENCIA REFERENCIA, ".
		               " P.NOME CLIENTE, ".
					   " A.AVALI_AREZ_DETALHE DETALHE_AREZZO, ".
				       "L.LANCA_MOTIVO RECLAMACAO ".
			      "FROM RAR_LANCAMENTO L, RAR_AVALIACAO A, PESSOA P, RAR_ITEM ".
				" WHERE L.LANCA_PESSOA = P.PESSOA ".
				        " AND AVALI_NUMRAR = LANCA_NUMRAR ".
						" AND ITEM_NUMRAR = LANCA_NUMRAR ".
				        " AND L.LANCA_NUMRAR = '" .$_GET['Referencia']. "' ";
		$Stmt = mysql_query($Sql);
		if (!$Rs = mysql_fetch_assoc($Stmt))
			die("<script>alert('Não foi possivel gerar o relatório\\n a janela será fechada !');window.close();</script>");
			
		$Meses[1] = "janeiro";
		$Meses[2] = "fevereiro";
		$Meses[3] = "março";
		$Meses[4] = "abril";
		$Meses[5] = "maio";
		$Meses[6] = "junho";
		$Meses[7] = "julho";
		$Meses[8] = "agosto";
		$Meses[9] = "setembro";
		$Meses[10] = "outubro";
		$Meses[11] = "novembro";
		$Meses[12] = "dezembro";

?>
<html>
<head>
<title>Resposta ao consumidor</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="wfa.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style3 {font-weight: bold}
-->
</style>
</head>

<body>
<table width="95%"  border="1" align="center" bordercolor="#333333">
  <tr>
    <td><p>&nbsp;</p>
    <p align="right" class="style1">&nbsp;</p>
    <table width="90%"  border="0" align="center">
      <tr class="campo_texto">
        <td>&nbsp;</td>
        <td width="26%" height="25" class="TextNormal_12">&nbsp;</td>
        <td width="57%" class="TextNormal_12"><div align="right"><span class="style1">Rio de Janeiro, <?=date("d") . " de " . $Meses[intval(date("n"))] . " de " . date("Y")?>.</span></div></td>
      </tr>
      <tr class="campo_texto">
        <td>&nbsp;</td>
        <td height="25" colspan="2" class="TextNormal_12">&nbsp;</td>
      </tr>
      <tr class="campo_texto">
        <td width="17%"><strong class="TextNormal_12Negrito">Resposta:</strong></td>
        <td height="25" colspan="2" class="TextNormal_12">N&atilde;o procede a reclama&ccedil;&atilde;o</td>
      </tr>
      <tr class="TextNormal_12">
        <td>&nbsp;</td>
        <td colspan="2">&nbsp;</td>
      </tr>
      <tr class="TextNormal_12">
        <td colspan="3">Prezado cliente <span class="style3">
          <?=$Rs["CLIENTE"]?>
        </span></td>
        </tr>
      <tr class="TextNormal_12">
        <td>&nbsp;</td>
        <td colspan="2" class="TextNormal_12">&nbsp;</td>
      </tr>
      <tr class="TextNormal_12">
        <td colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Recebemos seu produto de refer&ecirc;ncia  <?=$Rs["REFERENCIA"]?> para an&aacute;lise do defeito de fabrica&ccedil;&atilde;o exposto a seguir:</td>
        </tr>
      <tr class="TextNormal_12">
        <td colspan="3">&nbsp;</td>
        </tr>
      <tr class="TextNormal_12">
        <td><strong class="TextNormal_12Negrito">Reclama&ccedil;&atilde;o:</strong></td>
        <td colspan="2"> <?=$Rs["RECLAMACAO"]?></td>
      </tr>
      <tr class="TextNormal_12">
        <td colspan="3">&nbsp;</td>
      </tr>
      <tr class="tabela">
        <td colspan="3"><div align="center" class="TextNormal_12Negrito">Parecer do comit&ecirc; t&eacute;cnico</div></td>
      </tr>
      <tr class="TextNormal_12Negrito">
        <td colspan="3">:: Parecer t&eacute;cnico ::</td>
      </tr>
      <tr>
        <td colspan="3" class="TextNormal_12"> <?=$Rs["DETALHE_AREZZO"]?></td>
      </tr>
      <tr>
        <td colspan="3" class="TextNormal_12">&nbsp;</td>
      </tr>
<? if(trim($Rs["DETALHE_STAR"])) { ?>	  
      <tr class="TextNormal_12Negrito">
        <td colspan="3" class="TextNormal_12">:: Parecer t&eacute;cnico ::</td>
      </tr>
      <tr>
        <td colspan="3" class="TextNormal_12"> <?=$Rs["DETALHE_STAR"]?></td>
      </tr>
      <tr>
        <td colspan="3" class="TextNormal_12">&nbsp;</td>
      </tr>
<? } ?>
      <tr>
        <td colspan="3" class="TextNormal_12"><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sendo essas considera&ccedil;&otilde;es a serem feitas, colocamo-nos a disposi&ccedil;&atilde;o para quaisquer outros esclarecimentos que se fizerem necess&aacute;rios.</p></td>
      </tr>
      <tr class="TextNormal_12">
        <td colspan="3" class="TextNormal_12">&nbsp;</td>
      </tr>
      <tr class="TextNormal_12">
        <td colspan="3" class="TextNormal_12">&nbsp;</td>
      </tr>
      <tr class="TextNormal_12">
        <td class="TextNormal_12">&nbsp;</td>
        <td class="TextNormal_12">&nbsp;</td>
        <td class="TextNormal_12"><div align="right">Atenciosamente,</div></td>
      </tr>
      <tr class="TextNormal_12">
        <td class="TextNormal_12">&nbsp;</td>
        <td class="TextNormal_12">&nbsp;</td>
        <td class="style1"><div align="right">ANDARELLA</div></td>
      </tr>
      <tr class="TextNormal_12">
        <td class="TextNormal_12">&nbsp;</td>
        <td class="TextNormal_12">&nbsp;</td>
        <td class="TextNormal_12">&nbsp;</td>
      </tr>
    </table>    <p align="right">&nbsp; </p></td>
  </tr>
</table>
  <p><div  align="center" id="idButtons" style="display:"><a href="javascript:printDocument();" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image2','','imagens/imprimir.jpg',1)"><img src="imagens/imprimir.jpg" name="Image2" border="0"></a>&nbsp;<a href="javascript:self.close()" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image3','','imagens/fechar.jpg',1)"><img src="imagens/fechar.jpg" name="Image3" border="0"></a></div>
  </p>
</div>
<script language="javascript" type="text/javascript">
	function printDocument() {
		document.getElementById("idButtons").style.display = "none";
		self.print();
		document.getElementById("idButtons").style.display = "";
	}
	window.focus();
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
</script></body>
</html>
