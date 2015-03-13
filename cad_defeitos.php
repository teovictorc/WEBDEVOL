<? include("inc/headerI.inc.php"); 
	verifyAcess("CADDEFEITO","S");
	if (trim($_GET['Id'])) {
		$Stmt = mysql_query("SELECT * FROM rar_defeito WHERE DEFEI_IDO = '" .$_GET['Id']. "'",$Conn);
		$ID = $_GET["Id"];
		if ($Rs = mysql_fetch_assoc($Stmt)) {
			$DEFEI_DESCRICAO = $Rs["DEFEI_DESCRICAO"];
		}
	}
?>
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
<body onLoad="MM_preloadImages('imagens/gravar2.jpg')">
<form name="form" method="post" action="cad_defeitosok.php">
<input type="hidden" name="ID" value="<?=$ID?>">
<tr>
    <td height="100%" valign="top" class="tab_conteudo">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="32" class="tab_titulo"><h4>Cadastro de defeito</h4></td>
      </tr>
    </table>
	  
    <table width="100%"  border="0" cellpadding="0" cellspacing="0">
      <tr class="tab_cadastro">
        <td class=""><strong>Descri&ccedil;&atilde;o*</strong></td>
        <td><input name="DEFEI_DESCRICAO" type="text" class="form" value="<?=$DEFEI_DESCRICAO?>" size="50" maxlength="50"></td>
      </tr>
      <tr class="tab_inclusao">
        <td>&nbsp;</td>
        <td style="padding-top:10px;"> <a href="javascript:verificaForm();" >
          <? if (returnAcess("CADDEFEITO") == "T") { ?>
        </a><a href="javascript:verificaForm(document.form)" ><img src="../img/bts/gravar.jpg" alt="Gravar dados" name="Image351" border="0" id="Image351"></a><a href="javascript:verificaForm();" >
        <? } ?>
        </a><a href="pesq_defeitos.php" ><img src="../img/bts/cancelar.jpg" alt="Cancelar grava&ccedil;&atilde;o dos dados" name="Image361" border="0" id="Image361"></a></td>
      </tr>
    </table>
</form>
	<br/ ><br/ >
	</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="100%" bgcolor="#333333" class="rodape"><?=$RodapeDesenvolvedor?></td>
    <td bgcolor="#333333">&nbsp;</td>
  </tr>
</table>
<script language="javascript" type="text/javascript">
<!--
function verificaForm(formObj) {
	if (formObj.DEFEI_DESCRICAO.value == "") {
		alert("Preencha o campo \"Descrição\"");
		formObj.DEFEI_DESCRICAO.focus();
		return;
	}
	formObj.action = "cad_defeitosok.php";		
	document.form.submit();
}

//-->
</script>