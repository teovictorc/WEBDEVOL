<? include("inc/conn_externa.inc.php");  

	$Sql = "SELECT RAR_PRENF.*, CREDITOS_PAGOS.*, date_format(DATA_LIQUIDACAO,'%d/%m/%Y') DATANF ".

			  "  FROM RAR_PRENF, CREDITOS_PAGOS ".

			  " WHERE PRENF_NUMPRENF = '" .$_GET["ID"]. "'".

			  "       AND PRENF_PESSOA_DESTINATARIO = PESSOA ".

			  "       AND PRENF_NUMNFDEVOLUCAO = NUM_NF ";

			  //"       AND PRENF_SERIE = SERIE_NF ";

			  //die($Sql);

	$Stmt = mysql_query($Sql);

	$Rs = mysql_fetch_assoc($Stmt);



?><style type="text/css">

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



function abrir_janela_popup(theURL,winName,features) { //v2.0

		window.open(theURL,winName,features);

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

<body onLoad="MM_preloadImages('imagens/cancelar2.jpg')"><form name="form" method="POST" action="#">

<input type="hidden" name="ID" value="<?=$ID?>">

<table width="100%"  border="0" align="center">

 </td>

   <td colspan="9">

     <table width="100%"  border="0" class="tabela">

       <tr class="topo_listagem">

         <td height="30" colspan="4" class="titulo"><div align="center">:: Dados do cr&eacute;dito concedido ao cliente::</div></td>

        </tr>

       <tr>

         <td class="style2">&nbsp;</td>

         <td colspan="3">&nbsp;</td>

       </tr>

       <tr>

         <td class="style2"><strong>Forma de pagamento </strong></td>

         <td colspan="3"><input name="PRENF_NUMNFDEVOLUCAO2" type="text" class="campo_amarelo" id="PRENF_NUMNFDEVOLUCAO2" value="<?=$Rs["FORMA_PAGAMENTO"]?>" disabled size="50" maxlength="5"></td>

        </tr>

       <tr>

         <td width="20%" class="style2"><strong>N&ordm; NF</strong></td>

         <td><input name="PRENF_NUMNFDEVOLUCAO" type="text" class="campo_amarelo" id="PRENF_NUMNFDEVOLUCAO" value="<?=$Rs["PRENF_NUMNFDEVOLUCAO"]?>" disabled size="20" maxlength="5">           <div align="right"></div></td>

         <td align="right" class="style2"><strong>N&ordm; s&eacute;rie: </strong></td>

         <td><input name="PRENF_SERIE" type="text" class="campo_amarelo" id="PRENF_SERIE2" value="<?=((trim($Rs["PRENF_SERIE"])) ? $Rs["PRENF_SERIE"] : "U")?>" size="11" disabled maxlength="3" ></td>

       </tr>

       <tr>

         <td class="style2"><strong>Data do cr&eacute;dito </strong></td>

         <td width="29%"><input name="PRENF_DATA_INFNFDEVOLUCAO" type="text" class="campo_amarelo" id="PRENF_DATA_INFNFDEVOLUCAO" onKeyPress="return JSUtilApenasNumero(event);" onKeyUp="JSUtilMascara(this,event,'__/__/____');" disabled value="<?=$Rs["DATANF"]?>" size="11" maxlength="11"></td>

         <td width="17%" class="style1"><div align="right">Valor cr&eacute;dito: </div></td>

         <td width="34%"><input name="PRENF_DATA_INFNFDEVOLUCAO2" type="text" class="campo_amarelo" id="PRENF_DATA_INFNFDEVOLUCAO2" onKeyPress="return JSUtilApenasNumero(event);" onKeyUp="JSUtilMascara(this,event,'__/__/____');" disabled value="<?=formatCurrency($Rs["valor_pago"])?>" size="18" maxlength="18"></td>

       </tr>

       <tr class="style2">

         <td class="style2 style1">Banco:</td>

         <td>

           <input name="BancoOrig" type="text" disabled class="campo_amarelo" id="BancoOrig" value="<?=$Rs["BANCO"]?>" size="4" maxlength="3">           <div align="right" class="style1"></div>           </td>

         <td><div align="right"><strong>Ag&ecirc;ncia:</strong></div></td>

         <td><input name="AgenciaOrig" type="text" disabled class="campo_amarelo" id="AgenciaOrig" value="<?=$Rs["AGENCIA_CODIGO"]?>" size="7" maxlength="5">

-

  <input name="Agencia_NomeOrig" type="text" disabled class="campo_amarelo" id="Agencia_NomeOrig" value="<?=$Rs["AGENCIA_NOME"]?>" size="30" maxlength="30"></td>

       </tr>

       <tr class="style2">

         <td class="style2 style1">N.&deg; da conta:</td>

         <td >

           <input name="ContaOrig" type="text" disabled class="campo_amarelo" id="ContaOrig" value="<?=$Rs["CONTA"]?>" size="21" maxlength="20">           <div align="right" class="style2 style1"></div>           </td>

         <td ><div align="right"><strong>Titular da conta: </strong></div></td>

         <td ><input name="TitularOrig" type="text" disabled class="campo_amarelo" id="TitularOrig" value="<?=$Rs["TITULAR"]?>" size="50" maxlength="50"></td>

       </tr>

	   <? if ($Rs["PRENF_CATEGORIA"] == "2"){?>

		   <tr>

			 <td colspan="4"><table width="70%"  border="0" align="center" class="imp_normal_total">

			   <tr class="topo_listagem">

				 <td><div align="center">Comprovante de dep&oacute;sito </div></td>

			   </tr>

			   <tr>

				 <td><div align="center" onClick="abrir_janela_popup('visualizar_foto.php?path=../fotos/<?=$_GET["ID"]?>_COMPROVANTE.JPG','foto','width=780,height=480,top=0,left=0, scrollbars=yes,status=yes,resizable=no,dependent=yes')"><a href="#"><img src="fotos/<?=$_GET["ID"]?>_COMPROVANTE.JPG" alt="Clique sobre a imagem para ampliar" width="288" height="240" border="0" ></a></div></td>

			   </tr>

			   <tr>

			     <td><div align="center">Clique sobre a imagem para ampliar</div></td>

		       </tr>

			 </table></td>

		   </tr>

	   <? } ?>

       <tr>

         <td colspan="4">

           <div align="center"></div></td>

       </tr>

       <tr>

         <td colspan="4"><p align="center">

		  <a href="javascript: window.close()"><img src="imagens/fechar.jpg" alt="" name="Image361" width="52" height="22" border="0" id="Image361"></a></p></td>

       </tr>

     </table>



</form>

