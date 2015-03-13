<? include("inc/headerI.inc.php");
verifyAcess("CADCLIENTE","S");

$_pagi_sql  ="select distinct pecl.pessoa PESSOA, pecl.nome NOME, pecl.FANTASIA ";
$_pagi_sql .="from pessoa pecl ";
$_pagi_sql .="where ";
$_pagi_sql .=" pecl.ecliente in ('S',1) ";
$_pagi_sql .=" and pecl.cliente_ativo in ('S',1)";
$_pagi_sql .=" and pecl.pessoa in (select usucli_pessoa from rar_usuarioxcliente where usucli_usuar_ido = " . $_SESSION['sId'] . ")";



if (isset($_GET["busca"])){
	$_pagi_sql.= " and NOME LIKE '%" . addslashes($_GET["busca"]) . "%'";
}
$_pagi_sql.= " ORDER BY pecl.NOME ";
	
include_once("inc/paginator.inc.php");
?>
<script>
function setSubmit(acao, vlr)
{
	var form = document.form;
	
	switch(acao.toLowerCase())
	{
		case 'procurar'	:	form.action = 'pesq_cliente.php?busca=' + vlr;	form.submit();	break;
		default			:	break;
	}
}
</script>
<body onLoad="MM_preloadImages('imagens/excluir2.jpg','imagens/incluir2.jpg')">
<form name="form" method="post" action="#">
<tr>
    <td height="100%" valign="top" class="tab_conteudo">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="32" class="tab_titulo"><h4>Cadastro de cliente</h4></td>
      </tr>
      </table>  
    
    
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tab_cadastro">
      <tr>
        <td width="250"></td>
        <td width="220"><?=mysql_num_rows($_pagi_result)?> Registros</td>
        <td><input type="text" name="busca" id="textfield" class="busca" value="<?=$_GET["busca"];?>" /> <a href="#" onClick="javascript: setSubmit('procurar', document.form.textfield.value);"><img src="../img/bts/buscar.jpg" alt="Buscar" border="0" align="absmiddle" /></a><a href="cad_usuario.php"><img src="../img/bts/incluir.jpg" alt="Incluir" border="0" align="absmiddle" /></a></td>
      </tr>
    </table>
    <table width="100%" cellspacing="0" cellpadding="0" >
      <tr class="tab_usuarios">
        <td width="202"><strong>Código</strong></td>
        <td width="405"><strong>Nome</strong></td>
        <td width="366"><strong>Email 1</strong></td>
		<td width="5%" align="center"><strong>Op&ccedil;&otilde;es</strong></td>
      </tr>
	  <tr>
	  	<td colspan="8" style="margin-bottom:10px;"></td>
	  </tr>
	 <? 
	while($Rs = mysql_fetch_assoc($_pagi_result)) { 
		if ($cor == "$f5f5f5"){
			$cor = "$ffffff";
		}else{
			$cor = "$f5f5f5";
		}
		?>
      <tr bordercolor="<?=$cor?>" class="tab_usuarios_info" onMouseOver="javascript:this.bgColor='#F9F9F9'" onMouseOut="javascript:this.bgColor='#F0F0F0'">
        <td width="202"><a href="cad_cliente.php?Id=<?=$Rs["PESSOA"]?>&Nome=<?=urlencode($Rs["NOME"])?>"><?=$Rs["FANTASIA"]?></a></td>
        <td><?=$Rs["NOME"]?></td>
        <td><?=$Rs["EMAIL"]?></td>
		<td><a href="cad_cliente.php?Id=<?=$Rs["PESSOA"]?>&Nome=<?=urlencode($Rs["NOME"])?>"><img src="../img/bts/editar.jpg" alt="Editar" width="20" height="20" border="0" /></a></td>
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