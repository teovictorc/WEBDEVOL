<? $Title = "Gerenciamento de etapas";

	include("inc/top_imp.inc.php"); 



	$Sql = " SELECT SERVI_STATUS, SERVI_NUMERO, SERVI_DATAABERTURA AS DATA, SERVI_DATA_ENCERRAMENTO, SERVI_DATA_ENC_RESP, TISER_DESCRICAO, ";

	$Sql.= "        SERVI_DATA_RESPONSAVEL, SERVI_DATA_RESPONSAVEL2, SERVI_TIPPR_IDO, P.NOME, P.PESSOA, TISER_NOME, USUAR_IDO, USUAR_NOME ";

	$Sql.= " FROM PESSOA P, RAR_SERVICO, RAR_TIPOSERVICO, RAR_USUARIO ";

	$Sql.= " WHERE P.PESSOA = SERVI_PESSO_IDO ";

	$Sql.= "       AND SERVI_TISER_IDO = TISER_IDO ";

	$Sql.= "       AND SERVI_USUAR_ANJO  = USUAR_IDO ";

	$SQL.= "       and SERVI_PESSO_IDO in (select usucli_pessoa from rar_usuarioxcliente where usucli_usuar_ido = "  .$_SESSION['sId']. ")";

	$Sql.= "      " .$SqlCriterios;

	$Sql.= " ORDER BY SERVI_NUMERO";

	$Stmt = mysql_query($Sql);

?>

<!-- Objeto de controle de impressão de relatorios -->

<!-- MeadCo ScriptX Control -->







<object id="factory" style="display:none" viewastext

classid="clsid:1663ed61-23eb-11d2-b92f-008048fdd814"

codebase="ScriptX.cab#Version=5,60,0,360">

</object>

<script defer>

//(Header, Footer, Margins & Orientation) nesta versao so funciona

function window.onload() {

  factory.printing.header = "WFAWeb - Relatório de Gerenciamento de Etapas"

  factory.printing.footer = "<?=$Title." - ".$Categoria?>"

  //true=potrait false=landscape

  factory.printing.portrait = false

}

</script>

<script>

function abrirDetalhe(ID){

	abrir_janela_popup('rel_gerenciamento_servico_detalhe.php?ID='+ID,'popup_nf','width=760,height=600,top=0,left=0, scrollbars=yes,status=no,resizable=no,dependent=yes');

}

function abrir_janela_popup(theURL,winName,features) {

	window.open(theURL,winName,features);

}

	

</script>



<table width="100%" border="0" cellpadding="0" cellspacing="1">

  <tr>

    <td width="10%" class="imp_normal_total"><div align="center"><strong>N&ordm; Servi&ccedil;o </strong></div></td>

    <td width="16%" class="imp_normal_total"><div align="left"><strong>Cliente</strong></div></td>

    <td width="17%" class="imp_normal_total"><strong>Servi&ccedil;o</strong></td>

    <td width="12%" class="imp_normal_total"><div align="center"><strong>Abertura</strong></div></td>

    <td width="12%" class="imp_normal_total"><div align="center"><strong>Libera&ccedil;&atilde;o anjo </strong></div></td>

    <td width="12%" class="imp_normal_total"><div align="center"><strong>Conclus&atilde;o Respons&aacute;vel</strong></div></td>

    <td width="12%" class="imp_normal_total"><div align="center"><strong>Conclus&atilde;o Respons&aacute;vel 2 </strong></div></td>

    <td width="12%" class="imp_normal_total"><div align="center"><strong>Conclus&atilde;o anjo </strong></div></td>



  </tr>

<?  



	while($Rs = mysql_fetch_assoc($Stmt)){

		

		

		if ($Cor == "#DBEDF2"){

			$Cor = "#FFFFFF";

		}else{

			$Cor = "#DBEDF2";

		}

		?>

		



		<tr valign="top" bgcolor="<?=$Cor?>">

		<td align="center" bgcolor="<?=$Cor?>" class="imp_normal"><div align="center"><a href="javascript:abrirDetalhe('<?=$Rs["SERVI_NUMERO"]?>');"><?=$Rs["SERVI_NUMERO"]?></div></a></td>

		<td class="imp_normal"><?=$Rs["PESSOA"]?>-<?=$Rs["NOME"]?></td>

		<td class="imp_normal"><?=$Rs["TISER_NOME"]?></td>

		<td width="7%" class="imp_normal"><div align="center">

		  <?=FormataDataHora($Rs["DATA"])?>

		</div></td>

		<td width="7%" class="imp_normal" align="center"><?=FormataDataHora($Rs["SERVI_DATA_ENC_RESP"])?></td>

		<td width="7%" class="imp_normal" align="center"><?=FormataDataHora($Rs["SERVI_DATA_RESPONSAVEL"])?></td>

		<td width="7%" class="imp_normal" align="center"><?=FormataDataHora($Rs["SERVI_DATA_RESPONSAVEL2"])?></td>

		<td width="7%" class="imp_normal" align="center"><?=FormataDataHora($Rs["SERVI_DATA_ENCERRAMENTO"])?></td>

  </tr>

	<? } ?>

</table>



<table width="100%"  border="0">

  <tr>

    <th width="30%" class="imp_normal" scope="col">&nbsp;</th>

    <th width="70%" scope="col">&nbsp;</th>

  </tr>

  <tr>

    <th colspan="2" class="imp_normal" scope="col"><div align="left"></div>      <a href="javascript: window.print();"><img src="imagens/imprimir.jpg" alt="Clique aqui para fechar este relat&oacute;rio" width="52" height="22" border="0" ></a>&nbsp;<a href="javascript: window.close()"><img src="imagens/fechar.jpg" alt="Clique aqui para fechar esta janela" width="52" height="22" border="0" ></a></th>

  </tr>

</table>

<? 	include("inc/bot_imp.inc.php"); ?>