<? include("inc/headerI.inc.php"); 
verifyAcess("CADUSUARIO","S");

$_pagi_sql = "SELECT p.*, c.descricao categoria, date_format(datahora,'%d/%m/%Y %H:%i') hora, format(saldo,2) saldo_formatado 
                FROM produto p, categoria c where c.id = id_categoria";
if ($_GET["lote"] != ""){
	$_pagi_sql_w.= " and p.lote LIKE '%" . addslashes($_GET["lote"]) . "%'";
}
if ($_GET["busca"] != ""){
	$_pagi_sql_w.= " and p.descricao LIKE '%" . addslashes($_GET["busca"]) . "%'";
}
if ($_GET["id_categoria"] != ""){
	$_pagi_sql_w.= " and p.id_categoria = '" . addslashes($_GET["id_categoria"]) . "'";
}
if ($_GET["cor"] != ""){
	$_pagi_sql_w.= " and p.cor LIKE '%" . addslashes($_GET["cor"]) . "%'";
}
if ($_GET["cartela"] != ""){
	$_pagi_sql_w.= " and p.cartela LIKE '%" . addslashes($_GET["cartela"]) . "%'";
}
$_pagi_sql = $_pagi_sql . $_pagi_sql_w;
$_pagi_sql = $_pagi_sql . " ORDER BY lote";

//echo($_pagi_sql);


$sqlResumo = "SELECT c.descricao categoria, sum(saldo) saldo_formatado 
                FROM produto p, categoria c 
			   where c.id = id_categoria";
$sqlResumo = $sqlResumo . $_pagi_sql_w; 			   

$sqlResumo = $sqlResumo . " group by c.descricao order by c.descricao";
//echo($sqlResumo);	
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

function deletar(sPage,id) {
	if(confirm("Confirma a exclusão do(s) registro(s)?")==true){
		document.location.href = sPage + ((sPage.indexOf("?") == -1) ? "?" : "&") + "IdDel=" + id;
	}

}

function setSubmit(acao, vlr)
{
	var form = document.form;
	
	/*if (document.form.id_categoria.value == ""){
		alert('O filtro CATEGORIA deve ser selecionado !');
		document.form.id_categoria.focus();
	}else{*/
		
		switch(acao.toLowerCase())
		{
			case 'procurar'	:	form.action = 'pesq_produtos.php?busca=' + vlr;	form.submit();	break;
			default			:	break;
		}
	/*}*/
}
//-->
</script>
<body onLoad="MM_preloadImages('imagens/excluir2.jpg','imagens/incluir2.jpg')">
<form name="form" id="form" action="#">
<tr>
    <td height="100%" valign="top" class="tab_conteudo">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="32" class="tab_titulo"><h4>Cadastro de produtos</h4></td>
      </tr>
      </table>  
    
    
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tab_cadastro">
      <tr>
        <td>Pesquisa:</td>
        <td colspan="2">Categoria:
          <select name="id_categoria" class="busca" id="id_categoria">
            <option value="">..Selecione</option>
            <?
			$Sql = "SELECT distinct c.id, c.descricao FROM categoria c, produto p where c.id = p.id_categoria order by c.id";
			$Stmt = mysql_query($Sql);
			while ($Rs = mysql_fetch_assoc($Stmt)) {
			?>
            <option value="<?=$Rs["id"]?>" <?=(($Rs["id"]) == ($id_categoria) ? " selected" : "")?>>
            <?=$Rs["descricao"]?>
            </option>
            <?
			}
			?>
          </select>          
          Lote:
          <input name="lote" type="text" class="busca" id="lote" value="<?=$_GET["lote"];?>" size="15" />
          Descri&ccedil;&atilde;o:
          <input name="busca" type="text" class="busca" id="textfield" value="<?=$_GET["busca"];?>" size="30" />
          Cor:
          <input name="cor" type="text" class="busca" id="busca" value="<?=$_GET["cor"];?>" size="30" />
		  Cartela:
          <input name="cartela" type="text" class="busca" id="cartela" value="<?=$_GET["cartela"];?>" size="30" />
          <a href="#" onClick="javascript: setSubmit('procurar', document.form.textfield.value);"><img src="../img/bts/buscar.jpg" alt="Buscar" border="0" align="absmiddle" /></a><a href="cad_produto.php" onClick="javascript: if (document.form.textfield.value.length >0 ){ setSubmit('procurar', document.form.textfield.value); }">
		  <? if ($_SESSION['tipoUsuario'] == 1){?> <img src="../img/bts/incluir.jpg" alt="Incluir" border="0" align="absmiddle" /> <? } ?></a></td>
        </tr>
      <tr>
          
			<td width="165">
				<? if ($_SESSION['tipoUsuario'] == 1){?>
				<a href="#" onClick="javascript: deleteById('del_produtos.php', document.form.IDS);">
				<img src="../img/bts/apagar.jpg" width="20" height="20" border="0" align="absmiddle" alt="Apagar selecionadas" /></a>
				Apagar selecionados
				<? } else { ?>&nbsp; <? } ?>
				
			</td>
		
			
        <td width="305"><a href="cad_produto.php" onClick="javascript: if (document.form.textfield.value.length >0 ){ setSubmit('procurar', document.form.textfield.value); }"></a></td>
        <td width="847">&nbsp;</td>
      </tr>
    </table>
    <table width="100%" cellspacing="0" cellpadding="0" >
      <tr class="tab_usuarios">
        <td align="center">X</td>
		<td width="3%" align="center"><img src="../img/bts/selecionar.jpg" width="10" height="8" /></td>
		<td width="5%"><strong>Lote</strong></td>
        <td width="30%"><strong>Descrição</strong></td>
		<td width="10%"><strong>Cor</strong></td>
		<td width="5%" align="right"><strong>Qtde</strong></td>
		<td width="7%" align="center"><strong>Gaveta</strong></td>
		<td width="10%" align="center"><strong>Cartela</strong></td>
		<td width="7%"><strong>Categoria</strong></td>
        <td width="10%" align="center"><strong>Data/hora</strong></td>
		<? if ($_SESSION['tipoUsuario'] == 1){?> <td width="10%" align="center">&nbsp;</td> <? } ?>
      </tr>

	 <? 
	//$Stmt = mysql_query("SELECT * FROM rar_usuario ORDER BY USUAR_NOME",$Conn);

	$SaldoTotal = 0;
	$x=0;
	while($Rs = mysql_fetch_assoc($_pagi_result)) { 
		if ($cor == "$f5f5f5"){
			$cor = "$ffffff";
		}else{
			$cor = "$f5f5f5";
		}
		$x++;
		$SaldoTotal+=str_replace(",",".",$Rs["saldo"]);
		?>
      <tr bordercolor="<?=$cor?>" class="tab_usuarios_info" onMouseOver="javascript:this.bgColor='#F9F9F9'" onMouseOut="javascript:this.bgColor='#F0F0F0'">
        <td align="center"><?=$x?></td>
		<td width="22" align="center"><input type="checkbox" name="IDS" id="IDS" value="<?=$Rs["id"]?>" /></td>
		<? if ($_SESSION['tipoUsuario'] == 1){?>
	        <td><a href="cad_produto.php?Id=<?=$Rs["id"]?>"><?=$Rs["lote"]?></a></td>
		<? } else { ?>
			<td><?=$Rs["lote"]?></td>
		<? } ?>
		<td><?=$Rs["descricao"]?></td>
		<td><?=$Rs["cor"]?></td>
		<td align="right"><strong><?=$Rs["saldo_formatado"]?></strong></td>
		<td align="center"><?=$Rs["gaveta"]?></td>
		<td align="center"><?=$Rs["cartela"]?></td>
		<td><?=$Rs["categoria"]?></td>
		<td  align="center"><?=$Rs["hora"]?></td> 
		<? if ($_SESSION['tipoUsuario'] == 1){?>
			<td align="center">
			<a href="cad_produto.php?Id=<?=$Rs["id"]?>"><img src="../img/bts/editar.jpg" alt="Editar" width="20" height="20" border="0" /></a>
        	<a href="#" onClick="javascript: deletar('del_produtos.php','<?=$Rs["id"]?>');"><img src="../img/bts/apagar.jpg" alt="Excluir" width="20" height="20" border="0" </a>
			</td>
		<? } ?>
      </tr>
<? } ?>

	<tr bordercolor="<?=$cor?>" class="tab_usuarios_info">
        <td colspan="5"><div align="right"><strong>Total</strong></div></td>
        <td align="right"><strong><?=$SaldoTotal?></strong></td>
		<td colspan="5"><div align="right"><strong>&nbsp;</strong></div></td>
      </tr>

	</table>
	<br/ >
	
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td colspan="2"><strong>Resumo de quantidades por categoria</strong></td>
      </tr>
	  <?
			$Sql = $sqlResumo;
			$Stmt = mysql_query($Sql);
			while ($Rs = mysql_fetch_assoc($Stmt)) {
			?>
			<tr>
            <td><div align="left">Categoria: <?=$Rs["categoria"]?> - Qtde: <?=$Rs["saldo_formatado"]?></div></td>
			</tr>
            <?
			}
			?>
    </table>
	
	</br>
	
	
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