<? 	include("inc/headerI.inc.php");



	$Sql = "SELECT round(item_valor,2) ITEM_VALOR, L.*, ITEM_REFERENCIA, ".

		   //"       concat(substring(item_referencia,1,4),'-',substring(item_referencia,5,4),'-',substring(item_referencia,9,4),'-',substring(item_referencia,13,4)) ITEM_REFERENCIA,".

	       "       ITEM_COLECAO, ITEM_NF, ITEM_PAR, ITEM_QTDE, ITEM_FOTOPROD, ITEM_FOTOSOLA, ".

		   "       ITEM_FOTODEFEITO,F.NOME As FABRICA, ITEM_NUM33, ITEM_NUM34, ITEM_NUM35, ITEM_NUM36, ITEM_NUM37, ITEM_NUM38, ITEM_NUM39, ITEM_NUM40,".

		   "       date_format(L.lanca_dataabertura,'%d/%m/%Y') As DATA, P.PESSOA,P.NOME,P.LOGRADOURO,".

		   "       datediff(lanca_dataabertura,item_data) DIAS, ".

		   "       DS_RESUMIDA_ITEM DESCRICAO, ".

		   "       P.BAIRRO,P.NM_MUNICIPIO,P.SG_UF, date_format(item_data,'%d/%m/%Y') As ITEM_DATA ".

		   " FROM pessoa P, rar_lancamento L, pessoa F, rar_item I, item_material IM ".

		   " WHERE L.LANCA_FABRI_IDO = F.PESSOA ".

		   "       AND L.lanca_pessoa = P.PESSOA ".

		   "       AND I.item_numrar = L.lanca_numrar ".

		   "       AND I.item_REFERENCIA = IM.cd_item_material".

		   "       AND L.LANCA_NUMRAR = '" .$_GET['Id']. "'";



	$Stmt = mysql_query($Sql);

	if (!$Rs = mysql_fetch_assoc($Stmt))

		die("<script>document.location.href = 'pesq_avaliacoes_pendentes.php';</script>");

	else

		if ($Rs["LANCA_CATEGORIA"] == "1"){

			$Categoria = "sapato.jpg";

			$Descricao = "Calçado";

			$Foto1 =  "Foto do produto";

			$Foto2 =  "Foto da sola";

			$Foto3 =  "Foto do defeito";

		}elseif ($Rs["LANCA_CATEGORIA"] == "2"){

			$Categoria = "bolsa.jpg";

			$Descricao = "Bolsa";

			$Foto1 =  "Foto do produto - frente";

			$Foto2 =  "Foto do produto - verso";

			$Foto3 =  "Foto do defeito";

		}elseif ($Rs["LANCA_CATEGORIA"] == "3"){

			$Categoria = "cinto.jpg";

			$Descricao = "Cinto";

			$Foto1 =  "Foto do produto - frente";

			$Foto2 =  "Foto do produto - verso";

			$Foto3 =  "Foto do defeito";

		}elseif ($Rs["LANCA_CATEGORIA"] == "4"){

			$Categoria = "carteira.jpg";

			$Descricao = "Carteira";

			$Foto1 =  "Foto do produto - frente";

			$Foto2 =  "Foto do produto - verso";

			$Foto3 =  "Foto do defeito";

		}

		$Tempo = intval($Rs["DIAS"]);

	    $Meses = $Rs["DIAS"]/30;

	    $Dias = ($Meses - intval($Meses)) * 30;

	    $Meses = intval($Meses);

		$Rar = $_GET['Id']; 

	    $Tempo = $Meses." meses e ".$Dias." dias";?>



<style type="text/css">

<!--

.style1 {font-weight: bold}

-->

</style>



<link href="wfa.css" rel="stylesheet" type="text/css">
<form name="form" method="post" action="">

<input type="hidden" name="ID" value="<?=$_GET['Id']?>">

<input type="hidden" name="DESTINO" value="<?=$_GET['Destino']?>">

<iframe name="teste" id="teste" scrolling="no" frameborder="0" width="0" height="0" src=""></iframe>

<tr>

    <td height="100%" valign="top" class="tab_conteudo">

    <table width="100%" border="0" cellspacing="0" cellpadding="0">

      <tr>

        <td height="32" class="tab_titulo"><h4>Avalia&ccedil;&atilde;o de reclama&ccedil;&atilde;o</h4></td>

      </tr>

      </table>  



	<table width="100%"  border="0" class="tab_inclusao">

     <tr>

       <td height="10" class=""><strong>Reclama&ccedil;&atilde;o</strong></td>

       <td height="10"><span class="">

         <input name="textfield52243" type="text" disabled class="form"  value="<?=$Rs['LANCA_NUMRAR']?>" size="12" maxlength="11">

       </span></td>

       <td height="10" class=""><strong>Tempo</strong></td>

       <td height="10"><span class="">

         <input name="numrar2" type="text" disabled class="form" id="numrar2"  value="<?=$Tempo?>" size="20" maxlength="20">

       </span></td>
     </tr>

     <tr>

       <td width="17%" height="10" class=""><strong>C&oacute;digo</strong></td>

       <td width="35%" height="10"><span class="">

         <input name="textfield52225" type="text" disabled class="form"  value="<?=$Rs['PESSOA']?>" size="5" maxlength="5">

       </span></td>

       <td width="11%" height="10"><strong>Categoria</strong></td>

       <td height="10" valign="middle" class=""><input name="textfield53" type="text" disabled="disabled" class="form"  value="<?=$Rs["DESCRICAO"]?>" size="50" maxlength="50" /></td>
       </tr>

     <tr>

       <td height="10" class=""><strong>Nome do cliente </strong></td>

       <td height="10" colspan="3" class=""><input name="textfield5" type="text" disabled class="form"  value="<?=$Rs['NOME']?>" size="50" maxlength="50"></td>
       </tr>

     <tr>

       <td height="10" class=""><strong>Endere&ccedil;o</strong></td>

       <td height="10" class=""><input name="textfield52" type="text" disabled class="form"  value="<?=$Rs['LOGRADOURO']?>" size="50" maxlength="50"></td>

       <td height="10" class=""><strong>Bairro</strong></td>

       <td height="10" class=""><input name="textfield5222" type="text" disabled class="form"  value="<?=$Rs['BAIRRO']?>" size="20" maxlength="50"></td>
     </tr>

     <tr>

       <td height="10" class=""><strong>Cidade</strong></td>

       <td height="10" class=""><input name="textfield522" type="text" disabled class="form"  value="<?=$Rs['NM_MUNICIPIO']?>" size="50" maxlength="50"></td>

       <td height="10"><strong class="">UF</strong></td>

       <td height="10" class=""><input name="textfield52222" type="text" disabled class="form"  value="<?=$Rs['SG_UF']?>" size="5" maxlength="5"></td>
     </tr>

     <tr>

       <td height="10" class=""><strong>Solicitante</strong></td>

       <td height="10" colspan="3"><span class="">

         <input name="textfield5224" type="text" disabled class="form"  value="<?=$Rs['LANCA_SOLICITANTE']?>" size="50" maxlength="50">

       </span></td>
     </tr>

     <tr>

       <td height="10" class=""><strong>Fabricante</strong></td>

       <td height="10" colspan="3"><span class="">

         <input name="textfield5223" type="text" disabled class="form"  value="<?=$Rs['FABRICA']?>" size="50" maxlength="50">

       </span></td>
     </tr>

     <tr>

       <td height="10" class=""><strong>Motivo da solicita&ccedil;&atilde;o </strong></td>

       <td height="10" colspan="3"><textarea name="textarea" disabled cols="100%" rows="5" class="style2"><?=$Rs['LANCA_MOTIVO']?></textarea></td>
     </tr>

	 <tr bgcolor="#FFFFFF" class="">

       <td colspan="4" class="tab_titulo"><strong>Dados do consumidor </strong></td>
       </tr>

	 <tr>

       <td height="10" class=""><strong>Nome: </strong></td>

       <td height="10" class=""><input name="CLIENTE_NOME" type="text" class="form" id="CLIENTE_NOME" value="<?=$Rs['LANCA_CLIENTE_NOME']?>" size="50" maxlength="50" disabled></td>

       <td height="10" class=""><strong>Fone: </strong></td>

       <td height="10"><input name="CLIENTE_FONE" type="text" class="form" id="CLIENTE_FONE" value="<?=$Rs['LANCA_CLIENTE_FONE']?>" size="30" maxlength="30" disabled></td>
	 </tr>

	 <tr>

	   <td height="10" class=""><strong>Tipo reclama&ccedil;&atilde;o: </strong></td>

	   <td height="10" class="">

	   <input name="LANCA_TIPORECLAMACAO" type="radio" value="C" <? if ($Rs['LANCA_TIPORECLAMACAO'] == "C") {?> checked <? } ?> disabled> Defeito consumidor

	   <input name="LANCA_TIPORECLAMACAO" type="radio" value="L" <? if ($Rs['LANCA_TIPORECLAMACAO'] == "L") {?> checked <? } ?> disabled> Defeito loja </td>

	   <td height="10" class="">&nbsp;</td>

	   <td height="10">&nbsp;</td>
	   </tr>

     <tr bgcolor="#FFFFFF" class="">

       <td colspan="4" class="tab_titulo"><strong>Descri&ccedil;&atilde;o do &iacute;tem com problema </strong></td>
       </tr>

     <tr>
       <td height="15" class=""><strong>N<sup>o</sup> Bloco de An&aacute;lise </strong></td>

       <td height="15" class=""><span class="">

         <input name="textfield522232" type="text" disabled class="form"  value="<?=$Rs['LANCA_NBLOCO_ANALISE']?>" size="30" maxlength="50">

       </span></td>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
     </tr>
     <tr>

       <td height="15" class=""><strong>Refer&ecirc;ncia</strong></td>

       <td height="15" class=""><span class="">

         <input name="textfield522232" type="text" disabled class="form"  value="<?=$Rs['ITEM_REFERENCIA']?>" size="30" maxlength="50">

       </span></td>

       <td height="15" class=""><strong>Cole&ccedil;&atilde;o</strong></td>

       <td height="15" class=""><span class="">

         <input name="textfield52223" type="text" disabled class="form"  value="<?=$Rs['ITEM_COLECAO']?>" size="30" maxlength="50">

       </span></td>
     </tr>

     <tr>

       <td height="15" class="">Descri&ccedil;&atilde;o do produto</td>

       <td height="15" colspan="3"><span class=""><span class="style1">

         <input name="textfield5222323" type="text" disabled class="form"  value="<?=$Rs['DESCRICAO']?>" size="90" maxlength="90">

       </span></span></td>
     </tr>

     <tr>

       <td height="15" class=""><strong>N. NF origem </strong></td>

       <td height="15"><span class=""><span class="">

         <input name="textfield5222322" type="text" disabled class="form"  value="<?=$Rs['ITEM_NF']?>" size="6" maxlength="6">

       </span></span></td>

       <td height="15"><strong class="">Data NF</strong></td>

       <td height="15"><span class="">

         <input name="textfield52224" type="text" disabled class="form"  value="<?=$Rs['ITEM_DATA']?>" size="20" maxlength="50">

       </span></td>
     </tr>

     <tr>

       <td height="15" class=""><strong>Quantidade</strong></td>

       <td height="15"><span class=""><span class="">

         <input name="ITEM_QTDE" type="text" disabled class="form" id="ITEM_QTDE2"  value="<?=$Rs['ITEM_QTDE']?>" size="6" maxlength="6">

       </span></span></td>

       <td height="15" colspan="2" class="">

	   <?

	   if ($Rs['LANCA_CATEGORIA'] == "1"){

	   ?>

         <table width="100%"  border="0">

           <tr class="">

             <td width="4%">&nbsp;</td>

             <td width="12%"><div align="center">33</div></td>

             <td width="12%"><div align="center">34</div></td>

             <td width="12%"><div align="center">35</div></td>

             <td width="12%"><div align="center">36</div></td>

             <td width="12%"><div align="center">37</div></td>

             <td width="12%"><div align="center">38</div></td>

             <td width="12%"><div align="center">39</div></td>

             <td width="12%"><div align="center">40</div></td>
           </tr>

           <tr class="">

             <td>Qtde</td>

             <td align="center"><input name="ITEM_NUM33" type="text" disabled class="form" id="ITEM_NUM33" value="<?=$Rs['ITEM_NUM33']?>" size="3" maxlength="3" onChange="SomaQtde();"></td>

             <td align="center"><input name="ITEM_NUM34" type="text" disabled class="form" id="ITEM_NUM34" value="<?=$Rs['ITEM_NUM34']?>" size="3" maxlength="3" onChange="SomaQtde();"></td>

             <td align="center"><input name="ITEM_NUM35" type="text" disabled class="form" id="ITEM_NUM35" value="<?=$Rs['ITEM_NUM35']?>" size="3" maxlength="3" onChange="SomaQtde();"></td>

             <td align="center"><input name="ITEM_NUM36" type="text" disabled class="form" id="ITEM_NUM36" value="<?=$Rs['ITEM_NUM36']?>" size="3" maxlength="3" onChange="SomaQtde();"></td>

             <td align="center"><input name="ITEM_NUM37" type="text" disabled class="form" id="ITEM_NUM37" value="<?=$Rs['ITEM_NUM37']?>" size="3" maxlength="3" onChange="SomaQtde();"></td>

             <td align="center"><input name="ITEM_NUM38" type="text" disabled class="form" id="ITEM_NUM38" value="<?=$Rs['ITEM_NUM38']?>" size="3" maxlength="3" onChange="SomaQtde();"></td>

             <td align="center"><input name="ITEM_NUM39" type="text" disabled class="form" id="ITEM_NUM39" value="<?=$Rs['ITEM_NUM39']?>" size="3" maxlength="3" onChange="SomaQtde();"></td>

             <td align="center"><input name="ITEM_NUM40" type="text" disabled class="form" id="ITEM_NUM40" value="<?=$Rs['ITEM_NUM40']?>" size="3" maxlength="3" onChange="SomaQtde();"></td>
           </tr>
         </table>

		 <? } ?>		 </td>
       </tr>

     <tr>

       <td height="15" class=""><strong>Valor unit&aacute;rio </strong></td>

       <td height="15"><span class="">

         <input name="ITEM_VALOR_UNITARIO" type="text" disabled class="form" id="ITEM_VALOR_UNITARIO"  value="R$ <?=$Rs['ITEM_VALOR']?>" size="20" maxlength="20">

       </span></td>

       <td height="15"><strong class="">Valor total </strong></td>

       <td height="15"><span class="">

         <input name="ITEM_VALOR_TOTAL" type="text" disabled class="form" id="ITEM_VALOR_TOTAL" size="20" maxlength="20">

       </span></td>
     </tr>

     <tr>

       <td colspan="4" class="style2"><div align="center">

       </div></td>
       </tr>

     <tr>

       <td colspan="4" class="style2"><table width="100%"  border="0">

         <tr>

           <td width="32%"><table width="99%"  border="0">

             <tr class="">

               <td class=""><strong><?=$Foto1?></strong></td>
             </tr>

             <tr>

               <td><div align="center"><a onclick="abrir_janela_popup('visualizar_foto.php?path=<?=$Rs['ITEM_FOTOPROD']?>','foto','width=780,height=480,top=0,left=0, scrollbars=yes,status=yes,resizable=no,dependent=yes')" href="#" ><img src="fotos/<?=$Rs['ITEM_FOTOPROD']?>" width="180" height="150" border="0" ></a></div></td>
               </tr>

           </table></td>

           <td width="35%"><table width="99%"  border="0">

             <tr class="">

               <td class=""><strong><?=$Foto2?></strong></td>
             </tr>

             <tr>

               <td><div align="center"><a onclick="abrir_janela_popup('visualizar_foto.php?path=<?=$Rs['ITEM_FOTOSOLA']?>','foto','width=780,height=480,top=0,left=0, scrollbars=yes,status=yes,resizable=no,dependent=yes')" href="#" ><img src="fotos/<?=$Rs['ITEM_FOTOSOLA']?>" width="180" height="150" border="0" ></a></div></td>
             </tr>

           </table></td>

           <td width="33%"><table width="99%"  border="0">

             <tr class="">

               <td class=""><strong><?=$Foto3?></strong></td>
               </tr>

             <tr>

               <td><div align="center"><a onclick="abrir_janela_popup('visualizar_foto.php?path=<?=$Rs['ITEM_FOTODEFEITO']?>','foto','width=780,height=480,top=0,left=0, scrollbars=yes,status=yes,resizable=no,dependent=yes')" href="#" ><img src="fotos/<?=$Rs['ITEM_FOTODEFEITO']?>" width="180" height="150" border="0"></a></div></td>
             </tr>

           </table></td>
         </tr>

         <tr class="">

           <td ><div align="center">Clique sobre a foto para ampliar</div></td>

           <td ><div align="center">Clique sobre a foto para ampliar</div></td>

           <td ><div align="center">Clique sobre a foto para ampliar</div></td>
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

       <td colspan="4" class=""><table width="100%"  border="0">

         <tr class="">

<?	if ($VAR == true) { ?>

           <td colspan="4" class=""><strong>Avalia&ccedil;&atilde;o t&eacute;cnica</strong></td>
         </tr>

         <tr class="tab_conteudo">

           <td width="100%" class=""><strong>Defeito encontrado</strong></td>

           <td colspan="3" class="">

		   <? $Stmtg = mysql_query("SELECT DEFEIG_DESCRICAO FROM rar_defeito_grupo WHERE DEFEIG_IDO = ". $AVALI_AREZ_DEFEIG_IDO); ?>

		   <? if($Rsg = mysql_fetch_assoc($Stmtg)) { 

		         echo $Rsg["DEFEIG_DESCRICAO"]; 

		   	  }

		   ?>		   </td></tr>

		   <tr><td>&nbsp;</td><td colspan="3" class="">

		   <? $Stmtsg = mysql_query("SELECT DEFEIS_DESCRICAO FROM rar_defeito_subgrupo WHERE DEFEIS_IDO = ". $AVALI_AREZ_DEFEIS_IDO); ?>

		   <? if($Rsg = mysql_fetch_assoc($Stmtsg)) { 

		         echo $Rsg["DEFEIS_DESCRICAO"]; 

		   	  }

		   ?> 

		   </td>
           </tr>

         <tr class="">

           <td class=""><strong>Detalhamento</strong></td>

           <td colspan="3" class=""><span class="">

             <textarea name="AVALI_AREZ_DETALHE" cols="100%" rows="5" class="style2" id="AVALI_AREZ_DETALHE" disabled><?=$AVALI_AREZ_DETALHE?></textarea>

           </span></td>
         </tr>

         <tr class="">

           <td class=""><strong>Data avalia&ccedil;&atilde;o </strong></td>

           <td width="19%" class=""><span class="">

             <input name="AVALI_AREZ_DATA" value="<?=$AVALI_AREZ_DATA?>" type="text" class="form" id="AVALI_AREZ_DATA" onKeyPress="return JSUtilApenasNumero(event);" onKeyUp="JSUtilMascara(this,event,'__/__/____');" size="10" maxlength="50" disabled>

           </span></td>

           <td width="20%" class=""><strong>Avalia&ccedil;&atilde;o encerrada </strong></td>

           <td width="42%" class=""><input name="AVALI_AREZ_ENCERRADO" type="checkbox" id="AVALI_AREZ_ENCERRADO" value="S" <?=(($AVALI_AREZ_ENCERRADO == "S") ? "checked" : "")?> onClick="updateDateNow(this,'AVALI_AREZ_DATA');" disabled></td>
         </tr>

         <tr class="">

           <td class=""><strong>Respons&aacute;vel</strong></td>

           <td colspan="3" class=""><span class="">

             <input name="textfield52242" type="text" disabled class="form"  value="<?=$USUARIO?>" size="50" maxlength="50">

           </span></td>
         </tr>



         <tr class="tab_titulo">

           <td colspan="4" class=""><strong>Situa&ccedil;&atilde;o da reclama&ccedil;&atilde;o </strong></td>
         </tr>

         <tr class="">

           <td colspan="4" class=""><input name="AVALI_SITUACAO" type="radio" value="P" <?=(($AVALI_SITUACAO == "P") ? "checked" : "")?> disabled>

    Procedente

      <input name="AVALI_SITUACAO" type="radio" value="I"  <?=(($AVALI_SITUACAO == "I") ? "checked" : "")?> disabled>

    Improcedente

    <input name="AVALI_SITUACAO" type="radio" value="E" <?=(($AVALI_SITUACAO == "E") ? "checked" : "")?> disabled>

    Em an&aacute;lise </td>
         </tr>

         <tr class="">

           <td class=""><strong>Status da reclama&ccedil;&atilde;o </strong></td>

           <td colspan="3" class=""><span class="">

             <select name="LANCA_STATUS" class="form" onChange="updateAvaliacao()" disabled>

               <option value="">...Selecione</option>

			   <option value="1"<?=(($LANCA_STATUS == "1") ? " selected" : "")?>>Em andamento</option>

               <option value="3"<?=(($LANCA_STATUS == "3") ? " selected" : "")?>>Encerrada</option>
            </select>

</span></td>

<? }else{ ?>

		<Td><div  align="center"><strong>Avaliação não realizada !</strong></div></Td>

<? } ?>
         </tr>

       </table></td>
       </tr>

     <tr>

       <td colspan="4"> <div align="center"><a href="javascript: abre_impressao();"><img src="imagens/imprimir.jpg" alt="Clique aqui para fechar este relat&oacute;rio" width="52" height="22" border="0" ></a><a href="javascript:voltar();" >&nbsp;<img src="../img/bts/cancelar.jpg" name="Image361" width="52" height="22" border="0" id="Image361"></a>&nbsp;

         <? if ($_GET['Destino'] == "1"){?>

		 <a onClick="abrir_janela_popup('email_avaliacoes_realizadas.php?Referencia=<?=$Rar?>','prenota','width=450,height=450,top=0,left=0, scrollbars=yes,status=no,resizable=no,dependent=yes')" href="#"><img src="imagens/enviar.jpg" alt="Encaminhar reclama&ccedil;&atilde;o para agenciador" width="52" height="22" border="0"></a>&nbsp;

		 <input name="Reabrir" type="button" class="campo_texto" id="Reabrir" onclick="javascript:Reabre();" value="Reabrir avalia&ccedil;&atilde;o">

		 <? }?>

       </div></td>
       </tr>
   </table>

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

if (document.form.ITEM_QTDE.value == "" || document.form.ITEM_VALOR_UNITARIO.value == "")

	document.form.ITEM_VALOR_TOTAL.value = "R$ 0,00";

else

	document.form.ITEM_VALOR_TOTAL.value = "R$ " + arredondaNumber(parseFloat(document.form.ITEM_VALOR_UNITARIO.value.substring(3).replace(",",".")) * parseInt(document.form.ITEM_QTDE.value),",",2,true);

	

function voltar(){

	history.go(-1);

	/*if (document.form.DESTINO.value == "1"){

		document.location.href = "pesq_avaliacoes_individual_arz.php";

	}else if (document.form.DESTINO.value == "2"){

		document.location.href = "pesq_avaliacoes_realizadas_forn.php";

	}else{

		document.location.href = "pesq_avaliacoes_reliazadas.php";

	}*/

}	



function Reabre() {

	if(confirm("Deseja reabrir a avaliação da reclamação " + document.form.ID.value + " ?")){

		document.form.action = "util_reabreok.php?RAR=" + document.form.ID.value;

		document.form.submit();

	}



}





function verificaForm(formObj) {

	if (formObj.AVALI_AREZ_DEFEI_IDO.value == "") {

		alert("Preencha o campo \"Defeito encontrado\"");

		return;

	}

	if (formObj.AVALI_AREZ_DETALHE.value == "") {

		alert("Preencha o campo \"Detalhamento\"");

		return;

	}

	if (!JSUtilValidaData(formObj.AVALI_AREZ_DATA.value,false)) {

		alert("Preencha o campo \"Data da avaliação\"");

		return;

	}

	if (!JSUtilValidaData(formObj.AVALI_STAR_DATA.value,false)) {

		alert("Preencha o campo \"Data da avalaição (STAR EXPORT)\"");

		return;

	}



	if (!formObj.AVALI_SITUACAO[0].checked && !formObj.AVALI_SITUACAO[1].checked && !formObj.AVALI_SITUACAO[2].checked) {

		alert("Preencha o campo \"Situação da reclamação\"");

		return;

	}



	if (formObj.LANCA_STATUS.value == "") {

		alert("Preencha o campo \"Status da reclamação\"");

		return;

	}



	formObj.AVALI_STAR_DATA.disabled = false;

	formObj.AVALI_AREZ_DATA.disabled = false;

	formObj.action = "pesq_avaliacao_pendenteok.php";		

	document.form.submit();

}

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



function abrir_janela_popup(theURL,winName,features) { //v2.0

		window.open(theURL,winName,features);

	}

	

function abre_impressao(){

	abrir_janela_popup('imp_reclamacao.php?Id=<?=$_GET['Id']?>','imp_reclamacao','width=800,height=540,top=0,left=0, scrollbars=yes,status=yes,resizable=yes,dependent=yes');	

}







//-->

</script>