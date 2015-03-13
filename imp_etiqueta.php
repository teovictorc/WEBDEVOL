<? include("inc/conn_externa.inc.php"); 

	$reclamacao = $_GET['Valor'];
	$valor = str_replace("-","",$_GET['Valor']);
	$Quantidade = $_GET['Qtde'];
	$Fabrica = $_GET['Fabrica'];
	//$referencia = substr($_GET['Referencia'],0,4).'-'.substr($_GET['Referencia'],4,4).'-'.substr($_GET['Referencia'],8,4).'-'.substr($_GET['Referencia'],12,4);		$referencia = $_GET['Referencia'];
	
	/*$Sql = "select NOME AS FABRICA ";	$Sql.= " from pessoa";	$Sql.= " where pessoa in (".$Fabrica.")";	$Stmt2 = mysql_query($Sql);	while($RsI = mysql_fetch_assoc($Stmt2)) { 		$Fabrica = $RsI["FABRICA"];	}	*/
	
include("barcode.php");
?>
<html>
<head>
<title>WFAWeb - Impress&atilde;o etiqueta de controle</title>
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
.bordaSimples {	border: 1px solid #000000;
}
.style1 {font-size: 36px}
.style3 {
	font-size: 14px;
	font-weight: bold;
	font-family: TAHOMA;
}
.style5 {font-family: TAHOMA; font-size: 12px;}
-->
</style>
</head>

<body onLoad="MM_preloadImages('imagens/imprimir2.jpg','imagens/fechar2.jpg')">
<div align="center">

<? if ($_GET['Rar'] == ""){
	for ($x = 0; $x < $Quantidade; $x++) { ?>
		<table width="200" border="0" class="bordaSimples">
			<tr>
			  <td colspan="6"><div align="center" class="style1"><?=$reclamacao?></div></td>
			</tr>
			<tr>
			  <td colspan="6"><div align="center"><?=fbarcode($valor)?></div></td>
			</tr>
			<tr>
			  <td colspan="6"><div align="center"><span class="style5">Refer&ecirc;ncia: <?=$referencia?></span></div></td>
			</tr>
			<tr>
			  <td colspan="6"><div align="center"><span class="style5"><?=$Fabrica?></span></div></td>
			</tr>
			<tr>
			  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			  <td class="bordaSimples">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			  <td class="style3">Procedente</td>
			  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			  <td class="bordaSimples">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			  <td><span class="style3">Improcedente</span></td>
			</tr>
		</table>
		<table width="263" height="19" border="0">
			<tr>
			  <td colspan="6"></td>
			</tr>
		</table><?
	} 
}else{
	$Sql = "delete from rar_etiqueta where ETIQ_USUAR_IDO = '".$_SESSION['sId']."'";
	$Stmt = mysql_query($Sql);
	$Rar = str_replace(",,","",$_GET['Rar']);
	$Sql = "select LANCA_NUMRAR, ITEM_REFERENCIA, ITEM_QTDE, NOME AS FABRICA ";
	$Sql.= " from rar_lancamento, rar_item, pessoa";
	$Sql.= " where lanca_numrar in (".$Rar.")";
	$Sql.= "       and lanca_numrar = item_numrar";
	$Sql.= "       and lanca_fabri_ido = pessoa";
	$Sql.= " order by lanca_numrar";
	$Stmt2 = mysql_query($Sql);
	while($RsI = mysql_fetch_assoc($Stmt2)) { 
		/*$Referencia = substr($RsI["ITEM_REFERENCIA"],0,4) . "-";		$Referencia.= substr($RsI["ITEM_REFERENCIA"],4,4) . "-";		$Referencia.= substr($RsI["ITEM_REFERENCIA"],8,4) . "-";		$Referencia.= substr($RsI["ITEM_REFERENCIA"],12,4);		*/				$Referencia = $RsI["ITEM_REFERENCIA"];
		$Fabrica = $RsI["FABRICA"];
		$Fabrica = str_replace("'","''",$Fabrica);
		$valor = str_replace("-","",$RsI["LANCA_NUMRAR"]);
		$Quantidade = $RsI["ITEM_QTDE"];
		for ($x = 0; $x < $Quantidade; $x++) { 
			$Sql = "insert into rar_etiqueta (";
			$Sql.= " etiq_numrar, ";
			$Sql.= " etiq_referencia, ";
			$Sql.= " etiq_fabrica, ";
			$Sql.= " etiq_usuar_ido ";
			$Sql.= " ) values ( ";
			$Sql.= "'".$RsI["LANCA_NUMRAR"]."',";
			$Sql.= "'".$Referencia."',";
			$Sql.= "'".$Fabrica."',";
			$Sql.= "'".$_SESSION['sId']."')";
			$Stmt = mysql_query($Sql);
		}
	}
	?>
	<tr class="texto_normal">
	<th colspan="5">
		<table width="100%"  border="0">
			<tr>
				<td>
				<?
					$Sql = "select * ";
					$Sql.= " from rar_etiqueta";
					$Sql.= " where etiq_usuar_ido = '".$_SESSION['sId']."'";
					$Sql.= " order by etiq_numrar";
					$Stmt2 = mysql_query($Sql);
					$volta = 0;
					$continue = true;
					if (mysql_num_rows($Stmt2) > 0) {
						while($continue) { ?>
		  <tr>
							<? 
							for ($x = 0; $x < 2; $x++) {
								if (!($RsI = mysql_fetch_row($Stmt2))) {
									$continue = false;
									break;
								}
								$volta = $volta + 1;
								?>
								<td>
									<table width="150" border="0" class="bordaSimples">
										<tr>
										  <td colspan="6"><div align="center" class="style1"><?=$RsI[0]?></div></td>
										</tr>
										<tr>
										  <td colspan="6"><div align="center"><?=fbarcode(str_replace("-","",$RsI[0]))?></div></td>
										</tr>
										<tr>
										  <td colspan="6"><div align="center"><span class="style5">Refer&ecirc;ncia: <?=$RsI[1]?></span></div></td>
										</tr>
										<tr>
										  <td colspan="6"><div align="center"><span class="style5"><?=$RsI[2]?></span></div></td>
										</tr>
										<tr>
										  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
										  <td class="bordaSimples">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
										  <td class="style3">Procedente</td>
										  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
										  <td class="bordaSimples">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
										  <td><span class="style3">Improcedente</span></td>
										</tr>
									</table>
								</td>
						<?  } ?>
		  </tr>
					<? } 
				} 
				$Sql = "delete from rar_etiqueta where ETIQ_USUAR_IDO = '".$_SESSION['sId']."'";
				$Stmt = mysql_query($Sql);
				?>
				</td>
			</tr>
		</table>
	</th>
	</tr>
<? } ?>
  <p><div id="idButtons" style="display:"><a href="javascript:printDocument();"><img src="imagens/imprimir.jpg" name="Image2" width="52" height="22" border="0"></a>&nbsp;<a href="javascript:window.close()"><img src="imagens/fechar.jpg" name="Image3" width="52" height="22" border="0"></a></div>
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