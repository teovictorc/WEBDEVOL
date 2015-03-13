<? include("inc/headerI.inc.php"); 

verifyAcess("FORN_CREDITOPEND","S");

?>

<form name="form" method="get" action="pesq_forne_credito.php">

<tr>

    <td height="100%" valign="top" class="tab_conteudo">

    <table width="100%" border="0" cellspacing="0" cellpadding="0">

      <tr>

        <td height="32" class="tab_titulo"><h4>Pend&ecirc;ncias de NF a informar cr&eacute;dito ao cliente</h4></td>

      </tr>

      </table>



    <table width="100%"  border="0" class="tab_inclusao">

      <tr>

        <td width="47%" class="style2"><div align="right"><strong>Per&iacute;odo de pesquisa</strong></div></td>

        <td width="53%" height="50" class="style1"> de 

            <input name="DT_INICIAL" type="text" class="form" onKeyPress="return JSUtilApenasNumero(event);" onKeyUp="JSUtilMascara(this,event,'__/__/____');" value="<?=$_GET['DT_INICIAL']?>" size="9" maxlength="10"> 

          a 

          <input name="DT_FINAL" type="text" class="form" onKeyPress="return JSUtilApenasNumero(event);" onKeyUp="JSUtilMascara(this,event,'__/__/____');" value="<?=$_GET['DT_FINAL']?>" size="9" maxlength="10">

        </strong>          <a href="javascript:FilterSearch();"><img src="imagens/pesquisar.jpg" name="Image34" width="59" height="22" border="0" align="middle"></a> </td>

        </tr>

		

      <tr>

        <td colspan="2"> <div align="center">

          <table width="100%"  border="0" align="center">

            <tr class="tab_usuarios" >

              <td width="9%" ><div align="center">N&ordm; Pr&eacute;-Nota</div></td>

              <td width="9%" height="25" ><div align="center">N&ordm; NF/S&eacute;rie</div></td>

              <td width="10%" ><div align="center">Data Autoriza&ccedil;&atilde;o</div></td>

              <td width="29%" >Cliente</td>

              <td width="16%" >CNPJ</td>

              <td width="9%" ><div align="center">CFOP</div></td>

              <td width="7%" ><div align="right">Qtde Pares </div></td>

              <td width="11%" ><div align="right">Valor total </div></td>

            </tr>

<? 

	$Sql = "SELECT PRENF_PESSOA_DESTINATARIO, ".

	               " PRENF_NUMPRENF, ".

				   " PRENF_AUTOR_NUMAUT, ".

			       " PRENF_NUMNFDEVOLUCAO, ".

				   " PRENF_SERIE, ".

				   " PRENF_SERIE, ".

				   " PRENF_CFOP, ".

			       " date_format(AUTOR_DATAAUTORIZACAO,'%d/%m/%Y') DATANF, ".

			       " round(PRENF_QTDEVOLUME,0) PRENF_QTDEVOLUME, ".

				   " NOME NOMECLIENTE, ".

				   " concat(substr(cgccpf,1,2),'.',substr(cgccpf,3,3),'.',substr(cgccpf,6,3),'/',substr(cgccpf,9,4), '-',substr(cgccpf,13,2)) as CNPJ, ".

			       "(SELECT round(SUM(PRENFI_QUANTIDADE),0) QTDE FROM rar_prenf_item WHERE PRENFI_NUMPRENF = PRENF_NUMPRENF GROUP BY PRENF_PESSOA_EMITENTE) QTDE, ".

			       "(SELECT round(SUM(PRENFI_QUANTIDADE * PRENFI_VALORUNITARIO),2) VALOR FROM rar_prenf_item WHERE PRENFI_NUMPRENF = PRENF_NUMPRENF GROUP BY PRENF_PESSOA_EMITENTE) VALOR ".

			" FROM rar_prenf, pessoa, rar_autorizacao, rar_usuarioxcliente ".

			"WHERE PESSOA = PRENF_PESSOA_DESTINATARIO ".
			       " AND PRENF_AUTOR_NUMAUT = AUTOR_NUMAUT ".
			       " AND PRENF_DATA_RECEBTO_AREZZO IS NOT NULL ".
				   //" AND PRENF_CATEGORIA = '2'".
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
	$Stmt = mysql_query($Sql);



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

              <td><?=$Rs["PRENF_PESSOA_DESTINATARIO"]?> - <?=$Rs["NOMECLIENTE"]?></td>

              <td><?=$Rs["CNPJ"]?></td>

              <td><div align="center"><?=$Rs["PRENF_CFOP"]?></td>

              <td><div align="right"><?=$Rs["QTDE"]?></td>

              <td><div align="right">R$<?=formatCurrency($Rs["VALOR"])?></div></td>

            </tr>

<? } ?>

          </table>

          </div></td>

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

</form>



<script language="javascript" type="text/javascript">

<!--

function Exibir(Id){

	document.location.href = "pesq_forn_inf_credito.php?Exibe=S&Id=" + Id;

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