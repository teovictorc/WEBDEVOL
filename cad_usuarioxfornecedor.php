<? include("inc/headerI.inc.php"); 
	$ID = $_GET['Id'];
	verifyAcess("CADVINCULOFORNECEDOR","S");
?>

<form name="form" method="post" action="#">
<input type="hidden" name="ID" value="<?=$ID?>">
<input type="hidden" name="ACESS" value="">
<tr>
    <td height="100%" valign="top" class="tab_conteudo">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="100%" class="tab_titulo"><h4>Vincula&ccedil;&atilde;o de usu&aacute;rio x fornecedor</h4></td>
      </tr>
    </table>
	
	<table width="748" border="0" class="tab_inclusao">
      <tr>
        <td width="22%" class=""><strong>Nome do usu&aacute;rio *</strong></td>
        <td colspan="4"><input name="textfield" type="text" class="form" value="<?=$_GET['Nome']?>" size="50" maxlength="50" disabled></td>
  	  </tr>
    </table>  
	
	<table width="748" border="0" class="tab_inclusao">
	  <tr>
		<td width="45%" class=""><div align="center">Fornecedores dispon&iacute;veis</div></td>
		<td width="10%" class=""><div align="center"></div></td>
		<td width="45%" class=""><div align="center">Fornecedores selecionados</div></td>
	  </tr>
<tr>
            <td valign="top" class="campo_texto">
              <div align="center">
			  <select name="USUAR_ACESS_FREE" size="10" multiple class="campo_texto" id="USUAR_ACESS_FREE" style="overflow:auto; width:350px; height:150px">
				<? 
					$Sql = "SELECT NOME, PESSOA ".
					" FROM pessoa ".
					" WHERE EFORNECEDOR = 'S' ".
					//"       AND FORNECEDOR_ATIVO = 'S' ".
					"       AND PESSOA NOT IN (SELECT USUFOR_PESSOA ".
                                                "from rar_usuarioxfornecedor ".
											  " WHERE USUFOR_USUAR_IDO = '" .$ID. "')".
					" order by pessoa";
					$Stmt = mysql_query($Sql);
				    while($Rs = mysql_fetch_assoc($Stmt)) {  
						if ($Rs["FORNECEDOR_ATIVO"] != "S"){
							$Fornecedor = arrumaPessoa($Rs["PESSOA"])." - ".$Rs["NOME"]." (inativo)";
						}else{
							$Fornecedor = arrumaPessoa($Rs["PESSOA"])." - ".$Rs["NOME"];
						}
						
					?>
				   <option value="<?=$Rs["PESSOA"]?>"><?=$Fornecedor?></option>		   
				<? } ?>
                </select>
              </div></td>
            <td width="5%" class="campo_texto"><div align="center">
              <p><a href="javascript:moveListOByListD('USUAR_ACESS_FREE','USUAR_ACESS');"><img src="imagens/seta_direita.gif" alt="Adicionar acesso(s) selecionado(s)" width="33" height="15" border="0"></a></p>
              <p><a href="javascript:moveListOByListD('USUAR_ACESS','USUAR_ACESS_FREE');"><img src="imagens/seta_esquerda.gif" alt="Remover acesso(s) selecionado(s)" width="33" height="15" border="0"></a></p>
            </div></td>
            <td class="campo_texto">
			  <select name="USUAR_ACESS" size="10" multiple class="campo_texto" id="USUAR_ACESS" style="overflow:auto; width:350px; height:150px">
				<? 
					$Sql = " SELECT NOME,PESSOA FROM pessoa ";
					$Sql.= " WHERE EFORNECEDOR = 'S' ";
					//$Sql.= "       AND FORNECEDOR_ATIVO = 'S' ";
					$Sql.= "       AND PESSOA IN (SELECT USUFOR_PESSOA ";
					$Sql.= "                        FROM rar_usuarioxfornecedor ";
					$Sql.= "                       WHERE USUFOR_USUAR_IDO = '" .$ID. "') ";
					$Sql.= " order by pessoa";
					$Stmt = mysql_query($Sql);
				   	while($Rs = mysql_fetch_assoc($Stmt)) {  
						if ($Rs["FORNECEDOR_ATIVO"] != "S"){
							$Fornecedor = arrumaPessoa($Rs["PESSOA"])." - ".$Rs["NOME"]." (inativo)";
						}else{
							$Fornecedor = arrumaPessoa($Rs["PESSOA"])." - ".$Rs["NOME"];
						}
						?>
				   	<option value="<?=$Rs["PESSOA"]?>"><?=$Fornecedor?></option>
				<? } ?>
                </select>
            	</div>
				</td>
            </tr>	  
	</table>	  
	<br />
	<table width="748" border="0" class="tab_inclusao">
	  <tr>
        <td colspan="5">
			<div align="center">
				<a href="javascript:verificaForm();" >
          		<? if (returnAcess("CADVINCULOFORNECEDOR") == "T") { ?>
          		<img src="../img/bts/gravar.jpg" alt="Gravar dados" name="Image351" border="0" id="Image351">
          		<? } ?>
        		</a><a href="pesq_usuarioxfornecedor.php?USUAR_IDO=<?=$ID?>"><img src="../img/bts/cancelar.jpg" alt="Cancelar grava&ccedil;&atilde;o dos dados" name="Image361" border="0" id="Image361"></a>
			</div>
		</td>
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
function moveListOByListD(ListO,ListD) {
	var iTotal = document.forms['form'].elements[ListO].length;
	for (x = 0; x < iTotal; x++) {
		if (document.forms['form'].elements[ListO].options[x].selected) {
			var sValue = document.forms['form'].elements[ListO].options[x].value;
			var sText = document.forms['form'].elements[ListO].options[x].text;
			document.forms['form'].elements[ListD].options[document.forms['form'].elements[ListD].length] = new Option(sText,sValue,true);
			document.forms['form'].elements[ListO].options[x] = null;
			iTotal--;
			x--;
		}
	}
}
function verificaForm() {
	for(x = 0; x < document.form.USUAR_ACESS.options.length; x++)
		document.form.ACESS.value+= ((x == 0) ? "" : ",") + document.form.USUAR_ACESS.options[x].value;

	document.form.action = "cad_usuarioxfornecedorok.php";		
	document.form.submit();
}

//-->
</script>
</body>
</html>