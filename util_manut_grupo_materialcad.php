<? include("inc/headerI.inc.php"); 	

verifyAcess("DES_MANUT_GRUPOMAT","S");?>



<?

	$Sql = "SELECT * ".

			" FROM RAR_SERVICO, RAR_SERVICO_SOLICITACAOMATERIAL ".

			" WHERE SERVI_NUMERO = SERSM_SERVI_NUMERO ".

			"       AND SERSM_IDO = '".$_GET['Id']."'";

	$Stmt = mysql_query($Sql);

	if ($Rs = mysql_fetch_assoc($Stmt)){

	

	}

	

?>

<link href="wfa.css" rel="stylesheet" type="text/css" />

<script type="text/JavaScript">

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

<body onLoad="MM_preloadImages('imagens/gravar2.jpg','imagens/cancelar2.jpg')">



<form name="form" method="post" action="util_manut_grupo_materialcadok.php" enctype="multipart/form-data">

<table width="100%"  border="0" align="center">

     <tr>

       <td><span class="titulo">:: Servi&ccedil;os - Manuten&ccedil;&atilde;o dados solicita&ccedil;&atilde;o de material :: </span>         <div align="right"><span class="titulo"><a href="javascript: abrir_help('#delprenf');"></a></span></div></td>

     </tr>

  </table>

</td>

   <td><img name="webdevol_r7_c11" src="imagens/img/webdevol_r7_c11.jpg" width="33" height="38" border="0" alt=""></td>

  </tr>

  <tr>

   <td background="imagens/img/webdevol_r8_c1.jpg">&nbsp;</td>

   <td colspan="9"><table width="100%"  border="0" class="tabela">

     <tr class="listagem_azul">

       <td height="20" class="style2"><strong>:: Dados do Servi&ccedil;o :: </strong></td>

       <td height="20" class="campo_amarelo"><input name="SERSM_IDO" type="hidden" id="SERSM_IDO" value="<?=$_GET["Id"]?>" />

         <input name="SERVI_DATAABERTURAI" type="hidden" id="SERVI_DATAABERTURAI" value="<?=$_GET["SERVI_DATAABERTURAI"]?>" />

         <input name="SERVI_DATAABERTURAF" type="hidden" id="SERVI_DATAABERTURAF" value="<?=$_GET["SERVI_DATAABERTURAF"]?>" /></td>

     </tr>

     <tr>

       <td width="34%" height="10" class="style2"><strong>N&uacute;mero do servi&ccedil;o</strong></td>

       <td width="66%" height="10" class="campo_amarelo"><?=$Rs["SERVI_NUMERO"]?></td>

       </tr>

     <tr>

       <td height="10" class="style2"><strong>Complemento</strong></td>

       <td height="10" class="campo_amarelo"><?=$Rs["SERVI_COMPLEMENTO"]?></td>

     </tr>

     <tr>

       <td height="10" class="style2"><strong>Retorno ao cliente </strong></td>

       <td height="10" class="campo_amarelo"><?=$Rs["SERVI_OBS_RESPONSAVEL"]?></td>

     </tr>

     <tr>

       <td height="10" class="style2">Observa&ccedil;&otilde;es do anjo </td>

       <td height="10" class="campo_amarelo"><?=$Rs['SERVI_OBS_ANJO']?></td>

     </tr>

     <tr class="listagem_azul">

       <td height="30" colspan="2" class="style2"><strong>:: Dados da solicita&ccedil;&atilde;o de material :: </strong></td>

       </tr>

     <tr>

       <td height="10" class="style2"><strong>Descri&ccedil;&atilde;o</strong></td>

       <td height="10" class="campo_amarelo"><?=$Rs["SERSM_DESCRICAO"]?></td>

     </tr>

     <tr>

       <td height="10" class="style2"><strong>Refer&ecirc;ncia</strong></td>

       <td height="10" class="campo_amarelo"><?=$Rs["SERSM_REFERENCIA"]?></td>

     </tr>

     <tr>

       <td height="10" class="style2"><strong>Quantidade</strong></td>

       <td height="10" class="campo_amarelo"><?=$Rs["SERSM_QUANTIDADE"]?></td>

     </tr>

     <tr>

       <td height="10" class="style2">Entregue</td>

       <td height="10"><select name="SERSM_ENTREGUE" id="SERSM_ENTREGUE" class="campo_texto">

         <option value="">-- Selecione --</option>

         <option value="S">SIM</option>

         <option value="N">N&Atilde;O</option>

                     </select></td>

     </tr>

     <tr>

       <td height="10" class="style2">Grupo material </td>

       <td height="10"><select name="SERSM_MATERG_IDO" id="SERSM_MATERG_IDO" class="campo_texto" >

         <option value="">-- Selecione --</option>

         <?

				$Sql = " select * ";

				$Sql.= " from rar_material_grupo ";

				$Sql.= " where materg_categoria = '".$Rs["SERVI_TIPPR_IDO"]."'";

				$Sql.= " order by materg_categoria, materg_descricao";

				$Stmt = mysql_query($Sql);

				while($RsGrupo = mysql_fetch_assoc($Stmt)) {

				?>

         <option value="<?=$RsGrupo["MATERG_IDO"]?>">

           <?=CategoriaProduto($RsGrupo["MATERG_CATEGORIA"])." - ".$RsGrupo["MATERG_DESCRICAO"]?>

           </option>

         <? } ?>

       </select></td>

     </tr>

     <tr>

       <td colspan="2"> 

	   <div id="idButtons" style="display:" align="center">

	   <a href="javascript:verificaForm(document.form);" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image351','','imagens/gravar2.jpg',1)"><img src="imagens/gravar.jpg" name="Image351" width="58" height="20" border="0" id="Image351"></a><a href="javascript:history.go(-1);" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image361','','imagens/cancelar2.jpg',1)"><img src="imagens/cancelar.jpg" name="Image361" width="68" height="20" border="0" id="Image361"></a></div></td>

       </tr>

   </table>

   <input type="hidden" name="TOTAL_ITENS" value="15">

</form>

<? include("inc/headerF.inc.php"); ?>

<script language="javascript" type="text/javascript">

<!--

function verificaForm(formObj) {



	if (formObj.SERSM_MATERG_IDO.value == "") {

		alert("Preencha o campo \"Grupo do material\"");

		return;

	}

	

	document.getElementById("idButtons").style.display = "none";

	

	formObj.action = "util_manut_grupo_materialcadok.php";

	document.form.submit();

}





//-->

</script>

