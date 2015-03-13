<? include("inc/headerI.inc.php"); 
verifyAcess("ARZ_GERAIMPORTACAO","S");
?>
<form name="form" method="get" action="pesq_nf_emitir.php">
<table width="100%"  border="0" align="center">
     <tr>
       <td width="49%" class="tab_titulo" style="padding-top:15px;"><h4>Pend&ecirc;ncias de NF a gerar importa&ccedil;&atilde;o</h4></td>
     </tr>
   </table></td>
   <td></td>
  </tr>
  <tr>
   <td >&nbsp;</td>
   <td colspan="9">
    <table width="100%"  border="0" class="tab_inclusao">
      <tr>
        <td width="47%" class="style2"><div align="right"><strong>Per&iacute;odo de pesquisa</strong></div></td>
        <td width="53%" height="50" class=""> de 
            <input name="DT_INICIAL" type="text" class="form" onKeyPress="return JSUtilApenasNumero(event);" onKeyUp="JSUtilMascara(this,event,'__/__/____');" value="<?=$_GET['DT_INICIAL']?>" size="9" maxlength="10"> 
          a 
          <input name="DT_FINAL" type="text" class="form" onKeyPress="return JSUtilApenasNumero(event);" onKeyUp="JSUtilMascara(this,event,'__/__/____');" value="<?=$_GET['DT_FINAL']?>" size="9" maxlength="10">
        </strong>          <a href="javascript:FilterSearch();" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image34','','imagens/pesquisar2.jpg',1)"><img src="imagens/pesquisar.jpg" name="Image34" width="78" height="20" border="0" align="middle"></a> </td>
        </tr>
		
      <tr>
        <td colspan="2"> <div align="center">
          <table width="100%"  border="0" align="center">
            <tr class="tab_usuarios" >
              <td width="10%" ><div align="center">N&ordm; Pr&eacute;-Nota</div></td>
              <td width="10%" height="25" ><div align="center">N&ordm; NF/S&eacute;rie</div></td>
              <td width="10%" ><div align="center">Data Autoriza&ccedil;&atilde;o</div></td>
              <td width="35%" >Cliente</td>
              <td width="10%" ><div align="center">CFOP</div></td>
              <td width="10%" ><div align="right">Qtde Pares </div></td>
              <td width="15%" ><div align="right">Valor total </div></td>
            </tr>
<? 
	$Sql = "SELECT CGCCPF CNPJ, PRENF_PESSOA_DESTINATARIO, ".
	               " PRENF_NUMPRENF, ".
				   " PRENF_AUTOR_NUMAUT, ".
			       " PRENF_NUMNFDEVOLUCAO, ".
				   " PRENF_SERIE, ".
				   " PRENF_SERIE, ".
				   " PRENF_CFOP, ".
			       " date_format(AUTOR_DATAAUTORIZACAO,'%d/%m/%Y') DATANF, ".
			       " round(PRENF_QTDEVOLUME,0) PRENF_QTDEVOLUME, ".
				   " NOME NOMECLIENTE, ".
			       "(SELECT round(SUM(PRENFI_QUANTIDADE),0) QTDE FROM rar_prenf_item WHERE PRENFI_NUMPRENF = PRENF_NUMPRENF GROUP BY PRENF_PESSOA_EMITENTE) QTDE, ".
			       "(SELECT round(SUM(PRENFI_QUANTIDADE * PRENFI_VALORUNITARIO),2) VALOR FROM rar_prenf_item WHERE PRENFI_NUMPRENF = PRENF_NUMPRENF GROUP BY PRENF_PESSOA_EMITENTE) VALOR ".
			" FROM rar_prenf, pessoa, rar_autorizacao, rar_usuarioxcliente ".
			"WHERE PESSOA = PRENF_PESSOA_DESTINATARIO ".
			       " AND PRENF_AUTOR_NUMAUT = AUTOR_NUMAUT ".
			       " AND PRENF_DATA_RECEBTO_AREZZO IS NOT NULL ".
				   " AND PRENF_DATA_IMPORT_AREZZO IS NULL ".
			       " AND USUCLI_PESSOA = PRENF_PESSOA_DESTINATARIO ".
				   " AND (PRENF_CATEGORIA = '1' or (PRENF_CATEGORIA = 2 AND PRENF_PESSOA_EMITENTE IN (18800, 19000)))".
				   " AND USUCLI_USUAR_IDO = '" .$_SESSION['sId']. "'";
			
	if (trim($_GET['DT_INICIAL']) && trim($_GET['DT_FINAL']))
		$Sql.= " AND (AUTOR_DATAAUTORIZACAO BETWEEN date_format('" .$_GET['DT_INICIAL']. " 00:00','%d/%m/%Y %h:%i') ".
			   " AND date_format('" .$_GET['DT_FINAL']. " 23:59','%d/%m/%Y %h:%i'))";
	$Sql.= " ORDER BY PRENF_NUMNFDEVOLUCAO, AUTOR_NUMAUT";
	
	$_pagi_sql = $Sql;
	include_once("inc/paginator.inc.php");
	//$Stmt = mysql_query($_pagi_sql);

	while($Rs = mysql_fetch_assoc($Stmt)) { ?>
            <tr bordercolor="#00CCFF" class="tab_usuarios_info" >
              <td >
                <div align="center"><a href="javascript: Exibir(<?=$Rs["PRENF_NUMPRENF"]?>);"><?=$Rs["PRENF_NUMPRENF"]?></a></div></td>
              <td><div align="center"><?=$Rs["PRENF_NUMNFDEVOLUCAO"]?>
/ 
  <?=$Rs["PRENF_SERIE"]?>               
  <div align="center"></div>
                <div align="center"></div></td>
              <td><div align="center"><?=$Rs["DATANF"]?></div></td>
              <td><?=$Rs["PRENF_PESSOA_DESTINATARIO"]?> - <?=$Rs["NOMECLIENTE"]?> (<?=FormataCnpj($Rs["CNPJ"])?>)</td>
              <td><div align="center"><?=$Rs["PRENF_CFOP"]?></td>
              <td><div align="right"><?=$Rs["QTDE"]?></td>
              <td><div align="right">R$<?=formatCurrency($Rs["VALOR"])?></div></td>
            </tr>
<? } ?>
          </table>
          </div></td>
        </tr>
    </table>
	</form>

<br/ >
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
	<td><p>P&aacute;ginas:&nbsp;<?= $_pagi_navegacion ?></p></td>
  </tr>
</table>

<table width="100%" cellpadding="0" cellspacing="0" border="0" align="center">
	<td>
	<br/ ><br/ >
	</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="100%" bgcolor="#333333" class="rodape"><?=$RodapeDesenvolvedor?></td>
    <td bgcolor="#333333" >&nbsp;</td>
  </tr>
</table>


<script language="javascript" type="text/javascript">
<!--
function Exibir(Id){
	if(confirm("Deseja exibir os ítens da nota automaticamente ?")){
		document.location.href = "confirmacao_impor_arezzo.php?Exibe=S&Id=" + Id;
	}else{
		document.location.href = "confirmacao_impor_arezzo.php?Exibe=N&Id=" + Id;
	}
}

function FilterSearch() {
	if (document.form.DT_INICIAL.value == "" || document.form.DT_FINAL.value == "") {
		alert("Preencha os campos data final e inicial");
		return;
	}
	if (!JSUtilValidaData(document.form.DT_INICIAL.value,false) || !JSUtilValidaData(document.form.DT_FINAL.value,false)) {
		alert("As datas informadas devem ser datas validas !");
		return;
	}
	document.form.submit();
}
//-->
</script>