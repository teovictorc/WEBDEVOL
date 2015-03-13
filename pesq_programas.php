<? include("inc/headerI.inc.php"); 

verifyAcess("CONFIG_PROGRAMAS","S");?>

<Form name="form" action="#">

<table width="100%"  border="0" align="center">

     <tr>

       <td width="49%"><span class="titulo">:: Cadastro de programa ::</span></td>

       <td width="51%"><div align="right"><a href="cad_programas.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image35','','imagens/incluir2.jpg',1)"><span class="titulo"><a href="javascript: abrir_help('#cadprograma');">Help</a></span><a href="cad_programas.php"><img src="imagens/incluir.jpg" alt="Incluir novo registro" name="Image35" width="68" height="20" border="0"></a></a>&nbsp;<a href="javascript:deleteById('del_programas.php',document.form.IDS);" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image34','','imagens/excluir2.jpg',1)"><img src="imagens/excluir.jpg" alt="Excluir registros assinalados" name="Image34" width="68" height="20" border="0"></a><a href="cad_defeitos.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image35','','imagens/incluir2.jpg',1)"></a>&nbsp;</div></td>

     </tr>

   </table></td>

   <td><img name="webdevol_r7_c11" src="imagens/img/webdevol_r7_c11.jpg" width="33" height="38" border="0" alt=""></td>

  </tr>

  <tr>

   <td background="imagens/img/webdevol_r8_c1.jpg">&nbsp;</td>

   <td colspan="9">

    <table width="100%"  border="0" align="center">

      <tr class="topo_listagem" >

        <td width="5%" ><div align="center">X</div></td>

        <td width="20%" height="25" >C&Oacute;DIGO</td>

        <td width="50%" >DESCRI&Ccedil;&Atilde;O</td>

        <td width="15%" ><div align="center">TIPO PROGRAMA </div></td>

      </tr>

<? 

	$Stmt = mysql_query("SELECT * FROM RAR_PROGRAMA ORDER BY PROGR_DESCRICAO");



	while($Rs = mysql_fetch_assoc($Stmt)) { ?>

      <tr bordercolor="#00CCFF" class="listagem" onmouseover="javascript:this.bgColor='#E1E9F7'" onmouseout="javascript:this.bgColor='white'">

        <td >        

          <div align="center">

            <input type="checkbox" name="IDS" value="<?=$Rs["PROGR_CODIGO"]?>">

          </div></td>

        <td><a href="cad_programas.php?Id=<?=urlencode($Rs["PROGR_CODIGO"])?>"><?=$Rs["PROGR_CODIGO"]?></a></td>

        <td><?=$Rs["PROGR_DESCRICAO"]?></td>

        <td><?=(($Rs["PROGR_TIPO"] == "M") ? "Modulo" : "Programa")?></td>

      </tr>

<? } ?>

    </table>

</Form>	

<? include("inc/headerF.inc.php"); ?>