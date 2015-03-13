<? include("inc/headerI.inc.php");

verifyAcess("CLINFEEMITIR","S");





?>

<link href="wfa.css" rel="stylesheet" type="text/css">

<style type="text/css">

<!--

.style4 {font-weight: bold; color: #FFFFFF;}

-->

</style>



<form name="form" method="get" action="pesq_nf_emitir.php">

<tr>

    <td height="100%" valign="top" class="tab_conteudo">

    <table width="100%" border="0" cellspacing="0" cellpadding="0">

      <tr>

        <td height="100%" class="tab_titulo"><h4>Pend&ecirc;ncias de NF a emitir</h4></td>

      </tr>

    </table>

    <table width="100%"  border="0" class="tab_inclusao">

      <tr>

        <td width="47%" class=""><div align="right"><strong>Per&iacute;odo de pesquisa</strong></div></td>

        <td width="53%" height="50" class=""> de

            <input name="DT_INICIAL" type="text" class="form" onKeyPress="return JSUtilApenasNumero(event);" onKeyUp="JSUtilMascara(this,event,'__/__/____');" value="<?=$_GET['DT_INICIAL']?>" size="9" maxlength="10">

          a

          <input name="DT_FINAL" type="text" class="form" onKeyPress="return JSUtilApenasNumero(event);" onKeyUp="JSUtilMascara(this,event,'__/__/____');" value="<?=$_GET['DT_FINAL']?>" size="9" maxlength="10">

        </strong>          <a href="javascript:FilterSearch();" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image34','','imagens/pesquisar2.jpg',1)"><img src="imagens/pesquisar.jpg" name="Image34" width="59" height="22" border="0" align="middle"></a> </td>

        </tr>



      <tr>

        <td colspan="2"> <div align="center">

          <table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0">

            <tr class="tab_usuarios" >

              <td width="8%" ><div align="center">N&ordm; Autor. Coleta </div></td>

              <td width="8%" height="25" ><div align="center">N&ordm; Pr&eacute;-nota</div></td>

              <td width="9%" ><div align="center">Data gera&ccedil;&atilde;o</div></td>

              <td width="33%" >Cliente</td>

              <td width="17%" >CNPJ</td>

              <!--<td width="7%" ><div align="center">Categoria</div></td>-->

              <td width="9%" ><div align="center">Qtde</div></td>

              <td width="9%" ><div align="right">Valor total </div></td>

            </tr>

<?

	$Sql = "SELECT PRENF_PESSOA_DESTINATARIO, ".

	               " PRENF_NUMPRENF, ".

				   " PRENF_AUTOR_NUMAUT, ".

			       " PRENF_NUMNFDEVOLUCAO,".

				   " PRENF_CFOP, ".

				   " PRENF_CATEGORIA, ".

			       " date_format(AUTOR_DATAAUTORIZACAO,'%d/%m/%Y') DATANF, ".

			       " PRENF_QTDEVOLUME, ".

				   " NOME NOMECLIENTE, ".

	               " concat(substr(cgccpf,1,2),'.',substr(cgccpf,3,3),'.',substr(cgccpf,6,3),'/',substr(cgccpf,9,4), '-',substr(cgccpf,13,2)) as CNPJ, ".

			       " (SELECT round(SUM(PRENFI_QUANTIDADE),0) QTDE ".

				   "    FROM rar_prenf_item ".

			       "   WHERE PRENFI_NUMPRENF = PRENF_NUMPRENF ".

				   "GROUP BY PRENF_PESSOA_EMITENTE) QTDE, ".

			       " (SELECT round(SUM(PRENFI_QUANTIDADE * PRENFI_VALORUNITARIO),2) VALOR ".

				   "    FROM rar_prenf_item ".

			       "   WHERE PRENFI_NUMPRENF = PRENF_NUMPRENF ".

				   "GROUP BY PRENF_PESSOA_EMITENTE) VALOR ".

			  " FROM rar_prenf, pessoa, rar_autorizacao, rar_usuarioxcliente ".

			 " WHERE PESSOA = PRENF_PESSOA_DESTINATARIO ".

			 "       AND PRENF_AUTOR_NUMAUT = AUTOR_NUMAUT ".

			 "       AND PRENF_NUMNFDEVOLUCAO IS NULL ".

			 "       AND USUCLI_PESSOA = PRENF_PESSOA_DESTINATARIO ".

			 "       AND PRENF_STATUS IS NULL".

			 "       AND USUCLI_USUAR_IDO = '" .$_SESSION['sId']. "'";



	if ($_SESSION['Menu'] == "3"){

		$Sql.= " AND PRENF_TIPO = 'M'";

	}else{

		$Sql.= " AND PRENF_TIPO = 'F'";

	}

	

	if (trim($_GET['DT_INICIAL']) && trim($_GET['DT_FINAL'])){

		$DataIni = substr($_GET['DT_INICIAL'],6,4)."-".substr($_GET['DT_INICIAL'],3,2)."-".substr($_GET['DT_INICIAL'],0,2);

		$DataFim = substr($_GET['DT_FINAL'],6,4)."-".substr($_GET['DT_FINAL'],3,2)."-".substr($_GET['DT_FINAL'],0,2);



		$Sql.= " AND AUTOR_DATAAUTORIZACAO BETWEEN date_format('" .$DataIni. "','%Y-%m-%d') ".

			   " AND date_format('" .$DataFim. "','%Y-%m-%d')";

	

	}

		//$Sql.= " AND (date_format(AUTOR_DATAAUTORIZACAO,'%Y-%m-%d') BETWEEN date_format('" .strdata2db($_GET['DT_INICIAL']). "','%Y-%m-%d') ".

			   //" AND date_format('" .strdata2db($_GET['DT_FINAL']). "','%Y-%m-%d'))";

	$Sql.= " ORDER BY AUTOR_DATAAUTORIZACAO, AUTOR_NUMAUT, PRENF_NUMPRENF";

	

	//echo($Sql);

	//$Stmt = mysql_query($Sql);

	

	$_pagi_sql = $Sql;

	

	include_once("inc/paginator.inc.php");

	

	$TotalReclamacao = 0;

	$TotalPares = 0;

	while($Rs = mysql_fetch_assoc($_pagi_result)) {

			if ($Rs["PRENF_CATEGORIA"] == "1"){

				$Categoria = "Calçados";

			}else{

				$Categoria = "License";

			}

			$TotalReclamacao = $TotalReclamacao + 1;

		    $TotalPares = $TotalPares + $Rs["QTDE"];

		    ?>

			<tr bordercolor="#00CCFF" class="tab_usuarios_info" >

              <td align="center"><a href="confirmacao_nf_emitir.php?Id=<?=$Rs["PRENF_NUMPRENF"]?>"><?=$Rs["PRENF_AUTOR_NUMAUT"]?></a></td>

              <td align="center"><?=$Rs["PRENF_NUMPRENF"]?></td>

              <td align="center"><?=$Rs["DATANF"]?></td>

              <td><?=$Rs["PRENF_PESSOA_DESTINATARIO"]?> - <?=$Rs["NOMECLIENTE"]?></td>

              <td><?=$Rs["CNPJ"]?></td>

              <!--<td align="center"><?=$Categoria?></td>-->

              <td align="right"><?=$Rs["QTDE"]?></td>

              <td><div align="right">R$<?=formatCurrency($Rs["VALOR"])?></div></td>

            </tr>



<? } ?>

          </table>

          <table width="100%"  border="0" align="center" class="">

            <tr>

              <td width="20%"><div align="center"> </div></td>

              <td width="20%"><div align="right"></div></td>

              <td width="60%"><div align="center" class="">

				<div align="right"><strong class="">Resumo da pesquisa</strong>: Total de pr&eacute;-notas:<?=$TotalReclamacao?>&nbsp;- Total de pares:<?=$TotalPares?>

                  </div>

                </div>

                  <div align="center" class="">

                    <div align="right"></div>

                </div></td>

            </tr>

            <tr>

              <td>&nbsp;</td>

              <td>&nbsp;</td>

              <td>&nbsp;</td>

            </tr>

            <tr>

              <td colspan="3"></td>

              </tr>

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

	<br/ >
	<!--
	<br/ >

	<table width="90%"  border="0" align="center">

		<tr>

		  <td height="50" class="listagem_procedente">

		  	<div align="center" class="style4">Aten&ccedil;&atilde;o!<br>

				As pré notas geradas h&aacute; mais de 30 dias e que n&atilde;o forem emitidas as referidas notas fiscais de devolu&ccedil;&atilde;o, ser&atilde;o encerradas sendo necess&aacute;ria a abertura de uma nova reclama&ccedil;&atilde;o.

			</div>

		</td>

		</tr>

	</table>	
	-->
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

</body>

</html>