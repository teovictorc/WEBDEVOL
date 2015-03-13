<? $Title = "Créditos pendentes";

	include("inc/top_imp.inc.php"); 
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">

  <tr>
    <td class="imp_normal">
	<table width="100%"  border="0" align="center">
      <tr class="imp_normal" >
        <td width="5%" bgcolor="#f5f5f5" ><div align="center">N&ordm; Pr&eacute;-Nota</div></td>
        <td width="5%" height="25" bgcolor="#f5f5f5" ><div align="center">N&ordm; NF/S&eacute;rie</div></td>
        <td width="10%" bgcolor="#f5f5f5" ><div align="center">Data Autoriza&ccedil;&atilde;o</div></td>
        <td width="25%" bgcolor="#f5f5f5" >Cliente</td>
        <td width="25%" bgcolor="#f5f5f5" >Fornecedor</td>
        <td width="5%" bgcolor="#f5f5f5" ><div align="center">CFOP</div></td>
        <td width="5%" bgcolor="#f5f5f5" ><div align="right">Qtde Pares </div></td>
        <td width="10%" bgcolor="#f5f5f5" ><div align="right">Valor total </div></td>
      </tr>
      <? 

	$Sql = "SELECT PRENF_PESSOA_DESTINATARIO, ".
	               " PRENF_NUMPRENF, ".
				   " PRENF_PESSOA_EMITENTE, ".
				   " PRENF_AUTOR_NUMAUT, ".
			       " PRENF_NUMNFDEVOLUCAO, ".
				   " PRENF_SERIE, ".
				   " PRENF_SERIE, ".
				   " PRENF_CFOP, ".
			       " date_format(AUTOR_DATAAUTORIZACAO,'%d/%m/%Y') DATANF, ".
			       " round(PRENF_QTDEVOLUME,0) PRENF_QTDEVOLUME, ".
				   " P.NOME NOMECLIENTE, ".
				   " concat(substr(P.cgccpf,1,2),'.',substr(P.cgccpf,3,3),'.',substr(P.cgccpf,6,3),'/',substr(P.cgccpf,9,4), '-',substr(P.cgccpf,13,2)) as CNPJ, ".
				   " F.NOME NOMEFORNECEDOR, ".
				   " concat(substr(F.cgccpf,1,2),'.',substr(F.cgccpf,3,3),'.',substr(F.cgccpf,6,3),'/',substr(F.cgccpf,9,4), '-',substr(F.cgccpf,13,2)) as CNPJFORNECEDOR, ".
			       "(SELECT round(SUM(PRENFI_QUANTIDADE),0) QTDE FROM rar_prenf_item WHERE PRENFI_NUMPRENF = PRENF_NUMPRENF GROUP BY PRENF_PESSOA_EMITENTE) QTDE, ".
			       "(SELECT round(SUM(PRENFI_QUANTIDADE * PRENFI_VALORUNITARIO),2) VALOR FROM rar_prenf_item WHERE PRENFI_NUMPRENF = PRENF_NUMPRENF GROUP BY PRENF_PESSOA_EMITENTE) VALOR ".
			" FROM rar_prenf, pessoa P, rar_autorizacao, rar_usuarioxcliente, pessoa F ".
			"WHERE P.PESSOA = PRENF_PESSOA_DESTINATARIO ".
     		       " AND F.PESSOA = PRENF_PESSOA_EMITENTE ".
				   " AND PRENF_AUTOR_NUMAUT = AUTOR_NUMAUT ".
			       " AND PRENF_DATA_RECEBTO_AREZZO IS NOT NULL ".
				   " AND PRENF_DATA_IMPORT_AREZZO IS NULL ".
			       " AND USUCLI_PESSOA = PRENF_PESSOA_DESTINATARIO ".
				   " AND PRENF_PESSOA_EMITENTE NOT IN (18800, 19000)".
				   " AND PRENF_PESSOA_EMITENTE IN (SELECT USUFOR_PESSOA ".
				   "                                 FROM rar_usuarioxfornecedor ".
				   "                                WHERE USUFOR_USUAR_IDO = '" .$_SESSION['sId']. "')".
				   " AND USUCLI_USUAR_IDO = '" .$_SESSION['sId']. "'";
	if (trim($_GET['DT_INICIAL']) && trim($_GET['DT_FINAL'])){
		$DataIni = substr($_GET['DT_INICIAL'],6,4)."-".substr($_GET['DT_INICIAL'],3,2)."-".substr($_GET['DT_INICIAL'],0,2);
		$DataFim = substr($_GET['DT_FINAL'],6,4)."-".substr($_GET['DT_FINAL'],3,2)."-".substr($_GET['DT_FINAL'],0,2);

		$Sql.= " AND AUTOR_DATAAUTORIZACAO BETWEEN date_format('" .$DataIni. "','%Y-%m-%d') ".
			   " AND date_format('" .$DataFim. "','%Y-%m-%d')";		   
	}

	$Sql.= " ORDER BY PRENF_NUMNFDEVOLUCAO, AUTOR_NUMAUT";
	//die($Sql);
	$Stmt = mysql_query($Sql);



	while($Rs = mysql_fetch_assoc($Stmt)) { ?>
      <tr bordercolor="#00CCFF" class="imp_normal" >
        <td ><div align="center"><?=$Rs["PRENF_NUMPRENF"]?></div></td>
        <td><div align="center">
            <?=$Rs["PRENF_NUMNFDEVOLUCAO"]?>
          /
          <?=$Rs["PRENF_SERIE"]?>
          <div align="center"></div>
          <div align="center"></div></td>
        <td><div align="center">
          <?=$Rs["DATANF"]?>
        </div></td>
        <td><?=$Rs["PRENF_PESSOA_DESTINATARIO"]?>
          -
          <?=$Rs["NOMECLIENTE"]?> (<?=$Rs["CNPJ"]?>)</td>
        <td><?=$Rs["PRENF_PESSOA_EMITENTE"]?>
-
  <?=$Rs["NOMEFORNECEDOR"]?></td>
        <td><div align="center">
            <?=$Rs["PRENF_CFOP"]?></td>
        <td><div align="right">
            <?=$Rs["QTDE"]?></td>
        <td><div align="right">R$
              <?=formatCurrency($Rs["VALOR"])?>
        </div></td>
      </tr>
      <? } ?>
    </table></td>
  </tr>
  <tr>

    <td width="87%" class="imp_normal">&nbsp;</td>
  </tr>



  

  <?

  //setlocale(LC_MONETARY, 'pt_BR');

  ?>

  <tr>

    <td class="imp_normal"><div align="center"><a href="javascript: window.print();"><img src="imagens/imprimir.jpg" alt="Clique aqui para fechar este relat&oacute;rio" width="52" height="22" border="0" ></a>&nbsp;<a href="javascript: window.close()"><img src="imagens/fechar.jpg" alt="Clique aqui para fechar esta janela" width="52" height="22" border="0" ></a></div></td>
  </tr>
</table>

<? 	include("inc/bot_imp.inc.php"); ?>

