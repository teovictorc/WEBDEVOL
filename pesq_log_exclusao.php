<? include("inc/headerI.inc.php"); 

verifyAcess("ADMV_CONSLOGEXCLUSAO","S");?>

<Form name="form" action="#">
<tr>
    <td height="100%" valign="top" class="tab_conteudo">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="100%" class="tab_titulo"><h4>Log de exclusão de RAR e Pré-nota</h4></td>
      </tr>
    </table>
	
    <table width="100%"  border="0" align="center">
      <tr class="tab_usuarios" >
        <td width="15%">Data</td>
        <td width="20%">Usu&aacute;rio que deletou </td>
        <td width="20%">Solicitante</td>
        <td width="15%">Nº</td>
        <td width="30%">Motivo</td>
      </tr>
<? 
	$Stmt = mysql_query("SELECT *, date_format(LOG_DATA,'%d/%m/%Y %H:%i') as LOG_DATA FROM rar_log, rar_usuario where log_usuar_ido = usuar_ido ORDER BY LOG_DATA");

	while($Rs = mysql_fetch_assoc($Stmt)) { 
	   	if ($Rs["LOG_TIPO"] == "R"){
	   		$Tipo = "RAR";
		}else{
			$Tipo = "Pré-nota";
		}
	?>
      <tr bordercolor="#00CCFF" class="tab_usuarios_info" >
        <td><?=$Rs["LOG_DATA"]?></td>
        <td><?=$Rs["USUAR_NOME"]?></td>
        <td><?=$Rs["LOG_SOLICITANTE"]?></td>
        <td><?=$Tipo." ".$Rs["LOG_NUMERO"]?></td>
		<td><?=$Rs["LOG_MOTIVO"]?></td>
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