<? include("inc/headerI.inc.php"); 

	$USUAR_IDO = $_GET['USUAR_IDO'];

	verifyAcess("CADVINCSANJOCOORD","S");



?>

<form name="form" method="get" action="pesq_anjoxcoordenador.php">

<table width="100%"  border="0" align="center">

     <tr>

       <td width="49%"><span class="titulo">:: Vincula&ccedil;&atilde;o de anjo x coordenador :: </span></td>

       <td width="51%"><div align="right"><span class="titulo"><a href="javascript: abrir_help('#vincanjocoordenador');">Help</a></span>&nbsp;<a href="cad_defeitos.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image35','','imagens/incluir2.jpg',1)"></a>&nbsp;</div></td>

     </tr>

   </table></td>

   <td><img name="webdevol_r7_c11" src="imagens/img/webdevol_r7_c11.jpg" width="33" height="38" border="0" alt=""></td>

  </tr>

  <tr>

    <td background="imagens/img/webdevol_r8_c1.jpg">&nbsp;</td>

    <td colspan="9" bgcolor="#F4F4F4"><table width="100%"  border="0" align="center">

      <tr>

        <td width="18%"><span class="style1"><strong>Pesquisar acessos:</strong></span></td>

        <td width="60%" valign="middle"><select name="USUAR_IDO" class="campo_texto">

			<option value="">..Selecione</option>

<? 	$Stmt = mysql_query("SELECT * FROM RAR_USUARIO ORDER BY USUAR_NOME");

	while($Rs = mysql_fetch_assoc($Stmt)) { ?>

	<option value="<?=$Rs["USUAR_IDO"]?>"<?=(($USUAR_IDO == $Rs["USUAR_IDO"]) ? " selected" : "")?>><?=$Rs["USUAR_NOME"]?></option>

<? } ?>

</select><a href="javascript:document.form.submit();"><img src="imagens/pesquisar.jpg" alt="Incluir novo registro" name="Image3511" width="78" height="20" border="0" align="middle" id="Image351"></a>                <div align="left"><a href="cad_defeitos.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image35','','imagens/incluir2.jpg',1)"></a></div></td>

        <td width="22%"><div align="right"><a href="javascript:incluirUsuarioXCliente();" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image351','','imagens/incluir2.jpg',1)"><img src="imagens/incluir.jpg" alt="Incluir novo registro" name="Image351" width="68" height="20" border="0" id="Image351"></a><a href="javascript:deleteById('del_anjoxcoordenador.php?Usuar_Ido=<?=$USUAR_IDO?>',document.form.IDS);" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image341','','imagens/excluir2.jpg',1)"><img src="imagens/excluir.jpg" alt="Excluir registros assinalados" name="Image341" width="68" height="20" border="0" id="Image341"></a></div></td>

      </tr>

    </table></td>

    <td background="imagens/img/webdevol_r8_c11.jpg">&nbsp;</td>

  </tr>

  <tr>

   <td background="imagens/img/webdevol_r8_c1.jpg">&nbsp;</td>

   <td colspan="9">

    <table width="100%"  border="0" align="center">

      <tr class="topo_listagem" >

        <td width="5%" height="25" ><div align="center">X</div></td>

        <td >NOME DO COORDENADOR

          <div align="center"></div></td>

        </tr>

<? 

	$Sql = " SELECT A.*, PESSOA, NOME ";

	$Sql.= " FROM rar_anjo_coordenador A, PESSOA U ";

	$Sql.= " WHERE ANJCO_USUAR_IDO = '" .$USUAR_IDO. "' ";

	$Sql.= "       AND PESSOA = ANJCO_PESSOA ";

	$Sql.= " ORDER BY NOME";

	$Stmt = mysql_query($Sql);

	while($Rs = mysql_fetch_assoc($Stmt)) { ?>

      <tr bordercolor="#00CCFF" class="listagem" onmouseover="javascript:this.bgColor='#E1E9F7'" onmouseout="javascript:this.bgColor='white'">

        <td >        

          <div align="center">

            <input type="checkbox" name="IDS" value="<?=$Rs["ANJCO_IDO"]?>">

          </div></td>

        <td><?=$Rs["NOME"]?></td>

      </tr>

<? } ?>

    </table>

</form><? include("inc/headerF.inc.php"); ?>

<script language="javascript" type="text/javascript">

<!--

	function incluirUsuarioXCliente() {

		if (document.form.USUAR_IDO.value == "") {

			alert("Selecione um Usuário");

			return;

		}

		document.location.href = 'cad_anjoxcoordenador.php?Id=' + document.form.USUAR_IDO.value + '&Nome=' + escape(document.form.USUAR_IDO.options[document.form.USUAR_IDO.selectedIndex].text);   

	}

//-->

</script>