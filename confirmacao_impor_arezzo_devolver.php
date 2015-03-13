<? include("inc/headerI.inc.php"); 

	verifyAcess("FORN_CREDITOPEND","S");

	if (trim($_POST['NF'])) {

		$NFL = $_POST['NFL'] . "|" .$_POST['NF']. "|";

		$ID = $_POST['ID'];

	}else

		$ID = $_GET['Id'];



	$Exibe = $_GET['Exibe'];

	if (trim($ID)) {

			$Sql = "SELECT ".

						   " ROUND(PRENF_OPER_IDO,0) AS PRENF_OPER_IDO, ".

						   " PRENF_OBSTRANSPORTADORA,".

						   " PRENF_NUMPRENF,".

						   " PRENF_NUMNFDEVOLUCAO,".

						   " PRENF_SERIE,".

						   " PRENF_CFOP,".

						   " CONCAT(ROUND(PRENF_ICMS * 100,0),'%') AS ICMS,".

						   " ROUND(PRENF_QTDEVOLUME,0) PRENF_QTDEVOLUME ,".

			               " date_format(PRENF_DATA_INFNFDEVOLUCACAO,'%d/%m/%Y') DATANF, ".

						   " PRENF_OBSTRANSPORTADORA, ".

					       " PD.NOME NOMECLIENTE, ".

						   " PD.PESSOA CLIENTE, ".

						   " PRENF_CFOP, ".

						   " P.NOME, ".

						   " P.LOGRADOURO RUA,".

						   " P.BAIRRO, ".

						   " P.CEP, ".

						   " null SUFRAMA, ". 

					       "(SELECT round(SUM(PRENFI_QUANTIDADE * PRENFI_VALORUNITARIO),2) VALORTOTAL FROM rar_prenf_item WHERE PRENFI_NUMPRENF = PRENF_NUMPRENF GROUP BY PRENF_PESSOA_EMITENTE) VALORTOTAL, ".

					       "(SELECT round((SUM(PRENFI_QUANTIDADE * PRENFI_VALORUNITARIO) * PRENF_ICMS),2) VALORICMS FROM rar_prenf_item WHERE PRENFI_NUMPRENF = PRENF_NUMPRENF GROUP BY PRENF_PESSOA_EMITENTE) VALORICMS, ".

					       " P.NM_MUNICIPIO CIDADE, ".

						   " P.SG_UF UF, PRENF_MOTIVODEVOLUCAO ".

					  " FROM rar_prenf, pessoa P, pessoa PD ".

					  "WHERE PRENF_PESSOA_EMITENTE = P.PESSOA ".

					         " AND PD.PESSOA = PRENF_PESSOA_DESTINATARIO ".

							 " AND PRENF_NUMPRENF = '" .$ID. "'";

		//die($Sql);

		$Stmt = mysql_query($Sql);

		$Rs = mysql_fetch_assoc($Stmt);

		if (substr($Rs["PRENF_CFOP"],0,1) == "5") {

			$Cfop = "1".substr($Rs["PRENF_CFOP"],1,4);

		}

		

		if (substr($Rs["PRENF_CFOP"],0,1) == "6") {

			$Cfop = "2".substr($Rs["PRENF_CFOP"],1,4);

		}

	}

?><style type="text/css">

<!--

.style1 {font-weight: bold}

-->

</style>

<link href="wfa.css" rel="stylesheet" type="text/css">

<form name="form" method="POST" action="#">

<input type="hidden" name="ID" value="<?=$ID?>">

<table width="100%"  border="0" align="center">

<table width="100%"  border="0" align="center">

     <tr>

       <td width="49%" class="tab_titulo" style="padding-top:15px;"><span class=""><h4>Devolu&ccedil;&atilde;o de NF do cliente</h4></span></td>

     </tr>

  </table></td>

   <td></td>

  </tr>

  <tr>

   <td >&nbsp;</td>

   <td colspan="9">

     <table width="100%"  border="0" class="tab_inclusao">

       <tr>

         <td width="20%" class="style2"><strong>C&oacute;digo</strong></td>

         <td><input name="textfield" type="text" class="form" value="<?=$Rs["CLIENTE"]?>" size="6" maxlength="6" readonly></td>

         <td class="style2"><div align="right"><strong>N&ordm; Pr&eacute;-Nota</strong></div></td>

         <td width="32%"><input name="textfield3" type="text" class="form" value="<?=$Rs["PRENF_NUMPRENF"]?>" size="10" maxlength="10" readonly>

          <input name="Destino" type="hidden" id="Destino" value="<?=$_GET["Destino"]?>">          </td>

         <td width="5%">&nbsp;</td>
       </tr>

       <tr>

         <td class="style2"><strong>Nome Cliente</strong></td>

         <td colspan="4"><input name="textfield2" type="text" class="form" value="<?=$Rs["NOMECLIENTE"]?>" size="50" maxlength="50" readonly></td>
       </tr>

       <tr class="">

         <td height="25" colspan="5" class="tab_titulo" style="padding-top:15px;"><h4>Dados da NF de devolu&ccedil;&atilde;o</h4></td>
        </tr>

       <tr>

         <td class="style2"><strong>N&ordm; NF devolu&ccedil;&atilde;o</strong></td>

         <td><input name="PRENF_NUMNFDEVOLUCAO" type="text" class="form" id="PRENF_NUMNFDEVOLUCAO" value="<?=$Rs["PRENF_NUMNFDEVOLUCAO"]?>" readonly size="20" maxlength="5"></td>

         <td class="style2"><div align="right"><strong>N&ordm; s&eacute;rie:

            

          </strong></div></td>

         <td colspan="2" class="style1"><div align="left"><strong>
           <input name="PRENF_SERIE" type="text" class="form" id="PRENF_SERIE2" value="<?=((trim($Rs["PRENF_SERIE"])) ? $Rs["PRENF_SERIE"] : "U")?>" size="11" maxlength="3" readonly="readonly" />
         </strong></div></td>
       </tr>
       <tr>
         <td class="style2"><strong>Data NF devolu&ccedil;&atilde;o:</strong></td>
         <td><strong>
           <input name="PRENF_DATA_INFNFDEVOLUCAO" type="text" class="form" id="PRENF_DATA_INFNFDEVOLUCAO2" onkeypress="return JSUtilApenasNumero(event);" onkeyup="JSUtilMascara(this,event,'__/__/____');" readonly="readonly" value="<?=$Rs["DATANF"]?>" size="11" maxlength="11" />
         </strong></td>
         <td class="style2">&nbsp;</td>
         <td colspan="2" class="style1">&nbsp;</td>
       </tr>

       <tr>

         <td class="style2"><strong>Destinat&aacute;rio</strong></td>

         <td colspan="4"><input name="ADFDF" type="text" class="form" id="ADFDF" value="<?=$Rs["NOME"]?>" size="80" maxlength="80" readonly></td>
       </tr>

       <tr>

         <td class="style2"><strong>Endere&ccedil;o</strong></td>

         <td><input name="textfield23" type="text" class="form" value="<?=$Rs["RUA"]?>" size="50" readonly></td>

         <td class="style2"><div align="right"><strong>Bairro</strong></div></td>

         <td colspan="2"><input name="textfield232" type="text" class="form" value="<?=$Rs["BAIRRO"]?>" size="40" readonly maxlength="40"></td>
       </tr>

       <tr>

         <td class="style2"><strong>Cidade</strong></td>

         <td width="22%"><input name="textfield2322" type="text" class="form" value="<?=$Rs["CIDADE"]?>" size="20" readonly maxlength="20"></td>

         <td width="21%" class="style2"><div align="right"><strong>UF</strong></div></td>

         <td colspan="2"><input name="textfield23232" type="text" class="form" value="<?=$Rs["UF"]?>" size="4" readonly maxlength="2">         </td>
       </tr>

       <tr>

         <td class="style2"><strong>CFOP Entrada</strong></td>

         <td class="style1"><input name="textfield2323222" type="text" class="form" value="<?=$Cfop?>" readonly size="20" maxlength="20">         </td>

         <td class="style2"><div align="right"><strong>Qtde volumes</strong></div></td>

         <td colspan="2" class="style1"><input name="PRENF_QTDEVOLUME" type="text" class="form" id="PRENF_QTDEVOLUME" readonly onKeyPress="return JSUtilApenasNumero(event);" value="<?=$Rs["PRENF_QTDEVOLUME"]?>" size="3" maxlength="3">         </td>
       </tr>

       <tr>

         <td valign="top" class="style2"><strong>Opera&ccedil;&atilde;o</strong></td>

         <td colspan="4" class="style1">

		 		 <? $StmtC = mysql_query("SELECT CD_OPER,DS_OPER FROM operacao WHERE CD_OPER = ".$Rs["PRENF_OPER_IDO"]);

			   $RsC = mysql_fetch_assoc($StmtC);

			   {$Operacao = $Rs["PRENF_OPER_IDO"].' - '.$RsC["DS_OPER"];}?>

          <input name="textfield23232222" type="text" class="form" value="<?=$Operacao?>" readonly size="60" maxlength="60">          <div align="right" class="style2"></div></td>
       </tr>

       <tr class="">

         <td height="30" colspan="5" class="tab_titulo" style="padding-top:15px;"><div align="left"><h4>Motivo da devolu&ccedil;&atilde;o da nota fiscal</h4></div></td>
       </tr>

       <tr>

         <td colspan="5"><div align="center"><span>

             <textarea name="PRENF_MOTIVODEVOLUCAO" cols="100%" rows="5" class="campo_texto" id="PRENF_MOTIVODEVOLUCAO"><?=$Rs["PRENF_MOTIVODEVOLUCAO"]?></textarea>

         </span></div></td>
       </tr>

       <tr>

         <td colspan="5"><table width="100%"  border="0" align="center">

         </table>

          <p align="center"><a href="javascript:verificaForm(document.form);" ><img src="../img/bts/gravar.jpg" alt="Gravar dados" name="Image351" border="0" id="Image351"></a>

		  <a href="pesq_impor_arezzo.php"><img src="../img/bts/cancelar.jpg" alt="Cancelar grava&ccedil;&atilde;o dos dados" name="Image361" border="0" id="Image361"></a></p></td>
       </tr>
     </table>

<input type="hidden" name="NFF" value="<?=$NFF?>">

<input type="hidden" name="NFL" value="<?=$NFL?>">

</form>



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

function verificaForm(formObj) {

	if (formObj.PRENF_MOTIVODEVOLUCAO.value == "") {

		alert("Informe o motivo da devolução!");

		formObj.PRENF_MOTIVODEVOLUCAO.focus();

		return;

	}



	formObj.action = "confirmacao_impor_arezzo_devolverok.php";		

	document.form.submit();

}

//-->

</script>

