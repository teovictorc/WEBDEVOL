<? include("inc/conn_externa.inc.php");

	function validazero($campo){

		if ($campo = "" || $campo = " "){

			return 0;

		}else{

			return $campo;

		}

	}



	$Sql = " SELECT CASE P.CATEGORIA_CLIENTE ";

	$Sql.= "        	WHEN 8 THEN 'FRANQUIA' ";

	$Sql.= "        	WHEN 9 THEN 'MULTIMARCA DE FRANQUIA' ";

	$Sql.= "        	WHEN 10 THEN 'FRANQUIA' ";

	$Sql.= "        	ELSE 'SEM CATEGORIA' ";

	$Sql.= "        END AS CATEGORIA, ";

	$Sql.= "        P.NOME, P.LOGRADOURO ENDERECO, P.BAIRRO, P.NM_MUNICIPIO CIDADE, P.SG_UF UF, PC.NOME CONSULTOR, ";

	$Sql.= "        date_format(servi_dataabertura,'%d/%m/%Y %H:%I') As DATA , ";

	$Sql.= "        date_format(SERVI_DATA_ENC_RESP,'%d/%m/%Y %H:%I') As DATA_ENCAMINHAMENTO , ";

	$Sql.= "        date_format(SERVI_DATA_RESPONSAVEL,'%d/%m/%Y %H:%I') As DATA_RESPONSAVEL , ";

	$Sql.= "        U.USUAR_IDO, U.USUAR_NOME ANJO, S.*, TIPPR_DESCRICAO, EQUIP_NOME, TISER_DESCRICAO, T.*, U2.USUAR_NOME RESPONSAVEL ";

	$Sql.= " FROM PESSOA P, RAR_CLIENTE_ESTRUTURA RE, PESSOA PC, RAR_USUARIO U, RAR_SERVICO S, RAR_TIPOPRODUTO, RAR_EQUIPE, RAR_TIPOSERVICO T, RAR_USUARIO U2 ";

	$Sql.= " WHERE P.PESSOA = CLIEN_EST_CLIENTE ";

	$Sql.= "       AND P.PESSOA = SERVI_PESSO_IDO ";

	$Sql.= "       AND TIPPR_IDO = SERVI_TIPPR_IDO ";

	$Sql.= "       AND EQUIP_IDO = SERVI_EQUIP_IDO ";

	$Sql.= "       AND TISER_IDO = SERVI_TISER_IDO ";

	$Sql.= "       AND PC.PESSOA = CLIEN_EST_CONSULTOR ";

	$Sql.= "       AND SERVI_USUAR_ANJO = U.USUAR_IDO ";

	$Sql.= "       AND SERVI_USUAR_RESPONSAVEL = U2.USUAR_IDO ";

	$Sql.= "       AND SERVI_NUMERO = '" .$_GET['ID']. "'";

	

	

//	die($Sql);

	$Stmt = mysql_query($Sql);

	if (!$Rs = mysql_fetch_assoc($Stmt)){

		die("<script>document.location.href = 'pesq_wfarec_avaliacaopendente.php';</script>");

	}else{

		$SERVI_FOTO = $Rs["SERVI_FOTO"];

		$TISER_SOLICITANF = $Rs["TISER_SOLICITANF"];

		$TISER_SOLICITANFDEV = $Rs["TISER_SOLICITANFDEV"]; 

		$TISER_SOLICITADUP = $Rs["TISER_SOLICITADUP"];

		$TISER_SOLICITAPED = $Rs["TISER_SOLICITAPED"];

		$TISER_SOLICITAPED_PROD = $Rs["TISER_SOLICITAPED_PROD"];

		$TISER_SOLICITAFOTO = $Rs["TISER_SOLICITAFOTO"];

		$TISER_SOLICITANFPROD = $Rs["TISER_SOLICITANFPROD"];

		

		$TISER_SOLICITANF_PROD_QTDE = $Rs["TISER_SOLICITANF_PROD_QTDE"];

		$TISER_SOLICITAPROD_REC = $Rs["TISER_SOLICITAPROD_REC"];

		$TISER_SOLICITACOLETA = $Rs["TISER_SOLICITACOLETA"];

		

		$SERVI_COB_DATA = $Rs['SERVI_COB_DATA'];

		$SERVI_RARCOM_IDO = $Rs['SERVI_RARCOM_IDO'];

		

		$NomeCliente = str_replace("'","",$Rs["NOME"]);

		$SERVI_TIPPR_IDO = $Rs['SERVI_TIPPR_IDO'];

		$SERVI_EQUIP_IDO = $Rs['SERVI_EQUIP_IDO'];

		$SERVI_USUAR_RESPONSAVEL = $Rs['SERVI_USUAR_RESPONSAVEL'];

		$SERVI_OBS_ANJO = $Rs['SERVI_OBS_ANJO'];

		$SERVI_OBS_RESPONSAVEL = $Rs['SERVI_OBS_RESPONSAVEL'];

		

		$SERVI_EQUIP_IDO2 = $Rs['SERVI_EQUIP_IDO2'];

		$SERVI_USUAR_RESPONSAVEL = $Rs['SERVI_USUAR_RESPONSAVEL'];

		$SERVI_USUAR_RESPONSAVEL2 = $Rs['SERVI_USUAR_RESPONSAVEL2'];

		$SERVI_DATA_RESPONSAVEL = $Rs['SERVI_DATA_RESPONSAVEL'];

		$SERVI_DATA_RESPONSAVEL2 = $Rs['SERVI_DATA_RESPONSAVEL2'];

		$TISER_COLETAMERCADORIA = $Rs['TISER_COLETAMERCADORIA'];

		

		if ($SERVI_DATA_RESPONSAVEL != ""){

			$EQUIPE_RESPONSAVEL = "2";

		}else{

			$EQUIPE_RESPONSAVEL = "1";

		}

		$SERVI_OBS_ANJO = $Rs['SERVI_OBS_ANJO'];

		$SERVI_OBS_RESPONSAVEL = $Rs['SERVI_OBS_RESPONSAVEL'];

		$SERVI_OBS_RESPONSAVEL2 = $Rs['SERVI_OBS_RESPONSAVEL2'];

		

		$DATA = $Rs['DATA'];

		$DATA_ENCAMINHAMENTO = $Rs['SERVI_DATA_ENC_RESP'];

		$SERVI_STATUS = $Rs['SERVI_STATUS'];

		$SERVI_TISER_IDO = $Rs['SERVI_TISER_IDO'];

		$DATA_RESPONSAVEL = $Rs['SERVI_DATA_RESPONSAVEL'];

		$SERVI_FOTO_RETORNO = $Rs['SERVI_FOTO_RETORNO'];

		$TISER_SOLICITAFOTO_RETORNO = $Rs['TISER_SOLICITAFOTO_RETORNO'];

		$EQUIP_NOME = $Rs['EQUIP_NOME'];

		$USUAR_RESPONSAVEL = $Rs['USUAR_RESPONSAVEL'];

		

		$EQUIPE = $Rs['EQUIP_NOME'];

		$RESPONSAVEL = $Rs['RESPONSAVEL'];

		

		if ($SERVI_FOTO_RETORNO == "") {

			$ImagemRetorno = "imagens/b.gif";

		}else{

			$ImagemRetorno = "../fotos/".$SERVI_FOTO_RETORNO;

		}

	}



?>

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

<body onLoad="MM_preloadImages('imagens/cancelar2.jpg','imagens/rarcomercial.jpg','imagens/cobranca.jpg')">

<form name="form" method="post" action="" enctype="multipart/form-data">

<tr><td background="imagens/img/webdevol_r8_c1.jpg">&nbsp;</td>

   <td colspan="9"><table width="100%"  border="0" class="tabela">

     <tr class="listagem_azul">

       <td height="15" colspan="5" class="style2 style1">Identifica&ccedil;&atilde;o do cliente </td>

     </tr>

     <tr>

       <td width="20%" height="10" class="style2"><strong>C&oacute;digo         

	   <input name="SERVI_NUMERO" type="hidden" class="campo_amarelo" id="SERVI_NUMERO" value="<?=$Rs["SERVI_NUMERO"]?>" size="5" maxlength="5" readonly>

       <strong><strong>

       <input name="SERVI_USUAR_RESPONSAVEL_ORIG" type="hidden" class="campo_amarelo" id="SERVI_NUMERO3" value="<?=$Rs["SERVI_USUAR_RESPONSAVEL"]?>" size="5" maxlength="5" readonly>

       </strong></strong> </strong></td>

       <td height="10" colspan="2" class="campo_amarelo"><?=$Rs["SERVI_PESSO_IDO"]?></td>

       <td width="10%" height="10" class="style1">N&ordm; Servi&ccedil;o </td>

       <td width="35%" height="10"><input name="NUMERO" type="text" class="campo_amarelo" id="NOME3" value="<?=$Rs["SERVI_NUMERO"]?>" size="13" maxlength="11" readOnly></td>

     </tr>

     <tr>

       <td height="10" class="style2"><strong>Nome do cliente </strong></td>

       <td height="10" colspan="2" class="campo_amarelo"><?=$Rs["NOME"]?></td>

       <td height="10" class="style1">Abertura </td>

       <td height="10" ><input name="SERVI_DATAABERTURA" type="text" class="campo_amarelo" id="SERVI_DATAABERTURA" value="<?=$Rs["DATA"]?>" size="20" maxlength="12" readOnly></td>

     </tr>

     <tr>

       <td height="10" class="style2 style1">Categoria</td>

       <td height="10" colspan="2" class="campo_amarelo" ><?=$Rs["CATEGORIA"]?></td>

       <td height="10" class="style1">Consultor</td>

       <td height="10" class="campo_amarelo"><?=$Rs["CONSULTOR"]?></td>

     </tr>

     <tr>

       <td height="10" class="style2"><strong>Endere&ccedil;o</strong></td>

       <td height="10" colspan="2" class="campo_amarelo" ><?=$Rs["ENDERECO"]?></td>

       <td height="10" class="style1"><strong>Bairro</strong></td>

       <td height="10" class="campo_amarelo" ><?=$Rs["BAIRRO"]?></td>

     </tr>

     <tr>

       <td height="10" class="style2"><strong>Cidade</strong></td>

       <td height="10" colspan="2" class="campo_amarelo"><?=$Rs["CIDADE"]?></td>

       <td height="10"><strong class="style1">UF</strong></td>

       <td height="10" ><input name="UF" type="text" class="campo_amarelo" id="UF" value="<?=$Rs["UF"]?>" size="5" maxlength="5" readOnly></td>

     </tr>

     <tr>

       <td height="10" class="style2"><strong>Solicitante</strong></td>

       <td height="10" colspan="2" class="campo_amarelo"><?=$Rs["SERVI_SOLICITANTE"]?></td>

       <td height="10" class="style1">Anjo</td>

       <td height="10" class="campo_amarelo"><?=$Rs["ANJO"]?><input name="SERVI_USUAR_ANJO" type="hidden" class="campo_amarelo" id="SERVI_USUAR_ANJO" value="<?=$Rs["SERVI_USUAR_ANJO"]?>" size="5" maxlength="5" readOnly></td>

     </tr>

     <tr>

       <td height="10" class="style2">&nbsp;</td>

       <td height="10" colspan="4">&nbsp;</td>

     </tr>

     <tr class="listagem_azul">

       <td height="15" colspan="5" class="style2"><div id="numeropar" style="display: font-weight: bold; font-weight: bold;">Descri&ccedil;&atilde;o do servi&ccedil;o </div></td>

     </tr>

	 <tr>

	   <td height="15" class="style2 style1">Categoria de produto</td>

	   <td height="15" colspan="4" class="campo_amarelo"><?=$Rs["TIPPR_DESCRICAO"]?></td>

	   </tr>

	   <tr>

	   <td height="15" class="style2 style1">Equipe</td>

	   <td height="15" colspan="4" class="campo_amarelo"><?=$Rs["EQUIP_NOME"]?></td>

	   </tr>

	   <tr>

	     <td height="15" class="style2 style1">Servi&ccedil;o</td>

	     <td height="15" colspan="4" class="campo_amarelo"><?=$Rs["TISER_NOME"]?></td>

        </tr>

	   <tr>

	   <td height="15" class="style2 style1">Descri&ccedil;&atilde;o Serviço</td>

	   <td height="15" colspan="4" class="campo_amarelo"><?=$Rs["TISER_DESCRICAO"]?></td>

	   </tr>

	   <tr>

         <td height="15" class="style2 style1">Solu&ccedil;&atilde;o</td>

         <td height="15" colspan="4" class="campo_amarelo"><?=$Rs["TISER_SOLUCAO"]?></td>

        </tr>

	   <tr>

	   <td height="15" class="style2 style1">Complemento</td>

	   <td height="15" colspan="4" class="campo_amarelo"><?=$Rs["SERVI_COMPLEMENTO"]?></td>

	   </tr>

	   <tr class="listagem_azul">

       <td height="15" colspan="5" class="style2"><div id="numeropar" style="display: font-weight: bold; font-weight: bold;">Equipe respons&aacute;vel e usu&aacute;rio respons&aacute;vel pela resolu&ccedil;&atilde;o do servi&ccedil;o </div></td>

     </tr>

	 <? if ($SERVI_DIRETO == "S"){ 

	 	$SERVI_EQUIP_IDO = $Rs['SERVI_EQUIP_IDO'];

		$SERVI_USUAR_RESPONSAVEL = $Rs['SERVI_USUAR_RESPONSAVEL'];

	 

	 ?>

	 	<tr>

			<td class="style2 style1">Equipe</td>

			<td colspan="3" class="campo_amarelo"><?=$EQUIPE?></td>

	 	</tr>

	 	<tr>

	 	  <td class="style2 style1">Respons&aacute;vel</td>

	 	  <td colspan="3" class="campo_amarelo"><?=$RESPONSAVEL?></td>

 	    </tr>

	 <? }else{ ?>

		 <tr>

		   <td class="style2 style1">Equipe</td>

		   <td colspan="4" class="campo_amarelo"><?=$EQUIPE?></td>

	    </tr>

		 <tr>

		   <td class="style2 style1">Respons&aacute;vel</td>

		   <td colspan="4" class="campo_amarelo"><?=$RESPONSAVEL?></td>

	    </tr>

		 <tr>

           <td class="style2 style1">Obs. do respons&aacute;vel </td>

           <td colspan="4" class="campo_amarelo"><?=$SERVI_OBS_RESPONSAVEL?></td>

	    </tr>

		 <tr>

		   <td class="style2 style1">Data encerramento</td>

		   <td colspan="4" class="campo_amarelo"><?=FormataDataHora($SERVI_DATA_RESPONSAVEL)?></td>

	    </tr>

		<? if ($SERVI_USUAR_RESPONSAVEL2 != ""){?>

		<tr>

		   <td class="style2 style1">&nbsp;</td>

		   <td colspan="4">&nbsp;</td>

	    </tr>

		<tr>

		  <td class="style2 style1">Equipe 2 </td>

		  <td colspan="4" class="campo_amarelo"><?=Equipe($SERVI_EQUIP_IDO2)?></td>

	    </tr>

		<tr>

		   <td class="style2 style1">Respons&aacute;vel 2</td>

		   <td colspan="4" class="campo_amarelo"><?=Usuario($SERVI_USUAR_RESPONSAVEL2)?></td>

	    </tr>

		 <tr>

           <td class="style2 style1">Obs. do respons&aacute;vel 2</td>

           <td colspan="4" class="campo_amarelo"><?=$SERVI_OBS_RESPONSAVEL2?></td>

	    </tr>

		 <tr>

		   <td class="style2 style1">Data encerramento 2</td>

		   <td colspan="4" class="campo_amarelo"><?=FormataDataHora($SERVI_DATA_RESPONSAVEL2)?></td>

	    </tr>

		<? } ?>

		<? } ?>

	   <tr>

	 	 <td colspan="5">

		 

		 <table width="100%"  border="0">

	  

	 <tr class="listagem_azul">

       <td height="15" colspan="4" class="style2 style1">Demais informações complementares 

       <input name="TISER_SOLICITANF" type="hidden" class="campo_amarelo" value="<?=$TISER_SOLICITANF?>" id="TISER_SOLICITANF" size="5" maxlength="5">

       <input name="TISER_SOLICITANFDEV" type="hidden" class="campo_amarelo" value="<?=$TISER_SOLICITANFDEV?>" id="TISER_SOLICITANFDEV" size="5" maxlength="5">

       <input name="TISER_SOLICITADUP" type="hidden" class="campo_amarelo" value="<?=$TISER_SOLICITADUP?>" id="TISER_SOLICITADUP" size="5" maxlength="5">

       <input name="TISER_SOLICITAPED" type="hidden" class="campo_amarelo" value="<?=$TISER_SOLICITAPED?>" id="TISER_SOLICITAPED" size="5" maxlength="5">

       <input name="TISER_SOLICITAFOTO" type="hidden" class="campo_amarelo" value="<?=$TISER_SOLICITAFOTO?>" id="TISER_SOLICITAFOTO" size="5" maxlength="5">

       <input name="TISER_SOLICITANFPROD" type="hidden" class="campo_amarelo" value="<?=$TISER_SOLICITANFPROD?>" id="TISER_SOLICITANFPROD" size="5" maxlength="5">

       <input name="TISER_SOLICITANF_PROD_QTDE" type="hidden" class="campo_amarelo" value="<?=$TISER_SOLICITANF_PROD_QTDE?>" id="TISER_SOLICITANF_PROD_QTDE" size="5" maxlength="5">

       <input name="TISER_SOLICITAPROD_REC" type="hidden" class="campo_amarelo" value="<?=$TISER_SOLICITAPROD_REC?>" id="TISER_SOLICITAPROD_REC" size="5" maxlength="5">

       <input name="TISER_SOLICITACOLETA" type="hidden" class="campo_amarelo" value="<?=$TISER_SOLICITACOLETA?>" id="TISER_SOLICITACOLETA" size="5" maxlength="5"></td>

     </tr>

	 <? 

	 

	 if ($TISER_SOLICITANF == "S"){?>

	 <tr>

	   <td height="15" class="style2">&nbsp;</td>

	   <td height="15" colspan="3">

	   

	   <table width="100%"  border="0">

         <tr bgcolor="#FFFFFF" class="listagem_cinza">

           <td><strong>Dados da nota fiscal </strong></td>

         </tr>

         <tr class="tabela">

           <td height="15" class="style2"><table width="100%"  border="0">

             <tr class="topo_listagem" >

			  <td width="55%" ><div align="left">Emitente</div></td>

              <td width="10%" ><div align="center">Nº NF</div></td>

              <td width="10%" ><div align="center">Nº Série</div></td>

			  <td width="15%" ><div align="center">Data emissão</div></td>

              <td width="10%" >&nbsp;</td>

             </tr>

             <? 

		   	$Sql = " SELECT SERNF_IDO, SERNF_NUM_NF, SERNF_SERIE_NF, NOME, date_format(nf.dt_emis_nf,'%d/%m/%Y') DATA_EMISSAO ";

		   	$Sql.= " FROM RAR_SERVICO_NF S, NOTA_FISCAL NF, PESSOA P ";

		   	$Sql.= " WHERE S.SERNF_NUM_NF = NF.NUM_NF ";

			$Sql.= "       AND S.SERNF_SERIE_NF = NF.SERIE_NF ";

			$Sql.= "       AND S.SERNF_PESSOA_EMITENTE = NF.PESSOA_EMITENTE ";

			$Sql.= "       AND P.PESSOA = NF.PESSOA_EMITENTE ";

			$Sql.= "       AND SERNF_SERVI_NUMERO = '".$_GET['Id']."' ";

		   	$Stmt = mysql_query($Sql);

			$x=0;

			while($Rs = mysql_fetch_assoc($Stmt)) {  

				$x++;

				?>

				 <tr class="campo_texto">

					<td><div align="left"><?=$Rs["NOME"]?></div></td>

					<td><div align="center"><?=$Rs["SERNF_NUM_NF"]?></div></td>

					<td><div align="center"><?=$Rs["SERNF_SERIE_NF"]?></div></td>

					<td><div align="center"><?=$Rs["DATA_EMISSAO"]?></div></td>

				    <td><div align="center"></div></td>

				 </tr>

			 <? } ?>

           </table>             

		   </td>

           </tr>

       </table></td>

	   </tr>

	   

	  <? } ?> 

	  

	  

	  <? if ($TISER_SOLICITANFPROD == "S"){?> 

	 <tr>

	   <td height="15" class="style2">&nbsp;</td>

	   <td height="15" colspan="3">

	   

	   <table width="100%"  border="0">

         <tr bgcolor="#FFFFFF" class="listagem_cinza">

           <td class="style2"><strong>Dados da nota fiscal + produto</strong></td>

         </tr>

         <tr class="tabela">

           <td height="15" class="style2"><table width="100%"  border="0">

             <tr class="topo_listagem" >

               <td width="35%" ><div align="left">Emitente</div></td>

               <td width="28%" >Fabricante</td>

               <td width="17%" ><div align="center">Produto</div></td>

               <td width="7%" ><div align="center">N&ordm; NF</div></td>

               <td width="5%" ><div align="center">S&eacute;rie</div></td>

               <td width="13%" ><div align="center">Data emiss&atilde;o</div></td>

             </tr>

             <? 

		   	$Sql = " SELECT CD_ITEM_MATERIAL, SERPR_IDO, SERPR_NUM_NF, SERPR_SERIE_NF, NOME, date_format(nf.dt_emis_nf,'%d/%m/%Y') DATA_EMISSAO ";

		   	$Sql.= " FROM RAR_SERVICO_NF_PROD S, NOTA_FISCAL NF, PESSOA P, ITEM_NOTA_FISCAL IT ";

		   	$Sql.= " WHERE S.SERPR_NUM_NF = NF.NUM_NF ";

			$Sql.= "       AND S.SERPR_SERIE_NF = NF.SERIE_NF ";

			$Sql.= "       AND S.SERPR_PESSOA_EMITENTE = NF.PESSOA_EMITENTE ";

			$Sql.= "       AND SERPR_CD_ITEM_MATERIAL = IT.CD_ITEM_MATERIAL ";

			$Sql.= "       AND IT.NUM_NF = NF.NUM_NF ";

			$Sql.= "       AND IT.SERIE_NF = NF.SERIE_NF ";

			$Sql.= "       AND IT.PESSOA_EMITENTE = NF.PESSOA_EMITENTE ";

			$Sql.= "       AND P.PESSOA = NF.PESSOA_EMITENTE ";

			$Sql.= "       AND SERPR_SERVI_NUMERO = '".$_GET['Id']."' ";

		   	$Stmt = mysql_query($Sql);

			$x = 0;

			while($Rs = mysql_fetch_assoc($Stmt)) {

				$x++;  

				?>

             <tr class="campo_texto">

               <td><div align="left"><?=$Rs["NOME"]?></div></td>

               <td><?=Fabricante($Rs["CD_ITEM_MATERIAL"])?></td>

               <td><div align="center"><?=$Rs["CD_ITEM_MATERIAL"]?></div></td>

               <td><div align="center"><?=$Rs["SERPR_NUM_NF"]?></div></td>

               <td><div align="center"><?=$Rs["SERPR_SERIE_NF"]?></div></td>

               <td><div align="center"><?=$Rs["DATA_EMISSAO"]?></div></td>

             </tr>

             <? } ?>

           </table></td>

           </tr>

       </table></td>

	   </tr>

	   

	  <? } ?> 

	  <? if ($TISER_SOLICITANFDEV == "S"){?>

	 <tr>

	   <td height="15" class="style2">&nbsp;</td>

	   <td height="15" colspan="3"><table width="100%"  border="0">

         <tr bgcolor="#FFFFFF" class="listagem_cinza">

           <td class="style2"><strong>Dados da nota fiscal de devolu&ccedil;&atilde;o</strong></td>

         </tr>

         <tr class="tabela">

           <td height="15" class="style2"><table width="100%"  border="0">

             <tr class="topo_listagem" >

               <td width="55%" ><div align="left">Emitente</div></td>

               <td width="10%" ><div align="center">N&ordm; NF</div></td>

               <td width="10%" ><div align="center">N&ordm; S&eacute;rie</div></td>

               <td width="15%" ><div align="center">Data emiss&atilde;o</div></td>

               <td width="10%" >&nbsp;</td>

             </tr>

             <? 

		   	$Sql = " SELECT SERDV_IDO, SERDV_NUM_NF, SERDV_SERIE_NF, NOME, date_format(nf.dt_emis_nf,'%d/%m/%Y') DATA_EMISSAO ";

		   	$Sql.= " FROM RAR_SERVICO_NF_DEV S, NOTA_FISCAL NF, PESSOA P ";

		   	$Sql.= " WHERE S.SERDV_NUM_NF = NF.NUM_NF ";

			$Sql.= "       AND S.SERDV_SERIE_NF = NF.SERIE_NF ";

			$Sql.= "       AND S.SERDV_PESSOA_EMITENTE = NF.PESSOA_EMITENTE ";

			$Sql.= "       AND P.PESSOA = NF.PESSOA_EMITENTE ";

			$Sql.= "       AND SERDV_SERVI_NUMERO = '".$_GET['Id']."' ";

		   	$Stmt = mysql_query($Sql);

			$x = 0;

			while($Rs = mysql_fetch_assoc($Stmt)) {

				$x++;  

				?>

             <tr class="campo_texto">

               <td><div align="left"><?=$Rs["NOME"]?></div></td>

               <td><div align="center"><?=$Rs["SERDV_NUM_NF"]?></div></td>

               <td><div align="center"><?=$Rs["SERDV_SERIE_NF"]?></div></td>

               <td><div align="center"><?=$Rs["DATA_EMISSAO"]?></div></td>

               <td><div align="center"></div></td>

             </tr>

             <? } ?>

           </table></td>

         </tr>

       </table></td>

	   </tr>

	   <? } ?> 

	  <? if ($TISER_SOLICITADUP == "S"){?>

	 <tr>

	   <td height="15" class="style2">&nbsp;</td>

	   <td height="15" colspan="3"><table width="100%"  border="0">

         <tr bgcolor="#FFFFFF" class="listagem_cinza">

           <td width="100%" class="style2"><strong>Duplicatas</strong></td>

         </tr>

         <tr class="tabela">

           <td height="15" class="style2 style1"><div align="left">

             <table width="100%"  border="0">

               <tr class="topo_listagem" >

                 <td width="45%" ><div align="left">Emitente</div></td>

                 <td width="10%" ><div align="center">N&ordm; Duplicata</div></td>

                 <td width="10%" ><div align="center">Data emiss&atilde;o</div></td>

				 <td width="10%" ><div align="center">Data vencimento</div></td>

				 <td width="15%" ><div align="center">Valor duplicata</div></td>

                 <td width="10%" >&nbsp;</td>

               </tr>

               <? 

		   	$Sql = " SELECT distinct SERDP_IDO, SERDP_NUM_NF, SERDP_SERIE_NF, NOME, date_format(DT_EMISSAO,'%d/%m/%Y') DATA_EMISSAO, ";

		   	$Sql.= "        date_format(DT_VENCIMENTO,'%d/%m/%Y') DATA_VENCIMENTO, VL_DUPL, PARCELA ";

			$Sql.= " FROM RAR_SERVICO_DUPLICATA S, DUPLICATA NF, PESSOA P ";

		   	$Sql.= " WHERE S.SERDP_NUM_NF = NF.NUM_NF ";

			$Sql.= "       AND S.SERDP_SERIE_NF = NF.SERIE_NF ";

			$Sql.= "       AND S.SERDP_PESSOA_EMITENTE = NF.PESSOA_EMITENTE ";

			$Sql.= "       AND P.PESSOA = NF.PESSOA_EMITENTE ";

			$Sql.= "       AND SERDP_PARCELA = PARCELA ";

			$Sql.= "       AND SERDP_SERVI_NUMERO = '".$_GET['Id']."' ";

		   	$Stmt = mysql_query($Sql);

			$x = 0;

			while($Rs = mysql_fetch_assoc($Stmt)) {

				$x++;  

				?>

               <tr class="campo_texto">

                 <td><div align="left"><?=$Rs["NOME"]?></div></td>

                 <td><div align="center"><?=$Rs["SERDP_NUM_NF"]."/".$Rs["PARCELA"]?></div></td>

                 <td><div align="center"><?=$Rs["DATA_EMISSAO"]?></div></td>

				 <td><div align="center"><?=$Rs["DATA_VENCIMENTO"]?></div></td>

				 <td><div align="right"><?=number_format($Rs["VL_DUPL"], 2, ',', '')?></div></td>

                 <td><div align="center"></div></td>

               </tr>

               <? } ?>

             </table>

             </div></td>

           </tr>

       </table></td>

	   </tr>

	   <? } ?> 

	  <? if ($TISER_SOLICITAPED == "S"){?>

	 <tr>

	   <td height="15" class="style2">&nbsp;</td>

	   <td height="15" colspan="3"><table width="100%"  border="0">

         <tr bgcolor="#FFFFFF" class="listagem_cinza">

           <td width="100%" class="style2"><strong>Pedido de venda </strong></td>

         </tr>

         <tr class="tabela">

           <td height="15" class="style2"><div align="left">

             <table width="100%"  border="0">

               <tr class="topo_listagem" >

                 <td width="65%" ><div align="left">Fornecedor</div></td>

                 <td width="10%" ><div align="center">N&ordm; Pedido </div></td>

                 <td width="15%" ><div align="center">Data emiss&atilde;o</div></td>

                 <td width="10%" >&nbsp;</td>

               </tr>

               <? 

		   	$Sql = " SELECT DISTINCT SERPD_IDO, NUM_PEDD_VENDA PEDIDO, NOME, date_format(DT_EMISSAO,'%d/%m/%Y') DATA_EMISSAO ";

			$Sql.= " FROM RAR_SERVICO_PEDIDO S, PEDIDO_VENDA NF, PESSOA P ";

		   	$Sql.= " WHERE S.SERPD_PESSOA_EMPRESA = NF.PESSOA_EMPRESA ";

			$Sql.= "       AND P.PESSOA = NF.PESSOA_EMPRESA ";

			$Sql.= "       AND SERPD_NUM_PEDD_VENDA = NUM_PEDD_VENDA ";

			$Sql.= "       AND SERPD_SERVI_NUMERO = '".$_GET['Id']."' ";

		   	$Stmt = mysql_query($Sql);

			$x = 0;

			while($Rs = mysql_fetch_assoc($Stmt)) {

				$x++;  

				?>

               <tr class="campo_texto">

                 <td><div align="left"><?=$Rs["NOME"]?></div></td>

                 <td><div align="center"><?=$Rs["PEDIDO"]?></div></td>

                 <td><div align="center"><?=$Rs["DATA_EMISSAO"]?></div></td>

                 <td><div align="center"></div></td>

               </tr>

               <? } ?>

             </table>

             </div></td>

           </tr>

       </table></td>

	   </tr>

	   <? } ?> 

	   <? if ($TISER_SOLICITAPED_PROD == "S"){?>

	 <tr>

	   <td height="15" class="style2">&nbsp;</td>

	   <td height="15" colspan="3"><table width="100%"  border="0">

         <tr bgcolor="#FFFFFF" class="listagem_cinza">

           <td width="100%" class="style2"><strong>Pedido de venda + Produto </strong></td>

         </tr>

         <tr class="tabela">

           <td height="15" class="style2"><div align="left">

             <table width="100%"  border="0">

               <tr class="topo_listagem" >

                 <td width="40%" ><div align="left">Fornecedor</div></td>

                 <td width="10%" ><div align="center">N&ordm; Pedido</div></td>

				 <td width="25%" ><div align="center">Produto</div></td>

                 <td width="15%" ><div align="center">Data emiss&atilde;o</div></td>

                 <td width="10%" ><div align="center">Ítem</div></td>

               </tr>

               <? 

		   	$Sql = " SELECT distinct CD_ITEM_VENDA, SERPP_CD_ITEM_MATERIAL, SERPP_IDO, NF.NUM_PEDD_VENDA PEDIDO, NOME, date_format(DT_EMISSAO,'%d/%m/%Y') DATA_EMISSAO ";

			$Sql.= " FROM RAR_SERVICO_PEDIDO_PROD S, PEDIDO_VENDA NF, ITEM_PEDIDO_VENDA IP, PESSOA P ";

		   	$Sql.= " WHERE S.SERPP_PESSOA_EMPRESA = NF.PESSOA_EMPRESA ";

			$Sql.= "       AND P.PESSOA = NF.PESSOA_EMPRESA ";

			$Sql.= "       AND SERPP_NUM_PEDD_VENDA = NF.NUM_PEDD_VENDA ";

			$Sql.= "       AND SERPP_CD_ITEM_MATERIAL = IP.CD_ITEM_MATERIAL ";

			$Sql.= "       AND NF.NUM_PEDD_VENDA = IP.NUM_PEDD_VENDA ";

			$Sql.= "       AND NF.PESSOA_EMPRESA = IP.PESSOA_EMPRESA ";

			$Sql.= "       AND SERPP_SERVI_NUMERO = '".$_GET['Id']."' ";

		   	$Stmt = mysql_query($Sql);

			$x = 0;

			while($Rs = mysql_fetch_assoc($Stmt)) {

				$x++;  

				?>

               <tr class="campo_texto">

                 <td><div align="left"><?=$Rs["NOME"]?></div></td>

                 <td><div align="center"><?=$Rs["PEDIDO"]?></div></td>

				 <td><div align="center"><?=$Rs["SERPP_CD_ITEM_MATERIAL"]?></div></td>

                 <td><div align="center"><?=$Rs["DATA_EMISSAO"]?></div></td>

                 <td><div align="center"><?=$Rs["CD_ITEM_VENDA"]?></div></td>

               </tr>

               <? } ?>

             </table>

             </div></td>

           </tr>

       </table></td>

	   </tr>

	   <? } ?> 

	  <? if ($TISER_SOLICITAFOTO == "S"){?>

	 <tr>

	   <td height="15" class="style2">&nbsp;</td>

	   <td height="15" colspan="3"><table width="100%"  border="0">

         <tr class="listagem_cinza">

           <td class="style1">Imagem</td>

         </tr>

         <tr>

           <td><a onclick="abrir_janela_popup('visualizar_foto.php?path=<?=$SERVI_FOTO?>','foto','width=780,height=480,top=0,left=0, scrollbars=yes,status=yes,resizable=no,dependent=yes')" href="#" ><img src="../fotos/<?=$SERVI_FOTO?>" width="180" height="150" border="0" ></a></td>

         </tr>

       </table></td>

	   </tr>

		<? } ?>

		<? if ($TISER_SOLICITANF_PROD_QTDE == "S"){?> 

	 <tr>

	   <td height="15" class="style2">&nbsp;</td>

	   <td height="15" colspan="3">

	   

	   <table width="100%"  border="0">

         <tr bgcolor="#FFFFFF" class="listagem_cinza">

           <td class="style2"><strong>Dados da nota fiscal + produto + quantidade</strong></td>

         </tr>

         <tr class="tabela">

           <td height="15" class="style2"><table width="100%"  border="0">

             <tr class="topo_listagem" >

               <td width="30%" ><div align="left">Emitente</div></td>

               <td width="28%" >Fabricante</td>

               <td width="17%" ><div align="center">Produto</div></td>

			   <td width="5%" ><div align="center">Qtde</div></td>

			   <td width="5%" ><div align="center">Grade</div></td>

			   <td width="10%" ><div align="right">Valor</div></td>

               <td width="7%" ><div align="center">N&ordm; NF</div></td>

               <td width="5%" ><div align="center">S&eacute;rie</div></td>

             </tr>

             <? 

		   	$Sql = " SELECT DISTINCT VL_UNITARIO_ITEM VALOR, CD_ITEM_MATERIAL, SERPQ_IDO, SERPQ_NUM_NF, SERPQ_SERIE_NF, ";

			$Sql.= "        NOME, date_format(nf.dt_emis_nf,'%d/%m/%Y') DATA_EMISSAO, SERPQ_GRADE, SERPQ_QTDE ";

		   	$Sql.= " FROM RAR_SERVICO_NF_PROD_QTDE S, NOTA_FISCAL NF, PESSOA P, ITEM_NOTA_FISCAL IT ";

		   	$Sql.= " WHERE S.SERPQ_NUM_NF = NF.NUM_NF ";

			$Sql.= "       AND S.SERPQ_SERIE_NF = NF.SERIE_NF ";

			$Sql.= "       AND S.SERPQ_PESSOA_EMITENTE = NF.PESSOA_EMITENTE ";

			$Sql.= "       AND SERPQ_CD_ITEM_MATERIAL = IT.CD_ITEM_MATERIAL ";

			$Sql.= "       AND IT.NUM_NF = NF.NUM_NF ";

			$Sql.= "       AND IT.SERIE_NF = NF.SERIE_NF ";

			$Sql.= "       AND IT.PESSOA_EMITENTE = NF.PESSOA_EMITENTE ";

			$Sql.= "       AND P.PESSOA = NF.PESSOA_EMITENTE ";

			$Sql.= "       AND SERPQ_SERVI_NUMERO = '".$_GET['Id']."' ";

		   	$Stmt = mysql_query($Sql);

			$x = 0;

			while($Rs = mysql_fetch_assoc($Stmt)) {

				$x++;  

				?>

				 <tr class="campo_texto">

				   <td><div align="left"><?=$Rs["NOME"]?></div></td>

				   <td><?=Fabricante($Rs["CD_ITEM_MATERIAL"])?></td>

				   <td><div align="center"><?=$Rs["CD_ITEM_MATERIAL"]?></div></td>

				   <td><div align="center"><?=$Rs["SERPQ_QTDE"]?></div></td>

				   <td><div align="center"><?=$Rs["SERPQ_GRADE"]?></div></td>

				   <td><div align="right"><?=$Rs["VALOR"]?></div></td>

				   <td><div align="center"><?=$Rs["SERPQ_NUM_NF"]?></div></td>

				   <td><div align="center"><?=$Rs["SERPQ_SERIE_NF"]?></div></td>

				 </tr>

             	<? } ?>

           </table></td>

           </tr>

       </table></td>

	   </tr>

	   

	  <? } ?>

	  

	  <? if ($TISER_SOLICITAPROD_REC == "S"){?>

	 <tr>

	   <td height="15" class="style2">&nbsp;</td>

	   <td height="15" colspan="3"><table width="100%"  border="0">

         <tr bgcolor="#FFFFFF" class="listagem_cinza">

           <td width="100%" class="style2"><strong>Produtos recebidos</strong></td>

         </tr>

         <tr class="tabela">

           <td height="15" class="style2"><div align="left">

             <table width="100%"  border="0">

               <tr class="topo_listagem" >

                 <td width="65%" ><div align="left">Produto recebido</div></td>

                 <td width="20%" ><div align="center">Quantidade Pares </div></td>

                 <td width="15%" ><div align="center">Valor Unitário</div></td>

               </tr>

               <? 

		   	$Sql = " SELECT * ";

			$Sql.= " FROM RAR_SERVICO_PROD_REC S, ITEM_MATERIAL I";

		   	$Sql.= " WHERE S.SERPC_PRODUTO = CD_ITEM_MATERIAL ";

			$Sql.= "       AND SERPC_SERVI_NUMERO = '".$_GET['Id']."' ";

		   	$Stmt = mysql_query($Sql);

			$x = 0;

			while($Rs = mysql_fetch_assoc($Stmt)) {

				$x++;  

				?>

               <tr class="campo_texto">

                 <td><div align="left"><?=$Rs["SERPC_PRODUTO"]." - ".$Rs["DS_RESUMIDA_ITEM"]?></div></td>

                 <td><div align="center"><?=$Rs["SERPC_QTDE"]?></div></td>

                 <td><div align="center"><?=$Rs["SERPC_VALOR"]?></div></td>

               </tr>

               <? } ?>

             </table>

             </div></td>

           </tr>

       </table></td>

	   </tr>

	   <? } ?>

	    <? if ($TISER_SOLICITACOLETA == "S"){?>

	 <tr>

	   <td height="15" class="style2">&nbsp;</td>

	   <td height="15" colspan="3"><table width="100%"  border="0">

         <tr bgcolor="#FFFFFF" class="listagem_cinza">

           <td width="100%" class="style2"><strong>Dados da coleta</strong></td>

         </tr>

         <tr class="tabela">

           <td height="15" class="style2"><div align="left">

             <table width="100%"  border="0">

               <tr class="topo_listagem" >

                 <td width="33%" ><div align="left">Quantidade Volumes</div></td>

                 <td width="33%" ><div align="center">N.º NF</div></td>

                 <td width="33%" ><div align="center">Categoria</div></td>

               </tr>

               <? 

		   	$Sql = " SELECT * ";

			$Sql.= " FROM RAR_SERVICO_COLETA";

		   	$Sql.= " WHERE SERCO_SERVI_NUMERO = '".$_GET['Id']."' ";

		   	$Stmt = mysql_query($Sql);

			$x = 0;

			while($Rs = mysql_fetch_assoc($Stmt)) {

				$x++;  

				if ($Rs["SERCO_CATEGORIA"] == "R"){

					$Categoria = "Rodoviário";

				}else{

					$Categoria = "Aéreo";

				}

				?>

               <tr class="campo_texto">

                 <td><div align="left"><?=$Rs["SERCO_VOLUME"]?></div></td>

                 <td><div align="center"><?=$Rs["SERCO_NF"]?></div></td>

                 <td><div align="center"><?=$Categoria?></div></td>

               </tr>

               <? } ?>

             </table>

             </div></td>

           </tr>

       </table></td>

	   </tr>

	   <? } ?>

   </table>

		 

		 </td>

	   </tr>

	   <!--

     <tr class="listagem_azul">

       <td height="15" colspan="5" class="style2"><div id="numeropar" style="display: font-weight: bold; font-weight: bold;">Equipe respons&aacute;vel e usu&aacute;rio respons&aacute;vel pela resolu&ccedil;&atilde;o do servi&ccedil;o </div></td>

     </tr>

     <tr>

       <td class="style2 style1">Equipe</td>

       <td colspan="4" class="campo_amarelo"><?=$EQUIP_NOME?></td>

     </tr>

     <tr>

       <td class="style2 style1">Respons&aacute;vel</td>

       <td colspan="4" class="campo_amarelo"><?=$USUAR_RESPONSAVEL?></td>

     </tr>

	    <tr>

       <td class="style2 style1">Obs. do respons&aacute;vel </td>

       <td colspan="4" class="campo_amarelo"><?=$SERVI_OBS_RESPONSAVEL?></td>

     </tr>-->

     <? if ($TISER_SOLICITAFOTO_RETORNO == "S"){?>

		 <tr>

		   <td valign="top" class="style2 style1">Imagem</td>

		   <td colspan="4" class="style2">			 <a href="javascript: abrir_janela_popup('visualizar_foto.php?path=<?=$ImagemRetorno?>','foto','width=780,height=480,top=0,left=0, scrollbars=yes,status=yes,resizable=no,dependent=yes')"><img src="<?=$ImagemRetorno?>" name="imgFile1" width="180" height="150" border="1"></a></td>

		 </tr>

		<? } ?>

        <tr class="listagem_azul">

          <td height="15" colspan="5" class="style2 style1">Retorno final do anjo </td>

        </tr>

        <tr>

          <td class="style2 style1">Status</td>

		  <?

		if ($SERVI_STATUS == "4"){

		  	$Status = "Concluído";

		}else{

			$Status = "Em aberto";

		}

		  ?>

          <td colspan="4" class="campo_amarelo"><?=$Status?></td>

        </tr>

        <tr>

          <td class="style2 style1">Obs. do anjo </td>

          <td colspan="4" class="campo_amarelo"><?=$SERVI_OBS_ANJO?></td>

        </tr>

        <tr class="listagem_azul">

       <td height="15" colspan="5" class="style2"><div id="numeropar" style="display: font-weight: bold; font-weight: bold;">Datas</div></td>

     </tr>

     <tr>

       <td class="style2 style1">Abertura do servi&ccedil;o </td>

       <td width="18%" class="campo_amarelo"><?=$DATA?></td>

       <td width="17%" class="style2">&nbsp;</td>

       <td class="style2">&nbsp;</td>

       <td class="style2"><? 

	   if ($SERVI_RARCOM_IDO != ""){ ?>

         <div align="right"><a href="javascript:Comercial('<?=$Id?>');" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image3512','','imagens/rarcomercial.jpg',1)"><img src="imagens/rarcomercial.jpg" name="Image3512" width="86" height="20" border="0" id="Image351"></a>

             <? } ?>

             <? 

	   if ($SERVI_COB_DATA != ""){ ?>

             <a href="javascript:Cobranca('<?=$Id?>');" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image3513','','imagens/cobranca.jpg',1)"><img src="imagens/cobranca.jpg" alt="Gerar dados de cobran&ccedil;a" name="Image3513" width="60" height="20" border="0" id="Image351"></a>

             <? } ?>

         </div></td>

     </tr>

	 <!--

     <tr>

       <td class="style2 style1">Enc. p/ respons&aacute;vel </td>

       <td class="campo_amarelo"><?=FormataDataHora($DATA_ENCAMINHAMENTO)?></td>

       <td class="style2">&nbsp;</td>

       <td class="style2">&nbsp;</td>

       <td class="style2">&nbsp;</td>

     </tr>-->

     <tr>

       <td class="style2 style1">Retorno para o anjo </td>

       <td class="campo_amarelo"><?=FormataDataHora($DATA_RESPONSAVEL)?></td>

       <td class="style2">&nbsp;</td>

       <td class="style2">&nbsp;</td>

       <td class="style2">&nbsp;</td>

     </tr>

     <tr>

       <td class="style2 style1">&nbsp;</td>

       <td colspan="4" class="style2">&nbsp;</td>

     </tr>

     <tr>

       <td colspan="5"> 

	   <div id="idButtons" style="display:" align="center">

	   <a href="javascript:window.close();" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image361','','imagens/fechar2.jpg',1)"><img src="imagens/fechar.jpg" name="Image361" width="78" height="20" border="0" id="Image361"></a></div></td>

       </tr>

   </table>

   <input type="hidden" name="TOTAL_ITENS" value="15">

</form>

<script language="javascript" type="text/javascript">

<!--



function makeObject(){

var x; 

var browser = navigator.appName; 

if(browser == "Microsoft Internet Explorer"){

	x = new ActiveXObject("Microsoft.XMLHTTP");

}else{

	x = new XMLHttpRequest();

}

	return x;

}





var request = makeObject();



function get_conteudo(Tipo){

	if (Tipo == "1"){ 

		var data = form.SERVI_TIPPR_IDO.value;

		request.open('get', 'pesq_wfarec_inclusao_equipe.php?SERVI_TIPPR_IDO='+data);

		request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

		request.onreadystatechange = output_equipe;

	}

	

	if (Tipo == "2"){ 

		var data = form.SERVI_TIPPR_IDO.value;

		var data2= form.SERVI_EQUIP_IDO.value;

		request.open('get', 'pesq_wfarec_inclusao_servico.php?SERVI_TIPPR_IDO='+data+'&SERVI_EQUIP_IDO='+data2);

		request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

		request.onreadystatechange = output_servico;

	}

	

	if (Tipo == "3"){ 

		var data = form.SERVI_TISER_IDO.value;

		request.open('get', 'pesq_wfarec_inclusao_complemento.php?SERVI_NUMERO='+document.form.SERVI_NUMERO.value+'&SERVI_TISER_IDO='+data);

		request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

		request.onreadystatechange = output_complemento;

	}

	

	if (Tipo == "4"){ 

		var data = form.SERVI_EQUIP_IDO.value;

		request.open('get', 'pesq_wfarec_inclusao_responsavel.php?SERVI_NUMERO='+document.form.SERVI_NUMERO.value+'&SERVI_EQUIP_IDO='+data+'&SERVI_USUAR_RESPONSAVEL=<?=$SERVI_USUAR_RESPONSAVEL?>');

		request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

		request.onreadystatechange = output_responsavel;

	}

	 

	request.send('');

}



function output_complemento(){

	if(request.readyState == 1){

		//You can add animated gif while loading // 

		document.getElementById('complemento').innerHTML = 'Verificando complementos a serem preenchidos...';

	}

	if (request.readyState == 4){

		var data = request.responseText;

		document.getElementById('complemento').innerHTML = data;

	}

}



function output_responsavel(){

	if(request.readyState == 1){

		//You can add animated gif while loading // 

		document.getElementById('responsavel').innerHTML = 'Verificando responsáveis disponíveis...';

	}

	if (request.readyState == 4){

		var data = request.responseText;

		document.getElementById('responsavel').innerHTML = data;

	}

}



function output_equipe(){

	if(request.readyState == 1){

		//You can add animated gif while loading // 

		document.getElementById('equipe').innerHTML = 'Verificando equipes disponíveis...';

	}

	if (request.readyState == 4){

		var data = request.responseText;

		document.getElementById('equipe').innerHTML = data;

	}

}



function output_servico(){

	if(request.readyState == 1){

		//You can add animated gif while loading // 

		document.getElementById('servico').innerHTML = 'Verificando tipos de serviços disponíveis...';

	}

	if (request.readyState == 4){

		var data = request.responseText;

		document.getElementById('servico').innerHTML = data;

	}

}



function ExcluirRegistro(IDS,Tipo) {

	if (confirm("Confirma exclusão do registro ?")) {

		if (Tipo == 1){

			JSUtilRequest("autoCompletar.php?cmd=remover&Tipo=1&Ids=" + IDS);

		}

		

		if (Tipo == 2){

			JSUtilRequest("autoCompletar.php?cmd=remover&Tipo=2&Ids=" + IDS);

		}

		

		if (Tipo == 3){

			JSUtilRequest("autoCompletar.php?cmd=remover&Tipo=3&Ids=" + IDS);

		}

		

		if (Tipo == 4){

			JSUtilRequest("autoCompletar.php?cmd=remover&Tipo=4&Ids=" + IDS);

		}

		

		if (Tipo == 5){

			JSUtilRequest("autoCompletar.php?cmd=remover&Tipo=5&Ids=" + IDS);

		}



	}

	get_conteudo(3);

}





function CompleteData(fieldPessoa) {

	if (fieldPessoa.value != "")

		JSUtilRequest("autoCompletar.php?cmd=d_s&PESSOA=" + fieldPessoa.value);

}



function CompletaEquipe(field) {

	alert(field.value);

	if (field.value != "")

		JSUtilRequest("autoCompletar2.php?cmd=equipe&SERVI_TIPPR_IDO=" + field.value);

}



function viewImage(fieldFile,optionValue) {

  if (fieldFile.value != "")

	document.images['imgFile' + optionValue].src = "file://" + fieldFile.value;

}



function updateFabrica() {

	JSUtilRequest('autoCompletar.php?cmd=p_f&REFERENCIA=' + escape(document.form.ITEM_REFERENCIA.value));

}



function validaTypeImg(fieldFile) {

	extension = (fieldFile.substring(fieldFile.lastIndexOf(".") + 1)).toLowerCase();

	if (extension == "jpg" || extension == "gif" || extension == "jpeg")

		return true;

	else

		return false;

}



function abrir_janela_popup(theURL,winName,features) {

		window.open(theURL,winName,features);

	}

	

function abre_listagem(){	

	abrir_janela_popup('rel_listagem_fabrica.php','popup_nf','width=400,height=400,top=0,left=0, scrollbars=yes,status=no,resizable=no,dependent=yes');

}



function verificaForm(formObj) {

	if (formObj.SERVI_USUAR_RESPONSAVEL.value == "") {

		alert("Preencha o campo \"Responsável\"");

		formObj.SERVI_USUAR_RESPONSAVEL.focus();

		return;

	}

	

	if (formObj.SERVI_STATUS.value == "") {

		alert("Preencha o campo \"Status\"");

		formObj.SERVI_STATUS.focus();

		return;

	}

	document.getElementById("idButtons").style.display = "none";

	

	formObj.action = "pesq_wfarec_concluiranjook.php";		

	document.form.submit();

}



function Chat(){

	abrir_janela_popup('chat.php?SERVI_NUMERO='+document.form.SERVI_NUMERO.value+'&ClienteNome=<?=$NomeCliente?>','chat','width=780,height=480,top=0,left=0, scrollbars=yes,status=yes,resizable=no,dependent=yes')

}



function Cobranca(Servico){

	abrir_janela_popup('pesq_wfarec_cobranca.php?Consulta=S&SERVI_NUMERO='+Servico+'&ClienteNome=<?=$NomeCliente?>','cobranca','width=780,height=480,top=0,left=0, scrollbars=yes,status=yes,resizable=no,dependent=yes')

}



function Comercial(Servico){

	abrir_janela_popup('pesq_wfarec_rarcomercial.php?Consulta=S&SERVI_NUMERO='+Servico+'&ClienteNome=<?=$NomeCliente?>','comercial','width=780,height=480,top=0,left=0, scrollbars=yes,status=yes,resizable=no,dependent=yes')

}



function Verifica(Tipo) {

	if (document.form.SERVI_USUAR_RESPONSAVEL.value != document.form.SERVI_USUAR_RESPONSAVEL_ORIG.value){

		document.form.SERVI_STATUS.disabled = true;

	}else{

		document.form.SERVI_STATUS.disabled = false;

	}

}



//-->

</script>

