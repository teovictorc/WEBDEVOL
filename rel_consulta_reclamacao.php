<? 	include("inc/conn_externa.inc.php");



	$Sql = "SELECT round(i.item_valor,2) ITEM_VALOR, L.*,".

		   "       concat(substring(item_referencia,1,4),'-',substring(item_referencia,5,4),'-',substring(item_referencia,9,4),'-',substring(item_referencia,13,4)) ITEM_REFERENCIA,".

	       "       ITEM_COLECAO, ITEM_NF, ITEM_PAR, ITEM_QTDE, ITEM_FOTOPROD, ITEM_FOTOSOLA, ".

		   "       ITEM_FOTODEFEITO,F.NOME As FABRICA, ITEM_NUM33, ITEM_NUM34, ITEM_NUM35, ITEM_NUM36, ITEM_NUM37, ITEM_NUM38, ITEM_NUM39, ITEM_NUM40,".

		   "       date_format(L.lanca_dataabertura,'%d/%m/%Y') As DATA, P.PESSOA,P.NOME,P.LOGRADOURO,".

		   "       datediff(lanca_dataabertura,item_data) DIAS, ".

		   "       DS_RESUMIDA_ITEM DESCRICAO, ".

		   "       P.BAIRRO,P.NM_MUNICIPIO,P.SG_UF, date_format(item_data,'%d/%m/%Y') As ITEM_DATA ".

		   " FROM PESSOA P, RAR_LANCAMENTO L, PESSOA F, RAR_ITEM I, ITEM_MATERIAL IM ".

		   " WHERE L.LANCA_FABRI_IDO = F.PESSOA ".

		   "       AND L.lanca_pessoa = P.PESSOA ".

		   "       AND I.item_numrar = L.lanca_numrar ".

		   "       AND I.item_REFERENCIA = im.cd_item_material".

		   "       AND L.LANCA_NUMRAR = '" .$_GET['Id']. "'";



	$Stmt = mysql_query($Sql);

	if (!$Rs = mysql_fetch_assoc($Stmt))

		die("<script>window.close();</script>");

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

<script language="JavaScript" type="text/JavaScript">

<!--

function MM_swapImgRestore() { //v3.0

  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;

}



function MM_preloadImages() { //v3.0

  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();

    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)

    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}

}



function MM_findObj(n, d) { //v4.01

  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {

    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}

  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];

  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);

  if(!x && d.getElementById) x=d.getElementById(n); return x;

}



function MM_swapImage() { //v3.0

  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)

   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}

}

//-->

</script>

<body onLoad="MM_preloadImages('imagens/fechar2.jpg')"><form name="form" method="post" action="">

<input type="hidden" name="ID" value="<?=$_GET['Id']?>">

<input type="hidden" name="DESTINO" value="<?=$_GET['Destino']?>">

<iframe name="teste" id="teste" scrolling="no" frameborder="0" width="0" height="0" src=""></iframe>

<table width="100%"  border="0" align="center">

     <tr>

       <td><span class="imp_normal_bot"><img src="imagens/logotipo_impressao.jpg" width="141" height="41"></span>  </td>

       <td><div align="right" class="style1">Data de emiss&atilde;o:&nbsp;

         <?=date("d/m/Y")?></div></td>

     </tr>

     <tr>

       <td width="49%" height="30"><span class="titulo">:: Consulta de reclama&ccedil;&atilde;o :: </span></td>

       <td width="51%"><div align="right"><span class="titulo">

	   </span></div>

	   </td>

     </tr>

</table>

<? 	include("inc/bot_imp.inc.php"); ?>

<table width="100%"  border="0" class="tabela">

  <tr>

    <td height="10" class="style2"><strong>Reclama&ccedil;&atilde;o</strong></td>

    <td height="10"><span class="style1">

      <input name="textfield52243" type="text" disabled class="campo_amarelo"  value="<?=$Rs['LANCA_NUMRAR']?>" size="12" maxlength="11">

    </span></td>

    <td height="10" class="style2"><strong>Tempo</strong></td>

    <td height="10" colspan="2"><span class="style1">

      <input name="numrar2" type="text" disabled class="campo_amarelo" id="numrar2"  value="<?=$Tempo?>" size="20" maxlength="20">

    </span></td>

  </tr>

  <tr>

    <td width="17%" height="10" class="style2"><strong>C&oacute;digo</strong></td>

    <td width="35%" height="10"><span class="style1">

      <input name="textfield52225" type="text" disabled class="campo_amarelo"  value="<?=$Rs['PESSOA']?>" size="5" maxlength="5">

    </span></td>

    <td width="11%" height="10" class="style2 style1">Categoria</td>

    <td width="8%" height="10" valign="middle" class="style1"><img src="imagens/<?=$Categoria?>" width="60" height="45"> </td>

    <td width="29%" valign="middle" class="style1"><input name="textfield522252" type="text" disabled class="campo_amarelo"  value="<?=$Descricao?>" size="10" maxlength="10"></td>

  </tr>

  <tr>

    <td height="10" class="style2"><strong>Nome do cliente </strong></td>

    <td height="10" colspan="4" class="style1"><input name="textfield5" type="text" disabled class="campo_amarelo"  value="<?=$Rs['NOME']?>" size="50" maxlength="50"></td>

  </tr>

  <tr>

    <td height="10" class="style2"><strong>Endere&ccedil;o</strong></td>

    <td height="10" class="style1"><input name="textfield52" type="text" disabled class="campo_amarelo"  value="<?=$Rs['LOGRADOURO']?>" size="50" maxlength="50"></td>

    <td height="10" class="style1"><strong>Bairro</strong></td>

    <td height="10" colspan="2" class="style1"><input name="textfield5222" type="text" disabled class="campo_amarelo"  value="<?=$Rs['BAIRRO']?>" size="20" maxlength="50"></td>

  </tr>

  <tr>

    <td height="10" class="style2"><strong>Cidade</strong></td>

    <td height="10" class="style1"><input name="textfield522" type="text" disabled class="campo_amarelo"  value="<?=$Rs['NM_MUNICIPIO']?>" size="50" maxlength="50"></td>

    <td height="10"><strong class="style1">UF</strong></td>

    <td height="10" colspan="2" class="style1"><input name="textfield52222" type="text" disabled class="campo_amarelo"  value="<?=$Rs['SG_UF']?>" size="5" maxlength="5"></td>

  </tr>

  <tr>

    <td height="10" class="style2"><strong>Solicitante</strong></td>

    <td height="10" colspan="4"><span class="style1">

      <input name="textfield5224" type="text" disabled class="campo_amarelo"  value="<?=$Rs['LANCA_SOLICITANTE']?>" size="50" maxlength="50">

    </span></td>

  </tr>

  <tr>

    <td height="10" class="style2"><strong>Fabricante</strong></td>

    <td height="10" colspan="4"><span class="style1">

      <input name="textfield5223" type="text" disabled class="campo_amarelo"  value="<?=$Rs['FABRICA']?>" size="50" maxlength="50">

    </span></td>

  </tr>

  <tr>

    <td height="10" class="style2"><strong>Motivo da solicita&ccedil;&atilde;o </strong></td>

    <td height="10" colspan="4"><textarea name="textarea" disabled cols="100%" rows="5" class="campo_amarelo"><?=$Rs['LANCA_MOTIVO']?>

</textarea></td>

  </tr>

  <tr bgcolor="#FFFFFF" class="listagem_azul">

    <td colspan="5" class="style2"><strong>Dados do consumidor </strong></td>

  </tr>

  <tr>

    <td height="10" class="style2"><strong>Nome: </strong></td>

    <td height="10" class=""><input name="CLIENTE_NOME" type="text" class="campo_amarelo" id="CLIENTE_NOME" value="<?=$Rs['LANCA_CLIENTE_NOME']?>" size="50" maxlength="50" disabled></td>

    <td height="10" class="style2"><strong>Fone: </strong></td>

    <td height="10" colspan="2"><input name="CLIENTE_FONE" type="text" class="campo_amarelo" id="CLIENTE_FONE" value="<?=$Rs['LANCA_CLIENTE_FONE']?>" size="30" maxlength="30" disabled></td>

  </tr>

  <tr>

    <td height="10" class="style2"><strong>Tipo reclama&ccedil;&atilde;o: </strong></td>

    <td height="10" class="style1">

      <input name="LANCA_TIPORECLAMACAO" type="radio" value="C" <? if ($Rs['LANCA_TIPORECLAMACAO'] == "C") {?> checked <? } ?> disabled>

      Defeito consumidor

      <input name="LANCA_TIPORECLAMACAO" type="radio" value="L" <? if ($Rs['LANCA_TIPORECLAMACAO'] == "L") {?> checked <? } ?> disabled>

      Defeito loja </td>

    <td height="10" class="style2">&nbsp;</td>

    <td height="10" colspan="2">&nbsp;</td>

  </tr>

  <tr bgcolor="#FFFFFF" class="listagem_azul">

    <td colspan="5" class="style2"><strong>Descri&ccedil;&atilde;o do &iacute;tem com problema </strong></td>

  </tr>

  <tr>

    <td height="15" class="style2"><strong>Refer&ecirc;ncia</strong></td>

    <td height="15" class="style2"><span class="style1">

      <input name="textfield522232" type="text" disabled class="campo_amarelo"  value="<?=$Rs['ITEM_REFERENCIA']?>" size="30" maxlength="50">

    </span></td>

    <td height="15" class="style2"><strong>Cole&ccedil;&atilde;o</strong></td>

    <td height="15" colspan="2" class="style2"><span class="style1">

      <input name="textfield52223" type="text" disabled class="campo_amarelo"  value="<?=$Rs['ITEM_COLECAO']?>" size="30" maxlength="50">

    </span></td>

  </tr>

  <tr>

    <td height="15" class="style2 style1">Descri&ccedil;&atilde;o do produto</td>

    <td height="15" colspan="4"><span class="style2"><span class="style1">

      <input name="textfield5222323" type="text" disabled class="campo_amarelo"  value="<?=$Rs['DESCRICAO']?>" size="90" maxlength="90">

    </span></span></td>

  </tr>

  <tr>

    <td height="15" class="style2"><strong>N. NF origem </strong></td>

    <td height="15"><span class="style2"><span class="style1">

      <input name="textfield5222322" type="text" disabled class="campo_amarelo"  value="<?=$Rs['ITEM_NF']?>" size="6" maxlength="6">

    </span></span></td>

    <td height="15"><strong class="style1">Data NF</strong></td>

    <td height="15" colspan="2"><span class="style1">

      <input name="textfield52224" type="text" disabled class="campo_amarelo"  value="<?=$Rs['ITEM_DATA']?>" size="20" maxlength="50">

    </span></td>

  </tr>

  <tr>

    <td height="15" class="style2"><strong>Quantidade</strong></td>

    <td height="15"><span class="style2"><span class="style1">

      <input name="ITEM_QTDE" type="text" disabled class="campo_amarelo" id="ITEM_QTDE2"  value="<?=$Rs['ITEM_QTDE']?>" size="6" maxlength="6">

    </span></span></td>

    <td height="15" colspan="3" class="style2">

      <?

	   if ($Rs['LANCA_CATEGORIA'] == "1"){

	   ?>

      <table width="100%"  border="0">

        <tr class="style1">

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

        <tr class="style1">

          <td>Qtde</td>

          <td align="center"><input name="ITEM_NUM33" type="text" disabled class="campo_amarelo" id="ITEM_NUM33" value="<?=$Rs['ITEM_NUM33']?>" size="3" maxlength="3" onChange="SomaQtde();"></td>

          <td align="center"><input name="ITEM_NUM34" type="text" disabled class="campo_amarelo" id="ITEM_NUM34" value="<?=$Rs['ITEM_NUM34']?>" size="3" maxlength="3" onChange="SomaQtde();"></td>

          <td align="center"><input name="ITEM_NUM35" type="text" disabled class="campo_amarelo" id="ITEM_NUM35" value="<?=$Rs['ITEM_NUM35']?>" size="3" maxlength="3" onChange="SomaQtde();"></td>

          <td align="center"><input name="ITEM_NUM36" type="text" disabled class="campo_amarelo" id="ITEM_NUM36" value="<?=$Rs['ITEM_NUM36']?>" size="3" maxlength="3" onChange="SomaQtde();"></td>

          <td align="center"><input name="ITEM_NUM37" type="text" disabled class="campo_amarelo" id="ITEM_NUM37" value="<?=$Rs['ITEM_NUM37']?>" size="3" maxlength="3" onChange="SomaQtde();"></td>

          <td align="center"><input name="ITEM_NUM38" type="text" disabled class="campo_amarelo" id="ITEM_NUM38" value="<?=$Rs['ITEM_NUM38']?>" size="3" maxlength="3" onChange="SomaQtde();"></td>

          <td align="center"><input name="ITEM_NUM39" type="text" disabled class="campo_amarelo" id="ITEM_NUM39" value="<?=$Rs['ITEM_NUM39']?>" size="3" maxlength="3" onChange="SomaQtde();"></td>

          <td align="center"><input name="ITEM_NUM40" type="text" disabled class="campo_amarelo" id="ITEM_NUM40" value="<?=$Rs['ITEM_NUM40']?>" size="3" maxlength="3" onChange="SomaQtde();"></td>

        </tr>

      </table>

      <? } ?>

    </td>

  </tr>

  <tr>

    <td height="15" class="style2"><strong>Valor unit&aacute;rio </strong></td>

    <td height="15"><span class="style1">

      <input name="ITEM_VALOR_UNITARIO" type="text" disabled class="campo_amarelo" id="ITEM_VALOR_UNITARIO"  value="R$ <?=$Rs['ITEM_VALOR']?>" size="20" maxlength="20">

    </span></td>

    <td height="15"><strong class="style1">Valor total </strong></td>

    <td height="15" colspan="2"><span class="style1">

      <input name="ITEM_VALOR_TOTAL" type="text" disabled class="campo_amarelo" id="ITEM_VALOR_TOTAL" size="20" maxlength="20">

    </span></td>

  </tr>

  <tr>

    <td colspan="5" class="style2"><div align="center"> </div></td>

  </tr>

  <tr>

    <td colspan="5" class="style2"><table width="100%"  border="0">

        <tr>

          <td width="32%"><table width="99%"  border="0">

              <tr class="listagem_azul">

                <td class="style1"><strong>

                  <?=$Foto1?>

                </strong></td>

              </tr>

              <tr>

                <td><div align="center"><a onclick="abrir_janela_popup('visualizar_foto.php?path=<?=$Rs['ITEM_FOTOPROD']?>','foto','width=780,height=480,top=0,left=0, scrollbars=yes,status=yes,resizable=no,dependent=yes')" href="#" ><img src="../fotos/<?=$Rs['ITEM_FOTOPROD']?>" width="180" height="150" border="0" ></a></div></td>

              </tr>

          </table></td>

          <td width="35%"><table width="99%"  border="0">

              <tr class="listagem_azul">

                <td class="style1"><strong>

                  <?=$Foto2?>

                </strong></td>

              </tr>

              <tr>

                <td><div align="center"><a onclick="abrir_janela_popup('visualizar_foto.php?path=<?=$Rs['ITEM_FOTOSOLA']?>','foto','width=780,height=480,top=0,left=0, scrollbars=yes,status=yes,resizable=no,dependent=yes')" href="#" ><img src="../fotos/<?=$Rs['ITEM_FOTOSOLA']?>" width="180" height="150" border="0" ></a></div></td>

              </tr>

          </table></td>

          <td width="33%"><table width="99%"  border="0">

              <tr class="listagem_azul">

                <td class="listagem_azul"><strong>

                  <?=$Foto3?>

                </strong></td>

              </tr>

              <tr>

                <td><div align="center"><a onclick="abrir_janela_popup('visualizar_foto.php?path=<?=$Rs['ITEM_FOTODEFEITO']?>','foto','width=780,height=480,top=0,left=0, scrollbars=yes,status=yes,resizable=no,dependent=yes')" href="#" ><img src="../fotos/<?=$Rs['ITEM_FOTODEFEITO']?>" width="180" height="150" border="0"></a></div></td>

              </tr>

          </table></td>

        </tr>

        <tr class="style1">

          <td ><div align="center">Clique sobre a foto para ampliar</div></td>

          <td ><div align="center">Clique sobre a foto para ampliar</div></td>

          <td ><div align="center">Clique sobre a foto para ampliar</div></td>

        </tr>

    </table></td>

  </tr>

  <tr>

    <?

		$Sql =	"SELECT AVALI_NUMRAR,AVALI_AREZ_DEFEIG_IDO,AVALI_AREZ_DEFEIS_IDO,AVALI_AREZ_DATA,AVALI_AREZ_ENCERRADO,AVALI_AREZ_DETALHE,".

		" AVALI_AREZ_USUAR_IDO, LANCA_STATUS, ".

		" AVALI_SITUACAO,AVALI_AUTOR_NUMAUT, date_format(AVALI_AREZ_DATA,'%d/%m/%Y') As ADATA, ".

		" USUAR_NOME ".

		" FROM RAR_AVALIACAO, RAR_USUARIO, RAR_LANCAMENTO ".

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

    <td colspan="5" class="style2"><table width="100%"  border="0">

        <tr class="listagem_azul">

          <?	if ($VAR == true) { ?>

          <td colspan="4" class="style2"><strong>Avalia&ccedil;&atilde;o t&eacute;cnica </strong></td>

        </tr>

        <tr class="tabela">

          <td width="100%" class="style2"><strong>Defeito encontrado</strong></td>

          <td colspan="3" class="style2">

            <? $Stmtg = mysql_query("SELECT DEFEIG_DESCRICAO FROM RAR_DEFEITO_GRUPO WHERE DEFEIG_IDO = ". $AVALI_AREZ_DEFEIG_IDO); ?>

            <? if($Rsg = mysql_fetch_assoc($Stmtg)) { 

		         echo $Rsg["DEFEIG_DESCRICAO"]; 

		   	  }

		   ?>

          </td>

        </tr>

        <tr>

          <td>&nbsp;</td>

          <td colspan="3" class="style2">

            <? $Stmtsg = mysql_query("SELECT DEFEIS_DESCRICAO FROM RAR_DEFEITO_SUBGRUPO WHERE DEFEIS_IDO = ". $AVALI_AREZ_DEFEIS_IDO); ?>

            <? if($Rsg = mysql_fetch_assoc($Stmtsg)) { 

		         echo $Rsg["DEFEIS_DESCRICAO"]; 

		   	  }

		   ?>

          </td>

        </tr>

        <tr class="tabela">

          <td class="style2"><strong>Detalhamento</strong></td>

          <td colspan="3" class="style2"><span class="style1">

            <textarea name="AVALI_AREZ_DETALHE" cols="100%" rows="5" class="campo_amarelo" id="AVALI_AREZ_DETALHE" disabled><?=$AVALI_AREZ_DETALHE?>

</textarea>

          </span></td>

        </tr>

        <tr class="tabela">

          <td class="style2"><strong>Data avalia&ccedil;&atilde;o </strong></td>

          <td width="19%" class="style2"><span class="style1">

            <input name="AVALI_AREZ_DATA" value="<?=$AVALI_AREZ_DATA?>" type="text" class="campo_amarelo" id="AVALI_AREZ_DATA" onKeyPress="return JSUtilApenasNumero(event);" onKeyUp="JSUtilMascara(this,event,'__/__/____');" size="10" maxlength="50" disabled>

          </span></td>

          <td width="20%" class="style2"><strong>Avalia&ccedil;&atilde;o encerrada </strong></td>

          <td width="42%" class="style2"><input name="AVALI_AREZ_ENCERRADO" type="checkbox" id="AVALI_AREZ_ENCERRADO" value="S" <?=(($AVALI_AREZ_ENCERRADO == "S") ? "checked" : "")?> onClick="updateDateNow(this,'AVALI_AREZ_DATA');" disabled></td>

        </tr>

        <tr class="tabela">

          <td class="style2"><strong>Respons&aacute;vel</strong></td>

          <td colspan="3" class="style2"><span class="style1">

            <input name="textfield52242" type="text" disabled class="campo_amarelo"  value="<?=$USUARIO?>" size="50" maxlength="50">

          </span></td>

        </tr>

        <tr class="listagem_azul">

          <td colspan="4" class="style2"><strong>Situa&ccedil;&atilde;o da reclama&ccedil;&atilde;o </strong></td>

        </tr>

        <tr class="tabela">

          <td colspan="4" class="style2"><input name="AVALI_SITUACAO" type="radio" value="P" <?=(($AVALI_SITUACAO == "P") ? "checked" : "")?> disabled>

            Procedente

              <input name="AVALI_SITUACAO" type="radio" value="I"  <?=(($AVALI_SITUACAO == "I") ? "checked" : "")?> disabled>

            Improcedente

            <input name="AVALI_SITUACAO" type="radio" value="E" <?=(($AVALI_SITUACAO == "E") ? "checked" : "")?> disabled>

            Em an&aacute;lise </td>

        </tr>

        <tr class="tabela">

          <td class="style2"><strong>Status da reclama&ccedil;&atilde;o </strong></td>

          <td colspan="3" class="style2"><span class="style1">

            <select name="LANCA_STATUS" class="campo_amarelo" onChange="updateAvaliacao()" disabled>

              <option value="">...Selecione</option>

              <option value="1"<?=(($LANCA_STATUS == "1") ? " selected" : "")?>>Em andamento</option>

              <option value="3"<?=(($LANCA_STATUS == "3") ? " selected" : "")?>>Encerrada</option>

            </select>

          </span></td>

          <? }else{ ?>

          <Td><div  align="center"><strong>Avalia&ccedil;&atilde;o n&atilde;o realizada !</strong></div></Td>

          <? } ?>

        </tr>

    </table></td>

  </tr>

  <tr>

    <td colspan="5">

      <div align="center"><a href="javascript: window.print();"><img src="imagens/imprimir.jpg" alt="Clique aqui para fechar este relat&oacute;rio" width="52" height="22" border="0" ></a><a href="javascript:window.close();" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image361','','imagens/fechar2.jpg',1)">&nbsp;<img src="imagens/fechar.jpg" name="Image361" width="78" height="20" border="0" id="Image361"></a>&nbsp; </div></td>

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





function abrir_janela_popup(theURL,winName,features) { //v2.0

		window.open(theURL,winName,features);

	}









//-->

</script>