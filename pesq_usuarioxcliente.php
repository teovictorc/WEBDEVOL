<? include("inc/headerI.inc.php"); 
$USUAR_IDO = $_GET['USUAR_IDO'];
verifyAcess("CADVINCULOCLIENTE","S");

$_pagi_sql = " SELECT UC.*, P.NOME, P.PESSOA ";
$_pagi_sql.= " FROM rar_usuarioxcliente UC, pessoa P ";
$_pagi_sql.= " WHERE UC.USUCLI_USUAR_IDO = '" .$USUAR_IDO. "' ";
$_pagi_sql.= "       AND P.PESSOA = UC.USUCLI_PESSOA ";
$_pagi_sql.= " ORDER BY UC.USUCLI_IDO ";

include_once("inc/paginator.inc.php");
?>
<script language="javascript" type="text/javascript">
<!--
	function incluirUsuarioXCliente() {
		if (document.form.USUAR_IDO.value == "") {
			alert("Selecione um Usuário");
			return;
		}
		document.location.href = 'cad_usuarioxcliente.php?Id=' + document.form.USUAR_IDO.value + '&Nome=' + escape(document.form.USUAR_IDO.options[document.form.USUAR_IDO.selectedIndex].text);   
	}
	
	function Pesquisar(){
		document.form.submit();
	}
//-->
</script>
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
<form name="form" id="form" action="pesq_usuarioxcliente.php" method="get">
<tr>
    <td height="100%" valign="top" class="tab_conteudo">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="32" class="tab_titulo"><h4>Vinculação de usuário x cliente</h4></td>
      </tr>
      </table>  
    
    
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tab_cadastro">
      <tr>
        <td width="250"><a href="#" onClick="javascript: deleteById('del_usuarioxcliente.php?Usuar_Ido=<?=$USUAR_IDO?>', document.form.IDS);"><img src="../img/bts/apagar.jpg" width="20" height="20" border="0" align="absmiddle" alt="Apagar selecionadas" /></a> Apagar selecionadas</td>
        <td width="207"><?=mysql_num_rows($_pagi_result)?> Registros</td>
        <td>Usu&aacute;rio:</td>
		<td width="518" valign="bottom"> 
          <select name="USUAR_IDO" class="form">
          <option value="">..Selecione</option>
          <? 	$Stmt = mysql_query("SELECT * FROM rar_usuario ORDER BY USUAR_NOME");
	while($Rs = mysql_fetch_assoc($Stmt)) { ?>
          <option value="<?=$Rs["USUAR_IDO"]?>"<?=(($USUAR_IDO == $Rs["USUAR_IDO"]) ? " selected" : "")?>>
            <?=$Rs["USUAR_NOME"]?>
            </option>
          <? } ?>
        </select>
          <a href="#" onClick="javascript: Pesquisar();"><img src="../img/bts/buscar.jpg" alt="Buscar" border="0" align="absmiddle" /></a> <a href="#"><img onClick="incluirUsuarioXCliente();" src="../img/bts/incluir.jpg" alt="Incluir" border="0" align="absmiddle" /></a></td>
      </tr>
    </table>
    <table width="100%" cellspacing="0" cellpadding="0" >
      <tr class="tab_usuarios">
        <td width="3%"><img src="../img/bts/selecionar.jpg" width="10" height="8" /></td>
        <td width="17%"><strong>C&oacute;digo</strong></td>
        <td width="75%"><strong>Nome do cliente </strong></td>
        <td width="5%"><div align="center"><strong>Op&ccedil;&otilde;es</strong></div></td>
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
        <td width="22"><input type="checkbox" name="IDS" id="IDS" value="<?=$Rs["USUCLI_IDO"]?>" /></td>
        <td><?=arrumaPessoa($Rs["PESSOA"])?></td>
        <td><?=$Rs["NOME"]?></td>
		<td>
			<div align="center"><a href="cad_usuarioxcliente.php?Id=<?=$USUAR_IDO?>"><img src="../img/bts/editar.jpg" alt="Editar" width="20" height="20" border="0" /></a>
		    <a href="#" onClick="javascript: deleteById('del_usuarioxcliente.php?Usuar_Ido=<?=$USUAR_IDO?>', '<?=$Rs["USUCLI_IDO"]?>');"><img src="../img/bts/apagar.jpg" alt="Excluir" width="20" height="20" border="0" /></a>	          </div></td>
      </tr>
<? } ?>
	</table>
	<br/ >
    <table width="748" border="0" cellspacing="0" cellpadding="0">
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