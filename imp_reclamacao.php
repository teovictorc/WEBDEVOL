<? include("inc/conn_externa.inc.php");



	$Sql = "SELECT round(item_valor,2) ITEM_VALOR, L.*,".

		   "       concat(substring(item_referencia,1,4),'-',substring(item_referencia,5,4),'-',substring(item_referencia,9,4),'-',substring(item_referencia,13,4)) ITEM_REFERENCIA,".

	       "       ITEM_COLECAO, ITEM_NF, ITEM_PAR, ITEM_QTDE, ITEM_FOTOPROD, ITEM_FOTOSOLA, ".

		   "       ITEM_FOTODEFEITO,F.NOME As FABRICA, ".

		   "       date_format(lanca_dataabertura,'%d/%m/%Y') As DATA, P.PESSOA,P.NOME,P.LOGRADOURO,".

		   "       datediff(lanca_dataabertura,item_data) DIAS, ".

		   "       P.BAIRRO,P.NM_MUNICIPIO,date_format(item_data,'%d/%m/%Y') As ITEM_DATA, P.SG_UF ".

		   " FROM pessoa P, rar_lancamento L, pessoa F, rar_item I ".

		   " WHERE L.LANCA_FABRI_IDO = F.PESSOA ".

		   "       AND L.lanca_pessoa = P.PESSOA ".

		   "       AND I.item_numrar = L.lanca_numrar ".

		   "       AND L.LANCA_NUMRAR = '" .$_GET['Id']. "'";



	$Stmt = mysql_query($Sql);

	if (!$Rs = mysql_fetch_assoc($Stmt))

		die("<script>document.location.href = 'pesq_avaliacoes_pendentes.php';</script>");

	else

		$Tempo = intval($Rs["DIAS"]);

	    $Meses = $Rs["DIAS"]/30;

	    $Dias = ($Meses - intval($Meses)) * 30;

	    $Meses = intval($Meses);

	    $Tempo = $Meses." meses e ".$Dias." dias";?>



<style type="text/css">

<!--

.style1 {font-weight: bold}

-->

</style>



<link href="wfa.css" rel="stylesheet" type="text/css">

<link href="../css/global.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="js/util.js"></script>

<title>WFA Web - Impress&atilde;o de reclama&ccedil;&atilde;o</title>

<script language="JavaScript" type="text/JavaScript">

<!--

function MM_swapImgRestore() { //v3.0

  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;

}

//-->

</script>

<form name="form" method="post" action="">

<input type="hidden" name="ID" value="<?=$_GET['Id']?>">

<input type="hidden" name="DESTINO" value="<?=$_GET['Destino']?>">

<iframe name="teste" id="teste" scrolling="no" frameborder="0" width="0" height="0" src=""></iframe>

</td>

   <td>&nbsp;</td>

  </tr>

  <tr>

   <td >&nbsp;</td>

   <td colspan="9"><table width="100%"  border="0" class="">

     <tr>

       <td height="10" colspan="6" class="tab_cadastro"><strong><?=$NomeSistema?></strong></td>

       </tr>

     <tr>

       <td class="style2">&nbsp;</td>

       <td align="center">&nbsp;</td>

       <td >&nbsp;</td>

       <td class="style2">&nbsp;</td>

       <td>&nbsp;</td>

       <td >&nbsp;</td>

     </tr>

     <tr>

       <td colspan="6" class="tab_titulo"><strong>Dados da reclama&ccedil;&atilde;o </strong></td>

       </tr>

     <tr>

       <td class="style2"><strong>Reclama&ccedil;&atilde;o</strong></td>

       <td class="form" align="center"><?=$Rs['LANCA_NUMRAR']?></td>

       <td >&nbsp;</td>

       <td class="style2"><div align="right"><strong>Tempo venda&nbsp; </strong></div></td>

       <td class="form"><?=$Tempo?></td>

       <td >&nbsp;</td>

     </tr>

     <tr>

       <td width="17%" class="style2"><strong>C&oacute;digo</strong></td>

       <td class="form" align="center"><?=$Rs['PESSOA']?></td>

       <td>&nbsp;</td>

       <td width="11%" class="style2">&nbsp;</td>

       <td colspan="2">&nbsp;</td>

     </tr>

     <tr>

       <td class="style2"><strong>Nome do cliente </strong></td>

       <td colspan="5" class="form"><?=$Rs['NOME']?></td>

       </tr>

     <tr>

       <td class="style2"><strong>Endere&ccedil;o</strong></td>

       <td colspan="2" class="form"><?=$Rs['LOGRADOURO']?></td>

       <td class="style1"><div align="right"><strong>Bairro&nbsp;</strong></div></td>

       <td colspan="2" class="form"><?=$Rs['BAIRRO']?></td>

     </tr>

     <tr>

       <td height="10" class="style2"><strong>Cidade</strong></td>

       <td height="10" colspan="2" class="form"><?=$Rs['NM_MUNICIPIO']?></td>

       <td height="10"><div align="right"><strong class="style1">UF&nbsp;</strong></div></td>

       <td height="10" colspan="2" class="form"><?=$Rs['SG_UF']?></td>

     </tr>

     <tr>

       <td height="10" class="style2"><strong>Solicitante</strong></td>

       <td height="10" colspan="5" class="form"><?=$Rs['LANCA_SOLICITANTE']?></td>

     </tr>

     <tr>

       <td height="10" class="style2"><strong>Fabricante</strong></td>

       <td height="10" colspan="5" class="form"><?=$Rs['FABRICA']?></td>

     </tr>

     <tr>

       <td height="10" class="style2"><strong>Motivo da solicita&ccedil;&atilde;o </strong></td>

       <td height="10" colspan="5" class="form"><?=$Rs['LANCA_MOTIVO']?></td>

     </tr>

	 <tr bgcolor="#FFFFFF" class="">

	   <td colspan="6" style="padding-top:10px;">&nbsp;</td>

	   </tr>

	 <tr bgcolor="#FFFFFF" class="">

       <td colspan="6" class="tab_titulo" style="padding-top:10px;"><strong>Dados do consumidor </strong></td>

       </tr>

	 <tr>

	   <td height="10" class="style2"><strong>Tipo reclama&ccedil;&atilde;o: </strong></td>

	   <td height="10" colspan="2" class="style2"><input name="LANCA_TIPORECLAMACAO" type="radio" value="C" <? if ($Rs['LANCA_TIPORECLAMACAO'] == "C") {?> checked <? } ?> disabled>

Defeito consumidor

  <input name="LANCA_TIPORECLAMACAO" type="radio" value="L" <? if ($Rs['LANCA_TIPORECLAMACAO'] == "L") {?> checked <? } ?> disabled>

Defeito loja </td>

	   <td height="10" class="style2">&nbsp;</td>

	   <td height="10" colspan="2">&nbsp;</td>

	   </tr>

	 <tr>

       <td height="10" class="style2"><strong>Nome: </strong></td>

       <td height="10" colspan="2" class="form"><?=$Rs['LANCA_CLIENTE_NOME']?></td>

       <td height="10" class="style2"><div align="right"><strong>Fone&nbsp;</strong></div></td>

       <td height="10" colspan="2" class="form"><?=$Rs['LANCA_CLIENTE_FONE']?></td>

	 </tr>

     <tr bgcolor="#FFFFFF" class="">

       <td colspan="6" style="padding-top:10;">&nbsp;</td>

     </tr>

     <tr bgcolor="#FFFFFF" class="">

       <td colspan="6" class="tab_titulo" style="padding-top:10;"><strong>Descri&ccedil;&atilde;o do &iacute;tem com problema </strong></td>

       </tr>

     <tr>

       <td height="15" class="style2"><strong>Refer&ecirc;ncia</strong></td>

       <td width="18%" height="15" class="form" align="center"><?=$Rs['ITEM_REFERENCIA']?></td>

       <td width="17%">&nbsp;</td>

       <td height="15" class="style2"><div align="right"><strong>Cole&ccedil;&atilde;o&nbsp;</strong></div></td>

       <td width="12%" height="15" class="form" align="center"><?=$Rs['ITEM_COLECAO']?></td>

       <td width="25%">&nbsp;</td>

     </tr>

     <tr>

       <td height="15" class="style2"><strong>N. NF origem </strong></td>

       <td height="15" class="form" align="center"><?=$Rs['ITEM_NF']?></td>

       <td height="15">&nbsp;</td>

       <td height="15"><div align="right"><strong class="style1">Data NF&nbsp;</strong></div></td>

       <td height="15" class="form" align="center"><?=$Rs['ITEM_DATA']?></td>

       <td height="15">&nbsp;</td>

     </tr>

     <tr>

       <td height="15" class="style2"><strong>N. par reclamado </strong></td>

       <td height="15" class="form"><div align="center"><?=$Rs['ITEM_PAR']?></div></td>

       <td height="15">&nbsp;</td>

       <td height="15" class="style2"><div align="right"><strong>Quantidade&nbsp;</strong></div></td>

       <td height="15" class="form"><div align="right"><?=$Rs['ITEM_QTDE']?></div></td>

       <td height="15">&nbsp;</td>

     </tr>

     <tr>

       <td height="15" class="style2"><strong>Valor unit&aacute;rio </strong></td>

       <td height="15" class="form"><div align="right">R$

             <?=formatCurrency($Rs['ITEM_VALOR'])?>

       </div></td>

       <td height="15">&nbsp;</td>

       <td height="15"><div align="right"><strong class="style1">Valor total&nbsp; </strong></div></td>

       <td height="15" class="style2"><div align="right" class="form">R$ <?=formatCurrency($Rs['ITEM_VALOR']*$Rs['ITEM_QTDE'])?></div>         </td>

       <td height="15" class="style2">&nbsp;</td>

     </tr>

     <tr>

       <td colspan="6" class=""><table width="100%"  border="0">

         <tr>

           <td width="32%"><table width="99%"  border="0">

             <tr class="">

               <td width="33%" class="style2"><strong>Foto do Produto </strong></td>

             </tr>

             <tr>

               <td><div align="left"><img src="fotos/<?=$Rs['ITEM_FOTOPROD']?>" width="180" height="150" border="0" class="imp_normal_total" ></div></td>

               </tr>

           </table></td>

           <td width="35%"><table width="99%"  border="0">

             <tr class="">

               <td width="33%" class="style2"><strong>Foto Sola </strong></td>

             </tr>

             <tr>

               <td><div align="left"><img src="fotos/<?=$Rs['ITEM_FOTOSOLA']?>" width="180" height="150" border="0" class="imp_normal_total" ></div></td>

             </tr>

           </table></td>

           <td width="33%"><table width="99%"  border="0">

             <tr class="">

               <td class="style2"><strong>Foto do Defeito </strong></td>

               </tr>

             <tr>

               <td><div align="left"><img src="fotos/<?=$Rs['ITEM_FOTODEFEITO']?>" width="180" height="150" border="0" class="imp_normal_total"></div></td>

             </tr>

           </table></td>

         </tr>



       </table>         </td>

       </tr>

     <tr>

<?

		$Sql =	"SELECT AVALI_NUMRAR,AVALI_AREZ_DEFEIG_IDO,AVALI_AREZ_DEFEIS_IDO,AVALI_AREZ_DATA,AVALI_AREZ_ENCERRADO,AVALI_AREZ_DETALHE,".

		" AVALI_AREZ_USUAR_IDO, LANCA_STATUS, ".

		" AVALI_SITUACAO,AVALI_AUTOR_NUMAUT, date_format(AVALI_AREZ_DATA,'%d/%m/%Y') As ADATA, ".

		" USUAR_NOME ".

		" FROM rar_avaliacao, rar_usuario, rar_lancamento ".

		" WHERE AVALI_NUMRAR = '" .$_GET['Id']. "' ".

		"       AND LANCA_NUMRAR = AVALI_NUMRAR ".

		"       AND (USUAR_IDO = AVALI_AREZ_USUAR_IDO)".

		"       AND AVALI_SITUACAO IS NOT NULL ";



		$Stmt = mysql_query($Sql);

		$VAR = false;

		if ($Rs = mysql_fetch_assoc($Stmt)) {

			$VAR = true;

			$AVALI_AREZ_DEFEIG_IDO = $Rs["AVALI_AREZ_DEFEIG_IDO"];

			$AVALI_AREZ_DEFEIS_IDO = $Rs["AVALI_AREZ_DEFEIS_IDO"];

//			$AVALI_AREZ_DATA = ociresult($Stmt,"ADATA");

			$AVALI_AREZ_DATA = (trim($Rs["ADATA"])) ? $Rs["ADATA"] : date('d/m/Y');

			$AVALI_AREZ_ENCERRADO = $Rs["AVALI_AREZ_ENCERRADO"];

			$AVALI_AREZ_DETALHE = $Rs["AVALI_AREZ_DETALHE"];

			if ($AVALI_AREZ_DETALHE ==""){

				$AVALI_AREZ_DETALHE = "-";

			}



			//$AVALI_STAR_DEFEI_IDO = $Rs["AVALI_STAR_DEFEI_IDO"];

			//$AVALI_STAR_DATA = (trim($Rs["SDATA"])) ? $Rs["SDATA"] : date('d/m/Y');

			//$AVALI_STAR_ENCERRADO = $Rs["AVALI_STAR_ENCERRADO"];

			//$AVALI_STAR_DETALHE = $Rs["AVALI_STAR_DETALHE"];

			$USUARIO = $Rs["USUAR_NOME"];



			$AVALI_SITUACAO = $Rs["AVALI_SITUACAO"];

			$LANCA_STATUS = $Rs["LANCA_STATUS"];

			$USUARIO = (trim($USUARIO)) ? $USUARIO : $_SESSION['sNome'];

		}

?>

       <td colspan="6" class="style2"><table width="100%"  border="0">

         <tr class="">

           <td colspan="5" style="margin-top:10px;">&nbsp;</td>

         </tr>

         <tr class="">

<?	if ($VAR == true) { ?>

           <td colspan="5" class="tab_titulo" style="margin-top:10px;"><strong>Avalia&ccedil;&atilde;o t&eacute;cnica</strong></td>

         </tr>

         <tr >

           <td width="19%" class="style2"><strong>Defeito - grupo </strong></td>

           <td colspan="4" class="form">

		   <? $Stmtg = mysql_query("SELECT DEFEIG_DESCRICAO FROM rar_defeito_grupo WHERE DEFEIG_IDO = ". $AVALI_AREZ_DEFEIG_IDO); ?>

		   <? if($Rsg = mysql_fetch_assoc($Stmtg)) {

		         echo $Rsg["DEFEIG_DESCRICAO"];

		   	  }

		   ?>		   </td>

         </tr>

		   <tr>

		     <td class="style2"><strong>Defeito - subgrupo</strong></td><td colspan="4" class="form">

		   <? $Stmtsg = mysql_query("SELECT DEFEIS_DESCRICAO FROM rar_defeito_subgrupo WHERE DEFEIS_IDO = ". $AVALI_AREZ_DEFEIS_IDO); ?>

		   <? if($Rsg = mysql_fetch_assoc($Stmtsg)) {

		         echo $Rsg["DEFEIS_DESCRICAO"];

		   	  }

		   ?>

		   </td>

           </tr>

         <tr >

           <td class="style2"><strong>Detalhamento</strong></td>

           <td colspan="4" class="form"><?=$AVALI_AREZ_DETALHE?></td>

         </tr>

         <tr >

           <td class="style2"><strong>Data avalia&ccedil;&atilde;o </strong></td>

           <td width="10%" align="center" class="form"><?=$AVALI_AREZ_DATA?></td>

           <td width="19%" class="style2"><div align="right"><strong>Avalia&ccedil;&atilde;o encerrada:</strong></div></td>

           <td width="9%" class="form" align="center"><?=(($AVALI_AREZ_ENCERRADO == "S") ? "Sim" : "Não")?></td>

           <td width="32%">&nbsp;</td>

         </tr>

         <tr >

           <td class="style2"><strong>Respons&aacute;vel</strong></td>

           <td colspan="4" class="form"><?=$USUARIO?></td>

         </tr>



         <tr class="">

           <td colspan="5" style="margin-top:10px;">&nbsp;</td>

         </tr>

         <tr class="">

           <td colspan="5" class="tab_titulo" style="margin-top:10px;"><strong>Situa&ccedil;&atilde;o da reclama&ccedil;&atilde;o </strong></td>

         </tr>

         <tr >

           <td colspan="5" class="style2"><input name="AVALI_SITUACAO" type="radio" value="P" <?=(($AVALI_SITUACAO == "P") ? "checked" : "")?> disabled>

    Procedente

      <input name="AVALI_SITUACAO" type="radio" value="I"  <?=(($AVALI_SITUACAO == "I") ? "checked" : "")?> disabled>

    Improcedente

    <input name="AVALI_SITUACAO" type="radio" value="E" <?=(($AVALI_SITUACAO == "E") ? "checked" : "")?> disabled>

    Enviar para an&aacute;lise </td>

         </tr>

         <tr >

           <td class="style2"><strong>Status da reclama&ccedil;&atilde;o </strong></td>

           <td colspan="4" class="style2">             <select name="LANCA_STATUS" class="form" onChange="updateAvaliacao()" disabled>

                 <option value="">...Selecione</option>

			     <option value="1"<?=(($LANCA_STATUS == "1") ? " selected" : "")?>>Em andamento</option>

                 <option value="3"<?=(($LANCA_STATUS == "3") ? " selected" : "")?>>Encerrada</option>

             </select></td>

<? }else{ ?>

		<Td width="11%"><div  align="center"><strong>Avaliação não realizada !</strong></div></Td>

<? } ?>

         </tr>

       </table></td>

       </tr>

     <tr>

       <td colspan="6"> <div align="center"><a href="javascript: window.print();"><img src="imagens/imprimir.jpg" alt="Clique aqui para fechar este relat&oacute;rio" width="52" height="22" border="0" ></a><a href="javascript: window.close();" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image361','','imagens/fechar2.jpg',1)">&nbsp;</a><a href="javascript: window.close();"><img src="imagens/fechar.jpg" alt="Clique aqui para fechar este relat&oacute;rio" width="78" height="20" border="0" ></a></div></td>

       </tr>

   </table>



<script language="javascript" type="text/javascript">

<!--



function tabControl() {

	var imagesTab = new Array();

	imagesTab[0] = new Image();

	imagesTab[0].src = "imagens/bt_mais.jpg";

	imagesTab[1] = new Image();

	imagesTab[1].src = "imagens/bt_menos.jpg";



	document.getElementById("abaStar").style.display = (document.getElementById("abaStar").style.display == "") ? "none" : "";

	document.images['imgButtonTag'].src = imagesTab[((document.getElementById("abaStar").style.display == "") ? 1 : 0)].src;

}



function updateDateNow(objCheck,objDate) {

	if (objCheck.checked) {

		var dateNow = new Date();

		document.form.elements[objDate].value = ((dateNow.getDate() < 10) ? "0" : "") + dateNow.getDate() + "/" + ((dateNow.getMonth() < 10) ? "0" : "") + dateNow.getMonth() + "/" + dateNow.getFullYear();

		document.form.elements[objDate].disabled = true;

	}else{

		document.form.elements[objDate].disabled = false;

		document.form.elements[objDate].value = "";

	}

}

function updateAvaliacao() {

	document.form.AVALI_AREZ_ENCERRADO.checked = (document.form.LANCA_STATUS.value == "3") ? true : false;

	updateDateNow(document.form.AVALI_AREZ_ENCERRADO,'AVALI_AREZ_DATA');

}



function atualiza(subgrupo) {

	parent.teste.document.location.href = 'monta_subgrupo.php?subgrupo=' + subgrupo;

}





//-->

</script>

</form>