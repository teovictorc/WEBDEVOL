<? include("inc/headerI.inc.php"); 
verifyAcess("CADDEFEITO","S");

$_pagi_sql = "SELECT * FROM rar_defeito ORDER BY DEFEI_DESCRICAO";
include_once("inc/paginator.inc.php");

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
<body onLoad="MM_preloadImages('imagens/excluir2.jpg','imagens/incluir2.jpg')">
<form name="form" method="post" action="#">
<tr>
    <td height="100%" valign="top" class="tab_conteudo">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="32" class="tab_titulo"><h4>Cadastro de defeito</h4></td>
      </tr>
      </table>

	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tab_cadastro">
      <tr>
        <td width="30"><a href="#" onClick="javascript: deleteById('del_defeitos.php', document.form.IDS);"><img src="../img/bts/apagar.jpg" width="20" height="20" border="0" align="absmiddle" alt="Apagar selecionadas" /></a></td>
		<td width="256">Apagar selecionadas</td>
        <td width="220"><?=mysql_num_rows($_pagi_result)?> Registros</td>
        <td width="383" align="right"><a href="#" onClick="javascript: if (document.form.textfield.value.length >0 ){ setSubmit('procurar', document.form.textfield.value); }"></a><a href="cad_defeitos.php"><img src="../img/bts/incluir.jpg" alt="Incluir" border="0" align="absmiddle" /></a></td>
      </tr>
    </table>

    <table width="100%"  border="0" align="center">
      <tr class="tab_usuarios" >
        <td width="5%" ><div align="center"><img src="../img/bts/selecionar.jpg" border="0"></div></td>
        <td width="95%" height="25" >DESCRI&Ccedil;&Atilde;O</td>
		<td><strong>Op&ccedil;&otilde;es</strong></td>
        </tr>
<? 
	//$Stmt = mysql_query("SELECT * FROM rar_defeito ORDER BY DEFEI_DESCRICAO");
	while($Rs = mysql_fetch_assoc($_pagi_result)) { ?>
      <tr bordercolor="#00CCFF" class="tab_usuarios_info" onMouseOver="javascript:this.bgColor='#E1E9F7'" onMouseOut="javascript:this.bgColor='white'">
        <td >        
          <div align="center">
            <input type="checkbox" name="IDS" value="<?=$Rs["DEFEI_IDO"]?>">
          </div></td>
        <td><a href="cad_defeitos.php?Id=<?=$Rs["DEFEI_IDO"]?>"><?=$Rs["DEFEI_DESCRICAO"]?></a></td>
		<td>
			<div align="center"><a href="cad_defeitos.php?Id=<?=$Rs["DEFEI_IDO"]?>"><img src="../img/bts/editar.jpg" alt="Editar" width="20" height="20" border="0" /></a>
		    <a href="#" onClick="javascript: deleteById('del_defeitos.php', '<?=$Rs["DEFEI_IDO"]?>');"><img src="../img/bts/apagar.jpg" alt="Excluir" width="20" height="20" border="0" /></a></div>
		</td>
      </tr>
 <? } ?>
    </table>
</form>
	<br/ >
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><p>P&aacute;ginas:&nbsp;<?= $_pagi_navegacion ?></p></td>
      </tr>
    </table>
	<br/ ><br/ >
	</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="100%" bgcolor="#333333" class="rodape"><?=$RodapeDesenvolvedor?></td>
    <td bgcolor="#333333">&nbsp;</td>
  </tr>
</table>