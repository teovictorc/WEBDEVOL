<? include("inc/headerI.inc.php"); 
	$USUAR_IDO = $_GET['USUAR_IDO'];
	verifyAcess("CADVINCULOFORNECEDOR","S");

    $_pagi_sql = "SELECT * FROM rar_usuarioxfornecedor WHERE USUFOR_IDO = '0'";
	if (isset($_GET["USUAR_IDO"]))
		$_pagi_sql = "SELECT UC.*, P.NOME,P.PESSOA FROM rar_usuarioxfornecedor UC, pessoa P WHERE UC.USUFOR_USUAR_IDO = '" .$USUAR_IDO. "' AND P.PESSOA = UC.USUFOR_PESSOA ORDER BY UC.USUFOR_IDO";

	include_once("inc/paginator.inc.php");
?>
<body onLoad="MM_preloadImages('imagens/excluir2.jpg','imagens/incluir2.jpg')">
<form name="form" method="get" action="pesq_usuarioxfornecedor.php">
<tr>
    <td height="100%" valign="top" class="tab_conteudo">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="32" class="tab_titulo"><h4>Vincula&ccedil;&atilde;o de usu&aacute;rio x fornecedor</h4></td>
      </tr>
      </table>  
    
    
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tab_cadastro">
      <tr>
        <td width="250"><a href="#" onClick="javascript: deleteById('del_usuarioxfornecedor.php?Usuar_Ido=<?=$USUAR_IDO?>', document.form.IDS);"><img src="../img/bts/apagar.jpg" width="20" height="20" border="0" align="absmiddle" alt="Apagar selecionadas" /></a> Apagar selecionadas</td>
        <td width="220"><?=mysql_num_rows($_pagi_result)?> Registros</td>
        <td>
			<select name="USUAR_IDO" class="form">
				<option value="">..Selecione</option>
			<? 	$Stmt = mysql_query("SELECT * FROM rar_usuario ORDER BY USUAR_NOME");
				while($Rs = mysql_fetch_assoc($Stmt)) { ?>
				<option value="<?=$Rs["USUAR_IDO"]?>"<?=(($USUAR_IDO == $Rs["USUAR_IDO"]) ? " selected" : "")?>><?=$Rs["USUAR_NOME"]?></option>
			<? } ?>
			</select>		
		 <a href="#" onClick="javascript: document.form.submit();"><img src="../img/bts/buscar.jpg" alt="Buscar" border="0" align="absmiddle" /></a><a href="#" onclick="javascript: incluirUsuarioXCliente();"><img src="../img/bts/incluir.jpg" alt="Incluir" border="0" align="absmiddle" /></a>
		</td>
      </tr>
    </table>
    <table width="100%" cellspacing="0" cellpadding="0" >
      <tr class="tab_usuarios">
        <td width="3%"><img src="../img/bts/selecionar.jpg" width="10" height="8" /></td>
        <td width="47%"><strong>Código</strong></td>
        <td width="45%"><strong>Nome do fornecedor</strong></td>
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
        <td width="22"><input type="checkbox" name="IDS" id="IDS" value="<?=$Rs["USUFOR_IDO"]?>" /></td>
        <td><?=arrumaPessoa($Rs["PESSOA"])?></td>
		<td><?=$Rs["NOME"]?></td>
		<td>
			<div align="center">
		    	<a href="#" onClick="javascript: deleteById('del_usuarioxfornecedor.php?Usuar_Ido=<?=$USUAR_IDO?>','<?=$Rs["USUFOR_IDO"]?>');"><img src="../img/bts/apagar.jpg" alt="Excluir" width="20" height="20" border="0" /></a>
			</div>
		</td>
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
<script language="javascript" type="text/javascript">
<!--
	function incluirUsuarioXCliente() {
		if (document.form.USUAR_IDO.value == "") {
			alert("Selecione um Usuário");
			return;
		}
		document.location.href = 'cad_usuarioxfornecedor.php?Id=' + document.form.USUAR_IDO.value + '&Nome=' + escape(document.form.USUAR_IDO.options[document.form.USUAR_IDO.selectedIndex].text);   
	}
//-->
</script>
</body>
</html>