<? include("inc/headerI.inc.php");

verifyAcess("TRANS_SOLCOLETA","S");?>

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

<style type="text/css">

<!--

.style3 {

	color: #FFFFFF;

	font-weight: bold;

}

.style5 {color: #FFFFFF}

-->

</style>

<body onLoad="MM_preloadImages('imagens/confirmar2.jpg')">

<form name="form" method="post" action="#">

<tr>

    <td height="100%" valign="top" class="tab_conteudo">

    <table width="100%" border="0" cellspacing="0" cellpadding="0">

      <tr>

        <td height="100%" class="tab_titulo"><h4>Solicita&ccedil;&atilde;o de coleta no cliente</h4></td>

      </tr>

    </table>

    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="tab_conteudo">

      <tr>

        <td width="100%"> <div align="center">

          <table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0">

            <tr class="tab_usuarios" >

              <td width="3%" align="center"><img src="../img/bts/selecionar.jpg" border="0"></td>

              <td width="5%" >&nbsp;</td>

              <td width="7%" ><div align="center"><a href="pesq_solic_coleta.php?Ordem=1&Categoria=<?=$_GET["Categoria"]?>">N&ordm; NF</a></div></td>

              <td width="10%" ><div align="center"><a href="pesq_solic_coleta.php?Ordem=2&Categoria=<?=$_GET["Categoria"]?>">Data NF</a> </div></td>

              <td width="5%" ><div align="center">Qtde Vol.</div></td>

              <td width="45%" ><div align="left">Nome do Cliente </div></td>

              <td width="20%" >Cidade / UF</td>

              </tr>

<?



	if ($_GET["Categoria"] == "1"){

		$Criterio = " AND PRENF_PESSOA_EMITENTE IN (18800,19000)";

	}else{

		$Criterio = " AND PRENF_PESSOA_EMITENTE NOT IN (18800,19000)";

	}

	

	$Sql = "SELECT CGCCPF CNPJ, PRENF_PESSOA_DESTINATARIO, ".

	               " PRENF_NUMPRENF, ".

			       " PRENF_NUMNFDEVOLUCAO, ".

				   " PRENF_CFOP, ".

			       " date_format(PRENF_DATA_INFNFDEVOLUCACAO,'%d/%m/%Y') DATANF, ".

			       " ROUND(PRENF_QTDEVOLUME,0) PRENF_QTDEVOLUME, ".

				   " NOME NOMECLIENTE, ".

				   " NM_MUNICIPIO CIDADE, ".

				   " SG_UF UF, ".

			       "(SELECT ROUND(SUM(PRENFI_QUANTIDADE),0) QTDE ".

				   "   FROM rar_prenf_item ".

			       "  WHERE PRENFI_NUMPRENF = PRENF_NUMPRENF ".

				   "GROUP BY PRENF_PESSOA_EMITENTE) QTDE, ".

			       "(SELECT ROUND(SUM(PRENFI_QUANTIDADE * PRENFI_VALORUNITARIO),2) VALOR ".

				   "   FROM rar_prenf_item ".

			       "  WHERE PRENFI_NUMPRENF = PRENF_NUMPRENF ".

				   "GROUP BY PRENF_PESSOA_EMITENTE) VALOR ".

			" FROM rar_prenf, pessoa, rar_usuarioxcliente ".

			"WHERE PESSOA = PRENF_PESSOA_DESTINATARIO ".

			       " AND PRENF_DATA_SOLIC_COLETA IS NULL ".

				   " AND PRENF_NUMNFDEVOLUCAO IS NOT NULL ".

				   //" AND PRENF_CATEGORIA = ".$_GET["Categoria"].

				   $Criterio.

			       " AND USUCLI_PESSOA = PRENF_PESSOA_DESTINATARIO ".

				   " AND PRENF_PESSOA_EMITENTE IN (SELECT USUFOR_PESSOA FROM rar_usuarioxfornecedor WHERE USUFOR_USUAR_IDO = '" .$_SESSION['sId']. "')".

				   " AND USUCLI_USUAR_IDO = '" .$_SESSION['sId']. "'";

			if ($_GET["Ordem"] == ""){

		    	$Sql.= " ORDER BY PRENF_DATA_INFNFDEVOLUCACAO, PRENF_NUMNFDEVOLUCAO";

			}



			if ($_GET["Ordem"] == 1){

		    	$Sql.= " ORDER BY PRENF_NUMNFDEVOLUCAO, PRENF_DATA_NFDEVOLUCAO";

			}



			if ($_GET["Ordem"] == 2){

		    	$Sql.= " ORDER BY PRENF_DATA_INFNFDEVOLUCACAO, PRENF_NUMNFDEVOLUCAO";

			}

	//die($Sql);

	$Stmt = mysql_query($Sql);

	while($Rs = mysql_fetch_assoc($Stmt)) { ?>

            <tr class="tab_usuarios_info">

              <td width="3%"><div align="center"><input type="checkbox" name="ID" value="<?=$Rs["PRENF_NUMPRENF"]?>"></div></td>

              <td width="3%" class="listagem" ><div align="center"><a href="<?=((trim("1")) ? "javascript:abrir_janela_popup('imp_prenota.php?Id=" .$Rs["PRENF_NUMPRENF"]. "','popup_nf','width=780,height=550,top=0,left=0, scrollbars=yes,status=no,resizable=no,dependent=yes')" : "#")?>"><img src="imagens/imprimir.gif" alt="Clique aqui para imprimir carta-coleta" width="20" height="20" border="0"></a></div></td>

              <td width="10%" class="listagem" ><div align="center"><?=$Rs["PRENF_NUMNFDEVOLUCAO"]?></div></td>

              <td width="10%" ><div align="center"><?=$Rs["DATANF"]?></div></td>

              <td width="10%" ><div align="center"><?=$Rs["PRENF_QTDEVOLUME"]?></div></td>

              <td width="10%">                  <?=$Rs["PRENF_PESSOA_DESTINATARIO"]?> -                 <?=$Rs["NOMECLIENTE"]?>

                (<?=FormataCnpj($Rs["CNPJ"])?>

                )</td>

              <td><?=$Rs["CIDADE"]?> /

                <?=$Rs["UF"]?></td>

              </tr>

	<? } ?>

            </table>

			<hr>

		  	<div align="left">&nbsp;<br></div>

        </div></td>

        </tr>

      <tr class="">

        <td class="">

		<table width="100%" border="0" cellpadding="0" cellspacing="0">

          <tr class="tab_conteudo">

            <td colspan="3"><div align="center" class="tab_titulo">Assinale a(s) transportadora(s) a qual deseja enviar a solicita&ccedil;&atilde;o de coleta</div></td>

            </tr>

          <tr class="tab_usuarios">

            <td align="center"><img src="../img/bts/selecionar.jpg" border="0"></td>

            <td><strong>Nome da transportadora</strong></td>

            <td><strong>Nome do contato na transportadora</strong></td>

          </tr>

        <?

		  	$ar_transp=mysql_query("select * from rar_transportadoras order by transp_ido desc");

			while ($linha=mysql_fetch_array($ar_transp))

			//echo "<input type='checkbox' name='transp' value=".$linha["transp_email"].">".$linha["transp_nome"]."<br>";

			{ ?>

				<tr class="tab_usuarios_info">

				<td width="3%"><input type="checkbox" name="transp" value="<?=$linha["transp_email"]?>"></td>

				<td width="47%"><?=$linha["transp_nome"]?></td>

				<td width="50%"><?=$linha["transp_contato"]?></td>

				</tr>

			<?

			}

		?>

        </table>

        </td>

      </tr>

      <tr>

        <td><a href="javascript:confirmar();" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image34','','imagens/confirmar2.jpg',1)">

          <?

		  if (returnAcess('TRANS_SOLCOLETA_CON') == 'N'){ ?>

          <img src="imagens/confirmar.jpg" alt="Confirmar recebimento da NF assinalada" name="Image34" width="79" height="22" border="0"></a>

          <? } ?></td>

      </tr>

    </table>

</form>

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



var Ordem = "";

var Url = location.href;

Url = Url.replace(/.*\?(.*?)/,"$1");

Variaveis = Url.split ("&");

for (i = 0; i < Variaveis.length; i++) {

tmp = Variaveis[i].split("=");

eval ('var '+tmp[0]+'="'+tmp[1]+'"');

}



function confirmar() {

	Values = chk_checkedAllValues(document.form.ID,true);

	Transp = chk_checkedAllValues(document.form.transp,true);

	if (Values == "") {

		alert("Nenhuma reclamção assinalada !");

		return;

	}

    if (form.transp.value == ""){

   	   alert("Nenhuma Transportadora selecionada !");

	   return;

	}

	 document.location.href = "pesq_solic_coletaok.php?transp=" +Transp+"&Ids=" + Values+"&Ordem=" + Ordem+"&Categoria=" + Categoria;

}



function chk_checkedAllValues(elementForm,checked,optionDiv,valueEncode) {

	if (elementForm) {

		if (elementForm.length == undefined) {

			if (elementForm.checked == checked)

				return elementForm.value;

			return "";

		}else{

			var Values = "";

			optionDiv = (optionDiv == undefined) ? "," : optionDiv;

			valueEncode = (valueEncode == undefined) ? false : valueEncode;

			for(x = 0; x < elementForm.length; x++) {

				if (elementForm[x].checked == checked)

					Values+= ((Values.length > 0) ? optionDiv : "") + ((valueEncode) ? escape(elementForm[x].value) : elementForm[x].value);

			}

			return Values;

		}

	}

	return "";

}

//-->

</script>