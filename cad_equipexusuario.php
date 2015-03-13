<? include("inc/headerI.inc.php"); 

	$ID = $_GET['Id'];

	verifyAcess("CADVINCULOEQUIPE","S");

?>

<form name="form" method="post" action="#">

<input type="hidden" name="ID" value="<?=$ID?>">

<input type="hidden" name="ACESS" value="">

<table width="100%"  border="0" align="center">

     <tr>

       <td width="49%"><span class="titulo">:: Vincula&ccedil;&atilde;o de equipe x usu&aacute;rio  ::</span></td>

       <td width="51%"><div align="right"><span class="titulo"><a href="javascript: abrir_help('#cadequipexusuario_manut');">Help</a></span></div></td>

     </tr>

   </table></td>

   <td><img name="webdevol_r7_c11" src="imagens/img/webdevol_r7_c11.jpg" width="33" height="38" border="0" alt=""></td>

  </tr>

  <tr>

   <td background="imagens/img/webdevol_r8_c1.jpg">&nbsp;</td>

   <td colspan="9">

    <table width="100%"  border="0" class="tabela">

      <tr>

        <td width="20%" class="style2"><strong>Nome da equipe</strong></td>

        <td width="80%"><input name="textfield" type="text" class="campo_amarelo" value="<?=$_GET['Nome']?>" size="50" maxlength="50" disabled></td>

        </tr>

      <tr>

        <td colspan="2"><table width="95%"  border="0" align="center">

          <tr class="topo_listagem">

            <td width="45%" class="topo_listagem"><div align="center">Usu&aacute;rios dispon&iacute;veis </div></td>

            <td width="10%" class="topo_listagem"><div align="center"></div></td>

            <td width="45%" class="topo_listagem"><div align="center">Usu&aacute;rios selecionados</div>              

              <div align="center"></div>              </td>

            </tr>

          <tr>

            <td valign="top" class="campo_texto">

              <div align="center">

			  <select name="USUAR_ACESS_FREE" size="10" multiple class="campo_texto" id="USUAR_ACESS_FREE">

				<? 

					$Sql = "SELECT * ".

					" FROM RAR_USUARIO ".

					" WHERE USUAR_IDO NOT IN (SELECT EQUSU_USUAR_IDO ".

                                                "FROM RAR_EQUIPEXUSUARIO ".

											  " WHERE EQUSU_EQUIP_IDO = '" .$ID. "')".

					" order by USUAR_NOME";

					$Stmt = mysql_query($Sql);

				    while($Rs = mysql_fetch_assoc($Stmt)) {  

					?>

				   		<option value="<?=$Rs["USUAR_IDO"]?>"><?=$Rs["USUAR_NOME"]?></option>		   

					<? } ?>

                </select>

              </div></td>

            <td width="5%" class="campo_texto"><div align="center">

              <p><a href="javascript:moveListOByListD('USUAR_ACESS_FREE','USUAR_ACESS');"><img src="imagens/seta_direita.gif" alt="Adicionar acesso(s) selecionado(s)" width="33" height="15" border="0"></a></p>

              <p><a href="javascript:moveListOByListD('USUAR_ACESS','USUAR_ACESS_FREE');"><img src="imagens/seta_esquerda.gif" alt="Remover acesso(s) selecionado(s)" width="33" height="15" border="0"></a></p>

            </div></td>

            <td class="campo_texto"><div align="center"></div>              <div align="center">

			  <select name="USUAR_ACESS" size="10" multiple class="campo_texto" id="USUAR_ACESS">

				<? 

					$Sql = "SELECT * ".

					" FROM RAR_USUARIO ".

					" WHERE USUAR_IDO IN (SELECT EQUSU_USUAR_IDO ".

                                                "FROM RAR_EQUIPEXUSUARIO ".

											  " WHERE EQUSU_EQUIP_IDO = '" .$ID. "')".

					" order by USUAR_NOME";

					$Stmt = mysql_query($Sql);

				   	while($Rs = mysql_fetch_assoc($Stmt)) {  

					?>

				   		<option value="<?=$Rs["USUAR_IDO"]?>"><?=$Rs["USUAR_NOME"]?></option>

					<? } ?>

                </select>

            </div>              <div align="center"></div></td>

            </tr>

        </table>

          <div align="center"></div></td>

        </tr>

      <tr>

        <td colspan="2"> <div align="center"><a href="javascript:verificaForm();" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image351','','imagens/gravar2.jpg',1)">

          <? if (returnAcess("CADVINCULOEQUIPE") == "T") { ?>

          <img src="imagens/gravar.jpg" alt="Gravar dados" name="Image351" width="58" height="20" border="0" id="Image351">

          <? } ?>

        </a><a href="pesq_equipexusuario.php?EQUIP_IDO=<?=$ID?>" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image361','','imagens/cancelar2.jpg',1)"><img src="imagens/cancelar.jpg" alt="Cancelar grava&ccedil;&atilde;o dos dados" name="Image361" width="68" height="20" border="0" id="Image361"></a></div></td>

        </tr>

    </table>

</form>

<? include("inc/headerF.inc.php"); ?>

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



	document.form.action = "cad_equipexusuariook.php";		

	document.form.submit();

}



//-->

</script>