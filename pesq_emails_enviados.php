<? include("inc/headerI.inc.php"); 

   require_once("convdata.php"); 

verifyAcess("CADCONTATO","S");?>



<Form name="form" action="#">

<tr>

    <td height="100%" valign="top" class="tab_conteudo">

    <table width="100%" border="0" cellspacing="0" cellpadding="0">

      <tr>

        <td height="100%" class="tab_titulo"><h4>E-mails enviados</h4></td>

      </tr>

    </table>

    <table width="100%"  border="0" align="center">

      <tr class="tab_usuarios" >

        <td width="10%">Apagar/Reenviar</td>

        <td width="12%">Data</td>

        <td width="25%">E-mail</td>

        <td width="12%">Nº RAR</td>

        <td>Mensagem</td>

      </tr>

<? 

	$Stmt = mysql_query("SELECT * FROM rar_logemail ORDER BY LOG_DATA");



	while($Rs = mysql_fetch_assoc($Stmt)) { 

	   $conv_d=convdata($Rs["LOG_DATA"]);

	?>

      <tr bordercolor="#00CCFF" class="tab_usuarios_info" >

        <td >        

          <div align="center">

    	   <input type="checkbox" name="IDS" value="<?=$Rs["LOG_IDO"]?>"><a href="email.php?Id=<?=$Rs["LOG_LANCA_NUMRAR"]?>&destino=R&IDS=<?=$Rs["LOG_CONT_IDO"]?>&MENSAGEM=<?=$Rs["LOG_MENSAGEM"]?>" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image351','','imagens/enviar2.jpg',1)"><img src="imagens/enviar.jpg" alt="Reenviar e-mail" name="Image351" width="52" height="22" border="0" id="Image351"></a>          </div></td>

        <td><? echo $conv_d;?></td>

        <td><?=$Rs["LOG_CONT_IDO"]?></td>

        <td><?=$Rs["LOG_LANCA_NUMRAR"]?></td>

		<td><?=$Rs["LOG_MENSAGEM"]?></td>

      </tr>

<? } ?>

    </table>

</Form>	

	<br/ ><br/ >

	</td>

    <td>&nbsp;</td>

  </tr>

  <tr>

    <td height="100%" bgcolor="#333333" class="rodape"><?=$RodapeDesenvolvedor?></td>

    <td bgcolor="#333333">&nbsp;</td>

  </tr>

</table>