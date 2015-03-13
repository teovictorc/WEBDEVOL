<? include("inc/headerI.inc.php"); 
verifyAcess("CADUSUARIO","S");

$_pagi_sql = "SELECT * FROM rar_usuario";
if (isset($_GET["busca"])){
	$_pagi_sql.= " WHERE USUAR_NOME LIKE '%" . addslashes($_GET["busca"]) . "%'";
}
$_pagi_sql.= " ORDER BY USUAR_NOME";
	
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

function setSubmit(acao, vlr)
{
	var form = document.form;
	
	switch(acao.toLowerCase())
	{
		case 'procurar'	:	form.action = 'pesq_usuarios.php?busca=' + vlr;	form.submit();	break;
		default			:	break;
	}
}
//-->
</script>
<body onLoad="MM_preloadImages('imagens/excluir2.jpg','imagens/incluir2.jpg')">
<form name="form" id="form" action="#">
<tr>
    <td height="100%" valign="top" class="tab_conteudo">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="32" class="tab_titulo"><h4>Cadastro de usu&aacute;rio</h4></td>
      </tr>
      </table>  
    
    
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tab_cadastro">
      <tr>
        <td width="250"><a href="#" onClick="javascript: deleteById('del_usuarios.php', document.form.IDS);"><img src="../img/bts/apagar.jpg" width="20" height="20" border="0" align="absmiddle" alt="Apagar selecionadas" /></a> Apagar selecionadas</td>
        <td width="220"><?=mysql_num_rows($_pagi_result)?> Registros</td>
        <td><input type="text" name="busca" id="textfield" class="busca" value="<?=$_GET["busca"];?>" /> <a href="#" onClick="javascript: if (document.form.textfield.value.length >0 ){ setSubmit('procurar', document.form.textfield.value); }"><img src="../img/bts/buscar.jpg" alt="Buscar" border="0" align="absmiddle" /></a><a href="cad_usuario.php" onClick="javascript: if (document.form.textfield.value.length >0 ){ setSubmit('procurar', document.form.textfield.value); }"><img src="../img/bts/incluir.jpg" alt="Incluir" border="0" align="absmiddle" /></a></td>
      </tr>
    </table>
    <table width="100%" cellspacing="0" cellpadding="0" >
      <tr class="tab_usuarios">
        <td width="3%"><img src="../img/bts/selecionar.jpg" width="10" height="8" /></td>
        <td width="30%"><strong>Nome</strong></td>
        <td width="20%"><strong>Login</strong></td>
        <td width="10%"><strong>Bloqueado</strong></td>
        <td width="10%"><strong>Consultor</strong></td>
        <td width="10%"><strong>Franqueado</strong></td>
        <td width="10%"><strong>Logist&iacute;co</strong></td>
        <td width="5%" align="center"><strong>Op&ccedil;&otilde;es</strong></td>
      </tr>
	  <tr>
	  	<td colspan="8" style="margin-bottom:10px;"></td>
	  </tr>
	 <? 
	//$Stmt = mysql_query("SELECT * FROM rar_usuario ORDER BY USUAR_NOME",$Conn);


	while($Rs = mysql_fetch_assoc($_pagi_result)) { 
		if ($cor == "$f5f5f5"){
			$cor = "$ffffff";
		}else{
			$cor = "$f5f5f5";
		}
		?>
      <tr bordercolor="<?=$cor?>" class="tab_usuarios_info" onMouseOver="javascript:this.bgColor='#F9F9F9'" onMouseOut="javascript:this.bgColor='#F0F0F0'">
        <td width="22"><input type="checkbox" name="IDS" id="IDS" value="<?=$Rs["USUAR_IDO"]?>" /></td>
        <td><a href="cad_usuario.php?Id=<?=$Rs["USUAR_IDO"]?>"><?=$Rs["USUAR_NOME"]?></a></td>
        <td><?=$Rs["USUAR_LOGIN"]?></td>
        <td align="center"><?=(($Rs["USUAR_BLOQUEADO"] == "S") ? "X" : "&nbsp;")?></td>
        <td align="center"><?=(($Rs["USUAR_ECONSULTOR"] == "S") ? "SIM" : "&nbsp;")?></td>
        <td align="center"><?=(($Rs["USUAR_EFRANQUEADO"] == "S") ? "SIM" : "&nbsp;")?></td>
        <td align="center"><?=(($Rs["USUAR_ELOGISTICA"] == "S") ? "SIM" : "&nbsp;")?></td>
		<td align="center">
			<a href="cad_usuario.php?Id=<?=$Rs["USUAR_IDO"]?>"><img src="../img/bts/editar.jpg" alt="Editar" width="20" height="20" border="0" /></a>
        	<a href="#" onClick="javascript: deleteById('del_usuarios.php', '<?=$Rs["USUAR_IDO"]?>');"><img src="../img/bts/apagar.jpg" alt="Excluir" width="20" height="20" border="0" /></a>
		</td>
      </tr>
<? } ?>
	</table>
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
</Form>
</body>
</html>